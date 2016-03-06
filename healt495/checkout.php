<?include('inc/header.php');?>	
<?
if(empty($_SESSION['login_user']))
{
echo "<meta http-equiv=\"refresh\" content=\"0; url=index.php\">";

}
if(empty($_POST['total_amount']))
{
echo "<meta http-equiv=\"refresh\" content=\"0; url=mycart.php\">";

} else {
	

?>
<?
$user_id = $_SESSION['login_user'];
$user_email = mysqli_query($db, "SELECT * FROM customer WHERE id='$user_id'");
	$user_email = mysqli_fetch_assoc($user_email);
	$country = $user_email['country'];
	$user_email = $user_email['email'];
	
$cart_check = mysqli_query($db,"SELECT * FROM cart WHERE user='$user_email'");
$cart_exist = mysqli_num_rows($cart_check);


$MAX_LENGTH = 78;
$FLATRATE = 100;

?>

			<!-- main-container start -->
			<!-- ================ -->
			<section class="main-container">

				<div class="container">
					<div class="row">

						<!-- main start -->
						<!-- ================ -->
						<div class="main col-md-12">

							<!-- page-title start -->
							<!-- ================ -->
							<h1 class="page-title">Checkout</h1>
							<div class="separator-2"></div>
							<!-- page-title end -->

							<table class="table cart">
								<thead>
									<tr>
										<th>Product </th>
										<th>Price </th>
										<th>Quantity</th>
										<th class="amount">Total </th>
									</tr>
								</thead>
								<tbody>
											<?
												while ($cart_result = mysqli_fetch_assoc($cart_check)) {
													$cart_product_id = $cart_result['product_id'];
													$cart_product_amount = $cart_result['amount'];
													$product_check = mysqli_query($db,"SELECT * FROM product WHERE id='$cart_product_id'");
													while ($product_result = mysqli_fetch_assoc($product_check)) {
														$product_id = $product_result['id'];
														$product_name = $product_result['name'];
														$product_detail = $product_result['detail'];
														$product_price = $product_result['price'];
														$product_picture = $product_result['picture'];
														$product_catagory = $product_result['catagory'];
														$product_stock = $product_result['instock'];
														$product_discount = $product_result['discount']; 
														$product_weight[] = $product_result['weight']*$cart_product_amount; 	
														$product_price_no_factor = $product_price;
														$product_price = $product_price * $currency;
														if (empty($product_picture)) {
															$picture = "admin/images/default-image.gif";
														} else {
															$picture = "admin/images/products/$product_picture";
														}
														
														$before_discount[] = number_format($product_price*$cart_product_amount,2);
														
														if (strlen($product_detail) > $MAX_LENGTH) {
															$product_detail = substr($product_detail, 0, $MAX_LENGTH);
															$product_detail = "$product_detail...";
														}	
														if ($product_discount == 0 or empty($product_discount)) {
															$product_price = $product_price;
														}else {
															$product_price = $product_price * (1-$product_discount);
														}
														
														$price_total[] = $product_price*$cart_product_amount;													
														$sub_total = $product_price*$cart_product_amount;
														$product_price_no_factor_total[] = $product_price*$cart_product_amount/$currency;
											?>								
								
														<tr class="remove-data">
													
															<td class="product">
															<div class="media-left pull-left">
																<div class="overlay-container">
																	<img class="media-object" src="<?echo $picture;?>" alt="<?echo $product_name;?>" height="67" width="50">
																</div>
															</div>														
															<p class="pull-right"><p><?echo $product_name;?></p> <small><?echo $product_detail;?></small></p>
															
															</td>
															<td class="price">
															<?
																if ($product_discount == 0 or empty($product_discount)) {?>
																	<?echo $symbol;?><?echo number_format($product_price,2);?>
															<?	}else { ?>
																	<a data-toggle="price" data-placement="bottom" title="Discounted Price"><?echo $symbol?><?echo number_format($product_price,2);?>*</a>
															<?	}																
															?>

															</td>
															<td class="quantity">
															<form class="remove_cart" name="remove_cart">
																<div class="form-group">
																	<input type="text" class="form-control" value="<?echo $cart_product_amount;?>" disabled>
																</div>	
															</form>	
															</td>
															

															<td class="amount"><?echo $symbol;?><?echo number_format($sub_total,2);?></td>
															
														</tr>
														
														
											<?		}
												}
												$weight_total = ceil(array_sum($product_weight));
												$shipping_sql = mysqli_query($db,"SELECT * FROM shipping WHERE weight = '$weight_total'");
												$shipping_row = mysqli_num_rows($shipping_sql);
												$shipping_price = mysqli_fetch_assoc($shipping_sql);
												$shipping_price = $shipping_price['standard'];
													if ($shipping_row == 0) {
														$shipping_price = $FLATRATE;
													} else {
														$shipping_price = $shipping_price;
													}	
												$shipping_price_insert = $shipping_price;
												$shipping_price = $shipping_price * $currency;	
												
												$no_factor_price = array_sum($product_price_no_factor_total);
												$sum_total = array_sum($price_total);
												
												$post_first = $_POST['total_amount'][0];

												
												if ($post_first == "$") {
													$previous_currency = "usd";
												} else {
													$previous_currency = "rmb";
												}
											
												if (!empty($discount_post)) {
													$discount_percentage = mysqli_query($db,"SELECT * FROM coupon WHERE code='$discount_post'");
													$discount_percentage = mysqli_fetch_assoc($discount_percentage);
													$discount_percentage = $discount_percentage['discount'];
													$check_sum = $sum_total/(1+$discount_percentage);
													$check_sum = ceil($check_sum / 10) * 10;
												}
												
/**												if ($currency_factor == "rmb" and $previous_currency == "usd") {
													$total_price_post = substr($_POST['total_amount'], 1);
													$total_price_post = str_replace(",", "",$total_price_post);
													$total_price_post = $total_price_post * $currency;
												}elseif ($currency_factor == "usd" and $previous_currency == "rmb") {
													$get_currency = mysqli_query($db,"SELECT * FROM currency_rate WHERE country = 'rmb'");
													$get_currency = mysqli_fetch_assoc($get_currency);
													$get_currency = $get_currency['currency'];
													$total_price_post = substr($_POST['total_amount'], 1);
													$total_price_post = substr($total_price_post, 1);
													$total_price_post = str_replace(",", "",$total_price_post);
													$total_price_post = $total_price_post / $get_currency;												
												}elseif ($currency_factor == "rmb" and $previous_currency == "rmb") {
													$total_price_post = substr($_POST['total_amount'], 1);
													$total_price_post = substr($total_price_post, 1);
													$total_price_post = str_replace(",", "",$total_price_post);													
												}else {
													$total_price_post = substr($_POST['total_amount'], 1);
													$total_price_post = str_replace(",", "",$total_price_post);													
												}
**/												




													//$discount_number = preg_replace('/[^0-9.,]/', '', $discount_post);
													$discount_number = mysqli_query($db,"SELECT * FROM ship_coup WHERE user='$user_email'");
													$discount_number = mysqli_fetch_assoc($discount_number);
													$discount_number = $discount_number['coupon'];
													$discount_number = mysqli_query($db,"SELECT * FROM coupon WHERE code='$discount_number'");
													$discount_number = mysqli_fetch_assoc($discount_number);
													$discount_percentage_num = $discount_number['discount'] *100;
													$discount_number = $discount_number['discount'] * $sum_total;
												
												if ($discount_number == 0) {
													$discount_number = "--";
												}
												
												$check_row_ship = mysqli_query($db,"SELECT * FROM ship_coup WHERE user='$user_email'");
												$check_row_ship = mysqli_num_rows($check_row_ship);
												
													if ($check_row_ship == 0) {
														$insert_sql = mysqli_query($db,"INSERT INTO ship_coup (shipping,user,subtotal,currency) VALUES ('$shipping_price_insert','$user_email','$no_factor_price','$currency_factor') ");			
													}else {
														$update_sql = mysqli_query($db,"UPDATE ship_coup SET shipping='$shipping_price_insert', subtotal='$no_factor_price', currency='$currency_factor' WHERE user='$user_email'");
													}
													
												$total_price_post = $sum_total - $discount_number;
											?>														

									<tr>
										<td class="total-quantity" colspan="3">Subtotal:</td>
										<td class="amount"><?echo $symbol;?><?echo number_format($sum_total,2);?></td>
									</tr>
									<?
									
										if ($discount_number!="--"){?>
											<tr>										
												<td class="total-quantity" colspan="3">You Saved:(<?echo $discount_percentage_num?>%)</td>
												<td class="amount" id="coupon_amount">-<? echo $symbol?><?echo number_format($discount_number,2);?></td>
											</tr>													
									<?	}
									
									?>
						
													
									<?
									
										if ($discount_number!="--"){?>
											<tr>
												<td class="total-quantity" colspan="3">After Discount:</td>
												<td class="amount"><?echo $symbol;?><?echo number_format($total_price_post,2);?></td>
											</tr>											
									<?	}
										
									?>				
													
													
									<!-- SHIPPING -->
									<tr>										
										<td class="total-quantity" colspan="1">Shipping Options:</td>
										<td class="shipping" colspan="2">
										<input type="hidden" id="weight" value="<?echo $weight_total;?>">
										<input type="hidden" id="shipping_price" value="<?echo $shipping_price;?>">
										<input type="hidden" id="price_before_shipping" value="<?echo $total_price_post;?>">
										<input type="hidden" id="checkout_final" value="<?echo $total_price_post+$shipping_price?>">
											<select class="form-control" id="shipping_option">
												<option value="standard">Standard Shipping</option>
												<option value="express">Express Shipping</option>
											</select>
										
										</td>
										<td class="amount" id="shipping_amount"><?echo $symbol;?><?echo number_format($shipping_price,2);?></td>
									</tr>
									<!-- /SHIPPING -->
									<tr>
										<td class="total-quantity" colspan="3">Price (Total):</td>
										<td class="total-amount" id="total_final"><?echo $symbol?><?echo number_format($total_price_post+$shipping_price,2);?></td>
									</tr>
								</tbody>
							</table>
							<div class="space-bottom"></div>
							
							<?
								$personal_info_sql = mysqli_query($db,"SELECT * FROM customer WHERE email ='$user_email'");
									$personal_info = mysqli_fetch_assoc($personal_info_sql);
									$personal_fname = $personal_info['first_name'];
									$personal_lname = $personal_info['last_name'];
									$personal_email = $personal_info['email'];
									$personal_address = $personal_info['address'];
									$personal_postal_code = $personal_info['postal_code'];
									$personal_city = $personal_info['city'];
									$personal_country = $personal_info['country'];
									$personal_province = $personal_info['province'];
									
							?>
							
							<fieldset>
								<legend>Billing information</legend>
								<form role="form" class="form-horizontal" id="billing-information">
									<div class="row">
										<div class="col-lg-3">
											<h3 class="title">Personal Info</h3>
										</div>
										<div class="col-lg-8 col-lg-offset-1">
											<div class="form-group">
												<label for="billingFirstName" class="col-md-2 control-label">First Name<small class="text-default">*</small></label>
												<div class="col-md-10">
													<input type="text" class="form-control" id="billingFirstName" value="<?echo $personal_fname;?>">
												</div>
											</div>
											<div class="form-group">
												<label for="billingLastName" class="col-md-2 control-label">Last Name<small class="text-default">*</small></label>
												<div class="col-md-10">
													<input type="text" class="form-control" id="billingLastName" value="<?echo $personal_lname;?>">
												</div>
											</div>
											<div class="form-group">
												<label for="billingTel" class="col-md-2 control-label">Telephone<small class="text-default">*</small></label>
												<div class="col-md-10">
													<input type="text" class="form-control" id="billingTel" value="">
												</div>
											</div>
											<div class="form-group">
												<label for="billingFax" class="col-md-2 control-label">Fax</label>
												<div class="col-md-10">
													<input type="text" class="form-control" id="billingFax" value="">
												</div>
											</div>
											<div class="form-group">
												<label for="billingemail" class="col-md-2 control-label">Email<small class="text-default">*</small></label>
												<div class="col-md-10">
													<input type="email" class="form-control" id="billingemail" value="<?echo $personal_email;?>">
												</div>
											</div>
										</div>
									</div>
									<div class="space"></div>
									<div class="row">
										<div class="col-lg-3">
											<h3 class="title">Your Address</h3>
										</div>
										<div class="col-lg-8 col-lg-offset-1">
											<div class="form-group">
												<label for="billingAddress1" class="col-md-2 control-label">Address 1<small class="text-default">*</small></label>
												<div class="col-md-10">
													<input type="text" class="form-control" id="billingAddress1" value="<?echo $personal_address;?>">
												</div>
											</div>
											<div class="form-group">
												<label for="billingAddress2" class="col-md-2 control-label">Address 2</label>
												<div class="col-md-10">
													<input type="text" class="form-control" id="billingAddress2" value="">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-2 control-label">Country<small class="text-default">*</small></label>
												<div class="col-md-10">
													<input type="text" class="form-control" id="country_bill" value="<?echo $country;?>">
												</div>
											</div>
											<div class="form-group">
												<label for="billingCity" class="col-md-2 control-label">City<small class="text-default">*</small></label>
												<div class="col-md-10">
													<input type="text" class="form-control" id="billingCity" value="<?echo $personal_city;?>">
												</div>
											</div>
											<div class="form-group">
												<label for="billingProvince" class="col-md-2 control-label">State/Province<small class="text-default">*</small></label>
												<div class="col-md-10">
													<input type="text" class="form-control" id="billingProvince" value="<?echo $personal_province;?>">
												</div>
											</div>											
											<div class="form-group">
												<label for="billingPostalCode" class="col-md-2 control-label">Zip Code<small class="text-default">*</small></label>
												<div class="col-md-10">
													<input type="text" class="form-control" id="billingPostalCode" value="<?echo $personal_postal_code;?>">
												</div>
											</div>
										</div>
									</div>
									<div class="space"></div>
									<div class="row">
										<div class="col-lg-3">
											<h3 class="title">Additional Info</h3>
										</div>
										<div class="col-lg-8 col-lg-offset-1">
											<div class="form-group">
												<div class="col-md-12">
													<textarea id="billing_comment" class="form-control" rows="4"></textarea>
												</div>
											</div>
										</div>
									</div>
								</form>
							</fieldset>
							<fieldset>
								<legend>Shipping information</legend>
								<form role="form" class="form-horizontal" id="shipping-information-container">
									<div id="shipping-information" class="space-bottom">
										<div class="row">
											<div class="col-lg-3">
												<h3 class="title">Personal Info</h3>
											</div>
											<div class="col-lg-8 col-lg-offset-1">
												<div class="form-group">
													<label for="shippingFirstName" class="col-md-2 control-label">First Name<small class="text-default">*</small></label>
													<div class="col-md-10">
														<input type="text" class="form-control" id="shippingFirstName" value="<?echo $personal_fname;?>">
													</div>
												</div>
												<div class="form-group">
													<label for="shippingLastName" class="col-md-2 control-label">Last Name<small class="text-default">*</small></label>
													<div class="col-md-10">
														<input type="text" class="form-control" id="shippingLastName" value="<?echo $personal_lname;?>">
													</div>
												</div>
												<div class="form-group">
													<label for="shippingTel" class="col-md-2 control-label">Telephone<small class="text-default">*</small></label>
													<div class="col-md-10">
														<input type="text" class="form-control" id="shippingTel" value="">
													</div>
												</div>
												<div class="form-group">
													<label for="shippingFax" class="col-md-2 control-label">Fax</label>
													<div class="col-md-10">
														<input type="text" class="form-control" id="shippingFax" value="">
													</div>
												</div>
												<div class="form-group">
													<label for="shippingemail" class="col-md-2 control-label">Email<small class="text-default">*</small></label>
													<div class="col-md-10">
														<input type="email" class="form-control" id="shippingemail" value="<?echo $personal_email;?>">
													</div>
												</div>
											</div>
										</div>
										<div class="space"></div>
										<div class="row">
											<div class="col-lg-3">
												<h3 class="title">Your Address</h3>
											</div>
											<div class="col-lg-8 col-lg-offset-1">
												<div class="form-group">
													<label for="shippingAddress1" class="col-md-2 control-label">Address 1<small class="text-default">*</small></label>
													<div class="col-md-10">
														<input type="text" class="form-control" id="shippingAddress1" value="<?echo $personal_address;?>">
													</div>
												</div>
												<div class="form-group">
													<label for="shippingAddress2" class="col-md-2 control-label">Address 2</label>
													<div class="col-md-10">
														<input type="text" class="form-control" id="shippingAddress2" value="">
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-2 control-label">Country<small class="text-default">*</small></label>
													<div class="col-md-10">
														<input type="text" class="form-control" id="country_ship" value="<?echo $country;?>">
													</div>
												</div>
												<div class="form-group">
													<label for="shippingCity" class="col-md-2 control-label">City<small class="text-default">*</small></label>
													<div class="col-md-10">
														<input type="text" class="form-control" id="shippingCity" value="<?echo $personal_city;?>">
													</div>
												</div>
												<div class="form-group">
													<label for="shippingProvince" class="col-md-2 control-label">State/Province<small class="text-default">*</small></label>
													<div class="col-md-10">
														<input type="text" class="form-control" id="shippingProvince" value="<?echo $personal_province;?>">
													</div>
												</div>												
												<div class="form-group">
													<label for="shippingPostalCode" class="col-md-2 control-label">Zip Code<small class="text-default">*</small></label>
													<div class="col-md-10">
														<input type="text" class="form-control" id="shippingPostalCode" value="<?echo $personal_postal_code;?>">
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="checkbox padding-top-clear">
										<label>
											<input type="checkbox" id="shipping-info-check" checked> My Shipping information is the same as my Billing information.
										</label>
									</div>
								</form>
							</fieldset>
							
							<div class="text-right">	
							<div id="review_form_error"></div>
								<a href="mycart.php" class="btn btn-group btn-default"><i class="icon-left-open-big"></i> Go Back To My Cart</a>
								<input type="submit" id="review_order" class="btn btn-group btn-default" value="Review/Payment Order">
							</div>

						</div>
						<!-- main end -->
						<form id="review_confirm_form" action="review.php" >
						  <input type="hidden" id="bfname" name="bfname"value="">
						  <input type="hidden" id="blname" name="blname"value="">
						  <input type="hidden" id="btel" name="btel"value="">
						  <input type="hidden" id="bfax" name="bfax"value="">
						  <input type="hidden" id="bemail" name="bemail"value="">
						  <input type="hidden" id="baddress1" name="baddress1"value="">
						  <input type="hidden" id="baddress2" name="baddress2"value="">
						  <input type="hidden" id="bcountry" name="bcountry"value="">
						  <input type="hidden" id="bcity" name="bcity"value="">
						  <input type="hidden" id="bpostal" name="bpostal"value="">
						  <input type="hidden" id="bcomment" name="bcomment"value="">
						  <input type="hidden" id="bprovince" name="bprovince"value="">
						  <input type="hidden" id="sfname" name="sfname"value="">
						  <input type="hidden" id="slname" name="slname"value="">
						  <input type="hidden" id="stel" name="stel"value="">
						  <input type="hidden" id="sfax" name="sfax"value="">
						  <input type="hidden" id="semail" name="semail"value="">
						  <input type="hidden" id="saddress1" name="saddress1"value="">
						  <input type="hidden" id="scountry" name="scountry"value="">
						  <input type="hidden" id="scity" name="scity"value="">
						  <input type="hidden" id="spostal" name="spostal"value="">
						  <input type="hidden" id="sprovince" name="sprovince"value="">
						  <input type="hidden" id="shipping_is_same" name="shipping_is_same"value="">
						</form>
					</div>
				</div>
			</section>
			<!-- main-container end -->
<?}?>
<?include("inc/footer.php");?>
<?include("inc/scripts.php");?>