	<?
	include('inc/header.php');//includes logo and navigation
	?>
    <?
	    $sql = mysql_query("SELECT * FROM home");
	   $value = mysql_fetch_array($sql);
			$news_pic = $value['background_news'];//background url for about us
	?>
	<style>
	.news-pic {
		background: url("admin/<? echo $news_pic; ?>") no-repeat center 0 fixed;
	}
	</style>
     
      <!-- Intro Block
      ============================================-->
      <section class="intro-block intro-page boxed-section news-pic overlay-dark-m">
      
        <!-- Container -->
        <div class="container">     
          <!-- Section Title -->
          <div class="section-title invert-colors no-margin-b">
            <h2><font class="italiancustom" size="20">News</font></h2>
          </div>
          <!-- /Section Title -->
        </div>
        <!-- /Container -->
      
      </section>
      <!-- /Intro Block
      ============================================-->
      
      <!-- Page Info Block
      ============================================-->
      <section class="page-info-block boxed-section">
      
        <!-- Container -->
        <div class="container cont-pad-x-15"> 

          <!-- Breadcrumb -->
          <ol class="breadcrumb pull-left">
            <li><a href="#"></a></li>
          </ol>
          <!-- /Breadcrumb --> 

        </div>
        <!-- /Container -->
      
      </section>
      <!-- /Page Info  Block
      ============================================-->
      
      <!-- Content Block
      ============================================-->
      <section class="content-block default-bg">
      
        <!-- Container -->
        <div class="container cont-pad-t-sm">

          <!-- Row -->
          <div class="row">
<!-- Side Col -->
            <div class="side-col side-col-padded col-sm-4 col-md-4">
			</div>
            <!-- /Side Col -->
           
		   <!-- Main Col -->
			
		   <div class="col-lg-12">
		   
              
			  <!--  -------------------------------------Post -------------------------------------------------------------- -->
			  <!--  -------------------------------------Post -------------------------------------------------------------- -->
              <article class="blog-entry">
			  <div class="row">

                <div class="meta">
                  <span class="date">
				  
				  <div class="pull-left"><h4><font class="flam-font">Bread and Breakfast!</font></a></h4></div>
				  </span>
                </div>
				<div class="col-md-9 pull-right"><font class="flam-font">"Looking for a change of scenery and something unique?"<br/>
				For our travellers visiting we offer accommodation at the Heritage BNB in 49th St in Camrose. Walking distance from the Hart House!
				<br/>Check out their web site at <a href="http://www.heritagebnb.com">Heritage BNB</a> to info on the house and what it offers. 
				Make it a weekend and attend a concert at the Baily theatre or Peter Lougheed. </font></div>
               <div class="col-md-3 pull-left">
			  <!-- product -->
                    <div class="product clearfix">
                    
                      <!-- Image -->
                      <div class="image"> 
                        <a href="" class="main"><img class="custom_round" src="http://www.heritagebnb.com/wp-content/uploads/2014/07/IMG_1111-300x225.jpg" alt=""></a>
                      </div>
                      <!-- Image -->
                    </div>
                    <!-- /product -->
			  </div>
			  </div>
				<?php
					//get rows query
					$query = mysql_query("SELECT * FROM news ORDER BY id DESC LIMIT 3");
					
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
				
				<?php } ?>
			  </article>
              <!-- ---------------------------------Post /END--------------------------------------------------------------- -->
			  <!-- ---------------------------------Post /END--------------------------------------------------------------- -->

			</center>
            <!-- /Main Col --============================>
            
          <!-- /Row -->
             
        
        </div>
        <!-- /Container -->
        
      </section>
      <!-- /Content Block
      ============================================-->
	  <!-- Page Info Block
      ============================================-->
      <section class="page-info-block boxed-section">
      
        <!-- Container -->
        <div class="container cont-pad-x-15"> 

          <!-- Breadcrumb -->
          <ol class="breadcrumb pull-left">
            <li><a href="#"></a></li>
          </ol>
          <!-- /Breadcrumb --> 

        </div>
        <!-- /Container -->
      
      </section>
      <!-- /Page Info  Block
      ============================================-->
	<?include('inc/footer.php');?>
      
    </div>
    <!-- /Page Wrapper
    ++++++++++++++++++++++++++++++++++++++++++++++ -->

    <!-- Javascript
    ================================================== -->
    <script src="uikit/js/jquery-latest.min.js"></script>
    <script src="uikit/js/uikit.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('click','.show_more',function(){
			var ID = $(this).attr('id');
			$('.show_more').hide();
			$('.loding').show();
			$.ajax({
				type:'POST',
				url:'./services/news_list.php',
				data:'id='+ID,
				success:function(html){
					$('#show_more_main'+ID).remove();
					$('.blog-entry').append(html);
				}
			});
			
		});
	});
	</script>
    <!-- /JavaScript
    ================================================== -->
  </body>
</html>
