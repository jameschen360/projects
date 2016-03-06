<?include("../inc/connect.php");?>
<?

	$date = date("Y-m-d H:i:s");
?>
<?php
if (isset($_POST['code'])) {
$code = strip_tags($_POST['code']);
$bill = round(strip_tags($_POST['amount']),2);
$name = strip_tags($_POST['name']);
$gift_code= mysql_query("SELECT * FROM giftcert WHERE gift_code='$code'");

if (mysql_num_rows($gift_code) != 0) {
		$case = "exist";
		while($row = mysql_fetch_array($gift_code)){ 
		$code_db = $row["gift_code"];
		$amount = $row["mc_gross"];
        }
} else {
		$case = "non";
}
if ($bill==""){
	$bill="0.00";
}

$new_balance = round($amount - $bill,2);

if ($new_balance < 0){
	$amount_owe = round(abs($new_balance),2);
	$new_balance = 0;
} else {
	$amount_owe = "0.00";
}

mysql_query("UPDATE giftcert SET mc_gross='$new_balance' WHERE gift_code='$code'");


if ($bill > 0){
	$insert = "INSERT INTO transaction (gift_code,amount,action_by,date)
VALUES ('$code','$bill','$name','$date' )";
	mysql_query($insert);
} else {
	//nothing
}



if ($code!="" and $case == "exist") {
	echo "<center><p class=\"alert alert-success\" >Previous Balance: $$amount<br>Bill Total: $$bill<br>Current Balance: $$new_balance<br><b style=\"font-size:30px\">Amount Owing: $$amount_owe</b><br><i style=\"font-size:17px\">Amount was successfully deducted from their account!</p></center>";

	} else {
		echo "<center><p class=\"alert alert-warning\" >Invalid Gift Code Entered</p></center>";
	}
}?>