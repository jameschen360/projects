<?php
    include("../inc/db.php");
    session_start();
    $clientUser_id = mysqli_real_escape_string($db,$_POST['user_id']);
    $sessionUser_id = $_SESSION['login_user'];

    //initial check for existing cart

    if ($clientUser_id == $sessionUser_id) {

        $checkExist = "SELECT * FROM order_table WHERE user_id='$clientUser_id' AND status<>'New' ORDER BY id DESC";

        $queryCheckExist = mysqli_query($db, $checkExist);

        $data = [];
        $ordered_time = [];
        $date = [];
        while ($row = $queryCheckExist->fetch_array()) {
            $data[] = $row;
            $time[] = $row['order_time'];
            $ordered_time[] = strtotime($row['order_time']);
            $date[] = date("M/d Y h:i a", strtotime($row['order_time']));
        }

        echo json_encode(array(
            'cart_table' => $data,
            'date' => $date
        ));
        
        $queryCheckExist->close();
    }
?>