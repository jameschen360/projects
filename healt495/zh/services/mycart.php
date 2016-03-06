<?php
header("Content-Type: text/html");
include('../inc/db.php');
//grab all post variables

$product_id = mysqli_real_escape_string($db,strip_tags($_GET['product_user']));

$string = explode("_",$product_id);

$user_id = $string[2];

$product_id = $string[1];
//

$color_bad = "#FE2E2E";
$color_good = "#33cc33";


if (isset($product_id)) {
if (!empty($product_id)) {
	
				$delete_sql = mysqli_query($db,"DELETE FROM cart WHERE product_id = '$product_id' AND user = '$user_id'");
				$check = mysqli_query($db,"SELECT * FROM cart WHERE user='$user_id'");
				$check_row = mysqli_num_rows($check);
				if ($check_row == 0) {
					echo "remove";
				}
				
	
	} else {
		echo "<p style=\"color:$color_bad;\" >error</p>";
	}
	
}?>