 <?php
include("../inc/db.php");
date_default_timezone_set('America/Denver');

$auto_email_result = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM automsg_email"));
$auto_email = $auto_email_result['email'];
$auto_pwd = $auto_email_result['pwd'];
$logo = $auto_email_result['logo'];

function sernum() //  generate random gift code based on given template
			{
				$template   = 'XX99XX99';
				$k = strlen($template);
				$sernum = '';
				for ($i=0; $i<$k; $i++)
				{
					switch($template[$i])
					{
						case 'X': $sernum .= chr(rand(65,90)); break;
						case '9': $sernum .= rand(0,9); break;
						case '-': $sernum .= '-';  break;
					}
				}
				return $sernum;
			}
			
$password = sernum();
$md5_password = md5($password);

$username = mysqli_real_escape_string($db, $_POST['email']);
$fname = mysqli_real_escape_string($db, $_POST['fname']);
$lname = mysqli_real_escape_string($db, $_POST['lname']);
$uauth = mysqli_real_escape_string($db, $_POST['uauth']);
$ep_super = mysqli_real_escape_string($db, $_POST['ep_super']);
$position = mysqli_real_escape_string($db, $_POST['position']);

$email_check = mysqli_real_escape_string($db, $_POST['email_check']);

$employee_dob= mysqli_real_escape_string($db, $_POST['employee_dob']);
$employee_sin= mysqli_real_escape_string($db, $_POST['employee_sin']);
$employee_h_phone = mysqli_real_escape_string($db, $_POST['employee_h_phone']);
$employee_m_phone = mysqli_real_escape_string($db, $_POST['employee_m_phone']);
$employee_address = mysqli_real_escape_string($db, $_POST['employee_address']);
$employee_city = mysqli_real_escape_string($db, $_POST['employee_city']);
$employee_province = mysqli_real_escape_string($db, $_POST['employee_province']);
$employee_country = mysqli_real_escape_string($db, $_POST['employee_country']);
$employee_p_code = mysqli_real_escape_string($db, $_POST['employee_p_code']);
$timesheet_type = mysqli_real_escape_string($db, $_POST['timesheet_type']);
$ep_type = mysqli_real_escape_string($db, $_POST['ep_type']);
$employee_hours = mysqli_real_escape_string($db, $_POST['employee_hours']);
$employee_status= mysqli_real_escape_string($db, $_POST['employee_status']);
$contract_start_date= mysqli_real_escape_string($db, $_POST['contract_start_date']);
$contract_end_date= mysqli_real_escape_string($db, $_POST['contract_end_date']);
$employee_vacation = mysqli_real_escape_string($db, $_POST['employee_vacation']);
$employee_comments = mysqli_real_escape_string($db, $_POST['employee_comments']);
$file_contract = $_FILES['file_contract'];
$ep_result_check = mysqli_num_rows(mysqli_query($db, "SELECT * FROM user WHERE username='$username'"));

$user_id = mysqli_real_escape_string($db, $_POST['user_id']);

$delete_id = mysqli_real_escape_string($db, $_POST['delete_id']);

$username_edit = mysqli_real_escape_string($db, $_POST['email_edit']);
$fname_edit = mysqli_real_escape_string($db, $_POST['fname_edit']);
$lname_edit = mysqli_real_escape_string($db, $_POST['lname_edit']);
$uauth_edit = mysqli_real_escape_string($db, $_POST['uauth_edit']);
$ep_super_edit = mysqli_real_escape_string($db, $_POST['ep_super_edit']);
$position_edit = mysqli_real_escape_string($db, $_POST['position_edit']);
$employee_dob_edit= mysqli_real_escape_string($db, $_POST['employee_dob_edit']);
$employee_sin_edit= mysqli_real_escape_string($db, $_POST['employee_sin_edit']);
$employee_h_phone_edit = mysqli_real_escape_string($db, $_POST['employee_h_phone_edit']);
$employee_m_phone_edit = mysqli_real_escape_string($db, $_POST['employee_m_phone_edit']);
$employee_address_edit = mysqli_real_escape_string($db, $_POST['employee_address_edit']);
$employee_city_edit = mysqli_real_escape_string($db, $_POST['employee_city_edit']);
$employee_province_edit = mysqli_real_escape_string($db, $_POST['employee_province_edit']);
$employee_country_edit = mysqli_real_escape_string($db, $_POST['employee_country_edit']);
$employee_p_code_edit = mysqli_real_escape_string($db, $_POST['employee_p_code_edit']);
$ep_type_edit = mysqli_real_escape_string($db, $_POST['ep_type_edit']);
$employee_hours_edit = mysqli_real_escape_string($db, $_POST['employee_hours_edit']);
$employee_status_edit = mysqli_real_escape_string($db, $_POST['employee_status_edit']);
$contract_start_date_edit = mysqli_real_escape_string($db, $_POST['contract_start_date_edit']);
$contract_end_date_edit = mysqli_real_escape_string($db, $_POST['contract_end_date_edit']);
$employee_vacation_edit = mysqli_real_escape_string($db, $_POST['employee_vacation_edit']);
$employee_comments_edit = mysqli_real_escape_string($db, $_POST['employee_comments_edit']);
$user_id2 = mysqli_real_escape_string($db, $_POST['user_id2']);
$close_id = mysqli_real_escape_string($db, $_POST['close_id']);
$close_id2 = mysqli_real_escape_string($db, $_POST['close_id2']);

$file_proposal_edit_msg = mysqli_real_escape_string($db, $_POST['file_proposal_edit_msg']);
$file_proposal_edit = $_FILES['file_proposal_edit'];



$date_sql = date("Y-m-d H:i:s");//sql format*/
$username_full = "$fname $lname";

if (isset($_POST['email']) and isset($_POST['email_check'])) {
	if ($ep_result_check == 0){
		echo $ep_result_check;
	} else {
		echo $ep_result_check;
	}
}


//echo $ep_result_check;
if ($ep_result_check != 0 ) {
echo 'registered';

} else {

if (isset($_POST['fname']) and isset($_POST['user_id'])) {
	
	mysqli_query($db, "INSERT INTO user (username,password,auth,fname,lname,position,first_time,supervisor) VALUES('$username','$md5_password','$uauth','$fname','$lname','$position','yes','$ep_super')");
	
	$last_id = mysqli_insert_id($db);

	$test_var = mysqli_query($db, "INSERT INTO employee_info (user_id,dob,sin,h_phone,m_phone,address,city,province,country,p_code,employee_type,hours,employee_status,contract_start_date,contract_end_date,employee_vacation,comments,timesheet_type) VALUES('$last_id','$employee_dob','$employee_sin','$employee_h_phone','$employee_m_phone','$employee_address','$employee_city','$employee_province','$employee_country','$employee_p_code','$ep_type','$employee_hours','$employee_status','$contract_start_date','$contract_end_date','$employee_vacation','$employee_comments','$timesheet_type')");
	
	
	$file_main_path	='../uploads/contracts/'.$fname.$lname.'('.$username.')';
	if ( ! is_dir($file_main_path)) {
		mkdir($file_main_path);
	}	
	
	$contract_insert_id = mysqli_insert_id($db);	
	
	$file_contract_name = $file_contract['name'];
	$file_contract_tmp = $file_contract['tmp_name'];
	$file_contract_size = $file_contract['size'];
	$file_contract_error = $file_contract['error'];
	$file_name_new_contract= $fname.$lname.'_'.$date_sql.'_'.'contract'.'.'.'pdf';
	$file_destination_contract = $file_main_path.'/'.$file_name_new_contract;
	$sql_file_name_contract= 'contracts/'.$fname.$lname.'('.$username.')'.'/'.$file_name_new_contract;		
	if (move_uploaded_file($file_contract_tmp, $file_destination_contract)) {
		if(mysqli_query($db, "INSERT INTO contract_pdf (user_id,pdf_location,pdf_name) VALUES('$last_id','$sql_file_name_contract','$file_contract_name')")){
		}
	}

	require_once("../mail/class.phpmailer.php");//obtain mailer classes
	require_once("../mail/email/employees_email.php");	//send for approval

}

}

if (isset($file_proposal_edit) and isset($username)) {
	
	$file_main_path	='../uploads/contracts/'.$fname.$lname.'('.$username.')';
	
	if ( ! is_dir($file_main_path)) {
		mkdir($file_main_path);
	}
	
	$file_proposal_name = $file_proposal_edit['name'];
	$file_proposal_tmp = $file_proposal_edit['tmp_name'];
	$file_proposal_size = $file_proposal_edit['size'];
	$file_proposal_error = $file_proposal_edit['error'];

	
	
	$file_name_new_proposal = $fname.$lname.'_'.$date_sql.'_'.'contract'.'.'.'pdf';
	$file_destination_proposal= $file_main_path.'/'.$file_name_new_proposal;
	$sql_file_name_proposal = 'contracts/'.$fname.$lname.'('.$username.')'.'/'.$file_name_new_proposal;
	
 
	
			if (move_uploaded_file($file_proposal_tmp, $file_destination_proposal)) {
				//$proposal_file_check = mysqli_query($db, "SELECT * FROM contract_pdf WHERE user_id='$user_id'");
				//$proposal_check_number = mysqli_num_rows($proposal_file_check);
				mysqli_query($db, "UPDATE contract_pdf SET pdf_name='$file_proposal_name', pdf_location='$sql_file_name_proposal' WHERE user_id='$user_id2'");
				echo 'hello';
			}
	
	if ($_POST['file_proposal_edit_msg'] == "attached") {		
		if ($_FILES['file_proposal_edit']) {
			echo $file_proposal_tmp;

		}					
	}

}

if (isset($_POST['ep_type_edit']) and isset($_POST['user_id2'])) {

	$check = mysqli_query($db, "UPDATE user SET auth='$uauth_edit', position='$position_edit', supervisor='$ep_super_edit' WHERE id='$user_id2'");
	if ($ep_type_edit == 'Contract'){
	$check2 = mysqli_query($db, "UPDATE employee_info SET dob='$employee_dob_edit' , sin='$employee_sin_edit', h_phone='$employee_h_phone_edit', m_phone='$employee_m_phone_edit', address='$employee_address_edit', city='$employee_city_edit', province='$employee_province_edit', country='$employee_country_edit', p_code='$employee_p_code_edit', employee_type='$ep_type_edit', hours='$employee_hours_edit', employee_status='$employee_status_edit', contract_end_date='$contract_end_date_edit', contract_start_date='$contract_start_date_edit', employee_vacation='$employee_vacation_edit', comments='$employee_comments_edit'  WHERE user_id='$user_id2'");
	} else {
	$check2 = mysqli_query($db, "UPDATE employee_info SET dob='$employee_dob_edit' , sin='$employee_sin_edit', h_phone='$employee_h_phone_edit', m_phone='$employee_m_phone_edit', address='$employee_address_edit', city='$employee_city_edit', province='$employee_province_edit', country='$employee_country_edit', p_code='$employee_p_code_edit', employee_type='$ep_type_edit', hours='$employee_hours_edit', employee_status='$employee_status_edit', contract_end_date='', contract_start_date='', employee_vacation='$employee_vacation_edit', comments='$employee_comments_edit'  WHERE user_id='$user_id2'");
	}
	
}

/*
if (isset($_POST['payee_name_edit']) and isset($_POST['user_id'])) {
	$check = mysqli_query($db, "UPDATE payee SET name='$payee_name_edit', address='$payee_address_edit', city='$payee_city_edit', province='$payee_prov_edit', postal='$payee_zip_edit', info='$payee_info_edit', modified_on='$date_sql', by_whom='$username_id', email='$payee_email_edit', phone='$payee_phone_edit' WHERE id='$payee_id'");
	if ($check) {
		echo  "okay";
	}else {
		echo "no";
	}
}
*/
if (isset($_POST['close_id'])) {//grab sql data of payee info and store to json for js to decode upon closing remodal.
	$ep_result = mysqli_query($db, "SELECT * FROM user WHERE id='$close_id'");
	$data = [];
	$i=0;
	while ($row = $ep_result->fetch_array()) {
		$data[] = $row;
	}
	echo json_encode($data);
	$ep_result->close();
}

if (isset($_POST['close_id2'])) {//grab sql data of payee info and store to json for js to decode upon closing remodal.
	$ep_result = mysqli_query($db, "SELECT * FROM employee_info WHERE user_id='$close_id2'");
	$data = [];
	$i=0;
	while ($row = $ep_result->fetch_array()) {
		$data[] = $row;
	}
	echo json_encode($data);
	$ep_result->close();
}


/*
if (isset($_POST['delete_id'])) {
	$result = mysqli_num_rows(mysqli_query($db, "DELETE FROM payee WHERE id='$delete_id'"));
}

*/
?>