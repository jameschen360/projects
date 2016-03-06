<?
include('inc/connect.php');




if (isset($_POST['gallery_id'])) {
$gallery_id = mysql_real_escape_string($_POST['gallery_id']);



if ($gallery_id!="") {
		
			$sql = "DELETE FROM gallery WHERE id='$gallery_id'";
			$yes = mysql_query($sql);
			echo "<meta http-equiv=\"refresh\" content=\"0; url=./gallery.php\">";
			
		} else {
			echo "<meta http-equiv=\"refresh\" content=\"0; url=./gallery.php\">";
	}




}
?>