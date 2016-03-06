<?
include('inc/db.php');
$user_id = $_SESSION['login_user'];
$user_email = mysqli_query($db, "SELECT * FROM customer WHERE id='$user_id'");
	$user_email = mysqli_fetch_assoc($user_email);
	$zh = $user_email['zh'];
	$first_name = $user_email['first_name'];
	$last_name = $user_email['last_name'];
	$user_email = $user_email['email'];
mysqli_query($db, "DELETE FROM ship_coup WHERE user='$user_email'");
mysqli_query($db, "DELETE FROM cart WHERE user='$user_email'");
include('inc/header.php');
if(empty($_POST['stripeToken']))
{
echo "<meta http-equiv=\"refresh\" content=\"0; url=index.php\">";

} else {


?>
			<!-- main-container start -->
			<!-- ================ -->
			<section class="main-container">

				<div class="container">
					<div class="row">

						<!-- main start -->
						<!-- ================ -->
						<div class="main col-md-8 col-md-offset-2">

							<!-- page-title start -->
							<!-- ================ -->
							
							<?


							try {
							//var_dump($_POST);
								require_once('Stripe/lib/Stripe.php');
								Stripe::setApiKey("sk_test_NeofeRKVohFpuy5NxnJQVRhO");

								
								if ($_POST['stripeToken'][0]== "a") {
									$currency_code = "CNY";
									$input_total = round($_POST['inputTotal'] * $_POST['inputCurrency'] * 100);
								} else {
									$currency_code = "USD";
									$input_total = round($_POST['inputTotal'] * 100);
								}
								
								$charge = Stripe_Charge::create(array(
							  "amount" => $input_total,
							  "currency" => $currency_code,
							  "card" => $_POST['stripeToken'],
							  "description" => "Health Supplements Products"
							));?>
							<h1 class="page-title text-center">Payment Complete. Thank You <i class="fa fa-smile-o pl-10"></i></h1>
							<div class="separator"></div>
							<!-- page-title end -->
							<p class="lead text-center">You can check the status of your order and details in your <a href="myaccount.php">account order</a> page</p>
							
							<?
								if($_POST['inputCurrencyFactor'] == "rmb") {
									$symbol = "¥";
									$total = $_POST['inputTotal'] * $_POST['inputCurrency'];
								}else {
									$symbol = "$";
									$total = $_POST['inputTotal'];
								}
								if ($_POST['inputSameShipping'] == "true") { 
									$message = "Billing/Shipping Information";
								}else {
									$message = "Billing Information";
								}
								if ($zh == "yes") {
									$bname = "$last_name$first_name";
								}else {
									$bname = $_POST['inputBillingName'];
								}									
							?>
									<table class="table">
										<thead>
											<tr>
												<th colspan="2"><?echo $message;?> </th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>Full Name</td>
												<td class="information"><?echo $_POST['inputBillingName'];?> </td>
											</tr>
											<tr>
												<td>Email</td>
												<td class="information"><?echo $_POST['inputBillingEmail'];?> </td>
											</tr>
											<tr>
												<td>Telephone</td>
												<td class="information"><?echo $_POST['inputBillingPhone'];?></td>
											</tr>
											<tr>
												<td>Address</td>
												<td class="information"><?echo$_POST['inputBillingAddress'];?></td>
											</tr>
											<tr>
												<td>Additional Info</td>
												<td class="information"><?echo $_POST['inputComment'];?></td>
											</tr>
											<tr>
												<td>Total</td>
												<td class="information"><?echo $symbol;?><?echo number_format($total,2)?></td>
											</tr>											
										</tbody>
									</table>	
									<div class="space-bottom"></div>
									
									<?
									
										if ($_POST['inputSameShipping'] != "true") {?>
											<table class="table">
												<thead>
													<tr>
														<th colspan="2">Shipping Information </th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>Full Name</td>
														<td class="information"><?echo $_POST['inputShippingName'];?> </td>
													</tr>
													<tr>
														<td>Email</td>
														<td class="information"><?echo $_POST['inputShippingEmail'];?> </td>
													</tr>
													<tr>
														<td>Telephone</td>
														<td class="information"><?echo $_POST['inputShippingPhone'];?></td>
													</tr>
													<tr>
														<td>Address</td>
														<td class="information"><?echo $_POST['inputShippingAddress'];?></td>
													</tr>
												</tbody>
											</table>																
									<?	}
									
									?>
							<p>Please allow 2-3 business days for your order to be shipped!</p>									
			

												
							<?
							$user_id = $_POST['useremail'];
							$product = $_POST['productlist'];
							$bname = $_POST['inputBillingName'];
							$sname = $_POST['inputShippingName'];
							$bemail = $_POST['inputBillingEmail'];
							$semail = $_POST['inputShippingEmail'];	
							$shipping_price = $_POST['inputShippingAmount'];
							$coupon = $_POST['inputCoupon'];
							$baddress = $_POST['inputBillingAddress'];
							$saddress = $_POST['inputShippingAddress'];
							$comment = $_POST['inputComment'];
							$btel = $_POST['inputBillingPhone'];
							$stel = $_POST['inputShippingPhone'];
							$subtotal = $_POST['inputSubtotal'];
							$total_price = $_POST['inputTotal'];
							$currency_code = $_POST['inputCurrencyFactor'];
							$currency_rate = $_POST['inputCurrency'];
							$is_same_shipping = $_POST['inputSameShipping'];
							$amount = $_POST['productamount'];
							$token = $_POST['stripeToken'];						
							$today = date("Y-m-d H:i:s");
							$status = "completed";

							if ($is_same_shipping == "true") {
								$address = $baddress;
							}else {
								$address = $saddress;
							}
							
							if ($currency_code == "rmb") {
								$symbol = "¥";
								$trail = "CNY (RMB)";

							}else {
								$symbol = "$";
								$trail = "USD";
							}
								if ($zh == "yes") {
									$bname = "$last_name$first_name";
								}else {
									$bname = $_POST['inputBillingName'];
								}								
							srand((double)microtime()*10000); 

							function gen_id() 
							{ 
								$id = 'A'; 

								for ($i=1; $i<=12; $i++) { 
									if (rand(0,1)) { 
										// letter 
										$id .= chr(rand(65, 90)); 
									} else { 
										// number; 
										$id .= rand(0, 9); 
									} 
								} 
								return $id; 

							} 

							$invoice = gen_id(); ?>

							<p class="text-center">
								<a href="order.php?order_id=<?echo $invoice?>" class="btn btn-default btn-lg">View Order <?echo $invoice?></a>	
							</p>	
							
							<?
							$check = mysqli_query($db, "INSERT INTO `order_id` (user,product,bname,sname,bemail,semail,shipping_price,coupon,baddress,saddress,comment,btel,stel,subtotal,total,currency_code,is_same_shipping,token,date_created,invoice,status,currency_rate,amount) VALUES ('$user_id','$product','$bname','$sname','$bemail','$semail','$shipping_price','$coupon','$baddress','$saddress','$comment','$btel','$stel','$subtotal','$total_price','$currency_code','$is_same_shipping','$token','$today','$invoice','Completed','$currency_rate','$amount')");

							
							
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
																								Order payment has been completed
																							</td>
																						</tr>
																					</table>
																					<table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
																						<!-- Space -->
																						<tr><td style="font-size: 0; line-height: 0;" height="10">&nbsp;</td></tr>
																						<tr>
																							<td width="100%" align="left" style="font-size: 15px; line-height: 22px; font-family:helvetica, Arial, sans-serif; color:#777777;">
																								<p>Hi '.$bname.'!</p>
																								<p>A total of '.$symbol.''.number_format($total,2).' '.$trail.' has been charged to your credit card account and will be shipped to:<br/>'.$address.'</p>
																								<p>Your invoice number is '.$invoice.'. <br/>Please login to your <a href="https://healthsupplementsplus.com/myaccount.php">account</a> for a detailed overall of your order!</p>
																								<pThe order that you have placed will be shipped within 2 to 3 business days.</p>
																								<p>Sincerely,<br/>Health Supplements Plus</p>
																								
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
			$mail->Subject = "Thank you for your order! (Completed)";
			$mail->Body = $message;
			$mail->AddAddress("$bemail");			
			
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
																								<p>A total of '.$symbol.''.number_format($total,2).''.$trail.' has been collected to your Stripe Account.<br/>Ship to:'.$address.'</p>
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
			$mail->CharSet="UTF-8";
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




							
							
							
							?>

							
							<?}

							catch(Stripe_CardError $e) {
								
							}

							//catch the errors in any way you like

							 catch (Stripe_InvalidRequestError $e) {?>
							 
							<h1 class="page-title text-center">Invalid Parameters. Please try again later! <i class="fa fa-frown-o pl-10"></i></h1>
							<div class="separator"></div>
							<!-- page-title end -->
							<p class="lead text-center">If you are having trouble checking out. Please contact us at admin@healthsupplements.com</p>

							<?} catch (Stripe_AuthenticationError $e) {
							  // Authentication with Stripe's API failed
							  // (maybe you changed API keys recently)?>
							  
							<h1 class="page-title text-center">Authentication With Stripe Server Failed <i class="fa fa-frown-o pl-10"></i></h1>
							<div class="separator"></div>
							<!-- page-title end -->
							<p class="lead text-center">If you are having trouble checking out. Please contact us at admin@healthsupplements.com</p>							  

								
							<?} catch (Stripe_ApiConnectionError $e) {
							  // Network communication with Stripe failed?>
							  
							<h1 class="page-title text-center">Network Communication with Stripe Server Failed <i class="fa fa-frown-o pl-10"></i></h1>
							<div class="separator"></div>
							<!-- page-title end -->
							<p class="lead text-center">If you are having trouble checking out. Please contact us at admin@healthsupplements.com</p>								  
							  
							<?} catch (Stripe_Error $e) {?>
							
							<h1 class="page-title text-center">Ooops! Something went wrong! <i class="fa fa-frown-o pl-10"></i></h1>
							<div class="separator"></div>
							<!-- page-title end -->
							<p class="lead text-center">If you are having trouble checking out. Please contact us at admin@healthsupplements.com</p>	
							
							<?} catch (Exception $e) {?>
							<h1 class="page-title text-center">Something went wrong and we don't know what <i class="fa fa-frown-o pl-10"></i></h1>
							<div class="separator"></div>
							<!-- page-title end -->
							<p class="lead text-center">If you are having trouble checking out. Please contact us at admin@healthsupplements.com</p>	
							<?}
							?>							
											
							
						</div>
						<!-- main end -->

					</div>
				</div>
			</section>
			<!-- main-container end -->
<?}?>		
<?include("inc/footer.php");?>
<?include("inc/scripts.php");?>