<? include('inc/connect.php'); ?>
<?php
    if (isset($_SESSION["user_login"])) {
        $username = $_SESSION['user_login'];
		if (ctype_alnum($username)) {
		//check user exists
		$sql = mysql_query("SELECT * FROM users WHERE username='$username'");
		$userCount = mysql_num_rows($sql); //Count the number of rows returned
        if ($userCount == 1) {
            while($row = mysql_fetch_array($sql)){ 
                 $id = $row["id"];
				 $firstname = $row['first_name'];
				 $lastname = $row['last_name'];
				 $email = $row['email'];
			}
		}
	}
	}
    else
    {
        header( 'Location: index.php' ) ;
    }

			$sql = mysql_query("SELECT * FROM menu");
			$value = mysql_fetch_array($sql);
			$background = $value['background'];
			$content = $value['pdf'];
			$content2 = $value['pdf2'];
			$content3 = $value['pdf3'];
			$content4 = $value['pdf4'];

	


	include('inc/header.php');
?>


        <div id="page-wrapper">
		<div class="col-lg-12">
            
                
                    <h1 class="page-header">Menu Page Edit</h1>
                
                <!-- /.col-lg-12 -->
            
			Make sure when uploading images and PDF the extension for is lowercase eg).jpg, .png, .pdf etc and NOT .JPG .PNG .PDF
            <!-- /.row -->
            <div class="row">
			<div class="span4 collapse-group">
			  <h2>Menu Page Overlay Image:</h2><a id="logobtn" class="btn btn-primary" href="#">Open/Close</a></p>
			   <div class="collapse">
			   <div class="row">
			   <img  src="<?echo $background;?>" class="img-responsive" height="150px" width="50%">
			   <b>Use 1300x700 pixel image for the best look</b><br/>
			   <div class="col-lg-4">
			   <form  action="menubackground.php" method="post" enctype="multipart/form-data">		
					<input class="form-control" type="file" name="fileToUpload" id="fileToUpload">
					<input class= "form-control btn-primary" type="submit" value="Upload Image" name="background">
			   </form>
			   </div>
			   </div><br>
			  
			   
			   </div>

			</div>

			
			<h2>Menus Upload:</h2>
				<ul class="nav nav-tabs">
				  <li><a data-toggle="tab" href="#brunch"><h4>Brunch</h4></a></li>
				  <li><a data-toggle="tab" href="#lunch"><h4>Lunch</h4></a></li>
				  <li><a data-toggle="tab" href="#dinner"><h4>Dinner</h4></a></li>
				  <li><a data-toggle="tab" href="#drinks"><h4>Drinks</h4></a></li>
				</ul>			

				<div class="tab-content">
				  <div id="brunch" class="tab-pane fade in active">
					<h3>Brunch</h3>
				   <iframe src="http://docs.google.com/gview?url=http://harthousewineandtapa.com/admin/<?echo $content;?>&embedded=true" style="width:100%; height:500px;" frameborder="0"></iframe><br/>
				   <div class="col-lg-4">
				   <form  action="menupdf.php" method="post" enctype="multipart/form-data">		
						<input class="form-control" type="file" name="fileToUpload" id="fileToUpload">
						<input class= "form-control btn-primary" type="submit" value="Upload Menu" name="menu">
				   </form>
				   </div><br>
				  </div>
				  <div id="lunch" class="tab-pane fade">
					<h3>Lunch</h3>
				   <iframe src="http://docs.google.com/gview?url=http://harthousewineandtapa.com/admin/<?echo $content2;?>&embedded=true" style="width:100%; height:500px;" frameborder="0"></iframe><br/>
				   <div class="col-lg-4">
				   <form  action="menupdf2.php" method="post" enctype="multipart/form-data">		
						<input class="form-control" type="file" name="fileToUpload" id="fileToUpload">
						<input class= "form-control btn-primary" type="submit" value="Upload Menu" name="menu">
				   </form>
				   </div><br>
				  </div>
				  <div id="dinner" class="tab-pane fade">
					<h3>Dinner</h3>
				   <iframe src="http://docs.google.com/gview?url=http://harthousewineandtapa.com/admin/<?echo $content3;?>&embedded=true" style="width:100%; height:500px;" frameborder="0"></iframe><br/>
				   <div class="col-lg-4">
				   <form  action="menupdf3.php" method="post" enctype="multipart/form-data">		
						<input class="form-control" type="file" name="fileToUpload" id="fileToUpload">
						<input class= "form-control btn-primary" type="submit" value="Upload Menu" name="menu">
				   </form>
				   </div><br>
				  </div>	
				  <div id="drinks" class="tab-pane fade">
					<h3>Drinks</h3>
				   <iframe src="http://docs.google.com/gview?url=http://harthousewineandtapa.com/admin/<?echo $content4;?>&embedded=true" style="width:100%; height:500px;" frameborder="0"></iframe><br/>
				   <div class="col-lg-4">
				   <form  action="menupdf4.php" method="post" enctype="multipart/form-data">		
						<input class="form-control" type="file" name="fileToUpload" id="fileToUpload">
						<input class= "form-control btn-primary" type="submit" value="Upload Menu" name="menu">
				   </form>
				   </div><br>
				  </div>				  
				</div>
				   

			</div>

        <!-- /#page-wrapper -->

		</div>
		</div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="bower_components/raphael/raphael-min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>

	<script>
	$('#image4btn').on('click', function(e) {
    e.preventDefault();
    var $this = $(this);
    var $collapse = $this.closest('.collapse-group').find('.collapse');
    $collapse.collapse('toggle');
	});
	</script>
	<script>
	$('#logobtn').on('click', function(e) {
    e.preventDefault();
    var $this = $(this);
    var $collapse = $this.closest('.collapse-group').find('.collapse');
    $collapse.collapse('toggle');
	});
	</script>
</body>

</html>
