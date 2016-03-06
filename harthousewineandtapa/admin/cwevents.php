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

			$sql = mysql_query("SELECT * FROM cwevents");
			$value = mysql_fetch_array($sql);
			$content = $value['content'];
			$company1 = $value['company1'];
			$company2 = $value['company2'];
			$company3 = $value['company3'];
	


	include('inc/header.php');
?>


        <div id="page-wrapper">
		<div class="col-lg-12">
            
                
        <h1 class="page-header">CW Events Page Edit</h1>
		
            <div class="row">
			   				
			<h2>Associated Company Pictures:</h2>
			<strong>Make sure to ONLY use 1100px by 433px images!</strong>
				<ul class="nav nav-tabs">
				  <li class="active"><a data-toggle="tab" href="#1"><h4>Company 1</h4></a></li>
				  <li><a data-toggle="tab" href="#2"><h4>Company 2</h4></a></li>
				  <li><a data-toggle="tab" href="#3"><h4>Company 3</h4></a></li>
				</ul>			

				<div class="tab-content">
				  <div id="1" class="tab-pane fade in active">
					<h3>Company 1</h3>
				   <img src="<?echo $company1;?>" style="width:1100px; height:433px;"><br/>
				   <div class="col-lg-4">
				   <form  action="company1.php" method="post" enctype="multipart/form-data">		
						<input class="form-control" type="file" name="fileToUpload" id="fileToUpload">
						<input class= "form-control btn-primary" type="submit" value="Upload Pic" name="company">
				   </form>
				   </div><br>
				  </div>
				  <div id="2" class="tab-pane fade">
					<h3>Company 2</h3>
				   <img src="<?echo $company2;?>" style="width:1100px; height:433px;"><br/>
				   <div class="col-lg-4">
				   <form  action="company2.php" method="post" enctype="multipart/form-data">		
						<input class="form-control" type="file" name="fileToUpload" id="fileToUpload">
						<input class= "form-control btn-primary" type="submit" value="Upload Pic" name="company">
				   </form>
				   </div><br>
				  </div>
				  <div id="3" class="tab-pane fade">
					<h3>Company 3</h3>
				   <img src="<?echo $company3;?>" style="width:1100px; height:433px;"><br/>
				   <div class="col-lg-4">
				   <form  action="company3.php" method="post" enctype="multipart/form-data">		
						<input class="form-control" type="file" name="fileToUpload" id="fileToUpload">
						<input class= "form-control btn-primary" type="submit" value="Upload Pic" name="company">
				   </form>
				   </div><br>
				  </div>				  
				</div>
			</div>   <hr>            
           
        <!-- /.row -->
            <div class="row">
			   				
				<form  action="cwcontent.php" id="form1" method="POST" enctype="multipart/form-data">		

					<label for="cwcontent" class="control-label">Make Changes:(Please carefully edit thoroughly then update!)</label>
					<textarea class="form-control" id="cwcontent" name="cwcontent" rows="100"><?echo htmlspecialchars($content);?></textarea>		
			    </form>
				<button class="btn btn-primary" type="submit" form="form1" value="Submit">Update</button>	
			</div><hr>

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
