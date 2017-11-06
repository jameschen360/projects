<?php
    include("../inc/db.php");
    session_start();
    $clientUser_id = mysqli_real_escape_string($db,$_POST['user_id']);
    $sessionUser_id = $_SESSION['login_user'];

    if ($clientUser_id == $sessionUser_id) {
        $nameQuery = "SELECT * FROM user_table WHERE id='$clientUser_id'";
        $queryName = mysqli_query($db, $nameQuery);
        $resultname = mysqli_fetch_assoc($queryName);

        $userFirstName = $resultname['fname'];

        echo $userFirstName;

    }





?>