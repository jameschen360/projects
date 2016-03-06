<?
include('inc/connect.php');


if (isset($_POST['sel1'])) {
	
$social = mysql_real_escape_string($_POST['sel1']);
$link = mysql_real_escape_string($_POST['social']);
echo $social; echo $link;


if ($link!="") {
		if ($social == "Facebook") {
			$social = "facebook";
			
		} elseif ($social == "Instagram") {
			$social = "insta";
		} else {
			$social = "twitter";
		}
			$sql = "UPDATE home SET $social='$link' WHERE id=1";
			$yes = mysql_query($sql);
			echo "<meta http-equiv=\"refresh\" content=\"0; url=./home.php\">";
			
		} else {
			echo "<meta http-equiv=\"refresh\" content=\"0; url=./home.php\">";
	}




}
?>