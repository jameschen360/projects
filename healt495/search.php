<?include('inc/header.php');
  include('inc/nav.php');
?>
<?
include('inc/db.php');
$result = trim($_GET['keyword']);
//$result = str_replace(' ', '', $result);
$query_result = mysqli_query($db, "SELECT * FROM product WHERE keywords LIKE '%$result%' AND legacy <> 'yes'");
$search_result = mysqli_num_rows($query_result);
$MAX_LENGTH = 100;

$start_time = microtime(TRUE);




?>
			<!-- breadcrumb start -->
			<!-- ================ -->
			<div class="breadcrumb-container">
				<div class="container">
					<ol class="breadcrumb">
						<li><i class="fa fa-home pr-10"></i><a href="index.php">Home</a></li>
						<li class="active"><?echo $search_result?> result were found for keyword: <?echo strtoupper($result);?></li>
					</ol>
				</div>
			</div>
			<!-- breadcrumb end -->
			<!-- section start -->
			<!-- ================ -->
			<div class="light-gray-bg section">
				<div class="container">
					<!-- filters start -->
					<div class="sorting-filters text-center mb-20">
						<form class="form-inline" action="<?php $_PHP_SELF ?>" method="GET">
							<div class="form-group">
								<label>Search:</label>
										<input type="text" class="form-control col-xs-6" name="keyword" value="<?echo $result;?>" autocomplete="off" required>
							</div>
							<div class="form-group">
								<input type="submit" class="btn btn-default" value="Search">
							</div>
						</form>
					</div>
					<!-- filters end -->
				</div>
			</div>
			<!-- section end -->			
			<!-- main-container start -->
			<!-- ================ -->
			<section class="main-container">

				<div class="container">
					<div class="row">

						<!-- main start -->
						<!-- ================ -->
						<div class="main col-md-12">
							<!-- pills start -->
							<!-- ================ -->
							<!-- Nav tabs -->

							<!-- Tab panes -->
							<div class="tab-content clear-style">
								<div class="tab-pane active" id="pill-1">
									<div class="row masonry-grid-fitrows grid-space-10">
								<?
									if ($search_result == 0 or $result == "") {
										echo "No results were found. Please try another search!<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>";
									}else {?>
									<?
									while ($result_row = mysqli_fetch_assoc($query_result)) {
										$product_id = $result_row['id'];
										$product_name = $result_row['name'];
										$product_desc = $result_row['detail'];
										$product_price = $result_row['price'];
										$product_picture = $result_row['picture'];
										$product_stock = $result_row['instock'];
										$product_discount = $result_row['discount'];
										$product_catagory = $result_row['catagory'];
												if (strlen($product_desc) > $MAX_LENGTH) {
													$product_desc = substr($product_desc, 0, $MAX_LENGTH);
													$product_desc = "$product_desc...";
												}
												if (empty($product_picture)) {
													$product_picture = "admin/images/default-image.gif";
												} else {
													$product_picture = "admin/images/products/$product_picture";
												}
										if (empty($product_stock) or $product_stock == 0) {
											$stock_status = 0;
										} else {
											$stock_status = 1;
										}
											
											$product_price = $product_price * $currency;
										?>
											<div class="col-md-6 masonry-grid-item">
												<div class="listing-item bordered light-gray-bg mb-20">
													<div class="row grid-space-0">
														<div class="col-sm-6 col-md-4 col-lg-3">
															<div class="overlay-container">
																<img src="<?echo $product_picture?>" alt="<?echo $product_name?>">
																<a class="overlay-link" href="product-detail.php?catagory=<?echo $product_catagory;?>&id=<?echo $product_id;?>"><i class="icon-link pr-1"></i></a></a>
																
														<?
															if (!empty($product_discount)) {	
														?>
																<span class="badge"><?echo round($product_discount * 100);?>% OFF</span>
														<?	}
															
														?>
																
															</div>
														</div>
														<div class="col-sm-6 col-md-8 col-lg-9">
															<div class="body">
																<h3 class="margin-clear"><a href="product-detail.php?catagory=<?echo $product_catagory;?>&id=<?echo $product_id;?>"><?echo $product_name?> </a></h3>
																
																<?
																	if ($stock_status == 0) {?>
																		<strong><span style="color:#FE2E2E;">Out of Stock</span></strong>
																<?	} else {?>
																		<strong><span style="color:#ab6cc6;">In Stock: <?echo $product_stock?></span></strong>
																<?	}
																?>
																
																
																<p class="small"><?echo $product_desc;?></p>
																<div class="elements-list clearfix">
																
															<?
																if (!empty($product_discount)) {
																	$discount_price = $product_price * (1-$product_discount);
															?>
																	<span class="price"><del><?echo $symbol;?><?echo number_format($product_price,2);?></del> <?echo $symbol;?><?echo number_format($discount_price,2);?></span>
															<?	} else {?>
																<span class="price"><?echo $symbol;?><?echo number_format($product_price,2);?></span>
															<?}
															?>
																


																	
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										
		
									<?}
									?>										
								<?	}
								?>	
									</div>
								</div>
							</div>
							<!-- pills end -->

						</div>
						<?
							$end_time = microtime(TRUE);
 
							$time_taken = $end_time - $start_time;
							 
							$time_taken = round($time_taken,5);
						if ($search_result == 0 or $result == "") {
							
						}else {
							echo 'Results generated in '.$time_taken.' seconds.';
						}
							
						?>
						<!-- main end -->
						
					</div>
				</div>
			</section>
			<!-- main-container end -->
<?include("inc/footer.php");?>
<?include("inc/scripts.php");?>
