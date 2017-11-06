<?php
include('../../inc/db.php');
session_start();
$clientUser_id = mysqli_real_escape_string($db,$_POST['admin_id']);
$order_id = mysqli_real_escape_string($db,$_POST['order_id']);
$processing = mysqli_real_escape_string($db,$_POST['processing']);
$delivered = mysqli_real_escape_string($db,$_POST['delivered']);
$sessionUser_id = $_SESSION['admin_user'];

if ($clientUser_id == $sessionUser_id) {
    if (isset($_POST['processing']) and !isset($_POST['delivered'])) {
        $getCartStringOrder = "SELECT * FROM cart_table WHERE order_id='$order_id'";
        $getCartQueryOrder = mysqli_query($db, $getCartStringOrder);
    } else if (!isset($_POST['processing']) and isset($_POST['delivered'])) {
        $getCartStringOrder = "SELECT * FROM archived_cart_table WHERE order_id='$order_id'";
        $getCartQueryOrder = mysqli_query($db, $getCartStringOrder);
    }

    $getOrderStringOrder = "SELECT * FROM order_table WHERE id='$order_id'";
    $getOrderResultOrder = mysqli_fetch_assoc(mysqli_query($db, $getOrderStringOrder));
    $userID = $getOrderResultOrder['user_id'];

    $cartData = [];

    while ($row = $getCartQueryOrder->fetch_array()){
        $cartData[] = $row;
        $tempProductName = $row['item_id'];
        $isCustom = $row['isCustom'];
        if ($isCustom) {
            $queryProduct[] = $tempProductName;
        } else {
            $queryProductString = "SELECT * FROM product_table WHERE id='$tempProductName'";
            $queryProductResult = mysqli_fetch_assoc(mysqli_query($db, $queryProductString));
            $queryProduct[] = $queryProductResult;
        }
    }

    $getCartQueryOrder->close();

    $getUserStringOrder = "SELECT * FROM user_table WHERE id='$userID'";
    $getUserResultOrder = mysqli_fetch_assoc(mysqli_query($db, $getUserStringOrder));
    
    echo json_encode(array(
        'cartData' => $cartData,
        'product' => $queryProduct,
        'userInfo' => $getUserResultOrder,
        'orderInfo' => $getOrderResultOrder
    ));
    
}


?>