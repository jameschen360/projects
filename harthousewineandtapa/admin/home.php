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

			$sql = mysql_query("SELECT * FROM home");
			$value = mysql_fetch_array($sql);
			$pic1 = $value['pic1'];
			$pic2 = $value['pic2'];
			$pic3 = $value['pic3'];
			$logo = $value['logo'];
			$logosmall = $value['logosmall'];
			$logobottom = $value['logobottom'];
			$hours = $value['hours'];
			$facebook = $value['facebook'];
			$instagram = $value['insta'];
			$twitter = $value['twitter'];
	


	include('inc/header.php');
?>


        <div id="page-wrapper">
		<div class="col-lg-12">
            
                
                    <h1 class="page-header">Home Page Edit</h1>
                
                <!-- /.col-lg-12 -->
            
			Make sure when uploading images and PDF the extension for is lowercase eg).jpg, .png, .pdf etc and NOT .JPG .PNG .PDF
            <!-- /.row -->
            <div class="row">
			<div class="span4 collapse-group">
			  <h2>Logos:</h2><a id="logobtn" class="btn btn-primary" href="#">Open/Close</a></p>
			   <div class="collapse">
			   <div class="row">
			   <b>Logo:</b>
			   <img  src="<?echo $logo;?>" class="img-responsive" height="150px" width="50%">
			   
			   <div class="col-lg-4">
			   <form  action="logo.php" method="post" enctype="multipart/form-data">		
					<input class="form-control" type="file" name="fileToUpload" id="fileToUpload">
					<input class= "form-control btn-primary" type="submit" value="Upload Image" name="logo">
			   </form>
			   </div>
			   </div><br>
			   
			   <div class="row">
			   <b>Mobile Logo:</b>
			   <img  src="<?echo $logosmall;?>" class="img-responsive" height="20px" width="50%">
			   
			   <div class="col-lg-4">
			   <form  action="logosmall.php" method="post" enctype="multipart/form-data">		
					<input class="form-control" type="file" name="fileToUpload" id="fileToUpload">
					<input class= "form-control btn-primary" type="submit" value="Upload Image" name="logosmall">
			   </form>
			   </div>
			   </div><br>
			   
			   
			   <div class="row">
			   <b>Logo Footer:</b>
			   <img  src="<?echo $logobottom;?>" class="img-responsive" height="150px" width="50%">
			   
			   <div class="col-lg-4">
			   <form  action="logobottom.php" method="post" enctype="multipart/form-data">		
					<input class="form-control" type="file" name="fileToUpload" id="fileToUpload">
					<input class= "form-control btn-primary" type="submit" value="Upload Image" name="logobottom">
			   </form>
			   </div>
			   </div><br>
			   
			   </div>

			</div>

			<div class="span4 collapse-group">
			
			  <h2>Big Slider Image 1:</h2><a id="image1btn" class="btn btn-primary" href="#">Open/Close</a></p>
			   <div class="collapse">
			   <img  src="<?echo $pic1;?>" class="img-responsive" height="50%" width="50%">
			   This is what the first picture looks like on front page!
			   <p><b>Use 1140x750 pixel image for the best look</b></p>
			   <div class="row">
			   <div class="col-lg-4">
			   <form  action="home1pic.php" method="post" enctype="multipart/form-data">		
					<input class="form-control" type="file" name="fileToUpload" id="fileToUpload">
					<input class= "form-control btn btn-primary"type="submit" value="Upload Image" name="submit1">
			   </form>
			   </div>
			   </div><br/>

			</div>
			</div>
			
			<div class="span4 collapse-group">
			  <h2>Big Slider Image 2:</h2><a id="image2btn" class="btn btn-primary" href="#">Open/Close</a></p>
			   <div class="collapse">
			   <img  src="<?echo $pic2;?>" class="img-responsive" height="50%" width="50%">
			   This is what the first picture looks like on front page!
			   <p><b>Use 1140x750 pixel image for the best look</b></p>
			   <div class="row">
			   <div class="col-lg-4">
			   <form  action="home2pic.php" method="post" enctype="multipart/form-data">		
					<input class="form-control" type="file" name="fileToUpload" id="fileToUpload">
					<input class= "form-control btn btn-primary"type="submit" value="Upload Image" name="submit2">
			   </form>
			   </div>
			   </div>
			   </div>
			  
			</div>
			
			<div class="span4 collapse-group">
			  <h2>Big Slider Image 3:</h2><a id="image3btn" class="btn btn-primary" href="#">Open/Close</a></p>
			   <div class="collapse">
			   <img  src="<?echo $pic3;?>" class="img-responsive" height="50%" width="50%">
			   This is what the first picture looks like on front page!
			   <p><b>Use 1140x750 pixel image for the best look</b></p>
			   <div class="row">
			   <div class="col-lg-4">
			   <form  action="home3pic.php" method="post" enctype="multipart/form-data">		
					<input class="form-control" type="file" name="fileToUpload" id="fileToUpload">
					<input class= "form-control btn btn-primary"type="submit" value="Upload Image" name="submit3">
			   </form>
			   </div>
			   </div>
			   </div>

			</div>
			
			<div class="span4 collapse-group">
			  <h2>Footer Stuffs:</h2><a id="image4btn" class="btn btn-primary" href="#">Open/Close</a></p>
			   <div class="collapse">

			   
			   <div class="panel panel-default">
				  <div class="panel-heading"><b>Current Hours Info (Please use HTML Tags to separate each line)</b></div>
				  <div class="panel-body">
						<?echo htmlspecialchars($hours);?>
				  </div>
				</div>
					
				<form  action="hours.php" id="form1" method="POST" enctype="multipart/form-data">		

					<label for="message-text" class="control-label">Change Hours:</label>
					<textarea class="form-control" id="message-text" name="message" rows="8" placeholder="<?echo htmlspecialchars($hours);?>"></textarea>

							
			    </form>
				<button class="btn btn-primary" type="submit" form="form1" value="Submit">Update</button>
				
				
				<p></p><br/>
				<div class="panel panel-default">
				  <div class="panel-heading"><b>Current Social Media Links</b></div>
				  <div class="panel-body">
				  <ul class="list-group">
						<li class="list-group-item"><b>Facebook:</b> <?echo $facebook;?></li>
						<li class="list-group-item"><b>Instagram:</b> <?echo $instagram;?></li>
						<li class="list-group-item"><b>Twitter:</b> <?echo $twitter;?></li>
				  </ul>
				  </div>
				</div>
					
				<form  action="social.php" id="form2" method="POST" enctype="multipart/form-data">		

					<label for="sel1" class="control-label">Change Social Links (If NONE put: #):</label>
								  <select class="form-control" id="sel1" name="sel1">
									<option>Facebook</option>
									<option>Instagram</option>
									<option>Twitter</option>
								  </select>
					<input class="form-control" id="social_text" name="social">

							
			    </form>
				<button class="btn btn-primary" type="submit" form="form2" value="Submit">Update</button>
				
				
			   </div><br/>
			  <p>
			  
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
	$('#image1btn').on('click', function(e) {
    e.preventDefault();
    var $this = $(this);
    var $collapse = $this.closest('.collapse-group').find('.collapse');
    $collapse.collapse('toggle');
	});
	</script>
	<script>
	$('#image2btn').on('click', function(e) {
    e.preventDefault();
    var $this = $(this);
    var $collapse = $this.closest('.collapse-group').find('.collapse');
    $collapse.collapse('toggle');
	});
	</script>
	<script>
	$('#image3btn').on('click', function(e) {
    e.preventDefault();
    var $this = $(this);
    var $collapse = $this.closest('.collapse-group').find('.collapse');
    $collapse.collapse('toggle');
	});
	</script>
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
