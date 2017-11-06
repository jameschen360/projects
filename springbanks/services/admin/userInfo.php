<?php
    include("../../inc/db.php");
    session_start();
    $clientUser_id = mysqli_real_escape_string($db,$_POST['admin_id']);
    $userID = mysqli_real_escape_string($db,$_POST['user_id']);
    $sessionUser_id = $_SESSION['admin_user'];

    if ($clientUser_id == $sessionUser_id) {
        $userInfoQuery = mysqli_query($db, "SELECT * FROM user_table WHERE id='$userID'");
        $userDataDetails = [];
        while ($row = $userInfoQuery->fetch_array()) {
            $userDataDetails[] = $row;
        }

        echo json_encode(array(
            'userDetail' => $userDataDetails
        ));
        
        $userInfoQuery->close();

    }    


