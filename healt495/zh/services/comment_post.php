<?php
include('../inc/db.php');
//grab all post variables
$title_comment = mysqli_real_escape_string($db,strip_tags($_POST['title_comment']));
$rating_comment = mysqli_real_escape_string($db,strip_tags($_POST['rating_comment']));
$message_comment = mysqli_real_escape_string($db,strip_tags($_POST['message4']));
$passcode = mysqli_real_escape_string($db,strip_tags($_POST['passcode']));
$product_id = strip_tags($_POST['product_id']);
$user_id = strip_tags($_POST['user_id']);
$date = date("Y/m/d");
//

$check = mysqli_query($db,"SELECT * FROM review WHERE product = '$product_id' AND user = '$user_id'");
$check = mysqli_num_rows($check);


$color_bad = "#FE2E2E";
$color_good = "#33cc33";
$MIN_STRNAME = 2;//min length of name
$MAX_STRNAME = 32;//max length of name
$message_strname = 10;
$answer = 4;

if (isset($_POST['title_comment'])) {
if (!empty($user_id)) {
	if ($check == 0){
		if ($title_comment!="" && strlen($title_comment) >= $MIN_STRNAME && strlen($title_comment) <= $MAX_STRNAME) {
			if (strlen($message_comment) > $message_strname) {
				if ($passcode == $answer) {
					
					$insert_sql = mysqli_query($db,"INSERT INTO review (product,user,title,date,comment,rating) VALUES ('$product_id','$user_id','$title_comment','$date','$message_comment','$rating_comment')");
					
					
					echo "<p style=\"color:$color_good;\" >成功！</p>";
				}else {
					echo "<p style=\"color:$color_bad;\" >考问题不正确。</p>";
				}
			}else {
				echo "<p style=\"color:$color_bad;\" >您的评论太短了。</p>";
			}
		}else {
			echo "<p style=\"color:$color_bad;\" >题目需要大于2个字小于32个字。</p>";
		}
		}else {
		echo "<p style=\"color:$color_bad;\" >您已经评论过了。</p>";
	}	
	} else {
		echo "<p style=\"color:$color_bad;\" >请登录后再评论。</p>";
	}
	
}?>