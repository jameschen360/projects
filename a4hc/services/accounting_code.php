<?php
include("../inc/db.php");
date_default_timezone_set('America/Denver');
$description = mysqli_real_escape_string($db, $_POST['description']);
$accounting_code = mysqli_real_escape_string($db, $_POST['accounting_code']);

$username_id = mysqli_real_escape_string($db, $_POST['username']);
$update_code = mysqli_real_escape_string($db, $_POST['code']);
$update_desc = mysqli_real_escape_string($db, $_POST['desc']);
$update_id = mysqli_real_escape_string($db, $_POST['id']);

$check_id = mysqli_real_escape_string($db, $_POST['check_id']);
$check_code = mysqli_real_escape_string($db, $_POST['check_code']);

$delete_id = mysqli_real_escape_string($db, $_POST['delete_id']);


$date_sql = date("Y-m-d H:i:s");//sql format


if (isset($_POST['accounting_code']) and isset($_POST['username'])) {
	mysqli_query($db, "INSERT INTO accounting_code (code,description,created_on,modified_on,by_whom) VALUES('$accounting_code','$description','$date_sql','$date_sql','$username_id')");
	
}

if (isset($_POST['id']) and isset($_POST['username'])) {
	mysqli_query($db, "UPDATE accounting_code SET code='$update_code', description='$update_desc', modified_on='$date_sql', by_whom='$username_id' WHERE id='$update_id'");
}

if (isset($_POST['check_id'])) {
	$result = mysqli_num_rows(mysqli_query($db, "SELECT * FROM accounting_code WHERE id<>'$check_id' AND code='$check_code'"));
	if ($result >= 1) {
		echo "dups";
	}else {
		echo "okay";
	}
}

if (isset($_POST['delete_id'])) {
	$result = mysqli_num_rows(mysqli_query($db, "DELETE FROM accounting_code WHERE id='$delete_id'"));
}
?>