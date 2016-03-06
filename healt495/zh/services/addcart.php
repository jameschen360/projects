<?php
include('../inc/db.php');
//grab all post variables
$quanitity = mysqli_real_escape_string($db,strip_tags($_POST['quanitity']));
$product_id = strip_tags($_POST['product_id']);
$user_id = strip_tags($_POST['user_id']);
//

$product_amount = mysqli_query($db,"SELECT * FROM product WHERE id = '$product_id'");
$product_result = mysqli_fetch_assoc($product_amount);
$product_stock = $product_result['instock'];
	
$color_bad = "#FE2E2E";
$color_good = "#33cc33";

$check = mysqli_query($db,"SELECT * FROM cart WHERE user = '$user_id' AND product_id = '$product_id'");
$check_row = mysqli_num_rows($check);
if (isset($_POST['quanitity'])) {
if ($check_row == 0) {
if (!empty($quanitity)) {
	if (is_numeric($quanitity)) {
		if ($quanitity <= $product_stock) {
			$insert_sql = mysqli_query($db,"INSERT INTO cart (product_id,amount,user) VALUES ('$product_id','$quanitity','$user_id')");			
			echo "<p class=\"pull-right\" style=\"color:$color_good;\" >产品以加进购物车里！</p>";
		}else {
			echo "<p class=\"pull-right\" style=\"color:$color_bad;\" >对不起，我们目前没有这么多货！</p>";
		}	
	}else {
		echo "<p class=\"pull-right\" style=\"color:$color_bad;\" >请输入数量。</p>";
	}
	} else {
		echo "<p class=\"pull-right\" style=\"color:$color_bad;\" >请输入数量。</p>";
	}
	}else {
		echo "<p class=\"pull-right\" style=\"color:$color_bad;\" >您的购物车已拥有这个产品。</p>";
	}
}?>