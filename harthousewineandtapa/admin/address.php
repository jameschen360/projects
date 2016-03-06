<?
include('inc/connect.php');




if (isset($_POST['address'])) {
$address = mysql_real_escape_string($_POST['address']);



if ($address!="") {
		
			$sql = "UPDATE contact SET address='$address' WHERE id=1";
			$yes = mysql_query($sql);
			echo "<meta http-equiv=\"refresh\" content=\"0; url=./contact.php\">";
			
		} else {
			echo "<meta http-equiv=\"refresh\" content=\"0; url=./contact.php\">";
	}




}
?>