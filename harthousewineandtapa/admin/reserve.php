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

			$sql = mysql_query("SELECT * FROM reserve");
			$value = mysql_fetch_array($sql);
			$background = $value['background'];
			
			$gift_sql = mysql_query("SELECT * FROM gift");
			$value2 = mysql_fetch_array($gift_sql);
			$background2 = $value2['background'];

	include('inc/header.php');
?>


        <div id="page-wrapper">
		<div class="col-lg-12">
            
                
            <h1 class="page-header">Reservation and Gift Voucher Page Edit</h1>
                
                <!-- /.col-lg-12 -->
            
			Make sure when uploading images and PDF the extension for is lowercase eg).jpg, .png, .pdf etc and NOT .JPG .PNG .PDF
            <!-- /.row -->
            <div class="row">
			<div class="span4 collapse-group">
			  <h2>Reservation Page Overlay Image:</h2><a id="logobtn" class="btn btn-primary" href="#">Open/Close</a></p>
			   <div class="collapse">
			   <div class="row">
			   <img  src="<?echo $background;?>" class="img-responsive" height="150px" width="50%">
			   <b>Use 1300x700 pixel image for the best look</b><br/>
			   <div class="col-lg-4">
			   <form  action="reservebackground.php" method="post" enctype="multipart/form-data">		
					<input class="form-control" type="file" name="fileToUpload" id="fileToUpload">
					<input class= "form-control btn-primary" type="submit" value="Upload Image" name="background">
			   </form>
			   </div>
			   </div><br>			   
			   </div>
			</div>
			</div>
        <!-- /#page-wrapper -->
            <div class="row">
			<div class="span4 collapse-group">
			  <h2>Gift Voucher Page Overlay Image:</h2><a id="gift_voucher" class="btn btn-primary" href="#">Open/Close</a></p>
			   <div class="collapse">
			   <div class="row">
			   <img  src="<?echo $background2;?>" class="img-responsive" height="150px" width="50%">
			   <b>Use 1300x700 pixel image for the best look</b><br/>
			   <div class="col-lg-4">
			   <form  action="giftbackground.php" method="post" enctype="multipart/form-data">		
					<input class="form-control" type="file" name="fileToUpload" id="fileToUpload">
					<input class= "form-control btn-primary" type="submit" value="Upload Image" name="background">
			   </form>
			   </div>
			   </div><br>			   
			   </div>
			</div>
			</div>		
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
	$('#logobtn').on('click', function(e) {
    e.preventDefault();
    var $this = $(this);
    var $collapse = $this.closest('.collapse-group').find('.collapse');
    $collapse.collapse('toggle');
	});
	</script>
	<script>
	$('#gift_voucher').on('click', function(e) {
    e.preventDefault();
    var $this = $(this);
    var $collapse = $this.closest('.collapse-group').find('.collapse');
    $collapse.collapse('toggle');
	});
	</script>
</body>

</html>
