<?php
include('../inc/db.php');
//grab all post variables
$code = mysqli_real_escape_string($db,strip_tags($_GET['code']));
$discount = mysqli_real_escape_string($db,strip_tags($_GET['discount']));
$date = mysqli_real_escape_string($db,strip_tags($_GET['date']));

$date = explode('/',$date);
$date = "$date[2]-$date[0]-$date[1]";
$today = date("Y-m-d");
$newdate = date('Y-m-d', strtotime($date));
if ($date >= $today) {
    if ($discount > 0 and $discount < 1) {
        if (!empty($code)) {
            mysqli_query($db, "INSERT INTO coupon (code,discount,expire) VALUES ('$code','$discount','$newdate')");
            echo "success";            
        }else {
            echo "Coupon code empty!";
        }

        
    }else {
        echo "Discount between 0 and 1";
    }
}else {
    echo "Pick a day in the future!";
}

?>