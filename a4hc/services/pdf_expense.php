<?
include("../inc/db.php");
date_default_timezone_set('America/Denver');

$task_id = mysqli_real_escape_string($db, $_POST['task_id']);
$task_id2 = mysqli_real_escape_string($db, $_POST['task_id2']);
$payee_name_id = mysqli_real_escape_string($db, $_POST['payee_name_id']);
$create_by_id = mysqli_real_escape_string($db, $_POST['create_by_id']);
$supervisor_id = mysqli_real_escape_string($db, $_POST['supervisor_id']);

if (isset($_POST['task_id'])){
	$user_result = mysqli_query($db, "SELECT * FROM expense_claim WHERE id='$task_id'");
	$data = [];
	$i=0;
	while ($row = $user_result->fetch_array()) {
		$data[] = $row;	
	}
	echo json_encode($data);
	$user_result->close();
}
if (isset($_POST['task_id2'])){
	$user_result = mysqli_query($db, "SELECT * FROM expense_claim_detail WHERE expense_id='$task_id2'");
	$data = [];
	$i=0;
	while ($row = $user_result->fetch_array()) {
		$data[] = $row;	
	}
	echo json_encode($data);
	$user_result->close();
}

if (isset($_POST['payee_name_id']) and isset($_POST['create_by_id']) and isset($_POST['supervisor_id'])){
	$created_user_result = mysqli_query($db, "SELECT * FROM user WHERE id='$create_by_id'");
	$created_user_array = mysqli_fetch_assoc($created_user_result);
	$created_fname = $created_user_array['fname'];
	$created_lname = $created_user_array['lname'];
	$created_fullname = "$created_fname $created_lname";

	$supervisor_user_result = mysqli_query($db, "SELECT * FROM user WHERE id='$supervisor_id'");
	$supervisor_user_array = mysqli_fetch_assoc($supervisor_user_result);
	$supervisor_fname = $supervisor_user_array['fname'];
	$supervisor_lname = $supervisor_user_array['lname'];
	$supervisor_fullname = "$supervisor_fname $supervisor_lname";
	
	$payee_user_result = mysqli_query($db, "SELECT * FROM payee WHERE id='$payee_name_id'");
	$payee_user_array = mysqli_fetch_assoc($payee_user_result);
	$payee_name = $payee_user_array['name'];

	echo "$created_fullname,$supervisor_fullname,$payee_name";

}
?>