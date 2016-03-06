	<?
	include('inc/header.php');//includes logo and navigation
	?>
    <?
	   $sql = mysql_query("SELECT * FROM menu");
	   $value = mysql_fetch_array($sql);
			$menu_pic = $value['background'];//background url for about us
			$brunch = $value['pdf'];
			$lunch = $value['pdf2'];
			$dinner = $value['pdf3'];
			$drinks = $value['pdf4'];
	?>
	<style>
	.menu-pic {
		background: url("admin/<? echo $menu_pic; ?>") no-repeat center 0 fixed;
	}
	</style>
      <!-- Intro Block
      ============================================-->
      <section class="intro-block intro-page boxed-section menu-pic overlay-dark-m">
      
        <!-- Container -->
        <div class="container">     
          <!-- Section Title -->
          <div class="section-title invert-colors no-margin-b">
            <h2><font class="italiancustom" size="20">Our Menu</font></h2>
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
      ============================================ -->
      <div class="content-block">
      
        <!-- Container -->
        <div class="container no-pad-t">
		
		          <!-- Product Tabs -->
          <div class="product-tabs">

            <!-- Nav tabs -->
            <ul class="nav nav-tabs nav-tabs-line-bottom line-pcolor nav-tabs-center case-u" role="tablist">
              <li class="active"><a href="#brunch" data-toggle="tab">Brunch</a></li>
			  <li><a href="#lunch" data-toggle="tab">Lunch</a></li>
			  <li><a href="#dinner" data-toggle="tab">Dinner</a></li>
              <li><a href="#drinks" data-toggle="tab">Drinks</a></li>
            </ul>
            <!-- /Nav Tabs -->

            <!-- Tab panes -->
            <div class="tab-content tab-no-borders">
            
              <!-- brunch tab -->
              <div class="tab-pane active" id="brunch">
              
				<div class="row">
				<div class="col-lg-12">
				<iframe src="http://docs.google.com/gview?url=http://harthousewineandtapa.com/admin/<?echo $brunch;?>&embedded=true" style="width:100%; height:500px;" frameborder="0"></iframe> 
				</div>
				</div>
              
              </div>
              <!-- brunch tab -->
              
              <!-- lunch tab -->
              <div class="tab-pane" id="lunch">
			  
              <div class="row">
			  <div class="col-lg-12">
			   <iframe src="http://docs.google.com/gview?url=http://harthousewineandtapa.com/admin/<?echo $lunch;?>&embedded=true" style="width:100%; height:500px;" frameborder="0"></iframe>
			  </div>
			  </div>
              
              </div>
              <!-- /lunch tab -->
			  
              <!-- dinner tab -->
              <div class="tab-pane" id="dinner">
			  
              <div class="row">
			  <div class="col-lg-12">
			   <iframe src="http://docs.google.com/gview?url=http://harthousewineandtapa.com/admin/<?echo $dinner;?>&embedded=true" style="width:100%; height:500px;" frameborder="0"></iframe>
			  </div>
			  </div>
              
              </div>
              <!-- /dinner tab -->			  

              <!-- drinks tab -->
              <div class="tab-pane" id="drinks">
			  
              <div class="row">
			  <div class="col-lg-12">
			   <iframe src="http://docs.google.com/gview?url=http://harthousewineandtapa.com/admin/<?echo $drinks;?>&embedded=true" style="width:100%; height:500px;" frameborder="0"></iframe>
			  </div>
			  </div>
              
              </div>
              <!-- /drinks tab -->				  
              
            </div>
            <!-- /Tab Panes -->
            
          </div>
          <!-- /Product Tabs -->
          
        </div>
        <!-- /Container -->
        
      </div>
      <!-- /Content Block
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
