<?include("inc/header.php");

$MAX_LENGTH=100;?>
			<!-- banner start -->
			<!-- ================ -->
			<div class="banner clearfix">

				<!-- slideshow start -->
				<!-- ================ -->
				<div class="slideshow">
					
					<!-- slider revolution start -->
					<!-- ================ -->
					<div class="slider-banner-container">
						<div class="slider-banner-fullwidth-big-height">
							<ul class="slides">
								<!-- slide 1 start -->
								<!-- ================ -->
								<li data-transition="random" data-slotamount="7" data-masterspeed="500" data-saveperformance="on" data-title="Get 50% Sales">
								
								<!-- main image -->
								<img src="images/shop-slide-1.jpg" alt="slidebg1" data-bgposition="center top"  data-bgrepeat="no-repeat" data-bgfit="cover">
								
								<!-- Transparent Background -->
								<div class="tp-caption dark-translucent-bg"
									data-x="center"
									data-y="bottom"
									data-speed="600"
									data-start="0">
								</div>

								<!-- LAYER NR. 1 -->
								<div class="tp-caption sfb fadeout large_white"
									data-x="left"
									data-y="180"
									data-speed="500"
									data-start="1000"
									data-easing="easeOutQuad">Get <span class="text-default">50%</span> OFF<br> Next Generation Template
								</div>	

								<!-- LAYER NR. 2 -->
								<div class="tp-caption sfb fadeout large_white tp-resizeme hidden-xs"
									data-x="left"
									data-y="300"
									data-speed="500"
									data-start="1300"
									data-easing="easeOutQuad"><div class="separator-2 light"></div>
								</div>	

								<!-- LAYER NR. 3 -->
								<div class="tp-caption sfb fadeout medium_white hidden-xs"
									data-x="left"
									data-y="320"
									data-speed="500"
									data-start="1300"
									data-easing="easeOutQuad"
									data-endspeed="600">Lorem ipsum dolor sit amet, consectetur adipisicing elit. <br> Nesciunt, maiores, aliquid. Repellat eum numquam aliquid culpa offici, <br> tenetur fugiat dolorum sapiente eligendi...
								</div>

								<!-- LAYER NR. 4 -->
								<div class="tp-caption sfb fadeout small_white text-center"
									data-x="left"
									data-y="430"
									data-speed="500"
									data-start="1600"
									data-easing="easeOutQuad"
									data-endspeed="600"><a href="#" class="btn btn-default btn-animated">Learn More <i class="fa fa-arrow-right"></i></a>
								</div>

								</li>
								<!-- slide 1 end -->

								<!-- slide 2 start -->
								<!-- ================ -->
								<li data-transition="random" data-slotamount="7" data-masterspeed="500" data-saveperformance="on" data-title="New Arrivals">
								
								<!-- main image -->
								<img src="images/shop-slide-2.jpg" alt="slidebg1" data-bgposition="center top"  data-bgrepeat="no-repeat" data-bgfit="cover">
								
								<!-- Transparent Background -->
								<div class="tp-caption dark-translucent-bg"
									data-x="center"
									data-y="bottom"
									data-speed="600"
									data-start="0">
								</div>

								<!-- LAYER NR. 1 -->
								<div class="tp-caption sfb fadeout text-right large_white"
									data-x="right"
									data-y="180"
									data-speed="500"
									data-start="1000"
									data-easing="easeOutQuad"><span class="text-default">New</span> Arrivals<br> Unlimited Variations and Layouts
								</div>	

								<!-- LAYER NR. 2 -->
								<div class="tp-caption sfb fadeout large_white tp-resizeme hidden-xs"
									data-x="right"
									data-y="300"
									data-speed="500"
									data-start="1300"
									data-easing="easeOutQuad"><div class="separator-3 light"></div>
								</div>	

								<!-- LAYER NR. 3 -->
								<div class="tp-caption sfb fadeout medium_white text-right hidden-xs"
									data-x="right"
									data-y="320"
									data-speed="500"
									data-start="1300"
									data-easing="easeOutQuad"
									data-endspeed="600">Lorem ipsum dolor sit amet, consectetur adipisicing elit. <br> Nesciunt, maiores, aliquid. Repellat eum numquam aliquid culpa offici, <br> tenetur fugiat dolorum sapiente eligendi...
								</div>

								<!-- LAYER NR. 4 -->
								<div class="tp-caption sfb fadeout small_white text-right text-center"
									data-x="right"
									data-y="430"
									data-speed="500"
									data-start="1600"
									data-easing="easeOutQuad"
									data-endspeed="600"><a href="#" class="btn btn-default btn-animated">Check Now <i class="fa fa-arrow-right"></i></a>
								</div>
								</li>
								<!-- slide 2 end -->
							</ul>
							<div class="tp-bannertimer"></div>
						</div>
					</div>
					<!-- slider revolution end -->

				</div>
				<!-- slideshow end -->

			</div>
			<!-- banner end -->
			
			<div id="page-start"></div>

			<!-- section start -->
			<!-- ================ -->
			<section class="section light-gray-bg clearfix">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<!-- pills start -->
							<!-- ================ -->
							<!-- Nav tabs -->
							<ul class="nav nav-pills" role="tablist">
								<li class="active"><a href="#pill-1" role="tab" data-toggle="tab" title="Latest Arrivals"><i class="icon-star"></i> 最新产品</a></li>
							</ul>
							<!-- Tab panes -->
							<div class="tab-content clear-style">
								<div class="tab-pane active" id="pill-1">
									<div class="row masonry-grid-fitrows grid-space-10">
									
									<?
										$related_product = mysqli_query($db, "SELECT * FROM product ORDER BY RAND() LIMIT 8");
										$related_check = mysqli_num_rows($related_product);
										$star_side = mysqli_query($db,"SELECT * FROM review WHERE product = '$product'");
										if ($related_check == 0){
											echo "No related products";
										} else {
											
										while($related_result = mysqli_fetch_assoc($related_product)) {
											$related_name = $related_result['zh_name'];
											$related_price = $related_result['price'];
											$related_rating = $related_result['rating'];
											$related_discount = $related_result['discount'];
											$related_catagory = $related_result['catagory'];
											$related_id = $related_result['id'];
											$related_stock = $related_result['instock'];
											$related_picture = $related_result['picture'];
											$product_desc = $related_result['zh_detail'];
											$stock = $related_result['instock'];
											
											$related_price = $related_price * $currency;
												if (empty($related_picture)) {
													$picture = "../admin/images/default-image.gif";
												} else {
													$picture = "../admin/images/products/$related_picture";
												}	
												if (strlen($product_desc) > $MAX_LENGTH) {
													$product_desc = substr($product_desc, 0, $MAX_LENGTH);
													$product_desc = "$product_desc...";
												}	
												if (empty($stock) or $stock == 0) {
													$stock_status = 0;
												} else {
													$stock_status = 1;
												}		
												$zhekou = 10- ($related_discount * 10);												
											?>
											
											<div class="col-md-3 col-sm-6 masonry-grid-item">
												<div class="listing-item white-bg bordered mb-20">
													<div class="overlay-container">
														<a href="product-detail.php?catagory=<?echo $related_catagory?>&id=<?echo $related_id;?>"><img src="<?echo $picture;?>" alt="<?echo $related_name?>"></a>
														<?
														if($related_discount != "" or $related_discount != 0){?>
															<span class="badge"><?echo $zhekou?>折</span>
														<?}
														?>
														
														<div class="overlay-to-top links">
															<span class="small">
																<a href="product-detail.php?catagory=<?echo $related_catagory?>&id=<?echo $related_id;?>" class="btn-sm-link"><i class="icon-link pr-5"></i>更多产品信息</a>
															</span>
														</div>
													</div>
													<div class="body">
														<h3><a href="product-detail.php?catagory=<?echo $related_catagory?>&id=<?echo $related_id;?>"><?echo $related_name?></a></h3>
														<p class="small"><?echo $product_desc?></p>
																<?
																	if ($stock_status == 0) {?>
																		<strong><span style="color:#FE2E2E;">缺货</span></strong>
																<?	} else {?>
																		<strong><span style="color:#ab6cc6;">有现货: <?echo $stock?></span></strong>
																<?	}
																?>															
														<div class="elements-list clearfix">
														
														<?
														if ($related_discount == "" or $related_discount == 0) {?>
															<span class="price"><?echo $symbol?><?echo number_format($related_price,2)?></span>
														<?}else{?>
															<span class="price"><del><?echo $symbol?><?echo number_format($related_price,2)?></del> <?echo $symbol?><?echo number_format($related_price* (1-$related_discount),2)?></span>
														<?}
														
														?>
															
														</div>
													</div>
												</div>
											</div>

										<?
											}
										}
										?>
												
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- pills end -->
						</div>

			</section>
			<!-- section end -->


<?include("inc/footer.php");?>
<?include("inc/scripts.php");?>