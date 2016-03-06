<?
include('inc/connect.php');




if (isset($_POST['post_id'])) {
$post_id = mysql_real_escape_string($_POST['post_id']);



if ($post_id!="") {
		
			$sql = "DELETE FROM news WHERE id='$post_id'";
			$yes = mysql_query($sql);
			echo "<meta http-equiv=\"refresh\" content=\"0; url=./news.php\">";
			
		} else {
			echo "<meta http-equiv=\"refresh\" content=\"0; url=./news.php\">";
	}




}
?>