<?php
    include("../inc/db.php");
    session_start();
    $sessionUser_id = $_SESSION['login_user'];

    $clientUser_id = mysqli_real_escape_string($db,$_POST['user_id']);
    $order_id = mysqli_real_escape_string($db,$_POST['order_id']);

    //initial check for existing cart
    $orderCheck = mysqli_query($db, "SELECT * FROM order_table WHERE id='$order_id' AND user_id='$clientUser_id'");
    $orderCheckRows = mysqli_num_rows($orderCheck);

    if ($clientUser_id == $sessionUser_id) {

        if ($orderCheckRows > 0) {

            $orderCheckNew = mysqli_query($db, "SELECT * FROM order_table WHERE id='$order_id' AND user_id='$clientUser_id' AND status='Processing'");
            $orderCheckNewRows = mysqli_num_rows($orderCheckNew);

            if ($orderCheckNewRows > 0){

                $checkExist = "SELECT * FROM cart_table WHERE order_id='$order_id'";
                $queryCheckExist = mysqli_query($db, $checkExist);

                $order_info_array = [];
                $order_array = "SELECT * FROM order_table WHERE id='$order_id'";
                $order_info_array = mysqli_fetch_assoc(mysqli_query($db, $order_array));
                $order_time = $order_info_array['order_time'];

                date_default_timezone_set("America/Edmonton");
                
                $ordered_time = strtotime($order_time);
                $time_now = strtotime(date("m/d/Y h:i:s a"));
                $time_at_end = strtotime(date("m/d/Y").' 4:00:00 pm');
                $timed_out = $ordered_time+7200;

                if ($ordered_time >= $time_at_end){
                    $time_at_end = $timed_out;
                }

                
                if($time_now >= $time_at_end || $time_now >= $timed_out ){
                $can_edit = 'no';
                } else {
                $can_edit = 'yes';
                }
                
                
                $data = [];
                $dataArchive = [];
                $item_info = [];

                while ($row = $queryCheckExist->fetch_array()) {
                    $data[] = $row;
                    $item_id = $row['item_id'];
                    $product_info = "SELECT * FROM product_table WHERE id='$item_id'";
                    $item_array = mysqli_fetch_assoc(mysqli_query($db, $product_info));
                    $item_info[] = $item_array['product_name']; 
                    $product_unit[] = $item_array['unit']; 
                };


                echo json_encode(array(
                    'cart_table' => $data,
                    'product_info' => $item_info,
                    'product_unit' => $product_unit,
                    'order_info_array' => $order_info_array,
                    'can_edit' => $can_edit,
                    'time_now' => $time_now,
                    'time_at_end' => $time_at_end,
                    'timed_out' => $timed_out
                ));
                
                $queryCheckExist->close();

            } else {

                $checkExist = "SELECT * FROM archived_cart_table WHERE order_id='$order_id'";
                $queryCheckExist = mysqli_query($db, $checkExist);
                
                $order_info_array = [];
                $order_array = "SELECT * FROM order_table WHERE id='$order_id'";
                $order_info_array = mysqli_fetch_assoc(mysqli_query($db, $order_array));

                $data = [];
                $item_info = [];
                $product_unit = [];
                while ($row = $queryCheckExist->fetch_array()) {
                    $data[] = $row;
                    $item_id = $row['item_id'];
                    $product_info = "SELECT * FROM product_table WHERE id='$item_id'";
                    $item_array = mysqli_fetch_assoc(mysqli_query($db, $product_info));
                    $item_info[] = $item_array['product_name']; 
                    $product_unit[] = $item_array['unit']; 
                };
    
                echo json_encode(array(
                    'cart_table' => $data,
                    'product_info' => $item_info,
                    'product_unit' => $product_unit,
                    'order_info_array' => $order_info_array,
                    'time_now' => $time_now,
                    'time_at_end' => $time_at_end,
                    'timed_out' => $timed_out
                ));
                
                $queryCheckExist->close();
            }

        } else {
            echo "empty";
        }
    }
    
    // if ($clientUser_id == $sessionUser_id && isset($_POST['list']) && $list = 'item') {
    //     $checkExist = "SELECT * FROM product_table WHERE id='$item_id'";

    //     $queryCheckExist = mysqli_query($db, $checkExist);
 
    //     $data = [];
    //     while ($row = $queryCheckExist->fetch_array()) {
    //         $data[] = $row;	
    //     }

    //     echo json_encode(array(
    //         'product_item' => $data
    //     ));
        
    //     $queryCheckExist->close();

    // }
?>