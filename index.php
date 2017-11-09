<?php
    require '../config.php';
    require '../Slim/Slim.php';
    
    \Slim\Slim::registerAutoloader();
    $app = new \Slim\Slim;

    $app->post('/processingTable','processingTable'); 

    $app->run();   

    function processingTable() {
        $request = \Slim\Slim::getInstance()->request();
        $data = json_decode($request->getBody());
        $user_id=$data->id;
        $token=$data->token;
        $systemToken=apiToken($user_id);

        $mysqli = getDB();
        $processingOrderData = [];
        if ($mysqli) {
            if ($systemToken == $token) {

            }
            $sql = "SELECT * FROM order_table WHERE status='Processing'";
            $query = $mysqli->query($sql);
            while ($row = $query->fetch_array()) {
                $processingOrderData[] = $row;
            }
            $query->close();
            echo json_encode(array(
                'processingOrderData' => $processingOrderData
            ));             
        } else {
            echo json_encode(array(
                'error' => $mysqli->connection_errno
            ));    	
        }
    }

?>
