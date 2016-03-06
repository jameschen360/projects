<?
include('inc/connect.php');




if (isset($_POST['phone'])) {
$phone = mysql_real_escape_string($_POST['phone']);



if ($phone!="") {
		
			$sql = "UPDATE contact SET phone='$phone' WHERE id=1";
			$yes = mysql_query($sql);
			echo "<meta http-equiv=\"refresh\" content=\"0; url=./contact.php\">";
			
		} else {
			echo "<meta http-equiv=\"refresh\" content=\"0; url=./contact.php\">";
	}




}
?>