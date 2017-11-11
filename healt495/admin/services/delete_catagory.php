<?php
include('../inc/db.php');
//grab all post variables
$id = mysqli_real_escape_string($db,strip_tags($_GET['id']));
$catagory_result = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM catagory WHERE id='$id'"));
$name = $catagory_result['name'];
$sub_num = $catagory_result['sub'];
$subname = $catagory_result['subname'];

$product_num_result = mysqli_num_rows(mysqli_query($db, "SELECT * FROM product WHERE legacy <> 'yes' AND catagory_main='$name'"));

if (!empty($id)) {
    if ($product_num_result == 0) {
        mysqli_query($db, "DELETE FROM catagory WHERE id='$id'");
        echo "<span style=\"color:red;\">Delete successful!</span><br/>";
    }else {
        echo "<span style=\"color:red;\">Please remove products from $name to delete this category</span><br/>";
    }
    
}else {
    echo "<span style=\"color:red;\">Error</span><br/>";
}

?>