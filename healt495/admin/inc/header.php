<? include('db.php');
$user  = $_SESSION['login_user'];  
$user_check = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM customer WHERE id='$user'"));
$user_admin = $user_check['admin'];

if ($user_admin == 1 or $user_admin == 2) {?>
 <!DOCTYPE html><!--[if IE 9 ]>    <html class="ie9" lang="en"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html lang="en" class="no-js"><!--<![endif]-->
  <head>
    <meta charset="utf-8">
    <title>Health Supplements Plus</title>
    <meta name="description" content="admin content">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Place favicon.ico and apple-touch-icon.png in the root directory-->
    <link rel="stylesheet" href="./styles/main.css">
    <link rel="stylesheet" href="./styles/custom.css">
    <link rel="stylesheet" href="./styles/vendor.css">
    <link rel="stylesheet" href="./styles/datepicker.css">
    <link href="../css/print-invoice.css" rel="stylesheet" media="print">
    <script src="./scripts/vendor/modernizr.js"></script>
    <!-- GMaps api-->
    <script type="text/javascript" src="//maps.google.com/maps/api/js?sensor=true"></script>
  </head>
  <body class="layout-dock aside-offscreen layout-fixed">
    <!-- Main container-->
    <div class="app-container">
      <!-- top navbar-->
      <header class="bg-purple">
        <!-- START Top Navbar-->
        <nav role="navigation" class="navbar topnavbar">
          <!-- START button offset-->
          <!-- START button offset-->
          <!-- START navbar header-->
           <div class="navbar-header"><a href="dashboard.php" class="navbar-brand"> <img src="../images/logo_white.png" alt="App Logo" class="brand-logo"></a>
            <!-- Mobile buttons-->
            <div class="mobile-toggles">
              <!-- Button to show/hide the header menu on mobile. Visible on mobile only.--><a href="#nav-collapse" data-toggle="collapse" class="menu-toggle pull-left"><em class="fa fa-navicon fa-fw"></em></a>
            </div>
          </div>
          <!-- END navbar header-->
          <!-- START Nav wrapper-->
          <div id="nav-collapse" class="nav-wrapper collapse navbar-collapse">
            <!-- START Left navbar-->
            <ul class="nav navbar-nav">
              <li><a href="dashboard.php">Dashboard</a></li>    
			  <li><a href="catagory.php">Categories</a></li>
			  <li><a href="product.php">Products</a></li>
			  <li><a href="customer.php">Customers</a></li>
			  <li><a href="order.php">Orders</a></li>
              <li><a href="../index.php">Store Front</a></li>
			  <li class="hidden-lg hidden-md hidden-sm"><a href="logout.php">Log Out</a></li>
            </ul>
	
            <ul class="nav navbar-nav pull-right hidden-xs">
            <!-- START list item-->
			  <li><a href="logout.php">Log Out</a></li>
            </ul>

			</ul>            <!-- END Left navbar-->
          </div>
        </nav>
        <!-- END Top Navbar-->
        <script type="text/javascript">
          function resizeIframe(obj){
             obj.style.height = 0;
             obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
          }
        </script>
      </header>   
<?}else {
    header('Location: index.php');
    exit;
}
?>
