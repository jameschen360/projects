<?php
include('../inc/connect.php');
$sql = mysql_query("SELECT * FROM contact");
$value = mysql_fetch_array($sql);
$myemail = $value['email'];
$carrier = $value['carrier'];

if (isset($_POST['fullname'])) {
$fullname = strip_tags($_POST['fullname']);
$email = strip_tags($_POST['email']);
$email_vari = filter_var( strip_tags($_POST['email']), FILTER_VALIDATE_EMAIL ) && preg_match('/@.+\./', strip_tags($_POST['email']));
$reason = strip_tags($_POST['options']);
$message = strip_tags($_POST['message']);
$spam = strip_tags($_POST['anti']);
$reason = "$reason Message from $fullname";
$body = "From: $fullname\n E-Mail: $email\n Message:\n $message";
$MAX_STRNAME = 2;//Maximum length of name

if ($fullname!="" && strlen($fullname) >= $MAX_STRNAME) {
		//DO SOMETHING
			if($email_vari!="" || $email_vari!=false) {
				//DO SOEMTHING
				if($message!="") {
					//DOSOMETHING
					if($spam=='4') {
						
						mail($myemail, "$reason", $body, "From:" . $email);
						echo "<center><p class=\"alert alert-success\" >Thank you! We will be in touch shortly!</p></center>";

					} else {

						echo "<center><p class=\"alert alert-danger\" >Your anti-spam answer is incorrect.</p></center>";
					} 

				} else {
					echo "<center><p class=\"alert alert-danger\" >Please write a question.</p></center>";
				}

			} else {
				echo "<center><p class=\"alert alert-danger\" >Please enter your Email.</p></center>";
			}

		} else {
			echo "<center><p class=\"alert alert-danger\" >Please enter your name containing 2 or more characters.</p></center>";
	}




}?>