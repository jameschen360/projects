<?php
include("../inc/db.php");


$rev = mysqli_real_escape_string($db, $_POST['revision']);

if (mysqli_query($db, "UPDATE revision SET revision='$rev'")){
	echo $rev;
}
	
	

?>