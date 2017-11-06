<?
include("inc/db.php");
include('inc/header.php');
session_start();
if(empty($_SESSION['login_user']) or $auth != "admin") {
	echo "<meta http-equiv=\"refresh\" content=\"0; url=index.php\">";
}else {
?>


<!-- Simple splash screen-->
<div class="splash"> <div class="color-line"></div><div class="splash-title"><h1>A4HC Employees Maintenance</h1><p>Loading...</p><div class="spinner"> <div class="rect1"></div> <div class="rect2"></div> <div class="rect3"></div> <div class="rect4"></div> <div class="rect5"></div> </div> </div> </div>

<!-- Main Wrapper -->
<div id="wrapper">

    <div class="normalheader transition animated fadeIn small-header">
        <div class="hpanel">
            <div class="panel-body">


                <div id="hbreadcrumb" class="pull-right m-t-lg">
                    <ol class="hbreadcrumb breadcrumb">
                        <li><a href="index.html">Dashboard</a></li>
                        <li class="active">
                            <span>Employees</span>
                        </li>
                    </ol>
                </div>
                <h2 class="font-light m-b-xs">
                    Employees
                </h2>
                <small>All current and past employees</small>
				<div class="panel-header"></br>
				</div>
				<div class="panel-header">
				<button type="button" class="btn btn-success"
				data-toggle="modal" data-remodal-target="add_new_user">
				Add New Employee
				</button>
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
				<div class="table-responsive">
                <table id="example2" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th>First Name</th>
					<th>Last Name</th>
                    <th>E-mail</th>
					<th>View</th>
                </tr>
                </thead>
				
                <tbody>
				
				<?
				
				$user_query = mysqli_query($db, "SELECT * FROM user");
				
				while($user_array = mysqli_fetch_assoc($user_query)) {
					$user_id = $user_array['id'];
					
					$employee_query = mysqli_query($db, "SELECT * FROM employee_info WHERE user_id = '$user_id'");
					
					$employee_array = mysqli_fetch_assoc($employee_query);
					$ep_id = $employee_array['id'];
					$user_id2 = $employee_array['user_id'];
					$fname = $user_array['fname'];
					$lname = $user_array['lname'];
					$email = $user_array['username'];
					$employee_dob = $employee_array['dob'];
					$employee_sin = $employee_array['sin'];
					$employee_h_phone = $employee_array['h_phone'];
					$employee_m_phone = $employee_array['m_phone'];
					$employee_address= $employee_array['address'];
					$employee_city = $employee_array['city'];
					$employee_province = $employee_array['province'];
					$employee_country = $employee_array['country'];
					$employee_p_code = $employee_array['p_code'];
					$position = $user_array['position'];
					$timesheet_type = $employee_array['timesheet_type'];
					$employee_type = $employee_array['employee_type'];
					$employee_hours = $employee_array['hours'];
					$employee_status = $employee_array['employee_status'];
					$contract_start_date = $employee_array['contract_start_date'];
					$contract_end_date = $employee_array['contract_end_date'];
					$ep_super= $user_array['supervisor'];
					$employee_vacation = $employee_array['employee_vacation'];
					$employee_comments = $employee_array['comments'];
					$uauth=$user_array['auth'];
					
					$contract_pdf_query = mysqli_query($db, "SELECT * FROM contract_pdf WHERE user_id='$user_id2' ");
					$contract_pdf_array = mysqli_fetch_assoc($contract_pdf_query);
					$contract_pdf_destination = $contract_pdf_array['pdf_location'];
					$contract_file_name = $contract_pdf_array['pdf_name'];
					
					
				?>
				
				
                <tr>
                    <td><?echo $fname?></td>
					<td><?echo $lname?></td>
                    <td><?echo $email?></td>
                    <td><div class="btn-group cell-center"><button type="button" id="view_id_<?echo $ep_id?>" class="btn w-xs btn-info btn-xs remodal_view" data-remodal-target="remodal_<?echo $ep_id;?>">
									View/Edit
								</button>
					</div></td>
                </tr>
				
<!-- View/Edit Employee Modal-->
	<div id="employee_remodal_<?echo $ep_id?>" class="remodal-bg">
		<div class="remodal" data-remodal-id="remodal_<?echo $ep_id;?>" data-remodal-options="hashTracking: false, closeOnOutsideClick: false">
		<!--<div class="content" >-->
			  	<div class="color-line-green"></div>
				<input type="hidden" id="hidden_userid_<?echo $ep_id?>" value="<?echo $user_id?>"/>
									<div class="modal-header">
										<div class="row">
											<div class="col-md-5 col-md-offset-3">
												<h4 class="modal-title"><span id="switch_<?echo $ep_id?>">Viewing:</span> <strong><?echo $fname . " " . $lname?></strong></h4>
											</div>
									
											<div class="col-md-2">
												<div class="checkbox checkbox-success">
													<input id="checkbox_<?echo $ep_id?>" type="checkbox" class="edit_mode">
													<label id="edit_mode_text_<?echo $ep_id?>" for="checkbox_<?echo $ep_id?>">
														Edit Mode
													</label>
												</div>
											</div>
										</div>									
									</div>

				
				<form  id="employee_form_<?echo $ep_id?>" method="POST">
							<div class="text-center m-b-md" id="wizardControl" style="visibility: hidden">

								<a class="btn btn-primary" href="#steps1_<?echo $ep_id?>" id="btn_tab1">Step 1 - Personal data</a>
								<a class="btn btn-default" href="#steps2_<?echo $ep_id?>" id="btn_tab2">Step 2 - Payment data</a>

							</div>

							
							<div class="tab-content">
								
								<div id="steps1_<?echo $ep_id?>" class="active tab-pane tab-pane-view">
									<div class="p-m">
								
										<div class="modal-body">
										<div class="row form-group">					
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<div class="form-group">
													<label class="control-label pull-left">First Name<i class="text-danger">*</i><span class="text-danger"></span></label>
													<input id="fname_<?echo $ep_id?>" placeholder="Eg) James" type="text" value="<?echo $fname?>" autocomplete="off" disabled class="type_info1 form-control field_value_<?echo $ep_id?>">
												</div>
											</div>
											
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<div class="form-group">
													<label class="control-label pull-left">Last Name<i class="text-danger">*</i><span class="text-danger"></span></label>
													<input id="lname_<?echo $ep_id?>" placeholder="Eg) Chen" type="text" value="<?echo $lname?>"  autocomplete="off" disabled class="type_info1 form-control field_value_<?echo $ep_id?>">
												</div>
											</div>
										</div>
										
										<div class="row form-group">					
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<div class="form-group">
											<label class="control-label pull-left" for="date_from">Date of Birth<span class="text-danger error_msg1"></span></label>
											<a href="#" class="input-daterange"><input id="employee_dob_<?echo $ep_id?>" placeholder="Click me to select a Date" type="text" value="<?echo $employee_dob?>"  autocomplete="off" disabled class="type_info1 form-control field_value_<?echo $ep_id?> readonly_<?echo $ep_id?>"  readonly></a>
											</div>
											</div>
											
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<div class="form-group">
													<label class="control-label pull-left">SIN<span class="text-danger"></span></label>
													<input id="employee_sin_<?echo $ep_id?>" placeholder="Eg) Chen" type="text" value="<?echo $employee_sin?>"  autocomplete="off" disabled class="form-control field_value_<?echo $ep_id?> readonly_<?echo $ep_id?>">
												</div>
											</div>
										</div>
										
										<div class="row form-group" >
											<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
												<div class="form-group">
														<label class="control-label pull-left">E-mail<i class="text-danger">*</i><span class="text-danger"></span></label>
														<input id="email_<?echo $ep_id?>"  type="email" value="<?echo $email?>" class="form-control field_value_<?echo $ep_id?>" autocomplete="off" disabled>
												</div>
											</div>
											
											<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
												<div class="form-group">
													<label class="control-label pull-left">Mobile Phone Number<span class="text-danger"></span></label>
													<input id="employee_m_phone_<?echo $ep_id?>" placeholder="Eg) (403) 699-6999." type="text" value="<?echo $employee_m_phone?>" class="form-control field_value_<?echo $ep_id?> readonly_<?echo $ep_id?>" autocomplete="off" disabled>
												</div>
											</div>
																						
											<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
												<div class="form-group">
													<label class="control-label pull-left">Home Phone Number<span class="text-danger"></span></label>
													<input id="employee_h_phone_<?echo $ep_id?>" placeholder="Eg) (403) 699-6999." type="text" value="<?echo $employee_h_phone?>" class="form-control field_value_<?echo $ep_id?> readonly_<?echo $ep_id?>" autocomplete="off" disabled>
												</div>
											</div>
											
										</div>
										
									
									
										<div class="row form-group" >
											<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
												<div class="form-group">
														<label class="control-label pull-left">Home Address<span class="text-danger"></span></label>
														<input id="employee_address_<?echo $ep_id?>" placeholder="Eg) 350R Shawville Blvd SE #140" type="text" value="<?echo $employee_address?>" class="form-control pull-right field_value_<?echo $ep_id?> 
													readonly_<?echo $ep_id?>" autocomplete="off" disabled>
												</div>
											</div>
											<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
												<div class="form-group">
													<label class="control-label pull-left">City<span class="text-danger"></span></label>
													<input id="employee_city_<?echo $ep_id?>" placeholder="Eg) Calgary" type="text" value="<?echo $employee_city?>" class="form-control field_value_<?echo $ep_id?> readonly_<?echo $ep_id?>" autocomplete="off" disabled>
												</div>
											</div>
										</div>

												<div class="row form-group" >					
													<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
														<div class="form-group">
															<label class="control-label pull-left" for="payee_prov">Province: </label>
															<select id="employee_province_<?echo $ep_id?>" class="form-control pull-left province_select readonly_<?echo $ep_id?>" style="width: 100% text-align:left;" disabled>
																<optgroup label="Provinces">
																<?
																$province_query = mysqli_query($db, "SELECT province FROM province ORDER BY province asc");
																while($province_array = mysqli_fetch_assoc($province_query)) {
																	$province = $province_array['province'];
																	
																	$check_result = mysqli_num_rows(mysqli_query($db, "SELECT province FROM employee_info WHERE province='$province' AND id='$ep_id'"));
																	
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
													</div>
													<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" >
														<div class="form-group">
															<label class="control-label pull-left">Country<span class="text-danger"></span></label>
															<input id="employee_country_<?echo $ep_id?>" placeholder="Eg) Canada" type="text" value="<?echo $employee_country?>" class="form-control field_value_<?echo $ep_id?> readonly_<?echo $ep_id?>" autocomplete="off" disabled>
														</div>
													</div>
													<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" >
														<div class="form-group">
															<label class="control-label pull-left">Postal Code<span class="text-danger"></span></label>
															<input id="employee_p_code_<?echo $ep_id?>" placeholder="Eg) T2P 8M5" type="text" value="<?echo $employee_p_code?>" class="form-control field_value_<?echo $ep_id?> readonly_<?echo $ep_id?>" autocomplete="off" disabled>
														</div>
													</div>
												</div>
										</div>
								</div>
								
								
								<div class="modal-footer">
								
								
								<div class="text-right m-t-xs">
									<button type="button" id="close_<?echo $ep_id;?>" class="btn btn-default close_edit" data-remodal-action="close">Close</button>
									<a class="btn btn-default next" href="#" id="next_view_<?echo $ep_id;?>">Next</a>
									<button type="button" id="accounting_edit_<?echo $ep_id;?>_<?echo $user_id2;?>" class="btn btn-success edit_view">Save Changes</button>
								</div>
								</div>

							</div>
							

							<div id="steps2_<?echo $ep_id?>" class="tab-pane tab-pane-view">
							
							<div class="p-m">

									<div class="row form-group">					
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label class="control-label pull-left">Job Title/Position<span class="text-danger"></span></label>
												<input id="position_<?echo $ep_id?>" placeholder="Eg) Receptionist" type="text" value="<?echo $position?>" autocomplete="off" disabled class="type_info1 form-control field_value_<?echo $ep_id?> readonly_<?echo $ep_id?>">
											</div>
										</div>
										
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label class="control-label pull-left">Timesheet Type<span class="text-danger"></span></label>
												<select id="timesheet_type_<?echo $ep_id?>" disabled class="form-control pull-right type_info province_select field_value_<?echo $ep_id?>">
												<? if ($timesheet_type == 'Day') {?>
												<optgroup label="Timesheet Type">
													<option selected="selected">Day</option>
													<option>Period</option>
												</optgroup>
												<?} elseif ($timesheet_type == 'Period'){?>
												<optgroup label="Timesheet Type">
													<option>Day</option>
													<option selected="selected">Period</option>
												</optgroup>
												<?}?>
												</select>
												
											</div>
										</div>
									</div>
							
									<div class="row form-group">					
										<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="form-group">
											<label class="control-label pull-left">Employee Type<span class="text-danger"></span></label>
											<select id="ep_type_<?echo $ep_id?>" class="form-control pull-right type_info province_select field_value_<?echo $ep_id?> readonly_<?echo $ep_id?>"  autocomplete="off" disabled>
											<optgroup label="Employee Type">
											
											<?if ($employee_type == 'Permanent') {?>
												<option selected="selected">Permanent</option>
												<option>Temporary</option>
												<option>Contract</option>
												<option>Seasonal</option>
												<option>Volunteer</option>
												<option>Other-specify in comments</option>
											<?} elseif ($employee_type == 'Temporary'){?>
												<option>Permanent</option>
												<option selected="selected">Temporary</option>
												<option>Contract</option>
												<option>Seasonal</option>
												<option>Volunteer</option>
												<option>Other-specify in comments</option>
											<?} elseif ($employee_type == 'Contract'){?>
												<option>Permanent</option>
												<option>Temporary</option>
												<option selected="selected">Contract</option>
												<option>Seasonal</option>
												<option>Volunteer</option>
												<option>Other-specify in comments</option>
											<?} elseif ($employee_type == 'Seasonal'){?>
												<option>Permanent</option>
												<option>Temporary</option>
												<option>Contract</option>
												<option selected="selected">Seasonal</option>
												<option>Volunteer</option>
												<option>Other-specify in comments</option>
											<?} elseif ($employee_type == 'Volunteer'){?>
												<option>Permanent</option>
												<option>Temporary</option>
												<option>Contract</option>
												<option>Seasonal</option>
												<option selected="selected">Volunteer</option>
												<option>Other-specify in comments</option>
											<?} elseif ($employee_type == 'Other-specify in comments'){?>
												<option>Permanent</option>
												<option>Temporary</option>
												<option>Contract</option>
												<option>Seasonal</option>
												<option>Volunteer</option>
												<option selected="selected">Other-specify in comments</option>
											<?}?>
											
											</optgroup>
											</select>
											
										</div>
										</div>
										<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
											<label class="control-label pull-left">Hours<span class="text-danger"></span></label><select id="employee_hours_<?echo $ep_id?>" class="form-control pull-right province_select field_value_<?echo $ep_id?> readonly_<?echo $ep_id?>"  autocomplete="off" disabled>
												<optgroup label="Employee Hours"></option>
												
											<?if ($employee_hours == 'Salary') {?>
												<option selected="selected">Salary</option>
												<option>Hourly</option>
												<option>Part-time (hourly)</option>
												<option>Full-time (hourly)</option>
												<option>Other-specify in comments</option>
											<?} elseif ($employee_hours == 'Hourly'){?>
												<option>Salary</option>
												<option selected="selected">Hourly</option>
												<option>Part-time (hourly)</option>
												<option>Full-time (hourly)</option>
												<option>Other-specify in comments</option>
											<?} elseif ($employee_hours == 'Part-time (hourly)'){?>
												<option>Salary</option>
												<option>Hourly</option>
												<option selected="selected">Part-time (hourly)</option>
												<option>Full-time (hourly)</option>
												<option>Other-specify in comments</option>
											<?} elseif ($employee_hours == 'Full-time (hourly)'){?>
												<option>Salary</option>
												<option>Hourly</option>
												<option>Part-time (hourly)</option>
												<option selected="selected">Full-time (hourly)</option>
												<option>Other-specify in comments</option>
											<?} elseif ($employee_hours == 'Other-specify in comments'){?>
												<option>Salary</option>
												<option>Hourly</option>
												<option>Part-time (hourly)</option>
												<option>Full-time (hourly)</option>
												<option selected="selected">Other-specify in comments</option>
											<?}?>

											</optgroup>
											</select>
											</div>
										
										
										<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
											<label class="control-label pull-left">Employement Status<span id="status" class="text-danger "></span></label>
											<div class="form-group"><select id="employee_status_<?echo $ep_id?>" class="form-control pull-right province_select field_value_<?echo $ep_id?> readonly_<?echo $ep_id?>"  autocomplete="off" disabled>
											<optgroup label="Employee Status">
											<?if ($employee_status == 'Working') {?>
												<option selected="selected">Working</option>
												<option>Laid-off</option>
												<option>Misdemeanor</option>
												<option>Unavailable</option>
												<option>Available</option>
												<option>Other-specify in comments</option>
											<?} elseif ($employee_status== 'Laid-off'){?>
												<option>Working</option>
												<option selected="selected">Laid-off</option>
												<option>Misdemeanor</option>
												<option>Unavailable</option>
												<option>Available</option>
												<option>Other-specify in comments</option>
											<?} elseif ($employee_status == 'Misdemeanor'){?>
												<option>Working</option>
												<option>Laid-off</option>
												<option selected="selected">Misdemeanor</option>
												<option>Unavailable</option>
												<option>Available</option>
												<option>Other-specify in comments</option>
											<?} elseif ($employee_status == 'Unavailable'){?>
												<option>Working</option>
												<option>Laid-off</option>
												<option>Misdemeanor</option>
												<option selected="selected">Unavailable</option>
												<option>Available</option>
												<option>Other-specify in comments</option>
											<?} elseif ($employee_status == 'Available'){?>
												<option>Working</option>
												<option>Laid-off</option>
												<option>Misdemeanor</option>
												<option>Unavailable</option>
												<option selected="selected">Available</option>
												<option>Other-specify in comments</option>
											<?} elseif ($employee_status == 'Other-specify in comments'){?>
												<option>Working</option>
												<option>Laid-off</option>
												<option>Misdemeanor</option>
												<option>Unavailable</option>
												<option>Available</option>
												<option selected="selected">Other-specify in comments</option>
											<?}?>
											</optgroup>
											</select>
											</div>
										</div>
										
									</div>

							
									
									
									
				<!--Contract Date Selector -->	
							<div class="contract_dates_edit" style="display: none;">
								<div class="input-daterange row form-group text-center" style="padding-left:20px;" id="datepicker" >
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<div class="form-group">
									<label class="control-label" for="date_from">Contract Start Date:<span class="text-danger error_msg1"></span></label>
									<a href="#"><input id="contract_start_date_<?echo $ep_id?>" placeholder="Click me to select a Date" type="text" value="<?echo $contract_start_date?>"  autocomplete="off" disabled class="form-control field_value_<?echo $ep_id?> readonly_<?echo $ep_id?>"  readonly></a>
									</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<div class="form-group">
									<label class="control-label text-center" for="date_to">Contract End Date:<span class="text-danger error_msg1"></span></label>
									<a href="#"><input id="contract_end_date_<?echo $ep_id?>" placeholder="Click me to select a Date" type="text" value="<?echo $contract_end_date?>"  autocomplete="off" disabled class="form-control field_value_<?echo $ep_id?> readonly_<?echo $ep_id?>"  readonly></a>
									</div>
									</div>
								</div>
							</div>

										<div class="row">
											<div class="col-lg-12 edit_pdf_<?echo $ep_id?>">
											<input type="hidden" id="confirm_proposal_<?echo $ep_id?>" value="attached">
												<div class="hpanel">
													<div class="panel-heading">Contract</div>
													<a href="" id="upload_proposal_<?echo $ep_id?>" class="upload_link_edit"><div class="panel-body file-body hover-icon_upload proposal_icon_<?echo $ep_id?>">
														<i class="fa fa-file-pdf-o text-success"></i><p class="text-success">Attached</p>
													</div></a>
													<div class="panel-footer text_proposal_<?echo $ep_id?>">
														<?echo $contract_file_name?><span><i class="fa fa-check-circle text-success"></i></span>
														
													</div>
												</div>
											</div>
										</div>
										
										
										
							
										<div class="row">
											<div class="col-lg-12 view_pdf_<?echo $ep_id?>">
												<div class="hpanel">
													<div class="panel-heading">Contract</div>
													<a href="#" onClick="window.open('pdf_view/pdf_view.php?task=contract&path=<?echo $contract_pdf_destination;?>','pagename','resizable,height=1000,width=1000'); return false;"><div class="panel-body file-body">
														<i class="fa fa-file-pdf-o text-success"></i>
													</div>
													<div class="panel-footer text_proposal_<?echo $ep_id?>">
														<?echo $contract_file_name?>
													</div></a>
												</div>
											</div>
										</div>
										
										<input id="proposal_<?echo $ep_id?>" class="upload_edit hide_input" type="file"/>
										

								
								
								
								<div class="row"><div class="col-lg-12 edit_pdf_<?echo $ep_id?>"><p class="pull-left"><strong>Submitted Contract: </strong>
								<a href="#" onClick="window.open('pdf_view/pdf_view.php?task=contracts&path=<?echo $contract_pdf_destination;?>','pagename','resizable,height=1000,width=1000'); return false;"><span class="text-danger">

									<?echo basename($contract_pdf_destination);?> </span></a>

								</p></div></div>
								
							
							
							
										
				<!--User status-->
									<div class="row form-group">
									
										<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="padding-top:2%">
											<label class="control-label pull-left">User Privileges<span class="text-danger error_msg1"></span></label>
											<div class="form-group"><select id="uauth_<?echo $ep_id?>" class="form-control pull-right province_select field_value_<?echo $ep_id?> readonly_<?echo $ep_id?>"  autocomplete="off" disabled>
											<optgroup label="User Privileges">
											
											<?if ($uauth == 'regular') {?>
												<option selected="selected">Employee</option>
												<option>Supervisor</option>
												<option>Admin</option>
											<?} elseif ($uauth== 'super'){?>
												<option>Employee</option>
												<option selected="selected">Supervisor</option>
												<option>Admin</option>
											<?} elseif ($uauth == 'admin'){?>
												<option>Employee</option>
												<option>Supervisor</option>
												<option selected="selected">Admin</option>
											<?}?>

											</optgroup>
											</select>
											</div>
										</div>
										
										<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="padding-top:2%">
											<div class="form-group">
												<label class="control-label pull-left">Supervisor ID<i class="text-danger">*</i><span class="text-danger error_msg1"></span></label>
													<select id="ep_super_<?echo $ep_id?>" class="form-control pull-left province_select readonly_<?echo $ep_id?>" style="width: 100%" disabled>
														<optgroup label="Supervisors">
														<?
														$super_query = mysqli_query($db, "SELECT * FROM user WHERE auth='super' OR auth='admin' ORDER BY lname asc");
														while($manager_array = mysqli_fetch_assoc($super_query)) {
															$manager_fname = $manager_array['fname'];
															$manager_lname = $manager_array['lname'];
															$manager_user = $manager_array['username'];
															$manager_id = $manager_array['id'];
															
															$check_result = mysqli_num_rows(mysqli_query($db, "SELECT * FROM user WHERE id='$user_id' AND supervisor='$manager_id'"));
															
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
										
													<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="padding-top:2%">
														<div class="form-group">
															<label class="control-label pull-left">Vacation Percentage<span class="text-danger"></span></label>
															<input id="employee_vacation_<?echo $ep_id?>" placeholder="Eg) 5" type="text" value="<?echo $employee_vacation?>"  autocomplete="off" disabled class="form-control field_value_<?echo $ep_id?> readonly_<?echo $ep_id?>">
														</div>
													</div>
										
								</div>
										
								<div class="row" style="padding:13px;">
									<div class="form-group">
									<strong><p style="text-align:left">Additional Information:</p></strong>
										<textarea rows="5" id="employee_comments_<?echo $ep_id?>" autocomplete="off" disabled class="form-control field_value_<?echo $ep_id?> readonly_<?echo $ep_id?>"><?echo $employee_comments?></textarea>
									</div>
								</div>	
										
								</div>
										<div class="modal-footer">

										<div class="text-right m-t-xs">
											<button type="button" id="close2_<?echo $ep_id;?>" class="btn btn-default close_edit" data-remodal-action="close">Close</button>
											<a class="btn btn-default prev" href="#">Previous</a>
											<button type="button" id="accounting_edit_<?echo $ep_id;?>_<?echo $user_id2;?>" class="btn btn-success edit_view">Save Changes</button>
										</div>
										</div>

							</div>
							
							
							
							</div>
						
				</form>

		</div>
	</div> <!-- Add new employee modal ends here-->				


   
				
				<?}?>
                </tbody>
				
                </table>
				</div>
                </div>
            </div>
        </div>

    </div>
    </div>



</div>






<!-- Add New Employee Modal-->
	<div class="remodal-bg">
		<div class="remodal" data-remodal-id="add_new_user" data-remodal-options="hashTracking: false, closeOnOutsideClick: false">
		<!--<div class="content" >-->
			  	<div class="color-line-green"></div>
				<div class="modal-header">
					<h4 class="modal-title">Add New Employee</h4>
				</div>

				
				<form  id="employee_form" method="POST">
				
							<div class="text-center m-b-md" id="wizardControl" style="visibility: hidden">

								<a class="btn btn-primary" href="#ste1" id="btn_tab1">Step 1 - Personal data</a>
								<a class="btn btn-default" href="#ste2" id="btn_tab2">Step 2 - Payment data</a>

							</div>

							
							<div class="tab-content">
								
								<div id="ste1" class="active tab-pane">
									<div class="p-m">
								
										<div class="modal-body">
										<div class="row form-group">					
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<div class="form-group">
													<label class="control-label pull-left">First Name<i class="text-danger">*</i><span class="text-danger"></span></label>
													<input id="fname" placeholder="Eg) James" type="text" value="" class="form-control type_info1 type_info" name="start">
												</div>
											</div>
											
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<div class="form-group">
													<label class="control-label pull-left">Last Name<i class="text-danger">*</i><span class="text-danger"></span></label>
													<input id="lname" placeholder="Eg) Chen" type="text" value="" class="form-control pull-right type_info1 type_info" name="end">
												</div>
											</div>
										</div>
										
										<div class="row form-group">					
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<div class="form-group">
											<label class="control-label pull-left" for="date_from">Date of Birth<span class="text-danger error_msg1"></span></label>
											<a href="#" class="input-daterange"><input id="employee_dob" placeholder="Click me to select a Date" type="text" value="" class="form-control type_info1 type_info" name="start" readonly></a>
											</div>
											</div>
											
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<div class="form-group">
													<label class="control-label pull-left">SIN<span class="text-danger"></span></label>
													<input id="employee_sin" placeholder="Eg) 123-456-789" type="text" value="" class="form-control pull-right type_info1 type_info" name="end">
												</div>
											</div>
										</div>
										
										<div class="row form-group" >
											<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
												<div class="form-group">
														<label class="control-label pull-left">E-mail<i class="text-danger">*</i><span class="text-danger"></span></label>
														<input id="email" placeholder="Eg) bob@gmail.com" type="text" value="" class="form-control type_info1 type_info" name="start">
												</div>
											</div>

											<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
												<div class="form-group">
													<label class="control-label pull-left">Mobile Phone Number<span class="text-danger"></span></label>
													<input id="employee_m_phone" placeholder="Eg) (403) 699-6999." type="text" value="" class="form-control  type_info1 type_info" autocomplete="off" name="end">
												</div>
											</div>											
											
											<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
												<div class="form-group">
													<label class="control-label pull-left">Home Phone Number<span class="text-danger"></span></label>
													<input id="employee_h_phone" placeholder="Eg) (403) 699-6999." type="text" value="" class="form-control  type_info1 type_info" autocomplete="off" name="end">
												</div>
											</div>
										</div>
										

										
									
									
										<div class="row form-group" >
											<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
												<div class="form-group">
														<label class="control-label pull-left">Home Address<span class="text-danger"></span></label>
														<input id="employee_address" placeholder="Eg) 350R Shawville Blvd SE #140" type="text" value="" class="form-control type_info1 type_info" name="start">
												</div>
											</div>
											<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
												<div class="form-group">
													<label class="control-label pull-left">City<span class="text-danger"></span></label>
													<input id="employee_city" placeholder="Eg) Calgary" type="text" value="" class="form-control pull-right type_info1 type_info" name="end">
												</div>
											</div>
										</div>

												<div class="row form-group" >					
													<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
														<div class="form-group">
															<label class="control-label pull-left" for="payee_prov">Province: </label>
															<select id="employee_province" class="province_select type_info1" style="width: 100%">
																<optgroup label="Provinces">
																<?
																$province_query = mysqli_query($db, "SELECT province FROM province ORDER BY province asc");
																while($province_array = mysqli_fetch_assoc($province_query)) {
																	$province = $province_array['province'];
																?>
																	<option value="<?echo $province?>"><?echo $province?></option>
																<?}?>
																</optgroup>
															</select>
														</div>
													</div>
													<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" >
														<div class="form-group">
															<label class="control-label pull-left">Country<span class="text-danger"></span></label>
															<input id="employee_country" placeholder="Eg) Canada" type="text" value="" class="form-control pull-right type_info1 type_info" name="end">
														</div>
													</div>
													<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" >
														<div class="form-group">
															<label class="control-label pull-left">Postal Code<span class="text-danger"></span></label>
															<input id="employee_p_code" placeholder="Eg) T2P 8M5" type="text" value="" class="form-control pull-right type_info1 type_info" name="end">
														</div>
													</div>
												</div>
										</div>
								</div>
								
								
								<div class="modal-footer">
								<div class="text-right m-t-xs">
									<button type="button" class="btn btn-default close_main" data-remodal-action="close">Close</button>
									<a class="btn btn-default next" href="#" id="next_new">Next</a>
								</div>
								</div>

							</div>
							

							<div id="ste2" class="tab-pane">
							
							<div class="p-m">

										<div class="row form-group">					
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<div class="form-group">
													<label class="control-label pull-left">Job Title/Position<span class="text-danger"></span></label>
													<input id="position" placeholder="Eg) Receptionist" type="text" value="" class="form-control type_info1 type_info" name="start">
												</div>
											</div>
											
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<div class="form-group">
													<label class="control-label pull-left">Timesheet Type<span class="text-danger"></span></label>
													<select id="timesheet_type" class="form-control pull-right type_info province_select" name="account">
													<optgroup label="Timesheet Type">
														<option>Day</option>
														<option>Period</option>
													</optgroup>
													</select>
													
												</div>
											</div>
										</div>
										
									<div class="row form-group">					
										<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="form-group">
											<label class="control-label pull-left">Employee Type<span class="text-danger"></span></label>
											<select id="ep_type" class="form-control pull-right type_info province_select" name="account">
											<optgroup label="Employee Type">
												<option>Permanent</option>
												<option>Temporary</option>
												<option>Contract</option>
												<option>Seasonal</option>
												<option>Volunteer</option>
												<option>Other-specify in comments</option>
											</optgroup>
											</select>
											
										</div>
										</div>
										<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
											<label class="control-label pull-left">Hours<span class="text-danger"></span></label>
											<div class="form-group"><select id="employee_hours" class="form-control pull-right type_info province_select" name="account">
											<optgroup label="Employee Hours">
												<option>Salary</option>
												<option>Hourly</option>
												<option>Part-time (hourly)</option>
												<option>Full-time (hourly)</option>
												<option>Other-specify in comments</option>
											</optgroup>
											</select>
											</div>
										</div>
										<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
											<label class="control-label pull-left">Employement Status<span id="status" class="text-danger "></span></label>
											<div class="form-group"><select id="employee_status" class="form-control pull-right type_info province_select" name="account">
											<optgroup label="Employee Status">
												<option>Working</option>
												<option>Laid-off</option>
												<option>Misdemeanor</option>
												<option>Unavailable</option>
												<option>Available</option>
												<option>Other-specify in comments</option>
											</optgroup>
											</select>
											</div>
										</div>
										

									</div>
									
									
									
				<!--Contract Date Selector -->	
							<span id="contract_dates">

							</span>
							
							<div class="row form-group">
								<input id="proposal" class="upload" type="file"/>
								<div class="col-lg-12">
								
									<div class="panel-heading">Contract </div>
									<a href="#" id="upload_proposal" class="upload_link type_info"><div class="panel-body file-body hover-icon_upload proposal_icon">
										<i class="fa fa-file-pdf-o text-danger"></i>
									</div></a>
									<div class="panel-footer text_proposal">
										Select PDF Document
									</div>
								</div>
								

							</div>
										
				<!--User status-->
									<div class="row form-group">
									
										<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="padding-top:2%">
											<label class="control-label pull-left">User Privileges<span class="text-danger error_msg1"></span></label>
											<div class="form-group"><select id="uauth" class="form-control pull-right type_info province_select" name="account">
											<optgroup label="User Privileges">
												<option>Employee</option>
												<option>Supervisor</option>
												<option>Admin</option>
											</optgroup>
											</select>
											</div>
										</div>
										
										<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="padding-top:2%">
											<div class="form-group">
												<label class="control-label pull-left">Supervisor ID<i class="text-danger">*</i><span class="text-danger error_msg1"></span></label>
													<select id="ep_super" class="province_select" style="width: 100%">
														<optgroup label="Supervisors">
														<option value=""><?echo ""?></option>
														<?
														$super_query = mysqli_query($db, "SELECT * FROM user WHERE auth='super' OR auth='admin' ORDER BY lname asc");
														while($manager_array = mysqli_fetch_assoc($super_query)) {
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
										
													<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="padding-top:2%">
														<div class="form-group">
															<label class="control-label pull-left">Vacation Percentage<span class="text-danger"></span></label>
															<input id="employee_vacation" placeholder="Eg) 5" type="text" value="" class="form-control pull-right type_info" name="end">
														</div>
													</div>
										
								</div>
										
								<div class="row" style="padding:13px;">
									<div class="form-group">
									<strong><p style="text-align:left">Additional Information:</p></strong>
										<textarea class="form-control type_info" rows="5" id="employee_comments"></textarea>
									</div>
								</div>	
										
							</div>
										<div class="modal-footer">
										<div class="text-right m-t-xs">
											<button type="button" class="btn btn-default close_main" data-remodal-action="close">Close</button>
											<a class="btn btn-default prev" href="#">Previous</a>
											<a class="btn btn-success" id="employee_submit">Submit</a>
										</div>
										</div>

							</div>
							
							
							
							</div>
						
				</form>

		</div>
	</div> <!-- Add new employee modal ends here-->
			
			

				


	

                       
					



					

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
<script src="js_custom/moment.js"></script>
<script src="vendor/bootstrap-datepicker-master/dist/js/bootstrap-datepicker.min.js"></script>
<script src="vendor/clockpicker/dist/bootstrap-clockpicker.min.js"></script>
<script src="vendor/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>


<!-- App scripts -->
<script src="scripts/homer.js"></script>
<script src="js_custom/employees.js"></script>
<script src="js_custom/date.js"></script>
<script src="js_custom/form_helper.js"></script>
<script src="vendor/select2-3.5.2/select2.min.js"></script>
<script src="js_custom/form_helper.js"></script>






<script type="text/javascript">
$(function () {
	$('#payee_table').dataTable({
		"aaSorting": [ [0,'desc'] ]
	});	
	$("#employee_p_code").mask("S9S 9S9");
	$(".province_select").select2();	
	$("#employee_h_phone").mask("(999) 999-9999");
	$("#employee_m_phone").mask("(999) 999-9999");
	$("#employee_sin").mask("999-999-999");
	$("#employee_vacation").mask("99");
});
</script>

<script>

    $(function () {

        // Initialize Example 1
        $('#example1').dataTable( {
            "ajax": 'api/datatables.json',
            dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp",
            "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
            buttons: [
                {extend: 'copy',className: 'btn-sm'},
                {extend: 'csv',title: 'ExampleFile', className: 'btn-sm'},
                {extend: 'pdf', title: 'ExampleFile', className: 'btn-sm'},
                {extend: 'print',className: 'btn-sm'}
            ]
        });

        // Initialize Example 2
        $('#example2').dataTable();

    });
	
$(function () {
	$('#project_table').dataTable({
		"aaSorting": [ [0,'desc'] ]
		
	});	

	// Initialize Date
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