<?
include('inc/connect.php');




if (isset($_POST['delete_status'])) {
$delete_status = mysql_real_escape_string($_POST['delete_status']);



if ($delete_status!="") {
		
			$sql = "DELETE FROM reservation WHERE id='$delete_status'";
			$yes = mysql_query($sql);
			echo "<meta http-equiv=\"refresh\" content=\"0; url=./request.php\">";
			
		} else {
			echo "<meta http-equiv=\"refresh\" content=\"0; url=./request.php\">";
	}




}
?>