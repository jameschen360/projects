<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="#F5BC4B">

    <!-- Page title -->
    <title>Springbank Delivery | Shopping List</title>

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <link rel="icon" href="../favicon.ico" type="image/x-icon">

    <!-- Vendor styles -->
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.css" />
    <link rel="stylesheet" href="vendor/metisMenu/dist/metisMenu.css" />
    <link rel="stylesheet" href="vendor/animate.css/animate.css" />
    <link rel="stylesheet" href="vendor/bootstrap/dist/css/bootstrap.css" />
    <link rel="stylesheet" href="vendor/bootstrap-tour/build/css/bootstrap-tour.min.css" />
    <link rel="stylesheet" href="vendor/toastr/build/toastr.min.css" />
    <link rel="stylesheet" href="vendor/sweetalert2/sweetalert2.min.css" />

    <!-- App styles -->
    <link rel="stylesheet" href="fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css" />
    <link rel="stylesheet" href="fonts/pe-icon-7-stroke/css/helper.css" />
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/static_custom.css">
    <link rel="stylesheet" href="remodal/remodal.css">
    <link rel="stylesheet" href="remodal/remodal-default-theme.css">

</head>
<body class="fixed-navbar fixed-sidebar hide-sidebar">

<!-- Simple splash screen-->
<div class="splash"><div class="splash-title"><h1>Springbank Delivery Loading...</h1><div class="spinner"> <div class="rect1"></div> <div class="rect2"></div> <div class="rect3"></div> <div class="rect4"></div> <div class="rect5"></div> </div> </div> </div>
<!--[if lt IE 7]>
<p class="alert alert-danger">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<!-- Header -->
<div id="header">
    <div class="color-line">
    </div>
    <div id="logo" class="light-version">
        <span id="usernameGreet"></span>
    </div>
    <nav role="navigation">
        <div class="small-logo">
            <a href="../../"><span class="text-primary">Springbank Delivery</span></a>
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
                    <a id="previous_small" class="right-sidebar-toggle" style="cursor: pointer">Previous Order</a>
                </li>
                <li>
                    <a id="user_small" class="right-sidebar-toggle" style="cursor: pointer">User Settings</a>
                </li>
                <li>
                    <a id="resetShoppingList_small" class="" style="cursor: pointer">Reset Shopping List</a>
                </li>
                <li>
                    <a href="sblogout" style="cursor: pointer">Logout</a>
                </li>
            </ul>
        </div>
    </div>
        <div class="navbar-right">
            <ul class="nav navbar-nav no-borders">
                <li>
                    <a href="../../">
                        <i class="pe-7s-home"></i>
                    </a>
                </li>
                <li>
                    <a href="#" id="resetShoppingList_main" class="" data-toggle="tooltip" data-placement="bottom" title="Reset Shopping List">
                        <i class="pe-7s-refresh"></i>
                    </a>
                </li>
                <li>
                    <a href="#" id="previous_main" class="right-sidebar-toggle" data-toggle="tooltip" data-placement="bottom" title="Previous Orders">
                        <i class="pe-7s-notebook"></i>
                    </a>
                </li>
                <!-- <li>
                    <a href="#" class="run-tour">
                        Take A Tour!
                    </a>
                </li> -->
                <li>
                    <a href="#" id="user_main" class="right-sidebar-toggle user_main" data-toggle="tooltip" data-placement="bottom" title="User Settings">
                        <i class="pe-7s-users"></i>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="sblogout">
                        <i class="pe-7s-power"></i>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</div>
