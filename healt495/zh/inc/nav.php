<?
$catagory_fetch = mysqli_query($db, "SELECT * FROM catagory");
$row_count_catagory = mysqli_num_rows($catagory_fetch);

$catagory_fetch = mysqli_query($db, "SELECT * FROM catagory ORDER BY id DESC");
$row_last = mysqli_fetch_assoc($catagory_fetch);
$row_last = $row_last['id'];

for ($i = 1; $i <= $row_last; $i++) {
$catagory_test = mysqli_query($db, "SELECT * FROM catagory WHERE id='$i'");	
$row_test = mysqli_num_rows($catagory_test);
	if ($row_test == 0) {
			while ($row_test == 0) {
				$i++;
				$catagory_test = mysqli_query($db, "SELECT * FROM catagory WHERE id='$i'");	
				$row_test = mysqli_num_rows($catagory_test);				
		}
	}
	$catagory_fetch = mysqli_query($db, "SELECT * FROM catagory WHERE id='$i'");
	$row = mysqli_fetch_assoc($catagory_fetch);
	$id[] = $row['id'];
	$name[] = $row['zh_name'];
	$link_name[] = $row['name'];
	$sub[] = $row['sub'];
	$subname[] = $row['zh_subname'];
	$link_subname[] = $row['subname'];
}

$i = 0;
?>