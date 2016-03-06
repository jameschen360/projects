<?php
include('../inc/db.php');
//grab all post variables
$email = mysqli_real_escape_string($db,strip_tags($_POST['email']));

$email_check = mysqli_query($db, "SELECT id FROM customer WHERE email='$email'");
$row = mysqli_num_rows($email_check);

$sql = mysqli_query($db, "SELECT * FROM customer WHERE email='$email'");

	while($result = mysqli_fetch_assoc($sql)){ 
		$fname = 	$result['first_name'];
		$lname = 	$result['last_name'];
		$password = 	$result['pwd'];
	}

if (isset($_POST['email'])) {

if ($email!="" && $row == 1) {
			$rand = substr(uniqid('', true), -7);
			$md5_rand=md5($rand);
			$sql = mysqli_query($db, "UPDATE customer SET pwd='$md5_rand' WHERE email='$email'");
			
			require_once ("phpmailer/class.phpmailer.php");//obtain mailer classes

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
																		<a href="https://healthsupplementsplus.com/zh">
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
																								密码请求
																							</td>
																						</tr>
																					</table>
																					<table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
																						<!-- Space -->
																						<tr><td style="font-size: 0; line-height: 0;" height="10">&nbsp;</td></tr>
																						<tr>
																							<td width="100%" align="left" style="font-size: 15px; line-height: 22px; font-family:helvetica, Arial, sans-serif; color:#777777;">
																								<p>您好!</p>
																								<p>请用下面的密码登录您的帐户然后马上更新一个新的密码在<a href="https://www.healthsupplementsplus.com/zh/myaccount.php">“我的账户”</a>里!</p>
																								<p>您的新密码是 <b>'.$rand.'</b></p>
																								<br/>
																								<p>谢谢您的合作<br/>Health Supplements Plus</p>
																								
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
																		Copyright © 2016 Health Supplements Plus.
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
			$mail->Subject = "密码请求";
			$mail->Body = $message;
			$mail->AddAddress("$email");			
			
				 if(!$mail->Send()) {
					//echo "Mailer Error: " . $mail->ErrorInfo;
				 } else {
					//echo "Message has been sent";
				 }
				 
			echo "<center><p style=\"font-size:15px;\"><font color=\"green\"><strong>新密码已发送到您注册的电子信箱里</strong></font></p></center>";
		} else {
			echo "<center><p style=\"color:red;\" >对不起，您输入的电子信箱不正确！</p></center>";
	}
}




?>