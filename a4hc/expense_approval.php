<?
include("inc/db.php");
include('inc/header.php');
session_start();
$url_expense_id = $_GET['expense_id'];
?>

<?
if(empty($_SESSION['login_user']) or $auth== "regular" ) {
	if ($url_expense_id == "") {
		echo "<meta http-equiv=\"refresh\" content=\"0; url=./login\">";
	}else {
		echo "<meta http-equiv=\"refresh\" content=\"0; url=./login?path=expenseapproval&hash=expense_claim_&id=$url_expense_id\">";		
	}

}else {

?>

<!-- Simple splash screen-->
<div class="splash"> <div class="color-line"></div><div class="splash-title"><h1>Expense Approval Page</h1><p>Loading...</p><div class="spinner"> <div class="rect1"></div> <div class="rect2"></div> <div class="rect3"></div> <div class="rect4"></div> <div class="rect5"></div> </div> </div> </div>
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
                            <span>Expense Approvals</span>
                        </li>
                    </ol>
                </div>
				<div>
                <h2 class="font-light m-b-xs">
                  Expense Approvals
                </h2>
                <small>You can approve expense submissions here!</small>
				</div>
            </div>
        </div>
    </div>
<?

if ($auth == "admin") {
	$query_expense_result = mysqli_query($db, "SELECT * FROM expense_claim");	
}else {
	$query_expense_result = mysqli_query($db, "SELECT * FROM expense_claim WHERE notifier='$user'");	
}

$result_num = mysqli_num_rows($query_expense_result);
if ($result_num == 0) {?>
	<p style="text-align:center; padding-top:30px; padding-bottom:100%;">No claims yet!</p>
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
                <li class="active"><a data-toggle="tab" href="#tab-1"><span class="text-warning">Submitted Expense Claims</span></a></li>
                <li class=""><a data-toggle="tab" href="#tab-2"><span class="text-success">Approved Expense Claims</span></a></li>
                <li class=""><a data-toggle="tab" href="#tab-3"><span class="text-danger">Rejected Expense Claims</span></a></li>
            </ul>
            <div class="tab-content">
                <div id="tab-1" class="tab-pane active">
                <div class="panel-body">
                <table id="expense_table_1" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th>Expense ID / Requestee</th>
                    <th>Status / Supervisor</th>
					<th>Details</th>
                </tr>
                </thead>
                <tbody>
				<?
				
				if ($auth == "admin") {
					$query_expense_result = mysqli_query($db, "SELECT * FROM expense_claim WHERE application_status='Submitted' ORDER BY id asc");	
				}else {
					$query_expense_result = mysqli_query($db, "SELECT * FROM expense_claim WHERE notifier='$user' AND application_status='Submitted' ORDER BY id asc");	
				}				
					while($expense_array = mysqli_fetch_assoc($query_expense_result)) {
						$tax_rate = 0.05;
						$total_amount = $expense_array['total_amount'];
						$total_gst = $expense_array['total_gst'];
						$status = $expense_array['application_status'];
						$generated_id = $expense_array['expense_generated_id'];
						$payee_id = $expense_array['payee_name'];
						$expense_id = $expense_array['id'];
						$requested_user_id = $expense_array['requested_user'];
						$requested_supervisor_id = $expense_array['notifier'];
						$by_supervisor = $expense_array['by_supervisor'];
						$created_on = $expense_array['time_stamp'];
						$approved_on = $expense_array['supervisor_action_time'];
						$payee_type = $expense_array['payee_type'];
						
						$modal_detail_id = 'expense_claim_'.$expense_id;
						
						$payee_name = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM payee WHERE id='$payee_id'"));
						$payee_name = $payee_name['name'];
						
						$expense_pdf_query = mysqli_query($db, "SELECT * FROM file_upload WHERE request_id='$expense_id' AND topic='expense'");
						$expense_pdf_array = mysqli_fetch_assoc($expense_pdf_query);
						$expense_pdf_destination = $expense_pdf_array['file_destination'];
						$expense_pdf_name = $expense_pdf_array['real_file_name'];
						
						$user_name_query = mysqli_query($db, "SELECT * FROM user WHERE id='$requested_user_id'");
						$user_name_array = mysqli_fetch_assoc($user_name_query);
						$request_fname = $user_name_array['fname'];
						$request_lname = $user_name_array['lname'];						
						
						$super_name_query = mysqli_query($db, "SELECT * FROM user WHERE id='$requested_supervisor_id'");
						$super_name_array = mysqli_fetch_assoc($super_name_query);
						$request_super_fname = $super_name_array['fname'];
						$request_super_lname = $super_name_array['lname'];		

						$by_supervisor_query = mysqli_query($db, "SELECT * FROM user WHERE id='$by_supervisor'");
						$by_supervisor_array = mysqli_fetch_assoc($by_supervisor_query);
						$by_supervisor_fname = $by_supervisor_array['fname'];
						$by_supervisor_lname = $by_supervisor_array['lname'];						
						
				?>
						<tr>
							<td><strong><?echo "$generated_id / $request_fname $request_lname";?></strong></strong></td>
							<?
							
							if ($status == "Submitted"){?>
							<td class="text-warning"><?echo "$status / $request_super_fname $request_super_lname";?></td>	
							<?}else if ($status == "Approved") {?>
							<td class="text-success"><?echo "$status / $request_super_fname $request_super_lname";?></td>	
							<?}else {?>
							<td class="text-danger"><?echo "$status / $request_super_fname $request_super_lname";?></td>	
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
												<h4 class="modal-title">Expense Claim<br/>(
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
												<h5><p><?echo $generated_id;?></p></h5>
											</div>
										
												<div class="modal-body">
												
													<div class="row"><div class="col-lg-12"><p class="pull-left"><strong>Expense ID: </strong><?echo $generated_id;?></p></div></div>
													<?
														if ($payee_type == "new") {?>
															<div class="row"><div class="col-lg-12"><p class="pull-left"><strong>Payee: </strong><?echo $payee_id;?>  <span class="text-danger" data-toggle="tooltip" data-placement="top" title="To add new payee, please contact administrator">**Needs To Be Added or Changed</span></p></div></div>
															
															<select id="payee_name_<?echo $expense_id?>" class="expense_payee" style="width: 100%">
																<optgroup label="Payee Names">
																	<option selected>Select a Payee</option>
																<?
																$payee_query = mysqli_query($db, "SELECT * FROM payee ORDER BY name asc");
																while($payee_array = mysqli_fetch_assoc($payee_query)) {
																	$payee_name = $payee_array['name'];
																	$payee_id_2 = $payee_array['id'];
																?>
																	<option value="<?echo $payee_id_2?>"><?echo "$payee_name - (ID:$payee_id_2)"?></option>
																<?}?>
																</optgroup>
															</select>															
			
														<?}else {?>
															<div class="row"><div class="col-lg-12"><p class="pull-left"><strong>Payee: </strong><?echo $payee_name;?></p></div></div>
														<?}
													?>
													<div class="row"><div class="col-lg-12"><p class="pull-left"><strong>Amount (Before GST): </strong>$<?echo $total_amount;?></p></div></div>
													<div class="row"><div class="col-lg-12"><p class="pull-left"><strong>GST: </strong>$<?echo $total_gst;?></p></div></div>
													<div class="row"><div class="col-lg-12"><p class="pull-left"><strong>Total Amount (After GST): </strong>$<?echo number_format($total_amount+$total_gst,2);?></p></div></div>
													<div class="table-responsive">
														<table cellpadding="1" cellspacing="1" class="table table-bordered table-striped">
															<thead>
															<tr>
																<th>Project Name</th>
																<th>Expense Item</th>
																<th>Amount</th>
																<th>GST Expense</th>
																<th>GST Rebate</th>
																<th>GST Total</th>
															</tr>
															</thead>
															<tbody>														
															<?
																$expense_claim_array = mysqli_query($db, "SELECT * FROM expense_claim_detail WHERE expense_id='$expense_id'");
																$expense_claim_amount_array = mysqli_query($db, "SELECT * FROM expense_claim WHERE id='$expense_id'");																
																$expense_claim_amount_result = mysqli_fetch_assoc($expense_claim_amount_array);
																$expense_claim_total_amount = $expense_claim_amount_result['total_amount'];
																$expense_claim_total_gst = $expense_claim_amount_result['total_gst'];																
																$amount_accum = 0;
																$gst_e_accum = 0;
																$gst_r_accum = 0;
																$gst_t_accum = 0;
																while ($expense_claim_result = mysqli_fetch_assoc($expense_claim_array)) {
																		
																		$project_name = $expense_claim_result['project_name'];
																		$expense_code = $expense_claim_result['expense_code'];
																		$amount = $expense_claim_result['amount'];
																		$gst_total = $amount*$expense_claim_total_gst/$expense_claim_total_amount;
																		$gst_expense = $amount*$expense_claim_total_gst/$expense_claim_total_amount/2;
																		$gst_rebate = $gst_total-$gst_expense;
																		
																		$amount_accum = $amount_accum + $amount;
																		$gst_e_accum = $gst_e_accum + $gst_expense;
																		$gst_r_accum = $gst_r_accum + $gst_rebate;
																		$gst_t_accum = $gst_t_accum + $gst_total;
																		
																		$project_name_result = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM project WHERE id='$project_name'"));
																		$project_name_actual = $project_name_result['project_name'];
																		$project_number_actual = $project_name_result['project_number'];
																		
																		$expense_result = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM accounting_code WHERE code='$expense_code'"));
																		$expense_description = $expense_result['description'];																
	
															?>
																<tr class="row_repeat">
																	<td><?echo $project_name_actual?></td>
																	<td><?echo "$expense_description - ($expense_code)"?></td>
																	<td>$<?echo $amount?></td>
																	<td>$<?echo number_format($gst_expense,2)?></td>
																	<td>$<?echo number_format($gst_rebate,2)?></td>
																	<td>$<?echo number_format($gst_total,2)?></td>
																</tr>																	
															<?}
															?>
																<tr class="row_total">
																	<td></td>
																	<td><strong>Total:</strong></td>
																	<td><strong>$<?echo number_format($amount_accum,2)?></strong></td>
																	<td><strong>$<?echo number_format($gst_e_accum,2)?></strong></td>
																	<td><strong>$<?echo number_format($gst_r_accum,2)?></strong></td>
																	<td><strong>$<?echo number_format($gst_t_accum,2)?></strong></td>
																</tr>																
															</tbody>
														</table>					
													</div>	

													<div class="row"><div class="col-lg-12"><p class="pull-left"><strong>Submitted Invoice: </strong>
													<a href="#" onClick="window.open('pdf_view/pdf_view.php?task=expense&path=<?echo $expense_pdf_destination;?>','pagename','resizable,height=1000,width=1000'); return false;"><span class="text-danger">
													
													<?
													if ($payee_type == "new") {?>
														<?echo $payee_id?><?echo basename($expense_pdf_destination);?></span></a>
													<?}else {?>
														<?echo basename($expense_pdf_destination);?></span></a>
													<?}
													?>
													</p></div></div>
													<div class="row"><div class="col-lg-12"><p class="pull-left"><strong>Created By: </strong> <?echo "$request_fname $request_lname";?> on <?echo $created_on;?></div></div>
													<div class="row"><div class="col-lg-12"><p class="pull-left"><strong>Sent to Supervisor: </strong> <?echo "$request_super_fname $request_super_lname";?></div></div>
												<strong><p style="text-align:left">Comments:</p></strong>	
												<textarea id="expense_approval_<?echo $expense_id?>" class="form-control field_value_<?echo $expense_id?>" rows="5" placeholder="Write a comment here..."></textarea>													
													
												</div>
												<div class="modal-footer">
													<div class="pull-right"><button type="button" class="btn btn-default close_js" data-remodal-action="close">Close</button></div>
													<div class="pull-left">
														<button type="button" class="btn btn-success action_button" id="approve_<?echo $expense_id?>">Approve</button>
														<button type="button" class="btn btn-danger action_button" id="reject_<?echo $expense_id?>">Reject</button>
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
                <table id="expense_table_2" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th>Expense ID / Requestee</th>
                    <th>Status / Supervisor</th>
					<th>Details</th>
                </tr>
                </thead>
                <tbody>
				<?
				if ($auth == "admin") {
					$query_expense_result = mysqli_query($db, "SELECT * FROM expense_claim WHERE application_status='Approved' ORDER BY id asc");	
				}else {
					$query_expense_result = mysqli_query($db, "SELECT * FROM expense_claim WHERE notifier='$user' AND application_status='Approved' ORDER BY id asc");	
				}
					while($expense_array = mysqli_fetch_assoc($query_expense_result)) {
						$tax_rate = 0.05;
						$total_amount = $expense_array['total_amount'];
						$total_gst = $expense_array['total_gst'];
						$status = $expense_array['application_status'];
						$generated_id = $expense_array['expense_generated_id'];
						$payee_id = $expense_array['payee_name'];
						$expense_id = $expense_array['id'];
						$requested_user_id = $expense_array['requested_user'];
						$requested_supervisor_id = $expense_array['notifier'];
						$by_supervisor = $expense_array['by_supervisor'];
						$created_on = $expense_array['time_stamp'];
						$approved_on = $expense_array['supervisor_action_time'];
						$comment = $expense_array['comment'];
						
						$modal_detail_id = 'expense_claim_'.$expense_id;
						
						if (strlen ( $payee_id ) != 1) {
							$payee_name = $expense_array['payee_name'];
						}else {
							$payee_name = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM payee WHERE id='$payee_id'"));
							$payee_name = $payee_name['name'];							
						}

						
						$expense_pdf_query = mysqli_query($db, "SELECT * FROM file_upload WHERE request_id='$expense_id' AND topic='expense'");
						$expense_pdf_array = mysqli_fetch_assoc($expense_pdf_query);
						$expense_pdf_destination = $expense_pdf_array['file_destination'];
						$expense_pdf_name = $expense_pdf_array['real_file_name'];
						
						$user_name_query = mysqli_query($db, "SELECT * FROM user WHERE id='$requested_user_id'");
						$user_name_array = mysqli_fetch_assoc($user_name_query);
						$request_fname = $user_name_array['fname'];
						$request_lname = $user_name_array['lname'];						
						
						$super_name_query = mysqli_query($db, "SELECT * FROM user WHERE id='$requested_supervisor_id'");
						$super_name_array = mysqli_fetch_assoc($super_name_query);
						$request_super_fname = $super_name_array['fname'];
						$request_super_lname = $super_name_array['lname'];		

						$by_supervisor_query = mysqli_query($db, "SELECT * FROM user WHERE id='$by_supervisor'");
						$by_supervisor_array = mysqli_fetch_assoc($by_supervisor_query);
						$by_supervisor_fname = $by_supervisor_array['fname'];
						$by_supervisor_lname = $by_supervisor_array['lname'];						
						
				?>
						<tr>
							<td><strong><?echo "$generated_id / $request_fname $request_lname";?></strong></strong></td>
							<?
							
							if ($status == "Submitted"){?>
							<td class="text-warning"><?echo "$status / $request_super_fname $request_super_lname";?></td>	
							<?}else if ($status == "Approved") {?>
							<td class="text-success"><?echo "$status / $request_super_fname $request_super_lname";?></td>		
							<?}else {?>
							<td class="text-danger"><?echo "$status / $request_super_fname $request_super_lname";?></td>	
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
												<h4 class="modal-title">Expense Claim<br/>(
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
												<h5><p><?echo $generated_id;?></p></h5>
											</div>
										
												<div class="modal-body">
												
													<div class="row"><div class="col-lg-12"><p class="pull-left"><strong>Expense ID: </strong><?echo $generated_id;?></p></div></div>
													<div class="row"><div class="col-lg-12"><p class="pull-left"><strong>Payee: </strong><?echo $payee_name;?></p></div></div>
													<div class="row"><div class="col-lg-12"><p class="pull-left"><strong>Amount (Before GST): </strong>$<?echo $total_amount;?></p></div></div>
													<div class="row"><div class="col-lg-12"><p class="pull-left"><strong>GST: </strong>$<?echo $total_gst;?></p></div></div>
													<div class="row"><div class="col-lg-12"><p class="pull-left"><strong>Total Amount (After GST): </strong>$<?echo number_format($total_amount+$total_gst,2);?></p></div></div>
													<div class="table-responsive">
														<table cellpadding="1" cellspacing="1" class="table table-bordered table-striped">
															<thead>
															<tr>
																<th>Project Name</th>
																<th>Expense Item</th>
																<th>Amount</th>
																<th>GST Expense</th>
																<th>GST Rebate</th>
																<th>GST Total</th>
															</tr>
															</thead>
															<tbody>														
															<?
																$expense_claim_array = mysqli_query($db, "SELECT * FROM expense_claim_detail WHERE expense_id='$expense_id'");
																$expense_claim_amount_array = mysqli_query($db, "SELECT * FROM expense_claim WHERE id='$expense_id'");																
																$expense_claim_amount_result = mysqli_fetch_assoc($expense_claim_amount_array);
																$expense_claim_total_amount = $expense_claim_amount_result['total_amount'];
																$expense_claim_total_gst = $expense_claim_amount_result['total_gst'];																
																
																$amount_accum = 0;
																$gst_e_accum = 0;
																$gst_r_accum = 0;
																$gst_t_accum = 0;
																while ($expense_claim_result = mysqli_fetch_assoc($expense_claim_array)) {
																		
																		$project_name = $expense_claim_result['project_name'];
																		$expense_code = $expense_claim_result['expense_code'];
																		$amount = $expense_claim_result['amount'];
																		$gst_total = $amount*$expense_claim_total_gst/$expense_claim_total_amount;
																		$gst_expense = $amount*$expense_claim_total_gst/$expense_claim_total_amount/2;
																		$gst_rebate = $gst_total-$gst_expense;
																		
																		$amount_accum = $amount_accum + $amount;
																		$gst_e_accum = $gst_e_accum + $gst_expense;
																		$gst_r_accum = $gst_r_accum + $gst_rebate;
																		$gst_t_accum = $gst_t_accum + $gst_total;
																		
																		$project_name_result = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM project WHERE id='$project_name'"));
																		$project_name_actual = $project_name_result['project_name'];
																		$project_number_actual = $project_name_result['project_number'];
																		
																		$expense_result = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM accounting_code WHERE code='$expense_code'"));
																		$expense_description = $expense_result['description'];																
	
															?>
																<tr class="row_repeat">
																	<td><?echo $project_name_actual?></td>
																	<td><?echo "$expense_description - ($expense_code)"?></td>
																	<td>$<?echo $amount?></td>
																	<td>$<?echo number_format($gst_expense,2)?></td>
																	<td>$<?echo number_format($gst_rebate,2)?></td>
																	<td>$<?echo number_format($gst_total,2)?></td>
																</tr>																	
															<?}
															?>
																<tr class="row_total">
																	<td></td>
																	<td><strong>Total:</strong></td>
																	<td><strong>$<?echo number_format($amount_accum,2)?></strong></td>
																	<td><strong>$<?echo number_format($gst_e_accum,2)?></strong></td>
																	<td><strong>$<?echo number_format($gst_r_accum,2)?></strong></td>
																	<td><strong>$<?echo number_format($gst_t_accum,2)?></strong></td>
																</tr>																
															</tbody>
														</table>					
													</div>	

													<div class="row"><div class="col-lg-12"><p class="pull-left"><strong>Submitted Invoice: </strong>
													<a href="#" onClick="window.open('pdf_view/pdf_view.php?task=expense&path=<?echo $expense_pdf_destination;?>','pagename','resizable,height=1000,width=1000'); return false;"><span class="text-danger">
													
													<?
													if ($payee_type == "new") {?>
														<?echo $payee_id?><?echo basename($expense_pdf_destination);?></span></a>
													<?}else {?>
														<?echo basename($expense_pdf_destination);?></span></a>
													<?}
													?>
													</p></div></div>
													<div class="row"><div class="col-lg-12"><p class="pull-left"><strong>Created By: </strong> <?echo "$request_fname $request_lname";?> on <?echo $created_on;?></div></div>
													<div class="row"><div class="col-lg-12"><p class="pull-left"><strong>Sent to Supervisor: </strong> <?echo "$request_super_fname $request_super_lname";?></div></div>
													
													<?
													if ($status != "Submitted") {
														if ($status == "Rejected") {?>
														<div class="row"><div class="col-lg-12"><p class="pull-left"><strong>Rejected By: </strong> <?echo "$by_supervisor_fname $by_supervisor_lname";?> on <?echo $approved_on?></div></div>																
													<?	}else {?>
														<div class="row"><div class="col-lg-12"><p class="pull-left"><strong>Approved By: </strong> <?echo "$by_supervisor_fname $by_supervisor_lname";?> on <?echo $approved_on?></div></div>															
													<?}
													}
													?>
													<div class="hpanel hgreen">
														<div class="panel-body">
															<span class="font-trans font-bold">Comments:<br/>
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
													<div class="pull-right"><button type="button" class="btn btn-default" data-remodal-action="close">Close</button></div>
													<div class="pull-left">
														<button type="button" class="btn btn-warning pdf_export" id="pdf_<?echo $expense_id?>">Export as PDF</button>
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
				<div id="tab-3" class="tab-pane">
                <div class="panel-body">
                <table id="expense_table_3" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th>Expense ID / Requestee</th>
                    <th>Status / Supervisor</th>
					<th>Details</th>
                </tr>
                </thead>
                <tbody>
				<?
				if ($auth == "admin") {
					$query_expense_result = mysqli_query($db, "SELECT * FROM expense_claim WHERE application_status='Rejected' ORDER BY id asc");	
				}else {
					$query_expense_result = mysqli_query($db, "SELECT * FROM expense_claim WHERE notifier='$user' AND application_status='Rejected' ORDER BY id asc");	
				}
					while($expense_array = mysqli_fetch_assoc($query_expense_result)) {
						$tax_rate = 0.05;
						$total_amount = $expense_array['total_amount'];
						$total_gst = $expense_array['total_gst'];
						$status = $expense_array['application_status'];
						$generated_id = $expense_array['expense_generated_id'];
						$payee_id = $expense_array['payee_name'];
						$expense_id = $expense_array['id'];
						$requested_user_id = $expense_array['requested_user'];
						$requested_supervisor_id = $expense_array['notifier'];
						$by_supervisor = $expense_array['by_supervisor'];
						$created_on = $expense_array['time_stamp'];
						$approved_on = $expense_array['supervisor_action_time'];
						$comment = $expense_array['comment'];
						$payee_type = $expense_array['payee_type'];
						
						$modal_detail_id = 'expense_claim_'.$expense_id;
						
						$payee_name = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM payee WHERE id='$payee_id'"));
						$payee_name = $payee_name['name'];
						
						$expense_pdf_query = mysqli_query($db, "SELECT * FROM file_upload WHERE request_id='$expense_id' AND topic='expense'");
						$expense_pdf_array = mysqli_fetch_assoc($expense_pdf_query);
						$expense_pdf_destination = $expense_pdf_array['file_destination'];
						$expense_pdf_name = $expense_pdf_array['real_file_name'];
						
						$user_name_query = mysqli_query($db, "SELECT * FROM user WHERE id='$requested_user_id'");
						$user_name_array = mysqli_fetch_assoc($user_name_query);
						$request_fname = $user_name_array['fname'];
						$request_lname = $user_name_array['lname'];						
						
						$super_name_query = mysqli_query($db, "SELECT * FROM user WHERE id='$requested_supervisor_id'");
						$super_name_array = mysqli_fetch_assoc($super_name_query);
						$request_super_fname = $super_name_array['fname'];
						$request_super_lname = $super_name_array['lname'];		

						$by_supervisor_query = mysqli_query($db, "SELECT * FROM user WHERE id='$by_supervisor'");
						$by_supervisor_array = mysqli_fetch_assoc($by_supervisor_query);
						$by_supervisor_fname = $by_supervisor_array['fname'];
						$by_supervisor_lname = $by_supervisor_array['lname'];						
						
				?>
						<tr>
							<td><strong><?echo "$generated_id / $request_fname $request_lname";?></strong></strong></td>
							<?
							
							if ($status == "Submitted"){?>
							<td class="text-warning"><?echo "$status / $request_super_fname $request_super_lname";?></td>	
							<?}else if ($status == "Approved") {?>
							<td class="text-success"><?echo "$status / $request_super_fname $request_super_lname";?></td>	
							<?}else {?>
							<td class="text-danger"><?echo "$status / $request_super_fname $request_super_lname";?></td>	
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
												<h4 class="modal-title">Expense Claim<br/>(
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
												<h5><p><?echo $generated_id;?></p></h5>
											</div>
										
												<div class="modal-body">
												
													<div class="row"><div class="col-lg-12"><p class="pull-left"><strong>Expense ID: </strong><?echo $generated_id;?></p></div></div>
													<?
														if ($payee_type == "new") {?>
															<div class="row"><div class="col-lg-12"><p class="pull-left"><strong>Payee: </strong><?echo $payee_id;?></p></div></div>
														<?}else {?>
															<div class="row"><div class="col-lg-12"><p class="pull-left"><strong>Payee: </strong><?echo $payee_name;?></p></div></div>
														<?}
													?>
													<div class="row"><div class="col-lg-12"><p class="pull-left"><strong>Amount (Before GST): </strong>$<?echo $total_amount;?></p></div></div>
													<div class="row"><div class="col-lg-12"><p class="pull-left"><strong>GST: </strong>$<?echo $total_gst;?></p></div></div>
													<div class="row"><div class="col-lg-12"><p class="pull-left"><strong>Total Amount (After GST): </strong>$<?echo number_format($total_amount+$total_gst,2);?></p></div></div>
													<div class="table-responsive">
														<table cellpadding="1" cellspacing="1" class="table table-bordered table-striped">
															<thead>
															<tr>
																<th>Project Name</th>
																<th>Expense Item</th>
																<th>Amount</th>
																<th>GST Expense</th>
																<th>GST Rebate</th>
																<th>GST Total</th>
															</tr>
															</thead>
															<tbody>														
															<?
																$expense_claim_array = mysqli_query($db, "SELECT * FROM expense_claim_detail WHERE expense_id='$expense_id'");
																$expense_claim_amount_array = mysqli_query($db, "SELECT * FROM expense_claim WHERE id='$expense_id'");																
																$expense_claim_amount_result = mysqli_fetch_assoc($expense_claim_amount_array);
																$expense_claim_total_amount = $expense_claim_amount_result['total_amount'];
																$expense_claim_total_gst = $expense_claim_amount_result['total_gst'];																
																
																$amount_accum = 0;
																$gst_e_accum = 0;
																$gst_r_accum = 0;
																$gst_t_accum = 0;
																while ($expense_claim_result = mysqli_fetch_assoc($expense_claim_array)) {
																		
																		$project_name = $expense_claim_result['project_name'];
																		$expense_code = $expense_claim_result['expense_code'];
																		$amount = $expense_claim_result['amount'];
																		$gst_total = $amount*$expense_claim_total_gst/$expense_claim_total_amount;
																		$gst_expense = $amount*$expense_claim_total_gst/$expense_claim_total_amount/2;
																		$gst_rebate = $gst_total-$gst_expense;
																		
																		$amount_accum = $amount_accum + $amount;
																		$gst_e_accum = $gst_e_accum + $gst_expense;
																		$gst_r_accum = $gst_r_accum + $gst_rebate;
																		$gst_t_accum = $gst_t_accum + $gst_total;
																		
																		$project_name_result = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM project WHERE id='$project_name'"));
																		$project_name_actual = $project_name_result['project_name'];
																		$project_number_actual = $project_name_result['project_number'];
																		
																		$expense_result = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM accounting_code WHERE code='$expense_code'"));
																		$expense_description = $expense_result['description'];																
	
															?>
																<tr class="row_repeat">
																	<td><?echo $project_name_actual?></td>
																	<td><?echo "$expense_description - ($expense_code)"?></td>
																	<td>$<?echo $amount?></td>
																	<td>$<?echo number_format($gst_expense,2)?></td>
																	<td>$<?echo number_format($gst_rebate,2)?></td>
																	<td>$<?echo number_format($gst_total,2)?></td>
																</tr>																	
															<?}
															?>
																<tr class="row_total">
																	<td></td>
																	<td><strong>Total:</strong></td>
																	<td><strong>$<?echo number_format($amount_accum,2)?></strong></td>
																	<td><strong>$<?echo number_format($gst_e_accum,2)?></strong></td>
																	<td><strong>$<?echo number_format($gst_r_accum,2)?></strong></td>
																	<td><strong>$<?echo number_format($gst_t_accum,2)?></strong></td>
																</tr>																
															</tbody>
														</table>					
													</div>	

													<div class="row"><div class="col-lg-12"><p class="pull-left"><strong>Submitted Invoice: </strong>
													<a href="#" onClick="window.open('pdf_view/pdf_view.php?task=expense&path=<?echo $expense_pdf_destination;?>','pagename','resizable,height=1000,width=1000'); return false;"><span class="text-danger">
													
													<?
													if ($payee_type == "new") {?>
														<?echo $payee_id?><?echo basename($expense_pdf_destination);?></span></a>
													<?}else {?>
														<?echo basename($expense_pdf_destination);?></span></a>
													<?}
													?>
													</p></div></div>
													<div class="row"><div class="col-lg-12"><p class="pull-left"><strong>Created By: </strong> <?echo "$request_fname $request_lname";?> on <?echo $created_on;?></div></div>
													<div class="row"><div class="col-lg-12"><p class="pull-left"><strong>Sent to Supervisor: </strong> <?echo "$request_super_fname $request_super_lname";?></div></div>
													
													<?
													if ($status != "Submitted") {
														if ($status == "Rejected") {?>
														<div class="row"><div class="col-lg-12"><p class="pull-left"><strong>Rejected By: </strong> <?echo "$by_supervisor_fname $by_supervisor_lname";?> on <?echo $approved_on?></div></div>																
													<?	}else {?>
														<div class="row"><div class="col-lg-12"><p class="pull-left"><strong>Approved By: </strong> <?echo "$by_supervisor_fname $by_supervisor_lname";?> on <?echo $approved_on?></div></div>															
													<?}
													?>
												
													<?}
													?>
													
													<?
													?>
													<div class="hpanel hred">
														<div class="panel-body">
															<span class="font-trans font-bold">Comments:<br/>
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
													<button type="button" class="btn btn-default" data-remodal-action="close">Close</button>
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
<input type="hidden" id="hidden_user" value="<?echo $user?>">                 
<input type="hidden" id="hidden_username" value="<?echo $user?>">                 
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
<script src="js_custom/expense_claim_pdf_export.js"></script>


<!-- App scripts -->
<script src="scripts/homer.js"></script>
<script src="js_custom/expense_claim.js"></script>
<script src="js_custom/date.js"></script>
<script>
	$('#expense_table_1').dataTable({
	
		
	});
	$('#expense_table_2').dataTable({
	
		
	});
	$('#expense_table_3').dataTable({
	
		
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