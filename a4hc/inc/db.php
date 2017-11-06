<?php
ob_start();
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'healt495_admin');
define('DB_PASSWORD', '092104003');
define('DB_DATABASE', 'healt495_accounting');
$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
	mysqli_set_charset($db, "utf8");
    mysqli_query($db, "SET character_set_client=utf8");
    mysqli_query($db, "SET character_set_connection=utf8");
?>