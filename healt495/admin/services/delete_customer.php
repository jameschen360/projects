<?php
include("../inc/db.php");

$user_id = $_GET['id'];

$user_email = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM customer WHERE id='$user_id'"));
$user_email = $user_email['email'];

$check1 = mysqli_query($db, "DELETE FROM cart WHERE user='$user_email'");
$check2 = mysqli_query($db, "DELETE FROM ship_coup WHERE user='$user_email'");
$check3 = mysqli_query($db, "DELETE FROM customer WHERE email='$user_email'");
if ($check2 and $check1 and $check3) {
    echo "success";
}
?>