 <?php
include("../inc/db.php");
date_default_timezone_set('America/Denver');

$auto_email_result = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM automsg_email"));
$auto_email = $auto_email_result['email'];
$auto_pwd = $auto_email_result['pwd'];
$logo = $auto_email_result['logo'];

function sernum() //  generate random gift code based on given template
			{
				$template   = 'XX99XX99';
				$k = strlen($template);
				$sernum = '';
				for ($i=0; $i<$k; $i++)
				{
					switch($template[$i])
					{
						case 'X': $sernum .= chr(rand(65,90)); break;
						case '9': $sernum .= rand(0,9); break;
						case '-': $sernum .= '-';  break;
					}
				}
				return $sernum;
			}
			
	$email = mysqli_real_escape_string($db, $_POST['email']);
	$ep_result = mysqli_query($db, "SELECT * FROM user WHERE username='$email'");
	$row = mysqli_fetch_assoc($ep_result);


if (isset($_POST['email']) && $row!=  null){

	$password = sernum();
	$md5_password = md5($password);

	$fname = $row['fname'];
	$lname = $row['lname'];
	$username_full = "$fname $lname";
	$username = $email;

	$check2 = mysqli_query($db, "UPDATE user SET password='$md5_password' WHERE username='$username'");

	require_once("../mail/class.phpmailer.php");//obtain mailer classes
	require_once("../mail/email/login_reset_email.php");	//send for approval

}else{
echo 'i failed';
}

?>