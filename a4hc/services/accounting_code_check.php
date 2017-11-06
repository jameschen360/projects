<?php
include("../inc/db.php");

$accounting_code = mysqli_real_escape_string($db, $_POST['code_check']);


if (isset($accounting_code)) {
	$check = mysqli_query($db, "SELECT * FROM accounting_code WHERE code='$accounting_code'");
	if (mysqli_num_rows($check) >= 1 or strlen ($accounting_code)<4) {
		echo "taken";
	}else {
		echo "okay";
	}
}
?>