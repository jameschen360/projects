<?
include("../inc/db.php");
date_default_timezone_set('America/Denver');

$project_id = mysqli_real_escape_string($db, $_POST['project_id']);
$project_start = mysqli_real_escape_string($db, $_POST['date_from']);
$project_end = mysqli_real_escape_string($db, $_POST['date_to']);
$project_info = mysqli_real_escape_string($db, $_POST['project_info']);
$username = mysqli_real_escape_string($db, $_POST['username']);
$project_email = mysqli_real_escape_string($db, $_POST['project_email']);
$project_contactname = mysqli_real_escape_string($db, $_POST['project_contactname']);
$project_number = mysqli_real_escape_string($db, $_POST['project_number']);
$project_name = mysqli_real_escape_string($db, $_POST['project_name']);
$project_manager = mysqli_real_escape_string($db, $_POST['project_manager']);
$file_proposal = $_FILES['file_proposal'];
$file_approval = $_FILES['file_approval'];
$file_agreement = $_FILES['file_agreement'];

$delete_id = mysqli_real_escape_string($db, $_POST['delete_id']);

$project_start_edit = mysqli_real_escape_string($db, $_POST['project_start_edit']);
$project_end_edit = mysqli_real_escape_string($db, $_POST['project_end_edit']);
$client_contact_edit = mysqli_real_escape_string($db, $_POST['client_contact_edit']);
$project_manager_edit = mysqli_real_escape_string($db, $_POST['project_manager_edit']);
$file_agreement_edit_msg = mysqli_real_escape_string($db, $_POST['file_agreement_edit_msg']);
$file_approval_edit_msg = mysqli_real_escape_string($db, $_POST['file_approval_edit_msg']);
$file_proposal_edit_msg = mysqli_real_escape_string($db, $_POST['file_proposal_edit_msg']);
$project_id_edit = mysqli_real_escape_string($db, $_POST['project_id_edit']);
$client_email_edit = mysqli_real_escape_string($db, $_POST['client_email_edit']);
$project_info_edit = mysqli_real_escape_string($db, $_POST['project_info_edit']);

$file_proposal_edit = $_FILES['file_proposal_edit'];
$file_approval_edit = $_FILES['file_approval_edit'];
$file_agreement_edit = $_FILES['file_agreement_edit'];

$close_id = mysqli_real_escape_string($db, $_POST['close_id']);
$pdf_info_id = mysqli_real_escape_string($db, $_POST['pdf_info_id']);


$date_sql = date("Y-m-d H:i:s");//sql format
$project_name_code_check = mysqli_real_escape_string($db, $_POST['project_name_code_check']);
$project_number_code_check = mysqli_real_escape_string($db, $_POST['project_number_code_check']);

$project_manager_id = mysqli_real_escape_string($db, $_POST['project_manager_id']);

if (isset($_POST['project_name']) and isset($_POST['username'])) {
	
	mysqli_query($db, "INSERT INTO project (project_name,project_number,client_contact,client_email,project_manager,project_start,project_end,info,created_on,modified_on,by_whom) VALUES('$project_name','$project_number','$project_contactname','$project_email','$project_manager','$project_start','$project_end','$project_info','$date_sql','$date_sql','$username')");
	
	$project_id = mysqli_insert_id($db);
	
	$file_main_path	='../uploads/project/'.$project_name.'('.$project_number.')';
	if ( ! is_dir($file_main_path)) {
		mkdir($file_main_path);
	}	
	
	if ($_FILES['file_proposal']) {
		$file_proposal_name = $file_proposal['name'];
		$file_proposal_tmp = $file_proposal['tmp_name'];
		$file_proposal_size = $file_proposal['size'];
		$file_proposal_error = $file_proposal['error'];	
		$file_name_new_proposal = $project_name.'_'.$project_number.'_'.'proposal'.'.'.'pdf';
		$file_destination_proposal = $file_main_path.'/'.$file_name_new_proposal;
		$sql_file_name_proposal = 'project/'.$project_name.'('.$project_number.')'.'/'.$file_name_new_proposal;		
		if (move_uploaded_file($file_proposal_tmp, $file_destination_proposal)) {
			if(mysqli_query($db, "UPDATE project SET proposal_attachment='yes' WHERE id='$project_id'")){
			}
			if(mysqli_query($db, "INSERT INTO file_upload_project (file_destination,project_id,real_file_name,application) VALUES('$sql_file_name_proposal','$project_id','$file_proposal_name','proposal')")){
			}
		}
	}
	if ($_FILES['file_approval']) {
		$file_approval_name = $file_approval['name'];
		$file_approval_tmp = $file_approval['tmp_name'];
		$file_approval_size = $file_approval['size'];
		$file_approval_error = $file_approval['error'];	
		$file_name_new_approval = $project_name.'_'.$project_number.'_'.'approval'.'.'.'pdf';
		$file_destination_approval = $file_main_path.'/'.$file_name_new_approval;
		$sql_file_name_approval = 'project/'.$project_name.'('.$project_number.')'.'/'.$file_name_new_approval;			
		if (move_uploaded_file($file_approval_tmp, $file_destination_approval)) {
			if(mysqli_query($db, "UPDATE project SET approval_attachment='yes' WHERE id='$project_id'")){
			}
			if(mysqli_query($db, "INSERT INTO file_upload_project (file_destination,project_id,real_file_name,application) VALUES('$sql_file_name_approval','$project_id','$file_approval_name','approval')")){
			}
		
		}		
	}
	if ($_FILES['file_agreement']) {
		$file_agreement_name = $file_agreement['name'];
		$file_agreement_tmp = $file_agreement['tmp_name'];
		$file_agreement_size = $file_agreement['size'];
		$file_agreement_error = $file_agreement['error'];
		$file_name_new_agreement = $project_name.'_'.$project_number.'_'.'agreement'.'.'.'pdf';
		$file_destination_agreement = $file_main_path.'/'.$file_name_new_agreement;
		$sql_file_name_agreement = 'project/'.$project_name.'('.$project_number.')'.'/'.$file_name_new_agreement;	
		if (move_uploaded_file($file_agreement_tmp, $file_destination_agreement)) {
			if(mysqli_query($db, "UPDATE project SET agreement_attachment='yes' WHERE id='$project_id'")){
			}
			if(mysqli_query($db, "INSERT INTO file_upload_project (file_destination,project_id,real_file_name,application) VALUES('$sql_file_name_agreement','$project_id','$file_agreement_name','agreement')")){
			}
		
		}		
	}	
}	
		
if (isset($_POST['project_name_code_check'])) {
	$project_name_dup_check = mysqli_query($db, "SELECT * FROM project WHERE project_name='$project_name_code_check'");
	
	$project_name_dup_check = mysqli_num_rows($project_name_dup_check);
	if ($project_name_dup_check >0) {
		echo "taken";
	}else {
		echo "okay";
	}

}
if (isset($_POST['project_number_code_check'])) {
	$project_number_dup_check = mysqli_query($db, "SELECT * FROM project WHERE project_number='$project_number_code_check'");
	
	$project_number_dup_check = mysqli_num_rows($project_number_dup_check);
	if ($project_number_dup_check >0) {
		echo "taken";
	}else {
		echo "okay";
	}

}	

//////////////////////////////////////////
////////////////////////////////////////////

if (isset($_POST['client_contact_edit']) and isset($_POST['username'])) {
$project_array = mysqli_query($db, "SELECT * FROM project WHERE id='$project_id_edit'");
$project_array = mysqli_fetch_assoc($project_array);
$project_name_edit = $project_array['project_name'];
$project_number_edit = $project_array['project_number'];

mysqli_query($db, "UPDATE project SET client_contact='$client_contact_edit',client_email='$client_email_edit',project_manager='$project_manager_edit',project_start='$project_start_edit',project_end='$project_end_edit',info='$project_info_edit',modified_on='$date_sql',by_whom='$username' WHERE id='$project_id_edit'");



	$file_main_path	='../uploads/project/'.$project_name_edit.'('.$project_number_edit.')';
	if ( ! is_dir($file_main_path)) {
		mkdir($file_main_path);
	}
	$file_approval_name = $file_approval_edit['name'];
	$file_approval_tmp = $file_approval_edit['tmp_name'];
	$file_approval_size = $file_approval_edit['size'];
	$file_approval_error = $file_approval_edit['error'];	
	$file_name_new_approval = $project_name_edit.'_'.$project_number_edit.'_'.'approval'.'.'.'pdf';
	$file_destination_approval = $file_main_path.'/'.$file_name_new_approval;
	$sql_file_name_approval = 'project/'.$project_name_edit.'('.$project_number_edit.')'.'/'.$file_name_new_approval;	

	$file_proposal_name = $file_proposal_edit['name'];
	$file_proposal_tmp = $file_proposal_edit['tmp_name'];
	$file_proposal_size = $file_proposal_edit['size'];
	$file_proposal_error = $file_proposal_edit['error'];	
	$file_name_new_proposal = $project_name_edit.'_'.$project_number_edit.'_'.'proposal'.'.'.'pdf';
	$file_destination_proposal = $file_main_path.'/'.$file_name_new_proposal;
	$sql_file_name_proposal = 'project/'.$project_name_edit.'('.$project_number_edit.')'.'/'.$file_name_new_proposal;	
	
	$file_agreement_name = $file_agreement_edit['name'];
	$file_agreement_tmp = $file_agreement_edit['tmp_name'];
	$file_agreement_size = $file_agreement_edit['size'];
	$file_agreement_error = $file_agreement_edit['error'];
	$file_name_new_agreement = $project_name_edit.'_'.$project_number_edit.'_'.'agreement'.'.'.'pdf';
	$file_destination_agreement = $file_main_path.'/'.$file_name_new_agreement;
	$sql_file_name_agreement = 'project/'.$project_name_edit.'('.$project_number_edit.')'.'/'.$file_name_new_agreement;	
	
	
	//Updating or changing attached pdf
	if ($_POST['file_approval_edit_msg'] == "attached") {		
		if ($_FILES['file_approval_edit']) {
			if (move_uploaded_file($file_approval_tmp, $file_destination_approval)) {
							
				mysqli_query($db, "UPDATE project SET approval_attachment='yes' WHERE id='$project_id_edit'");
				$approval_file_check = mysqli_query($db, "SELECT * FROM file_upload_project WHERE project_id='$project_id_edit' AND application='approval'");
				$approval_check_number = mysqli_num_rows($approval_file_check);
				if ($approval_check_number >= 1) {
					mysqli_query($db, "UPDATE file_upload_project SET real_file_name='$file_approval_name', file_destination='$sql_file_name_approval' WHERE project_id='$project_id_edit' AND application='approval'");
				}else {
					mysqli_query($db, "INSERT INTO file_upload_project (file_destination,project_id,real_file_name,application) VALUES('$sql_file_name_approval','$project_id_edit','$file_approval_name','approval')");
					mysqli_query($db, "UPDATE project SET approval_attachment='yes' WHERE id='$project_id_edit'");
					
				}	
			}
		}					
	}else {
		mysqli_query($db, "UPDATE project SET approval_attachment='no' WHERE id='$project_id_edit'");
		mysqli_query($db, "DELETE FROM file_upload_project WHERE project_id='$project_id_edit' AND application='approval'");
		unlink($file_destination_approval);
	}
	
	
	if ($_POST['file_proposal_edit_msg'] == "attached") {		
		if ($_FILES['file_proposal_edit']) {
				

			echo $file_proposal_tmp;
			if (move_uploaded_file($file_proposal_tmp, $file_destination_proposal)) {
							
				mysqli_query($db, "UPDATE project SET proposal_attachment='yes' WHERE id='$project_id_edit'");
				$proposal_file_check = mysqli_query($db, "SELECT * FROM file_upload_project WHERE project_id='$project_id_edit' AND application='proposal'");
				$proposal_check_number = mysqli_num_rows($proposal_file_check);
				if ($proposal_check_number >= 1) {
					mysqli_query($db, "UPDATE file_upload_project SET real_file_name='$file_proposal_name', file_destination='$sql_file_name_proposal' WHERE project_id='$project_id_edit' AND application='proposal'");
				}else {
					mysqli_query($db, "INSERT INTO file_upload_project (file_destination,project_id,real_file_name,application) VALUES('$sql_file_name_proposal','$project_id_edit','$file_proposal_name','proposal')");
					mysqli_query($db, "UPDATE project SET proposal_attachment='yes' WHERE id='$project_id_edit'");
					
				}	
			}
		}					
	}else {
		mysqli_query($db, "UPDATE project SET proposal_attachment='no' WHERE id='$project_id_edit'");
		mysqli_query($db, "DELETE FROM file_upload_project WHERE project_id='$project_id_edit' AND application='proposal'");
		unlink($file_destination_proposal);
	}

	if ($_POST['file_agreement_edit_msg'] == "attached") {		
		if ($_FILES['file_agreement_edit']) {
				

			echo $file_agreement_tmp;
			if (move_uploaded_file($file_agreement_tmp, $file_destination_agreement)) {
							
				mysqli_query($db, "UPDATE project SET agreement_attachment='yes' WHERE id='$project_id_edit'");
				$agreement_file_check = mysqli_query($db, "SELECT * FROM file_upload_project WHERE project_id='$project_id_edit' AND application='agreement'");
				$agreement_check_number = mysqli_num_rows($agreement_file_check);
				if ($agreement_check_number >= 1) {
					mysqli_query($db, "UPDATE file_upload_project SET real_file_name='$file_agreement_name', file_destination='$sql_file_name_agreement' WHERE project_id='$project_id_edit' AND application='agreement'");
				}else {
					mysqli_query($db, "INSERT INTO file_upload_project (file_destination,project_id,real_file_name,application) VALUES('$sql_file_name_agreement','$project_id_edit','$file_agreement_name','agreement')");
					mysqli_query($db, "UPDATE project SET agreement_attachment='yes' WHERE id='$project_id_edit'");
					
				}	
			}
		}					
	}else {
		mysqli_query($db, "UPDATE project SET agreement_attachment='no' WHERE id='$project_id_edit'");
		mysqli_query($db, "DELETE FROM file_upload_project WHERE project_id='$project_id_edit' AND application='agreement'");
		unlink($file_destination_agreement);
	}	



}

///////////////////////////////////////

if (isset($_POST['close_id'])) {//grab sql data of payee info and store to json for js to decode upon closing remodal.
	$project_result1 = mysqli_query($db, "SELECT * FROM project WHERE id='$close_id'");
	$data1 = [];

	while ($row = $project_result1->fetch_array()) {
		$data1[] = $row;	
	}
	
	echo json_encode($data1);
	$project_result1->close();
}

if (isset($_POST['pdf_info_id'])) {//grab sql data of payee info and store to json for js to decode upon closing remodal.
	$project_result2 = mysqli_query($db, "SELECT * FROM file_upload_project WHERE project_id='$pdf_info_id'");
	$data2 = array();
	while ($row = mysqli_fetch_assoc($project_result2)) {
		$data2[] = array('data' => $row);	
	}
	
	echo json_encode($data2);
	$project_result2->close();	
}


if (isset($_POST['delete_id'])) {	
	$project_array = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM project WHERE id='$delete_id'"));
	$project_name = $project_array['project_name'];
	$project_number = $project_array['project_number'];
	$result1 = mysqli_num_rows(mysqli_query($db, "DELETE FROM project WHERE id='$delete_id'"));
	$result2 = mysqli_num_rows(mysqli_query($db, "DELETE FROM file_upload_project WHERE project_id='$delete_id'"));
	$path_delete = '../uploads/project/'.$project_name.'('.$project_number.')';
	system("rm -rf ".escapeshellarg($path_delete));
}

if (isset($_POST['project_manager_id'])) {
	$project_manager_result = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM user WHERE id='$project_manager_id'"));
	$project_manager_fname = $project_manager_result['fname'];
	$project_manager_lname = $project_manager_result['lname'];
	$project_manager_email = $project_manager_result['username'];
	
	$string = "$project_manager_lname, $project_manager_fname ($project_manager_email)";
	echo $string;
}
?>