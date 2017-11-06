<?php
    include("../inc/db.php");
    session_start();
    $clientUser_id = mysqli_real_escape_string($db,$_POST['user_id']);
    $mainCategory = mysqli_real_escape_string($db,$_POST['mainCategory']);
    $sessionUser_id = $_SESSION['login_user'];
    //initial modal status for deliveryOption and Category Select
    if ($clientUser_id == $sessionUser_id and isset($_POST['mainCategory'])) {
        $query = "UPDATE last_filter_position SET category='$mainCategory' WHERE user_id='$clientUser_id'";
        mysqli_query($db, $query);
    }


?>