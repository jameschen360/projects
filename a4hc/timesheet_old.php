<?
include("inc/db.php");
include('inc/header.php');
session_start();
?>

<?
if(empty($_SESSION['login_user'])) {
	echo "<meta http-equiv=\"refresh\" content=\"0; url=./login\">";
}else {

?>

<!-- Simple splash screen-->
<div class="splash"> <div class="color-line"></div><div class="splash-title"><h1>A4HC Timesheet</h1><p>Loading...</p><div class="spinner"> <div class="rect1"></div> <div class="rect2"></div> <div class="rect3"></div> <div class="rect4"></div> <div class="rect5"></div> </div> </div> </div>
<!--[if lt IE 7]>
<p class="alert alert-danger">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<!-- Main Wrapper -->
<div id="wrapper">
<?
$timesheet_type = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM employee_info WHERE user_id='$user'"));
$timesheet_type = $timesheet_type['timesheet_type'];
?>
    <div class="normalheader transition animated fadeIn small-header">
        <div class="hpanel">
            <div class="panel-body">


                <div id="hbreadcrumb" class="pull-right m-t-lg">
                    <ol class="hbreadcrumb breadcrumb">
                        <li><a href="./">Dashboard</a></li>
                        <li class="active">
                            <span>Timesheet</span>
                        </li>
                    </ol>
                </div>
                <h2 class="font-light m-b-xs">
                  Timesheet
                </h2>
                <small>You can submit and manage your timesheets here!</small>
				<div class="panel-header"></br>
				</div>
				<div class="panel-header panelCommentSection ">
					<button type="button" class="btn btn-success" data-remodal-target="timesheet_select_modal">
					Select Timesheet Dates
					</button>
					<button type="button" class="btn btn-info infoCommentPdf" data-remodal-target="commentModal">
					Insert Comments/PDFs
					</button>
					<button type="button" id="autoParam" class="btn btn-warning defaultHours">
						Auto Default Hours
					</button>					
				</div>				
            </div>
        </div>
    </div>

	<div id="timesheet_slot" style="padding:2em;" > 
		<div class="row">
			<div class="pull-left">
				<h4>
					<div id="timesheet_title"></div>
				</h4>
			</div>
			<div class="pull-right">
				<h6>
					<div id="timesheet_action_time"></div>
					<div id="timesheet_approve_time"></div>
				</h6>				
			</div>			
		</div>
		<div class="table-responsive">
			<table id="timesheet_table" cellpadding="1" cellspacing="1" class="table table-bordered table-striped">
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
					<th>Statutory Hours</th>
					<th>O/T Hours Banked</th>
					<th>O/T Taken</th>
					<th>Hours Paid</th>
				</tr>
				</thead>
				<tbody>				
				</tbody>				
			</table>
		<div class="pull-right">
			<button type="button" id="save" class="btn btn-warning save_button action_button">Save Timesheet</button>
			<button type="button" id="submit" class="btn btn-success submit_button action_button">Submit Timesheet</button>
			<button type="button" class="btn btn-warning pdf_export" id="pdf_<?echo $timesheet_id?>">Export as PDF</button>	
		</div>			
		</div>

   </div>
   
</div>

<!-- make request modal -->
	<div id="timesheet_select" class="remodal-bg">
		<div class="remodal" data-remodal-id="timesheet_select_modal" data-remodal-options="hashTracking: false, closeOnOutsideClick: false">
				<div class="color-line"></div>			
					<div class="modal-body">
					
					<form id="accounting_code_form" method="POST" enctype="multipart/form-data" >
						<div class="row">
						<h3>Please Pick a Month and Year to Continue</h3>
						
							<div class="form-group">
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<div class="form-group">
										<label class="control-label pull-left" for="code">Month: <i class="text-danger">*</i><span class="text-danger error_msg1"></span></label>
									<select id="month" class="time_modal" style="width: 100%">
										<optgroup label="Month">
											<?
											$month_query = mysqli_query($db, "SELECT * FROM month");
											while($month_array = mysqli_fetch_assoc($month_query)) {
												$month_name = $month_array['month'];
												$month_id = $month_array['id'];
											?>
												<option value="<?echo $month_id?>"><?echo "$month_name"?></option>
											<?}?>
										</optgroup>
									</select>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<div class="form-group">
										<label class="control-label pull-left" for="date_to">Year: <i class="text-danger">*</i><span class="text-danger error_msg2"></span></label>
										<select id="year" class="time_modal" style="width: 100%">
											<optgroup label="Year">
												<?
												$years_query = mysqli_query($db, "SELECT * FROM years");
												while($years_array = mysqli_fetch_assoc($years_query)) {
													$years_name = $years_array['years'];
													$years_id = $years_array['id'];
												?>
													<option value="<?echo $years_name?>"><?echo "$years_name"?></option>
												<?}?>
											</optgroup>
										</select>
									</div>
								</div>
								<button type="button" id="timesheet_continue" class="btn btn-success">Continue</button>
							</div>
							
						</div>
						
						
						<div class="row pull-right">
							<div class="col-lg-12">
								<div class="form-group">
								</div>
							</div>
						</div>
						<input type="hidden" id="hidden_username" value="<?echo $user;?>">
					</form>
				</div>	
		</div><!-- tab-content -->
	</div> <!-- /form -->
<!-- make comment modal -->
	<div id="commentModal_section" class="remodal-bg">
		<div class="remodal" data-remodal-id="commentModal" data-remodal-options="hashTracking: false, closeOnOutsideClick: false">
				<div class="color-line"></div>			
					<div class="modal-body">
										
						<div class="row">
							<h3 id="commentTextTimesheet"></h3>
						
							<div class="form-group">
								<div class="col-xs-6">
									<div class="form-group">
										<div class="hpanel" style="margin-bottom:0px;">
											<div class="panel-heading pull-left">Comments</div>
											<textarea class="form-control" rows="5" id="comments"></textarea>
										</div>								
									</div>
								</div>
								
								<div class="col-xs-6">
									<div class="form-group" id="pdf_submit_show">
										<input id="proposal" class="upload" type="file"/>
											<div class="hpanel">
												<div class="panel-heading">PDF Document </div>
												<a href="#" id="upload_proposal" class="upload_link"><div class="panel-body file-body hover-icon_upload proposal_icon">
													<i class="fa fa-file-pdf-o text-danger"></i>
												</div></a>
												<div class="panel-footer text_proposal">
													Select PDF Document
												</div>
											</div>
									</div>
									<div class="form-group" id="pdf_submit_hide">
										<div class="hpanel">
											<div class="panel-heading">PDF Document </div>
											<div id="SubmitPDF"></div>
										</div>									

									</div>
								</div>	
								
								<div class="col-xs-12">
									<div class="form-group" id="supervisor_comments">
										<div class="hpanel" style="margin-bottom:0px;">
											<div class="panel-heading pull-left">Supervisor Comments</div>
											<textarea class="form-control" rows="5" id="supercomments"readonly>
											</textarea>
										</div>								
									</div>
								</div>	
								
							</div>

						</div>
						



						
					</div>	
					<div class="modal-footer">
						<p class="pull-left" id="warningText">**This page will reset if timesheet is not submitted. (Saving the page does not keep comments and PDF.)</p>
						<button type="button" id="" class="btn btn-info close_main" data-remodal-action="close">Okay</button>
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
<script src="vendor/select2-3.5.2/select2.min.js"></script>
<script src="js_custom/timesheet_pdf_export.js"></script>


<!-- App scripts -->
<script src="scripts/homer.js"></script>
<script src="js_custom/date.js"></script>
<?
if ($timesheet_type == "Period") {?>
	<script src="js_custom/timesheet_period.js"></script>							
<?}else if ($timesheet_type == "Day") {?>
	<script src="js_custom/timesheet_day.js"></script>
	
<?}else {
	echo "Something went wrong...";
}

?>	
<script type="text/javascript">
//////////////////////////////////////////////////////
//////////////////////////////////////////////////////
//////////////////////////////////////////////////////
//////////////////////////////////////////////////////
//////////////////////////////////////////////////////
//////////////////////////////////////////////////////	
function monthtoword(number) {
	
	number = parseFloat(number);	
	var returnVal = ""
	
	switch(number) {
		case 1:
			returnVal= "Jan";
			break;
		case 2:
			returnVal= "Feb";
			break;
		case 3:
			returnVal= "Mar";
			break;
		case 4:
			returnVal= "Apr";
			break;
		case 5:
			returnVal= "May";
			break;
		case 6:
			returnVal= "Jun";
			break;
		case 7:
			returnVal= "Jul";
			break;
		case 8:
			returnVal= "Aug";
			break;
		case 9:
			returnVal= "Sep";
			break;
		case 10:
			returnVal= "Oct";
			break;
		case 11:
			returnVal= "Nov";
			break;
		case 12:
			returnVal= "Dec";
			break;		
	}
	return returnVal;	
}
// function isNumberKey(evt){
// 	var charCode = (evt.which) ? evt.which : event.keyCode;
// 	return !(charCode > 31 && (charCode < 48 || charCode > 57));
// }

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
	var whichDay = '<?echo $timesheet_type?>';
	if ( whichDay == "Period") {
		//$(".onchange_input").mask("99.99");	
	}else {
		//$(".onchange_input").mask("9.99");	
	}
	
	
	
});
</script>

</body>
</html>
<?
}
?>