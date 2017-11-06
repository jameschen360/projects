<?php
    include("../../inc/db.php");
    session_start();
    $clientUser_id = mysqli_real_escape_string($db,$_POST['user_id']);
    $productID = mysqli_real_escape_string($db,$_POST['product_id']);
    $productAmount = mysqli_real_escape_string($db,$_POST['product_amount']);
    $productDescription = mysqli_real_escape_string($db,$_POST['product_description']);
    $sessionUser_id = $_SESSION['login_user'];

    $isRealProductCheckQueryString = "SELECT * FROM product_table WHERE id='$productID'";
    $queryProduct =  mysqli_query($db, $isRealProductCheckQueryString);
    $resultProduct = mysqli_fetch_assoc($queryProduct);
    $resultNumberCheck = mysqli_num_rows($queryProduct);
    $productUnit = $resultProduct['unit'];

    $unitTableString = "SELECT * FROM unit_table ORDER BY unit ASC";
    $unitTableQuery =  mysqli_query($db, $unitTableString);
    $unitData = [];
    while ($row = $unitTableQuery->fetch_array()) {
        $unitData[] = $row;
    }

    ///for db products
    if ($clientUser_id == $sessionUser_id and $resultNumberCheck == 1) {
        $queryString = "SELECT id FROM order_table WHERE user_id='$clientUser_id' AND status='New'";
        $query = mysqli_query($db, $queryString);
        $orderIDResult = mysqli_fetch_assoc($query);
        $orderID = $orderIDResult['id'];

        //insert into shopping list cart. By default isCustom field is set to 0 or boolean false.
        $insertToCartQueryString = "INSERT INTO cart_table (order_id, item_id, amount, description, isCustomUnit) VALUES ('$orderID','$productID','$productAmount','$productDescription','$productUnit')";
        if (mysqli_query($db, $insertToCartQueryString)) {
            $lastID = mysqli_insert_id($db);
            $queryStringCart = "SELECT * FROM cart_table WHERE order_id='$orderID' ORDER BY id ASC";
            $queryCart = mysqli_query($db, $queryStringCart);
            $queryCartNum = mysqli_num_rows($queryCart);
            echo json_encode(array(
                'cartID' => $lastID,
                'productName' => $resultProduct,
                'totalCartNumber' => $queryCartNum,
                'units' => $unitData
            ));
        }else {
            echo "error";
        }
    }

    $otherAmount = mysqli_real_escape_string($db,$_POST['otherAmount']);
    $otherName = mysqli_real_escape_string($db,$_POST['otherName']);
    $otherDescription = mysqli_real_escape_string($db,$_POST['otherDescription']);

    ////for custom products
    if ($clientUser_id == $sessionUser_id and isset($_POST['otherAmount']) and isset($_POST['otherName']) and isset($_POST['otherDescription'])) {
        $queryString = "SELECT id FROM order_table WHERE user_id='$clientUser_id' AND status='New'";
        $query = mysqli_query($db, $queryString);
        $orderIDResult = mysqli_fetch_assoc($query);
        $orderID = $orderIDResult['id'];
        
        //insert into shopping list cart. By default isCustom field is set to 0 or boolean false.
        $insertToCartQueryString = "INSERT INTO cart_table (order_id, item_id, amount, description, isCustom, isCustomUnit) VALUES ('$orderID','$otherName','$otherAmount','$otherDescription', '1', 'Each')";
        if (mysqli_query($db, $insertToCartQueryString)) {
            $lastID = mysqli_insert_id($db);
            $queryStringCart = "SELECT * FROM cart_table WHERE order_id='$orderID' ORDER BY id ASC";
            $queryCart = mysqli_query($db, $queryStringCart);
            $queryCartNum = mysqli_num_rows($queryCart);
            echo json_encode(array(
                'cartID' => $lastID,
                'totalCartNumber' => $queryCartNum,
                'units' => $unitData
            ));
        }else {
            echo "error";
        }    
    }


?>