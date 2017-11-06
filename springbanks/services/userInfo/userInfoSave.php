<?php
    include("../../inc/db.php");
    session_start();
    $clientUser_id = mysqli_real_escape_string($db,$_POST['user_id']);
    $addressSave = mysqli_real_escape_string($db,$_POST['addressSave']);
    $postalSave = mysqli_real_escape_string($db,$_POST['postalSave']);
    $phoneSave = mysqli_real_escape_string($db,$_POST['phoneSave']);
    $sessionUser_id = $_SESSION['login_user'];

    ////////load user info onload page content
    if ($clientUser_id == $sessionUser_id) {
        $checkExist = "UPDATE user_table SET address='$addressSave', pcode='$postalSave', phone='$phoneSave' WHERE id='$clientUser_id'";
        if (mysqli_query($db, $checkExist)) {
            echo "success";
        } else {
            echo "error";
        }
    }
?>