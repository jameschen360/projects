<?php
include('../inc/db.php');
//grab all post variables
$fname = mysqli_real_escape_string($db,ucfirst(strip_tags($_POST['fname'])));
$lname = mysqli_real_escape_string($db,ucfirst(strip_tags($_POST['lname'])));

$pwd1 = mysqli_real_escape_string($db,strip_tags($_POST['pwd1']));
$pwd2 = mysqli_real_escape_string($db,strip_tags($_POST['pwd2']));
$address = mysqli_real_escape_string($db,strip_tags($_POST['address']));
$postal = mysqli_real_escape_string($db,strip_tags($_POST['postal']));
$city = mysqli_real_escape_string($db,strip_tags($_POST['city']));
$country = mysqli_real_escape_string($db,strip_tags($_POST['country']));
$province = mysqli_real_escape_string($db,strip_tags($_POST['province']));
$phone = mysqli_real_escape_string($db,strip_tags($_POST['btel']));
$user_id = mysqli_real_escape_string($db,strip_tags($_POST['user_id']));
//
$MAX_STRNAME = 2;//Maximum length of name
$MAX_PASS = 6;//Maximum length of name



if (isset($_POST['fname'])) {


if ($fname!="" && strlen($fname) >= $MAX_STRNAME && $lname!="" && strlen($lname) >= $MAX_STRNAME) {
		//DO SOMETHING
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
												$add_account = mysqli_query($db, "UPDATE customer SET first_name='$fname',last_name='$lname',pwd='$pwdmd5',address='$address',postal_code='$postal',city='$city',country='$country',province='$province',phone='$phone' WHERE id='$user_id'");
												echo "Success";
												
											}else {
											echo "<p style=\"color:red;\" >It appears that you already have an account with us!</p>";
											}	
										}else {
										echo "<p style=\"color:red;\" >Please enter a province location.</p>";
										}
									}else {
									echo "<center><p style=\"color:red;\" >Please enter a country location.</p>";
									}
								}else {
								echo "<p style=\"color:red;\" >Please enter a city location.</p>";
								}
							}else {
							echo "<p style=\"color:red;\" >Please enter a postal address.</p>";
							}
						}else {
						echo "<p style=\"color:red;\" >Please enter an address.</p>";
						}
					} else {
						echo "<p style=\"color:red;\" >Please enter 6 characters or more password.</p>";
					} 
				} else {
					echo "<center><p style=\"color:red;\" >Password does not match.</p>";
				}	
		} else {
			echo "<p style=\"color:red;\" >Please enter a valid first and last name.</p>";
	}
}?>