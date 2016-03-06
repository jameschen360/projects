<?
include('inc/connect.php');




if (isset($_POST['email'])) {
$email = mysql_real_escape_string($_POST['email']);



if ($email!="") {
		
			$sql = "UPDATE contact SET email='$email' WHERE id=1";
			$yes = mysql_query($sql);
			echo "<meta http-equiv=\"refresh\" content=\"0; url=./contact.php\">";
			
		} else {
			echo "<meta http-equiv=\"refresh\" content=\"0; url=./contact.php\">";
	}




}
?>