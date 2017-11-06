<?php
include("../inc/db.php");
date_default_timezone_set('America/Denver');

$dob_u = mysqli_real_escape_string($db, $_POST['dob_u']);
$home_address_u = mysqli_real_escape_string($db, $_POST['home_address_u']);
$city_u = mysqli_real_escape_string($db, $_POST['city_u']);
$province_u = mysqli_real_escape_string($db, $_POST['province_u']);
$postal_u = mysqli_real_escape_string($db, $_POST['postal_u']);
$hphone_u = mysqli_real_escape_string($db, $_POST['hphone_u']);
$personal_cphone_u = mysqli_real_escape_string($db, $_POST['personal_cphone_u']);
$password_u = md5(mysqli_real_escape_string($db, $_POST['password_u']));
$user_id = mysqli_real_escape_string($db, $_POST['user_id']);

$close_id1 = mysqli_real_escape_string($db, $_POST['user_id_close1']);
$close_id2 = mysqli_real_escape_string($db, $_POST['user_id_close2']);
$close_id3 = mysqli_real_escape_string($db, $_POST['user_id_close3']);
$close_id4 = mysqli_real_escape_string($db, $_POST['user_id_close4']);

$email_check = mysqli_real_escape_string($db, $_POST['email_check']);
$user_id_check = mysqli_real_escape_string($db, $_POST['user_id_check']);

$fullname_emergency_u = mysqli_real_escape_string($db, $_POST['fullname_emergency_u']);
$emergency_address_u = mysqli_real_escape_string($db, $_POST['emergency_address_u']);
$emergency_hphone_u = mysqli_real_escape_string($db, $_POST['emergency_hphone_u']);
$emergency_cphone_u = mysqli_real_escape_string($db, $_POST['emergency_cphone_u']);

$doctor_fullname_u = mysqli_real_escape_string($db, $_POST['doctor_fullname_u']);
$doctor_address_u = mysqli_real_escape_string($db, $_POST['doctor_address_u']);
$doctor_phone_u = mysqli_real_escape_string($db, $_POST['doctor_phone_u']);
$health_care_number = mysqli_real_escape_string($db, $_POST['health_care_number']);


if (isset($_POST['user_id_close1'])) {//grab sql data of user info and store to json for js to decode upon closing remodal.
	$user_result = mysqli_query($db, "SELECT * FROM user WHERE id='$close_id1'");
	$data = [];
	$i=0;
	while ($row = $user_result->fetch_array()) {
		$data[] = $row;	
	}
	echo json_encode($data);
	$user_result->close();
}

if (isset($_POST['user_id_close2'])) {//grab sql data of user info and store to json for js to decode upon closing remodal.
	$user_result = mysqli_query($db, "SELECT * FROM employee_info WHERE user_id='$close_id2'");
	$data = [];
	$i=0;
	while ($row = $user_result->fetch_array()) {
		$data[] = $row;	
	}
	echo json_encode($data);
	$user_result->close();
}

if (isset($_POST['user_id_close3'])) {//grab sql data of user info and store to json for js to decode upon closing remodal.
	$user_result = mysqli_query($db, "SELECT * FROM emergency_contact WHERE user_id='$close_id3'");
	$data = [];
	$i=0;
	while ($row = $user_result->fetch_array()) {
		$data[] = $row;	
	}
	echo json_encode($data);
	$user_result->close();
}

if (isset($_POST['user_id_close4'])) {//grab sql data of user info and store to json for js to decode upon closing remodal.
	$user_result = mysqli_query($db, "SELECT * FROM medical_info WHERE user_id='$close_id4'");
	$data = [];
	$i=0;
	while ($row = $user_result->fetch_array()) {
		$data[] = $row;	
	}
	echo json_encode($data);
	$user_result->close();
}

if (isset($_POST['user_id']) and isset($_POST['emergency_cphone_u'])) {
	$user_count = mysqli_num_rows(mysqli_query($db, "SELECT * FROM emergency_contact WHERE user_id='$user_id'"));
	if ($user_count == 1) {
		mysqli_query($db, "UPDATE emergency_contact SET full_name='$fullname_emergency_u', home_phone='$emergency_hphone_u', cell_phone='$emergency_cphone_u', address='$emergency_address_u' WHERE user_id='$user_id'");			
	}else {
		mysqli_query($db, "INSERT INTO emergency_contact (full_name,home_phone,cell_phone,address,user_id) VALUES ('$fullname_emergency_u','$emergency_hphone_u','$emergency_cphone_u','$emergency_address_u','$user_id')");
	}	
}

if (isset($_POST['user_id']) and isset($_POST['hphone_u'])) {
	mysqli_query($db, "UPDATE employee_info SET h_phone='$hphone_u', address='$home_address_u', city='$city_u', province='$province_u', p_code='$postal_u', dob='$dob_u', m_phone='$personal_cphone_u' WHERE user_id='$user_id'");
		
	mysqli_query($db, "UPDATE user SET password='$password_u' WHERE id='$user_id'");

}

if (isset($_POST['user_id']) and isset($_POST['doctor_fullname_u'])) {
	$user_count = mysqli_num_rows(mysqli_query($db, "SELECT * FROM medical_info WHERE user_id='$user_id'"));
	if ($user_count == 1) {
		mysqli_query($db, "UPDATE medical_info SET health_care_number='$health_care_number', doctor_name='$doctor_fullname_u', address='$doctor_address_u', phone='$doctor_phone_u' WHERE user_id='$user_id'");			
	}else {
		mysqli_query($db, "INSERT INTO medical_info (health_care_number,doctor_name,address,phone,user_id) VALUES ('$health_care_number','$doctor_fullname_u','$doctor_address_u','$doctor_phone_u','$user_id')");
	}	
}


if (isset($_POST['email_check'])) {
	$email_check = str_replace(' ', '', $email_check);
	$user_result_check = mysqli_num_rows(mysqli_query($db, "SELECT * FROM user WHERE username='$email_check' AND id<>'$user_id_check'"));
	if ($user_result_check >= 1) {
		echo "no";
	}else {
		echo $email_check;
	}

}
?>
























