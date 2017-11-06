<?
include("inc/db.php");
include('inc/header.php');
session_start();
$url_timesheet_id = $_GET['timesheet_id'];
?>

<?
if(empty($_SESSION['login_user']) or $auth== "regular" ) {
	if ($url_timesheet_id == "") {
		echo "<meta http-equiv=\"refresh\" content=\"0; url=./login\">";
	}else {
		echo "<meta http-equiv=\"refresh\" content=\"0; url=./login?path=timesheetapproval&hash=timesheet_submission_&id=$url_timesheet_id\">";		
	}

}else {

?>

<!-- Simple splash screen-->
<div class="splash"> <div class="color-line"></div><div class="splash-title"><h1>Timesheet Approval Page</h1><p>Loading...</p><div class="spinner"> <div class="rect1"></div> <div class="rect2"></div> <div class="rect3"></div> <div class="rect4"></div> <div class="rect5"></div> </div> </div> </div>
<!--[if lt IE 7]>
<p class="alert alert-danger">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<!-- Main Wrapper -->
<div id="wrapper">

    <div class="normalheader transition animated fadeIn small-header">
        <div class="hpanel">
            <div class="panel-body">
                <div id="hbreadcrumb" class="pull-right m-t-lg">
                    <ol class="hbreadcrumb breadcrumb">
                        <li><a href="./">Dashboard</a></li>
                        <li class="active">
                            <span>Timesheet Approvals</span>
                        </li>
                    </ol>
                </div>
				<div>
                <h2 class="font-light m-b-xs">
                  Timesheet Approvals
                </h2>
                <small>You can approve timesheet submissions here!</small>
				</div>
            </div>
        </div>
    </div>
<?

if ($auth == "admin") {
	$query_expense_result = mysqli_query($db, "SELECT * FROM timesheet_general WHERE timesheet_status<>'Saved'");	
}else {
	$query_expense_result = mysqli_query($db, "SELECT * FROM timesheet_general WHERE supervisor_id='$user' AND timesheet_status<>'Saved'");
}

$result_num = mysqli_num_rows($query_expense_result);
if ($result_num == 0) {?>
	<p style="text-align:center; padding-top:30px; padding-bottom:100%;">No submissions yet!</p>
<?} else {?>


<div id="timesheet_result" class="content animate-panel">
    <div class="row">
        <div class="col-lg-12">
            <div class="hpanel">			
                <div class="panel-heading">
                    <div class="panel-tools">
                    </div>
                </div>
                <div class="panel-body">
				<div class="table-responsive">
                <table id="timesheet_view_table" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th>Employee Name</th>
                    <th>Timesheet Date</th>
					<th>Details</th>
                </tr>
                </thead>
                <tbody>
				<?
				function monthtoword($number) {	
					$number = (float)$number;	
					switch($number) {
						case 1: return "January";
						case 2: return "February";
						case 3: return "March";
						case 4: return "April";
						case 5: return "May";
						case 6: return "June";
						case 7: return "July";
						case 8: return "August";
						case 9: return "September";
						case 10: return "October";
						case 11: return "November";
						case 12: return "December";	
					}
				}				
				if ($auth == "admin") {
					$query_timesheet_general_result = mysqli_query($db, "SELECT * FROM timesheet_general WHERE timesheet_status<>'Saved' ORDER BY id asc");	
				}else {
					$query_timesheet_general_result = mysqli_query($db, "SELECT * FROM timesheet_general WHERE supervisor_id='$user' AND timesheet_status<>'Saved' ORDER BY id asc");	
				}				
					while($timesheet_general_array = mysqli_fetch_assoc($query_timesheet_general_result)) {
					$timesheet_id = $timesheet_general_array['id'];					
					$employee_id = $timesheet_general_array['requested_userid'];
					$supervisor_id = $timesheet_general_array['supervisor_id'];
					$timesheet_status = $timesheet_general_array['timesheet_status'];
					$timesheet_year = $timesheet_general_array['year'];
					$timesheet_month = $timesheet_general_array['month'];
					$timesheet_month = monthtoword($timesheet_month);
					$super_comments= $timesheet_general_array['super_comments'];
					$user_comments= $timesheet_general_array['user_comments'];
					$pdf_path= $timesheet_general_array['pdf_path'];
					$modal_detail_id = 'timesheet_submission_'.$timesheet_id;
					$TimesheetRepDate = "$timesheet_month - $timesheet_year";

					$employee_result = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM user WHERE id='$employee_id'"));
					$employee_fname = $employee_result['fname'];$employee_lname = $employee_result['lname'];$employee_fullname = "$employee_fname $employee_lname";
					
					$supervisor_result = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM user WHERE id='$supervisor_id'"));
					$supervisor_fname = $supervisor_result['fname'];$supervisor_lname = $supervisor_result['lname']; $approver_fullname = "$supervisor_fname $supervisor_lname";						
				?>
						<tr>
							<td><strong><?echo "$employee_fullname";?></strong></td>
							<?
							
							if ($timesheet_status == "Submitted"){?>
							<td class="text-warning"><?echo "$timesheet_status for Timesheet: $TimesheetRepDate";?></td>	
							<?}else if ($timesheet_status == "Approved") {?>
							<td class="text-success"><?echo "$timesheet_status for Timesheet: $TimesheetRepDate";?></td>	
							<?}else if ($timesheet_status == "Rejected") {?>
							<td class="text-danger"><?echo "$timesheet_status for Timesheet: $TimesheetRepDate";?></td>
							<?}
							
							?>
							<td><div class="btn-group cell-center"><button type="button" class="btn w-xs btn-info btn-xs" data-remodal-target="<?echo $modal_detail_id;?>">
								View/Action
							</button>
							</div>
							<!-- make request modal -->
								<div id="<?echo $modal_detail_id;?>" class="remodal-bg">
									<div class="remodal timesheet_app_size" data-remodal-id="<?echo $modal_detail_id;?>" data-remodal-options="hashTracking: true, closeOnOutsideClick: false">
									<?
									$timesheet_details = mysqli_query($db, "SELECT * FROM timesheet WHERE timesheet_id='$timesheet_id'");
									$timesheet_details_result = mysqli_fetch_assoc($timesheet_details);
									$timesheet_type = $timesheet_details_result['timesheet_type'];
									$timesheet_submit_date = $timesheet_details_result['submitted_date'];
									$sent_to_supervisor_id = $timesheet_details_result['supervisor_id'];
									
									$sent_to_sup_result = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM user WHERE id='$sent_to_supervisor_id'"));
									
									$sen_to_supervisor_fname = $sent_to_sup_result['fname'];$sen_to_supervisor_lname = $sent_to_sup_result['lname']; $sen_to_supervisor_fullname = "$sen_to_supervisor_fname $sen_to_supervisor_lname";
									
									?>		
											<?
											if ($timesheet_status == "Submitted"){?>
											<div class="color-line-orange"></div>
											<?}else if ($timesheet_status == "Approved") {?>
											<div class="color-line-green"></div>		
											<?} else if ($timesheet_status == "Rejected") {?>
											<div class="color-line-red"></div>
											<?}
											?>											
											<div class="modal-header">
												<h4 class="modal-title">Timesheet Submission<br/>
												 
												<?echo "$employee_fullname for $TimesheetRepDate";?>
												<br/>
												(
												<?
												if ($timesheet_status == "Submitted"){?>
												<span class="text-warning"><?echo $timesheet_status;?></span>		
												<?}else if ($timesheet_status == "Approved") {?>
												
												<i class="fa fa-check"></i><span class="text-success">Approved</span> By: <?echo $approver_fullname;?>			
												<?}else {?>
												<i class="fa fa-frown-o"></i><span class="text-danger"><?echo $timesheet_status;?></span>	
												<?}
												
												?>										
												
												)</h4>
												<h5><p>Submitted On: <?echo $timesheet_submit_date;?></p></h5>
												<?
												if ($timesheet_status == "Approved") {?>
												<h5><p>Approved On: <?echo $timesheet_submit_date;?></p></h5>	
												<?}
												?>
											</div>										
											<div class="modal-body">
												<div class="table-responsive">
													<table cellpadding="1" cellspacing="1" class="table table-bordered table-striped table-hover">
														<thead>
														<tr>
															<?
															if ($timesheet_type == "Period") {?>
															<th>Date From</th>
															<th>Date To</th>						
															<?}else if ($timesheet_type == "Day") {?>
															<th>Date</th>				
															<?}else {
																echo "Something went wrong...";
															}
															?>				
															<th>Hours Worked</th>
															<th>Sick Hours Taken</th>
															<th>Vacation Hours</th>
															<th>Satutory Hours</th>
															<th>O/T Hours Banked</th>
															<th>O/T Taken</th>
															<th>Hours Paid</th>
														</tr>
														</thead>
														<tbody>														
														<?
														$hours_worked_total=0;
														$sick_hours_total=0;
														$vacation_hours_total=0;
														$stat_hours_total=0;
														$ot_hours_banked_total=0;
														$ot_hours_taken_total=0;
														
														$timesheet_details_array = mysqli_query($db, "SELECT * FROM timesheet WHERE timesheet_id='$timesheet_id'");														
															while ($timesheet_details_result = mysqli_fetch_assoc($timesheet_details_array)) {
																$timesheet_from_date = $timesheet_details_result['from_date'];  																		
																$timesheet_to_date = $timesheet_details_result['to_date'];  																		
																$timesheet_year_date = $timesheet_details_result['year_date'];  																		
																$timesheet_month_date = $timesheet_details_result['month_date'];  																		
																$hours_worked = $timesheet_details_result['hours_worked'];  																		
																$sick_hours = $timesheet_details_result['sick_hours'];  																		
																$vacation_hours = $timesheet_details_result['vacation_hours'];  																		
																$stat_hours = $timesheet_details_result['stat_hours'];  																		
																$ot_hours_banked = $timesheet_details_result['ot_hours_banked'];  																		
																$ot_hours_taken = $timesheet_details_result['ot_hours_taken'];
																
																if ($hours_worked == "") {
																	$hours_worked =0;
																}
																if ($sick_hours == "") {
																	$sick_hours =0;
																}																
																if ($vacation_hours == "") {
																	$vacation_hours =0;
																}
																if ($stat_hours == "") {
																	$stat_hours =0;
																}
																if ($ot_hours_banked == "") {
																	$ot_hours_banked =0;
																}
																if ($ot_hours_taken == "") {
																	$ot_hours_taken =0;
																}
																
																$hours_worked_total+=$hours_worked;
																$sick_hours_total+=$sick_hours;
																$vacation_hours_total+=$vacation_hours;
																$stat_hours_total+=$stat_hours;
																$ot_hours_banked_total+=$ot_hours_banked;
																$ot_hours_taken_total+=$ot_hours_taken;
																
																$hours_paid = $hours_worked+$sick_hours+$vacation_hours+$stat_hours-$ot_hours_banked+$ot_hours_taken;
														?>
															<tr class="row_repeat time_table_hover">
																<?
																if ($timesheet_type == "Period") {?>
																<td style="text-align: left;"><?echo $timesheet_from_date?></td>
																<td style="text-align: left;"><?echo $timesheet_to_date?></td>						
																<?}else if ($timesheet_type == "Day") {?>
																<td style="text-align: left;"><?echo $timesheet_from_date?></td>				
																<?}else {
																	echo "Something went wrong...";
																}
																?>																
																<td><?echo "$hours_worked"?></td>
																<td><?echo "$sick_hours"?></td>
																<td><?echo "$vacation_hours"?></td>
																<td><?echo "$stat_hours"?></td>
																<td><?echo "$ot_hours_banked"?></td>
																<td><?echo "$ot_hours_taken"?></td>
																<td><?echo "$hours_paid"?></td>
															</tr>																	
														<?}
														   $hours_paid_total = $hours_worked_total+$sick_hours_total+$vacation_hours_total+$stat_hours_total-$ot_hours_banked_total+$ot_hours_taken_total;
														   
														?>
															<tr class="row_total time_table_hover">							
																<td></td>
																<?
																if ($timesheet_type == "Period") {?>
																<td></td>					
																<?}
																?>																
																<td><strong><?echo $hours_worked_total?></strong></td>
																<td><strong><?echo $sick_hours_total?></strong></td>
																<td><strong><?echo $vacation_hours_total?></strong></td>
																<td><strong><?echo $stat_hours_total?></strong></td>
																<td><strong><?echo $ot_hours_banked_total?></strong></td>
																<td><strong><?echo $ot_hours_taken_total?></strong></td>
																<td><strong><?echo $hours_paid_total?></strong></td>

															</tr>
															<tr class="row_total time_table_hover">							
																<td></td>
																<?
																if ($timesheet_type == "Period") {?>
																<td></td>					
																<?}
																?>																
																<td><strong>Total Hours Worked</strong></td>
																<td><strong>Total Sick Hours Taken</strong></td>
																<td><strong>Total Vacation Hours</strong></td>
																<td><strong>Total Satutory Hours</strong></td>
																<td><strong>Total O/T Hours Banked</strong></td>
																<td><strong>Total O/T Taken</strong></td>
																<td><strong>Total Hours Paid</strong></td>
															</tr>															
														</tbody>
													</table>					
												</div>
												
												<strong><p style="text-align:left">User Comments:</p></strong>
												<p style="text-align:left"><?echo $user_comments?></p>
												<br/>
												
												<strong><p style="text-align:left">PDF Link:</p></strong>
												<p style="text-align:left"><a href='#' onClick="window.open('pdf_view/pdf_view.php?task=timesheet&path=<?echo $pdf_path;?>','pagename','resizable,height=640,width=800'); return false;"><span class="text-danger"><?$pdf_name = explode("/",$pdf_path); echo $pdf_name[2]?></span></a></p>
												<br/>
												
												
												<strong><p style="text-align:left">Supervisor Comments:</p></strong>

												<?
												if ($timesheet_status == "Submitted"){?>
												<textarea id="supervisor_comment_<?echo $timesheet_id?>" class="form-control field_value_<?echo $timesheet_id?>" rows="5" placeholder="Write a comment here..."><?echo $super_comments?></textarea>
												<?}else if ($timesheet_status == "Approved") {?>
												<textarea id="supervisor_comment_<?echo $timesheet_id?>" class="form-control field_value_<?echo $timesheet_id?>" rows="5" value="" disabled><?echo $super_comments?></textarea>
												<?}else if ($timesheet_status == "Rejected") {?>
												<textarea id="supervisor_comment_<?echo $timesheet_id?>" class="form-control field_value_<?echo $timesheet_id?>" rows="5" value="" disabled><?echo $super_comments?></textarea>
												<?}
												
												{?>
												
													<br/>
												<div class="row"><div class="col-lg-12"><p class="pull-left"><strong>Sent to Supervisor: </strong> <?echo "$sen_to_supervisor_fullname";?></div></div>													
												
											</div>
											<div class="modal-footer">
												<div class="pull-right"><button type="button" class="btn btn-default close_js" data-remodal-action="close">Close</button></div>
												<div class="pull-left">
												<?}
												if ($timesheet_status == "Submitted"){?>
													<button type="button" class="btn btn-success action_button" id="approve_<?echo $timesheet_id?>">Approve</button>
													<button type="button" class="btn btn-danger action_button" id="reject_<?echo $timesheet_id?>">Reject</button>	
												<?}else if ($timesheet_status == "Approved") {?>
													<button type="button" class="btn btn-warning pdf_export" id="pdf_<?echo $timesheet_id?>">Export as PDF</button>
												<?}else {?>
												<?}
												
												?>												
												</div>
											</div>
									</div><!-- tab-content -->
								</div> <!-- /form --> 								
							</td>						
						</tr>	
				<?	}
				?>							
                </tbody>
                </table>
				</div>				
                </div>
            </div>
        </div>

    </div>
    </div>
<?
}
?>
</div>     
<input type="hidden" id="hidden_user" value="<?echo $user?>">                 
<input type="hidden" id="hidden_username" value="<?echo $user?>">                 
<input type="hidden" id="hidden_supervisor" value="<?echo $supervisor?>">                 
<!-- Vendor scripts -->
<script src="vendor/slimScroll/jquery.slimscroll.min.js"></script>
<script src="vendor/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="vendor/metisMenu/dist/metisMenu.min.js"></script>
<script src="vendor/iCheck/icheck.min.js"></script>
<script src="vendor/sparkline/index.js"></script>
<!-- DataTables -->
<script src="vendor/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="vendor/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- DataTables buttons scripts -->
<script src="vendor/pdfmake/build/vfs_fonts.js"></script>
<script src="vendor/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="vendor/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="vendor/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="vendor/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="js_custom/moment.js"></script>
<script src="vendor/bootstrap-datepicker-master/dist/js/bootstrap-datepicker.min.js"></script>
<script src="vendor/clockpicker/dist/bootstrap-clockpicker.min.js"></script>
<script src="vendor/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<script src="vendor/select2-3.5.2/select2.min.js"></script>
<script src="js_custom/timesheet_pdf_export.js"></script>


<!-- App scripts -->
<script src="scripts/homer.js"></script>
<script src="js_custom/timesheet_approval.js"></script>
<script src="js_custom/date.js"></script>
<script src="js_custom/timesheetApprovalModal.js"></script>
<script>
	$('#timesheet_view_table').dataTable({
		"pageLength": 500000000000
	});
	
	$(document).ready(function(){
		$('[data-toggle="tooltip"]').tooltip(); 
	});			
</script>
</body>
</html>
<?
}
?>