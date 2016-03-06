<?php
include('../inc/db.php');

//grab all post variables
$output = mysqli_real_escape_string($db,strip_tags($_GET['msg']));
$user_email = mysqli_real_escape_string($db,strip_tags($_GET['user']));
$today = date("Y-m-d H:i:s"); 


$coupon = mysqli_query($db,"SELECT * FROM coupon WHERE code = '$output' AND expire >= '$today'");
$coupon_row = mysqli_num_rows($coupon);
$coupon_result = mysqli_fetch_assoc($coupon);
$discount = $coupon_result['discount'];
$delete_sql = mysqli_query($db,"DELETE FROM ship_coup WHERE user='$user_email'");
if (isset($_GET['msg'])) {
if ($coupon_row != 0) {
	
	$check = mysqli_query($db,"SELECT * FROM ship_coup WHERE user='$user_email'");
	$check_row = mysqli_num_rows($check);
	if ($check_row == 0 ) {
		$insert_ship_coup = mysqli_query($db,"INSERT INTO ship_coup (coupon,user) VALUES ('$output','$user_email')");
		echo "$discount";		
	} else {
		$insert_ship_coup = mysqli_query($db,"INSERT INTO ship_coup (coupon,user) VALUES ('$output','$user_email')");
		echo "$discount";		
	}

	}else {
		echo "invalid";
	}
}?>