<?php
    include("../../inc/db.php");
    session_start();
    $clientUser_id = mysqli_real_escape_string($db,$_POST['user_id']);
    $sessionUser_id = $_SESSION['login_user'];

    $unitTableString = "SELECT * FROM unit_table ORDER BY unit ASC";
    $unitTableQuery =  mysqli_query($db, $unitTableString);
    $unitData = [];
    while ($row = $unitTableQuery->fetch_array()) {
        $unitData[] = $row;
    }

    if ($clientUser_id == $sessionUser_id) {
        $queryString = "SELECT * FROM order_table WHERE user_id='$clientUser_id' AND status='New'";
        $query = mysqli_query($db, $queryString);
        $orderIDResult = mysqli_fetch_assoc($query);
        $orderID = $orderIDResult['id'];

        $queryStringCart = "SELECT * FROM cart_table WHERE order_id='$orderID' ORDER BY id ASC";
        $queryCart = mysqli_query($db, $queryStringCart);
        $queryCartNum = mysqli_num_rows($queryCart);
        if ($queryCartNum > 0) {
            $queryProduct = [];
            $data = [];
            while ($row = $queryCart->fetch_array()) {
                $data[] = $row;
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
            echo json_encode(array(
                'myCartData' => $data,
                'product' => $queryProduct,
                'totalCartNumber' => $queryCartNum,
                'units' => $unitData,
            ));

            $queryCart->close();

        } else {
            echo "empty";
        }
    }

?>