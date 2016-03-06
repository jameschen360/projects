<?php
include('../inc/db.php');
//grab all post variables
$ename = mysqli_real_escape_string($db,strip_tags($_GET['ename']));
$zname = mysqli_real_escape_string($db,strip_tags($_GET['zname']));
$etext = mysqli_real_escape_string($db,strip_tags($_GET['etext']));
$ztext = mysqli_real_escape_string($db,strip_tags($_GET['ztext']));
$subname = mysqli_real_escape_string($db,strip_tags($_GET['subname']));
//
$subname_exploded = explode(',' ,$subname);
$subname_number = count($subname_exploded);
if (!empty($ename)) {
     if (!empty($zname)) {
         if (!empty($etext)) {
             if (!empty($ztext)) {
                 
                 if (empty($subname)) {
                     mysqli_query($db, "INSERT INTO catagory (`name`,`zh_name`,`sub`,`desc`,`zh_desc`) VALUES ('$ename','$zname','0','$etext','$ztext')");
                     echo "success";
                 }else {
                     mysqli_query($db, "INSERT INTO catagory (`name`,`zh_name`,`sub`,`desc`,`zh_desc`,`subname`) VALUES ('$ename','$zname','$subname_number','$etext','$ztext','$subname')");
                     echo "success";
                 }         
             }else {
                 echo "<p class=\"pull-right\" style=\"color:red;\" >Please fill in a Chinese detail for catagory</p>"; 
             }
         }else {
            echo "<p class=\"pull-right\" style=\"color:red;\" >Please fill in a English detail for catagory</p>";  
         }
     }else {
        echo "<p class=\"pull-right\" style=\"color:red;\" >Please enter a Chinese catagory name</p>"; 
     }
} else {
    echo "<p class=\"pull-right\" style=\"color:red;\" >Please enter English catagory name</p>";
}


?>