<?session_start();


include('db.php');
include('nav.php');
$user_id = $_SESSION['login_user'];
$user_email = mysqli_query($db, "SELECT * FROM customer WHERE id='$user_id'");
$user_result = mysqli_fetch_assoc($user_email);
$user_fname = $user_result['first_name'];
$user_email = $user_result['email'];
$cart_sql = mysqli_query($db,"SELECT * FROM cart WHERE user = '$user_email'");	
$cart_row = mysqli_num_rows($cart_sql);

$ip = $_SERVER['REMOTE_ADDR'];

$ip_check = mysqli_query($db,"SELECT * FROM ip WHERE ip = '$ip'");	
$ip_currency = mysqli_fetch_assoc($ip_check);

$ip_currency = $ip_currency['currency'];

$ip_row = mysqli_num_rows($ip_check);

if ($ip_row == 0 and empty($user_id)) {
$currency_factor = "usd";
$ip_insert = mysqli_query($db,"INSERT INTO ip (ip,currency) VALUES ('$ip','$currency_factor')");
} else {
if (empty($user_id) and $ip_row != 0) {
$currency_factor = $ip_currency;

}else {
$ip_check = mysqli_query($db,"SELECT * FROM customer WHERE email = '$user_email'");	
$ip_result = mysqli_fetch_assoc($ip_check);
$currency_factor = $ip_result['currency'];
}
}
$currency_rate = mysqli_query($db, "SELECT * FROM currency_rate WHERE country='$currency_factor'");
$currency_result = mysqli_fetch_assoc($currency_rate);
$currency = $currency_result['currency'];
if ($currency_factor == "rmb" or $currency_factor == "RMB") {
$symbol =  "¥";
} else {
$symbol =  "$";
}

mysqli_query($db, "DELETE FROM `order_id` WHERE status='Pending' AND exp_date < CURDATE()");	

$app_id = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM app_id"));
$app_id = $app_id['currency'];

$content=file_get_contents("https://openexchangerates.org/api/latest.json?app_id=$app_id");  // add your url which contains json file
$json = json_decode($content, true);
$json = $json['rates'];
// var_export($json);
$cny_value = $json['CNY'];
mysqli_query($db, "UPDATE currency_rate SET currency='$cny_value' WHERE country='rmb'");
?>

<!DOCTYPE html>
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
	<!--<![endif]-->

	<head>
		<meta charset="utf-8">
		<title>Health Supplements Plus</title>
		<meta name="description" content="Health Supplements Plus ">
		<meta name="author" content="HSP">

		<!-- Mobile Meta -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- Favicon -->
		<link rel="shortcut icon" href="../images/favicon.ico">

		<!-- Web Fonts -->
		<link href='https://fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic,500,500italic,700,700italic' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Raleway:700,400,300' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=PT+Serif' rel='stylesheet' type='text/css'>
		<link href="css/print-invoice.css" rel="stylesheet" media="print">

		<!-- Bootstrap core CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

		<!-- Font Awesome CSS -->
		<link href="../fonts/font-awesome/css/font-awesome.css" rel="stylesheet">

		<!-- Fontello CSS -->
		<link href="../fonts/fontello/css/fontello.css" rel="stylesheet">

		<!-- Plugins -->
		<link href="../plugins/magnific-popup/magnific-popup.css" rel="stylesheet">
		<link href="../plugins/rs-plugin/css/settings.css" rel="stylesheet">
		<link href="../css/animations.css" rel="stylesheet">
		<link href="../plugins/owl-carousel/owl.carousel.css" rel="stylesheet">
		<link href="../plugins/owl-carousel/owl.transitions.css" rel="stylesheet">
		<link href="../plugins/hover/hover-min.css" rel="stylesheet">
		
		<!-- the project core CSS file -->
		<link href="../css/style.css" rel="stylesheet" >

		<!-- Color Scheme (In order to change the color scheme, replace the blue.css with the color scheme that you prefer)-->
		<link href="../css/skins/purple.css" rel="stylesheet">

		<!-- Custom css --> 
		<link href="../css/custom.css" rel="stylesheet">
	</head>

	<!-- body classes:  -->
	<body class="no-trans">

		<!-- scrollToTop -->
		<!-- ================ -->
		<div class="scrollToTop circle"><i class="icon-up-open-big"></i></div>
		
		<!-- page wrapper start -->
		<!-- ================ -->
		<div class="page-wrapper">
				<!-- ================ -->
				<div class="header-top dark ">
					<div class="container">
						<div class="row">
							<div class="col-xs-3 col-sm-6 col-md-9">
								<!-- header-top-first start -->
								<!-- ================ -->
								<div class="header-top-first clearfix">
									<ul class="social-links circle small clearfix hidden-xs">
										<li class="twitter"><a target="_blank" href="http://www.wechat.com"><i class="fa fa-wechat"></i></a></li>
									</ul>
									<div class="social-links hidden-lg hidden-md hidden-sm circle small">
										<div class="btn-group dropdown">
											<button type="button" class="btn dropdown-toggle" data-toggle="dropdown"><i class="fa fa-wechat"></i></button>
											<ul class="dropdown-menu dropdown-animation">
												<li class="twitter"><a target="_blank" href="http://wechat.com"><i class="fa fa-wechat"></i></a></li>
											</ul>
										</div>
									</div>
									<ul class="list-inline hidden-sm hidden-xs">
										<li><i class="fa fa-phone pr-5 pl-10"></i>(403) 401-5701 </li>
										<li><i class="fa fa-envelope-o pr-5 pl-10"></i> admin@healthsupplementsplus.com</li>
									</ul>
								</div>
								<!-- header-top-first end -->
							</div>
							<div class="col-xs-9 col-sm-6 col-md-3">

								<!-- header-top-second start -->
								<!-- ================ -->
								<div id="header-top-second"  class="clearfix">

									<!-- header top dropdowns start -->
									<!-- ================ -->
									<div class="header-top-dropdown text-right" style="padding-top:4px;">
										<div class="btn-group dropdown">
										<select class="btn dropdown-toggle btn-default btn-sm currency_change">
											<option disabled>Currency:</option>
											<?
												if($currency_factor == "usd" or $currency_factor =="USD") { ?>
													<option value="usd" id="usd" selected>$USD</option>
													<option value="rmb" id="rmb">¥RMB</option>
											<?	} else {?>
													<option value="usd" id="usd" >$USD</option>
													<option value="rmb" id="rmb" selected>¥RMB</option>												
											<?}
											?>

											<input type="hidden" id="hidden_user" value="<?echo $user_email?>">
											<input type="hidden" id="hidden_ip" value="<?echo $ip?>">
											
										</select>
										</div>
									</div>
									<!--  header top dropdowns end -->
								</div>
								<!-- header-top-second end -->
							</div>
						</div>
					</div>
				</div>
				<!-- header-top end -->		
			<!-- header-container start -->
			<div class="header-container">
				<!-- header start -->
				<!-- classes:  -->
				<!-- "fixed": enables fixed navigation mode (sticky menu) e.g. class="header fixed clearfix" -->
				<!-- "dark": dark version of header e.g. class="header dark clearfix" -->
				<!-- "full-width": mandatory class for the full-width menu layout -->
				<!-- "centered": mandatory class for the centered logo layout -->
				<!-- ================ --> 
				<header class="header fixed full-width clearfix">
					
								<!-- header-right start -->
								<!-- ================ -->
								<div class="header-right clearfix">
									
								<!-- main-navigation start -->
								<!-- classes: -->
								<!-- "onclick": Makes the dropdowns open on click, this the default bootstrap behavior e.g. class="main-navigation onclick" -->
								<!-- "animated": Enables animations on dropdowns opening e.g. class="main-navigation animated" -->
								<!-- "with-dropdown-buttons": Mandatory class that adds extra space, to the main navigation, for the search and cart dropdowns -->
								<!-- ================ -->
								<div class="main-navigation  animated with-dropdown-buttons">

									<!-- navbar start -->
									<!-- ================ -->
									<nav class="navbar navbar-default" role="navigation">
										<div class="container-fluid">

											<!-- Toggle get grouped for better mobile display -->
											<div class="navbar-header">
												<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
													<span class="sr-only">Toggle navigation</span>
													<span class="icon-bar"></span>
													<span class="icon-bar"></span>
													<span class="icon-bar"></span>
												</button>
												
												<!-- header-left start -->
												<!-- ================ -->
												<div class="header-left clearfix">

													<!-- logo -->
													<div id="logo" class="logo">
														<a href="index.php"><img id="logo_img" src="images/logo_purple.png" width="150" height="35" alt="The Project"></a>
													</div>

													<!-- name-and-slogan -->
													<div class="site-slogan hidden-xs">
														Health Supplements Plus
													</div>

												</div>
												<!-- header-left end -->
												
											</div>

											<!-- Collect the nav links, forms, and other content for toggling -->
											<div class="collapse navbar-collapse" id="navbar-collapse-1">
												<!-- main-menu -->
												<ul class="nav navbar-nav navbar-right">

													<!-- mega-menu start -->													
													<li>
														<a href="index.php">Home</a>
													</li>
													<!-- mega-menu end -->
													
													<li class="dropdown ">
														<a class="dropdown-toggle" data-toggle="dropdown" href="#">Products</a>
														<ul class="dropdown-menu">
														<?
															while ($i < $row_count_catagory) {
																if ($sub[$i] == "0") {?>
																	<li ><a href="product.php?catagory=<?echo strtolower($name[$i]);?>&id=<?echo $id[$i]?>"><?echo $name[$i]?></a></li>
																<?	$i++;
																} else {?>
																	<li class="dropdown ">
																		<a  class="dropdown-toggle" data-toggle="dropdown" href="#"><?echo $name[$i]?></a>
																		<ul class="dropdown-menu">
																			<?
																			for ($j = 0; $j < $sub[$i] ; $j++) {?>
																				<?$sub_catagory = explode(",",$subname[$i]);?>
																				<li ><a href="product.php?catagory=<?echo strtolower($sub_catagory[$j]);?>&id=<?echo $id[$i]?>"><?echo $sub_catagory[$j]?></a></li>
																			<?}
																			?>
																		</ul>
																	</li>
																<?	$i++;
																}

															}
														?>
														</ul>
													</li>
													
													
													<?
													if(!empty($_SESSION['login_user']))
													{?>
													<li>
														<a id="change_num" href="mycart.php">My Cart (<?echo $cart_row?>)</a>
													</li>												
													<li class="dropdown"">
														<a class="dropdown-toggle" data-toggle="dropdown" href="#">Hi <?echo $user_fname;?><i class="fa fa-gear pr-10" style="padding-left:3px;"></i></a>
														<ul class="dropdown-menu ">
															<li>
																<a href="myaccount.php">My Account</a>
															</li>		
															<li>
																<a href="logout.php">Logout</a>
															</li>																
														</ul>
													</li>													
													
													<?} else {?>
													<li>
														<a href="signup.php">Sign Up</a>
													</li>														
													<li class="dropdown"">
														<a class="dropdown-toggle" data-toggle="dropdown" href="#">Login<i class="fa fa-lock pr-10" style="padding-left:3px;"></i></a>
														<ul class="dropdown-menu " style="padding:14px;">
														<form action="" class="login-form margin-clear contact" method="POST">
															<div class="form-group has-feedback">
																<label class="control-label">Username</label>
																<input type="text" class="form-control" id="username" name="username" autocomplete="off" placeholder="Email Address" required="required">
																<i class="fa fa-user form-control-feedback"></i>
															</div>
															<div class="form-group has-feedback">
																<label class="control-label">Password</label>
																<input type="password" class="form-control" id="password" name="password" autocomplete="off" placeholder="Password" required="required">
																<i class="fa fa-lock form-control-feedback"></i>
															</div>
															
															<input id="login" type="submit" class="btn btn-danger btn-sm" value="Log In">
															<span class='msg'></span>
															<div id="error"></div>	
															<a href="passwordreset.php">Forgot your password?</a>
														</form>														
														</ul>
													</li>
													<?}?>
		
												<!-- header dropdown buttons -->
												<div class="header-dropdown-buttons hidden-xs hidden-sm">
													<div class="btn-group dropdown">
														<button type="button" class="btn dropdown-toggle" data-toggle="dropdown"><i class="icon-search"></i></button>
														<ul class="dropdown-menu dropdown-menu-right dropdown-animation">
															<li>
																<form role="search" class="search-box margin-clear" action="search.php" method="GET">
																	<div class="form-group has-feedback">
																		<input type="text" name="keyword" class="form-control" placeholder="Search..."  autocomplete="off" required>
																		<i class="icon-search form-control-feedback"></i>
																	</div>
																</form>
															</li>
														</ul>
													</div>
												</div>
												<!-- header dropdown buttons end-->
												
											</div>

										</div>
									</nav>
									<!-- navbar end -->

								</div>
								<!-- main-navigation end -->	
								</div>
								<!-- header-right end -->					
				</header>
				<!-- header end -->
			</div>
			<!-- header-container end -->
