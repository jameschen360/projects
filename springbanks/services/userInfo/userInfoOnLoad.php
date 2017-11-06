<?php
    include("../../inc/db.php");
    session_start();
    $clientUser_id = mysqli_real_escape_string($db,$_POST['user_id']);
    $sessionUser_id = $_SESSION['login_user'];

    ////////load user info onload page content
    if ($clientUser_id == $sessionUser_id) {
        $checkExist = "SELECT * FROM user_table WHERE id='$clientUser_id'";
        $queryCheckExist = mysqli_query($db, $checkExist);
        $resultCheckExist = mysqli_fetch_assoc($queryCheckExist);
        
        echo json_encode(array(
            'userInfo' => $resultCheckExist
        ));
    }
?>