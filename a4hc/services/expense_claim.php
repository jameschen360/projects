<?php
include("../inc/db.php");
date_default_timezone_set('America/Denver');

$auto_email_result = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM automsg_email"));
$auto_email = $auto_email_result['email'];
$auto_pwd = $auto_email_result['pwd'];
$logo = $auto_email_result['logo'];


$project_array = mysqli_real_escape_string($db, $_POST['project_array']);
$expense_array = mysqli_real_escape_string($db, $_POST['expense_array']);
$amount_array = mysqli_real_escape_string($db, $_POST['array_amount']);
$payee_name = mysqli_real_escape_string($db, $_POST['payee_name']);
$total_amount_insert = mysqli_real_escape_string($db, $_POST['total_amount_insert']);
$total_gst_insert = mysqli_real_escape_string($db, $_POST['total_gst_insert']);
$payee_type = mysqli_real_escape_string($db, $_POST['payee_type']);

$supervisor_name = mysqli_real_escape_string($db, $_POST['supervisor_name']);



$notify_admin = mysqli_real_escape_string($db, $_POST['notify_admin']);

$invoice = $_FILES['invoice'];

$user_id = mysqli_real_escape_string($db, $_POST['user']);
$username = mysqli_real_escape_string($db, $_POST['username']);

$delete_id = mysqli_real_escape_string($db, $_POST['delete_id']);
$payee_name_selection = mysqli_real_escape_string($db, $_POST['payee_name_selection']);

$date_sql = date("Y-m-d H:i:s");//sql format

$total_exploded = explode("," , $amount_array);
$num_count = count($total_exploded);
$i=0;


$supervisor_name_query = mysqli_query($db, "SELECT * FROM user WHERE id='$supervisor_name'");
$supervisor_name_result = mysqli_fetch_assoc($supervisor_name_query);
$supervisor_fname = $supervisor_name_result['fname'];
$supervisor_lname = $supervisor_name_result['lname'];
$supervisor_email = $supervisor_name_result['username'];

while ($i < $num_count) { //TOTAL AMOUNT calculation
	$new_total += $total_exploded[$i];
	$i++;
}

$total_tax = $new_total*0.05;

$expense_generated_id = date("Y-m-d").'-'.rand(1000000,9999999);//create expense submission id

$user_names = mysqli_query($db, "SELECT * FROM user WHERE id='$user_id'");
$usernames_array = mysqli_fetch_assoc($user_names);
$fname = $usernames_array['fname'];
$lname = $usernames_array['lname'];
$user_email = $usernames_array['username'];

$fullname = "$fname $lname";
$supervisor_fullname = "$supervisor_fname $supervisor_lname";

if (isset($_POST['array_amount']) and $_FILES['invoice'] and isset($_POST['username'])) {
	
	if ($payee_type == "new") {
		mysqli_query($db, "INSERT INTO expense_claim (expense_generated_id,payee_name,application_status,notifier,time_stamp,view_super,view_user,attachment,total_amount,total_gst,requested_user,payee_type) VALUES('$expense_generated_id','$payee_name','Submitted','$supervisor_name','$date_sql','no','yes','yes','$total_amount_insert','$total_gst_insert','$user_id','$payee_type')");		
	}else {
		mysqli_query($db, "INSERT INTO expense_claim (expense_generated_id,payee_name,application_status,notifier,time_stamp,view_super,view_user,attachment,total_amount,total_gst,requested_user,payee_type) VALUES('$expense_generated_id','$payee_name','Submitted','$supervisor_name','$date_sql','no','yes','yes','$total_amount_insert','$total_gst_insert','$user_id','$payee_type')");		
	}
	
	$expense_insert_id = mysqli_insert_id($db);	
	
	mysqli_query($db, "INSERT INTO notification (task,task_id,user_id,supervisor_id,user_viewed,supervisor_viewed,date) VALUES ('expense','$expense_insert_id','$user_id','$supervisor_name','yes','no','$date_sql')");

	$k=0;	
	$project_array = explode("," , $project_array);
	$expense_array = explode("," , $expense_array);
	$amount_array = explode("," , $amount_array);
	
	while ($k < $num_count) {
		$project_name = $project_array[$k];
		$expense_code = $expense_array[$k];
		$amount = $amount_array[$k];
		
		$code_desc = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM accounting_code WHERE code='$expense_code'"));
		$code_desc = $code_desc['description'];
		
		$project_name_result = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM project WHERE id='$project_name'"));
		$project_name_full = $project_name_result['project_name'];
		
		if (mysqli_query($db, "INSERT INTO expense_claim_detail (expense_id,project_name,expense_code,amount,accounting_name,project_name_full) VALUES('$expense_insert_id','$project_name','$expense_code','$amount','$code_desc','$project_name_full')")) {
		}	
		$k++;
	}

	$userfolder_name = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM user WHERE id='$user_id'"));
	
	$fname = $userfolder_name['fname'];
	$lname = $userfolder_name['lname'];
	
	$project_name_insert = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM payee WHERE id='$payee_name'"));
	$payee_name_insert = $project_name_insert['name'];

	$file_main_path	='../uploads/expense/'.$fname.$lname.'('.$username.')';
	if ( ! is_dir($file_main_path)) {
		mkdir($file_main_path);
	}
	
	$file_invoice_name = $invoice['name'];
	$file_invoice_tmp = $invoice['tmp_name'];
	$file_invoice_size = $invoice['size'];
	$file_invoice_error = $invoice['error'];	
	$file_name_new_invoice = $payee_name_insert.'_'.$date_sql.'_'.'invoice'.'.'.'pdf';
	$file_destination_invoice = $file_main_path.'/'.$file_name_new_invoice;
	$sql_file_name_invoice = 'expense/'.$fname.$lname.'('.$username.')'.'/'.$file_name_new_invoice;		
	if (move_uploaded_file($file_invoice_tmp, $file_destination_invoice)) {
		if(mysqli_query($db, "INSERT INTO file_upload (username,file_destination,topic,request_id,real_file_name) VALUES('$user_id','$sql_file_name_invoice','expense','$expense_insert_id','$file_invoice_name')")){
		}
	}
	require_once("../mail/class.phpmailer.php");//obtain mailer classes
    require_once("../mail/email/expense_claim_email.php");//send for notification pending approval
	
}


if (isset($_POST['delete_id']) and isset($_POST['username'])) {
	$check = mysqli_num_rows(mysqli_query($db, "SELECT * FROM expense_claim WHERE id='$delete_id' AND application_status='Submitted'"));
	if ($check == 1) {
		$supervisor_id_query = mysqli_query($db, "SELECT * FROM expense_claim WHERE id='$delete_id'");
		$supervisor_id_result = mysqli_fetch_assoc($supervisor_id_query);
		$supervisor_id = $supervisor_id_result['notifier'];
		$expense_generated_id = $supervisor_id_result['expense_generated_id'];		
		$user_id = $supervisor_id_result['requested_user'];		
		
		$supervisor_info_query = mysqli_query($db, "SELECT * FROM user WHERE id='$supervisor_id'");
		$supervisor_info_result = mysqli_fetch_assoc($supervisor_info_query);		
		$supervisor_fname = $supervisor_info_result['fname'];
		$supervisor_lname = $supervisor_info_result['lname'];
		
		$user_info_query = mysqli_query($db, "SELECT * FROM user WHERE id='$user_id'");
		$user_info_result = mysqli_fetch_assoc($user_info_query);		
		$user_fname = $user_info_result['fname'];
		$user_lname = $user_info_result['lname'];
		
		$supervisor_name = "$supervisor_fname $supervisor_lname";
		$user_name = "$user_fname $user_lname";
		$supervisor_username = $supervisor_info_result['username'];
	
		$result = mysqli_num_rows(mysqli_query($db, "DELETE FROM expense_claim WHERE id='$delete_id' AND application_status='Submitted'"));		
		mysqli_query($db, "DELETE FROM expense_claim_detail WHERE expense_id='$delete_id'");
		$file_url_result = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM file_upload WHERE topic='expense' AND request_id='$delete_id'"));
		$file_url = $file_url_result['file_destination'];
		unlink("../uploads/".$file_url);
		mysqli_query($db, "DELETE FROM file_upload WHERE topic='expense' AND request_id='$delete_id'");
		mysqli_query($db, "DELETE FROM notification WHERE task='expense' AND task_id='$delete_id'");
		
		
		require_once("../mail/class.phpmailer.php");//obtain mailer classes
		require_once("../mail/email/expense_delete.php");	//send for deletion	
			echo "okay";
	}else {
		echo "no";
	}
	
}





/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$comment = mysqli_real_escape_string($db, $_POST['comment']);
$id = mysqli_real_escape_string($db, $_POST['id']);
$purpose = mysqli_real_escape_string($db, $_POST['purpose']);
$supervisor = mysqli_real_escape_string($db, $_POST['supervisor']);

$supervisor_name_query = mysqli_query($db, "SELECT * FROM user WHERE id='$supervisor'");
$supervisor_name_result = mysqli_fetch_assoc($supervisor_name_query);
$supervisor_fname = $supervisor_name_result['fname'];
$supervisor_lname = $supervisor_name_result['lname'];
$supervisor_email = $supervisor_name_result['username'];

$supervisor_name = "$supervisor_fname $supervisor_lname";

$expense_query = mysqli_query($db, "SELECT * FROM expense_claim WHERE id='$id'");
$expense_result = mysqli_fetch_assoc($expense_query);
$expense_generated_id = $expense_result['expense_generated_id'];
$requested_id = $expense_result['requested_user'];

$payee_name_no_exist = $expense_result['payee_name'];

$user_id = mysqli_query($db, "SELECT * FROM user WHERE id='$requested_id'");
$user_id_result = mysqli_fetch_assoc($user_id);
$user_id_fname = $user_id_result['fname'];
$user_id_lname = $user_id_result['lname'];
$user_id_email = $user_id_result['username'];

$username = "$user_id_fname $user_id_lname";


if (isset($_POST['notify_admin'])) {
	mysqli_query($db, "UPDATE expense_claim SET application_status='Approved', view_super='yes', view_user='no', supervisor_action_time='$date_sql', by_supervisor='$supervisor', comment='$comment'  WHERE id='$id'");
	
	require_once("../mail/class.phpmailer.php");//obtain mailer classes
	require_once("../mail/email/new_payee.php");	//send for approval		
}

if (isset($_POST['purpose']) and isset($_POST['username'])) {
	
	$check2 = mysqli_num_rows(mysqli_query($db, "SELECT * FROM expense_claim WHERE id='$id' AND application_status='Submitted'"));
	
	if ($check2 == 1) {
		if ($purpose == "reject") {
			mysqli_query($db, "UPDATE expense_claim SET application_status='Rejected', view_super='yes', view_user='no', supervisor_action_time='$date_sql', by_supervisor='$supervisor', comment='$comment' WHERE id='$id'");
		}else {
			mysqli_query($db, "UPDATE expense_claim SET application_status='Approved', view_super='yes', view_user='no', supervisor_action_time='$date_sql', by_supervisor='$supervisor', comment='$comment'  WHERE id='$id'");
			
			if ($_POST['payee_name_selection'] != "undefined") {
				mysqli_query($db, "UPDATE expense_claim SET payee_name='$payee_name_selection', payee_type='database' WHERE id='$id'");	
				
				$file_destination_result = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM file_upload WHERE topic='expense' AND request_id='$id'"));
				
				$file_destination = $file_destination_result['file_destination'];
				
				$basename = basename($file_destination);
				$filename_exploded = explode("_", $basename);
				
				$payee_name_result = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM payee WHERE id='$payee_name_selection'"));
				
				$payee_name = $payee_name_result['name'];
				
				$destination_explode = explode("/", $file_destination);
				
				$new_file_name = $destination_explode[0].'/'.$destination_explode[1].'/'.$payee_name.'_'.$filename_exploded[1].'_'.$filename_exploded[2];
				
				$first_destination = '../uploads/'.$file_destination;
				$second_destination = '../uploads/'.$new_file_name;
				
				rename ($first_destination, $second_destination);
				mysqli_query($db, "UPDATE file_upload SET file_destination='$new_file_name' WHERE request_id='$id' AND topic='expense'");
				
			}			
			
		}
		
		if ($purpose == "reject") {
			$purpose_text = "rejected";
		}else {
			$purpose_text = "approved";
		}
		require_once("../mail/class.phpmailer.php");//obtain mailer classes
		require_once("../mail/email/expense_approval.php");	//send for approval	

		mysqli_query($db, "UPDATE notification SET user_viewed='no', supervisor_viewed='yes' WHERE task='expense' AND task_id='$id'");
		
	}else {
		echo "no";
	}

	
}


	
	


?>