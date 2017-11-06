<?php
include("../inc/db.php");

$accounting_id = mysqli_real_escape_string($db, $_POST['id']);

if (isset($accounting_id)) {
	$check = mysqli_query($db, "SELECT * FROM accounting_code WHERE id='$accounting_id'");
	$check_array = mysqli_fetch_assoc($check);
	$code = $check_array['code'];
	$desc = $check_array['description'];
	echo $code.'_'.$desc;
	
}
?>