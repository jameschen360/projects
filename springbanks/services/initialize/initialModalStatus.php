<?php
    include("../../inc/db.php");
    session_start();
    $clientUser_id = mysqli_real_escape_string($db,$_POST['user_id']);
    $sessionUser_id = $_SESSION['login_user'];
    //initial modal status for deliveryOption and Category Select
    if ($clientUser_id == $sessionUser_id) {
        $checkExist = "SELECT * FROM last_filter_position WHERE user_id='$clientUser_id'";
        $queryCheckExist = mysqli_query($db, $checkExist);
        $resultCheckExist = mysqli_fetch_assoc($queryCheckExist);
        
        echo json_encode(array(
            'isDeliveryModal' => $resultCheckExist['isDeliveryModal'],
            'isCategoryModal' => $resultCheckExist['isCategoryModal']
          ));


    }


?>