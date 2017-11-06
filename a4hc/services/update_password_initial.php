<?php
include("../inc/db.php");
session_start();
if(isset($_POST['password1']) && isset($_POST['password2']))
{
// username and password sent from Form
$username=mysqli_real_escape_string($db,$_POST['username']); 
$password=md5(mysqli_real_escape_string($db,$_POST['password']));
$password1=mysqli_real_escape_string($db,$_POST['password1']);
$password2=mysqli_real_escape_string($db,$_POST['password2']); 

$result=mysqli_query($db,"SELECT * FROM user WHERE username='$username' and password='$password'");
$count=mysqli_num_rows($result);

$good_pass=md5($password1);

$set_criteria = preg_match('/^(?=.*[A-Za-z])(?=.*[0-9])([A-Za-z0-9_!@#$%^&*-\[\]])+$/', $password1);

$row=mysqli_fetch_assoc($result);
$id=$row['id'];
// If result matched $myusername and $mypassword, table row must be 1 row
	if($password1 == $password2) {
		if ($set_criteria) {
			if (strlen($password1)<9){
				echo "short";
			}else {
				$update_account=mysqli_query($db,"UPDATE user SET password='$good_pass',first_time='no' WHERE id='$id'");
				$_SESSION['login_user']=$row['id'];
				echo $row['id'];			
			}
		}else {
			echo "contain";
		}
	}

}
?>