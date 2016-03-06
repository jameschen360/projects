<?php
if(isset($_POST["id"]) && !empty($_POST["id"])){

//include database configuration file
include('../inc/connect.php');

//get rows query
$query = mysql_query("SELECT * FROM news WHERE id < ".$_POST['id']." ORDER BY id DESC LIMIT 1");

//number of rows
$rowCount = mysql_num_rows($query);

if($rowCount > 0){ 
										while($row = mysql_fetch_assoc($query)){ 
										$gallery_id = 	$row['id'];
										$gallery_url = 	$row['url'];
										$gallery_title = 	$row['title'];
					?>
					
					
				<div class="row">

										<div class="grid-item">
										<a href="admin/<?echo $gallery_url;?>"  title="<?echo $gallery_title;?>" data-gallery>
										<img src="admin/<?echo $gallery_url;?>"  alt="<?echo $gallery_title;?>">
										</a>
									  </div>				
				

			  </div>
			  <?php } ?>
				<center><div class="show_more_main" id="show_more_main<?php echo $news_id; ?>">
						<span id="<?php echo $news_id; ?>" class="show_more btn btn-outline custom_round" title="Load more posts">More News</span>
						<span class="loding" style="display: none;"><span class="loding_txt">Loading...</span></span></center>
					</div>
				
				<?php }
}
?>