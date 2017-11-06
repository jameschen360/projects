<!DOCTYPE html>
<?
//Start our session.
session_start();
 
//Expire the session if user is inactive for 2
//hour or more.
$expireAfter = 120;
 
//Check to see if our "last action" session
//variable has been set.
if(isset($_SESSION['last_action'])){
    
    //Figure out how many seconds have passed
    //since the user was last active.
    $secondsInactive = time() - $_SESSION['last_action'];
    
    //Convert our minutes into seconds.
    $expireAfterSeconds = $expireAfter * 60;
    
    //Check to see if they have been inactive for too long.
    if($secondsInactive >= $expireAfterSeconds){
        //User has been inactive for too long.
        //Kill their session.
		$_SESSION['login_user']='';
        session_unset();
        session_destroy();
    }
    
}
 
//Assign the current timestamp as the user's
//latest activity
$_SESSION['last_action'] = time();

$user = $_SESSION['login_user'];
$user_query = mysqli_query($db,"SELECT * FROM user WHERE id='$user'") or die("Database connection error!");
$user_query_array = mysqli_fetch_assoc($user_query);
$fname = $user_query_array['fname'];
$lname = $user_query_array['lname'];
$auth = $user_query_array['auth'];
$position = $user_query_array['position'];
$username = $user_query_array['username'];
$supervisor = $user_query_array['supervisor'];

$revision = mysqli_query($db,"SELECT revision FROM revision") or die("Database connection error!");
$revision = mysqli_fetch_assoc($revision);
$revision = $revision['revision'];
?>

<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Page title -->
    <title>A4HC e-Business</title>

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	<link rel="shortcut icon" href="./favicon.ico" type="image/x-icon">
    <!--<link rel="shortcut icon" type="image/ico" href="favicon.ico" />-->

    <!-- Vendor styles -->
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.css" />
    <link rel="stylesheet" href="vendor/metisMenu/dist/metisMenu.css" />
    <link rel="stylesheet" href="vendor/animate.css/animate.css" />
    <link rel="stylesheet" href="vendor/bootstrap/dist/css/bootstrap.css" />
    <link rel="stylesheet" href="vendor/jquery-ui/themes/base/all.css" />
	
    <!-- App styles -->
    <link rel="stylesheet" href="fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css" />
    <link rel="stylesheet" href="fonts/pe-icon-7-stroke/css/helper.css" />
    <link rel="stylesheet" href="vendor/fullcalendar/dist/fullcalendar.print.css" media='print'/>
    <link rel="stylesheet" href="vendor/fullcalendar/dist/fullcalendar.min.css" />
	
	 
	<link rel="stylesheet" href="styles/sweetalert2.min.css">
	
	<link rel="stylesheet" href="./styles/remodal.css">
	<link rel="stylesheet" href="./styles/remodal-default-theme.css">	
	
    <link rel="stylesheet" href="vendor/bootstrap-datepicker-master/dist/css/bootstrap-datepicker3.min.css" />
    <link rel="stylesheet" href="vendor/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" />
    <link rel="stylesheet" href="vendor/clockpicker/dist/bootstrap-clockpicker.min.css" />
    <link rel="stylesheet" href="vendor/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" />	
    <link rel="stylesheet" href="vendor/summernote/dist/summernote.css" />
    <link rel="stylesheet" href="vendor/summernote/dist/summernote-bs3.css" />
	<link rel="stylesheet" href="vendor/xeditable/bootstrap3-editable/css/bootstrap-editable.css" />
	<link rel="stylesheet" href="vendor/toastr/build/toastr.min.css" />
	<link rel="stylesheet" href="styles/static_custom.css" />
	<link rel="stylesheet" href="vendor/select2-3.5.2/select2.css" />
    <link rel="stylesheet" href="vendor/select2-bootstrap/select2-bootstrap.css" />
	<link rel="stylesheet" href="styles/custom.css">
	<script src="vendor/jquery/dist/jquery.min.js"></script>
	<script src="vendor/jquery-ui/jquery-ui.min.js"></script>
	<script src="js_custom/sweetalert2.min.js"></script>
	<script src="js_custom/loadingoverlay.min.js"></script>
	<script src="vendor/toastr/build/toastr.min.js"></script>

	
	<script src="js_custom/inactive_check.js"></script>
	<script src="js_custom/remodal.min.js"></script>
	<script src="vendor/select2-3.5.2/select2.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.debug.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/2.3.2/jspdf.plugin.autotable.js"></script>
	
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

</head>
<?
if ($auth=="regular") {?>
	<body class="fixed-navbar hide-sidebar reload_table">
<?}else{?>
	<body class="fixed-navbar fixed-sidebar reload_table">
<?}?>


<!-- Header -->
<div id="header">
    <div class="color-line-green">
    </div>
	<?
	if ($auth == "super" or $auth == "admin") {?>
		<div class="header-link hide-menu"><i class="fa fa-bars"></i></div>		
	<?
	}
	?>
		<?
		if ($auth == "regular") {?>
		<div id="logo" class="light-version">
			<span>		
            <a class="" href="./">Welcome, <?echo "$fname $lname";?></a>	
			</span>
		</div>			
		<?
		}elseif ($auth == "super") {?> 
			<a class="" href="./"><div id="logo" class="light-version"><strong>Dashboard</strong></div></a>
		<?}else {?>
			<a class="" href="./"><div id="logo" class="light-version"><strong>Admin Dashboard</strong></div></a>				
		<?
		}
		?>

    <nav role="navigation">

        <div class="small-logo">
            <span class="text-primary" style="padding-left:23px;">
				<?
				if ($auth == "regular") {?>
					Welcome, <?echo "$fname $lname";?>			
				<?
				}elseif ($auth == "super") {?>
					<a class="" href="./">Dashboard</a>
				<?}else {?> 
					<a class="" href="./">Admin Dashboard</a>
				<?
				}
				?>			
			</span>
        </div>

        <div class="mobile-menu">
            <button type="button" class="navbar-toggle mobile-menu-toggle" data-toggle="collapse" data-target="#mobile-collapse">
                <i class="fa fa-chevron-down"></i>
            </button>
            <div class="collapse mobile-navbar" id="mobile-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a class="" href="./">Home</a>
                    </li>				
                    <li>
                        <a class="" href="#" data-remodal-target="profile_modal">Profile</a>
                    </li>
					<?
					if ($auth == "admin") {?>
                    <li>
                        <a class="" href="#" data-remodal-target="emailing_modal">Emailing Service</a>
                    </li>								
					<?}
					?>					
                    <li>
                        <a href="#" id="sidebar" class="right-sidebar-toggle label-menu-corner">Notifications 
						<?
							//new stuff notification
							$sidebar_query = mysqli_query($db, "SELECT * FROM notification WHERE supervisor_id='$user' AND supervisor_viewed='no'");
							$sidebar_num = mysqli_num_rows($sidebar_query);	
							
							//approved or rejected notification
							$sidebar_query2 = mysqli_query($db, "SELECT * FROM notification WHERE user_id='$user' AND supervisor_viewed='yes' AND final_status<>'complete'");
							$sidebar_num2 = mysqli_num_rows($sidebar_query2);

							$notification_total_num = $sidebar_num + $sidebar_num2;
							if ($notification_total_num != 0) {?>
								<span class="notification_count">(<?echo $notification_total_num?>)</span>
						<?	}
						?>
						</a>
                    </li>
					<li>
						<a href="./mytimesheet"> <span class="nav-label label-menu-approval-sub">Timesheets </span> </a>
					</li>
					<li>
						<a href="./expenseclaim"> <span class="nav-label label-menu-approval-sub">Expense Claim</span> </a>
					</li>
					<li>
						<a href="./myvacation"> <span class="nav-label label-menu-approval-sub">Timeoff</span> </a>
					</li>
					<li>
						<a href="./myovertime"> <span class="nav-label label-menu-approval-sub">Overtime</span> </a>
					</li>					
                    <li>
                        <a class="" href="./logout">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="navbar-right">
            <ul class="nav navbar-nav no-borders">						
                <li>
                    <a href="#" id="sidebar" class="right-sidebar-toggle label-menu-corner">
                        <i class="pe-7s-news-paper"></i>
						
						<?
							//new stuff notification
							$sidebar_query = mysqli_query($db, "SELECT * FROM notification WHERE supervisor_id='$user' AND supervisor_viewed='no'");
							$sidebar_num = mysqli_num_rows($sidebar_query);	
							
							//approved or rejected notification
							$sidebar_query2 = mysqli_query($db, "SELECT * FROM notification WHERE user_id='$user' AND supervisor_viewed='yes' AND final_status<>'complete'");
							$sidebar_num2 = mysqli_num_rows($sidebar_query2);

							$notification_total_num = $sidebar_num + $sidebar_num2;
							if ($notification_total_num != 0) {?>
								<span class="label label-danger notification_count"><?echo $notification_total_num?></span>
							<?}
						?>									
						
                    </a>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                        <i class="pe-7s-keypad"></i>
                    </a>

                    <div class="dropdown-menu hdropdown bigmenu animated flipInX">
                        <table>
                            <tbody>
                            <tr>
                                <td>
									<a href="./" title="Home Page (Dashboard)" data-toggle="tooltip1" data-placement="bottom" >
										<i class="fa fa-home text-success"></i>
										<h5>Dashboard</h5>
									</a>
                                </td>
                                <td>
									<a href="./mytimesheet" data-toggle="tooltip1" data-placement="bottom" title="Timesheets">
										<i class="fa fa-calendar-check-o text-success"></i>
										<h5>My Timesheet</h5>
									</a>
                                </td>
                                <td>
									<a href="./expenseclaim" data-toggle="tooltip1" data-placement="bottom" title="Expense Claim">
										<i class="fa fa-dollar text-success"></i>
										<h5>Expense Claim</h5>
									</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
									<a href="./myvacation" data-toggle="tooltip1" data-placement="bottom" title="My Time Off">
										<i class="fa fa-smile-o text-success"></i>
										<h5>My Time Off</h5>
									</a>
                                </td>
                                <td>
									<a href="./myovertime" data-toggle="tooltip1" data-placement="bottom" title="My Overtime">
										<i class="fa fa-clock-o text-success"></i>
										<h5>My Overtime</h5>
									</a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </li>				
                <li class="dropdown">
                    <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                        <i class="fa fa-user"></i>
                    </a>
                    <div class="dropdown-menu hdropdown bigmenu animated flipInX">
                        <table>
                            <tbody>
                            <tr>
                                <td>
                                    <a href="#" data-remodal-target="profile_modal">
                                        <i class="fa fa-cogs"></i>
                                        <h5>Profile</h5>
                                    </a>
                                </td>
							<?
							if ($auth == "admin") {?>
                                <td>
                                    <a href="#" data-remodal-target="emailing_modal">
                                        <i class="fa fa-at"></i>
                                        <h5>Emailing Service</h5>
                                    </a>
                                </td>								
							<?}
							?>		
                                <td>
                                    <a href="./logout">
                                        <i class="fa fa-sign-out"></i>
                                        <h5>Logout</h5>
                                    </a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </li>				
            </ul>
        </div>
    </nav>
</div>

<!-- Navigation -->
<?
if ($auth=="regular") {
}else{?>
	
<aside id="menu">
    <div id="navigation">
        <div class="profile-picture">	
            <div class="stats-label text-color">
                <span class="font-extra-bold font-uppercase"><?echo "$fname $lname";?><br/></span>
                <small class="text-muted"><?echo $position;?></small>
            </div>
        </div>

        <ul class="nav" id="side-menu">
			<li>
				<a href="./"> <span class="nav-label">Home </span> </a>
			</li>
			<?
			if ($auth=="admin") {?>
            <li>
                <a href="#"><span class="nav-label label-menu-approval">Administration</span><span class="fa arrow"></span> </a>
                <ul class="nav nav-second-level">
					<li>
						<a href="./employees"> <span class="nav-label">Employees</span> </a>
					</li>
					<li>
						<a href="./accounting"> <span class="nav-label">Expense Codes</span> </a>
					</li>
					<li>
						<a href="./projects"> <span class="nav-label">Project Management</span> </a>
					</li>
					<li>
						<a href="./payees"> <span class="nav-label">Payees</span> </a>
					</li>	
                </ul>
            </li>				
			<?
			}
			?>
			<?
			if ($auth == "admin") {			
				$total_notifications = mysqli_query($db, "SELECT * FROM notification WHERE supervisor_viewed='no'");
				$total_num = mysqli_num_rows($total_notifications);
				
				$total_notifications_time = mysqli_query($db, "SELECT * FROM notification WHERE supervisor_viewed='no' AND task='timesheet'");
				$total_num_time = mysqli_num_rows($total_notifications_time);

				$total_notifications_expense = mysqli_query($db, "SELECT * FROM notification WHERE supervisor_viewed='no' AND task='expense'");
				$total_num_expense = mysqli_num_rows($total_notifications_expense);	

				$total_notifications_vacation = mysqli_query($db, "SELECT * FROM notification WHERE supervisor_viewed='no' AND task='vacation'");
				$total_num_vacation = mysqli_num_rows($total_notifications_vacation);

				$total_notifications_overtime = mysqli_query($db, "SELECT * FROM notification WHERE supervisor_viewed='no' AND task='overtime'");
				$total_num_overtime = mysqli_num_rows($total_notifications_overtime);					
		
			?>
			<li>
                <a href="#"><span class="nav-label label-menu-approval">Approvals
				<?
				if ($total_num != 0) {?>
					<span class="label label-danger"><?echo $total_num?></span>
				<?}
				?>

				</span><span class="fa arrow"></span> </a>
                <ul class="nav nav-second-level">
					<li>
						<a href="./timesheetapproval"> <span class="nav-label label-menu-approval-sub">Timesheets
						<?
						if ($total_num_time != 0) {?>
							<span class="label label-primary"><?echo $total_num_time?></span>
						<?}
						?>						
						</span> </a>
					</li>
					<li>
						<a href="./expenseapproval"> <span class="nav-label label-menu-approval-sub">Expense Claim
						<?
						if ($total_num_expense != 0) {?>
							<span class="label label-info"><?echo $total_num_expense?></span>
						<?}
						?>							
						</span> </a>
					</li>
					<li>
						<a href="./vacationapproval"> <span class="nav-label label-menu-approval-sub">Time Off
						<?
						if ($total_num_vacation != 0) {?>
							<span class="label label-success"><?echo $total_num_vacation?></span>
						<?}
						?>
						</span> </a>
					</li>
					<li>
						<a href="./overtimeapproval"> <span class="nav-label label-menu-approval-sub">Overtime
						<?
						if ($total_num_overtime != 0) {?>
							<span class="label label-warning"><?echo $total_num_overtime?></span>
						<?}
						?>
						</span> </a>
					</li>	
                </ul>
            </li>			
			<?
			}
			?>
			<?
			if ($auth == "super") {			
				$total_notifications = mysqli_query($db, "SELECT * FROM notification WHERE supervisor_viewed='no' AND supervisor_id='$user'");
				$total_num = mysqli_num_rows($total_notifications);
				
				$total_notifications_time = mysqli_query($db, "SELECT * FROM notification WHERE supervisor_viewed='no' AND task='timesheet' AND supervisor_id='$user'");
				$total_num_time = mysqli_num_rows($total_notifications_time);

				$total_notifications_expense = mysqli_query($db, "SELECT * FROM notification WHERE supervisor_viewed='no' AND task='expense' AND supervisor_id='$user'");
				$total_num_expense = mysqli_num_rows($total_notifications_expense);	

				$total_notifications_vacation = mysqli_query($db, "SELECT * FROM notification WHERE supervisor_viewed='no' AND task='vacation' AND supervisor_id='$user'");
				$total_num_vacation = mysqli_num_rows($total_notifications_vacation);

				$total_notifications_overtime = mysqli_query($db, "SELECT * FROM notification WHERE supervisor_viewed='no' AND task='overtime' AND supervisor_id='$user'");
				$total_num_overtime = mysqli_num_rows($total_notifications_overtime);					
		
			?>
			<li>
                <a href="#"><span class="nav-label label-menu-approval">Approvals
				<?
				if ($total_num != 0) {?>
					<span class="label label-danger"><?echo $total_num?></span>
				<?}
				?>

				</span><span class="fa arrow"></span> </a>
                <ul class="nav nav-second-level">
					<li>
						<a href="./timesheetapproval"> <span class="nav-label label-menu-approval-sub">Timesheets
						<?
						if ($total_num_time != 0) {?>
							<span class="label label-primary"><?echo $total_num_time?></span>
						<?}
						?>						
						</span> </a>
					</li>
					<li>
						<a href="./expenseapproval"> <span class="nav-label label-menu-approval-sub">Expense Claim
						<?
						if ($total_num_expense != 0) {?>
							<span class="label label-info"><?echo $total_num_expense?></span>
						<?}
						?>							
						</span> </a>
					</li>
					<li>
						<a href="./vacationapproval"> <span class="nav-label label-menu-approval-sub">Vacation
						<?
						if ($total_num_vacation != 0) {?>
							<span class="label label-success"><?echo $total_num_vacation?></span>
						<?}
						?>
						</span> </a>
					</li>
					<li>
						<a href="./overtimeapproval"> <span class="nav-label label-menu-approval-sub">Overtime
						<?
						if ($total_num_vacation != 0) {?>
							<span class="label label-warning"><?echo $total_num_overtime?></span>
						<?}
						?>
						</span> </a>
					</li>	
                </ul>
            </li>			
			<?
			}
			?>				
        </ul>
    </div>
<footer class="footer" style="text-align:center;">
    <a href="#" data-remodal-target="revision"><small>Release Version 1.01</small></a>
</footer>	
</aside>
<?}
?>
<?include("inc/right_sidebar.php");?>

<?
$user_query = mysqli_query($db, "SELECT * FROM user WHERE id='$user'");
$user_array = mysqli_fetch_assoc($user_query);

$user_email = $user_array['username'];
$user_fname = $user_array['fname'];
$user_lname = $user_array['lname'];

$user_detailed_info_query = mysqli_query($db, "SELECT * FROM employee_info WHERE user_id='$user'");
$user_detailed_info_array = mysqli_fetch_assoc($user_detailed_info_query);

$sin = $user_detailed_info_array['sin'];
$dob = $user_detailed_info_array['dob'];
$user_address = $user_detailed_info_array['address'];
$user_city = $user_detailed_info_array['city'];
$user_province = $user_detailed_info_array['province'];
$user_postal = $user_detailed_info_array['p_code'];
$user_home_phone = $user_detailed_info_array['h_phone'];
$user_cell_phone = $user_detailed_info_array['m_phone'];

$emergency_query = mysqli_query($db, "SELECT * FROM emergency_contact WHERE user_id='$user'");
$emergency_array = mysqli_fetch_assoc($emergency_query);

$emergency_name = $emergency_array['full_name'];
$emergency_hphone = $emergency_array['home_phone'];
$emergency_cphone = $emergency_array['cell_phone'];
$emergency_address = $emergency_array['address'];

$medical_query = mysqli_query($db, "SELECT * FROM medical_info WHERE user_id='$user'");
$medical_array = mysqli_fetch_assoc($medical_query);

$medical_number = $medical_array['health_care_number'];
$medical_name = $medical_array['doctor_name'];
$medical_phone = $medical_array['phone'];
$medical_address = $medical_array['address'];
?>
<!-- profile -->
	<div class="remodal-bg">
		<div class="remodal" data-remodal-id="profile_modal" data-remodal-options="hashTracking: false, closeOnOutsideClick: false">
				<div class="color-line"></div>
				<div class="modal-header">
					<h4 class="modal-title">User Settings</h4>
				</div>
				<div class="modal-body">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#personal-tab" data-toggle="tab">Personal Information</a></li>
						<li><a href="#emergency-tab" data-toggle="tab">Emergency Contact</a></li>
						<li><a href="#medical-tab" data-toggle="tab">Medical Information</a></li>
						<li><a href="#contract-tab" data-toggle="tab">Contract Information</a></li>
					</ul>
						<div class="tab-content">
							<div class="tab-pane active" id="personal-tab">
							<form id="p_info">
								<div class="form-group">
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<label class="control-label pull-left" for="fname">First Name: </label>
										<input id="" placeholder="Eg) James" type="text" value="<?echo $user_fname?>" class="user_box form-control pull-right
										" autocomplete="off" readonly disabled>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<label class="control-label pull-left" for="lname">Last Name: </label>
										<input id="" placeholder="Eg) Chen" type="text" value="<?echo $user_lname?>" class="user_box form-control" autocomplete="off" readonly disabled>
									</div>	
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<label class="control-label pull-left" for="sin">Social Insurance Number (SIN): </label>
										<input id="sin_u" placeholder="Eg) 999 999 999" type="text" value="<?echo $sin?>" class="user_box form-control" autocomplete="off"  readonly disabled>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<label class="control-label pull-left" for="dob">Date of Birth: </label>
										<input id="dob_u" placeholder="Eg) yyyy/mm/dd" type="text" value="<?echo $dob?>" class="user_box form-control" autocomplete="off">
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<label class="control-label pull-left" for="home_address">Home Address: </label>
										<input id="home_address_u" placeholder="Eg) 111 Silver Cres NW" type="text" value="<?echo $user_address?>" class="user_box form-control" autocomplete="off">
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<label class="control-label pull-left" for="city">City: </label>
										<input id="city_u" placeholder="Eg) Edmonton" type="text" value="<?echo $user_city?>" class="user_box form-control" autocomplete="off">
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<label class="control-label pull-left" for="province">Province:</label>
										<select id="province_u" class="province_select_u" style="width: 100%">
											<optgroup label="Provinces">
											<?
											$province_query = mysqli_query($db, "SELECT province FROM province ORDER BY province asc");
											while($province_array = mysqli_fetch_assoc($province_query)) {
												$province = $province_array['province'];
												
												$check_result = mysqli_num_rows(mysqli_query($db, "SELECT province FROM employee_info WHERE province='$province' AND user_id='$user'"));
												if ($check_result == 1) {?>
													<option value="<?echo $province?>" selected="selected"><?echo $province?></option>
											<?	}else {?>
													<option value="<?echo $province?>"><?echo $province?></option>
											<?	}
												
											?>
													
											<?}?>
											</optgroup>
										</select>
									</div>	
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<label class="control-label pull-left" for="postal">Postal Code: </label>
										<input id="postal_u" placeholder="Eg) T7Y 0K8" type="text" value="<?echo $user_postal?>" class="user_box form-control" autocomplete="off">
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<label class="control-label pull-left" for="personal_hphone">Home Phone: </label>
										<input id="hphone_u" placeholder="Eg) (780) 999-9999" type="text" value="<?echo $user_home_phone?>" class="user_box form-control phone_mask" autocomplete="off">
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<label class="control-label pull-left" for="personal_cphone">Cell Phone: </label>
										<input id="personal_cphone_u" placeholder="Eg) (780) 999-9999" type="text" value="<?echo $user_cell_phone?>" class="user_box form-control phone_mask" autocomplete="off">
									</div>
									<div class="col-lg-12">
										<label class="control-label pull-left" for="email">Email (Login Username): </label>
										<input id="" placeholder="Eg) bob.manning@gmail.com" type="text" value="<?echo $user_email?>" class="user_box form-control" autocomplete="off" readonly disabled>
									</div>									
									<div class="col-lg-12">
										<label class="control-label pull-left" for="password1">Password: </label>
										<input id="password1_u" placeholder="*********" type="password" value="" class="user_box form-control" autocomplete="off">
									</div>
									<div class="col-lg-12">
										<label class="control-label pull-left" for="password2">Repeat Password: </label>
										<input id="password2_u" placeholder="*********" type="password" value="" class="user_box form-control" autocomplete="off">
									</div>										
									<div class="row" style="padding:25px;">
									</div>
									<div class="row">
										<button type="button" class="btn btn-default close_main" data-remodal-action="close">Close</button>
										<button type="button" id="personal_save" class="btn btn-success">Save Personal Information</button>	
									</div>									
								</div>
							</form>						
							</div>

							
							<div class="tab-pane" id="emergency-tab">
							<form id="emergency_form">
								<div class="form-group">
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<label class="control-label pull-left" for="emergency_fullname">Full Name: </label>
										<input id="fullname_emergency_u" placeholder="Eg) James Chen" type="text" value="<?echo $emergency_name?>" class="user_box form-control pull-right
										" autocomplete="off">
									</div>	
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<label class="control-label pull-left" for="emergency_address">Address: </label>
										<input id="emergency_address_u" placeholder="Eg) 111 Silver Cres NW" type="text" value="<?echo $emergency_address?>" class="user_box form-control pull-right
										" autocomplete="off">
									</div>	
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<label class="control-label pull-left" for="emergency_hphone">Home Phone: </label>
										<input id="emergency_hphone_u" placeholder="Eg) (780) 999-9999" type="text" value="<?echo $emergency_hphone?>" class="user_box form-control pull-right phone_mask
										" autocomplete="off">
									</div>	
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<label class="control-label pull-left" for="emergency_cphone">Cell Phone: </label>
										<input id="emergency_cphone_u" placeholder="Eg) (780) 999-9999" type="text" value="<?echo $emergency_cphone?>" class="user_box form-control pull-right phone_mask
										" autocomplete="off">
									</div>									
								</div>
								<div class="row" style="padding:25px;">
								</div>								
								<div class="row">
									<button type="button" class="btn btn-default close_main" data-remodal-action="close">Close</button>
									<button type="button" id="emergency_save" class="btn btn-success">Save Emergency Information</button>	
								</div>	
							</form>
							</div>
							
							<div class="tab-pane" id="medical-tab">
							<form id="medical_form">
								<div class="form-group">
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<label class="control-label pull-left" for="health_number">Provincial Health Care #: </label>
										<input id="health_care_number" placeholder="Eg) 12345-0000" type="text" value="<?echo $medical_number?>" class="user_box form-control pull-right
										" autocomplete="off">
									</div>	
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<label class="control-label pull-left" for="doctor">Family Doctor Full Name: </label>
										<input id="doctor_fullname_u" placeholder="Eg) James Chen" type="text" value="<?echo $medical_name?>" class="user_box form-control pull-right
										" autocomplete="off">
									</div>	
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<label class="control-label pull-left" for="doctor_address">Address: </label>
										<input id="doctor_address_u" placeholder="Eg) 111 Silver Cres NW" type="text" value="<?echo $medical_address?>" class="user_box form-control pull-right
										" autocomplete="off">
									</div>	
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<label class="control-label pull-left" for="doctor_phone">Phone: </label>
										<input id="doctor_phone_u" placeholder="Eg) (780) 999-9999" type="text" value="<?echo $medical_phone?>" class="user_box form-control pull-right phone_mask
										" autocomplete="off">
									</div>									
								</div>
								<div class="row" style="padding:25px;">
								</div>								
								<div class="row">
									<button type="button" class="btn btn-default close_main" data-remodal-action="close">Close</button>
									<button type="button" id="medical_save" class="btn btn-success">Save Medical Information</button>	
								</div>
							</form>
							</div>

							<div class="tab-pane" id="contract-tab">
								<div class="form-group">
								<?
								$contract_user_result = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM contract_pdf WHERE user_id='$user'"));
								$contract_pdf_location = $contract_user_result['pdf_location'];								
								?>
									<iframe width="100%;" height="500px;" frameborder="0" src="./pdf_view/pdf_view.php?task=contract&path=<?echo $contract_pdf_location?>"></iframe>
								</div>
								<div class="row" style="padding:25px;">
								</div>								
								<div class="row">
									<button type="button" class="btn btn-default close_main" data-remodal-action="close">Close</button>
								</div>		
							</div>							
							
						</div>
				</div>
		</div><!-- tab-content -->
	</div> <!-- /form -->
<!-- revision control -->
	<div class="remodal-bg">
		<div class="remodal" data-remodal-id="revision" data-remodal-options="hashTracking: false, closeOnOutsideClick: true">
		<button data-remodal-action="close" class="remodal-close"></button>
				<div class="modal-body">
					<?
					if ($username == "jxchen@live.ca" ) {?>
						<div id="revision_edit"><?echo $revision;?></div>	
						<button type="button" id="update_revision" class="btn btn-success">Submit</button><hr/>
					<?}else {?>
						<div>
						<?echo $revision;?>
						</div>
						

					<?}
					?>
				</div>			
				
		</div>
	</div>
	
<!-- emailing modal -->	
	<div class="remodal-bg">
		<div class="remodal" data-remodal-id="emailing_modal" data-remodal-options="hashTracking: false, closeOnOutsideClick: false">
			<div class="color-line"></div>
			<div class="modal-header">
				<h4 class="modal-title">Automated Emailing Account</h4>
			</div>		
			<div class="modal-body">
				<form id="emailing_info">
					<div class="form-group row">								
						<div class="col-lg-12">
							<?
								$auto_email_result = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM automsg_email"));
								$email = $auto_email_result['email'];
								$pwd = $auto_email_result['pwd'];
							?>
							
							<label class="control-label pull-left" for="emailing_auto_name">Automated Email: </label>
							<input id="emailing_auto_name" placeholder="Eg) no-reply@gmail.com" type="text" value="<?echo $email?>" class="user_box form-control" autocomplete="off">
						</div>
						<div class="col-lg-12">
							<label class="control-label pull-left" for="passwor_emailing">Automated Email Password: </label>
							<input id="passwor_emailing" placeholder="*********" type="password" value="<?echo $pwd?>" class="user_box form-control" autocomplete="off">
						</div>
					</div>
					<p class="text-danger">Do not change this without permission.</p>
					
					<p>Automated emailing system can only be used with Google associated accounts. Please follow the three links below to fully activate emailing mode with the associated account.</p>
					<h4 class="text-info"><a href="https://www.google.com/settings/u/1/security/lesssecureapps">Google Less Secure Apps</a><br/>
					<a href="https://accounts.google.com/b/0/DisplayUnlockCaptcha">Google Unlock Captcha</a><br/>
					<a href="https://security.google.com/settings/security/activity?hl=en&pli=1">Google Security Device Monitor</a><br/></h4>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default close_main_email" data-remodal-action="close">Close</button>
				<button type="button" id="emailing_save" class="btn btn-success">Save Settings</button>
			</div>				
		</div>
	</div>	
	
	
<script src="vendor/summernote/dist/summernote.min.js"></script>
<script src="js_custom/revision.js"></script>
<script src="js_custom/form_helper.js"></script>
<script src="js_custom/user_settings.js"></script>
<script src="js_custom/auto_email.js"></script>
<input type="hidden" id="user_id_settings" value="<?echo $user?>"/>
<?
if ($username == "jxchen@live.ca") {?>
<script>
    $(function () {
        $('#revision_edit').summernote({
			placeholder: '',
			  height: 400,                 // set editor height
			  minHeight: null,             // set minimum height of editor
			  maxHeight: null,             // set maximum height of editor
			  focus: true,
            toolbar: [
                ['headline', ['style']],
                ['style', ['bold', 'italic', 'underline', 'superscript', 'subscript', 'strikethrough', 'clear']],
                ['textsize', ['fontsize']],
                ['alignment', ['ul', 'ol', 'paragraph', 'lineheight']],
            ]

        });	
		
		$('[data-toggle="tooltip1"]').tooltip(); 			
		
    });
</script>
	
	
<?}
?>
<script>
    $(function () {	
		
		$('[data-toggle="tooltip1"]').tooltip(); 
		$(".province_select_u").select2();	
		
		$("#sin_u").mask("999-999-999");		
		$("#dob_u").mask("9999/99/99");		
		$(".phone_mask").mask("(999) 999-9999");		
		$("#postal_u").mask("S9S 9S9");		
		$("#health_care_number").mask("99999-9999");		
		
    });
</script>
