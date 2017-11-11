<?
include('../inc/db.php');
$id = $_GET['id'];

$check = mysqli_query($db, "DELETE FROM product_picture WHERE product_id='$id'");
if ($check) {
    echo "okay";
} else {
    echo "nope";
}
?>