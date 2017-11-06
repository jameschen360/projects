<!DOCTYPE html>
<?
include("./inc/db.php");
session_start();
date_default_timezone_set('America/Denver');

$auto_email_result = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM automsg_email"));
$auto_email = $auto_email_result['email'];
$auto_pwd = $auto_email_result['pwd'];
$logo = $auto_email_result['logo'];

$ep_result = mysqli_query($db, "SELECT * FROM employee_info WHERE employee_type='Contract' AND contract_email_check IS NULL AND contract_end_date < DATE_ADD(CURDATE(), INTERVAL 30 DAY)");
$i=1;


while($a=mysqli_fetch_assoc($ep_result)){
	//echo explode("/",$a['contract_end_date'])[1];
	$user_id = $a['user_id'];
	
	
	
	$user_id_result = mysqli_query($db, "SELECT * FROM user WHERE id='$user_id'");
	//$email_result = mysqli_fetch_assoc($user_id_result);
	//$email_location = $email_result['username'];
		//echo $email_result;
		//echo $email_location;
	while($email_result = mysqli_fetch_assoc($user_id_result)){
		$email_location = $email_result['username'];
		$fname = $email_result['fname'];
		$lname = $email_result['lname'];
		$expiry_date = $a['contract_end_date'];
		$username_full = "$fname $lname";
		$username = $email_location;
		
			require_once("mail/class.phpmailer.php");//obtain mailer classes
			require("mail/email/contract_check_email.php");	//send for approval
		
		$update = mysqli_query($db, "UPDATE employee_info SET contract_email_check = 'sent' WHERE user_id='$user_id' ");
		
	}
	

}

if(!empty($_SESSION['login_user'])) {
	echo "<meta http-equiv=\"refresh\" content=\"0; url=./\">";
} else {
?>
 
 
 
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Page title -->
    <title>A4HC e-Business</title>

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
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
	<link rel="stylesheet" href="styles/custom.css">
	
	<link rel="stylesheet" href="styles/remodal.css">
	<link rel="stylesheet" href="styles/remodal-default-theme.css">	
	
	

</head>
<body class="blank">

<!-- Simple splash screen-->
<div class="splash"> <div class="color-line"></div><div class="splash-title"><h1>A4HC E-Business</h1><p>Loading...</p><div class="spinner"> <div class="rect1"></div> <div class="rect2"></div> <div class="rect3"></div> <div class="rect4"></div> <div class="rect5"></div> </div> </div> </div>
<!--[if lt IE 7]>
<p class="alert alert-danger">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<div class="color-line-green"></div>
<div id="login-panel" class="login-container">
    <div class="row">
        <div class="col-md-12">
            <div class="text-center m-b-md">
                <h3>A4HC Employee Login</h3>
            </div>
            <div class="hpanel">
                <div class="panel-body">
					<div id="error" style="text-align: center;"></div>
                        <form id="loginForm">
                            <div class="form-group">
                                <label class="control-label" for="username">Username</label>
                                <input type="text" placeholder="example@gmail.com" title="Please enter you username" required="" value="" name="username" id="username" class="form-control" oninvalid="this.setCustomValidity('Please Enter Valid Username')" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="password">Password</label>
                                <input type="password" placeholder="Please enter your password" required="" value="" name="password" id="password" class="form-control" oninvalid="this.setCustomValidity('Please Enter Valid Password')">
                            </div>
                            <button id="login" class="btn btn-success btn-block">Login</button>
							<button class="btn btn-default btn-block" type="button" data-toggle="modal" data-remodal-target="password_reset" href="#password_reset">Forgot Password?</button>
                        </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-center">
            <strong>Simplewebs Calgary Copyright &copy 2017</strong>
        </div>
    </div>
</div>

<div id="password-reset" class="login-container">
    <div class="row">
        <div class="col-md-12">
            <div class="text-center m-b-md">
                <h3>New Password Required</h3>
            </div>
            <div class="hpanel">
                <div class="panel-body">
				<h4 style="text-align: center;">Please update your password!</h4>
					<div id="error_pass" style="text-align: center;"></div>
                        <form id="passwordForm">
                            <div class="form-group">
                                <label class="control-label" for="password1">New Password</label>
                                <input type="password" placeholder="New Password" title="Passwords needs to contain a number/letter and longer than 9 characters. (0-9,a-z)" required="" value="" name="password1" id="password1" class="form-control" oninvalid="this.setCustomValidity('Please Enter Valid Password')" data-toggle="tooltip" data-placement="top" >
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="password2">Repeat Password</label>
                                <input type="password" placeholder="Repeat Password" required="" value="" name="password2" id="password2" class="form-control" oninvalid="this.setCustomValidity('Please Enter Valid Password')">
                            </div>
                            <button id="password-confirm" class="btn btn-success btn-block">Update Password</button>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="remodal-bg close_js">
		<div class="remodal login_remodal_size" data-remodal-id="password_reset" data-remodal-options="hashTracking: false, closeOnOutsideClick: true">
			  	<div class="color-line-green"></div>
				<div class="modal-header">
					<h4 class="modal-title">Reset Password</h4>
				</div>
				
				<div class="modal-body">
				<div class="row form-group">					
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="form-group reset_password_modal">
							<label class="control-label pull-left reset_password_modal">Username (E-mail)<i class="text-danger">*</i><span class="text-danger"></span></label>
							<input id="username_email" placeholder="Eg) abc@abc.com" type="text" value="" class="form-control type_info1 type_info" name="start">
						</div>
					</div>
				</div>
				<button id="password_confirm_submit" class="btn btn-success btn-block reset_password_modal">Reset Password</button>
				</div>
				

		</div>
	</div>
	
	

<input type="hidden" id="path" value="<?echo $_GET['path'];?>">
<input type="hidden" id="hash" value="<?echo $_GET['hash'];?>">
<input type="hidden" id="id" value="<?echo $_GET['id'];?>">
<link rel="stylesheet" href="styles/sweetalert2.min.css">

<!-- Vendor scripts -->
<script src="vendor/jquery/dist/jquery.min.js"></script>
<script src="vendor/jquery-ui/jquery-ui.min.js"></script>
<script src="vendor/slimScroll/jquery.slimscroll.min.js"></script>
<script src="vendor/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="vendor/metisMenu/dist/metisMenu.min.js"></script>
<script src="vendor/iCheck/icheck.min.js"></script>
<script src="vendor/sparkline/index.js"></script>
<script src="js_custom/remodal.min.js"></script>
<script src="vendor/moment/moment.js"></script>
<script src="js_custom/sweetalert2.min.js"></script>
<script src="js_custom/loadingoverlay.min.js"></script>

<!-- App scripts -->
<script src="scripts/homer.js"></script>

<!-- Custom scripts -->
<script src="js_custom/login_check.js"></script>
<script src="js_custom/login_reset.js"></script>
<script src="js_custom/update_password_initial.js"></script>
<script src="js_custom/contract_check.js"></script>
<script>
	$(document).ready(function(){
		$('[data-toggle="tooltip"]').tooltip(); 
	});
	
</script>
 
</body>
</html>
<?
}
?>