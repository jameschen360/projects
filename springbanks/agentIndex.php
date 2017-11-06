
<!DOCTYPE html>
<?php
include("inc/db.php");
session_start();
date_default_timezone_set('America/Denver');

if(empty($_SESSION['admin_user'])) {
	echo "<meta http-equiv=\"refresh\" content=\"0; url=./agentlogin\">";
} else {
?>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Page title -->
    <title>Agents Home Page</title>

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <!--<link rel="shortcut icon" type="image/ico" href="favicon.ico" />-->

    <!-- Vendor styles -->
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.css" />
    <link rel="stylesheet" href="vendor/metisMenu/dist/metisMenu.css" />
    <link rel="stylesheet" href="vendor/animate.css/animate.css" />
    <link rel="stylesheet" href="vendor/bootstrap/dist/css/bootstrap.css" />
    <link rel="stylesheet" href="vendor/datatables.net-bs/css/dataTables.bootstrap.min.css" />
    <link rel="stylesheet" href="remodal/remodal.css">
    <link rel="stylesheet" href="remodal/remodal-default-theme.css">
    <link rel="stylesheet" href="vendor/toastr/build/toastr.min.css" />
    <link rel="stylesheet" href="styles/static_custom.css">
    <link rel="stylesheet" href="styles/admin.css">
    <link rel="stylesheet" href="vendor/sweetalert2/sweetalert2.min.css" />

    <!-- App styles -->
    <link rel="stylesheet" href="fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css" />
    <link rel="stylesheet" href="fonts/pe-icon-7-stroke/css/helper.css" />
    <link rel="stylesheet" href="styles/style.css">

</head>
<body class="fixed-navbar fixed-sidebar hide-sidebar">

<!-- Simple splash screen-->
<div class="splash"> <div class="color-line"></div><div class="splash-title"><h1>Agents Page Loading...</h1><div class="spinner"> <div class="rect1"></div> <div class="rect2"></div> <div class="rect3"></div> <div class="rect4"></div> <div class="rect5"></div> </div> </div> </div>
<!--[if lt IE 7]>
<p class="alert alert-danger">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<!-- Header -->
<div id="header">
<div class="color-line">
</div>
<div id="logo" class="light-version">
    <span id="usernameGreet">Agents Home Page</span>
</div>
<nav role="navigation">
    <div class="small-logo">
        <span class="text-primary">Agents Home Page</span>
    </div>
    <!-- <form role="search" class="navbar-form-custom" method="post" action="#">
        <div class="form-group">
            <input type="text" placeholder="Start your search here!" class="form-control resizedTextbox tour-1" name="search">
        </div>
    </form> -->
    <div class="mobile-menu">
    <button type="button" class="navbar-toggle mobile-menu-toggle" data-toggle="collapse" data-target="#mobile-collapse">
        <i class="fa fa-chevron-down"></i>
    </button>
    <div class="collapse mobile-navbar" id="mobile-collapse">
        <ul class="nav navbar-nav">
            <li>
                <a href="agentlogout" class="right-sidebar-toggle" style="cursor: pointer">Logout</a>
            </li>
        </ul>
    </div>
</div>
    <div class="navbar-right">
        <ul class="nav navbar-nav no-borders">
            <li class="dropdown">
                <a href="agentlogout">
                    <i class="pe-7s-power"></i>
                </a>
            </li>
        </ul>
    </div>
</nav>
</div>

<!-- Main Wrapper -->
<div id="wrapper">
    <div class="content animate-panel">
        <?php
            include('inc/admin/mainPage.php');
        ?>
    </div>
</div>



</div>

<!-- Under Construction -->
<div id="construction" class="remodal-bg">
    <div class="remodal product-modal-size" data-remodal-id="construction" data-remodal-options="hashTracking: false">
            <button data-remodal-action="close" class="remodal-close close-position" aria-label="Close"></button>
            <h1>Under Construction!!!! :D</h1>
    </div><!-- tab-content -->
</div> <!-- /form -->
<?
include('inc/admin/processingOrderModal.html');
include('inc/admin/deliveredOrderModal.html');
include('inc/admin/userModal.html');
?>
<!-- Vendor scripts -->
<script src="vendor/jquery/dist/jquery.min.js"></script>
<script src="vendor/jquery-ui/jquery-ui.min.js"></script>
<script src="vendor/slimScroll/jquery.slimscroll.min.js"></script>
<script src="vendor/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="vendor/metisMenu/dist/metisMenu.min.js"></script>
<script src="vendor/iCheck/icheck.min.js"></script>
<script src="vendor/sparkline/index.js"></script>
<script src="remodal/remodal.js"></script>
<!-- DataTables -->
<script src="vendor/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="vendor/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- DataTables buttons scripts -->
<script src="vendor/pdfmake/build/pdfmake.min.js"></script>
<script src="vendor/pdfmake/build/vfs_fonts.js"></script>
<script src="vendor/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="vendor/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="vendor/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="vendor/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="vendor/toastr/build/toastr.min.js"></script>
<script src="vendor/sweetalert2/sweetalert2.min.js"></script>

<!-- App scripts -->
<script src="scripts/homer.js"></script>
<script src="js_custom/toastrOptions.js"></script>
<script src="js_custom/admin/tables/processingTable.js"></script>
<script src="js_custom/admin/tables/deliveredTable.js"></script>
<script src="js_custom/admin/tables/userTable.js"></script>
<script src="js_custom/admin/tables/mainTable.js"></script>
<script src="js_custom/admin/cartEdit.js"></script>
<script src="js_custom/admin/submitOrderChange.js"></script>


<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@1.5.4/src/loadingoverlay.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@1.5.4/extras/loadingoverlay_progress/loadingoverlay_progress.min.js"></script>


<script>
</script>

</body>
</html>
<?php
}
?>