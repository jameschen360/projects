<?include('../inc/connect.php')?>
<?php
if (isset($_POST['email'])) {
$email = mysql_real_escape_string(strip_tags($_POST['email']));
$email_vari = filter_var( strip_tags($_POST['email']), FILTER_VALIDATE_EMAIL ) && preg_match('/@.+\./', strip_tags($_POST['email']));
$exist = mysql_query("SELECT id FROM subscribe WHERE email='$email' LIMIT 1"); 

if(mysql_num_rows($exist)==1) {
	echo"<center><p class=\"alert alert-danger\" >Email Already Exists!</p></center>";
} else
	{
	if ($email_vari!="" || $email_vari!=false) {

				
									$sql = "INSERT INTO subscribe (email)
									VALUES ('$email')";
									$check = mysql_query($sql);
									if ($check === TRUE) {
										echo "<center><p class=\"alert alert-success\" >Thank you for subscribing!</p></center>";//success msg
									} else {
										echo "Error: " . $sql . "<br>" . $conn->error;
									}
		
						} else {
							echo "<center><p class=\"alert alert-danger\" >Invalid Email Address!</p></center>";
					}
				}

				





}?>