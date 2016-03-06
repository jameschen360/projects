<?php
include('../inc/connect.php');


$sql = mysql_query("SELECT * FROM contact");
$value = mysql_fetch_array($sql);
$myemail = $value['email'];
$carrier1 = $value['carrier1'];
$carrier2 = $value['carrier2'];

if (isset($_POST['fullname'])) {
$fullname = mysql_real_escape_string(strip_tags($_POST['fullname']));
$phone = mysql_real_escape_string(strip_tags($_POST['phonenumber']));
$peoplenum = mysql_real_escape_string(strip_tags($_POST['peoplenum']));
$email = mysql_real_escape_string(strip_tags($_POST['email']));
$email_vari = mysql_real_escape_string(filter_var( strip_tags($_POST['email']), FILTER_VALIDATE_EMAIL ) && preg_match('/@.+\./', strip_tags($_POST['email'])));
$message = mysql_real_escape_string(strip_tags($_POST['message']));
$date = mysql_real_escape_string(strip_tags($_POST['datepick']));
$time = mysql_real_escape_string(strip_tags($_POST['timepicker']));
$spam = mysql_real_escape_string(strip_tags($_POST['anti']));
$reason = "Reservation made by $fullname";
$body = "From: $fullname\n E-Mail: $email\n Message:\n $message";
$MAX_STRNAME = 2;//Maximum length of name
$MAX_STRPHONE = 7;//Maximum length of phone


if ($fullname!="" && strlen($fullname) >= $MAX_STRNAME) {
		//DO SOMETHING
			if($email_vari!="" || $email_vari!=false) {
				//DO SOEMTHING
					//DOSOMETHING
					if($spam=='4') {
						
						if($phone !="" && strlen($phone) >= $MAX_STRPHONE) {
							
							if ($date !="") {
										
							
								$sql = "INSERT INTO reservation (name, number, email, people, date, time, comment, isconfirmed)
									VALUES ('$fullname', '$phone', '$email', '$peoplenum', '$date', '$time', '$message', 'no')";
									$check = mysql_query($sql);

										//mail($carrier1, "", "You have a new Reservation from $fullname for $peoplenum people on $date at $time. Please log in to admin page to confirm his/her reservation!", "From: $fullname ($email)\r\n");//email to cellphone	
										//mail($carrier2, "", "You have a new Reservation from $fullname for $peoplenum people on $date at $time. Please log in to admin page to confirm his/her reservation!", "From: $fullname ($email)\r\n");//email to cellphone	
										echo "<center><p class=\"alert alert-success\" >We will confirm your reservation and Email you shortly! Thank you!</p></center>";//success msg

	
							} else {
								echo "<center><p class=\"alert alert-danger\" >Please select a preferred date.</p></center>";
							}
							
						} else {
							
							echo "<center><p class=\"alert alert-danger\" >Please enter a valid phone number.</p></center>";
						}

					} else {

						echo "<center><p class=\"alert alert-danger\" >Your anti-spam answer is incorrect.</p></center>";
					} 

			} else {
				echo "<center><p class=\"alert alert-danger\" >Please enter a valid Email $email.</p></center>";
			}

		} else {
			echo "<center><p class=\"alert alert-danger\" >Please enter your name containing 2 or more characters.</p></center>";
	}




}?>