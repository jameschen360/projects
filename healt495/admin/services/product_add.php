<?php
include('../inc/db.php');

$catagory_select = mysqli_real_escape_string($db,strip_tags($_POST['catagory_select']));
$ename = mysqli_real_escape_string($db,strip_tags($_POST['ename']));
$zname = mysqli_real_escape_string($db,strip_tags($_POST['zname']));
$etext = mysqli_real_escape_string($db,htmlspecialchars($_POST['etext']));
$ztext = mysqli_real_escape_string($db,htmlspecialchars($_POST['ztext']));
$price = mysqli_real_escape_string($db,strip_tags($_POST['price']));
$stock = mysqli_real_escape_string($db,strip_tags($_POST['stock']));
$weight = mysqli_real_escape_string($db,strip_tags($_POST['weight']));
$discount = mysqli_real_escape_string($db,strip_tags($_POST['discount']));
$keyword = mysqli_real_escape_string($db,strip_tags($_POST['keyword']));


//mysql_insert_id();
//Loop through each file
if (!empty($_FILES['upload']['name'][0])) {
for($i=0; $i<count($_FILES['upload']['name']); $i++) {
  //Get the temp file path
  $tmpFilePath = $_FILES['upload']['tmp_name'][$i];

  //Make sure we have a filepath
  if ($tmpFilePath != ""){
    //Setup our new file path
    $newFilePath = "/images/products/" . $_FILES['upload']['name'][$i];
    //Upload the file into the temp dir
    if(move_uploaded_file($tmpFilePath, $newFilePath)) {	echo "OKAY";
		//insert into MSYQL
      //Handle other code here

    }
  }else {	echo "nope";}
}
}else {	echo "empty";}

?>