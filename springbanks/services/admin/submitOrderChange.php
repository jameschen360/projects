<?php
    include("../../inc/db.php");
    date_default_timezone_set('America/Denver');
    session_start();
    $clientUser_id = mysqli_real_escape_string($db,$_POST['admin_id']);
    $totalFinal = mysqli_real_escape_string($db,$_POST['totalFinal']);
    $orderID = mysqli_real_escape_string($db,$_POST['orderID']);
    $sessionUser_id = $_SESSION['admin_user'];
    $serverCurrentTime = date('m/d/Y h:i:s a', time());

    if ($clientUser_id == $sessionUser_id) {
        mysqli_query($db, "UPDATE order_table SET deliveredTime='$serverCurrentTime', totalAmount='$totalFinal', status='Delivered' WHERE id='$orderID'");

        $moveToArchiveString = "SELECT * FROM cart_table WHERE order_id='$orderID'";
        $moveToArchiveQuery = mysqli_query($db, $moveToArchiveString);
        $dataTest = [];
        while ($row = $moveToArchiveQuery->fetch_array()) {
            $id = $row['id'];
            $order_id = $row['order_id'];
            $item_id = $row['item_id'];
            $amount = $row['amount'];
            $description = $row['description'];
            $isCustom = $row['isCustom'];
            $isCustomUnit = $row['isCustomUnit'];

            $dataTest[] = $row;

            $archiveString = mysqli_query($db, "INSERT INTO archived_cart_table (id, order_id, item_id, amount, description, isCustom, isCustomUnit) VALUES('$id','$order_id','$item_id','$amount','$description','$isCustom','$isCustomUnit')");
        }

        
        $auto_email_result = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM automsg_email"));
        $auto_email = $auto_email_result['email'];
        $auto_pwd = $auto_email_result['pwd'];
        $logo = $auto_email_result['logo'];

        $userOrderResult = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM order_table WHERE id='$orderID'"));
        $userID = $userOrderResult['user_id'];
        
        $userEmailResult = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM user_table WHERE id='$userID'"));
        $userEmail = $userEmailResult['email'];
        $userFname = $userEmailResult['fname'];

        $serverCurrentTimeFull = date('m/d/Y h:i:s a', time());
        require_once("../../mail/class.phpmailer.php");//obtain mailer classes
        require_once("../../mail/email/orderDelivered.php");

        echo json_encode(array(
            'orderInfo' => $userOrderResult
        ));

        mysqli_query($db, "DELETE FROM cart_table WHERE order_id='$orderID'");
        $moveToArchiveQuery->close();

    } 


