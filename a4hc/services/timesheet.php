<?php
include("../inc/db.php");
date_default_timezone_set('America/Denver');

$auto_email_result = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM automsg_email"));
$auto_email = $auto_email_result['email'];
$auto_pwd = $auto_email_result['pwd'];
$logo = $auto_email_result['logo'];

$user_id = mysqli_real_escape_string($db, $_POST['user_id']);

$user_id_submitted = mysqli_real_escape_string($db, $_POST['user_id_submitted']);
$timesheet_file = $_FILES['file'];

$month = mysqli_real_escape_string($db, $_POST['month']);
$year = mysqli_real_escape_string($db, $_POST['year']);

$user_id_ex = mysqli_real_escape_string($db, $_POST['user_id_ex']);
$month_ex = mysqli_real_escape_string($db, $_POST['month_ex']);
$year_ex = mysqli_real_escape_string($db, $_POST['year_ex']);

$action = mysqli_real_escape_string($db, $_POST['action']);
$save_user_id = mysqli_real_escape_string($db, $_POST['save_user_id']);
$save_month = mysqli_real_escape_string($db, $_POST['save_month']);
$save_year = mysqli_real_escape_string($db, $_POST['save_year']);

$hours_worked_array = mysqli_real_escape_string($db, $_POST['hours_worked_array']);
$sick_hours_array = mysqli_real_escape_string($db, $_POST['sick_hours_array']);
$vacation_hours_array = mysqli_real_escape_string($db, $_POST['vacation_hours_array']);
$stat_hours_array = mysqli_real_escape_string($db, $_POST['stat_hours_array']);
$ot_banked_array = mysqli_real_escape_string($db, $_POST['ot_banked_array']);
$ot_taken_array = mysqli_real_escape_string($db, $_POST['ot_taken_array']);
$timesheet_date_array = mysqli_real_escape_string($db, $_POST['timesheet_date_array']);
$timesheet_to_date_array = mysqli_real_escape_string($db, $_POST['timesheet_to_date_array']);
$period_format = mysqli_real_escape_string($db, $_POST['period_format']);


$user_comments = mysqli_real_escape_string($db, $_POST['comments']);



$requested_userid_pull = mysqli_real_escape_string($db, $_POST['requested_userid_pull']);
$month_pull = mysqli_real_escape_string($db, $_POST['month_pull']);
$year_pull = mysqli_real_escape_string($db, $_POST['year_pull']);

if (isset($_POST['requested_userid_pull']) && isset($_POST['month_pull']) && isset($_POST['year_pull'])) {
	$pdfInsertQuery = mysqli_query($db, "SELECT * FROM timesheet_general WHERE requested_userid='$requested_userid_pull' AND year='$year_pull' AND month='$month_pull'");
	$data = [];

	while ($row = $pdfInsertQuery->fetch_array()) {
		$data[] = $row;	
	}		
	echo json_encode($data);
	$pdfInsertQuery->close();	
}


$date_sql = date("Y-m-d H:i:s");//sql format

if ($action == "submit") {
	$timesheet_status = "Submitted";
}else {
	$timesheet_status = "Saved";
}

$supervisor_get = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM user WHERE id='$save_user_id'"));

$supervisor_id = $supervisor_get['supervisor'];

if (isset($_POST['user_id']) and isset($_POST['month']) and isset($_POST['year'])) {
	$timesheet_ex_check = mysqli_query($db, "SELECT * FROM timesheet WHERE user_id='$user_id' AND year_date='$year' AND month_date='$month'");
	$timesheet_rows_check = mysqli_num_rows($timesheet_ex_check);
	
	if ($timesheet_rows_check == 0) {//create the timeslots	
		$days = cal_days_in_month(CAL_GREGORIAN,$month,$year);		
		echo $days;		
	}else {
		echo "exist";
	}
}

if (isset($_POST['user_id_submitted']) and isset($_POST['month']) and isset($_POST['year'])) {
	$timesheet_ex_check = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM timesheet_general WHERE requested_userid='$user_id_submitted' AND year='$year' AND month='$month'"));
	$my_timesheet_id = $timesheet_ex_check['id'];
	echo $my_timesheet_id;
}

if (isset($_POST['save_user_id']) and isset($_POST['action'])) {
	if ($action == "save") {
		$action="Saved";
	}
	if ($action == "submit") {
		$action="Submitted";
	}
	
	$hours_worked_array = explode("," , $hours_worked_array);
	$sick_hours_array = explode("," , $sick_hours_array);
	$vacation_hours_array = explode("," , $vacation_hours_array);
	$stat_hours_array = explode("," , $stat_hours_array);
	$ot_banked_array = explode("," , $ot_banked_array);
	$ot_taken_array = explode("," , $ot_taken_array);
	$timesheet_date_array = explode("," , $timesheet_date_array);
	$timesheet_to_date_array = explode("," , $timesheet_to_date_array);
	$num_count = count($timesheet_date_array);
	$i=0;
	
	$check_ex_num = mysqli_num_rows(mysqli_query($db, "SELECT * FROM timesheet where user_id='$save_user_id' AND year_date='$save_year' AND month_Date='$save_month'"));
	
	if ($check_ex_num > 1) {
		$query_timesheet_general_insert = "
										  UPDATE timesheet_general
										  SET timesheet_status='$action', isRejected='no'
									      WHERE 
										  requested_userid='$save_user_id'
										  AND
										  year='$save_year'
										  AND
										  month='$save_month'
										  ";
		$insert_query_general = mysqli_query($db, $query_timesheet_general_insert);
		
		$last_id_result = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM timesheet_general WHERE requested_userid='$save_user_id' AND year='$save_year' AND month='$save_month'"));
		$last_id = $last_id_result['id'];
		
		while ($i < $num_count) {
			$temp_hours_worked = (float)$hours_worked_array[$i];
			$temp_sick_hours = (float)$sick_hours_array[$i];
			$temp_vacation_hours = (float)$vacation_hours_array[$i];
			$temp_stat_hours = (float)$stat_hours_array[$i];
			$temp_ot_banked = (float)$ot_banked_array[$i];
			$temp_ot_taken = (float)$ot_taken_array[$i];
			$temp_timesheet_date = $timesheet_date_array[$i];
			
			$update_query = "UPDATE timesheet
							SET submitted_date='$date_sql', hours_worked='$temp_hours_worked',sick_hours='$temp_sick_hours',vacation_hours='$temp_vacation_hours',stat_hours='$temp_stat_hours',ot_hours_banked='$temp_ot_banked',ot_hours_taken='$temp_ot_taken', timesheet_status='$action' WHERE from_date='$temp_timesheet_date' AND user_id='$save_user_id'
							";			
			$update_query = mysqli_query($db, $update_query);
			$i++;
		}
	}else {
		$query_timesheet_general_insert = "
										  INSERT INTO timesheet_general (requested_userid,supervisor_id,timesheet_status,month,year,isRejected) VALUES ('$save_user_id','$supervisor_id','$timesheet_status','$save_month','$save_year','no')												  
										  ";
		$insert_query_general = mysqli_query($db, $query_timesheet_general_insert);
		$last_id = mysqli_insert_id($db);		
		
		while ($i < $num_count) {
			$temp_hours_worked = (float)$hours_worked_array[$i];
			$temp_sick_hours = (float)$sick_hours_array[$i];
			$temp_vacation_hours = (float)$vacation_hours_array[$i];
			$temp_stat_hours = (float)$stat_hours_array[$i];
			$temp_ot_banked = (float)$ot_banked_array[$i];
			$temp_ot_taken = (float)$ot_taken_array[$i];
			$temp_timesheet_date = $timesheet_date_array[$i];
			$temp_timesheet_to_date = $timesheet_to_date_array[$i];
		
			
			if (!empty($period_format)){
				$query_insert = "INSERT INTO timesheet (timesheet_id,from_date,to_date,year_date,month_date,timesheet_type,user_id,supervisor_id,submitted_date,timesheet_status,hours_worked,sick_hours,vacation_hours,stat_hours,ot_hours_taken,ot_hours_banked) VALUES ('$last_id','$temp_timesheet_date','$temp_timesheet_to_date','$save_year','$save_month','Period','$save_user_id','$supervisor_id','$date_sql','$timesheet_status','$temp_hours_worked','$temp_sick_hours','$temp_vacation_hours','$temp_stat_hours','$temp_ot_taken','$temp_ot_banked')";
			
				$insert_query = mysqli_query($db, $query_insert);
			
			}else{			
				
				$query_insert = "INSERT INTO timesheet (timesheet_id,from_date,to_date,year_date,month_date,timesheet_type,user_id,supervisor_id,submitted_date,timesheet_status,hours_worked,sick_hours,vacation_hours,stat_hours,ot_hours_taken,ot_hours_banked) VALUES ('$last_id','$temp_timesheet_date','$temp_timesheet_date','$save_year','$save_month','Day','$save_user_id','$supervisor_id','$date_sql','$timesheet_status','$temp_hours_worked','$temp_sick_hours','$temp_vacation_hours','$temp_stat_hours','$temp_ot_taken','$temp_ot_banked')";
			
				$insert_query = mysqli_query($db, $query_insert);
				
			}
			$i++;
		}	
	}

	if ($action=="Submitted") {
		
		$userQuery = mysqli_query($db, "SELECT * FROM user WHERE id='$save_user_id'");
		
		$userQuery_result = mysqli_fetch_assoc($userQuery);
		
		$username = $userQuery_result['username'];
		
		$file_main_path	='../uploads/timesheet/'.$username;
		if ( ! is_dir($file_main_path)) {
			mkdir($file_main_path);
		}
		
		$saveMonth= monthtoword($save_month);
		
		if ($_FILES['file']) {
			$file_timesheet_name = $timesheet_file['name'];
			$file_timesheet_tmp = $timesheet_file['tmp_name'];
			$file_timesheet_size = $timesheet_file['size'];
			$file_timesheet_error = $timesheet_file['error'];	
			$file_name_new_timesheet = $username.' ('.$saveMonth.' '.$save_year.')'.'.pdf';
			$file_destination_timesheet = $file_main_path.'/'.$file_name_new_timesheet;
			$sql_file_name_timesheet = 'timesheet/'.$username.'/'.$file_name_new_timesheet;		
			if (move_uploaded_file($file_timesheet_tmp, $file_destination_timesheet)) {
			}
		}		
		mysqli_query($db, "UPDATE timesheet_general SET user_comments='$user_comments', pdf_path='$sql_file_name_timesheet' WHERE id='$last_id'");
			
		$user_info_result = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM user WHERE id='$save_user_id'"));
		
		$user_fname = $user_info_result['fname'];
		$user_lname = $user_info_result['lname'];
		$supervisor_id = $user_info_result['supervisor'];
		
		$user_fullname = "$user_fname $user_lname";//user full name
		
		$super_info_result = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM user WHERE id='$supervisor_id'"));
		
		$super_fname = $super_info_result['fname'];
		$super_lname = $super_info_result['lname'];	
		$super_email = $super_info_result['username'];	
		$super_fullname = "$super_fname $super_lname";//super full name
		
		$month_word = monthtoword($save_month);
		
		mysqli_query($db, "INSERT INTO notification (task,task_id,user_id,supervisor_id,user_viewed,supervisor_viewed,date) VALUES ('timesheet','$last_id','$save_user_id','$supervisor_id','yes','no','$date_sql')");			
		
		require_once("../mail/class.phpmailer.php");//obtain mailer classes
		require_once("../mail/email/timesheet_email.php");//send for notification pending approval			
	}	

}

if (isset($_POST['user_id_ex']) and isset($_POST['month_ex']) and isset($_POST['year_ex'])) {
	$check_submission = mysqli_query($db, "SELECT * FROM timesheet WHERE user_id='$user_id_ex' AND year_date='$year_ex' AND month_date='$month_ex' LIMIT 1");
	$check_result = mysqli_fetch_assoc($check_submission);
	$submission_status = $check_result['timesheet_status'];
	
	if ($submission_status == "Saved") {
		$timesheet_result = mysqli_query($db, "SELECT * FROM timesheet WHERE user_id='$user_id_ex' AND year_date='$year_ex' AND month_date='$month_ex'");
		$data = [];

		while ($row = $timesheet_result->fetch_array()) {
			$data[] = $row;	
		}		
		echo json_encode($data);
		$timesheet_result->close();
		
	}else if ($submission_status == "Submitted" or $submission_status == "Approved") {
		$timesheet_result = mysqli_query($db, "SELECT * FROM timesheet WHERE user_id='$user_id_ex' AND year_date='$year_ex' AND month_date='$month_ex'");
		$data = [];

		while ($row = $timesheet_result->fetch_array()) {
			$data[] = $row;	
		}		
		echo json_encode($data);
		$timesheet_result->close();
		
	}else  {
		echo "error";
	}
	
}

$approval_purpose = mysqli_real_escape_string($db, $_POST['purpose']);
$approval_timesheet_id = mysqli_real_escape_string($db, $_POST['id']);
$approval_username = mysqli_real_escape_string($db, $_POST['username']);
$super_comments = mysqli_real_escape_string($db, $_POST['super_comments']);

if (isset($_POST['purpose']) and isset($_POST['username']) and isset($_POST['id'])) {	
	$check2 = mysqli_num_rows(mysqli_query($db, "SELECT * FROM timesheet_general WHERE id='$approval_timesheet_id' AND timesheet_status='Submitted'"));	
	mysqli_query($db, "UPDATE timesheet_general SET super_comments='$super_comments' WHERE id='$approval_timesheet_id'");
	if ($check2 == 1) {
		if ($approval_purpose == "reject") {
			mysqli_query($db, "UPDATE timesheet_general SET timesheet_status='Rejected', super_comments='$super_comments', isRejected='Yes' WHERE id='$approval_timesheet_id'");
			mysqli_query($db, "UPDATE timesheet SET timesheet_status='Saved' WHERE timesheet_id='$approval_timesheet_id'");
			mysqli_query($db, "DELETE FROM notification WHERE task_id='$approval_timesheet_id' AND task='timesheet'");
			
		}else {
			mysqli_query($db, "UPDATE timesheet_general SET timesheet_status='Approved', supervisor_id='$approval_username', isRejected='no' WHERE id='$approval_timesheet_id'");
			mysqli_query($db, "UPDATE timesheet SET timesheet_status='Approved', action_date='$date_sql', approval_status='Approved' WHERE timesheet_id='$approval_timesheet_id'");			
		}
		
		if ($approval_purpose == "reject") {
			$purpose_text = "rejected";
		}else {
			$purpose_text = "approved";
		}
		
		$employee_username_result = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM timesheet_general WHERE id='$approval_timesheet_id'"));
		$employee_userid = $employee_username_result['requested_userid'];
		$employee_timesheet_year = $employee_username_result['year'];
		$employee_timesheet_month = $employee_username_result['month'];
		$employee_user_result = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM user WHERE id='$employee_userid'"));
		$employee_fname = $employee_user_result['fname'];
		$employee_lname = $employee_user_result['lname'];
		$employee_email = $employee_user_result['username'];
		$employee_fullname = "$employee_fname $employee_lname";
		
		require_once("../mail/class.phpmailer.php");//obtain mailer classes
		require_once("../mail/email/timesheet_approval.php");	//send for approval	
		mysqli_query($db, "UPDATE notification SET user_viewed='no', supervisor_viewed='yes' WHERE task='timesheet' AND task_id='$approval_timesheet_id'");
		
	}else {
		echo "no";
	}	
}


///////////////timesheet update version date nov-5th-2017/////////////////////
$super_comments = mysqli_real_escape_string($db, $_POST['rejectedCheck']);
$user_id = mysqli_real_escape_string($db, $_POST['user_id']);
if (isset($_POST['rejectedCheck'])) {
	$checkNumQuery = mysqli_query($db, "SELECT * FROM timesheet_general WHERE requested_userid='$user_id' AND isRejected='yes' AND timesheet_status='Rejected'");
	$checkNum = mysqli_num_rows($checkNumQuery);
	$checkNumResult = mysqli_fetch_assoc($checkNumQuery);
	if ($checkNum == 1) {
		$supervisorComment = $checkNumResult['super_comments'];
		echo $supervisorComment;
	} else {
		echo "notRejected";
	}
}



function monthtoword($number) {	
	$number = (float)$number;	
	switch($number) {
		case 1: return "January";
		case 2: return "February";
		case 3: return "March";
		case 4: return "April";
		case 5: return "May";
		case 6: return "June";
		case 7: return "July";
		case 8: return "August";
		case 9: return "September";
		case 10: return "October";
		case 11: return "November";
		case 12: return "December";	
	}
}
?>



















