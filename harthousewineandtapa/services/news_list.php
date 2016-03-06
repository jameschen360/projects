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
							$news_id = 	$row['id'];
							$news_content = 	$row['content'];
							$news_title = 	$row['title'];
							$news_date = 	$row['date'];
							$news_pic = 	$row['pic'];
					?>
					
					
				<div class="row">

                <div class="meta">
                  <span class="date">
				  
				  <div class="pull-left"><h4><font class="flam-font"><?echo $news_title;?></font></a></h4></div>
				  
				  <div class="pull-right"><i class="fa fa-calendar"></i><?echo $news_date;?></div>
				  
				  
				  </span>
                </div>
				<div class="col-md-9 pull-right"><font class="flam-font"><? echo $news_content; ?></font></div>
              <div class="col-md-3 pull-left">
			  <!-- product -->
                    <div class="product clearfix">
                    
                      <!-- Image -->
                      <div class="image"> 
                        <a href="" class="main"><img class="custom_round" src="admin/<?echo $news_pic;?>" alt="<?echo $news_title;?>"></a>
                      </div>
                      <!-- Image -->
                    </div>
                    <!-- /product -->
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