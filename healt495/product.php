<?include('inc/header.php');
	include('inc/nav.php');
?>
<?
  $product_catagory = $_GET['catagory'];
  $catagory_name_id = $_GET['id'];
  $catagory_name_fetch = mysqli_query($db, "SELECT * FROM catagory WHERE id='$catagory_name_id'");
  $cata_sql = mysqli_fetch_assoc($catagory_name_fetch);
  $cata_sql_row = mysqli_num_rows($catagory_name_fetch);
  $catagory_name = $cata_sql['name'];
  $catagory_desc = $cata_sql['desc'];
  $min_price = $_GET['min'];
  $max_price = $_GET['max'];
  $MAX_LENGTH = 100;
  $product_fetcha = mysqli_query($db, "SELECT * FROM product WHERE catagory='$product_catagory' AND legacy <> 'yes'");
  $row_counta = mysqli_num_rows($product_fetcha);	
  if (!is_numeric($min_price)) {
	  $fill_in_min = "0.00";
  } else {
	  $fill_in_min = $min_price;
  }
  if (!is_numeric($max_price)) {
	  $fill_in_max = "0.00";
  }else {
	  $fill_in_max = $max_price;
  }
  if($row_counta == 0) {
	echo "<meta http-equiv=\"refresh\" content=\"0; url=error.php\">";
  }
?>

			<!-- breadcrumb start -->
			<!-- ================ -->
			<div class="breadcrumb-container">
				<div class="container">
					<ol class="breadcrumb">
						<li><i class="fa fa-home pr-10"></i><a href="index.php">Home</a></li>
						<li class="active"><?echo strtoupper($product_catagory);?></li>
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
										<input type="hidden" name="catagory" value="<?echo $product_catagory;?>">
										<input type="hidden" name="id" value="<?echo $catagory_name_id;?>">
							<div class="form-group">
								<label>Min Price</label>
										<input type="text" class="form-control col-xs-6" name="min" value="<?echo $fill_in_min;?>" autocomplete="off">
							</div>
							<div class="form-group">
								<label>Max Price</label>
										<input type="text" class="form-control col-xs-6" name="max" value="<?echo $fill_in_max;?>" autocomplete="off">
							</div>
							<div class="form-group">
								<input type="submit" class="btn btn-default" value="Filter">
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
						<!-- sidebar start -->
						<!-- ================ -->
						<aside id="floating" class="col-md-3 hidden-xs hidden-sm" >
							<div class="sidebar">
								<div class="block clearfix">
									<h3 class="title">Categories</h3>
									<div class="separator-2"></div>
									<nav>
														<?
															while ($i < $row_count_catagory) {
																if ($sub[$i] == "0") {?>
																	<a href="product.php?catagory=<?echo strtolower($name[$i]);?>&id=<?echo $id[$i]?>"><?echo $name[$i]?></a>																
																<?	$i++;
																} else {?>
																	<div id="acr">
																		<a data-toggle="collapse" data-parent="#acr" href="#<?echo preg_replace('/\s+/', '', $name[$i])?>"><?echo $name[$i]?> (<?echo $sub[$i];?>)</a>
																	</div>
																	<div class="collapse in catagory_acr" id="<?echo preg_replace('/\s+/', '', $name[$i])?>">
																		<ul>
																		<?
																			for ($j = 0; $j < $sub[$i] ; $j++) {?>
																				<?$sub_catagory = explode(",",$subname[$i]);?>
																				<li><a href="product.php?catagory=<?echo strtolower($sub_catagory[$j]);?>&id=<?echo $id[$i]?>"><?echo $sub_catagory[$j]?></a></li>
																			<?}
																			?>
																		</ul>
																	</div>																	
																<?	$i++;
																}

															}
														?>
									</nav>
								</div>
								<?
									if ($cata_sql_row != 0) { ?>
								<div class="block clearfix">
									<h3 class="title"><?echo $catagory_name;?></h3>
									<div class="separator-2"></div>
									<p class="margin-clear"><?echo $catagory_desc;?></p>
								</div>										
								<?	}
								?>
								<div class="block clearfix">
									<form role="search" action="search.php" method="GET">
										<div class="form-group has-feedback">
											<input type="text" name="keyword" class="form-control" placeholder="Search..." required autocomplete="off">
											<i class="fa fa-search form-control-feedback"></i>
										</div>
									</form>
								</div>	
							</div>
						</aside>
						<!-- sidebar end -->
						<!-- main start -->
						<!-- ================ -->
						<div class="main col-md-9">
							<!-- pills start -->
							<!-- ================ -->
							<!-- Nav tabs -->
							<ul class="nav nav-pills" role="tablist">
								<li class="active"><a href="#pill-1" role="tab" data-toggle="tab" title="Latest Arrivals"><i class="icon-star"></i> <?echo strtoupper($product_catagory);?></a></li>
							</ul>
							<!-- Tab panes -->
							<div class="tab-content clear-style">
								<div class="tab-pane active" id="pill-1">
									<div class="row masonry-grid-fitrows grid-space-10">
									
										<?
										
										if (!is_numeric($min_price) and !is_numeric($max_price)) {
											$product_fetch = mysqli_query($db, "SELECT * FROM product WHERE catagory='$product_catagory' AND legacy <> 'yes'");
										}else {
											if ($currency_factor == "rmb" or $currency_factor == "RMB") {
												$min_price = $min_price / $currency;
												$max_price = $max_price / $currency;
											}
											$product_fetch = mysqli_query($db, "SELECT * FROM product WHERE catagory='$product_catagory' AND price>='$min_price' AND price<='$max_price' AND legacy <> 'yes'");												
										}
										$row_count = mysqli_num_rows($product_fetch);
										
										if($row_count == 0) {
											echo "No results were found. Please try another combination!";
										} else {
											while($row = mysqli_fetch_assoc($product_fetch)) { 
												$product_id = $row['id'];
												$product_name = $row['name'];
												$product_desc= $row['detail'];
												$price = $row['price'];
												$picture = $row['picture'];
												$stock = $row['instock'];
												$discount = $row['discount'];
												if (strlen($product_desc) > $MAX_LENGTH) {
													$product_desc = substr($product_desc, 0, $MAX_LENGTH);
													$product_desc = "$product_desc...";
												}
												if (empty($picture)) {
													$picture = "admin/images/default-image.gif";
												} else {
													$picture = "admin/images/products/$picture";
												}
												
												if (empty($stock) or $stock == 0) {
													$stock_status = 0;
												} else {
													$stock_status = 1;
												}	
												
												
												$price = $price * $currency;

										
											?>
											<div class="col-sm-6 col-lg-4 masonry-grid-item">
												<div class="listing-item white-bg bordered mb-20">
													<div class="overlay-container">
														<a href="product-detail.php?catagory=<?echo $product_catagory?>&id=<?echo $product_id;?>"><img src="<?echo $picture;?>" alt="<?echo $product_name;?>"></a>
														<?
															if (!empty($discount)) {	
														?>
																<span class="badge"><?echo round($discount * 100);?>% OFF</span>
														<?	}
															
														?>
														
														
														<div class="overlay-to-top links">
															<span class="small">
																<a href="product-detail.php?catagory=<?echo $product_catagory?>&id=<?echo $product_id;?>" class="btn-sm-link"><i class="icon-link pr-5"></i>View Details</a>
															</span>
														</div>
													</div>
													<div class="body">
														<h3><a href="product-detail.php?catagory=<?echo $product_catagory?>&id=<?echo $product_id;?>"><?echo $product_name;?></a></h3>
																<?
																	if ($stock_status == 0) {?>
																		<strong><span style="color:#FE2E2E;">Out of Stock</span></strong>
																<?	} else {?>
																		<strong><span style="color:#ab6cc6;">In Stock: <?echo $stock?></span></strong>
																<?	}
																?>														
														<p class="small"><?echo $product_desc;?></p>
														<div class="elements-list clearfix">
															
															<?
																if (!empty($discount)) {
																	$discount_price = $price * (1-$discount);
															?>
																	<span class="price"><del><?echo $symbol?><?echo number_format($price,2);?></del> <?echo $symbol?><?echo number_format($discount_price,2);?></span>
															<?	} else {?>
																<span class="price"><?echo $symbol?><?echo number_format($price,2);?></span>
															<?}
															?>

														</div>
													</div>
												</div>
											</div>
										<?	} 
										}
										?>

									</div>
								</div>

							</div>
							<!-- pills end -->

						</div>
						<!-- main end -->


						
					</div>
				</div>
			</section>
			<!-- main-container end -->
<?include("inc/footer.php");?>
<?include("inc/scripts.php");?>
