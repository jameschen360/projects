<?php
include('../../../inc/db.php');
session_start();
$clientUser_id = mysqli_real_escape_string($db,$_POST['admin_id']);
$sessionUser_id = $_SESSION['admin_user'];

if ($clientUser_id == $sessionUser_id) {
    $getProcessingStringOrder = "SELECT * FROM order_table WHERE status='Delivered'";
    $getProcessingQueryOrder = mysqli_query($db, $getProcessingStringOrder);

    $orderData = [];

    while ($row = $getProcessingQueryOrder->fetch_array()){
        $orderData[] = $row;
    }

    $getProcessingQueryOrder->close();
    
    echo json_encode(array(
        'orderData' => $orderData
    ));
    
}


?>