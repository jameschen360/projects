<?include("../inc/connect.php");?>
<?php
if (isset($_POST['code'])) {
$code = strip_tags($_POST['code']);

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

if ($code!="" and $case == "exist") {
	echo "<br><center><p>Your Balance is: \$$amount";
		echo "<br/><p><img alt=\"$code_db\" src=\"services/barcode.php?codetype=Code128&size=80&text=$code_db\" width=\"50%\" height=\"100px\"/></p>";
			echo "</p></center>";
	} else {
		echo "<center><p class=\"alert alert-danger\" >Invalid Gift Code Entered</p></center>";
	}
}?>