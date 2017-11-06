<?php
include('../../../inc/db.php');
session_start();
$clientUser_id = mysqli_real_escape_string($db,$_POST['admin_id']);
$sessionUser_id = $_SESSION['admin_user'];

if ($clientUser_id == $sessionUser_id) {
    $getUserString = "SELECT * FROM user_table";
    $getUserQuery = mysqli_query($db, $getUserString);

    $userData = [];

    while ($row = $getUserQuery->fetch_array()){
        $userData[] = $row;
    }

    $getUserQuery->close();
    
    echo json_encode(array(
        'userData' => $userData
    ));
    
}


?>