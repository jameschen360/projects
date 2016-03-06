<?php
include('../inc/db.php');
//grab all post variables
$fname = mysqli_real_escape_string($db,ucfirst(strip_tags($_POST['fname'])));
$lname = mysqli_real_escape_string($db,ucfirst(strip_tags($_POST['lname'])));
$email = mysqli_real_escape_string($db,strip_tags($_POST['email']));
$email_vari = filter_var( strip_tags($_POST['email']), FILTER_VALIDATE_EMAIL ) && preg_match('/@.+\./', strip_tags($_POST['email']));
$pwd1 = mysqli_real_escape_string($db,strip_tags($_POST['pwd1']));
$pwd2 = mysqli_real_escape_string($db,strip_tags($_POST['pwd2']));
$address = mysqli_real_escape_string($db,strip_tags($_POST['address']));
$postal = mysqli_real_escape_string($db,strip_tags($_POST['postal']));
$city = mysqli_real_escape_string($db,strip_tags($_POST['city']));
$country = mysqli_real_escape_string($db,strip_tags($_POST['country']));
$province = mysqli_real_escape_string($db,strip_tags($_POST['province']));
//
$MAX_STRNAME = 2;//Maximum length of name
$MAX_PASS = 6;//Maximum length of name


$email_check = mysqli_query($db, "SELECT id FROM customer WHERE email='$email'");
$row = mysqli_num_rows($email_check);

if (isset($_POST['fname'])) {


if ($fname!="" && strlen($fname) >= $MAX_STRNAME && $lname!="" && strlen($lname) >= $MAX_STRNAME) {
		//DO SOMETHING
			if($email_vari!="" || $email_vari!=false) {
				//DO SOEMTHING
				if($pwd1 == $pwd2) {
					//DOSOMETHING
					if(strlen($pwd1) >= $MAX_PASS){
						//DOSOMETHING
						if ($address!="" && strlen($address) >= $MAX_PASS) {
							if ($postal!="") {
								if($city !="") {
									if($country !="") {
										if ($province !="") {
											if ($row == 0) {
												$pwdmd5 = md5($pwd1);
												$add_account = mysqli_query($db, "INSERT INTO customer (first_name,last_name,email,pwd,address,postal_code,city,country,province,currency)
																									VALUES ('$fname','$lname','$email','$pwdmd5','$address','$postal','$city','$country','$province','usd');");
												echo "<center><p style=\"font-size:25px;\"><font color=\"green\"><strong>Thank you for registering! You may now login!</strong></font></p></center>";
												
											}else {
											echo "<center><p style=\"color:red;\" >It appears that you already have an account with us!</p></center>";
											}	
										}else {
										echo "<center><p style=\"color:red;\" >Please enter a province location.</p></center>";
										}
									}else {
									echo "<center><p style=\"color:red;\" >Please enter a country location.</p></center>";
									}
								}else {
								echo "<center><p style=\"color:red;\" >Please enter a city location.</p></center>";
								}
							}else {
							echo "<center><p style=\"color:red;\" >Please enter a postal address.</p></center>";
							}
						}else {
						echo "<center><p style=\"color:red;\" >Please enter an address.</p></center>";
						}
					} else {
						echo "<center><p style=\"color:red;\" >Please enter 6 characters or more password.</p></center>";
					} 
				} else {
					echo "<center><p style=\"color:red;\" >Password does not match.</p></center>";
				}
			} else {
				echo "<center><p style=\"color:red;\" >Please enter a valid email address.</p></center>";
			}
		} else {
			echo "<center><p style=\"color:red;\" >Please enter a valid first and last name.</p></center>";
	}
}?>