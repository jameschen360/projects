	<?
	include('inc/header.php');//includes logo and navigation
	?>
    <?
	   	   $sql = mysql_query("SELECT * FROM home");
	   $value = mysql_fetch_array($sql);
			$gallery_pic = $value['background_gallery'];//background url for about us
	?>
	<style>
	.gallery-pic {
		background: url("admin/<? echo $gallery_pic; ?>") no-repeat center 0 fixed;
	}
	
	* {
  -webkit-box-sizing: border-box;
     -moz-box-sizing: border-box;
          box-sizing: border-box;
}

/* force scrollbar */
html { overflow-y: scroll; }

body {
  font-family: sans-serif;
}

/* ---- isotope ---- */

.grid {
  background: #FFF;
}

/* clear fix */
.grid:after {
  content: '';
  display: block;
  clear: both;
}

/* ---- .grid-item ---- */

.grid-sizer,
.grid-item {
  width: 33.333%;
}

.grid-item {
  float: left;
}

.grid-item img {
  display: block;
  max-width: 100%;
}

	</style>
      <!-- Intro Block
      ============================================-->
      <section class="intro-block intro-page boxed-section gallery-pic overlay-dark-m">
      
        <!-- Container -->
        <div class="container">     
          <!-- Section Title -->
          <div class="section-title invert-colors no-margin-b">
            <h2><font class="italiancustom" size="20">Gallery</font></h2>

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


    
        <!-- Container -->


			<div class="grid">
			<div id="links" class="image">
			<div class="gallery_list">
			  <div class="grid-sizer"></div>
			  
			  <?php
								//get rows query
								$query = mysql_query("SELECT * FROM gallery ORDER BY id DESC");
								$rowCount = mysql_num_rows($query);
								//number of rows

								
								
									while($row = mysql_fetch_assoc($query)){ 
										$gallery_id = 	$row['id'];
										$gallery_url = 	$row['url'];
										$gallery_title = 	$row['title'];
								?>
								
									  <div class="grid-item">
										<a href="admin/<?echo $gallery_url;?>"  title="<?echo $gallery_title;?>" data-gallery>
										<img src="admin/<?echo $gallery_url;?>"  alt="<?echo $gallery_title;?>">
										</a>
									  </div>
								<?php } ?>
								
								
								
			  
			</div>

		
			</div>

			</div>


         

	  
	  
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
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="//blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
	<script src="js/bootstrap-image-gallery.min.js"></script>
	<script src="js_custom/image.js"></script>
	<script src="js_custom/packge.js"></script>
	
	<script>
	  $(document).ready( function() {
		  // init Masonry
		  var $grid = $('.grid').masonry({
			itemSelector: '.grid-item',
			percentPosition: true,
			columnWidth: '.grid-sizer'
		  });
		  // layout Isotope after each image loads
		  $grid.imagesLoaded().progress( function() {
			$grid.masonry();
		  });  

		});
	</script>
	
	<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('click','.show_more',function(){
			var ID = $(this).attr('id');
			$('.show_more').hide();
			$('.loding').show();
			$.ajax({
				type:'POST',
				url:'./services/gallery_list.php',
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
	
	<!-- The Bootstrap Image Gallery lightbox, should be a child element of the document body -->
	<div id="blueimp-gallery" class="blueimp-gallery" data-use-bootstrap-modal="false">
    <!-- The container for the modal slides -->
    <div class="slides"></div>
    <!-- Controls for the borderless lightbox -->
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
    <!-- The modal dialog, which will be used to wrap the lightbox content -->
    <div class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body next"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left prev">
                        <i class="glyphicon glyphicon-chevron-left"></i>
                        Previous
                    </button>
                    <button type="button" class="btn btn-primary next">
                        Next
                        <i class="glyphicon glyphicon-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
  </body>
</html>
