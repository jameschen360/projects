<?
include('inc/connect.php');




if (isset($_POST['cwcontent'])) {
$cwcontent = mysql_real_escape_string($_POST['cwcontent']);



if ($cwcontent!="") {
		
			$sql = "UPDATE cwevents SET content='$cwcontent' WHERE id=1";
			$yes = mysql_query($sql);
			echo "<meta http-equiv=\"refresh\" content=\"0; url=./cwevents.php\">";
			
		} else {
			echo "<meta http-equiv=\"refresh\" content=\"0; url=./cwevents.php\">";
	}




}
?>