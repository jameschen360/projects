<?php
    include("../../inc/db.php");
    session_start();

    $signupFirstName=mysqli_real_escape_string($db,$_POST['signupFirstName']); 
    $signupLastName=mysqli_real_escape_string($db,$_POST['signupLastName']); 
    $signupEmail=mysqli_real_escape_string($db,$_POST['signupEmail']); 
    $signupPassword=mysqli_real_escape_string($db,$_POST['signupPassword']); 
    $passwordCheck=mysqli_real_escape_string($db,$_POST['passwordCheck']); 

    $doesEmailExistQuery=mysqli_query($db, "SELECT * FROM user_table WHERE email='$signupEmail'");
    $doesEmailExistResult=mysqli_num_rows($doesEmailExistQuery);

    if (strlen($signupFirstName) < 2) {
        echo '<span style='.'"color:red"'.'>Error:</span> First name too short!';
        exit;
    }
    if (strlen($signupLastName) < 2) {
        echo '<span style='.'"color:red"'.'>Error:</span> Last name too short!';
        exit;
    }
    if ($doesEmailExistResult == 1) {
        echo '<span style='.'"color:red"'.'>Error:</span> Email is already used!';
        exit;
    }
    if (!filter_var($signupEmail, FILTER_VALIDATE_EMAIL)) {
        echo '<span style='.'"color:red"'.'>Error:</span> Invalid email!';
        exit;
    }
    if (strlen($signupPassword) < 7) {
        echo '<span style='.'"color:red"'.'>Error:</span> Password length must be 7 characters or longer!';
        exit;
    }
    if ($signupPassword != $passwordCheck) {
        echo '<span style='.'"color:red"'.'>Error:</span> Passwords do not match!';
        exit;
    }

    $encryptedPassword = md5($signupPassword);

    $insertNewUserQuery = "INSERT INTO 
                           user_table (fname, lname, email, pwd) 
                           VALUES ('$signupFirstName',
                                   '$signupLastName',
                                   '$signupEmail',
                                   '$encryptedPassword')";
    
    mysqli_query($db, $insertNewUserQuery);
    $last_id = mysqli_insert_id($db);
    $_SESSION['login_user']=$last_id;

    echo json_encode(array(
        'success' => true,
        'user_id' => $last_id
      ));
    
?>