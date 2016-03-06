<?php
include('../inc/db.php');
//grab all post variables
$user = mysqli_real_escape_string($db,strip_tags($_GET['user']));
$product = mysqli_real_escape_string($db,strip_tags($_GET['product']));
$bname = mysqli_real_escape_string($db,strip_tags($_GET['bname']));
$sname = mysqli_real_escape_string($db,strip_tags($_GET['sname']));
$bemail = mysqli_real_escape_string($db,strip_tags($_GET['bemail']));
$semail = mysqli_real_escape_string($db,strip_tags($_GET['semail']));
$shipping_cost = mysqli_real_escape_string($db,strip_tags($_GET['shipping_cost']));
$baddress = mysqli_real_escape_string($db,strip_tags($_GET['baddress']));
$saddress = mysqli_real_escape_string($db,strip_tags($_GET['saddress']));
$comment = mysqli_real_escape_string($db,strip_tags($_GET['comment']));
$btel = mysqli_real_escape_string($db,strip_tags($_GET['btel']));
$stel = mysqli_real_escape_string($db,strip_tags($_GET['stel']));
$subtotal = mysqli_real_escape_string($db,strip_tags($_GET['subtotal']));
$total = mysqli_real_escape_string($db,strip_tags($_GET['total']));
$currency_rate = mysqli_real_escape_string($db,strip_tags($_GET['currency_rate']));
$is_same_shipping = mysqli_real_escape_string($db,strip_tags($_GET['is_same_shipping']));
$currency_code = mysqli_real_escape_string($db,strip_tags($_GET['currency_code']));
$coupon = mysqli_real_escape_string($db,strip_tags($_GET['coupon']));
$invoice = mysqli_real_escape_string($db,strip_tags($_GET['invoice']));
$amount = mysqli_real_escape_string($db,strip_tags($_GET['amount']));
$today = date("Y-m-d H:i:s");
$exp_date = date('Y-m-d',strtotime(date("Y-m-d", mktime()) . " + 20 day"));


if (!empty($_GET['user'])) {
	
	$order_sql = mysqli_query($db,"INSERT INTO order_id (user,product,bname,sname,bemail,semail,shipping_price,coupon,baddress,saddress,comment,btel,stel,subtotal,total,currency_code,is_same_shipping,date_created,status,currency_rate,invoice,exp_date,amount) VALUES ('$user','$product','$bname','$sname','$bemail','$semail','$shipping_cost','$coupon','$baddress','$saddress','$comment','$btel','$stel','$subtotal','$total','$currency_code','$is_same_shipping','$today','Pending','$currency_rate','$invoice','$exp_date','$amount')");

	if($order_sql){
		echo "good";
	}else {
		echo "bad";
	}
	
}

?>