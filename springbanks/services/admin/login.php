<?php
    include("../../inc/db.php");
    session_start();
    if( isset($_POST['password']) && isset($_POST['username']) ) {

    $loginEmail=mysqli_real_escape_string($db,$_POST['username']); 
    $loginPassword=md5(mysqli_real_escape_string($db,$_POST['password'])); 

    $result=mysqli_query($db,"SELECT * FROM admin_table WHERE username='$loginEmail' and password='$loginPassword'");
    $count=mysqli_num_rows($result);

    $row=mysqli_fetch_assoc($result);
    $new_user = $row['first_time'];
        $user_id = $row['id'];
        $_SESSION['admin_user'] = $user_id;
        echo json_encode(array(
            'success' => true,
            'user_id' => $user_id
            ));	        	
    }
?>