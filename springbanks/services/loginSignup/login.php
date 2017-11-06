<?php
    include("../../inc/db.php");
    session_start();
    if( isset($_POST['loginEmail']) && isset($_POST['loginPassword']) ) {

    $loginEmail=mysqli_real_escape_string($db,$_POST['loginEmail']); 
    $loginPassword=md5(mysqli_real_escape_string($db,$_POST['loginPassword'])); 

    $result=mysqli_query($db,"SELECT * FROM user_table WHERE email='$loginEmail' and pwd='$loginPassword'");
    $count=mysqli_num_rows($result);

    $row=mysqli_fetch_assoc($result);
    $new_user = $row['first_time'];
        if($count==1) {
            if ($new_user == "yes") {
                echo $new_user;
            }else {
                $user_id = $row['id'];
                $_SESSION['login_user'] = $user_id;
                echo json_encode(array(
                    'success' => true,
                    'user_id' => $user_id
                  ));	
            }
        }	
    }
?>