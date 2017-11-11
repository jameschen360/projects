<?php
include('../inc/db.php');
$id = $_GET['id'];

mysqli_query($db, "UPDATE product SET legacy='yes' WHERE id='$id'");

?>