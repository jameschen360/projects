<?php include('../inc/connect.php'); ?>
<?php
	if(isset($_POST['page'])):
 	$paged=$_POST['page'];
	$sql="SELECT * FROM gallery ORDER BY id DESC LIMIT 1";
	if($paged>0){
	       $page_limit=$resultsPerPage*($paged-1);
	       $pagination_sql=" LIMIT  $page_limit, $resultsPerPage";
	       }
	else{
	$pagination_sql=" LIMIT 0 , $resultsPerPage";
	}

	$result=mysql_query($sql.$pagination_sql);

	$num_rows = mysql_num_rows($result);
	if($num_rows>0){
	while($data=mysql_fetch_array($result)){
	$gallery_id = 	$row['id'];
	$gallery_url = 	$row['url'];
	$gallery_title = 	$row['title'];
	?>
	<div class="grid-item">
	<a href="admin/<?echo $gallery_url;?>"  title="<?echo $gallery_title;?>" data-gallery>
	<img src="admin/<?echo $gallery_url;?>"  alt="<?echo $gallery_title;?>">
	</a>
	</div>
	<?
	}
	}?>
	<?if($num_rows == $resultsPerPage){?>
 	<li class="loadbutton"><button class="loadmore" data-page="<?php echo  $paged+1 ;?>">Load More</button></li>
 <?php 
  }else{
  	echo "<li class='loadbutton'><h3>No More Feeds</h3></li>";
 }
  endif;
   ?>