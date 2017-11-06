<?php
    include("../inc/db.php");
    session_start();
    $clientUser_id = mysqli_real_escape_string($db,$_POST['user_id']);
    $product_id = mysqli_real_escape_string($db,$_POST['product_id']);
    $sessionUser_id = $_SESSION['login_user'];
    //initial modal status for deliveryOption and Category Select
    if ($clientUser_id == $sessionUser_id && isset($_POST['product_id'])) {
        $productQueryString = "SELECT * FROM product_table WHERE id='$product_id'";
        $productQuery = mysqli_query($db, $productQueryString);
        $queryRow = mysqli_num_rows($productQuery);

        if ($queryRow == 1) {
            $productResult = mysqli_fetch_assoc($productQuery);
    
            $productID = $productResult['id'];
            $productName = $productResult['product_name'];
            $productUnit = $productResult['unit'];
    
            echo json_encode(array(
                'productID' => $productID,
                'productName' => $productName,
                'productUnit' => $productUnit
              ));
        } else {
            echo "error";
        }


    }


?>