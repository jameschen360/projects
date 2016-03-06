<?php
include("inc/db.php");
$user  = $_SESSION['login_user'];
$user_check = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM customer WHERE id='$user'"));
$user_admin = $user_check['admin'];

if ($user_admin == 1 or $user_admin == 2) {
    header('Location: dashboard.php');
}else {?>
<!DOCTYPE html><!--[if IE 9 ]>    <html class="ie9" lang="en"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html lang="en" class="no-js"><!--<![endif]-->
  <head>
    <meta charset="utf-8">
    <title>HSP Admin Login</title>
    <meta name="description" content="Admin Login HSP">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Place favicon.ico and apple-touch-icon.png in the root directory-->
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="styles/vendor.css">
    <script src="scripts/vendor/modernizr.js"></script>
    <!-- GMaps api-->
    <script type="text/javascript" src="//maps.google.com/maps/api/js?sensor=true"></script>
  </head>
  <body>
    <div class="animated fadeOutZoom">
      <div class="container container-sm animated fadeInDown">
        <div class="center-block mt-xl">
          <h1 class="text-center">HSP Login Panel</h1>
          <div class="panel">
            <div class="panel-body">
              <p class="pv text-bold">LOGIN CREDENTIALS</p>
              <form role="form" class="mb-lg">
                <div class="row">
                  <div class="col-md-12">
                     <label>Username:</label>
                    <div class="form-group has-feedback mb">
                      <input id="exampleInputEmail1" type="text" autocomplete="off" class="form-control"><span class="fa fa-envelope form-control-feedback text-muted"></span>
                    </div><br>
                      <label>Password:</label>
                    <div class="form-group has-feedback">
                        
                      <input id="exampleInputPassword1" type="password" class="form-control"><span class="fa fa-lock form-control-feedback text-muted"></span>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <button type="button" id="login_admin" class="btn btn-block btn-info mb">Login</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <!-- END panel-->
        </div>
      </div>
    </div>
    <script src="scripts/vendor.js"></script>
    <script src="scripts/plugins.js"></script>
    <script src="scripts/main.js"></script>
  </body>
</html>
<?    
include("inc/scripts.php");
}
?>