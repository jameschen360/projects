<?php
include("../inc/db.php");

$status = $_GET['status'];
$id = $_GET['id'];

$check = mysqli_query($db, "UPDATE order_id SET status='$status' WHERE invoice='$id'");

if ($check) {
   echo "<p style=\"color:green;\">Ship Marked</p>"; 
}
?>