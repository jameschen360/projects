<?php
include("../inc/db.php");
date_default_timezone_set('America/Denver');

$emailing_auto_name = mysqli_real_escape_string($db, $_POST['emailing_auto_name']);
$password_emailing = mysqli_real_escape_string($db, $_POST['password_emailing']);
$close_instruction = mysqli_real_escape_string($db, $_POST['close']);

if (isset($_POST['emailing_auto_name'])) {
	mysqli_query($db, "UPDATE automsg_email SET email='$emailing_auto_name', pwd='$password_emailing' WHERE id='1'");
}


if (isset($_POST['close'])) {//grab sql data of user info and store to json for js to decode upon closing remodal.
	$user_result = mysqli_query($db, "SELECT * FROM automsg_email");
	$data = [];
	$i=0;
	while ($row = $user_result->fetch_array()) {
		$data[] = $row;	
	}
	echo json_encode($data);
	$user_result->close();
}

?>
























