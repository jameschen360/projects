<?php
    include("../../inc/db.php");
    session_start();
    $clientUser_id = mysqli_real_escape_string($db,$_POST['user_id']);
    $currentPassword = md5(mysqli_real_escape_string($db,$_POST['currentPassword']));
    $password1 = mysqli_real_escape_string($db,$_POST['password1']);
    $password2 = mysqli_real_escape_string($db,$_POST['password2']);
    $sessionUser_id = $_SESSION['login_user'];

    $md5Password = md5($password2);

    if ($clientUser_id == $sessionUser_id) {
        $isCorrectPassword = mysqli_num_rows(mysqli_query($db, "SELECT id FROM user_table WHERE id='$clientUser_id' AND pwd='$currentPassword'"));
        if ($isCorrectPassword == 1) {
            if ($password1 == $password2) {
                if (strlen($password1) >= 9) {
                    mysqli_query($db, "UPDATE user_table SET pwd='$md5Password' WHERE id='$clientUser_id'");
                    echo "updated";
                } else {
                    echo "tooShort"; 
                }
            } else {
                echo "notMatching";
            }
        } else {
            echo "invalidCurrentPassword";
        }

    }
?>