<?
include('inc/connect.php');
    if (isset($_SESSION["user_login"])) {
        $username = $_SESSION['user_login'];
		if (ctype_alnum($username)) {
		//check user exists
		$sql = mysql_query("SELECT * FROM users WHERE username='$username'");
		$userCount = mysql_num_rows($sql); //Count the number of rows returned
        if ($userCount == 1) {
            while($row = mysql_fetch_array($sql)){ 
                 $id = $row["id"];
				 $firstname = $row['first_name'];
				 $lastname = $row['last_name'];
				 $email = $row['email'];
			}
		}
	}
	}
    else
    {
        header( 'Location: index.php' ) ;
    }
$sql = mysql_query("SELECT * FROM contact");
$value = mysql_fetch_array($sql);
$myemail = $value['email'];


if (isset($_POST['confirm_status'])) {
$confirm_status = mysql_real_escape_string($_POST['confirm_status']);
	
$stuff = mysql_query("SELECT * FROM reservation WHERE id='$confirm_status'");
while($row = mysql_fetch_array($stuff)){ 
                 $id = $row["id"];
				 $nameguest = $row['name'];
				 $theiremail = $row['email'];
				 $date = $row['date'];
				 $time = $row['time'];
				 $people = $row['people'];
				 $status = $row['isconfirmed'];
			}
			
$name = "$firstname $lastname";

			require_once ("../services/phpmailer/class.phpmailer.php");//obtain mailer classes
			$message_completed = '<html><head><style>';
			$message_completed .= file_get_contents("../services/email_styling.css");
			$message_completed .= '</style><body>';
			$message_completed .= '<table class="body-wrap"><tr><td></td><td class="container" style="border-style: solid; border-width:1px;border-color: #BAA378;" >';
			$message_completed .= '<div class="content"><table><tr><td>';
			$message_completed .= '<center><img src ="http://harthousewineandtapa.com/admin/images/logo.png" alt = "Hart House Wine and Tapa" ></center>';
			$message_completed .= '<h4><br>Dear '.$nameguest.',</h4><br>Your reservation has been confirmed for the date of '.$date.' at '.$time.' for '.$people.' people.<br>We look forward on seeing you!';
			$message_completed .= '<br><br>Sincerely,<br>Hart House Wine and Tapa';
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
			$mail_completed->Password = "tankwank";
			$mail_completed->SetFrom("harthousewineandtapa@gmail.com", "Hart House Wine and Tapa");
			$mail_completed->Subject = "Your reservation has been confirmed!";
			$mail_completed->Body = $message_completed;
			$mail_completed->AddAddress("$theiremail");	


if ($confirm_status!="") {
		
			if ($status == "yes") {
				echo "<meta http-equiv=\"refresh\" content=\"0; url=./request.php\">";
			} else {
			$sql = "UPDATE reservation SET isconfirmed='yes' WHERE id='$confirm_status'";
			$yes = mysql_query($sql);
			$sql = "UPDATE reservation SET action='$name' WHERE id='$confirm_status'";
			$yes = mysql_query($sql);		

			if(!$mail_completed->Send()) {
					echo "Mailer Error: " . $mail->ErrorInfo;
					echo "$theiremail $nameguest";
				 } else {
					//echo "Message has been sent";
					//echo $theiremail;
				 }				
			echo "<meta http-equiv=\"refresh\" content=\"0; url=./request.php\">";
			}
		
			
			
		} else {
			echo "<meta http-equiv=\"refresh\" content=\"0; url=./request.php\">";
	}




}
?>