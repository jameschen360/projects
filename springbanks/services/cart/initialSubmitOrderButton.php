<?php
    include("../../inc/db.php");
    session_start();
    $clientUser_id = mysqli_real_escape_string($db,$_POST['user_id']);
    $sessionUser_id = $_SESSION['login_user'];

    if ($clientUser_id == $sessionUser_id) {
        $orderIDString = "SELECT * FROM order_table WHERE user_id='$clientUser_id' AND status='New'";
        $orderIDQuery = mysqli_query($db, $orderIDString);
        $orderIDResult = mysqli_fetch_assoc($orderIDQuery);
        $orderID = $orderIDResult['id'];

        $isCartExistQuery = mysqli_query($db, "SELECT * FROM cart_table WHERE order_id='$orderID'");
        $isCartExist = mysqli_num_rows($isCartExistQuery);
        if ($isCartExist > 0) {
            $userDefaultAddressInfo = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM user_table WHERE id='$clientUser_id'"));
            $address = $userDefaultAddressInfo['address'];
            $pcode = $userDefaultAddressInfo['pcode'];
            $phone = $userDefaultAddressInfo['phone'];
            if ($address == "" or $pcode == "" or $phone == "") {
                echo json_encode(array(
                    'address' => $address,
                    'pcode' => $pcode,
                    'phone' => $phone
                ));
            } else {
                echo "showTerms";
            }
        } else {
            echo "noItems";
        }

    }

?>