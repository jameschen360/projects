<?php
ob_start();
define('DB_SERVER', 'localhost');
define('DB_USERNAME', '***');
define('DB_PASSWORD', '***');
define('DB_DATABASE', '***');
$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
	mysqli_set_charset($db, "utf8");
    mysqli_query($db, "SET character_set_client=utf8");
    mysqli_query($db, "SET character_set_connection=utf8");
?>