<?php
include("../inc/db.php");
date_default_timezone_set('America/Denver');

$auto_email_result = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM automsg_email"));
$auto_email = $auto_email_result['email'];
$auto_pwd = $auto_email_result['pwd'];
$logo = $auto_email_result['logo'];

$username = mysqli_real_escape_string($db, $_POST['username']);
$supervisor = mysqli_real_escape_string($db, $_POST['supervisor']);
$reason = mysqli_real_escape_string($db, $_POST['reason']);
// $date_from = mysqli_real_escape_string($db, $_POST['date_from']);
// $date_to = mysqli_real_escape_string($db, $_POST['date_to']);
$delete_id = mysqli_real_escape_string($db, $_POST['delete_id']);

$random_number = rand(1,10000000);
$date_file = date("Y-M-d");
$date_sql = date("Y-m-d H:i:s");//sql format

$user_id = mysqli_fetch_assoc(mysqli_query($db, "SELECT id FROM user WHERE username='$username'"));
$user_id = $user_id['id'];

$super_result = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM user WHERE id='$supervisor'"));
$super_id = $super_result['id'];
$supervisor_fname = $super_result['fname'];
$supervisor_lname = $super_result['lname'];
$supervisor_email = $super_result['username'];
$supervisor_fullname = "$supervisor_fname $supervisor_lname";

$vacation_generated_id = 'vacation-'.date("Y-m-d").'-'.rand(1000000,9999999);//create vacation submission id

$username_data = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM user WHERE id='$user_id'"));
$user_fname = $username_data['fname'];
$user_lname = $username_data['lname'];
$username_full = "$user_fname $user_lname";
$username_email = $username_data['username'];

if (isset($_FILES['file']) and isset($_POST['username'])) {	
	$file = $_FILES['file'];
	
	//file properties
	$file_main_path	='../uploads/vacation/'.$user_fname.$user_lname.'('.$username_email.')';
	if ( ! is_dir($file_main_path)) {
		mkdir($file_main_path);
	}
	
	$file_vacation_name = $file['name'];
	$file_vacation_tmp = $file['tmp_name'];
	$file_vacation_size = $file['size'];
	$file_vacation_error = $file['error'];	
	$file_name_new_vacation = $vacation_generated_id.'.pdf';
	$file_destination_vacation = $file_main_path.'/'.$file_name_new_vacation;
	$sql_file_name_vacation = 'vacation/'.$user_fname.$user_lname.'('.$username_email.')'.'/'.$file_name_new_vacation;

	$file_extension = explode('.', $file_vacation_name);
	$file_extension = strtolower(end($file_extension));
	$allowed = array('pdf');
	
	if (in_array($file_extension, $allowed)) {
echo $file_destination_vacation;
			if ($file_size <= 5000000) {//5MB limit
					
				if (move_uploaded_file($file_vacation_tmp, $file_destination_vacation)) {

					if(mysqli_query($db, "INSERT INTO vacation_request (requested_user,application_status,notifier,time_stamp,view_super,view_user,attachment,reason,vacation_generated_id) VALUES('$user_id','Submitted','$super_id','$date_sql','no','yes','yes','$reason','$vacation_generated_id')")){
					}
					$last_id = mysqli_insert_id($db);
					
					mysqli_query($db, "INSERT INTO notification (task,task_id,user_id,supervisor_id,user_viewed,supervisor_viewed,date) VALUES ('vacation','$last_id','$user_id','$super_id','yes','no','$date_sql')");					
					
					if(mysqli_query($db, "INSERT INTO file_upload (username,file_destination,topic,request_id,real_file_name) VALUES('$user_id','$sql_file_name_vacation','vacation','$last_id','$file_vacation_name')")){
					}
			
					require_once("../mail/class.phpmailer.php");//obtain mailer classes
					require_once("../mail/email/vacation_email.php");//send for notification pending approval			
				}
				
			} else { 
				echo "Files must be less than 5MB.";
			}
	} else { 
		echo "Only PDF files are allowed.";
	}
}else {
	
	if (isset($_POST['username'])) {
		if(mysqli_query($db, "INSERT INTO vacation_request (requested_user,application_status,notifier,time_stamp,view_super,view_user,attachment,reason,vacation_generated_id) VALUES('$user_id','Submitted','$super_id','$date_sql','no','yes','no','$reason','$vacation_generated_id')")){
		}

		$last_id = mysqli_insert_id($db);
		
		mysqli_query($db, "INSERT INTO notification (task,task_id,user_id,supervisor_id,user_viewed,supervisor_viewed,date) VALUES ('vacation','$last_id','$user_id','$super_id','yes','no','$date_sql')");			
		
		require_once("../mail/class.phpmailer.php");//obtain mailer classes
		require_once("../mail/email/vacation_email.php");//send for notification pending approval		
	}
		
	
}
/////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////

if (isset($_POST['delete_id']) and isset($_POST['username'])) {
	$check = mysqli_num_rows(mysqli_query($db, "SELECT * FROM vacation_request WHERE id='$delete_id' AND application_status='Submitted'"));
	if ($check == 1) {
		$supervisor_id_query = mysqli_query($db, "SELECT * FROM vacation_request WHERE id='$delete_id'");
		$supervisor_id_result = mysqli_fetch_assoc($supervisor_id_query);
		$supervisor_id = $supervisor_id_result['notifier'];
		$vacation_generated_id = $supervisor_id_result['vacation_generated_id'];		
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
	
		$result = mysqli_num_rows(mysqli_query($db, "DELETE FROM vacation_request WHERE id='$delete_id' AND application_status='Submitted'"));		
		$file_url_result = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM file_upload WHERE topic='vacation' AND request_id='$delete_id'"));
		$file_url = $file_url_result['file_destination'];
		unlink("../uploads/".$file_url);
		mysqli_query($db, "DELETE FROM file_upload WHERE topic='vacation' AND request_id='$delete_id'");
		mysqli_query($db, "DELETE FROM notification WHERE task='vacation' AND task_id='$delete_id'");	
		require_once("../mail/class.phpmailer.php");//obtain mailer classes
		require_once("../mail/email/vacation_delete.php");	//send for deletion	
			echo "okay";
	}else {
		echo "no";
	}
	
}

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

$vacation_query = mysqli_query($db, "SELECT * FROM vacation_request WHERE id='$id'");
$vacation_result = mysqli_fetch_assoc($vacation_query);
$vacation_generated_id = $vacation_result['vacation_generated_id'];
$requested_id = $vacation_result['requested_user'];

$user_id = mysqli_query($db, "SELECT * FROM user WHERE id='$requested_id'");
$user_id_result = mysqli_fetch_assoc($user_id);
$user_id_fname = $user_id_result['fname'];
$user_id_lname = $user_id_result['lname'];
$user_id_email = $user_id_result['username'];

$username = "$user_id_fname $user_id_lname";

if (isset($_POST['purpose']) and isset($_POST['username'])) {
	
	$check2 = mysqli_num_rows(mysqli_query($db, "SELECT * FROM vacation_request WHERE id='$id' AND application_status='Submitted'"));
	if ($check2 == 1) {
		if ($purpose == "reject") {
			mysqli_query($db, "UPDATE vacation_request SET application_status='Rejected', view_super='yes', view_user='no', supervisor_action_time='$date_sql', by_supervisor='$supervisor', comment='$comment' WHERE id='$id'");
		}else {
			mysqli_query($db, "UPDATE vacation_request SET application_status='Approved', view_super='yes', view_user='no', supervisor_action_time='$date_sql', by_supervisor='$supervisor', comment='$comment' WHERE id='$id'");
		}
		
		if ($purpose == "reject") {
			$purpose_text = "rejected";
		}else {
			$purpose_text = "approved";
		}
		
		mysqli_query($db, "UPDATE notification SET user_viewed='no', supervisor_viewed='yes' WHERE task='vacation' AND task_id='$id'");
		
		require_once("../mail/class.phpmailer.php");//obtain mailer classes
		require_once("../mail/email/vacation_approval.php");	//send for approval		
	}else {
		echo "no";
	}

	
}
?>