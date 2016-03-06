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

			$sql = mysql_query("SELECT * FROM contact");
			$value = mysql_fetch_array($sql);
			$address = $value['address'];
			$email = $value['email'];
			$phone = $value['phone'];

	


	include('inc/header.php');
?>


        <div id="page-wrapper">
		<div class="col-lg-12">
            
                
                    <h1 class="page-header">Contact Us Page Edit</h1>
                
                <!-- /.col-lg-12 -->
            
			<p>Make sure when uploading images and PDF the extension for is lowercase eg).jpg, .png, .pdf etc and NOT .JPG .PNG .PDF</p>
            <!-- /.row -->
            <div class="row">
			   
			   <div class="panel panel-default">
				  <div class="panel-heading"><b>Current Address Info (Please use HTML Tags to separate each line)</b></div>
				  <div class="panel-body">
						<?echo htmlspecialchars($address);?>
				  </div>
				</div>
					
				<form  action="address.php" id="form1" method="POST" enctype="multipart/form-data">		

					<label for="address" class="control-label">Change address:</label>
					<textarea class="form-control" id="address" name="address" rows="4" placeholder="<?echo htmlspecialchars($address);?>"></textarea>

							
			    </form>
				<button class="btn btn-primary" type="submit" form="form1" value="Submit">Update</button>
				
				
				<p></p><br/>
				 <div class="panel panel-default">
				  <div class="panel-heading"><b>Current Email Info (Please use HTML Tags to separate each line)</b></div>
				  <div class="panel-body">
						<?echo htmlspecialchars($email);?>
				  </div>
				</div>
					
				<form  action="email.php" id="form2" method="POST" enctype="multipart/form-data">		

					<label for="email" class="control-label">Change Email:</label>
					<textarea class="form-control" id="email" name="email" rows="4" placeholder="<?echo htmlspecialchars($email);?>"></textarea>

							
			    </form>
				<button class="btn btn-primary" type="submit" form="form2" value="Submit">Update</button>
				
				<p></p><br/>
				 <div class="panel panel-default">
				  <div class="panel-heading"><b>Current Phone Info (Please use HTML Tags to separate each line)</b></div>
				  <div class="panel-body">
						<?echo htmlspecialchars($phone);?>
				  </div>
				</div>
					
				<form  action="phone.php" id="form3" method="POST" enctype="multipart/form-data">		

					<label for="phone" class="control-label">Change Phone Number:</label>
					<textarea class="form-control" id="phone" name="phone" rows="4" placeholder="<?echo htmlspecialchars($phone);?>"></textarea>

							
			    </form>
				<button class="btn btn-primary" type="submit" form="form3" value="Submit">Update</button>
				<div style="padding-bottom:100px"></div>
				

			  

			
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
	
	
</body>

</html>
