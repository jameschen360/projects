      <?include('inc/header.php');?>
	  
	  <?
		$sql = mysql_query("SELECT * FROM home");
		$value = mysql_fetch_array($sql);
			$pic1 = $value['pic1'];
			$pic2 = $value['pic2'];
			$pic3 = $value['pic3'];
		
	  ?>
	  
	  
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
                <img class="img-main" src="<?echo "admin/$pic1";?>" alt=""/><!-- slider image + background -->
              </div>
              <!-- /Slide -->
              
              <!-- Slide -->
              <div class="slide">
                <img class="img-main" src="<?echo "admin/$pic2";?>" alt=""/><!-- slider image + background -->

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
                <img class="img-main" src="<?echo "admin/$pic3";?>" alt=""/><!-- slider image + background -->
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
