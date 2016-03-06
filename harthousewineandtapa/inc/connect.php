<?
$database_user="****";
$password="****";
$database="****";
mysql_connect("localhost",$database_user,$password) or die(mysql_error());
mysql_select_db($database);
?>