<?include('inc/header.php');?>	
<?
if(empty($_SESSION['login_user']))
{
echo "<meta http-equiv=\"refresh\" content=\"0; url=index.php\">";

}
?>
<?
$user_id = $_SESSION['login_user'];
$user_email = mysqli_query($db, "SELECT * FROM customer WHERE id='$user_id'");
	$user_email = mysqli_fetch_assoc($user_email);
	$user_email = $user_email['email'];
	
$cart_check = mysqli_query($db,"SELECT * FROM cart WHERE user='$user_email'");
$cart_exist = mysqli_num_rows($cart_check);

$delete_row_ship = mysqli_query($db,"DELETE FROM ship_coup WHERE user='$user_email'");
$MAX_LENGTH = 78;
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
							<div class="row">
							<div class="col-md-10">
							<h1 id="shopping_num" class="page-title">Shopping Cart: <?echo $cart_exist;?> Items</h1>
							</div>
							</div>					
							
							<div class="separator-2"></div>
							<!-- page-title end -->
							<div id="cart_msg">
								<?
									if ($cart_exist == 0) {?>
										Your shopping cart is empty!<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
									<?}else {?>
							</div>		
										<table class="table cart table-hover table-colored">
											<thead>
												<tr>
													<th>Product </th>
													<th>Price </th>
													<th>Quantity</th>
													<th>Remove </th>
													<th class="amount">Sub-total </th>
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
															$product_p = $product_price * (1-$product_discount);
															
															$product_price = $product_p;
														}
														
														$price_total[] = $product_price*$cart_product_amount;													
														$sub_total = $product_price*$cart_product_amount;
											?>
														
														<tr class="remove-data">
													
															<td class="product">
															<div class="media-left pull-left">
																<div class="overlay-container">
																	<img class="media-object" src="<?echo $picture;?>" alt="<?echo $product_name;?>" height="67" width="50">
																</div>
															</div>														
															<p class="pull-right"><a href="product-detail.php?catagory=<?echo $product_catagory?>&id=<?echo $cart_product_id?>"><?echo $product_name;?></a> <small><?echo $product_detail;?></small></p>
															
															</td>
															<td class="price">
															<?
																if ($product_discount == 0 or empty($product_discount)) {?>
																	<?echo $symbol?><?echo number_format($product_price,2);?>
																<?}else {?>
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
															<td class="remove">
															<input type="submit" id="id_<?echo $cart_product_id;?>_<?echo $user_email;?>_<?echo $sub_total?>" value="Remove" class="btn btn-remove btn-sm btn-default del_button">
															<td class="amount"><?echo $symbol?><?echo number_format($sub_total,2);?></td>
															
														</tr>														
														
											<?		}
												}
												$sum_total = array_sum($price_total);
											?>
												
												<!--
												<tr>
													<td class="total-quantity" colspan="4">Price Before Discount:</td>
													<td class="total-amount">$<?//echo number_format(array_sum($before_discount),2)?></td>
												</tr>	
												
												<tr>
												-->
													<tr>										
														<td class="total-quantity" colspan="2">Discount Coupon:(optional)</td>
														<td class="coupon" colspan="2">
															<input type="text" id="coupon" placeholder="Coupon Code" class="form-control">
															<div id="output" style="color:green;"></div>
															
														</td>
														<td class="amount" id="coupon_amount">--</td>
													</tr>
													<td class="total-quantity" colspan="4">Total Price:</td>
													<a data-toggle="price" data-placement="bottom" title="Not including shipping"><td class="total-amount" id="change_total" ><?echo $symbol?><?echo number_format($sum_total,2)?></td></a>
												</tr>
												
											</tbody>
										</table>	
										
								<?	}
								?>
							<?
								if ($cart_exist == 0) { 
								
								}else {?>
								<div id="checkout_remove">



									<form action="checkout.php" method="POST">								
									<input type="hidden" name="total_amount" id="post_amount" value="<?echo $symbol?><?echo number_format($sum_total,2)?>">
									<input type="hidden" name="discount_amount" id="discount_amount" value="">
									<div id="msg_coupon"></div>
									<div class="text-right">									
										<input type="submit" class="btn btn-group btn-default" value="Checkout">
									</div>
									
									</form>
										


								</div>
							<?	}
							?>


						</div>
						<!-- main end -->

					</div>
				</div>
			</section>
			<!-- main-container end -->
			
<?include("inc/footer.php");?>
<?include("inc/scripts.php");?>