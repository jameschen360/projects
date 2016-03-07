<?php
    //Change these with your information
    $paypalmode = ''; //Sandbox for testing or empty ''
    $dbusername     = '***'; //db username
    $dbpassword     = '***'; //db password
    $dbhost     = 'localhost'; //db host
    $dbname     = '***'; //db name

if($_POST)
{
        if($paypalmode=='sandbox')
        {
            $paypalmode     =   '.sandbox';
        }
        $req = 'cmd=' . urlencode('_notify-validate');
        foreach ($_POST as $key => $value) {
            $value = urlencode(stripslashes($value));
            $req .= "&$key=$value";
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www'.$paypalmode.'.paypal.com/cgi-bin/webscr');
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Host: www'.$paypalmode.'.sandbox.paypal.com'));
        $res = curl_exec($ch);
        curl_close($ch);

        if (strcmp ($res, "VERIFIED") == 0)
        {
		    $conn = mysql_connect($dbhost,$dbusername,$dbpassword);
            if (!$conn)
            {
             die('Could not connect: ' . mysql_error());
            }

            mysql_select_db($dbname, $conn);
            $transaction_id = $_POST['txn_id'];
            $payerid = $_POST['payer_id'];
            $firstname = $_POST['first_name'];
            $lastname = $_POST['last_name'];
            $payeremail = $_POST['payer_email'];
            $paymentdate = $_POST['payment_date'];
            $paymentstatus = $_POST['payment_status'];
			$gift_to = $_POST['option_selection1'];
			$gift_total = floor($_POST['mc_gross']/1.029 + 0.4);
            $mdate= date("D, d M Y H:i:s", time()); 
			$date_mail= date("F j, Y", time()); 
			$reciever_email = $_POST['custom'];
			$activation_fee = $gift_total - ($_POST['mc_gross']/1.029 + 0.4);
			$check = mysql_query("SELECT * FROM giftcert WHERE txn_id='$transaction_id'");
			$check = mysql_num_rows($check);
			if ($check == 1) {
				$case = "update";
			} else {
				$case = "insert";
			}
			
			function sernum() //  generate random gift code based on given template
			{
				$template   = 'XXXX-XX99-99XX-9999';
				$k = strlen($template);
				$sernum = '';
				for ($i=0; $i<$k; $i++)
				{
					switch($template[$i])
					{
						case 'X': $sernum .= chr(rand(65,90)); break;
						case '9': $sernum .= rand(0,9); break;
						case '-': $sernum .= '-';  break;
					}
				}
				return $sernum;
			}
			
			$gift_code = sernum();
			$check_dups = mysql_query("SELECT * FROM giftcert WHERE gift_code='$gift_code'");
			$check_dups = mysql_num_rows($check_dups);
				while ($check_dups >= 1) {
					$gift_code = sernum();
					$check_dups = mysql_query("SELECT * FROM giftcert WHERE gift_code='$gift_code'");
					$check_dups = mysql_num_rows($check_dups);
				}// check for duplicating gift codes			
			
			require_once ("services/phpmailer/class.phpmailer.php");//obtain mailer classes
			/* -- Mail to Gift Reciever -- */
			$message = '<html><head><style>';
			$message .= file_get_contents("services/email_styling.css");
			$message .= '</style><body>';
			$message .= '<table class="body-wrap"><tr><td></td><td class="container" style="border-style: solid; border-width:1px;border-color: #BAA378;" >';
			$message .= '<div class="content"><table><tr><td>';
			$message .= '<center><img src ="http://harthousewineandtapa.com/admin/images/logo.png" alt = "Hart House Wine and Tapa"></center>';
			$message .= '<h4> Hi '.$gift_to.'!<br>You have just received a <b><i>$'.$gift_total.'</i></b> CAD electronic gift voucher from '.$firstname.' '.$lastname.' to dine with us at the Hart House Wine and Tapa!</h4><br>';
			$message .= '<div class="container cont-pad-t-sm"><div class="box"><div class="ribbon"><span>Voucher</span></div>';
			$message .= '<div class="panel-body text-center"><center><div class="row"><div class="main-col">';
			$message .= '<h1>Hart House Wine and Tapa</h1>';
			$message .= '<h3>Gift Voucher of <b><i>$'.$gift_total.'</i></b> CAD</h3>';
			$message .= '<h4>'.$gift_code.'</h4>';
			$message .= '<p><img alt="'.$gift_code.'" src="http://harthousewineandtapa.com/services/barcode.php?codetype=Code128&size=50&text='.$gift_code.'" /></p></div><br/></div>
						</div>
						</div>';
			$message_completed .= '<br>Sincerely,<br>Hart House Wine and Tapa';			
			$message .= '</div></td></tr></table>';			
		    $message .= '<div class="content"><table><tr><td align="center">';
			$message .= '<p>Hart House Wine and Tapa<br>Email: harthousewineandtapa@gmail.com<br/>4812 49 St
						Camrose, Alberta, T4V 1M5<br>&copy 2015 All Rights Reserved</p>';
			$message .= '</p></td></tr></table></div>';	
			$message .= '</div></td><td></td></tr></table>';	
			$message .= '</body></html>';

			$mail = new PHPMailer(); // create a new object
			$mail->IsSMTP(); // enable SMTP
			$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
			$mail->SMTPAuth = true; // authentication enabled
			$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
			$mail->Host = "smtp.gmail.com";
			$mail->Port = 465; // or 587
			$mail->IsHTML(true);
			$mail->Username = "harthousewineandtapa@gmail.com";
			$mail->Password = "****";
			$mail->SetFrom("harthousewineandtapa@gmail.com", "Hart House Wine and Tapa");
			$mail->Subject = "You have received a gift from $firstname $lastname!";
			$mail->Body = $message;
			$mail->AddAddress("$reciever_email");
			
			
			/* -- Pending Order Mail -- */
			$message_pending = '<html><head><style>';
			$message_pending .= file_get_contents("services/email_styling.css");
			$message_pending .= '</style><body>';
			$message_pending .= '<table class="body-wrap"><tr><td></td><td class="container" style="border-style: solid; border-width:1px;border-color: #BAA378;" >';
			$message_pending .= '<div class="content"><table><tr><td>';
			$message_pending .= '<center><img src ="http://harthousewineandtapa.com/admin/images/logo.png" alt = "Hart House Wine and Tapa" ></center>';
			$message_pending .= '<h4><br>Dear '.$firstname.' '.$lastname.',</h4><br>Thank you for purchasing our electronic gift voucher!<br>We have received your gift voucher order of the amount <b><i>$'.$gift_total.'</i></b> CAD and is now currently processing the order.<br>Your transaction ID for this order is <b><i>'.$transaction_id.'</i></b> and was purchased on '.$date_mail.'.<br>When the payment is cleared, we will send the electronic gift voucher to the recipient!<br>A total of $'.$_POST['mc_gross'].' CAD will be charged to your PayPal account.';
			$message_pending .= '<br><p>If you have any questions regarding this purchase, feel free to contact us at <b><i>harthousewineandtapa@gmail.com</i></b>.</p>';
			$message_pending .= '<br>Sincerely,<br>Hart House Wine and Tapa';
			$message_pending .= '</div></td></tr></table>';
		    $message_pending .= '<div class="content"><table><tr><td align="center">';
			$message_pending .= '<p>Hart House Wine and Tapa<br>Email: harthousewineandtapa@gmail.com<br/>4812 49 St
						Camrose, Alberta, T4V 1M5<br>&copy 2015 All Rights Reserved</p>';
			$message_pending .= '</p></td></tr></table></div>';	
			$message_pending .= '</div></td><td></td></tr></table>';	
			$message_pending .= '</body></html>';

			$mail_pending = new PHPMailer(); // create a new object
			$mail_pending->IsSMTP(); // enable SMTP
			$mail_pending->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
			$mail_pending->SMTPAuth = true; // authentication enabled
			$mail_pending->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
			$mail_pending->Host = "smtp.gmail.com";
			$mail_pending->Port = 465; // or 587
			$mail_pending->IsHTML(true);
			$mail_pending->Username = "harthousewineandtapa@gmail.com";
			$mail_pending->Password = "***";
			$mail_pending->SetFrom("harthousewineandtapa@gmail.com", "Hart House Wine and Tapa");
			$mail_pending->Subject = "Your gift voucher payment is being processed";
			$mail_pending->Body = $message_pending;
			$mail_pending->AddAddress("$payeremail");
			
			/* -- Completed Order Mail -- */
			$message_completed = '<html><head><style>';
			$message_completed .= file_get_contents("services/email_styling.css");
			$message_completed .= '</style><body>';
			$message_completed .= '<table class="body-wrap"><tr><td></td><td class="container" style="border-style: solid; border-width:1px;border-color: #BAA378;" >';
			$message_completed .= '<div class="content"><table><tr><td>';
			$message_completed .= '<center><img src ="http://harthousewineandtapa.com/admin/images/logo.png" alt = "Hart House Wine and Tapa" ></center>';
			$message_completed .= '<h4><br>Dear '.$firstname.' '.$lastname.',</h4><br>You have successfully sent an electronic gift voucher with the amount of <b><i>$'.$gift_total.'</i></b> CAD to '.$gift_to.'.<br>Your transaction ID for this order is <b><i>'.$transaction_id.'</i></b> was completed on '.$date_mail.'.<br>A total of $'.$_POST['mc_gross'].' CAD is charged to your PayPal account.';
			$message_completed .= '<br><p>Thank you for purchasing an electronic gift voucher from us!<br>If you have any questions regarding this purchase, feel free to contact us at <b><i>harthousewineandtapa@gmail.com</i></b>.</p>';
			$message_completed .= '<br>Sincerely,<br>Hart House Wine and Tapa';
			$message_completed .= '</div></td></tr></table>';
		    $message_completed .= '<div class="content"><table><tr><td align="center">';
			$message_completed .= '<p>Hart House Wine and Tapa<br>Email: harthousewineandtapa@gmail.com<br/>4812 49 St
						Camrose, Alberta, T4V 1M5<br>&copy 2015 All Rights Reserved</p>';
			$message_completed .= '</p></td></tr></table></div>';	
			$message_completed .= '</div></td><td></td></tr></table>';	
			$message_completed .= '</body></html>';

			$mail_completed = new PHPMailer(); // create a new object
			$mail_completed->IsSMTP(); // enable SMTP
			$mail_completed->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
			$mail_completed->SMTPAuth = true; // authentication enabled
			$mail_completed->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
			$mail_completed->Host = "smtp.gmail.com";
			$mail_completed->Port = 465; // or 587
			$mail_completed->IsHTML(true);
			$mail_completed->Username = "harthousewineandtapa@gmail.com";
			$mail_completed->Password = "****";
			$mail_completed->SetFrom("harthousewineandtapa@gmail.com", "Hart House Wine and Tapa");
			$mail_completed->Subject = "Electronic gift voucher sent!";
			$mail_completed->Body = $message_completed;
			$mail_completed->AddAddress("$payeremail");			
			if ($paymentstatus == "Completed" and $case == "insert") {

	            // insert in our IPN record table
				$query = "INSERT INTO giftcert
				(txn_id,payer_id,gift_from,payer_email,payment_date,payment_status,mc_gross,gift_code,reciever_email,gift_to)
				VALUES
				('$transaction_id','$payerid','$firstname $lastname','$payeremail','$mdate', '$paymentstatus','$gift_total','$gift_code','$reciever_email','$gift_to')";

				 if(!$mail->Send()) {
					//echo "Mailer Error: " . $mail->ErrorInfo;
				 } else {
					//echo "Message has been sent";
				 }
				
				 if(!$mail_completed->Send()) {
					//echo "Mailer Error: " . $mail->ErrorInfo;
				 } else {
					//echo "Message has been sent";
				 }					
				
			} elseif ($paymentstatus == "Completed" and $case == "update"){
				
				// insert in our IPN record table when completed with update
				$query = "UPDATE giftcert SET gift_code='$gift_code' WHERE txn_id='$transaction_id'";
				$query2 = "UPDATE giftcert SET payment_status='$paymentstatus' WHERE txn_id='$transaction_id'";
				mysql_query($query2);
				
				 if(!$mail->Send()) {
					//echo "Mailer Error: " . $mail->ErrorInfo;
				 } else {
					//echo "Message has been sent";
				 }
				 
				 if(!$mail_completed->Send()) {
					//echo "Mailer Error: " . $mail->ErrorInfo;
				 } else {
					//echo "Message has been sent";
				 }				 
				
			} elseif ($paymentstatus == "Pending") {
				unset($gift_code);//clears giftcode if payment not completed
			    // insert in our IPN record table
				$query = "INSERT INTO giftcert
				(txn_id,payer_id,gift_from,payer_email,payment_date,payment_status,mc_gross,gift_code,reciever_email,gift_to)
				VALUES
				('$transaction_id','$payerid','$firstname $lastname','$payeremail','$mdate', '$paymentstatus','$gift_total','$gift_code','$reciever_email','$gift_to')";
				
				 if(!$mail_pending->Send()) {
					//echo "Mailer Error: " . $mail->ErrorInfo;
				 } else {
					//echo "Message has been sent";
				 }				
				
				
			} else {
				unset($gift_code);
				$query = "UPDATE giftcert SET payment_status='$paymentstatus' WHERE txn_id='$transaction_id'";
			}



            if(!mysql_query($query))
            {
                //mysql error..!
            }
            mysql_close($conn);

        }
}
?>