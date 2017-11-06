<?php
    include("../../inc/db.php");
    session_start();

    $passwordReset=mysqli_real_escape_string($db,$_POST['passwordReset']); 
    $result=mysqli_query($db,"SELECT * FROM user_table WHERE email='$passwordReset'");
    $count=mysqli_num_rows($result);
    $row=mysqli_fetch_assoc($result);
    $userID=$row['id'];
    $firstName=$row['fname'];
    $lastName=$row['lname'];
    $email=$row['email'];

    if($count==1) {
        $auto_email_result = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM automsg_email"));
        $auto_email = $auto_email_result['email'];
        $auto_pwd = $auto_email_result['pwd'];
        $logo = $auto_email_result['logo'];

        $template   = 'XX99XX99';
        $k = strlen($template);
        $password = '';
        for ($i=0; $i<$k; $i++)
        {
            switch($template[$i])
            {
                case 'X': $password .= chr(rand(65,90)); break;
                case '9': $password .= rand(0,9); break;
            }
        }

        $passwordMD5 = md5($password);
        mysqli_query($db, "UPDATE user_table SET pwd='$passwordMD5' WHERE id='$userID'");
        
        require_once("../../mail/class.phpmailer.php");//obtain mailer classes
        require_once("../../mail/email/login_reset_email.php");//send for approval


    }
?>