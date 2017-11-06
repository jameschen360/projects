<?php
    include("../inc/db.php");
    session_start();
    $sessionUser_id = $_SESSION['login_user'];

    $clientUser_id = mysqli_real_escape_string($db,$_POST['user_id']);
    $order_id = mysqli_real_escape_string($db,$_POST['order_id']);
    $cart_id = mysqli_real_escape_string($db,$_POST['cart_id']);
    $amount = mysqli_real_escape_string($db,$_POST['amount']);
    $cartIDArray = mysqli_real_escape_string($db,$_POST['cartIDArray']);
    $listArray = mysqli_real_escape_string($db,$_POST['listArray']);
    $productName = mysqli_real_escape_string($db,$_POST['productName']);
    $editType = mysqli_real_escape_string($db,$_POST['editType']);
    $description = mysqli_real_escape_string($db,$_POST['description']);

    //initial check for existing cart
    $orderCheck = mysqli_query($db, "SELECT * FROM order_table WHERE id='$order_id' AND user_id='$clientUser_id' AND status='Processing'");
    $orderCheckRows = mysqli_num_rows($orderCheck);

    if ($clientUser_id == $sessionUser_id) {

        if ($orderCheckRows > 0) {

            $checkExist = "SELECT * FROM order_table WHERE id='$order_id' ";
            $queryCheckExist = mysqli_query($db, $checkExist);

            $data = [];
            while ($row = $queryCheckExist->fetch_array()) {
                $data[] = $row;
            };

            $order_time = $data[0]['order_time'];

            date_default_timezone_set("America/Edmonton");

            $ordered_time = strtotime($order_time);
            $time_now = strtotime(date("m/d/Y h:i:s a"));
            $time_at_end = strtotime(date("m/d/Y").' 4:00:00 pm');
            $timed_out = $ordered_time+7200;

            if ($ordered_time >= $time_at_end){
                $time_at_end = $timed_out;
            }

            if ($time_now >= $time_at_end or $time_now >= $timed_out ) {
                $status='NoEdit';
            } else {
                $orderRows = mysqli_query($db, "SELECT * FROM cart_table WHERE order_id='$order_id'");
                $orderRowsNum =  mysqli_num_rows($orderRows);
                    if ($editType == 'edit') {
                    $orderCheckNew = mysqli_query($db, "UPDATE cart_table SET amount='$amount' WHERE id='$cart_id'");
                    $status='Changed';
                    } else if ($editType == 'remove') {
                    $orderCheckNew = mysqli_query($db, "DELETE FROM cart_table WHERE id='$cart_id'");
                        if ($orderRowsNum > 1){
                        $status='Deleted';
                        } else {
                        $status='empty';
                        }
                    } else if ($editType == 'add') {
                    $isCustom = 1;
                    $orderCheckNew = mysqli_query($db, "INSERT INTO cart_table (order_id, item_id, amount, description, isCustom, isCustomUnit) VALUES ('$order_id', '$productName', '$amount', '$description', '$isCustom', 'Each')");
                    $status='Added';
                    $new_id = mysqli_query($db, "SELECT MAX(id) FROM cart_table");
                    $new_id_query = mysqli_fetch_assoc(mysqli_query($db, "SELECT MAX(id) FROM cart_table"));
                    } else if ($editType == 'save'){
                    $itemAmount = explode(",",$listArray);
                    $itemCart = explode(",",$cartIDArray);
                    $arrayLength = count($itemAmount);
                        for($i=0 ; $i<$arrayLength ; $i++){
                            $itemAmountNumber = $itemAmount[$i];
                            $itemCartNumber = $itemCart[$i];
                            $orderCheckNew = mysqli_query($db, "UPDATE cart_table SET amount='$itemAmountNumber' WHERE id='$itemCartNumber'");
                        }
                    }
            }

            echo json_encode(array(
                'other_thing' => $data,
                'order_time' => $order_time,
                'ordered_time' => $ordered_time,
                'time_now' => $time_now,
                'time_at_end' => $time_at_end,
                'timed_out' => $timed_out,
                'status' => $status,
                'new_id_query' => $new_id_query,
                'itemAmount' => $itemAmount,
                'itemCart' => $itemCart,
                'arrayLength' => $arrayLength
            ));

            }

        } else {
            echo "error";
        }
    
    
?>