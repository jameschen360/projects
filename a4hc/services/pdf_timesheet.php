<?
include("../inc/db.php");
date_default_timezone_set('America/Denver');

$task_id = mysqli_real_escape_string($db, $_POST['task_id']);
$task_id2 = mysqli_real_escape_string($db, $_POST['task_id2']);
$create_by_id = mysqli_real_escape_string($db, $_POST['create_by_id']);
$employee_id = mysqli_real_escape_string($db, $_POST['employee_id']);
$supervisor_id = mysqli_real_escape_string($db, $_POST['supervisor_id']);

if (isset($_POST['task_id'])){
	$user_result = mysqli_query($db, "SELECT * FROM timesheet_general WHERE id='$task_id'");
	$data = [];
	$i=0;
	while ($row = $user_result->fetch_array()) {
		$data[] = $row;	
	}
	echo json_encode($data);
	$user_result->close();
}
if (isset($_POST['task_id2'])){
	$user_result = mysqli_query($db, "SELECT * FROM timesheet WHERE timesheet_id='$task_id2'");
	$data = [];
	$i=0;
	while ($row = $user_result->fetch_array()) {
		$data[] = $row;	
	}
	echo json_encode($data);
	$user_result->close();
}

if (isset($_POST['employee_id']) and isset($_POST['supervisor_id'])){
	$created_user_result = mysqli_query($db, "SELECT * FROM user WHERE id='$employee_id'");
	$created_user_array = mysqli_fetch_assoc($created_user_result);
	$created_fname = $created_user_array['fname'];
	$created_lname = $created_user_array['lname'];
	$created_fullname = "$created_fname $created_lname";

	$supervisor_user_result = mysqli_query($db, "SELECT * FROM user WHERE id='$supervisor_id'");
	$supervisor_user_array = mysqli_fetch_assoc($supervisor_user_result);
	$supervisor_fname = $supervisor_user_array['fname'];
	$supervisor_lname = $supervisor_user_array['lname'];
	$supervisor_fullname = "$supervisor_fname $supervisor_lname";
	
	echo "$created_fullname,$supervisor_fullname";

}
?>