<?
include("./inc/db.php");
include('inc/header.php');
session_start();
if(empty($_SESSION['login_user']) or $auth != "admin") {
	echo "<meta http-equiv=\"refresh\" content=\"0; url=./\">";
}else {
?>

<!-- Simple splash screen-->
<div class="splash"> <div class="color-line"></div><div class="splash-title"><h1>Project Management</h1><p>Loading...</p><div class="spinner"> <div class="rect1"></div> <div class="rect2"></div> <div class="rect3"></div> <div class="rect4"></div> <div class="rect5"></div> </div> </div> </div>
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
                        <li><a href="./index.php">Dashboard</a></li>
                        <li class="active">
                            <span>Project Management</span>
                        </li>
                    </ol>
                </div>
                <h2 class="font-light m-b-xs">
                    Project Management
                </h2>
                <small>All existing Projects</small>
				<div class="panel-header"></br>
				</div>
				<div class="panel-header">
					<button type="button" class="btn btn-success" data-remodal-target="project_modal">Add New Project</button>
				</div>
            </div>
        </div>
    </div>

<div class="content animate-panel">

    <div class="row">
        <div class="col-lg-12">
            <div class="hpanel">
                <div class="panel-heading">
                    <div class="panel-tools">
                    </div>
                </div>
                <div class="panel-body">
				
                <table id="project_table" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
					<th>Project Name</th>
					<th>View</th>
                </tr>
                </thead>
                <tbody>
				
				<?
				$project_query = mysqli_query($db, "SELECT * FROM project");
				while($project_array = mysqli_fetch_assoc($project_query)) {
					$project_id = $project_array['id'];
					$project_name = $project_array['project_name'];
					$project_number = $project_array['project_number'];
					$client_contact = $project_array['client_contact'];
					$client_email = $project_array['client_email'];
					$project_manager = $project_array['project_manager'];
					$project_start = $project_array['project_start'];
					$project_end = $project_array['project_end'];
					$proposal_attachment = $project_array['proposal_attachment'];
					$approval_attachment = $project_array['approval_attachment'];
					$agreement_attachment = $project_array['agreement_attachment'];
					$project_info = $project_array['info'];
					
					$created_on = $project_array['created_on'];
					$modified_on = $project_array['modified_on'];
					$by_whom = $project_array['by_whom'];
					
					if ($proposal_attachment == "yes") {
						$pdf_proposal_query = mysqli_query($db, "SELECT * FROM file_upload_project WHERE project_id='$project_id' AND application='proposal'");
						$pdf_proposal_array = mysqli_fetch_assoc($pdf_proposal_query);
						$proposal_file_name = $pdf_proposal_array['real_file_name'];
						$proposal_url = $pdf_proposal_array['file_destination'];						
					}
					if ($approval_attachment == "yes") {
						$pdf_approval_query = mysqli_query($db, "SELECT * FROM file_upload_project WHERE project_id='$project_id' AND application='approval'");
						$pdf_approval_array = mysqli_fetch_assoc($pdf_approval_query);
						$approval_file_name = $pdf_approval_array['real_file_name'];
						$approval_url = $pdf_approval_array['file_destination'];						
					}
					if ($agreement_attachment == "yes") {
						$pdf_agreement_query = mysqli_query($db, "SELECT * FROM file_upload_project WHERE project_id='$project_id' AND application='agreement'");
						$pdf_agreement_array = mysqli_fetch_assoc($pdf_agreement_query);
						$agreement_file_name = $pdf_agreement_array['real_file_name'];
						$agreement_url = $pdf_agreement_array['file_destination'];						
					}					
					
					$modify_user = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM user WHERE id='$by_whom'"));
					$modify_user_fname = $modify_user['fname'];
					$modify_user_lname = $modify_user['lname'];
					
					$modify_user = "$modify_user_fname $modify_user_lname";
				?>
                <tr>
                    <td><?echo $project_name?></td>
                    <td><div class="btn-group cell-center"><button type="button" id="view_id_<?echo $project_id?>" class="btn w-xs btn-info btn-xs remodal_view" data-remodal-target="project_view_<?echo $project_id;?>">
									View/Edit
								</button>
					</div></td>
                </tr>
				<!-- make request modal -->
					<div id="project_remodal_<?echo $project_id;?>" class="remodal-bg">
						<div class="remodal" data-remodal-id="project_view_<?echo $project_id;?>" data-remodal-options="hashTracking: false, closeOnOutsideClick: false">
								<div class="color-line"></div>
								<div class="modal-header">
									<div class="row">
										<div class="col-md-6 col-md-offset-3">
											<h4 class="modal-title"><span id="switch_<?echo $project_id?>">Viewing:</span><br/> <strong><?echo $project_name?></strong></h4><p><h5>Project Number: <?echo $project_number?></h5></p>
										</div>									
										<div class="col-md-2">
											<div class="checkbox checkbox-success">
												<input id="checkbox_<?echo $project_id?>" type="checkbox" class="edit_mode">
												<label id="edit_mode_text_<?echo $project_id?>" for="checkbox_<?echo $project_id?>">
													Edit Mode
												</label>
											</div>
										</div>
									</div>
								</div>						
								<div class="modal-body">
									<form id="project_form_<?echo $project_id?>" method="POST" enctype="multipart/form-data" >
										<div class="row">
											<div class="form-group">
												<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
													<div class="form-group">
														<label class="control-label pull-left" for="project_contactname_<?echo $project_id?>">Client Contact: <i class="text-danger">*</i></label>
														<input id="project_contactname_<?echo $project_id?>" placeholder="Eg) Richard Manning" type="text" value="<?echo $client_contact?>" class="form-control readonly_<?echo $project_id?> field_value_<?echo $project_id?>" autocomplete="off" disabled>
													</div>
												</div>
												<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
													<div class="form-group">
														<label class="control-label pull-left" for="project_email_<?echo $project_id?>">Client Email: <i class="text-danger">*</i></label>
														<input id="project_email_<?echo $project_id?>" placeholder="Eg) Richard.Maning@company.com" type="text" value="<?echo $client_email?>" class="form-control readonly_<?echo $project_id?> field_value_<?echo $project_id?>" autocomplete="off" disabled>
													</div>
												</div>
												<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
													<div class="form-group">
														<label class="control-label pull-left" for="project_manager_<?echo $project_id?>">A4HC Project Manager: <i class="text-danger">*</i></label>
													<select id="project_manager_<?echo $project_id?>" class="project_select readonly_<?echo $project_id?>" style="width: 100%" disabled>
														<optgroup label="Manager Names">
														<?
														$manager_query = mysqli_query($db, "SELECT * FROM user WHERE auth='super' ORDER BY lname asc");
														while($manager_array = mysqli_fetch_assoc($manager_query)) {
															$manager_fname = $manager_array['fname'];
															$manager_lname = $manager_array['lname'];
															$manager_user = $manager_array['username'];
															$manager_id = $manager_array['id'];
															
															$check_result = mysqli_num_rows(mysqli_query($db, "SELECT * FROM project WHERE project_manager='$manager_id' AND id='$project_id'"));
															if ($check_result == 1) {?>
																<option value="<?echo $manager_id?>" selected="selected"><?echo "$manager_lname, $manager_fname ($manager_user)"?></option>
														<?	}else {?>
																<option value="<?echo $manager_id?>"><?echo "$manager_lname, $manager_fname ($manager_user)"?></option>
														<?	}
															
														?>
																
														<?}?>	
														</optgroup>														
													
													</select>
													</div>
												</div>									
											</div>
										</div>
										<div class="input-daterange row form-group text-center" style="padding-left:20px;" id="datepicker" >
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<div class="form-group">
													<label class="control-label" for="date_from_<?echo $project_id?>">Project Start Date:<i class="text-danger">*</i><span class="text-danger error_msg1"></span></label>
													<a href="#"><input id="date_from_<?echo $project_id?>" placeholder="Click me to select a Date" type="text" value="<?echo $project_start?>" class="form-control readonly_<?echo $project_id?> field_value_<?echo $project_id?>" name="start" disabled></a>
												</div>
											</div>
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<div class="form-group">
													<label class="control-label text-center" for="date_to_<?echo $project_id?>">Project End Date:<i class="text-danger">*</i><span class="text-danger error_msg1>"></span></label>
													<a href="#"><input id="date_to_<?echo $project_id?>" placeholder="Click me to select a Date" type="text" value="<?echo $project_end?>" class="form-control pull-right readonly_<?echo $project_id?> field_value_<?echo $project_id?>" name="end" disabled></a>
												</div>
											</div>
										</div>						
										<div class="row">
										
																			
											<input id="proposal_<?echo $project_id?>" class="upload_edit hide_input" type="file"/>
											<?
											if ($proposal_attachment == "yes"){?>
											<div class="col-lg-4 col-md-4 col-sm-4 col-sx-4 edit_pdf_<?echo $project_id?>">
											<input type="hidden" id="confirm_proposal_<?echo $project_id?>" value="attached">
												<div class="hpanel">
													<div class="panel-heading">Proposal</div>
													<a href="" id="upload_proposal_<?echo $project_id?>" class="upload_link_edit"><div class="panel-body file-body hover-icon_upload proposal_icon_<?echo $project_id?>">
														<i class="fa fa-file-pdf-o text-success"></i><p class="text-success">Attached</p>
														
													</div></a>
													<div class="panel-footer text_proposal_<?echo $project_id?>">
														<?echo $proposal_file_name?><span><i class="fa fa-check-circle text-success"></i></span>
														<span id="proposal_x"><a id="remove_proposal_<?echo $project_id?>" href="#" class="pdf_remove"><span class="pdf_label">X</span></a></span>
													</div>
												</div>
											</div>												
											<?}else {?>
											<div class="col-lg-4 col-md-4 col-sm-4 col-sx-4 edit_pdf_<?echo $project_id?>">
											<input type="hidden" id="confirm_proposal_<?echo $project_id?>" value="removed">
												<div class="hpanel">
													<div class="panel-heading">Proposal</div>
													<a href="" id="upload_proposal_<?echo $project_id?>" class="upload_link_edit"><div class="panel-body file-body hover-icon_upload proposal_icon_<?echo $project_id?>">
														<i class="fa fa-file-pdf-o text-danger"></i>
													</div></a>
													<div class="panel-footer text_proposal_<?echo $project_id?>">
														Select PDF Document
													</div>
												</div>
											</div>												
											<?}
											?>						
											
											<?
											if ($proposal_attachment != "yes") {?>
											<div class="col-lg-4 col-md-4 col-sm-4 col-sx-4 view_pdf_<?echo $project_id?>">
												<div class="hpanel">
													<div class="panel-heading">Proposal</div>
													<div class="panel-body file-body">
														<i class="fa fa-file-pdf-o"></i>
													</div>
													<div class="panel-footer">
														No Files Attached
													</div>
												</div>
											</div>													
											<?}else {?>
											<div class="col-lg-4 col-md-4 col-sm-4 col-sx-4 view_pdf_<?echo $project_id?>">
												<div class="hpanel">
													<div class="panel-heading">Proposal</div>
													<a href="#" onClick="window.open('pdf_view/pdf_view.php?task=project&path=<?echo $proposal_url;?>','pagename','resizable,height=1000,width=1000'); return false;"><div class="panel-body file-body">
														<i class="fa fa-file-pdf-o text-success"></i>
													</div>
													<div class="panel-footer">
														<?echo $proposal_file_name?>
													</div></a>
												</div>
											</div>													
											<?}
											?>
											

											
											<input id="approval_<?echo $project_id?>" class="upload_edit hide_input" type="file"/>
											<?
											if ($approval_attachment == "yes"){?>
											<div class="col-lg-4 col-md-4 col-sm-4 col-sx-4 edit_pdf_<?echo $project_id?>">
											<input type="hidden" id="confirm_approval_<?echo $project_id?>" value="attached">
												<div class="hpanel">
													<div class="panel-heading">Approval Letter</div>
													<a href="" id="upload_approval_<?echo $project_id?>" class="upload_link_edit"><div class="panel-body file-body hover-icon_upload approval_icon_<?echo $project_id?>">
														<i class="fa fa-file-pdf-o text-success"></i><p class="text-success">Attached</p>
													</div></a>
													<div class="panel-footer text_approval_<?echo $project_id?>">
														<?echo $approval_file_name?><span><i class="fa fa-check-circle text-success"></i></span>
														<span id="approval_x"><a id="remove_approval_<?echo $project_id?>" href="#" class="pdf_remove"><span class="pdf_label">X</span></a></span>
													</div>
												</div>
											</div>												
											<?}else {?>
											<div class="col-lg-4 col-md-4 col-sm-4 col-sx-4 edit_pdf_<?echo $project_id?>">
											<input type="hidden" id="confirm_approval_<?echo $project_id?>" value="removed">
												<div class="hpanel">
													<div class="panel-heading">Approval Letter</div>
													<a href="" id="upload_approval_<?echo $project_id?>" class="upload_link_edit"><div class="panel-body file-body hover-icon_upload approval_icon_<?echo $project_id?>">
														<i class="fa fa-file-pdf-o text-danger"></i>
													</div></a>
													<div class="panel-footer text_approval_<?echo $project_id?>">
														Select PDF Document
													</div>
												</div>
											</div>												
											<?}
											?>
											
											<?
											if ($approval_attachment != "yes") {?>
											<div class="col-lg-4 col-md-4 col-sm-4 col-sx-4 view_pdf_<?echo $project_id?>">
												<div class="hpanel">
													<div class="panel-heading">Approval Letter</div>
													<div class="panel-body file-body">
														<i class="fa fa-file-pdf-o"></i>
													</div>
													<div class="panel-footer">
														No Files Attached
													</div>
												</div>
											</div>													
											<?}else {?>
											<div class="col-lg-4 col-md-4 col-sm-4 col-sx-4 view_pdf_<?echo $project_id?>">
												<div class="hpanel">
													<div class="panel-heading">Approval Letter</div>
													<a href="uploads/<?echo $approval_url?>" onClick="window.open('pdf_view/pdf_view.php?task=project&path=<?echo $approval_url;?>','pagename','resizable,height=1000,width=1000'); return false;"><div class="panel-body file-body">
														<i class="fa fa-file-pdf-o text-success"></i>
													</div>
													<div class="panel-footer">
														<?echo $approval_file_name?>
													</div></a>
												</div>
											</div>													
											<?}
											?>



											
											<input id="agreement_<?echo $project_id?>" class="upload_edit hide_input" type="file"/>
											<?
											if ($agreement_attachment == "yes"){?>
											<div class="col-lg-4 col-md-4 col-sm-4 col-sx-4 edit_pdf_<?echo $project_id?>">
											<input type="hidden" id="confirm_agreement_<?echo $project_id?>" value="attached">
												<div class="hpanel">
													<div class="panel-heading">Agreement/Contract</div>
													<a href="" id="upload_agreement_<?echo $project_id?>" class="upload_link_edit"><div class="panel-body file-body hover-icon_upload agreement_icon_<?echo $project_id?>">
														<i class="fa fa-file-pdf-o text-success"></i><p class="text-success">Attached</p>
														
													</div></a>
													<div class="panel-footer text_agreement_<?echo $project_id?>">
														<?echo $agreement_file_name?><span><i class="fa fa-check-circle text-success"></i></span>
														<span id="agreement_x"><a id="remove_agreement_<?echo $project_id?>" href="#" class="pdf_remove"><span class="pdf_label">X</span></a></span>
													</div>
												</div>
											</div>												
											<?}else {?>
											<div class="col-lg-4 col-md-4 col-sm-4 col-sx-4 edit_pdf_<?echo $project_id?>">
											<input type="hidden" id="confirm_agreement_<?echo $project_id?>" value="removed">
												<div class="hpanel">
													<div class="panel-heading">Agreement/Contract</div>
													<a href="" id="upload_agreement_<?echo $project_id?>" class="upload_link_edit"><div class="panel-body file-body hover-icon_upload agreement_icon_<?echo $project_id?>">
														<i class="fa fa-file-pdf-o text-danger"></i>
													</div></a>
													<div class="panel-footer text_agreement_<?echo $project_id?>">
														Select PDF Document
													</div>
												</div>
											</div>												
											<?}
											?>
											
											<?
											if ($agreement_attachment != "yes") {?>
											<div class="col-lg-4 col-md-4 col-sm-4 col-sx-4 view_pdf_<?echo $project_id?>">
												<div class="hpanel">
													<div class="panel-heading">Agreement/Contract</div>
													<div class="panel-body file-body">
														<i class="fa fa-file-pdf-o"></i>
													</div>
													<div class="panel-footer">
														No Files Attached
													</div>
												</div>
											</div>													
											<?}else {?>
											<div class="col-lg-4 col-md-4 col-sm-4 col-sx-4 view_pdf_<?echo $project_id?>">
												<div class="hpanel">
													<div class="panel-heading">Agreement/Contract</div>
													<a href="uploads/<?echo $agreement_url?>" onClick="window.open('pdf_view/pdf_view.php?task=project&path=<?echo $agreement_url;?>','pagename','resizable,height=1000,width=1000'); return false;"><div class="panel-body file-body">
														<i class="fa fa-file-pdf-o text-success"></i>
													</div>
													<div class="panel-footer">
														<?echo $agreement_file_name?>
													</div></a>
												</div>
											</div>													
											<?}
											?>


											
										</div>
										<div class="row" style="padding:14px;">
											<div class="form-group">
											<strong><p style="text-align:left" >Additional Information:</p></strong>
												<textarea class="form-control readonly_<?echo $project_id?> field_value_<?echo $project_id?>" rows="5" id="project_info_<?echo $project_id?>" disabled><?echo $project_info?></textarea>
											</div>
										</div>	
										<div class="row" style="text-align:left;">
											<div class="col-lg-12">
												<div class="form-group">
													<small><span><strong>Notes:</strong><i class="text-danger">*</i> are mandatory fields.</span></small><br/>
													<small class=""><strong>Created On:</strong> <?echo "$created_on";?></small><br/>
													<small class=""><strong>Last Modified On:</strong> <?echo "$modified_on";?> by <?echo $modify_user?></small>												
												</div>
											</div>
										</div>
										<input type="hidden" id="hidden_username" value="<?echo $user;?>">
									</form>
								</div>	
								<div class="modal-footer">
									<div class="pull-left">
										<button type="button" id="delete_<?echo $project_id;?>" class="btn btn-danger button_delete">Delete</button>
									</div> 
									<div class="pull-right">
										<button type="button" id="close_<?echo $project_id;?>" class="btn btn-default close_js" data-remodal-action="close">Close</button>
										<button type="button" id="project_edit_<?echo $project_id;?>" class="btn btn-success edit_view">Save Changes</button>
									</div>	
								</div>
						</div><!-- tab-content -->
					</div> <!-- /form -->  	 						
				<?}?>
                </tbody>
                </table>

                </div>
            </div>
        </div>

    </div>
    </div>

</div>

<!-- make request modal -->
	<div id="payee_remodal" class="remodal-bg">
		<div class="remodal" data-remodal-id="project_modal" data-remodal-options="hashTracking: false, closeOnOutsideClick: false">
				<div class="color-line"></div>
				<div class="modal-header">
					<h4 class="modal-title">Add New Project</h4>
				</div>
			
				<div class="modal-body">
					<form id="project_form" method="POST" enctype="multipart/form-data" >
						<div class="row">
							<div class="form-group">
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<div class="form-group">
										<label class="control-label pull-left" for="project_name">Project Name: <i class="text-danger">*</i></label>
										<input id="project_name" placeholder="Eg) Fire Water Treatment" type="text" value="" class="form-control" autocomplete="off">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<div class="form-group">
										<label class="control-label pull-left" for="project_number">Project Number: <i class="text-danger">*</i></label>
										<input id="project_number" placeholder="Eg) 15543-052" type="text" value="" class="form-control" autocomplete="off">
									</div>
								</div>								
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
									<div class="form-group">
										<label class="control-label pull-left" for="project_contactname">Client Contact: <i class="text-danger">*</i></label>
										<input id="project_contactname" placeholder="Eg) Richard Manning" type="text" value="" class="form-control" autocomplete="off">
									</div>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
									<div class="form-group">
										<label class="control-label pull-left" for="project_email">Client Email: <i class="text-danger">*</i></label>
										<input id="project_email" placeholder="Eg) Richard.Maning@company.com" type="text" value="" class="form-control" autocomplete="off">
									</div>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
									<div class="form-group">
										<label class="control-label pull-left" for="project_manager">A4HC Project Manager: <i class="text-danger">*</i></label>
									<select id="project_manager" class="project_select" style="width: 100%">
										<optgroup label="Manager Names">
										<?
										$manager_query = mysqli_query($db, "SELECT * FROM user WHERE auth='super' ORDER BY lname asc");
										while($manager_array = mysqli_fetch_assoc($manager_query)) {
											$manager_fname = $manager_array['fname'];
											$manager_lname = $manager_array['lname'];
											$manager_user = $manager_array['username'];
											$manager_id = $manager_array['id'];
										?>
											<option value="<?echo $manager_id?>"><?echo "$manager_lname, $manager_fname ($manager_user)"?></option>
										<?}?>
										</optgroup>
									</select>
									</div>
								</div>									
							</div>
						</div>
						<div class="input-daterange row form-group text-center" style="padding-left:20px;" id="datepicker" >
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<div class="form-group">
									<label class="control-label" for="date_from">Project Start Date:<i class="text-danger">*</i><span class="text-danger error_msg1"></span></label>
									<a href="#"><input id="date_from" placeholder="Click me to select a Date" type="text" value="" class="form-control" name="start" readonly></a>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<div class="form-group">
									<label class="control-label text-center" for="date_to">Project End Date:<i class="text-danger">*</i><span class="text-danger error_msg1"></span></label>
									<a href="#"><input id="date_to" placeholder="Click me to select a Date" type="text" value="" class="form-control pull-right" name="end" readonly></a>
								</div>
							</div>
						</div>						
						<div class="row">
							<input id="proposal" class="upload" type="file"/>
							<div class="col-lg-4 col-md-4 col-sm-4 col-sx-4">
								<div class="hpanel">
									<div class="panel-heading">Proposal</div>
									<a href="#" id="upload_proposal" class="upload_link"><div class="panel-body file-body hover-icon_upload proposal_icon">
										<i class="fa fa-file-pdf-o text-danger"></i>
									</div></a>
									<div class="panel-footer text_proposal">
										Select PDF Document
									</div>
								</div>
							</div>
							<input id="approval" class="upload" type="file"/>
							<div class="col-lg-4 col-md-4 col-sm-4 col-sx-4">
								<div class="hpanel">
									<div class="panel-heading ">Approval Letter</div>
									<a href="#" id="upload_approval" class="upload_link"><div class="panel-body file-body hover-icon_upload approval_icon">
										<i class="fa fa-file-pdf-o text-danger"></i>
									</div></a>
									<div class="panel-footer text_approval">
										Select PDF Document
									</div>
								</div>
							</div>
							<input id="agreement" class="upload" type="file"/>
							<div class="col-lg-4 col-md-4 col-sm-4 col-sx-4">
								<div class="hpanel">
									<div class="panel-heading">Agreement/Contract</div>
									<a href="#" id="upload_agreement" class="upload_link"><div class="panel-body file-body hover-icon_upload agreement_icon">
										<i class="fa fa-file-pdf-o text-danger"></i>
									</div></a>
									<div class="panel-footer text_agreement">
										Select PDF Document
									</div>
								</div>
							</div>
						</div>
						<div class="row" style="padding:14px;">
							<div class="form-group">
							<strong><p style="text-align:left">Additional Information:</p></strong>
								<textarea class="form-control" rows="5" id="project_info"></textarea>
							</div>
						</div>								
						<div class="row pull-right">
							<div class="col-lg-12">
								<div class="form-group">
									<small><span><strong>Notes:</strong><i class="text-danger">*</i> are mandatory fields.</span></small>
								</div>
							</div>
						</div>
						<input type="hidden" id="hidden_username" value="<?echo $user;?>">
					</form>
				</div>	
				<div class="modal-footer">
					<button type="button" class="btn btn-default close_main" data-remodal-action="close">Close</button>
					<button type="button" id="project_add_submit" class="btn btn-success">Add</button>
				</div>
		</div><!-- tab-content -->
	</div> <!-- /form -->  
                       
					
					

<!-- Vendor scripts -->
<script src="vendor/slimScroll/jquery.slimscroll.min.js"></script>
<script src="vendor/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="vendor/metisMenu/dist/metisMenu.min.js"></script>
<script src="vendor/iCheck/icheck.min.js"></script>
<script src="vendor/sparkline/index.js"></script>
<script src="vendor/moment/moment.js"></script>
<!-- DataTables -->
<script src="vendor/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="vendor/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- DataTables buttons scripts -->
<script src="vendor/pdfmake/build/vfs_fonts.js"></script>
<script src="vendor/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="vendor/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="vendor/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="vendor/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="vendor/bootstrap-datepicker-master/dist/js/bootstrap-datepicker.min.js"></script>
<script src="vendor/clockpicker/dist/bootstrap-clockpicker.min.js"></script>
<script src="vendor/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<!-- App scripts -->
<script src="scripts/homer.js"></script>
<script src="js_custom/form_helper.js"></script>
<script src="js_custom/projects.js"></script>
<script src="js_custom/date.js"></script>
<script src="vendor/select2-3.5.2/select2.min.js"></script>


<script type="text/javascript">
$(function () {
	$('#project_table').dataTable({
		"aaSorting": [ [0,'desc'] ]
		
	});	

	// Initialie Date
	$('.input-daterange').datepicker({
		todayBtn: "linked",
		format: 'yyyy/m/d',
		autoclose: true,
		
	});	
	
	$(".project_select").select2();	
	
});
</script>

						

</body>
</html>
<?
}
?>