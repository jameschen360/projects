<?php
    include("../../inc/db.php");
    session_start();
    $clientUser_id = mysqli_real_escape_string($db,$_POST['user_id']);
    $deliveryOption = mysqli_real_escape_string($db,$_POST['deliveryOption']);
    $sessionUser_id = $_SESSION['login_user'];

    //initial modal status for deliveryOption and Category Select
    if ($clientUser_id == $sessionUser_id) {
        if ($deliveryOption == "Rush Delivery") {
            $deliveryString = "SELECT * FROM shop_table WHERE rush='1'";
        } else {
            $deliveryString = "SELECT * FROM shop_table WHERE regular='1'";
        }
       
        $shopOptions = mysqli_query($db, $deliveryString);
        $data = [];
        while ($row = $shopOptions->fetch_array()) {
            $data[] = $row;
        }
        echo json_encode(array(
            'shopOptions' => $data
          ));


    }


?>