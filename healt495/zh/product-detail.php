<?include('inc/header.php');?>	

<?
$user_id = $_SESSION['login_user'];
$user_email = mysqli_query($db, "SELECT * FROM customer WHERE id='$user_id'");
	$user_email = mysqli_fetch_assoc($user_email);
	$user_email = $user_email['email'];
	
$catagory_name = $_GET['catagory'];
$product_id = $_GET['id'];
$product_detail = mysqli_query($db, "SELECT * FROM product WHERE id='$product_id' AND legacy <> 'yes'");
	$product_detail_check = mysqli_num_rows($product_detail);
if ($product_detail_check == 0) {
	echo "<meta http-equiv=\"refresh\" content=\"0; url=error.php\">";
}
	$product_detail_array = mysqli_fetch_assoc($product_detail);
		$product_detail_id = $product_detail_array['id'];
		$product_detail_name = $product_detail_array['zh_name'];
		$product_detail_desc = $product_detail_array['zh_detail'];
		$product_detail_price = $product_detail_array['price'];
		$product_detail_picture_main = $product_detail_array['picture'];
		$product_detail_catagory = $product_detail_array['catagory'];
		$product_detail_keywords = $product_detail_array['keywords'];
		$product_detail_stock = $product_detail_array['instock'];
		$product_detail_discount = $product_detail_array['discount'];
		$product_detail_pdf = $product_detail_array['zh_pdf'];
		
		$product_detail_price = $product_detail_price * $currency;
$discount_price = $product_detail_price*(1-$product_detail_discount);
												if (empty($product_detail_picture_main)) {
													$picture = "../admin/images/default-image.gif";
												} else {
													$picture = "../admin/images/products/$product_detail_picture_main";
													}	
												if (empty($product_detail_stock) or $product_detail_stock == 0) {
													$stock_status = 0;
												} else {
													$stock_status = 1;
												}
	$comment_post = mysqli_query($db,"SELECT * FROM review WHERE product = '$product_id'");
	$comment_check_row = mysqli_num_rows($comment_post);		
	
	
  $check_row = mysqli_num_rows(mysqli_query($db, "SELECT * FROM catagory WHERE subname LIKE '%$catagory_name%'"));
  
 $zh_catagory_name = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM catagory WHERE subname LIKE '%$catagory_name%'"));
 if ($check_row != 0){
		$zh_catagory_name = $zh_catagory_name['zh_name'];
 }else {

	$zh_catagory_name = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM catagory WHERE id='$catagory_name'")); 
	$zh_catagory_name = $zh_catagory_name['zh_name']; 
 }
 
 
 

?>	
			<!-- breadcrumb start -->
			<!-- ================ -->
			<div class="breadcrumb-container">
				<div class="container">
					<ol class="breadcrumb">
						<li><i class="fa fa-home pr-10"></i><a href="index.php">首页</a></li>
						<li><a href="product.php?catagory=<?echo $catagory_name;?>"><?echo $zh_catagory_name?></a></li>
						<li><?echo strtoupper($product_detail_name);?></a></li>
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
						<div class="main col-md-12">

							<!-- page-title start -->
							<!-- ================ -->
							<h1 class="page-title"><?echo $product_detail_name;?></h1>
							<div class="separator-2"></div>
							<!-- page-title end -->

							<div class="row">
								<div class="col-md-4">
									<!-- pills start -->
									<!-- ================ -->
									<!-- Nav tabs -->

									<!-- Tab panes -->
									<div class="tab-content clear-style">
											<div class="owl-carousel content-slider-with-large-controls">
												<div class="overlay-container overlay-visible">
													<img src="<?echo $picture;?>" alt="<?echo $product_detail_name;?>">
													<a href="<?echo $picture;?>" class="popup-img overlay-link" title="<?echo $product_detail_name;?>"><i class="icon-plus-1"></i>
													</a>
												</div>
									<?
									$extra_picture = mysqli_query($db,"SELECT * FROM product_picture WHERE product_id = '$product_id'");
									$extra_picture_check = mysqli_num_rows($extra_picture);
									if ($extra_picture_check != 0) {
										while ($extra_picture_result = mysqli_fetch_assoc($extra_picture)) {
											$extra_picture_url = $extra_picture_result['picture']; 
											$extra_picture_url = "../admin/images/products/$extra_picture_url";
											?>
												<div class="overlay-container overlay-visible">
													<img src="<?echo $extra_picture_url;?>" alt="<?echo $product_detail_name;?>">
													<a href="<?echo $extra_picture_url;?>" class="popup-img overlay-link" title="<?echo $product_detail_name;?>"><i class="icon-plus-1"></i></a>
												</div>											
											
									<?	}
									}
									
									
									?>			

												
											</div>
									</div>
									<!-- pills end -->
								</div>
								<div class="col-md-8 pv-30">
									<h2>产品详细解说</h2>
									<?echo $product_detail_desc;?>

									<?if (!empty($product_detail_pdf)) {
										$product_detail_pdf = "admin/pdf/$product_detail_pdf";

									?>
									<p style="padding-bottom:20px;"></p>
									<button class="btn btn-info" data-toggle="modal" data-target="#pdf_listing">PDF 文档</button>								

									<?}?>

									<hr class="mb-10">
									<div class="clearfix mb-20">
										<span>
										<?
											$star_post = mysqli_query($db,"SELECT * FROM review WHERE product = '$product_id'");
											$star_check_row = mysqli_num_rows($star_post);												
										if ($star_check_row == 0) {
											echo "<i>这个产品还没有评论</i>";
										}else {
											while ($star_check = mysqli_fetch_assoc($star_post)) {
												$star_all[] = $star_check['rating'];
											}
											$star_total = array_sum($star_all);
											$star_average = round($star_total / $star_check_row);
											$negative_star = 5- $star_average;
											for ($i = 1; $i <= $star_average; $i++) {?>
												<i class="fa fa-star text-default"></i>
											<?}
											for ($i = 1; $i <= $negative_star; $i++) {?>
												<i class="fa fa-star"></i>
											<?}											
										}
									
											$zhekou = 10-($product_detail_discount *10);
										?>
										</span>
									</div>

																<?
																	if ($stock_status == 0) {?>
																		<strong><span style="color:#FE2E2E;"缺货</span></strong>
																<?	} else {?>
																		<strong><span style="color:#ab6cc6;">有现货: <?echo $product_detail_stock?></span></strong>
																<?	}
																?>										
									
									<div class="light-gray-bg p-20 bordered clearfix">
								
										<span class="product price">
										<?
											if ($product_detail_discount == 0 or empty($product_detail_discount)) {?>
												<?echo $symbol?><?echo number_format($product_detail_price,2)?>
										<?	}else {?>
												<span class="price"><?echo $symbol?><?echo number_format($discount_price,2);?> <del><?echo $symbol?><?echo number_format($product_detail_price,2);?></del> </span>
										<?	}
										?>
										
										</span>
										<?
											if($product_detail_discount != 0 or !empty($product_detail_discount)) {?>
												<strong><span style="color:#FE2E2E;"><?echo $zhekou?>折</span><strong><br/>												
										<?	}
										?>										
										<span class="product  pull-right clearfix">
										<form class="addcart" name="addcart">
												<input type="hidden" name="product_id" value="<?echo $product_id?>">
												<input type="hidden" name="user_id" value="<?echo $user_email;?>">											
												<div class="form-group">
													<label>数量</label>
													<input type="text" class="form-control" id="quanitity" name="quanitity" value="1">
												</div>	
										</form>		
										<div id="cart_msg"></div>
															<?
																if (!empty($_SESSION['login_user'])) {
																	if ($stock_status == 1) {?>
															      <input type="submit" id="addcart" value="加入购物车" class="margin-clear btn btn-default pull-right">																		
															<?		}else {?>
															      <input type="submit" value="加入购物车" class="margin-clear btn btn-default pull-right" disabled>																	
															<?		}
																}else {?>
																	<center>加入购物车需要您<a href="#" data-toggle="modal" data-target="#myModal">登录或注册</a></center>
															<?	}
															?>
										
										</span>
										
									</div>
								</div>
							</div>
						</div>
						<!-- main end -->

					</div>
				</div>
			</section>
			<!-- main-container end -->

			<!-- section start -->
			<!-- ================ -->
			<section class="pv-30 light-gray-bg">
				<div class="container">
					<div class="row">
						<div class="col-md-8">
							<!-- Nav tabs -->
							<ul class="nav nav-tabs style-4" role="tablist">
								<li class="active"><a href="#comment" role="tab" data-toggle="tab"><i class="fa fa-check pr-5"></i>评论 (<?echo $comment_check_row;?>)</a></li>
							</ul>
							<!-- Tab panes -->
							<div class="tab-content padding-top-clear padding-bottom-clear">
								<div class="tab-pane fade in active" id="comment">
									<!-- comments start -->
									<div class="comments margin-clear space-top">
									<?
										if ($comment_check_row == 0) {
											echo "你可以当第一哦！<br/><br/>";
										} else {
											while ($post_check = mysqli_fetch_assoc($comment_post)) {
												$comment_title = $post_check['title'];
												$comment_date = $post_check['date'];
												$comment_comment = $post_check['comment'];
												$comment_rating = $post_check['rating']; 
												$comment_star_g = $comment_rating;
												$comment_star_b = 5-$comment_rating;
												?>
												<!-- comment start -->
												<div class="comment clearfix">
													<header>
														<h3><?echo $comment_title;?></h3>
														<div class="comment-meta">

													<?
													
														for ($i=1; $i <= $comment_star_g; $i++) {?>
															<i class="fa fa-star text-default"></i>
													<?	}
														for ($i=1; $i <= $comment_star_b; $i++) {?>
														</i><i class="fa fa-star"></i>
													<?	}														
													?>
													

														| <?echo $comment_date;?></div>
													</header>
													<div class="comment-content">
														<div class="comment-body clearfix">
															<p><?echo $comment_comment;?></p>
														</div>
													</div>
												</div>
												<!-- comment end -->												
												
									<?		}
										}
									?>


									</div>
									<!-- comments end -->
									<?
									$check_comment = mysqli_query($db,"SELECT * FROM review WHERE product = '$product_id' AND user = '$user_email'");
									$check_comment = mysqli_num_rows($check_comment);
										if ($check_comment == 1) {?>
									<div class="comments-form">
										<h2 class="title" id="comment_change">您已对这个产品评论过啦！</h2>		
									</div>												
									<?	}else {?>
									<!-- comments form start -->
									<div class="comments-form">
										<h2 class="title" id="comment_change">评论输入</h2>
										<div id="comment_msg"></div>
										<form role="form" class="comment_post" id="comment-form">
											<div class="form-group has-feedback">
												<label for="subject4">题目</label>
												<input type="text" class="form-control" id="title_comment" placeholder="" name="title_comment" required>
												<i class="fa fa-pencil form-control-feedback"></i>
											</div>
											<div class="form-group">
												<label>等级</label>
												<select class="form-control" id="rating_comment" name="rating_comment">
													<option value="5">5</option>
													<option value="4">4</option>
													<option value="3">3</option>
													<option value="2">2</option>
													<option value="1">1</option>
												</select>
											</div>
											<div class="form-group has-feedback">
												<label for="message4">评论</label>
												<textarea class="form-control" rows="8" id="message4" name="message4" required></textarea>
												<i class="fa fa-envelope-o form-control-feedback"></i>
											</div>	
											<div class="form-group has-feedback">
												<label for="passcode">2+2=?</label>
												<input type="text" class="form-control" id="passcode" name="passcode" required>
												<i class="fa fa-question-circle form-control-feedback"></i>
											</div>	
												<input type="hidden" id="product_id" name="product_id" value="<?echo $product_id?>">
												<input type="hidden" id="user_id" name="user_id" value="<?echo $user_email;?>">												
										</form>
										<input type="submit" id="comment_submit" value="加入评论" class="btn btn-default">
									</div>
									<!-- comments form end -->										
									<?}
									?>

								</div>
							</div>
						</div>

						<!-- sidebar start -->
						<!-- ================ -->
						<aside class="col-md-4 col-lg-3 col-lg-offset-1">
							<div class="sidebar">
								<div class="block clearfix">
									<h3 class="title">相似产品</h3>
									<div class="separator-2"></div>
									<div class="media margin-clear">
									
									<?
										$related_product = mysqli_query($db, "SELECT * FROM product WHERE catagory='$catagory_name' AND id <> '$product_id' ORDER BY RAND() LIMIT 5");
										$related_check = mysqli_num_rows($related_product);
										$star_side = mysqli_query($db,"SELECT * FROM review WHERE product = '$product'");
										if ($related_check == 0){
											echo "没有相似产品";
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
											$related_price = $related_price * $currency;
												if (empty($related_picture)) {
													$picture = "../admin/images/default-image.gif";
												} else {
													$picture = "../admin/images/products/$related_picture";
												}											
											?>

											
										<div class="media-left">
											<div class="overlay-container">
												<img class="media-object" src="<?echo $picture;?>" alt="<?echo $related_name?>">
												<a href="product-detail.php?catagory=<?echo $related_catagory?>&id=<?echo $related_id;?>" class="overlay-link small"><i class="fa fa-link"></i></a>
											</div>
										</div>
										<div class="media-body">
											<h6 class="media-heading"><a href="product-detail.php?catagory=<?echo $related_catagory?>&id=<?echo $related_id;?>"><?echo $related_name;?></a></h6>
											
											<p class="margin-clear">
											
												<?
													if ($related_stock == "" or $related_stock == 0) {?>
														<strong><span style="color:#FE2E2E;">缺货</span></strong>
												<?	}else {?>
														<strong><span style="color:#ab6cc6;">有现货: <?echo $related_stock?></span></strong>
												<?}
												?>
											
											</p>
											
															<?
																if (!empty($related_discount)) {
																	$discount_price = $related_price * (1-$related_discount);
															?>
																	<span class="price"><del><?echo $symbol?><?echo number_format($related_price,2);?></del> <font color="#FE2E2E"><?echo $symbol?><?echo number_format($discount_price,2);?></font></span>
															<?	} else {?>
																<span class="price"><?echo $symbol?><?echo number_format($related_price,2);?></span>
															<?}
															?>
										</div>
										<hr>											
											
									<?	}
										
									}?>											
										
										

									</div>
								</div>
							</div>
						</aside>
						<!-- sidebar end -->

					</div>
				</div>
				
					<div class="modal fade modal_login_style" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					  <div class="modal-content modal-dialog modal-sm">
						  <div class="modal-header">
							  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
							  <h4 class="modal-title" id="modalla">登录网页</h4>
						  </div>
						  
						  <div class="modal-body">
							  <div class="row">
								  <div class="col-md-12">
									  <div class="well">
										  <form id="loginForm" novalidate="novalidate">
											  <div class="form-group">
												  <label for="username" class="control-label">电子邮箱</label>
												  <input type="text" class="form-control" id="username_modal" name="username" value="" required="" title="Please enter your username" placeholder="example@163.com">
												  <span class="help-block"></span>
											  </div>
											  <div class="form-group">
												  <label for="password" class="control-label">密码</label>
												  <input type="password" class="form-control" id="password_modal" name="password" value="" required="" title="Please enter your password" placeholder="******">
												  <span class="help-block"></span>
											  </div>								  
										  </form>
										  <div id="error_modal"></div>
										  <input id="login_modal" type="submit" class="btn btn-danger btn-block" value="登录">
										  <a href="passwordreset.php">忘记密码</a><br/>
										  没有账户？
										  <a href="signup.php">注册</a>
									  </div>
								  </div>
							  </div>
						  </div>
						  
					  </div>
				  </div>
				  
				  
					<div class="modal fade modal_login_style" id="pdf_listing" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					  <div class="modal-content modal-dialog modal-lg">
						  <div class="modal-header">
							  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
							  <h4 class="modal-title" id="modalla"><?echo $product_detail_name?> 产品详细解说</h4>
						  </div>
						  
						  <div class="modal-body">
								<iframe src="https://docs.google.com/gview?url=https://www.healthsupplementsplus.com/<?echo $product_detail_pdf?>&embedded=true" width="100%" height="600px" frameborder="0"></iframe>
						  </div>
						  
					  </div>
				  </div>				  
				  
			</section>
			<!-- section end -->

<?include("inc/footer.php");?>
<?include("inc/scripts.php");?>
