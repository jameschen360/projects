<?
include('inc/connect.php');




if (isset($_POST['message'])) {
$message = mysql_real_escape_string($_POST['message']);



if ($message!="") {
		
			$sql = "UPDATE home SET hours='$message' WHERE id=1";
			$yes = mysql_query($sql);
			echo "<meta http-equiv=\"refresh\" content=\"0; url=./home.php\">";
			
		} else {
			echo "<meta http-equiv=\"refresh\" content=\"0; url=./home.php\">";
	}




}
?>