<?
include("./inc/db.php");
include('inc/header.php');
session_start();
if(empty($_SESSION['login_user']) or $auth != "admin") {
	echo "<meta http-equiv=\"refresh\" content=\"0; url=./\">";
}else {
?>

<!-- Simple splash screen-->
<div class="splash"> <div class="color-line"></div><div class="splash-title"><h1>Expense Codes</h1><p>Loading...</p><div class="spinner"> <div class="rect1"></div> <div class="rect2"></div> <div class="rect3"></div> <div class="rect4"></div> <div class="rect5"></div> </div> </div> </div>
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
                            <span>Expense Codes</span>
                        </li>
                    </ol>
                </div>
                <h2 class="font-light m-b-xs">
                    Expense Codes
                </h2>
                <small>All existing expense codes</small>
				<div class="panel-header"></br>
				</div>
				<div class="panel-header">
					<button type="button" class="btn btn-success" data-remodal-target="account_code_modal">Add New Code</button>
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
				
                <table id="code_table" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
					<th>Expense Item</th>
                    <th>Expense Code</th>
					<th>View</th>
                </tr>
                </thead>
                <tbody>
				
				<?
				$accounting_code_query = mysqli_query($db, "SELECT * FROM accounting_code");
				while($accounting_array = mysqli_fetch_assoc($accounting_code_query)) {
					$accounting_id = $accounting_array['id'];
					$code = $accounting_array['code'];
					$desc = $accounting_array['description'];
					$created_on = $accounting_array['created_on'];
					$modified_on = $accounting_array['modified_on'];
					$by_whom = $accounting_array['by_whom'];
					
					$modify_user = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM user WHERE id='$by_whom'"));
					$modify_user_fname = $modify_user['fname'];
					$modify_user_lname = $modify_user['lname'];
					
					$modify_user = "$modify_user_fname $modify_user_lname";
				?>
                <tr>
                    <td><?echo $desc?></td>
					<td><?echo $code?></td>
                    <td><div class="btn-group cell-center"><button type="button" id="view_id_<?echo $accounting_id?>" class="btn w-xs btn-info btn-xs remodal_view" data-remodal-target="remodal_<?echo $accounting_id;?>">
									View/Edit
								</button>
					</div></td>
                </tr>				
					<!-- make request modal -->
						<div id="accounting_remodal_<?echo $accounting_id?>" class="remodal-bg">
							<div class="remodal" data-remodal-id="remodal_<?echo $accounting_id;?>" data-remodal-options="hashTracking: false, closeOnOutsideClick: false">
									<div class="color-line"></div>
									<div class="modal-header">
										<div class="row">
											<div class="col-md-5 col-md-offset-3">
												<h4 class="modal-title"><span id="switch_<?echo $accounting_id?>">Viewing:</span> <strong><?echo $code?></strong></h4>
											</div>
											<div class="col-md-1">
											
											</div>											
											<div class="col-md-2">
												<div class="checkbox checkbox-success">
													<input id="checkbox_<?echo $accounting_id?>" type="checkbox" class="edit_mode">
													<label id="edit_mode_text_<?echo $accounting_id?>" for="checkbox_<?echo $accounting_id?>">
														Edit Mode
													</label>
												</div>
											</div>
										</div>									
									</div>				
										<div class="modal-body">
										<form id="view_form_<?echo $accounting_id;?>" class="view_form_<?echo $accounting_id;?>" method="POST" enctype="multipart/form-data" >
											<div class="row">
												<div class="form-group">
													<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
														<div class="form-group">
															<label class="control-label pull-left" for="code">Expense Code: <i class="text-danger">*</i><span class="text-danger error_msg<?echo $accounting_id?>"></span></label>
															<input type="number" id="code_<?echo $accounting_id;?>" value="<?echo $code;?>" class="form-control field_value_<?echo $accounting_id?> readonly_<?echo $accounting_id?>" autocomplete="off" disabled>
														</div>
													</div>
													<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
														<div class="form-group">
															<label class="control-label pull-left" for="date_to">Expense Item (Description): <i class="text-danger">*</i><span class="text-danger error_msg<?echo $accounting_id?>"></span></label>
															<input type="text" id="desc_<?echo $accounting_id;?>" value="<?echo $desc;?>" class="form-control field_value_<?echo $accounting_id?> readonly_<?echo $accounting_id?>" autocomplete="off" disabled>
														</div>
													</div>
												</div>
											</div>
										</form>	
										<div class="row" style="text-align:left;">
											<div class="col-lg-12">
												<div class="form-group">
													<small><span><strong>Notes:</strong><i class="text-danger">*</i> are mandatory fields.</span></small><br/>
													<small class=""><strong>Created On:</strong> <?echo "$created_on";?></small><br/>
													<small class=""><strong>Last Modified On:</strong> <?echo "$modified_on";?> by <?echo $modify_user?></small>												
												</div>
											</div>
										</div>											
										</div>
									<div class="modal-footer">	
									<div class="pull-left">
										<button type="button" id="delete_<?echo $accounting_id;?>" class="btn btn-danger button_delete">Delete</button>
									</div> 
									<div class="pull-right">
										<button type="button" id="close_<?echo $accounting_id;?>" class="btn btn-default close_js" data-remodal-action="close">Close</button>
										<button type="button" id="accounting_edit_<?echo $accounting_id;?>" class="btn btn-success edit_view">Save Changes</button>
									</div>									
									</div>
							</div><!-- tab-content -->
						</div> <!-- /form -->  	
						<script>
						$(function () {
							$('#code_'+<?echo $accounting_id;?>).mask("9999");
						});
						</script>
											
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
	<div id="accounting_remodal" class="remodal-bg">
		<div class="remodal" data-remodal-id="account_code_modal" data-remodal-options="hashTracking: false, closeOnOutsideClick: false">
				<div class="color-line"></div>
				<div class="modal-header">
					<h4 class="modal-title">Add New Expense Code</h4>
				</div>
			
					<div class="modal-body">
					
					<form id="accounting_code_form" method="POST" enctype="multipart/form-data" >
						<div class="row">
							<div class="form-group">
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<div class="form-group">
										<label class="control-label pull-left" for="code">Expense Code: <i class="text-danger">*</i><span class="text-danger error_msg1"></span></label>
										<input id="accounting_code" placeholder="Eg) 4700" type="number" value="" class="form-control" name="code" autocomplete="off">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<div class="form-group">
										<label class="control-label pull-left" for="date_to">Expense Item (Description): <i class="text-danger">*</i><span class="text-danger error_msg2"></span></label>
										<input id="description" placeholder="Eg) Office Supplies" type="text" value="" class="form-control pull-right
										" name="description" autocomplete="off">
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
						<input type="hidden" id="hidden_username" value="<?echo $user;?>">
					</form>
				</div>	
				<div class="modal-footer">
					<button type="button" class="btn btn-default close_main" data-remodal-action="close">Close</button>
					<button type="button" id="accounting_add_submit" class="btn btn-success">Add</button>
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
<script src="js_custom/form_helper.js"></script>
<script src="scripts/homer.js"></script>
<script src="js_custom/accounting_code.js"></script>


<script>
$(function () {
	$('#code_table').dataTable({
		"aaSorting": [ [0,'desc'] ]
	});	

	$("#accounting_code").mask("9999");
});
</script>

						

</body>
</html>
<?
}
?>