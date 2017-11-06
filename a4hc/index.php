<?
include("./inc/db.php");
session_start();
if(empty($_SESSION['login_user'])) {
	echo "<meta http-equiv=\"refresh\" content=\"0; url=./login\">";
} else {
	include('inc/header.php');
?>

<!-- Simple splash screen-->
<div class="splash"> <div class="color-line"></div><div class="splash-title"><h1>A4HC E-Business Dashboard</h1><p>Loading...</p><div class="spinner"> <div class="rect1"></div> <div class="rect2"></div> <div class="rect3"></div> <div class="rect4"></div> <div class="rect5"></div> </div> </div> </div>
<!--[if lt IE 7]>
<p class="alert alert-danger">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<!-- Main Wrapper -->
<div id="wrapper">
    <div class="content animate-panel">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                        <a href="./mytimesheet">
							<div class="hpanel">
								<div class="panel-body text-center hover-icon">
									<i class="fa fa-calendar-check-o fa-5x text-success" aria-hidden="true"></i>
									<div class="m-t-sm">
										<strong>My Timesheet</strong>
									</div>
								</div>
							</div>
						</a>	
                    </div>
					
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
						<a href="./expenseclaim">
							<div class="hpanel">
								<div class="panel-body text-center hover-icon">
									<i class="fa fa-usd fa-5x text-success" aria-hidden="true"></i>
									<div class="m-t-sm">
										<strong>Expense Claim</strong>
									</div>
								</div>
							</div>
						</a>	
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
						<a href="./myvacation">
							<div class="hpanel">
								<div class="panel-body text-center hover-icon">
									<i class="fa fa-smile-o fa-5x text-success" aria-hidden="true"></i>
									<div class="m-t-sm">
										<strong>My Time Off Request</strong>
									</div>
								</div>
							</div>
						</a>	
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
						<a href="./myovertime">
							<div class="hpanel">
								<div class="panel-body text-center hover-icon">
									<i class="fa fa-clock-o fa-5x text-success" aria-hidden="true"></i>
									<div class="m-t-sm">
										<strong>My Overtime Request</strong>
									</div>
								</div>
							</div>
						</a>	
                    </div>					
                </div>

        <div class="row">

            <div class="col-md-12">

                <div class="hpanel">

                    <div class="panel-body">

                        <p>
                            <strong>Recent Submissions</strong>
                        </p>

                        <div class="table-responsive">
                        <table class="table table-hover table-bordered table-striped">
                            <tbody>
							
							<?
							$recent_tasks_query = mysqli_query($db, "SELECT * FROM notification WHERE user_id='$user' ORDER BY date DESC LIMIT 10");
							$row_check_tasks = mysqli_num_rows($recent_tasks_query);
							if ($row_check_tasks >= 1) {
								while ($row = mysqli_fetch_assoc($recent_tasks_query)) {
								$notification_task = $row['task'];
								$notification_date = $row['date'];
								$notification_task_id = $row['task_id'];
								$notification_supervisor_id = $row['supervisor_id'];
								
								$supervisor_query = mysqli_query($db, "SELECT * FROM user WHERE id='$notification_supervisor_id'");
								$supervisor_result = mysqli_fetch_assoc($supervisor_query);
								$supervisor_fname = $supervisor_result['fname'];
								$supervisor_lname = $supervisor_result['lname'];
								$supervisor_fullname = "$supervisor_fname $supervisor_lname";
							
							?>
									<tr>
										<td>
											<?
											switch ($notification_task) {
												case "expense":
													?>
													<span class="label label-info">Expense Claim</span>											
													<?
													break;
												case "vacation":
													?>
													<span class="label label-success">Vacation Request</span>														
													<?
													break;
												case "overtime":
													?>
													<span class="label label-warning">Overtime Request</span>													
													<?
													break;
												case "timesheet":
													?>
													<span class="label label-primary">Timesheet</span>													
													<?
													break;													
											}
											?>																					
										</td>
										<td class="issue-info">
											<a href="#">
												System Message
											</a>
											<br/>
											<small>
											<?
											switch ($notification_task) {
												case "expense":
													?>
													Expense Claim was submitted to <?echo $supervisor_fullname?>.										
													<?
													break;
												case "vacation":
													?>
													Vacation Request was submitted to <?echo $supervisor_fullname?>.													
													<?
													break;
												case "overtime":
													?>
													Overtime Request was submitted to <?echo $supervisor_fullname?>.												
													<?
													break;
												case "timesheet":
													?>
													Timesheet was submitted to <?echo $supervisor_fullname?>.												
													<?
													break;													
											}
											?>																							
											</small>
										</td>
										<td>
											<?echo $notification_date?>
										</td>
										<td class="text-right">
											<?
											switch ($notification_task) {
												case "expense":
													?>
													<a href="expenseclaim#expense_claim_<?echo $notification_task_id?>"><button class="btn btn-default btn-xs"> View</button></a>										
													<?
													break;
												case "vacation":
													?>
													<a href="myvacation#vacation_request_view_<?echo $notification_task_id?>"><button class="btn btn-default btn-xs"> View</button></a>													
													<?
													break;
												case "overtime":
													?>
													<a href="myovertime#overtime_request_view_<?echo $notification_task_id?>"><button class="btn btn-default btn-xs"> View</button></a>													
													<?
													break;
												case "timesheet":
													?>
													---												
													<?
													break;													
											}
											?>																				
											
										</td>
									</tr>									
							<?	}
							}else {
								echo "No Recent Submissions Yet.";
							}
							?>
							
                            </tbody>
                        </table>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>


	
</div>

<!-- Vendor scripts -->
<script src="vendor/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="vendor/metisMenu/dist/metisMenu.min.js"></script>
<script src="vendor/iCheck/icheck.min.js"></script>
<script src="vendor/sparkline/index.js"></script>

<!-- App scripts -->
<script src="scripts/homer.js"></script>

</body>
</html>
<?
}
?>