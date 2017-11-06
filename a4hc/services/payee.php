<?php
include("../inc/db.php");
date_default_timezone_set('America/Denver');

$payee_id = mysqli_real_escape_string($db, $_POST['payee_id']);
$payee_name = mysqli_real_escape_string($db, $_POST['payee_name']);
$payee_address = mysqli_real_escape_string($db, $_POST['payee_address']);
$payee_city = mysqli_real_escape_string($db, $_POST['payee_city']);
$payee_prov = mysqli_real_escape_string($db, $_POST['payee_prov']);
$payee_zip = mysqli_real_escape_string($db, $_POST['payee_zip']);
$payee_info = mysqli_real_escape_string($db, $_POST['payee_info']);
$payee_email = mysqli_real_escape_string($db, $_POST['payee_email']);
$payee_phone = mysqli_real_escape_string($db, $_POST['payee_phone']);

$username_id = mysqli_real_escape_string($db, $_POST['user_id']);

$delete_id = mysqli_real_escape_string($db, $_POST['delete_id']);

$payee_name_edit = mysqli_real_escape_string($db, $_POST['payee_name_edit']);
$payee_address_edit = mysqli_real_escape_string($db, $_POST['payee_address_edit']);
$payee_city_edit = mysqli_real_escape_string($db, $_POST['payee_city_edit']);
$payee_prov_edit = mysqli_real_escape_string($db, $_POST['payee_prov_edit']);
$payee_zip_edit = mysqli_real_escape_string($db, $_POST['payee_zip_edit']);
$payee_info_edit = mysqli_real_escape_string($db, $_POST['payee_info_edit']);
$payee_email_edit = mysqli_real_escape_string($db, $_POST['payee_email_edit']);
$payee_phone_edit = mysqli_real_escape_string($db, $_POST['payee_phone_edit']);


$close_id = mysqli_real_escape_string($db, $_POST['close_id']);


$date_sql = date("Y-m-d H:i:s");//sql format


if (isset($_POST['payee_name']) and isset($_POST['user_id'])) {
	mysqli_query($db, "INSERT INTO payee (name,address,city,province,postal,info,created_on,modified_on,by_whom,phone,email) VALUES('$payee_name','$payee_address','$payee_city','$payee_prov','$payee_zip','$payee_info','$date_sql','$date_sql','$username_id','$payee_phone','$payee_email')");
	
}

if (isset($_POST['payee_name_edit']) and isset($_POST['user_id'])) {
	$check = mysqli_query($db, "UPDATE payee SET name='$payee_name_edit', address='$payee_address_edit', city='$payee_city_edit', province='$payee_prov_edit', postal='$payee_zip_edit', info='$payee_info_edit', modified_on='$date_sql', by_whom='$username_id', email='$payee_email_edit', phone='$payee_phone_edit' WHERE id='$payee_id'");
	if ($check) {
		echo  "okay";
	}else {
		echo "no";
	}
}

if (isset($_POST['close_id'])) {//grab sql data of payee info and store to json for js to decode upon closing remodal.
	$payee_result = mysqli_query($db, "SELECT * FROM payee WHERE id='$close_id'");
	$data = [];
	$i=0;
	while ($row = $payee_result->fetch_array()) {
		$data[] = $row;	
	}
	echo json_encode($data);
	$payee_result->close();
}

if (isset($_POST['delete_id'])) {
	$result = mysqli_num_rows(mysqli_query($db, "DELETE FROM payee WHERE id='$delete_id'"));
}
?>