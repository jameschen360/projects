<?php
    include("../../inc/db.php");
    session_start();
    $clientUser_id = mysqli_real_escape_string($db,$_POST['admin_id']);
    $cartID = mysqli_real_escape_string($db,$_POST['cartID']);
    $amount = mysqli_real_escape_string($db,$_POST['amount']);
    $sessionUser_id = $_SESSION['admin_user'];

    $isRealCartCheckQueryString = "SELECT order_id FROM cart_table WHERE id='$cartID'";
    $queryCart =  mysqli_query($db, $isRealCartCheckQueryString);
    $resultCart = mysqli_fetch_assoc($queryCart);
    $orderID = $resultCart['order_id'];
    $isRealOrderCheckQueryString = "SELECT id FROM order_table WHERE id='$orderID' AND status='Processing'";
    $queryOrder =  mysqli_query($db, $isRealOrderCheckQueryString);
    $queryNumberOrder = mysqli_num_rows($queryOrder);
    
    ///delete product
    if ($clientUser_id == $sessionUser_id and isset($_POST['remove'])) {
        if ($queryNumberOrder == 1) {
            $cartItemNum = mysqli_num_rows(mysqli_query($db, "SELECT * FROM cart_table WHERE order_id='$orderID'"));

            if ($cartItemNum == 1) {
                echo "notAllowed";
            } else {
                mysqli_query($db, "DELETE FROM cart_table WHERE id='$cartID'");
                $isRealCartCheckQueryString = "SELECT id FROM cart_table WHERE order_id='$orderID'";
                $queryCartNum =  mysqli_num_rows(mysqli_query($db, $isRealCartCheckQueryString));
                echo $queryCartNum;
            }
        } else {
            echo "error";

        }
    }

    ///edit amount
    if ($clientUser_id == $sessionUser_id and isset($_POST['edit'])) {
        if ($queryNumberOrder == 1 and $amount >= 1) {
            mysqli_query($db, "UPDATE cart_table SET amount='$amount' WHERE id='$cartID'");
        } else {
            echo "error";

        }
    }    


