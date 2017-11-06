<?
include("../inc/db.php");
//Start our session.
session_start();
$user = $_SESSION['login_user'];
$path = $_GET['path'];//GET file path
$task = $_GET['task'];//GET expense id
$file2 = basename($path);	

if ($task == "expense" or $task == "vacation" or $task == "timesheet" or $task == "overtime") {
	$check_file = mysqli_num_rows(mysqli_query($db, "SELECT * FROM file_upload WHERE file_destination='$path' AND username='$user' AND topic='$task'"));//check if file belongs to user.
}else if ($task == "project") {
	$check_file = mysqli_num_rows(mysqli_query($db, "SELECT * FROM file_upload_project WHERE file_destination='$path'"));//check if file belongs to user.
	if ($user == "") {
		$check_file = 0;
	}
}else if ($task == "contract") {
	$check_file = mysqli_num_rows(mysqli_query($db, "SELECT * FROM contract_pdf WHERE pdf_location='$path'"));//check if file belongs to user.
	if ($user == "") {
		$check_file = 0;
	}	
}else {
	$check_file = 0;
}

$check_auth_array = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM user WHERE id='$user'"));
$check_auth = $check_auth_array['auth'];

if ($check_file == 1 or $check_auth == "admin" or $check_auth == "super") {
	$file = '../uploads/'.$path;
	$filename = $file2;
	header('Content-type: application/pdf');
	header('Cache-Control: no-cache, no-store, must-revalidate'); // HTTP 1.1
	header('Pragma: no-cache'); // HTTP 1.0
	header('Expires: 0'); // Proxies	
	header('Content-Disposition: inline; filename="'.$filename.'"');
	header('Content-Transfer-Encoding: binary');
	header('Accept-Ranges: bytes');

	readfile($file);		
}else {
	echo "<meta http-equiv=\"refresh\" content=\"0; url=../error.html\">";
}
	

?>
