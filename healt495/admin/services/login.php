<?php
include("../inc/db.php");
session_start();
if(isset($_POST['username']) && isset($_POST['password']))
{
// username and password sent from Form
$username=mysqli_real_escape_string($db,$_POST['username']); 
$password=md5(mysqli_real_escape_string($db,$_POST['password'])); 

$result=mysqli_query($db,"SELECT id FROM customer WHERE email='$username' and pwd='$password'");
$count=mysqli_num_rows($result);

$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1)
{
$_SESSION['login_user']=$row['id'];
echo "OKAY";
}

}
?>