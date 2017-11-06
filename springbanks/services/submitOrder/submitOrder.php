<?php
    include("../../inc/db.php");
    date_default_timezone_set('America/Denver');
    session_start();
    $clientUser_id = mysqli_real_escape_string($db,$_POST['user_id']);
    $sessionUser_id = $_SESSION['login_user'];

    $serverCurrentTime = date('H:i:s', time());
    $serverCurrentTimeFull = date('m/d/Y h:i:s a', time());
    $cartComparisonTime = date('H:i:s', 82800); //4pm time or 1600hr

    if ($serverCurrentTime > $cartComparisonTime) {
        //add 2 hours editing limit
        $endEditTime = date('H:i:s', time()+7200);
        $timeEmailEnd = date('m/d/Y h:i:s a', time()+7200);
    } else {
        if (date('H:i:s', time()+7200) > $cartComparisonTime) {
            $endEditTime = $cartComparisonTime;
            $timeEmailEnd = date('m/d/Y h:i:s a', 82800);
        } else {
            $endEditTime = date('H:i:s', time()+7200);
            $timeEmailEnd = date('m/d/Y h:i:s a', time()+7200);
        }
    }
    if ($clientUser_id == $sessionUser_id) {
        $submitOrderString = "SELECT * FROM order_table WHERE user_id='$clientUser_id' AND status='New'";
        $submitOrderQuery = mysqli_query($db, $submitOrderString);
        $orderIDResult = mysqli_fetch_assoc($submitOrderQuery);
        $orderID = $orderIDResult['id'];
        $queryNumCheck = mysqli_num_rows($submitOrderQuery);
        if ($queryNumCheck == 1) {
            $updateStringCartStatus = "UPDATE order_table SET order_time='$serverCurrentTimeFull', canEditEndDate='$endEditTime', status='Processing' WHERE id='$orderID' AND user_id='$clientUser_id'";
            if (mysqli_query($db, $updateStringCartStatus)) {
                echo "success";
                //send email to user and admin
                $auto_email_result = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM automsg_email"));
                $auto_email = $auto_email_result['email'];
                $auto_pwd = $auto_email_result['pwd'];
                $logo = $auto_email_result['logo'];

                $userEmailResult = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM user_table WHERE id='$clientUser_id'"));
                $userEmail = $userEmailResult['email'];
                $userFname = $userEmailResult['fname'];
                $address = $userEmailResult['address'];
                $postal = $userEmailResult['pcode'];
                $phone = $userEmailResult['phone'];
                require_once("../../mail/class.phpmailer.php");//obtain mailer classes
                require_once("../../mail/email/orderSubmitUserEmail.php");//send to user
                require_once("../../mail/email/orderSubmitAgentEmail.php");//send for springbank agent
            } else {
                echo "error";
            }

        } else {
            echo "error";
        }

    } else {
        echo "error";
    }
?>