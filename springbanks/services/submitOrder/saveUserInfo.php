<?php
    include("../../inc/db.php");
    session_start();
    $clientUser_id = mysqli_real_escape_string($db,$_POST['user_id']);
    $address = mysqli_real_escape_string($db,$_POST['address']);
    $postal = mysqli_real_escape_string($db,$_POST['postal']);
    $phone = mysqli_real_escape_string($db,$_POST['phone']);
    $sessionUser_id = $_SESSION['login_user'];

    if ($clientUser_id == $sessionUser_id) {
        if(mysqli_query($db, "UPDATE user_table SET address='$address', pcode='$postal', phone='$phone' WHERE id='$clientUser_id'")) {
            echo "proceed";
        } else {
            echo "error";
        }
    }


?>