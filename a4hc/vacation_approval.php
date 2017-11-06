<?
error_reporting(0);
include("inc/db.php");
include('inc/header.php');
session_start();
$url_vacation_id = $_GET['vacation_id'];
?>

<?
if(empty($_SESSION['login_user']) or $auth == "regular") {
	if ($url_vacation_id == "") {
		echo "<meta http-equiv=\"refresh\" content=\"0; url=./login\">";
	}else {
		echo "<meta http-equiv=\"refresh\" content=\"0; url=./login?path=vacationapproval&hash=vacation_request_view_&id=$url_vacation_id\">";		
	}

}else {

?>

<!-- Simple splash screen-->
<div class="splash"> <div class="color-line"></div><div class="splash-title"><h1>Time Off Request Page</h1><p>Loading...</p><div class="spinner"> <div class="rect1"></div> <div class="rect2"></div> <div class="rect3"></div> <div class="rect4"></div> <div class="rect5"></div> </div> </div> </div>
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
                            <span>Time Off Approvals</span>
                        </li>
                    </ol>
                </div>
				<div>
                <h2 class="font-light m-b-xs">
				Time Off Approvals
                </h2>
                <small>You can approve employee's time off requests here!</small>
				</div>
            </div>
        </div>
    </div>

<?
if ($auth == "admin") {
	$query_vacation_result = mysqli_query($db, "SELECT * FROM vacation_request");
}else {
	$query_vacation_result = mysqli_query($db, "SELECT * FROM vacation_request WHERE notifier='$user'");
}
$result_num = mysqli_num_rows($query_vacation_result);
if ($result_num == 0) {?>
	<p style="text-align:center; padding-top:30px; padding-bottom:500px;">No requests yet!</p>
<?} else {?>


<div id="expense_claim_result" class="content animate-panel">
    <div class="row">
        <div class="col-lg-12">
            <div class="hpanel">
			
                <div class="panel-heading">
                    <div class="panel-tools">
                    </div>
                </div>
				<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#tab-1"><span class="text-warning">Submitted Time Off Requests</span></a></li>
					<li class=""><a data-toggle="tab" href="#tab-2"><span class="text-success">Approved Time Off Requests</span></a></li>
					<li class=""><a data-toggle="tab" href="#tab-3"><span class="text-danger">Rejected Time Off Requests</a></li>
				</ul>
            <div class="tab-content">
                <div id="tab-1" class="tab-pane active">
                <div class="panel-body">
				<table id="vacation_table_1" class="table table-striped table-bordered table-hover">
                <thead>
							<tr>
								<th>Request Created On</th>
								<th>Status</th>
								<th>View</th>
							</tr>
                </thead>
                <tbody>
								<?								
								if ($auth == "admin") {
									$query_vacation_result = mysqli_query($db, "SELECT * FROM vacation_request WHERE application_status='Submitted' ORDER BY id asc");
								}else {
									$query_vacation_result = mysqli_query($db, "SELECT * FROM vacation_request WHERE notifier='$user' AND application_status='Submitted' ORDER BY id asc");
								}
								
									while($vacation_array = mysqli_fetch_assoc($query_vacation_result)) {
										$date_from = $vacation_array['date_from'];
										$date_to = $vacation_array['date_to'];
										$status = $vacation_array['application_status'];
										$vacation_request_id = $vacation_array['id'];
										$reason = $vacation_array['reason'];
										$time_stamp_created = $vacation_array['time_stamp'];
										$attachment_status = $vacation_array['attachment'];
										$action_time = $vacation_array['supervisor_action_time'];
										$action_by = $vacation_array['by_supervisor'];
										$comment = $vacation_array['comment'];
										$requested_user = $vacation_array['requested_user'];
										$supervisor_notifier = $vacation_array['notifier'];
										$vacation_generated_id = $vacation_array['vacation_generated_id'];
										
										$supervisor_data = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM user WHERE id='$supervisor_notifier'"));
											$supervisor_fname = $supervisor_data['fname'];
											$supervisor_lname = $supervisor_data['lname'];
											$supervisor_name = "$supervisor_fname $supervisor_lname";

										$requested_user_data = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM user WHERE id='$requested_user'"));
											$requested_user_fname = $requested_user_data['fname'];
											$requested_user_lname = $requested_user_data['lname'];
											$requested_user_name = "$requested_user_fname $requested_user_lname";
											
										$date_format_from = date_create($date_from);
										$date_from = date_format($date_format_from,"M-d-y");
										
										$date_format_to = date_create($date_to);
										$date_to = date_format($date_format_to,"M-d-y");

										$time_stamp_created_format = date_create($time_stamp_created);
										$time_stamp_created_format = date_format($time_stamp_created_format,"M-d-y @ H:i");
										
										$modal_detail_id = 'vacation_request_view_'.$vacation_request_id;
										
										if ($attachment_status == "yes") {
											$query_attachment = mysqli_query($db, "SELECT * FROM file_upload WHERE request_id='$vacation_request_id' AND topic='vacation'");
											$attachment_array = mysqli_fetch_assoc($query_attachment);
												$file_location = $attachment_array['file_destination'];
												$file_name = $attachment_array['real_file_name'];
										}else {
											$file_location = "";
										}
										
								?>
						<tr>
							<td><strong><?echo "$time_stamp_created_format";?> from <?echo "$requested_user_name"?></strong></strong></td>
							<?
							
							if ($status == "Submitted"){?>
							<td class="text-warning"><?echo "$status ";?></td>	
							<?}else if ($status == "Approved") {?>
							<td class="text-success"><?echo "$status ";?></td>	
							<?}else {?>
							<td class="text-danger"><?echo "$status ";?></td>	
							<?}
							
							?>
							<td><div class="btn-group cell-center"><button type="button" class="btn w-xs btn-info btn-xs" data-remodal-target="<?echo $modal_detail_id;?>">
								View/Action
							</button>
							</div>
							<!-- make request modal -->
								<div id="view_<?echo $modal_detail_id;?>" class="remodal-bg">
									<div class="remodal" data-remodal-id="<?echo $modal_detail_id;?>" data-remodal-options="hashTracking: true, closeOnOutsideClick: false">
											<div class="color-line-orange"></div>
										<div class="modal-header">
											<h4 class="modal-title">Time Off Request<br/>(
											<?
											if ($status == "Submitted"){?>
											<span class="text-warning">	
											<?}else if ($status == "Approved") {?>
											<i class="fa fa-check"></i><span class="text-success">		
											<?}else {?>
											<i class="fa fa-frown-o"></i><span class="text-danger">
											<?}
											
											?><?echo $status;?></span>											
											
											)</h4>
											ID: <?echo $vacation_generated_id;?>
											<small class="font-bold">
											<?
											if (!empty($action_by)) {?>
											<?
												if ($status == "Approved") {
													echo "Approved By: ";
													echo $supervisor_fname.' '.$supervisor_lname;
												}elseif($status == "Rejected") {
													echo "Rejected By: ";
													echo $supervisor_fname.' '.$supervisor_lname;
												}else {
													
												}
											
											?>
											<?
											
											}
											?>
											</small><br/>
										</div>	
										<div class="modal-body">
										<!--	<div class="row">
												<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
												
													<div class="form-group">
														<label class="control-label pull-left" for="date_from">From Date:</label>
														<input type="text" value="<?echo $date_from;?>" class="form-control" readonly>
													</div>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
													<div class="form-group">
														<label class="control-label pull-left" for="date_from">To Date:</label>
														<input type="text" value="<?echo $date_to;?>" class="form-control" readonly>
													</div>
												</div>
											</div>-->
											<div class="row">
												<div class="col-lg-12">
												<label class="control-label pull-left" for="Reason">Details:</label><br/>
												<hr/>	<div class="form-group" style="text-align: left;">
														<?echo $reason;?>
													</div>
												</div><br/><br/>
											</div>
											<div class="row">
												<div class="col-lg-12">
													<div class="form-group">
														<strong><span class="pull-left" for="vacation_pdf">File Uploaded URL:</span></strong><br/><hr/>
														<?
														if ($file_location!="") {?>
															<p style="text-align:left;"><a href="#" onClick="window.open('pdf_view/pdf_view.php?task=vacation&path=<?echo $file_location;?>','pagename','resizable,height=640,width=800'); return false;"><span class="text-danger"><?echo $file_name;?></span></a></p>
														<?}else {?>
															<p style="text-align:left;">No Files Included.</p>
														<?}
														?>
														
													</div>
												</div>
											</div>
											<strong><p style="text-align:left">Comments:</p></strong>	
											<textarea id="vacation_approval_<?echo $vacation_request_id?>" class="form-control field_value_<?echo $vacation_request_id?>" rows="5" placeholder="Write a comment here..."></textarea>
				
											<div class="row"><div class="col-lg-12"><p class="pull-left"><strong>Created By: </strong><?echo "$requested_user_name on $time_stamp_created";?></p></div></div>													
											<div class="row"><div class="col-lg-12"><p class="pull-left"><strong>Sent to Supervisor: </strong><?echo "$supervisor_name";?></p></div></div>								
										</div>
										<div class="modal-footer">
											<div class="pull-right"><button type="button" class="btn btn-default close_js" data-remodal-action="close">Close</button></div>
											<div class="pull-left">
												<button type="button" class="btn btn-success action_button" id="approve_<?echo $vacation_request_id?>">Approve</button>
												<button type="button" class="btn btn-danger action_button" id="reject_<?echo $vacation_request_id?>">Reject</button>
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
                <div id="tab-2" class="tab-pane">
                <div class="panel-body">
				<table id="vacation_table_2" class="table table-striped table-bordered table-hover">
				<thead>
				<tr>
					<th>Request Created On</th>
					<th>Status</th>
					<th>View</th>
				</tr>
				</thead>
                <tbody>
				<?
				if ($auth == "admin") {
					$query_vacation_result = mysqli_query($db, "SELECT * FROM vacation_request WHERE application_status='Approved' ORDER BY id asc");
				}else {
					$query_vacation_result = mysqli_query($db, "SELECT * FROM vacation_request WHERE notifier='$user' AND application_status='Approved' ORDER BY id asc");
				}
					while($vacation_array = mysqli_fetch_assoc($query_vacation_result)) {
						// $date_from = $vacation_array['date_from'];
						// $date_to = $vacation_array['date_to'];
						$status = $vacation_array['application_status'];
						$vacation_request_id = $vacation_array['id'];
						$reason = $vacation_array['reason'];
						$time_stamp_created = $vacation_array['time_stamp'];
						$attachment_status = $vacation_array['attachment'];
						$action_time = $vacation_array['supervisor_action_time'];
						$action_by = $vacation_array['by_supervisor'];
						$comment = $vacation_array['comment'];
						$notifier = $vacation_array['notifier'];
						$requested_user = $vacation_array['requested_user'];
						$vacation_generated_id = $vacation_array['vacation_generated_id'];
						
						$supervisor_data = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM user WHERE id='$action_by'"));
							$supervisor_fname = $supervisor_data['fname'];
							$supervisor_lname = $supervisor_data['lname'];
							$actionby_name = "$supervisor_fname $supervisor_lname";
							
						$supervisor_sent = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM user WHERE id='$notifier'"));
							$supervisor_sent_fname = $supervisor_sent['fname'];
							$supervisor_sent_lname = $supervisor_sent['lname'];	
							$supervisor_sent_name = "$supervisor_sent_fname $supervisor_sent_lname";
							
						$requested_user_data = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM user WHERE id='$requested_user'"));
							$requested_user_fname = $requested_user_data['fname'];
							$requested_user_lname = $requested_user_data['lname'];
							$requested_user_name = "$requested_user_fname $requested_user_lname";	
							
						$date_format_from = date_create($date_from);
						$date_from = date_format($date_format_from,"M-d-y");
						
						$date_format_to = date_create($date_to);
						$date_to = date_format($date_format_to,"M-d-y");

						$time_stamp_created_format = date_create($time_stamp_created);
						$time_stamp_created_format = date_format($time_stamp_created_format,"M-d-y @ H:i");
						
						$modal_detail_id = 'vacation_request_view_'.$vacation_request_id;
						
						if ($attachment_status == "yes") {
							$query_attachment = mysqli_query($db, "SELECT * FROM file_upload WHERE request_id='$vacation_request_id' AND topic='vacation'");
							$attachment_array = mysqli_fetch_assoc($query_attachment);
								$file_location = $attachment_array['file_destination'];
								$file_name = $attachment_array['real_file_name'];
						}else {
							$file_location = "";
						}
						
				?>
						<tr>
							<td><strong><?echo "$time_stamp_created_format";?></strong></strong></td>
							<?
							
							if ($status == "Submitted"){?>
							<td class="text-warning"><?echo "$status";?></td>	
							<?}else if ($status == "Approved") {?>
							<td class="text-success"><?echo "$status";?></td>		
							<?}else {?>
							<td class="text-danger"><?echo "$status";?></td>	
							<?}
							
							?>
							<td><div class="btn-group cell-center"><button type="button" class="btn w-xs btn-info btn-xs" data-remodal-target="<?echo $modal_detail_id;?>">
								Details
							</button>
							</div>
							<!-- make request modal -->
								<div id="view_<?echo $modal_detail_id;?>" class="remodal-bg">
									<div class="remodal" data-remodal-id="<?echo $modal_detail_id;?>" data-remodal-options="hashTracking: true, closeOnOutsideClick: false">
											<div class="color-line-green"></div>
										<div class="modal-header">
											<h4 class="modal-title">Time Off Request<br/>(
											<?
											if ($status == "Submitted"){?>
											<span class="text-warning">	
											<?}else if ($status == "Approved") {?>
											<i class="fa fa-check"></i><span class="text-success">		
											<?}else {?>
											<i class="fa fa-frown-o"></i><span class="text-danger">
											<?}
											
											?><?echo $status;?></span>											
											
											)</h4>
											ID: <?echo $vacation_generated_id;?><br/>
											<small class="font-bold">
											<?
											if (!empty($action_by)) {?>
											<?
												if ($status == "Approved") {
													echo "Approved By: ";
													echo $supervisor_fname.' '.$supervisor_lname;
												}elseif($status == "Rejected") {
													echo "Rejected By: ";
													echo $supervisor_fname.' '.$supervisor_lname;
												}else {
													
												}
											
											?>
											<?
											
											}
											?>
											</small><br/>
										</div>									
									
										<div class="modal-body">
										<!--	<div class="row">
												<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
												
													<div class="form-group">
														<label class="control-label pull-left" for="date_from">From Date:</label>
														<input type="text" value="<?echo $date_from;?>" class="form-control" readonly>
													</div>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
													<div class="form-group">
														<label class="control-label pull-left" for="date_from">To Date:</label>
														<input type="text" value="<?echo $date_to;?>" class="form-control" readonly>
													</div>
												</div>
											</div>-->
											<div class="row">
												<div class="col-lg-12">
												<label class="control-label pull-left" for="Reason">Details:</label><br/>
												<hr/>	<div class="form-group" style="text-align: left;">
														<?echo $reason;?>
													</div>
												<hr/></div><br/><br/>
											</div>
											<div class="row">
												<div class="col-lg-12">
													<div class="form-group">
														<strong><span class="pull-left" for="vacation_pdf">File Uploaded URL:</span></strong><br/><hr/>
														<?
														if ($file_location!="") {?>
															<p style="text-align:left;"><a href="#" onClick="window.open('pdf_view/pdf_view.php?task=vacation&path=<?echo $file_location;?>','pagename','resizable,height=640,width=800'); return false;"><span class="text-danger"><?echo $file_name;?></span></a></p>
														<?}else {?>
															<p style="text-align:left;">No Files Included.</p>
														<?}
														?>
														
													</div>
												</div>
											</div>
											<div class="row"><div class="col-lg-12"><p class="pull-left"><strong>Created By: </strong><?echo "$requested_user_name on $time_stamp_created";?></p></div></div>													
											<div class="row"><div class="col-lg-12"><p class="pull-left"><strong>Sent to Supervisor: </strong><?echo "$supervisor_sent_name";?></p></div></div>								
											<div class="row"><div class="col-lg-12"><p class="pull-left"><strong>Approved By: </strong><?echo "$actionby_name on $action_time";?></p></div></div>
											<div class="hpanel hgreen">
												<div class="panel-body">
													<span class="font-trans font-bold">Supervisor's Comment:<br/>
														<?if ($comment !="") {
															echo $comment;
														}else {
															echo "None";
														}?>
													</span>
												</div>
											</div>											
										</div>	
										
										<div class="modal-footer">									
											<button type="button" id="vacation_request_close" class="btn btn-default" data-remodal-action="close">Close</button>										
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
				<div id="tab-3" class="tab-pane">
                <div class="panel-body">
				<table id="vacation_table_3" class="table table-striped table-bordered table-hover">
				<thead>
				<tr>
					<th>Request Created On</th>
					<th>Status</th>
					<th>View</th>
				</tr>
				</thead>
                <tbody>
								<?
								if ($auth == "admin") {
									$query_vacation_result = mysqli_query($db, "SELECT * FROM vacation_request WHERE application_status='Rejected' ORDER BY id asc");
								}else {
									$query_vacation_result = mysqli_query($db, "SELECT * FROM vacation_request WHERE notifier='$user' AND application_status='Rejected' ORDER BY id asc");
								}
									while($vacation_array = mysqli_fetch_assoc($query_vacation_result)) {
										// $date_from = $vacation_array['date_from'];
										// $date_to = $vacation_array['date_to'];
										$status = $vacation_array['application_status'];
										$vacation_request_id = $vacation_array['id'];
										$reason = $vacation_array['reason'];
										$time_stamp_created = $vacation_array['time_stamp'];
										$attachment_status = $vacation_array['attachment'];
										$action_time = $vacation_array['supervisor_action_time'];
										$action_by = $vacation_array['by_supervisor'];
										$comment = $vacation_array['comment'];
										$notifier = $vacation_array['notifier'];
										$requested_user = $vacation_array['requested_user'];
										$vacation_generated_id = $vacation_array['vacation_generated_id'];
										
										$supervisor_data = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM user WHERE id='$action_by'"));
											$supervisor_fname = $supervisor_data['fname'];
											$supervisor_lname = $supervisor_data['lname'];
											$actionby_name = "$supervisor_fname $supervisor_lname";
											
										$supervisor_sent = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM user WHERE id='$notifier'"));
											$supervisor_sent_fname = $supervisor_sent['fname'];
											$supervisor_sent_lname = $supervisor_sent['lname'];	
											$supervisor_sent_name = "$supervisor_sent_fname $supervisor_sent_lname";
											
										$requested_user_data = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM user WHERE id='$requested_user'"));
											$requested_user_fname = $requested_user_data['fname'];
											$requested_user_lname = $requested_user_data['lname'];
											$requested_user_name = "$requested_user_fname $requested_user_lname";	
											
										$date_format_from = date_create($date_from);
										$date_from = date_format($date_format_from,"M-d-y");
										
										$date_format_to = date_create($date_to);
										$date_to = date_format($date_format_to,"M-d-y");

										$time_stamp_created_format = date_create($time_stamp_created);
										$time_stamp_created_format = date_format($time_stamp_created_format,"M-d-y @ H:i");
										
										$modal_detail_id = 'vacation_request_view_'.$vacation_request_id;
										
										if ($attachment_status == "yes") {
											$query_attachment = mysqli_query($db, "SELECT * FROM file_upload WHERE request_id='$vacation_request_id' AND topic='vacation'");
											$attachment_array = mysqli_fetch_assoc($query_attachment);
												$file_location = $attachment_array['file_destination'];
												$file_name = $attachment_array['real_file_name'];
										}else {
											$file_location = "";
										}
										
								?>
						<tr>
							<td><strong><?echo "$time_stamp_created_format";?></strong></strong></td>
							<?
							
							if ($status == "Submitted"){?>
							<td class="text-warning"><?echo "$status";?></td>	
							<?}else if ($status == "Approved") {?>
							<td class="text-success"><?echo "$status";?></td>	
							<?}else {?>
							<td class="text-danger"><?echo "$status";?></td>	
							<?}
							
							?>
							<td><div class="btn-group cell-center"><button type="button" class="btn w-xs btn-info btn-xs" data-remodal-target="<?echo $modal_detail_id;?>">
								Details
							</button>
							</div>
							<!-- make request modal -->
								<div id="view_<?echo $modal_detail_id;?>" class="remodal-bg">
									<div class="remodal" data-remodal-id="<?echo $modal_detail_id;?>" data-remodal-options="hashTracking: true, closeOnOutsideClick: false">
											<div class="color-line-red"></div>
										<div class="modal-header">
											<h4 class="modal-title">Time Off Request<br/>(
											<?
											if ($status == "Submitted"){?>
											<span class="text-warning">	
											<?}else if ($status == "Approved") {?>
											<i class="fa fa-check"></i><span class="text-success">		
											<?}else {?>
											<i class="fa fa-frown-o"></i><span class="text-danger">
											<?}
											
											?><?echo $status;?></span>											
											
											)</h4>
											ID: <?echo $vacation_generated_id;?><br/>
											<small class="font-bold">
											<?
											if (!empty($action_by)) {?>
											<?
												if ($status == "Approved") {
													echo "Approved By: ";
													echo $supervisor_fname.' '.$supervisor_lname;
												}elseif($status == "Rejected") {
													echo "Rejected By: ";
													echo $supervisor_fname.' '.$supervisor_lname;
												}else {
													
												}
											
											?>
											<?
											
											}
											?>
											</small><br/>
										</div>									
									
										<div class="modal-body">
										<!--	<div class="row">
												<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
												
													<div class="form-group">
														<label class="control-label pull-left" for="date_from">From Date:</label>
														<input type="text" value="<?echo $date_from;?>" class="form-control" readonly>
													</div>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
													<div class="form-group">
														<label class="control-label pull-left" for="date_from">To Date:</label>
														<input type="text" value="<?echo $date_to;?>" class="form-control" readonly>
													</div>
												</div>
											</div>-->
											<div class="row">
												<div class="col-lg-12">
												<label class="control-label pull-left" for="Reason">Details:</label><br/>
												<hr/>	<div class="form-group" style="text-align: left;">
														<?echo $reason;?>
													</div>
												<hr/></div><br/><br/>
											</div>
											<div class="row">
												<div class="col-lg-12">
													<div class="form-group">
														<strong><span class="pull-left" for="vacation_pdf">File Uploaded URL:</span></strong><br/><hr/>
														<?
														if ($file_location!="") {?>
															<p style="text-align:left;"><a href="#" onClick="window.open('pdf_view/pdf_view.php?task=vacation&path=<?echo $file_location;?>','pagename','resizable,height=640,width=800'); return false;"><span class="text-danger"><?echo $file_name;?></span></a></p>
														<?}else {?>
															<p style="text-align:left;">No Files Included.</p>
														<?}
														?>
														
													</div>
												</div>
											</div>
											<div class="row"><div class="col-lg-12"><p class="pull-left"><strong>Created By: </strong><?echo "$requested_user_name on $time_stamp_created";?></p></div></div>													
											<div class="row"><div class="col-lg-12"><p class="pull-left"><strong>Sent to Supervisor: </strong><?echo "$supervisor_sent_name";?></p></div></div>								
											<div class="row"><div class="col-lg-12"><p class="pull-left"><strong>Rejected By: </strong><?echo "$actionby_name on $action_time";?></p></div></div>	
											<div class="hpanel hred">
												<div class="panel-body">
													<span class="font-trans font-bold">Supervisor's Comment:<br/>
														<?if ($comment !="") {
															echo $comment;
														}else {
															echo "None";
														}?>
													</span>
												</div>
											</div>											
										</div>	
										
										<div class="modal-footer">									
											<button type="button" id="vacation_request_close" class="btn btn-default" data-remodal-action="close">Close</button>										
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
    </div>
<?
}
?>
</div>
<!-- make request modal -->
	<div id="vacation_remodal" class="remodal-bg">
		<div class="remodal" data-remodal-id="vacation_request" data-remodal-options="hashTracking: false, closeOnOutsideClick: false">
				<div class="color-line"></div>
				<div class="modal-header">
					<h4 class="modal-title">Make a Vacation Request</h4>
				</div>
			
					<div class="modal-body">
					
					<form id="vacation_form" method="POST" enctype="multipart/form-data" >
					<!--
						<div class="input-daterange row form-group" id="datepicker" >
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<div class="form-group">
									<label class="control-label pull-left" for="date_from">From Date:<i class="text-danger">*</i><span class="text-danger error_msg1"></span></label>
									<a href="#"><input id="date_from" placeholder="Click me to select a Date" type="text" value="" class="form-control" name="start" readonly></a>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<div class="form-group">
									<label class="control-label pull-left" for="date_to">To Date:<i class="text-danger">*</i><span class="text-danger error_msg1"></span></label>
									<a href="#"><input id="date_to" placeholder="Click me to select a Date" type="text" value="" class="form-control pull-right" name="end" readonly></a>
								</div>
							</div>
						</div>-->
						<div class="row">
							<div class="col-lg-12">
							<strong><p style="text-align:left">Details:<i class="text-danger">*</i><span class="text-danger error_msg2"></span></p></strong>
								<div id="reason_div" class="summernote"></div>
							</div>
							
						</div>
						<div class="row">
							<div class="col-lg-12">
								<div class="form-group">
									<input id="proposal" class="upload" type="file"/>
										<div class="hpanel">
											<div class="panel-heading">PDF Document: </div>
											<a href="#" id="upload_proposal" class="upload_link"><div class="panel-body file-body hover-icon_upload proposal_icon">
												<i class="fa fa-file-pdf-o text-danger"></i>
											</div></a>
											<div class="panel-footer text_proposal">
												Select PDF Document
											</div>
										</div>
								</div>	
							</div>		
						</div>								
						<div class="row pull-right">
							<div class="col-lg-12">
								<div class="form-group">
									<small><span><strong>Notes:</strong><i class="text-danger">*</i> are mandatory fields.</span></small>
								</div>
							</div>
						</div>
						<input type="hidden" id="hidden_username" value="<?echo $username;?>">
						<input type="hidden" id="hidden_user" value="<?echo $user;?>">
						<input type="hidden" id="hidden_supervisor" value="<?echo $supervisor;?>">
					</form>
					</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default close_main" data-remodal-action="close">Close</button>
					<button type="button" id="submit_vacation" class="btn btn-success">Submit</button>
				</div>
		</div><!-- tab-content -->
	</div> <!-- /form -->                       
					
					

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


<!-- App scripts -->
<script src="scripts/homer.js"></script>
<script src="js_custom/vacation_request.js"></script>
<script src="js_custom/date.js"></script>

<script>

    $(function () {
		function stripHTML(dirtyString) {//function to check if reason content is with html tags
		  var container = document.createElement('div');
		  var text = document.createTextNode(dirtyString);
		  container.appendChild(text);
		  return container.innerHTML; // innerHTML will be a xss safe string
		}		
        // Initialize vacation_request table
        $('#vacation_table_1').dataTable({
			"aaSorting": [ [0,'desc'] ]
			
		});
        $('#vacation_table_2').dataTable({
			"aaSorting": [ [0,'desc'] ]
			
		});	
        $('#vacation_table_3').dataTable({
			"aaSorting": [ [0,'desc'] ]
			
		});			
		// Initialie Date
		$('.input-daterange').datepicker({
			todayBtn: "linked",
			format: 'yyyy/m/d',
			autoclose: true,
			startDate: '+1d'
			
		});
		
		
        $('.summernote').summernote({		
				placeholder: 'Please write a reason here...',
				height: 200,                 // set editor height
				minHeight: null,             // set minimum height of editor
				maxHeight: null,             // set maximum height of editor
				focus: true,
				toolbar: [
					['headline', ['style']],
					['style', ['bold', 'italic', 'underline', 'superscript', 'subscript', 'strikethrough', 'clear']],
					['textsize', ['fontsize']],
					['alignment', ['ul', 'ol', 'paragraph', 'lineheight']],
				],

				onChange: function() {
				var reason = $('.summernote').code();
				var reason_check_content = stripHTML(reason);				
					if ($.trim(reason_check_content).length > 0) {
						$(".note-editor").removeClass("summernote-css-error");
						$(".note-editor").addClass("summernote-css-success");	
					}else {
						$(".note-editor").addClass("summernote-css-error");
						$(".note-editor").removeClass("summernote-css-success");	
						toastr.error('Please put a reason.','System Message:');						
					} 
				}

			
        });	
	
		
    });

</script>

</body>
</html>
<?
}
?>