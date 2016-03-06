<?php
    //Change these with your information
    $paypalmode = 'sandbox'; //Sandbox for testing or empty ''
	include('inc/db.php');

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

            $transaction_id = $_POST['txn_id'];
            $payerid = $_POST['payer_id'];
            $firstname = $_POST['first_name'];
            $lastname = $_POST['last_name'];
            $payeremail = $_POST['payer_email'];
            $paymentdate = $_POST['payment_date'];
            $paymentstatus = $_POST['payment_status'];
			$account_email = $_POST['option_selection1'];
			$gift_total = floor($_POST['mc_gross']/1.029 + 0.4);
            $mdate= date("D, d M Y H:i:s", time()); 
			$date_mail= date("F j, Y", time()); 
			$reciever_email = $_POST['custom'];
			$activation_fee = $gift_total - ($_POST['mc_gross']/1.029 + 0.4);
			
				//$query = "INSERT INTO ip (ip,currency) VALUES('$transaction_id','$account_email')";
				//mysqli_query($db,$query);
				mysqli_query($db, "UPDATE order_id SET status='Completed', token='$transaction_id' WHERE invoice='$reciever_email'");
							
				mysqli_query($db, "DELETE FROM ship_coup WHERE user='$account_email'");
				mysqli_query($db, "DELETE FROM cart WHERE user='$account_email'");
				
				$order_id_sql = mysqli_query($db, "SELECT * FROM order_id WHERE invoice='$reciever_email'");
				$order_id_sql = mysqli_fetch_assoc($order_id_sql);
					$bname = $order_id_sql['bname'];
					$product = $order_id_sql['product'];
					$baddress = $order_id_sql['baddress'];
					$saddress = $order_id_sql['saddress'];
					$is_same_shipping = $order_id_sql['is_same_shipping'];
					$invoice = $order_id_sql['invoice'];
					$total = $order_id_sql['total'];
					$id = $order_id_sql['id'];
				if ($is_same_shipping == "true"){
					$address = $baddress;
				}else {
					$address = $saddress;
				}
			require_once ("services/phpmailer/class.phpmailer.php");//obtain mailer classes

			$message .= '
					<body style="margin: 0; padding: 0;">
						<table border="0" cellpadding="0" cellspacing="0" width="100%">
							<tr>
								<td>

									<!-- Header Top Start -->
									<table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse;">
										<tr>
											<td>
												<table align="center" border="0" cellpadding="0" cellspacing="0" width="580" style="border-collapse: collapse;">
													<tr>
														<td align="left"  bgcolor="#332d35">
															<!-- Space -->
															<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
																<tr><td style="font-size: 0; line-height: 0;" height="10">&nbsp;</td></tr>
															</table>
															<table align="center">
																<tr>
																	<td width="33"></td>
																	<td width="22">
																		<img src="https://healthsupplementsplus.com/services/images/phone-icon-white.png" alt="location" />
																	</td>
																	<td style="color: #fff; font-size: 12px; line-height: 18px; font-weight: normal; font-family: helvetica, Arial, sans-serif;"><font color="white">+1(403)401-5701</font></td>
																	<td width="33"></td>
																	<td width="22">
																		<img src="https://healthsupplementsplus.com/services/images/mail-icon-white.png" alt="location" />
																	</td>
																	<td>
																		<a style="color: #fff; font-size: 12px; line-height: 18px; font-weight: normal; font-family: helvetica, Arial, sans-serif; text-decoration:none;" href="mailto:admin@healthsupplementsplus.com">admin@healthsupplementsplus.com</a>
																	</td>
																</tr>
															</table>
															<!-- Space -->
															<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
																<tr><td style="font-size: 0; line-height: 0;" height="10">&nbsp;</td></tr>
															</table>
														</td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
									<!-- Header Top End -->

									<!-- Header Start -->
									<table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse;">
										<tr>
											<td style="padding:15px 0 0 0;">
												<table align="center" border="0" cellpadding="0" cellspacing="0" width="580" style="border-collapse: collapse;">
													<tr>
														<td>
															<table align="left" border="0" cellpadding="0" cellspacing="0" width="200" style="border-collapse: collapse;">
																<!-- logo -->
																<tr>
																	<td align="left">
																		<a href="https://healthsupplementsplus.com">
																			<img src="https://healthsupplementsplus.com/services/images/logo_purple.png" alt="HSP" style="display: block;"/>
																		</a>
																	</td>
																</tr>
																<!-- company slogan -->
																<tr>
																	<td width="100%" align="left" style="font-size: 12px; line-height: 18px; font-family:helvetica, Arial, sans-serif; color:#999999;">	
																		Health Supplements Plus
																	</td>
																</tr>									
																<!-- Space -->
																<tr><td style="font-size: 0; line-height: 0;" height="15">&nbsp;</td></tr>
															</table>
														</td>
													</tr>
												</table>
											</td>
										</tr>
									</table>

									<!-- Section End -->

									<!-- Banner Start -->
									<table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse;">
										<tr>
											<td>
												<table align="center" border="0" cellpadding="0" cellspacing="0" width="580" style="border-collapse: collapse;">
													<tr>
														<td>
															<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
																<tr>
																	<td>
																		<!-- Space -->
																		<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
																			<tr><td style="font-size: 0; line-height: 0;" height="20">&nbsp;</td></tr>
																		</table>
																		<table align="center" border="0" cellpadding="0" cellspacing="0" width="540" style="border-collapse: collapse;">
																			<tr>
																				<td>
																					<table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
																						<tr>
																							<td width="100%" align="left" style="font-size: 28px; line-height: 34px; font-family:helvetica, Arial, sans-serif; color:#343434;">
																								您的订单已完成
																							</td>
																						</tr>
																					</table>
																					<table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
																						<!-- Space -->
																						<tr><td style="font-size: 0; line-height: 0;" height="10">&nbsp;</td></tr>
																						<tr>
																							<td width="100%" align="left" style="font-size: 15px; line-height: 22px; font-family:helvetica, Arial, sans-serif; color:#777777;">
																								<p>您好 '.$bname.'!</p>
																								我们已收到 $'.number_format($total,2).'(USD) 
																								<p>$'.number_format($total,2).'(USD) 已扣除您的贝宝账户 <br/>邮递到:<br/>'.$address.'</p>
																								<p>Your invoice number is '.$invoice.'. <br/>请的路您的<a href="https://healthsupplementsplus.com/myaccount.php">帐户</a>去查看您的订单</p>
																								<p请稍候2至3个工作日发货。</p>
																								<p>谢谢您的合作，<br/>Health Supplements Plus</p>
																								
																							</td>
																						</tr>
																					</table>
																				</td>
																			</tr>
																		</table>
																		<!-- Space -->
																		<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
																			<tr><td style="font-size: 0; line-height: 0;" height="30">&nbsp;</td></tr>				
																		</table>
																	</td>
																</tr>
															</table>
														</td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
									<!-- Banner End -->
									<!-- Subfooter Start -->
									<table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse;">
										<tr>
											<td>
												<table bgcolor="#f5f5f5" align="center" border="0" cellpadding="0" cellspacing="0" width="580" style="border-collapse: collapse;">
													<tr>
														<td>
															<!-- Space -->
															<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
																<tr><td style="font-size: 0; line-height: 0;" bgcolor="#eaeaea" height="1">&nbsp;</td></tr>
																<tr><td style="font-size: 0; line-height: 0;" height="20">&nbsp;</td></tr>
															</table>
															<table align="center" border="0" cellpadding="0" cellspacing="0" width="540" style="border-collapse: collapse;">
																<tr>
																	<td align="center" style="color: #999999; font-size: 14px; line-height: 18px; font-weight: normal; font-family: helvetica, Arial, sans-serif;">
																		Copyright © 2016 Health Supplements Plus
																	</td>
																</tr>
															</table>
															<!-- Space -->
															<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
																<tr><td style="font-size: 0; line-height: 0;" height="20">&nbsp;</td></tr>
															</table>
														</td>
													</tr>
												</table>
											</td>
										</tr>

									</table>
									<!-- Subfooter End -->
							

								</td>
							</tr>
						</table>
					</body>
				</html>';
			
			$mail = new PHPMailer(); // create a new object
			//$mail->IsSMTP(); // enable SMTP
			//$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
			//$mail->SMTPAuth = true; // authentication enabled
			//$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
			$mail->Host = "mail.healthsupplementsplus.com";
			$mail->Port = 465; // or 587
			$mail->IsHTML(true);
			$mail->CharSet="UTF-8";
			$mail->Username = "healt495";
			$mail->Password = "Jian2001";
			$mail->SetFrom("admin@healthsupplementsplus.com", "Health Supplements Plus");
			$mail->Subject = "您的订单已完成";
			$mail->Body = $message;
			$mail->AddAddress("$account_email");			
			
				 if(!$mail->Send()) {
					//echo "Mailer Error: " . $mail->ErrorInfo;
				 } else {
					//echo "Message has been sent";
				 }				

				 
				 
				 
				 
				 
				 
			require_once ("services/phpmailer/class.phpmailer.php");//obtain mailer classes

			$message = '
					<body style="margin: 0; padding: 0;">
						<table border="0" cellpadding="0" cellspacing="0" width="100%">
							<tr>
								<td>

									<!-- Header Top Start -->
									<table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse;">
										<tr>
											<td>
												<table align="center" border="0" cellpadding="0" cellspacing="0" width="580" style="border-collapse: collapse;">
													<tr>
														<td align="left"  bgcolor="#332d35">
															<!-- Space -->
															<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
																<tr><td style="font-size: 0; line-height: 0;" height="10">&nbsp;</td></tr>
															</table>
															<table align="center">
																<tr>
																	<td width="33"></td>
																	<td width="22">
																		<img src="https://healthsupplementsplus.com/services/images/phone-icon-white.png" alt="location" />
																	</td>
																	<td style="color: #fff; font-size: 12px; line-height: 18px; font-weight: normal; font-family: helvetica, Arial, sans-serif;"><font color="white">+1(403)401-5701</font></td>
																	<td width="33"></td>
																	<td width="22">
																		<img src="https://healthsupplementsplus.com/services/images/mail-icon-white.png" alt="location" />
																	</td>
																	<td>
																		<a style="color: #fff; font-size: 12px; line-height: 18px; font-weight: normal; font-family: helvetica, Arial, sans-serif; text-decoration:none;" href="mailto:admin@healthsupplementsplus.com">admin@healthsupplementsplus.com</a>
																	</td>
																</tr>
															</table>
															<!-- Space -->
															<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
																<tr><td style="font-size: 0; line-height: 0;" height="10">&nbsp;</td></tr>
															</table>
														</td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
									<!-- Header Top End -->

									<!-- Header Start -->
									<table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse;">
										<tr>
											<td style="padding:15px 0 0 0;">
												<table align="center" border="0" cellpadding="0" cellspacing="0" width="580" style="border-collapse: collapse;">
													<tr>
														<td>
															<table align="left" border="0" cellpadding="0" cellspacing="0" width="200" style="border-collapse: collapse;">
																<!-- logo -->
																<tr>
																	<td align="left">
																		<a href="https://healthsupplementsplus.com">
																			<img src="https://healthsupplementsplus.com/services/images/logo_purple.png" alt="HSP" style="display: block;"/>
																		</a>
																	</td>
																</tr>
																<!-- company slogan -->
																<tr>
																	<td width="100%" align="left" style="font-size: 12px; line-height: 18px; font-family:helvetica, Arial, sans-serif; color:#999999;">	
																		Health Supplements Plus
																	</td>
																</tr>									
																<!-- Space -->
																<tr><td style="font-size: 0; line-height: 0;" height="15">&nbsp;</td></tr>
															</table>
														</td>
													</tr>
												</table>
											</td>
										</tr>
									</table>

									<!-- Section End -->

									<!-- Banner Start -->
									<table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse;">
										<tr>
											<td>
												<table align="center" border="0" cellpadding="0" cellspacing="0" width="580" style="border-collapse: collapse;">
													<tr>
														<td>
															<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
																<tr>
																	<td>
																		<!-- Space -->
																		<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
																			<tr><td style="font-size: 0; line-height: 0;" height="20">&nbsp;</td></tr>
																		</table>
																		<table align="center" border="0" cellpadding="0" cellspacing="0" width="540" style="border-collapse: collapse;">
																			<tr>
																				<td>
																					<table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
																						<tr>
																							<td width="100%" align="left" style="font-size: 28px; line-height: 34px; font-family:helvetica, Arial, sans-serif; color:#343434;">
																								You have received a new order!
																							</td>
																						</tr>
																					</table>
																					<table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
																						<!-- Space -->
																						<tr><td style="font-size: 0; line-height: 0;" height="10">&nbsp;</td></tr>
																						<tr>
																							<td width="100%" align="left" style="font-size: 15px; line-height: 22px; font-family:helvetica, Arial, sans-serif; color:#777777;">
																								<p>A total of $'.number_format($total,2).'(USD) has been collected to your PayPal account.<br/>Ship to:'.$address.'</p>
																								<p>Please login to Admin Panel to Proccess this order</p>
																								
																							</td>
																						</tr>
																					</table>
																				</td>
																			</tr>
																		</table>
																		<!-- Space -->
																		<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
																			<tr><td style="font-size: 0; line-height: 0;" height="30">&nbsp;</td></tr>				
																		</table>
																	</td>
																</tr>
															</table>
														</td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
									<!-- Banner End -->
									<!-- Subfooter Start -->
									<table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse;">
										<tr>
											<td>
												<table bgcolor="#f5f5f5" align="center" border="0" cellpadding="0" cellspacing="0" width="580" style="border-collapse: collapse;">
													<tr>
														<td>
															<!-- Space -->
															<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
																<tr><td style="font-size: 0; line-height: 0;" bgcolor="#eaeaea" height="1">&nbsp;</td></tr>
																<tr><td style="font-size: 0; line-height: 0;" height="20">&nbsp;</td></tr>
															</table>
															<table align="center" border="0" cellpadding="0" cellspacing="0" width="540" style="border-collapse: collapse;">
																<tr>
																	<td align="center" style="color: #999999; font-size: 14px; line-height: 18px; font-weight: normal; font-family: helvetica, Arial, sans-serif;">
																		Copyright © 2016 Health Supplements Plus. All Rights Reserved
																	</td>
																</tr>
															</table>
															<!-- Space -->
															<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
																<tr><td style="font-size: 0; line-height: 0;" height="20">&nbsp;</td></tr>
															</table>
														</td>
													</tr>
												</table>
											</td>
										</tr>

									</table>
									<!-- Subfooter End -->
								</td>
							</tr>
						</table>
					</body>
				</html>';
			
			$mail = new PHPMailer(); // create a new object
			//$mail->IsSMTP(); // enable SMTP
			//$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
			//$mail->SMTPAuth = true; // authentication enabled
			//$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
			$mail->Host = "mail.healthsupplementsplus.com";
			$mail->Port = 465; // or 587
			$mail->IsHTML(true);
			$mail->Username = "healt495";
			$mail->Password = "Jian2001";
			$mail->SetFrom("admin@healthsupplementsplus.com", "Health Supplements Plus");
			$mail->Subject = "New Order! Please Process!)";
			$mail->Body = $message;
			$mail->AddAddress("admin@healthsupplementsplus.com");			
			
				 if(!$mail->Send()) {
					//echo "Mailer Error: " . $mail->ErrorInfo;
				 } else {
					//echo "Message has been sent";
				 }						 
				 
				 
				 
				 
				 
				 
				 
        }
}
?>