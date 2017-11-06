<?php
    include("../inc/db.php");
    session_start();

    $clientUser_id = mysqli_real_escape_string($db,$_POST['user_id']);
    $sessionUser_id = $_SESSION['login_user'];

    if ($clientUser_id == $sessionUser_id) {
        $query = "SELECT * FROM order_table WHERE user_id='$clientUser_id' AND status='New'";
        if ($sqlReturnQuery = mysqli_query($db, $query)) {
            $sqlReturnResult = mysqli_fetch_assoc($sqlReturnQuery);
            $orderID = $sqlReturnResult['id'];

            //delete from cart_table and other dbs
            mysqli_query($db, "DELETE FROM cart_table WHERE order_id='$orderID'");
            mysqli_query($db, "DELETE FROM order_table WHERE id='$orderID'");
            mysqli_query($db, "DELETE FROM last_filter_position WHERE user_id='$clientUser_id'");
        }else {
            echo "error";
        }

    }


?>