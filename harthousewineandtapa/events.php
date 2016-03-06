	<?
	include('inc/header.php');//includes logo and navigation
	
	?>
    <?
	   $sql = mysql_query("SELECT * FROM home");
	   $value = mysql_fetch_array($sql);
			$aboutus_pic = $value['background_news'];
			$content = $value['content'];
	   
	?>
	<style>
	.aboutus-pic {
		background: url("admin/<? echo $aboutus_pic; ?>") no-repeat center 0 fixed;
	}
	</style>
      <!-- Intro Block
      ============================================-->
      <section class="intro-block intro-page boxed-section aboutus-pic overlay-dark-m">
      
        <!-- Container -->
        <div class="container">     
          <!-- Section Title -->
          <div class="section-title invert-colors no-margin-b">
            <h2><font class="italiancustom" size="20">Events</font></h2>
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

            <!-- Main Col -->
            <div class="main-col">
            
              <!-- Post -->
              <article class="blog-entry text-center">

                <iframe src="https://calendar.google.com/calendar/embed?src=88vbltu5unsnkkfkkni5348fqs%40group.calendar.google.com&ctz=America/Edmonton" style="border: 0" width="100%" height="750" frameborder="0" scrolling="no"></iframe>

              </article>
              <!-- Post /END -->
              
              
            <!-- /Main Col -->

          </div>
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
    <!-- /JavaScript
    ================================================== -->
  </body>
</html>
