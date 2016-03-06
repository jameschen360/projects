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
			$background = $value['background_gallery'];
	
	include('inc/header.php');
?>


        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Gallery Page Edit</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
				Make sure when uploading images and PDF the extension for is lowercase eg).jpg, .png, .pdf etc and NOT .JPG .PNG .PDF
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Gallery Image Table
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="gallery-table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>IMAGE</th>
                                            <th>TITLE</th>
                                        </tr>
                                    </thead>
                                    <tbody>

										<?php
											//get rows query
											$query = mysql_query("SELECT * FROM gallery ORDER BY id DESC");
											
											//number of rows
											$rowCount = mysql_num_rows($query);
											
											if($rowCount > 0){ 
												while($row = mysql_fetch_assoc($query)){ 
													$gallery_id = 	$row['id'];
													$gallery_url = 	$row['url'];
													$gallery_title = 	$row['title'];
											?>
												        <tr>
															<td><?echo $gallery_id;?></td>
															<td><img src="<?echo $gallery_url;?>" height="100px" width="100px"></td>
															<td><?echo $gallery_title;?></td>
														</tr>
										<?php }

											}?>
										
                                        
                                    </tbody>
									
                                </table>
								
								<div class="col-lg-12" style="padding-bottom:25px;">

							   <b>Insert ID of Image to Delete:</b><br/>
							   
							   <form  action="gallerydelete.php" method="post" enctype="multipart/form-data">		
									<input class="form-control" type="text" name="gallery_id" id="gallery_id" placeholder="eg)1">
									<input class= "form-control btn-primary" type="submit" value="Delete Image" name="gallerydelete">
							   </form>
							   

							  </div>
							  
							  

								<div class="col-lg-12">
				              

							   <b>Upload new Image to Gallery</b><br/>
							   
							   <form  action="galleryimage.php" method="post" enctype="multipart/form-data">		
									<input class="form-control" type="file" name="fileToUpload" id="fileToUpload">
									<input class="form-control" type="text" name="gallery_title" id="gallery_title" placeholder="Give it a Title!">
									<input class= "form-control btn-primary" type="submit" value="Upload to Gallery" name="gallery">
							   </form>
							   

							  </div><br>
							  	  
							  

							  				
									<div class=" col-lg-12 row">
									<div class="span4 collapse-group">
									  <h2>Gallery Page Overlay Image:</h2><a id="image4btn" class="btn btn-primary" href="#">Open/Close</a></p>
									   <div class="collapse">
									   <div class="row">
									   <img  src="<?echo $background;?>" class="img-responsive" height="150px" width="50%">
									   <b>Use 1300x700 pixel image for the best look</b><br/>
									   <div class="col-lg-4">
									   <form  action="gallerybackground.php" method="post" enctype="multipart/form-data">		
											<input class="form-control" type="file" name="fileToUpload" id="fileToUpload">
											<input class= "form-control btn-primary" type="submit" value="Upload Image" name="background">
									   </form>
									   </div>
									   </div><br>
									  
									   
									   </div>

									</div>	
										
									</div>
                            </div>
                            <!-- /.table-responsive -->

							
							
							
							
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
				

            <!-- /.row -->
           
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>

    <script>
    $(document).ready(function() {
        $('#gallery-table').DataTable({
                responsive: true
        });
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

</body>

</html>
