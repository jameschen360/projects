<?php
include('../inc/db.php');
//grab all post variables
$option = mysqli_real_escape_string($db,strip_tags($_GET['option']));
$weight = mysqli_real_escape_string($db,strip_tags($_GET['weight']));
$currency = mysqli_real_escape_string($db,strip_tags($_GET['currency']));
$user = mysqli_real_escape_string($db,strip_tags($_GET['user']));
if (!empty($_GET['option'])) {
	
	$shipping_sql = mysqli_query($db,"SELECT * FROM shipping WHERE weight='$weight'");
	$shipping_row = mysqli_num_rows($shipping_sql);
	
	$currency_sql = mysqli_query($db,"SELECT * FROM currency_rate WHERE country ='$currency'");
	$currency_factor = mysqli_fetch_assoc($currency_sql);
	$currency_factor = $currency_factor['currency'];
	if ($shipping_row == 0) {
		echo 100;
	} else {
		
		$shipping_result = mysqli_fetch_assoc($shipping_sql);
		$shipping_cost = $shipping_result["$option"];
		
		if (empty($user)) {
			$insert_sql = mysqli_query($db,"INSERT INTO ship_coup (shipping,user) VALUES ('$shipping_cost','$user') ");			
		}else {
			$update_sql = mysqli_query($db,"UPDATE ship_coup SET shipping='$shipping_cost' WHERE user='$user'");
		}	
		echo $shipping_cost*$currency_factor;
	}
}

?>