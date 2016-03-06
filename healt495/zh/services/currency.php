<?php
include('../inc/db.php');
//grab all post variables
$currency = mysqli_real_escape_string($db,strip_tags($_GET['currency']));
$user = mysqli_real_escape_string($db,strip_tags($_GET['user']));
$ip = mysqli_real_escape_string($db,strip_tags($_GET['ip']));

if (!empty($_GET['currency'])) {
	
	if (empty($user)){
		$sql = mysqli_query($db,"UPDATE ip SET currency='$currency' WHERE ip='$ip'");
	} else {
		$sql = mysqli_query($db,"UPDATE customer SET currency='$currency' WHERE email='$user'");
	}
		//$sql = mysqli_query($db,"UPDATE customer WHERE country='$currency'");
		//$sql = mysqli_fetch_assoc($sql);
			//$sql = $sql['currency'];
		echo "$currency $user $ip";
	
	
}

?>