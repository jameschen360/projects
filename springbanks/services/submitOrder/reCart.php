<?php
    include("../../inc/db.php");
    session_start();
    $clientUser_id = mysqli_real_escape_string($db,$_POST['user_id']);
    $sessionUser_id = $_SESSION['login_user'];

    if ($clientUser_id == $sessionUser_id) {
        $getCartString = "SELECT * FROM order_table WHERE user_id='$clientUser_id' AND status='New'";
        $getCartQuery = mysqli_query($db, $getCartString);
        $getCartResult = mysqli_fetch_assoc($getCartQuery);
        $orderID = $getCartResult['id'];

        $queryStringCart = "SELECT * FROM cart_table WHERE order_id='$orderID' ORDER BY id ASC";
        $queryCart = mysqli_query($db, $queryStringCart);
        $queryCartNum = mysqli_num_rows($queryCart);
        if ($queryCartNum > 0) {
            $queryProduct = [];
            $data = [];
            $productUnit = [];
            while ($row = $queryCart->fetch_array()) {
                $data[] = $row;
                $tempProductName = $row['item_id'];
                $isCustom = $row['isCustom'];
                if ($isCustom) {
                    $queryProduct[] = $tempProductName;
                } else {
                    $queryProductString = "SELECT * FROM product_table WHERE id='$tempProductName'";
                    $queryProductResult = mysqli_fetch_assoc(mysqli_query($db, $queryProductString));
                    $queryProduct[] = $queryProductResult['product_name'];
                    $productUnit[] = $queryProductResult['unit'];
                }
            }

            $userInfo = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM user_table WHERE id='$clientUser_id'"));
            echo json_encode(array(
                'cartData' => $data,
                'product' => $queryProduct,
                'userInfo' => $userInfo,
                'orderInfo' => $getCartResult,
                'productUnit' => $productUnit
            ));

            $queryCart->close();

        } else {
            echo "error";
        }
        

    }


?>