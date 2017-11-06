<?
include("./inc/db.php");
include('inc/header.php');
session_start();
if(empty($_SESSION['login_user']) or $auth != "admin") {
	echo "<meta http-equiv=\"refresh\" content=\"0; url=./\">";
}else {
?>

<!-- Simple splash screen-->
<div class="splash"> <div class="color-line"></div><div class="splash-title"><h1>Payee Maintenance</h1><p>Loading...</p><div class="spinner"> <div class="rect1"></div> <div class="rect2"></div> <div class="rect3"></div> <div class="rect4"></div> <div class="rect5"></div> </div> </div> </div>
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
                            <span>Payees</span>
                        </li>
                    </ol>
                </div>
                <h2 class="font-light m-b-xs">
                    Payees
                </h2>
                <small>All existing payees</small>
				<div class="panel-header"></br>
				</div>
				<div class="panel-header">
					<button type="button" class="btn btn-success" data-remodal-target="account_code_modal">Add New Payee</button>
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
				
                <table id="payee_table" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
					<th>Payee Name</th>
					<th>View</th>
                </tr>
                </thead>
                <tbody>
				
				<?
				$payee_query = mysqli_query($db, "SELECT * FROM payee");
				while($payee_array = mysqli_fetch_assoc($payee_query)) {
					$payee_id = $payee_array['id'];
					$payee_name = $payee_array['name'];
					$payee_address = $payee_array['address'];
					$payee_city = $payee_array['city'];
					$payee_province = $payee_array['province'];
					$payee_postal = $payee_array['postal'];
					$payee_info = $payee_array['info'];
					$created_on = $payee_array['created_on'];
					$modified_on = $payee_array['modified_on'];
					$by_whom = $payee_array['by_whom'];
					$payee_phone = $payee_array['phone'];
					$payee_email = $payee_array['email'];
					
					$modify_user = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM user WHERE id='$by_whom'"));
					$modify_user_fname = $modify_user['fname'];
					$modify_user_lname = $modify_user['lname'];
					
					$modify_user = "$modify_user_fname $modify_user_lname";
				?>
                <tr>
                    <td><?echo $payee_name?></td>
                    <td><div class="btn-group cell-center"><button type="button" id="view_id_<?echo $payee_id?>" class="btn w-xs btn-info btn-xs remodal_view" data-remodal-target="remodal_<?echo $payee_id;?>">
									View/Edit
								</button>
					</div></td>
                </tr>				
					<!-- make request modal -->
						<div id="payee_remodal_<?echo $payee_id?>" class="remodal-bg">
							<div class="remodal" data-remodal-id="remodal_<?echo $payee_id;?>" data-remodal-options="hashTracking: false, closeOnOutsideClick: false">
									<div class="color-line"></div>
									<div class="modal-header">
										<div class="row">
											<div class="col-md-5 col-md-offset-3">
												<h4 class="modal-title"><span id="switch_<?echo $payee_id?>">Viewing:</span> <strong><?echo $payee_name?></strong></h4>
											</div>
											<div class="col-md-1">
											
											</div>											
											<div class="col-md-2">
												<div class="checkbox checkbox-success">
													<input id="checkbox_<?echo $payee_id?>" type="checkbox" class="edit_mode">
													<label id="edit_mode_text_<?echo $payee_id?>" for="checkbox_<?echo $payee_id?>">
														Edit Mode
													</label>
												</div>
											</div>
										</div>									
									</div>					
										<div class="modal-body">
										<form id="view_form_<?echo $payee_id;?>" class="view_form_<?echo $payee_id;?>" method="POST" enctype="multipart/form-data" >
										<div class="row">
											<div class="form-group">
												<div class="col-lg-4 col-md-4 col-sm-3 col-xs-12">
													<div class="form-group">
														<label class="control-label pull-left" for="payee_name">Payee Name: <i class="text-danger">*</i></label>
														<input id="payee_name_<?echo $payee_id?>" placeholder="Eg) Staples LTD." type="text" value="<?echo $payee_name?>" class="form-control field_value_<?echo $payee_id?> readonly_<?echo $payee_id?>" autocomplete="off" disabled>
													</div>
												</div>									
											</div>
										</div>
										<div class="row">
												<div class="form-group">
												<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
													<label class="control-label pull-left" for="payee_address">Street Address: <i class="text-danger"></i></label>
													<input id="payee_address_<?echo $payee_id?>" placeholder="Eg) 350R Shawville Blvd SE #140" type="text" value="<?echo $payee_address?>" class="form-control pull-right field_value_<?echo $payee_id?> 
													readonly_<?echo $payee_id?>" autocomplete="off" disabled>
												</div>
												<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
													<div class="form-group">
														<label class="control-label pull-left" for="payee_email">Email: <i class="text-danger"></i></label>
														<input id="payee_email_<?echo $payee_id?>" placeholder="Eg) bob@gmail.com" type="email" value="<?echo $payee_email?>" class="form-control field_value_<?echo $payee_id?> readonly_<?echo $payee_id?>" autocomplete="off" disabled> 
													</div>
												</div>
												<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
													<div class="form-group">
														<label class="control-label pull-left" for="payee_phone">Phone: <i class="text-danger"></i></label>
														<input id="payee_phone_<?echo $payee_id?>" placeholder="Eg) (403) 699-6999." type="text" value="<?echo $payee_phone?>" class="form-control field_value_<?echo $payee_id?> readonly_<?echo $payee_id?>" autocomplete="off" disabled>
													</div>
												</div>												
												</div>										
										</div>				
									
										<div class="row">
											<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
												<div class="form-group">
													<label class="control-label pull-left" for="payee_city">City: <i class="text-danger"></i></label>
													<input id="payee_city_<?echo $payee_id?>" placeholder="Eg) Calgary" type="text" value="<?echo $payee_city?>" class="form-control field_value_<?echo $payee_id?> readonly_<?echo $payee_id?>" autocomplete="off" disabled>
												</div>
											</div>
											<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
												<div class="form-group">
													<label class="control-label pull-left" for="payee_prov">Province: <i class="text-danger"></i></label>
													<select id="payee_province_<?echo $payee_id?>" class="form-control pull-left province_select readonly_<?echo $payee_id?>" style="width: 100% text-align:left;" disabled>
														<optgroup label="Provinces">
														<?
														$province_query = mysqli_query($db, "SELECT province FROM province ORDER BY province asc");
														while($province_array = mysqli_fetch_assoc($province_query)) {
															$province = $province_array['province'];
															
															$check_result = mysqli_num_rows(mysqli_query($db, "SELECT province FROM payee WHERE province='$province' AND id='$payee_id'"));
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
											<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
												<div class="form-group">
													<label class="control-label pull-left" for="payee_zip">Postal Code: <i class="text-danger"></i></label>
													<input id="payee_zip_<?echo $payee_id?>" placeholder="Eg) T2P 8M5" type="text" value="<?echo $payee_postal?>" class="form-control field_value_<?echo $payee_id?> readonly_<?echo $payee_id?>" autocomplete="off" disabled>
												</div>
											</div>									
										</div>					
										<div class="row" style="padding:13px;">
											<div class="form-group">
											<strong><p style="text-align:left">Additional Information:</p></strong>
												<textarea id="payee_info_<?echo $payee_id?>" class="form-control field_value_<?echo $payee_id?> readonly_<?echo $payee_id?>" rows="5" disabled><?echo $payee_info?></textarea>
											</div>
										</div>						
										<div class="row" style="text-align:left;">
											<div class="col-lg-12">
												<div class="form-group">
													<small><span><strong>Notes:</strong><i class="text-danger"></i> are mandatory fields.</span></small><br/>
													<small class=""><strong>Created On:</strong> <?echo "$created_on";?></small><br/>
													<small class=""><strong>Last Modified On:</strong> <?echo "$modified_on";?> by <?echo $modify_user?></small><br/>													
												</div>
											</div>
										</div>
										</form>										
										
										</div>
									<div class="modal-footer">	
									<div class="pull-left">
										<button type="button" id="delete_<?echo $payee_id;?>" class="btn btn-danger button_delete">Delete</button>
									</div> 
									<div class="pull-right">
										<button type="button" id="close_<?echo $payee_id;?>" class="btn btn-default close_js" data-remodal-action="close">Close</button>
										<button type="button" id="accounting_edit_<?echo $payee_id;?>" class="btn btn-success edit_view">Save Changes</button>
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
		<div class="remodal" data-remodal-id="account_code_modal" data-remodal-options="hashTracking: false, closeOnOutsideClick: false">
				<div class="color-line"></div>
				<div class="modal-header">
					<h4 class="modal-title">Add New Payee</h4>
				</div>
			
				<div class="modal-body">
					<form id="payee_form" method="POST" enctype="multipart/form-data" >
						<div class="row">
							<div class="form-group">
								<div class="col-lg-4 col-md-4 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="control-label pull-left" for="payee_name">Payee Name: <i class="text-danger">*</i></label>
										<input id="payee_name" placeholder="Eg) Staples LTD." type="text" value="" class="form-control" autocomplete="off">
									</div>
								</div>									
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
									<label class="control-label pull-left" for="payee_address">Street Address: <i class="text-danger"></i></label>
									<input id="payee_address" placeholder="Eg) 350R Shawville Blvd SE #140" type="text" value="" class="form-control pull-right
									" autocomplete="off">
								</div>
								<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
									<div class="form-group">
										<label class="control-label pull-left" for="payee_email">Email: <i class="text-danger"></i></label>
										<input id="payee_email" placeholder="Eg) bob@gmail.com" type="email" value="" class="form-control" autocomplete="off">
									</div>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
									<div class="form-group">
										<label class="control-label pull-left" for="payee_phone">Phone: <i class="text-danger"></i></label>
										<input id="payee_phone" placeholder="Eg) (403) 699-6999." type="text" value="" class="form-control" autocomplete="off">
									</div>
								</div>	
							
							</div>									
						</div>				
					
						<div class="row">
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
								<div class="form-group">
									<label class="control-label pull-left" for="payee_city">City: <i class="text-danger"></i></label>
									<input id="payee_city" placeholder="Eg) Calgary" type="text" value="" class="form-control" autocomplete="off">
								</div>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
								<div class="form-group">
									<label class="control-label pull-left" for="payee_prov">Province: <i class="text-danger"></i></label>
									<select id="payee_prov" class="province_select" style="width: 100%">
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
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
								<div class="form-group">
									<label class="control-label pull-left" for="payee_zip">Postal Code: <i class="text-danger"></i><span class="text-danger error_msg1"></span></label>
									<input id="payee_zip" placeholder="Eg) T2P 8M5" type="text" value="" class="form-control" autocomplete="off">
								</div>
							</div>									
						</div>					
						<div class="row" style="padding:13px;">
							<div class="form-group">
							<strong><p style="text-align:left">Additional Information:</p></strong>
								<textarea class="form-control" rows="5" id="payee_info"></textarea>
							</div>
						</div>						
						<div class="row pull-right">
							<div class="col-lg-12">
								<div class="form-group">
									<small><span><strong>Notes:</strong><i class="text-danger"></i> are mandatory fields.</span></small>
								</div>
							</div>
						</div>
						<input type="hidden" id="hidden_username" value="<?echo $user;?>">
					</form>
				</div>	
				<div class="modal-footer">
					<button type="button" class="btn btn-default close_main" data-remodal-action="close">Close</button>
					<button type="button" id="payee_add_submit" class="btn btn-success">Add</button>
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

<!-- App scripts -->
<script src="scripts/homer.js"></script>
<script src="js_custom/form_helper.js"></script>
<script src="js_custom/payee.js"></script>
<script src="vendor/select2-3.5.2/select2.min.js"></script>

<script type="text/javascript">
$(function () {
	$('#payee_table').dataTable({
		"aaSorting": [ [0,'desc'] ]
	});	
	$("#payee_zip").mask("S9S 9S9");
	$("#payee_phone").mask("(999) 999-9999");
	
	$(".province_select").select2();

});
</script>

						

</body>
</html>
<?
}
?>