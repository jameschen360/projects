<?
include("inc/db.php");
include('inc/header.php');
session_start();
$url_expense_id = $_GET['expense_id'];
?>

<?
if(empty($_SESSION['login_user'])) {
	if ($url_expense_id == "") {
		echo "<meta http-equiv=\"refresh\" content=\"0; url=./login\">";
	}else {
		echo "<meta http-equiv=\"refresh\" content=\"0; url=./login?path=expenseclaim&hash=expense_claim_&id=$url_expense_id\">";		
	}

}else {

?>

<!-- Simple splash screen-->
<div class="splash"> <div class="color-line"></div><div class="splash-title"><h1>A4HC Expense Claims</h1><p>Loading...</p><div class="spinner"> <div class="rect1"></div> <div class="rect2"></div> <div class="rect3"></div> <div class="rect4"></div> <div class="rect5"></div> </div> </div> </div>
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
                            <span>Expense Claims</span>
                        </li>
                    </ol>
                </div>
                <h2 class="font-light m-b-xs">
                  Expense Claims
                </h2>
                <small>You can make a expense claim here!</small>
				<div class="panel-header"></br>
				</div>
				<div class="panel-header">
				<button type="button" class="btn btn-success" data-remodal-target="expense_claim">
				Make a Claim
				</button>
				</div>
            </div>
        </div>
    </div>

<?

$query_expense_result = mysqli_query($db, "SELECT * FROM expense_claim WHERE requested_user='$user'");


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
                <li class=""><a data-toggle="tab" href="#tab-3"><span class="text-danger">Rejected Expense Claims</a></li>
            </ul>
            <div class="tab-content">
                <div id="tab-1" class="tab-pane active">
                <div class="panel-body">
                <table id="expense_table_1" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th>Expense ID</th>
                    <th>Status</th>
					<th>View</th>
                </tr>
                </thead>
                <tbody>
				<?
				$query_expense_result = mysqli_query($db, "SELECT * FROM expense_claim WHERE requested_user='$user' AND application_status='Submitted' ORDER BY id asc");
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
							<td><strong><?echo $generated_id;?></strong></strong></td>
							<?
							
							if ($status == "Submitted"){?>
							<td class="text-warning"><?echo $status;?></td>	
							<?}else if ($status == "Approved") {?>
							<td class="text-success"><?echo $status;?></td>		
							<?}else {?>
							<td class="text-danger"><?echo $status;?></td>
							<?}
							
							?>
							<td><div class="btn-group cell-center"><button type="button" class="btn w-xs btn-info btn-xs" data-remodal-target="<?echo $modal_detail_id;?>">
								Details
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
													if ($approved_on != "") {?>
														<div class="row"><div class="col-lg-12"><p class="pull-left"><strong>Approved By: </strong> <?echo "$by_supervisor_fname $by_supervisor_lname";?> on <?echo $approved_on?></div></div>													
													<?}
													?>
													
													<?
													?>
												</div>
												<div class="modal-footer">
													<div class="pull-right"><button type="button" class="btn btn-default close_js" data-remodal-action="close">Close</button></div>
													<div class="pull-left">
														<button type="button" class="btn btn-danger button_delete" id="delete_<?echo $expense_id?>">Delete</button>
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
                    <th>Expense ID</th>
                    <th>Status</th>
					<th>View</th>
                </tr>
                </thead>
                <tbody>
				<?
				$query_expense_result = mysqli_query($db, "SELECT * FROM expense_claim WHERE requested_user='$user' AND application_status='approved' ORDER BY id asc");
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
							<td><strong><?echo $generated_id;?></strong></strong></td>
							<?
							
							if ($status == "Submitted"){?>
							<td class="text-warning"><?echo $status;?></td>	
							<?}else if ($status == "Approved") {?>
							<td class="text-success"><?echo $status;?></td>		
							<?}else {?>
							<td class="text-danger"><?echo $status;?></td>
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
                    <th>Expense ID</th>
                    <th>Status</th>
					<th>View</th>
                </tr>
                </thead>
                <tbody>
				<?
				$query_expense_result = mysqli_query($db, "SELECT * FROM expense_claim WHERE requested_user='$user' AND application_status='Rejected' ORDER BY id asc");
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
							<td><strong><?echo $generated_id;?></strong></strong></td>
							<?
							
							if ($status == "Submitted"){?>
							<td class="text-warning"><?echo $status;?></td>	
							<?}else if ($status == "Approved") {?>
							<td class="text-success"><?echo $status;?></td>		
							<?}else {?>
							<td class="text-danger"><?echo $status;?></td>
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
<!-- make request modal -->
	<div id="expense_claim_remodal" class="remodal-bg">
		<div class="remodal" data-remodal-id="expense_claim" data-remodal-options="hashTracking: false, closeOnOutsideClick: false">
				<div class="color-line"></div>
				<div class="modal-header">
					<h4 class="modal-title">Make an Expense Claim</h4>
				</div>
			
					<div class="modal-body">
					
					<form id="expense_form" method="POST" enctype="multipart/form-data" >
					<div class="row">
						<div class="col-lg-8" style="padding:18px;">
							<div class="form-group">
								<label class="control-label pull-left" for="payee_name">Payee Name: <i class="text-danger">*</i></label>
								
								<a href="#" id="new_payee" title="Suggest New Payee Here" class="text-info pull-right" data-toggle="tooltip" data-placement="top"> New Payee (Click Here)</a>
								<a href="#" id="select_payee" class="text-info pull-right"> Select Existing Payee</a>								
								
								<div id="payee_original">
									<select id="payee_name" class="expense_payee" style="width: 100%">
										<optgroup label="Payee Names">
											<option selected>Select a Payee</option>
										<?
										$payee_query = mysqli_query($db, "SELECT * FROM payee ORDER BY name asc");
										while($payee_array = mysqli_fetch_assoc($payee_query)) {
											$payee_name = $payee_array['name'];
											$payee_id = $payee_array['id'];
										?>
											<option value="<?echo $payee_id?>"><?echo "$payee_name - (ID:$payee_id)"?></option>
										<?}?>
										</optgroup>
									</select>			
								</div>
								<div id="payee_new">
									<input type="text" class="form-control" id="new_payee_input" value="" placeholder="Input New Payee Name">
								</div>								
								<label class="control-label pull-left" for="supervisor">Supervisor's Name: <i class="text-danger">*</i></label>
									<select id="supervisor" class="supervisor" style="width: 100%">
										<optgroup label="Supervisor Names">
										<?
										$supervisor_query = mysqli_query($db, "SELECT * FROM user WHERE auth='super' OR auth='admin' AND id<>$user ORDER BY lname asc");
										while($supervisor_array = mysqli_fetch_assoc($supervisor_query)) {
											$supervisor_fname = $supervisor_array['fname'];
											$supervisor_lname = $supervisor_array['lname'];
											$supervisor_id = $supervisor_array['id'];
											$supervisor_email = $supervisor_array['username'];
											
											$check_result = mysqli_num_rows(mysqli_query($db, "SELECT * FROM user WHERE supervisor='$supervisor_id' AND id='$user'"));
											if ($check_result == 1) {?>
												<option value="<?echo $supervisor_id?>" selected="selected"><?echo "$supervisor_lname, $supervisor_fname ($supervisor_email) -DEFAULT"?></option>
										<?	}else {?>
												<option value="<?echo $supervisor_id?>"><?echo "$supervisor_lname, $supervisor_fname ($supervisor_email)"?></option>
										<?	}
											
										?>
												
										<?}?>	
										</optgroup>										
									</select>
									<?
										$user_supervisor = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM user where id='$user'"));
										$user_supervisor = $user_supervisor['supervisor'];
										
										$supervisor_name = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM user where id='$user_supervisor'"));
										$supervisor_fname = $supervisor_name['fname'];
										$supervisor_lname = $supervisor_name['lname'];
										$supervisor_id_2 = $supervisor_name['id'];
									?>
								<label class="control-label pull-left" for="supervisor">Total Amount $ (Before GST): <i class="text-danger">*</i></label>
								<input type="number" class="form-control total_check" id="total_amount_entered" value="" placeholder="0">
								<label class="control-label pull-left" for="supervisor">Total GST $: <i class="text-danger">*</i></label>
								<input type="number" class="form-control total_check" id="total_gst_entered" value="" placeholder="0">
							</div>
						<button type="button" id="continue_table" class="btn btn-info pull-left">Continue</button>
						<button type="button" id="revert_table" class="btn btn-danger pull-left">Change Input</button>
						</div>	
						<div class="col-lg-4" >
							<input id="proposal" class="upload" type="file"/>
							<div class="col-lg-12">
								<div class="hpanel">
									<div class="panel-heading">Invoice <i class="text-danger">*</i></div>
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
					<div id="table_form"><hr/>
						<div class="col-lg-12 row">
							<h5>	
							
								<label class="control-label pull-left" style="padding-right:25px;">Amount (Before GST): $<i class="text-info amount_all">0.00</i></label>
								<label class="control-label pull-left" style="padding-right:25px;">Total GST: $<i class="text-info gst_all">0.00</i></label>
								<label class="control-label pull-left" style="padding-right:25px;">Total GST Expense: $<i class="text-info gst_e">0.00</i></label>
								<label class="control-label pull-left">Total GST Rebate: $<i class="text-info gst_r">0.00</i></label>
								
							
							</h5>	
						</div>		
						<div class="row">
							<div class="col-lg-12">
								<div class="table-responsive">
								<table id="expense_table" cellpadding="1" cellspacing="1" class="table table-bordered table-striped">
									<thead>
									<tr>
										
										<th>Delete</th>
										<th>Project Name <i class="text-danger">*</i></th>
										<th>Expense Item <i class="text-danger">*</i></th>
										<th>Amount ($)<i class="text-danger">*</i></th>
										<th>GST Expense</th>
										<th>GST Rebate</th>
										<th>GST Total</th>
									</tr>
									</thead>
									<tbody>
									
									<tr id="row_1">
										<td><a href="#" class="remove_link row_remove_icon">X</a></td>
										<td>
											<select class="project_name_1" style="width: 100%">
												<optgroup label="Projects">
												<?
												$project_query = mysqli_query($db, "SELECT * FROM project ORDER BY project_name asc");
												while($project_array = mysqli_fetch_assoc($project_query)) {
													$project_name = $project_array['project_name'];
													$project_number = $project_array['project_number'];
													$project_id = $project_array['id'];
												?>
													<option value="<?echo $project_id?>"><?echo "$project_name - ($project_number)"?></option>
												<?}?>
												</optgroup>
											</select>									
										</td>
										<td>
											<select class="expense_code_1" style="width: 100%">
												<optgroup label="Expense Codes">
												<?
												$accounting_query = mysqli_query($db, "SELECT * FROM accounting_code ORDER BY description asc");
												while($accounting_array = mysqli_fetch_assoc($accounting_query)) {
													$accounting_code = $accounting_array['code'];
													$accounting_desc = $accounting_array['description'];
													$accounting_id = $accounting_array['id'];
												?>
													<option value="<?echo $accounting_code?>"><?echo "CODE:$accounting_code - ($accounting_desc)"?></option>
												<?}?>
												</optgroup>
											</select>									
										</td>
										<td>
											<input type="number" class="form-control amount_distr" value="0">
										</td>									
										
										<td class="gst_expense ">0.00</td>
										<td class="gst_rebate ">0.00</td>
										<td class="gst_total ">0.00</td>
									</tr>
									
									</tbody>
								</table>
									<button type="button" id="add_button" class="btn w-xs btn-info btn-sm pull-right">
										Add New Expense
									</button>	
									<h3><label class="control-label pull-left">Total Amount: $<i class="text-info total_after">0.00</i></label></h3>								
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
							<input type="hidden" id="hidden_user" value="<?echo $user;?>">
							<input type="hidden" id="hidden_username" value="<?echo $username;?>">
							<input type="hidden" id="supervisor_id_2" value="<?echo $supervisor_id_2;?>">
						</form>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default close_main" data-remodal-action="close">Close</button>
						<button type="button" id="submit_expense" class="btn btn-success">Submit</button>
					</div>
		</div><!-- tab-content -->
	</div> <!-- /form -->    

<input type="hidden" id="payee_picked_name" value=""/>	
<input type="hidden" id="payee_type" value=""/>	
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
<script src="js_custom/expense_claim_pdf_export.js"></script>
<script src="vendor/bootstrap-datepicker-master/dist/js/bootstrap-datepicker.min.js"></script>
<script src="vendor/clockpicker/dist/bootstrap-clockpicker.min.js"></script>
<script src="vendor/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<script src="vendor/select2-3.5.2/select2.min.js"></script>


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

</script>
</body>
</html>
<?
}
?>