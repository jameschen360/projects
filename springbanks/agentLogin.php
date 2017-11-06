<?php
    session_start();
    date_default_timezone_set('America/Denver');
    if(!empty($_SESSION['admin_user'])) {
        echo "<meta http-equiv=\"refresh\" content=\"0; url=./agent\">";
              
    } else {?>

  
<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Page title -->
    <title>Agents Login</title>

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <!--<link rel="shortcut icon" type="image/ico" href="favicon.ico" />-->

    <!-- Vendor styles -->
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.css" />
    <link rel="stylesheet" href="vendor/metisMenu/dist/metisMenu.css" />
    <link rel="stylesheet" href="vendor/animate.css/animate.css" />
    <link rel="stylesheet" href="vendor/bootstrap/dist/css/bootstrap.css" />

    <!-- App styles -->
    <link rel="stylesheet" href="fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css" />
    <link rel="stylesheet" href="fonts/pe-icon-7-stroke/css/helper.css" />
    <link rel="stylesheet" href="styles/style.css">

</head>

<body class="blank">

<!--[if lt IE 7]>
<p class="alert alert-danger">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
        <div class="color-line"></div>
        <div class="login-container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center m-b-md">
                        <h3>SPRING BANK DELIVERY SERVICES</h3>
                        <small>Agents Login</small>
                    </div>
                    <div class="hpanel">
                        <div class="panel-body">
                            <div id="loginErrorMsg"></div>
                            <form action="#" id="loginForm">
                                <div class="form-group">
                                    <label class="control-label" for="username">Username</label>
                                    <input type="text" placeholder="example@gmail.com" title="Please enter you username" required="" id="username" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="password">Password</label>
                                    <input type="password" title="Please enter your password" placeholder="******" required="" id="password" class="form-control">
                                </div>
                                <button class="btn btn-warning btn-block" id="agentLogin">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>




<!-- Vendor scripts -->
<script src="vendor/jquery/dist/jquery.min.js"></script>
<script src="vendor/jquery-ui/jquery-ui.min.js"></script>
<script src="vendor/slimScroll/jquery.slimscroll.min.js"></script>
<script src="vendor/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="vendor/metisMenu/dist/metisMenu.min.js"></script>
<script src="vendor/iCheck/icheck.min.js"></script>
<script src="vendor/sparkline/index.js"></script>
<script src="js_custom/admin/login.js"></script>

<!-- App scripts -->
<script src="scripts/homer.js"></script>
</body>
</html>

<?php
}
?>