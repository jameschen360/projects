<?
include("../inc/db.php");
date_default_timezone_set('America/Denver');

$task_id = mysqli_real_escape_string($db, $_POST['task_id']);
$task = mysqli_real_escape_string($db, $_POST['task']);

$task_id_update = mysqli_real_escape_string($db, $_POST['task_id_update']);
$task_update = mysqli_real_escape_string($db, $_POST['task_update']);
$date_sql = date("Y-m-d H:i:s");//sql format
if (isset($_POST['task_id']) and isset($_POST['task'])) {
	mysqli_query($db, "DELETE FROM notification WHERE task='$task' AND task_id='$task_id'");
}

if (isset($_POST['task_update']) and isset($_POST['task_id_update'])) {
	mysqli_query($db, "UPDATE notification SET user_viewed='yes', final_status='complete', date='$date_sql' WHERE task='$task_update' AND task_id='$task_id_update'");
}
?>