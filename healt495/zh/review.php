<?include('inc/header.php');
if(empty($_SESSION['login_user']))
{
echo "<meta http-equiv=\"refresh\" content=\"0; url=index.php\">";

}
$check_e = mysqli_num_rows(mysqli_query($db,"SELECT * FROM ship_coup WHERE user='$user_email'"));
if ($check_e == 0) {
	echo "<meta http-equiv=\"refresh\" content=\"0; url=mycart.php\">";
}

if(empty ($_GET['baddress1']) and empty ($_GET['blname']) and empty ($_GET['bfname']) and empty ($_GET['bemail']) and empty ($_GET['bcountry']) and empty ($_GET['bpostal']))
{
	echo "<meta http-equiv=\"refresh\" content=\"0; url=mycart.php\">";

}else {
	



?>

<?php

$blname = $_GET['blname'];
$bfname = $_GET['bfname'];
$btel = $_GET['btel'];
$bfax = $_GET['bfax'];
$bemail = $_GET['bemail'];
$baddress1 = $_GET['baddress1'];
$baddress2 = $_GET['baddress2'];
$bcountry = $_GET['bcountry'];
$bcity = $_GET['bcity'];
$bpostal = $_GET['bpostal'];
$bcomment = $_GET['bcomment'];
$sfname = $_GET['sfname'];
$slname = $_GET['slname'];
$stel = $_GET['stel'];
$sfax = $_GET['sfax'];
$semail = $_GET['semail'];
$saddress1 = $_GET['saddress1'];
$saddress2 = $_GET['saddress2'];
$scountry = $_GET['scountry'];
$scity = $_GET['scity'];
$spostal = $_GET['spostal'];
$shipping_is_same = $_GET['shipping_is_same'];
$bprovince = $_GET['bprovince'];
$sprovince = $_GET['sprovince'];

$price_sql = mysqli_query($db,"SELECT * FROM ship_coup WHERE user='$user_email'");
$price_sql = mysqli_fetch_assoc($price_sql);
	$shipping_cost = $price_sql['shipping'];
	$coupon = $price_sql['coupon'];
	$subtotal = $price_sql['subtotal'];
	$currency_factor = $price_sql['currency'];
	
$coupon_discount = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM coupon WHERE code='$coupon'"));
$coupon_discount = $coupon_discount['discount'];

$coupon_discount = $coupon_discount * $subtotal;

$currency_sql = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM currency_rate WHERE country='$currency_factor'"));
$currency = $currency_sql['currency'];

$total_price = $subtotal - $coupon_discount + $shipping_cost;
$total_price_paypal = $subtotal - $coupon_discount + $shipping_cost;
if ($coupon_discount == 0) {
	$string = "(邮递费已包括)";
}else {
	$string = "(邮递费和折扣券已包括)";
}
$bname = "$bfname $blname";
$sname = "$sfname $slname";
$baddress = "$baddress1 $baddress2 $bcity, $bprovince, $bcountry $bpostal";
$saddress = "$saddress1 $saddress2 $scity, $sprovince, $scountry $spostal";

mysqli_query($db,"UPDATE ship_coup SET bname='$bname',sname='$sname',total='$total_price',baddress='$baddress',saddress='$saddress',comments='$bcomment',bphone='$btel',sphone='$stel' WHERE user='$user_email'");

if ($currency_factor == "usd") {
	$symbol = "$";
}
else {
	$symbol = "¥";
}
?>

<??>
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
							<h1 class="page-title">最后一步！ <h6>支付宝只可在人民币付款方式来使用</h6></h1>
							<div class="separator-2"></div>
							<!-- page-title end -->
							<div class="space-bottom"></div>

							<?
								
								if ($shipping_is_same == "true") {?>
									<table class="table">
										<thead>
											<tr>
												<th colspan="2">账单/邮递信息 </th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>名字</td>
												<td class="information"><?echo "$bfname $blname";?> </td>
											</tr>
											<tr>
												<td>电子信箱</td>
												<td class="information"><?echo $bemail;?> </td>
											</tr>
											<tr>
												<td>电话</td>
												<td class="information"><?echo $btel;?></td>
											</tr>
											<tr>
												<td>地址</td>
												<td class="information"><?echo "$baddress1 $baddress2 $bcity, $bprovince, $bcountry $bpostal";?></td>
											</tr>
											<tr>
												<td>其他评论</td>
												<td class="information"><?echo $bcomment?></td>
											</tr>
											<tr>
												<td>总价</td>
												<td class="information"><?echo $symbol?><?echo number_format($total_price*$currency,2)?> <?echo $string;?></td>
											</tr>											
										</tbody>
									</table>									
							<?	} else {?>
									<table class="table">
										<thead>
											<tr>
												<th colspan="2">账单信息 </th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>名字</td>
												<td class="information"><?echo "$bfname $blname";?> </td>
											</tr>
											<tr>
												<td>电子信箱</td>
												<td class="information"><?echo $bemail;?> </td>
											</tr>
											<tr>
												<td>电话</td>
												<td class="information"><?echo $btel;?></td>
											</tr>
											<tr>
												<td>地址</td>
												<td class="information"><?echo "$baddress1 $baddress2 $bcity, $bprovince, $bcountry $bpostal";?></td>
											</tr>
											<tr>
												<td>其他评论</td>
												<td class="information"><?echo $bcomment?></td>
											</tr>
											<tr>
												<td>总价</td>
												<td class="information"><?echo $symbol?><?echo number_format($total_price*$currency,2)?> <?echo $string;?></td>
											</tr>											
										</tbody>
									</table>	
									<div class="space-bottom"></div>
									<table class="table">
										<thead>
											<tr>
												<th colspan="2">邮递信息 </th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>名字</td>
												<td class="information"><?echo $sname;?> </td>
											</tr>
											<tr>
												<td>电子信箱</td>
												<td class="information"><?echo $semail;?> </td>
											</tr>
											<tr>
												<td>电话</td>
												<td class="information"><?echo $stel?></td>
											</tr>
											<tr>
												<td>地址</td>
												<td class="information"><?echo $saddress?></td>
											</tr>
										</tbody>
									</table>									
							<?}
							
							?>						
										<div class="row">



										</div>
							<style>
							.share-button{
								display:inline-block;
								align:right;
							}
							</style>
							
							
							<?
							
								$sql_products = mysqli_query($db,"SELECT * FROM cart WHERE user='$user_email'");

									while ($sql_result_product = mysqli_fetch_assoc($sql_products)) {
										$product_array[] = $sql_result_product['product_id'];
										}
										$prefix = '';
									foreach ($product_array as $product_array)
										{
											$product_arrayList .= $prefix.''.$product_array.'';
											$prefix = ',';
										}	

								$sql_amount = mysqli_query($db,"SELECT * FROM cart WHERE user='$user_email'");

									while ($sql_result_amount = mysqli_fetch_assoc($sql_amount)) {
										$product_amount[] = $sql_result_amount['amount'];
										}
										$prefix = '';
									foreach ($product_amount as $product_amount)
										{
											$product_amountList .= $prefix.''.$product_amount.'';
											$prefix = ',';
										}										

							?>
							<div class="share_button pull-right row" style="margin-top:-38px;">	
							
											<div class="share_button">
											
													<?
													
														if ($currency_factor == "rmb") {
															$currency_code = "cny";
															$locale = "zh";
														?>
														
														<form action="payment_checking.php" method="post">
																<noscript>你需要打开<a href="http://www.enable-javascript.com" target="_blank">javascript</a>在你的网页浏览器再继续</a></noscript>

																<input 
																	type="submit" 
																	value="使用信用卡或支付宝付款"
																	class="btn btn-group btn-info pull-right"
																	data-key="pk_test_04HEZ4uzlMPLYFUEIfB97cK6"
																	data-amount="<?echo round($total_price*100*$currency);?>"
																	data-currency="cny"
																	data-name="Health Supplements Plus"
																	data-description="产品总价"
																	data-email="<?echo $user_email;?>"
																	data-alipay="true"
																	data-locale="zh"
																/>

																<script src="https://checkout.stripe.com/v2/checkout.js"></script>
																<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
																<script>
																$(document).ready(function() {
																	$(':submit').on('click', function(event) {
																		event.preventDefault();
																		var $button = $(this),
																			$form = $button.parents('form');
																		var opts = $.extend({}, $button.data(), {
																			token: function(result) {
																				$form.append($('<input>').attr({ type: 'hidden', name: 'stripeToken', value: result.id })).submit();
																			}
																		});
																		StripeCheckout.open(opts);
																	});
																});
																</script>
																<input type="hidden" name="inputBillingName" value="<?echo $bname?>">
																<input type="hidden" name="inputShippingName" value="<?echo $sname?>">
																<input type="hidden" name="inputBillingEmail" value="<?echo $bemail?>">
																<input type="hidden" name="inputShippingEmail" value="<?echo $semail?>">
																<input type="hidden" name="inputShippingAmount" value="<?echo $shipping_cost?>">
																<input type="hidden" name="inputCoupon" value="<?echo $coupon?>">
																<input type="hidden" name="inputBillingAddress" value="<?echo $baddress?>">
																<input type="hidden" name="inputShippingAddress" value="<?echo $saddress?>">
																<input type="hidden" name="inputComment" value="<?echo $bcomment?>">
																<input type="hidden" name="inputBillingPhone" value="<?echo $btel?>">
																<input type="hidden" name="inputShippingPhone" value="<?echo $stel?>">
																<input type="hidden" name="inputSubtotal" value="<?echo $subtotal?>">
																<input type="hidden" name="inputTotal" value="<?echo $total_price?>">
																<input type="hidden" name="inputCurrencyFactor" value="<?echo $currency_factor?>">
																<input type="hidden" name="inputSameShipping" value="<?echo $shipping_is_same;?>">	
																<input type="hidden" name="inputCurrency" value="<?echo $currency?>">	
																<input type="hidden" name="useremail" value="<?echo $user_email;?>">	
																<input type="hidden" name="productlist" value="<?echo $product_arrayList;?>">
																<input type="hidden" name="productamount" value="<?echo $product_amountList;?>">
														</form>									
													<?	} else {
															$currency_code = "usd";
															$locale = "en";								
													?>
													
														<form action="payment_checking.php" method="post">
																<noscript>你需要打开<a href="http://www.enable-javascript.com" target="_blank">javascript</a>在你的网页浏览器再继续</a></noscript>

																<input 
																		
																	id="cc_submit"
																	type="submit" 
																	value="使用信用卡付款"
																	class="btn btn-group btn-info"

																	data-key="pk_test_04HEZ4uzlMPLYFUEIfB97cK6"
																	data-amount="<?echo $total_price*100*$currency;?>"
																	data-currency="usd"
																	data-name="Health Supplements Plus"
																	data-description="产品总价"
																	data-email="<?echo $user_email;?>"
																	data-locale="zh"
																/>

																<script src="https://checkout.stripe.com/v2/checkout.js"></script>
																<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
																<script>
																$(document).ready(function() {
																	$('#cc_submit').on('click', function(event) {
																		event.preventDefault();
																		var $button = $(this),
																			$form = $button.parents('form');
																		var opts = $.extend({}, $button.data(), {
																			token: function(result) {
																				$form.append($('<input>').attr({ type: 'hidden', name: 'stripeToken', value: result.id })).submit();
																			}
																		});
																		StripeCheckout.open(opts);
																	});
																});
																</script>
																<input type="hidden" id= "inputBillingName" name="inputBillingName" value="<?echo $bname?>">
																<input type="hidden" id= "inputShippingName" name="inputShippingName" value="<?echo $sname?>">
																<input type="hidden" id= "inputBillingEmail" name="inputBillingEmail" value="<?echo $bemail?>">
																<input type="hidden" id= "inputShippingEmail" name="inputShippingEmail" value="<?echo $semail?>">
																<input type="hidden" id= "inputShippingAmount" name="inputShippingAmount" value="<?echo $shipping_cost?>">
																<input type="hidden" id= "inputCoupon" name="inputCoupon" value="<?echo $coupon?>">
																<input type="hidden" id= "inputBillingAddress" name="inputBillingAddress" value="<?echo $baddress?>">
																<input type="hidden" id= "inputShippingAddress" name="inputShippingAddress" value="<?echo $saddress?>">
																<input type="hidden" id= "inputComment" name="inputComment" value="<?echo $bcomment?>">
																<input type="hidden" id= "inputBillingPhone" name="inputBillingPhone" value="<?echo $btel?>">
																<input type="hidden" id= "inputShippingPhone" name="inputShippingPhone" value="<?echo $stel?>">
																<input type="hidden" id= "inputSubtotal" name="inputSubtotal" value="<?echo $subtotal?>">
																<input type="hidden" id= "inputTotal" name="inputTotal" value="<?echo $total_price?>">
																<input type="hidden" id= "inputCurrency" name="inputCurrency" value="<?echo $currency?>">	
																<input type="hidden" id= "inputSameShipping" name="inputSameShipping" value="<?echo $shipping_is_same;?>">
																<input type="hidden" id= "inputCurrencyFactor" name="inputCurrencyFactor" value="<?echo $currency_factor?>">
																<input type="hidden" name="productamount" value="<?echo $product_amountList;?>">
																<input type="hidden" name="useremail" value="<?echo $user_email;?>">	
																<input type="hidden" id="product_array" name="productlist" value="<?echo $product_arrayList;?>">
																
														</form>	
														
														
													<?}
													
													?>																		
											
											</div>							
							
												<?
												
													if ($currency_factor == "rmb"){?>
												<?	}else {?>
												<?
												
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

															$invoice = gen_id(); 
													
												
												?>
														<input type="hidden" id="user_email_id" name="custom" value="<?echo $user_email?>">
														<input type="hidden" id="productamount" name="productamount" value="<?echo $product_amountList;?>">
													<form name="paypal_form" action="https://www.sandbox.paypal.com/cgi-bin/webscr" >
														<input type="hidden" name="cmd" value="_xclick">
														<input type="hidden" name="business" value="sell@zaffiro.ca">
														<input type="hidden" name="item_name" value="Health Supplements Products">
														<input type="hidden" name="item_number" value="2016-HSP">
														<input type="hidden" name="currency_code" value="USD">
														<input type="hidden" id="unique_id" name="custom" value="<?echo $invoice;?>">
														<input type="hidden" name="amount" value="<?echo round($total_price_paypal,2)?>">	
														<input type="hidden" name="on1" value="Account" maxlength="200">
														<input type="hidden" class="form-control" id="fullname1" name="os1" value="<?echo $user_email;?>">		
													</form> 
														<div class="share_button"><button id="paypal_button" class="btn btn-group btn-info pull-right" style="margin-top:-25px;"  >使用贝宝付款</button>
														</div>	

												<?}
												
												?>
						
										

										<a href="mycart.php" class="btn btn-group btn-default pull-right" style="margin-top:5px;">购物车</a>
								<!--<a href="shop-checkout-review.html" class="btn btn-group btn-default">Complete Your Order <i class="icon-right-open-big"></i></a>-->
							</div>
							<div class="text-left row">
							
							</div>
						</div>
						<!-- main end -->

					</div>
				</div>
			</section>
			<!-- main-container end -->
<?}?>
<?include("inc/footer.php");?>
<?include("inc/scripts.php");?>