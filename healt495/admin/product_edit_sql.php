<?php
include('../inc/db.php');

$id = $_POST['hidden_id'];
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

$catagory_select_explode = explode('_', $catagory_select);

if (isset($_POST['ename'])) {
    
if ($catagory_select_explode[1] == ""){
    $catagory_main = $catagory_select_explode[0];
    $catagory_sub = $catagory_select_explode[0];
}else {
    $catagory_main = $catagory_select_explode[0];
    $catagory_sub = $catagory_select_explode[1];   
}

$last_str_keyword = substr($keyword, -1);
    if ($last_str_keyword == ",") {
       $keyword = rtrim($string, ",");
    }

//THIS IS FOR MAIN PRODUCT PICTURE
if (!empty($_FILES['main_image_edit']['name'])) {
$main_image = $_FILES['main_image_edit']['name'];
$tmpFilePath_main = $_FILES['main_image_edit']['tmp_name'];
$random_digit=rand(0000,9999);
$product_image_main = $random_digit.$main_image;
$newFilePath_main = "images/products/" . $product_image_main;
move_uploaded_file($tmpFilePath_main, $newFilePath_main);
mysqli_query($db, "UPDATE product SET picture='$product_image_main' WHERE id='$id'");
}
//THIS IS FOR MAIN PRODUCT PDF
if (!empty($_FILES['pdf']['name'])) {
$main_image = $_FILES['pdf']['name'];
$tmpFilePath_main = $_FILES['pdf']['tmp_name'];
$random_digit=rand(0000,9999);
$english_pdf = $random_digit.$main_image;
$newFilePath_main = "pdf/" . $english_pdf;
move_uploaded_file($tmpFilePath_main, $newFilePath_main);
mysqli_query($db, "UPDATE product SET pdf='$english_pdf' WHERE id='$id'");
}
//THIS IS FOR MAIN PRODUCT ZH_PDF
if (!empty($_FILES['zpdf']['name'])) {
$main_image = $_FILES['zpdf']['name'];
$tmpFilePath_main = $_FILES['zpdf']['tmp_name'];
$random_digit=rand(0000,9999);
$chinese_pdf = $random_digit.$main_image;
$newFilePath_main = "pdf/" . $chinese_pdf;
move_uploaded_file($tmpFilePath_main, $newFilePath_main);  
mysqli_query($db, "UPDATE product SET zh_pdf='$chinese_pdf' WHERE id='$id'");
}
    
//$mysqli_check = mysqli_query($db, "INSERT INTO product (name,zh_name,detail,zh_detail,price,catagory,catagory_main,keywords,instock,discount,weight,pdf,zh_pdf,picture) VALUES ('$ename','$zname','$etext','$ztext','$price','$catagory_sub','$catagory_main','$keyword','$stock','$discount','$weight','$english_pdf','$chinese_pdf','$product_image_main')");
    
mysqli_query($db, "UPDATE product SET name='$ename',zh_name='$zname',detail='$etext',zh_detail='$ztext',price='$price',catagory='$catagory_sub',catagory_main='$catagory_main',keywords='$keyword',instock='$stock',discount='$discount',weight='$weight' WHERE id='$id'");
echo "OKAY";  
}else {
    echo "No";
}

//Loop through each file
if (!empty($_FILES['upload']['name'][0])) {
for($i=0; $i<count($_FILES['upload']['name']); $i++) {
  //Get the temp file path
    $random_digit=rand(0000,9999);
    $new_file_name=$random_digit.$_FILES['upload']['name'][$i];   
    $tmpFilePath = $_FILES['upload']['tmp_name'][$i];

  //Make sure we have a filepath
  if ($tmpFilePath != ""){
    //Setup our new file path
    $newFilePath = "images/products/" . $new_file_name;
    //Upload the file into the temp dir
    if(move_uploaded_file($tmpFilePath, $newFilePath)) {
            mysqli_query($db, "INSERT INTO product_picture (product_id,picture) VALUES ('$id','$new_file_name')");
      //Handle other code here

    }
  }
}
}

function isImage($pathToFile)
{
  if( false === exif_imagetype($pathToFile) )
   return FALSE;

   return TRUE;
}
?>