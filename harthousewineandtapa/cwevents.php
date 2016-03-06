	<?
	include('inc/header.php');//includes logo and navigation
	
	?>
    <?
	   $sql = mysql_query("SELECT * FROM about");
	   $value = mysql_fetch_array($sql);
			$aboutus_pic = $value['background'];//background url for about us
	   $sql2 = mysql_query("SELECT * FROM cwevents");
	   $value2 = mysql_fetch_array($sql2);
			$content = $value2['content'];  
			$company1 = $value2['company1']; 
			$company2 = $value2['company2']; 
			$company3 = $value2['company3']; 
	?>
	<style>
	.aboutus-pic {
		background: url("admin/<? echo $aboutus_pic; ?>") no-repeat center 0 fixed;
	}
	</style>
	<body>
      <!-- Intro Block
      ============================================-->
      <section class="intro-block intro-page boxed-section aboutus-pic overlay-dark-m">
      
        <!-- Container -->
        <div class="container">     
          <!-- Section Title -->
          <div class="section-title invert-colors no-margin-b">
            <h2><font class="italiancustom" size="20">Corporate/ Wedding Events</font></h2>
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
	  
	  
	  <!-- Intro Block
      ============================================ -->
      <div class="intro-block mgb-20">
      
        <!-- Container -->
        <div class="container">

          <!-- Slider Wrapper -->
          <div class="intro-slider">
          
            <!-- BxSlider -->
            <div class="bxslider" data-call="bxslider" data-options="{pager:true, mode:'fade'}">
            
              <!-- Slide -->
              <div class="slide">
                <img class="img-main" src="admin/<?echo $company1;?>" style="width:100%; height:433px;" alt=""/><!-- slider image + background -->
              </div>
              <!-- /Slide -->
              
              <!-- Slide -->
              <div class="slide">
                <img class="img-main" src="admin/<?echo $company2;?>" style="width:100%; height:433px; "alt=""/><!-- slider image + background -->

                <!-- Text -->
                <div class="text">
                  <div class="vcenter">

                  </div>
                </div>
                <!-- /Text -->
              </div>
              <!-- /Slide -->
              
              <!-- Slide -->
              <div class="slide">
                <img class="img-main" src="admin/<?echo $company3;?>" style="width:100%; height:433px;" alt=""/><!-- slider image + background -->
                <!-- Text -->
                <div class="text">
                  <div class="vcenter">
                  </div>
                </div>
                <!-- /Text -->
              </div>
              <!-- /Slide -->
            
            </div>
            <!-- /BxSlider -->
            
          </div>
          <!-- Slider Wrapper -->

        </div>
        <!-- /Container -->
      
      </div>
      <!-- /Intro Block
      ============================================ -->
	  
	  

      <!-- Content Block
      ============================================-->
		
		<?echo $content;?>

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
    <!-- /JavaScript
    ================================================== -->
  </body>
</html>
