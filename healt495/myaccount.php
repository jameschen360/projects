<?
include('inc/header.php');
if (empty($_SESSION['login_user'])) {
	echo "<meta http-equiv=\"refresh\" content=\"0; url=index.php\">";
} else {

$user_id = $_SESSION['login_user'];
	$customer_data = mysqli_query($db, "SELECT * FROM customer WHERE id='$user_id'");
	$customer_data = mysqli_fetch_assoc($customer_data);
		$fname = $customer_data['first_name'];
		$lname = $customer_data['last_name'];
		$email = $customer_data['email'];
		$address = $customer_data['address'];
		$postal_code = $customer_data['postal_code'];
		$city = $customer_data['city'];
		$country = $customer_data['country'];
		$province = $customer_data['province'];
		$currency = $customer_data['currency'];
		$phone = $customer_data['phone'];
$user_id = $_SESSION['login_user'];
$user_email = mysqli_query($db, "SELECT * FROM customer WHERE id='$user_id'");
	$user_email = mysqli_fetch_assoc($user_email);
	$regi = $user_email['zh'];
	$user_email = $user_email['email'];
?>

			<!-- breadcrumb start -->
			<!-- ================ -->
			<div class="breadcrumb-container">
				<div class="container">
					<ol class="breadcrumb">
						<li><i class="fa fa-home pr-10"></i><a href="index.php">Home</a></li>
						<li class="active">My Account</li>
					</ol>
				</div>
			</div>
			<!-- breadcrumb end -->

			<!-- main-container start -->
			<!-- ================ -->
			<section class="main-container">

				<div class="container">
					<div class="row">

						<!-- main start -->
						<!-- ================ -->



	
						<div id="account" class="main col-md-8 col-lg-offset-1 col-md-push-4 col-lg-push-3">

							<!-- page-title start -->
							<!-- ================ -->
							<h1 class="page-title">Account/Billing Settings</h1>
							<div class="separator-2"></div>
							
									<form class="contact" name="contact">
									 <input type="hidden" name="user_id" value="<?echo $user_id?>">
									 <div class="row">
									<div id="account_errmsg" class="pull-left"></div>
									 </div>
									  <div class="row">
									  <div class="form-group col-lg-6 javaremove" style="padding:5px;">
										<label for="fname" class="control-label">First Name:</label>
										<input type="text" class="form-control" id="fname" name="fname" value="<?echo $fname?>" required>
									  </div>	
									  <div class="form-group col-lg-6 javaremove" style="padding:5px;">
										<label for="lname" class="control-label">Last Name:</label>
										<input type="text" class="form-control" id="lname" name="lname" value="<?echo $lname?>">
									  </div>										  
									  </div>
									  <div class="row">
									  <div class="form-group col-lg-6 javaremove" style="padding:5px;">
										<label for="email" class="control-label" id="javaemail">Email:</label>
										<input type="text" class="form-control" id="email" name="email" value="<?echo $email?>" disabled>
									  </div>
									  <div class="form-group col-lg-6 javaremove" style="padding:5px;">
										<label for="btel" class="control-label">Phone:</label>
										<input type="text" class="form-control" id="btel" name="btel" value="<?echo $phone?>">
									  </div>									  
									  </div>
									  <div class="row">
									  <div class="form-group col-lg-6 javaremove" style="padding:5px;">
										<label for="pwd1" class="control-label">Password:</label>
										<input type="password" class="form-control" id="pwd1" name="pwd1" placeholder="**********" value="">
									  </div>	
									  <div class="form-group col-lg-6 javaremove" style="padding:5px;">
										<label for="pwd2" class="control-label">Re-enter Password:</label>
										<input type="password" class="form-control" id="pwd2" name="pwd2" placeholder="**********" value="">
									  </div>										  
									  </div>	
									  <div class="row" style="padding:5px;">									  
									  <div class="form-group javaremove">
										<label for="address" class="control-label">Address:</label>
										<input type="text" class="form-control" id="address" name="address" value="<?echo $address?>">
									  </div>	
									  </div>								  
									  <div class="row">
									  <div class="form-group col-lg-6 javaremove" style="padding:5px;">
										<label for="postal" class="control-label">Postal Code:</label>
										<input type="text" class="form-control" id="postal" name="postal" value="<?echo $postal_code?>">
									  </div>	
									  <div class="form-group col-lg-6 javaremove" style="padding:5px;">
										<label for="city" class="control-label">City:</label>
										<input type="text" class="form-control" id="city" name="city" value="<?echo $city?>">
									  </div>										  
									  </div>
									  <div class="row">
									  <div class="form-group col-lg-6 javaremove" style="padding:5px;" >
									  
										<label for="country" class="control-label">Country:</label>
										<select class="form-control" id="country" name="country">
													<?
													$country_sql = mysqli_query($db,"SELECT * FROM countries");
														while ($countries = mysqli_fetch_assoc($country_sql)) {
															$country_name = $countries['country_name']; 	
															
															if ($regi == "yes") {
																$country_name = $countries['cninfo']; 
															}else {
																$country_name = $countries['country_name']; 
															}

															
															if ($country == $country_name) {?>
																<option value="<?echo $country_name?>" selected><?echo $country_name?></option>
														<?	} else {?>
																<option value="<?echo $country_name?>"><?echo $country_name?></option>																
														<?}?>
													
													<?	}
													?>
										</select>
										
									  </div>	
									  <div class="form-group col-lg-6 javaremove" style="padding:5px;">
										<label for="province" class="control-label">State/Province:</label>
										<input type="text" class="form-control" id="province" name="province" value="<?echo $province?>">
									  </div>										  
									  </div>									  
									</form>
								
								<button id="update_customer" class="btn btn-danger pull-right" style="padding:5px;">Update Profile</button>
							<!-- page-title end -->
						</div>								
						
						
						<div id="order" class="main col-md-8 col-lg-offset-1 col-md-push-4 col-lg-push-3">

							<!-- page-title start -->
							<!-- ================ -->
							<h1 class="page-title">My Orders</h1>
							<a href="#" data-toggle="modal" data-target="#order_status">What does the statuses mean?</a>
							<div class="separator-2"></div>
<?


											//get rows query
											$query = mysqli_query($db, "SELECT * FROM order_id WHERE user='$user_email'");
											
											//number of rows
											$rowCount = mysqli_num_rows($query);
											if ($rowCount == 0) {
												echo "You do not have any orders!";
											} else {   ?>
													<div class="dataTable_wrapper">
													<table class="table table-striped table-bordered table-hover" id="order_table">
														<thead>
															<tr>
																<th>Invoice #</th>
																<th>Total</th>
																<th>Status</th>
															</tr>
														</thead>
														<tbody>

															<?php
																//get rows query
																$query = mysqli_query($db, "SELECT * FROM order_id WHERE user='$user_email'");
																
																//number of rows
																$rowCount = mysqli_num_rows($query);
																
																if($rowCount > 0){ 
																	while($row = mysqli_fetch_assoc($query)){ 
																		$invoice = 	$row['invoice'];
																		$total = 	$row['total'];
																		$status = 	$row['status'];
																		$currency = $row['currency_rate'];
																	if ($currency != 1) {
																		$symbol = "¥";	
																	}else {
																		$symbol = "$";
																	}

																?>
																			<tr>
																				<td><?echo $invoice;?></td>
																				<td><?echo $symbol?><?echo number_format($total* $currency,2);?></td>
																				<td><?echo $status;?>


																				<input type="submit" id="<?echo $invoice;?>" class="btn btn-sm btn-default order_invoice" style="margin-left:5px;" value="Details">
																				
																				
																				
																				</td>

																			</tr>																	
															<?php }

																}?>                                        
														</tbody>									
													</table>
												  
												</div>
												<!-- page-title end -->												
<?											}
?>							
							

						</div>
	
					<div class="modal fade modal_login_style" id="order_status" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					  <div class="modal-content modal-dialog modal-sm">
						  <div class="modal-header">
							  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
							  <h4 class="modal-title" id="modalla">Order Status</h4>
						  </div>
						  
						  <div class="modal-body">
								<p><strong>Pending:</strong> Your order is being processed. The payment has not yet been approved.</p>
								<p><strong>Completed:</strong> We are currently getting your order ready. Payment has been approved.</p>
								<p><strong>Shipped: </strong>Your order has been shipped and it is on its way!</p>
						  </div>
						  
					  </div>
					</div>
				
						<!-- main end -->

						<!-- sidebar start -->
						<!-- ================ -->
						<aside class="col-md-4 col-lg-3 col-md-pull-8 col-lg-pull-9">
							<div class="sidebar">
								<div class="block clearfix">
									<h3 class="title">Menu</h3>
									<div class="separator-2"></div>
									<nav>
										<ul class="nav nav-pills nav-stacked">
											<li class="active"><button id="account_tab" class="btn btn-outline">Account/Billing Settings</button></li>
											<li><button id="order_tab" class="btn btn-default">My Orders</button></li>
										</ul>
									</nav>
								</div>
							</div>
						</aside>
						<!-- sidebar end -->

					</div>
				</div>
			</section>
			<!-- main-container end -->
			
			
<?}?>
<?include("inc/footer.php");?>
<?include("inc/scripts.php");?>