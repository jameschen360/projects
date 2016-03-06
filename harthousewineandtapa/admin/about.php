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

			$sql = mysql_query("SELECT * FROM about");
			$value = mysql_fetch_array($sql);
			$background = $value['background'];
			$content = $value['content'];

	


	include('inc/header.php');
?>


        <div id="page-wrapper">
		<div class="col-lg-12">
            
                
                    <h1 class="page-header">About Us Page Edit</h1>
                
                <!-- /.col-lg-12 -->
            
		Make sure when uploading images and PDF the extension for is lowercase eg).jpg, .png, .pdf etc and NOT .JPG .PNG .PDF
            <!-- /.row -->
            <div class="row">
			<div class="span4 collapse-group">
			  <h2>About Us Page Overlay Image:</h2><a id="logobtn" class="btn btn-primary" href="#">Open/Close</a></p>
			   <div class="collapse">
			   <div class="row">
			   <img  src="<?echo $background;?>" class="img-responsive" height="150px" width="50%">
			   <b>Use 1300x700 pixel image for the best look</b><br/>
			   <div class="col-lg-4">
			   <form  action="aboutbackground.php" method="post" enctype="multipart/form-data">		
					<input class="form-control" type="file" name="fileToUpload" id="fileToUpload">
					<input class= "form-control btn-primary" type="submit" value="Upload Image" name="background">
			   </form>
			   </div>
			   </div><br>
			  
			   
			   </div>

			</div>

			

			
			<div class="span4 collapse-group">
			  <h2>About Us Content Text:</h2><a id="image4btn" class="btn btn-primary" href="#">Open/Close</a></p>
			   <div class="collapse">

			   
			   <div class="panel panel-default">
				  <div class="panel-heading"><b>Current About Us Info (Please use HTML Tags to separate each line)</b></div>
				  <div class="panel-body">
						<?echo htmlspecialchars($content);?>
				  </div>
				</div>
					
				<form  action="content.php" id="form1" method="POST" enctype="multipart/form-data">		

					<label for="message-text" class="control-label">Change Content:</label>
					<textarea class="form-control" id="message-text" name="message" rows="8" placeholder="<?echo htmlspecialchars($content);?>"></textarea>

							
			    </form>
				<button class="btn btn-primary" type="submit" form="form1" value="Submit">Update</button>
				

				
			   </div><br/>

			  
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
