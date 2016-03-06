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
			$background = $value['background_news'];
	
	include('inc/header.php');
?>


        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">News Page Edit</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           News Table
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="news-table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>DATE</th>
											<th>TITLE</th>
											<th>IMAGE</th>
                                            <th>Content</th>
                                        </tr>
                                    </thead>
                                    <tbody>

										<?php
											//get rows query
											$query = mysql_query("SELECT * FROM news ORDER BY id DESC");
											
											//number of rows
											$rowCount = mysql_num_rows($query);
											
											if($rowCount > 0){ 
												while($row = mysql_fetch_assoc($query)){ 
													$news_id = 	$row['id'];
													$news_url = 	$row['pic'];
													$news_title = 	$row['title'];
													$news_content = 	$row['content'];
													$news_date = 	$row['date'];
											?>
												        <tr>
															<td><?echo $news_id;?></td>
															<td><?echo $news_date;?></td>
															<td><?echo $news_title;?></td>
															<td><img src="<?echo $news_url;?>" height="100px" width="100px"></td>
															<td><?echo $news_content?></td>
														</tr>
										<?php }

											}?>
										
                                        
                                    </tbody>
									
                                </table>
								
								<div class="col-lg-12" style="padding-bottom:25px;">

							   <b>Insert ID of Post to Delete:</b><br/>
							   
							   <form  action="postdelete.php" method="post" enctype="multipart/form-data">		
									<input class="form-control" type="text" name="post_id" id="post_id" placeholder="eg)1">
									<input class= "form-control btn-primary" type="submit" value="Delete Post" name="postdelete">
							   </form>
							   

							  </div>
							  
							  

								<div class="col-lg-12">
				               

							   <b>Insert New Post:</b><br/>
							   
							   <form  action="newsinsert.php" method="post" enctype="multipart/form-data">
									Insert a Picture! (If no picture is uploaded, default image will be used)
									<input class="form-control" type="file" name="fileToUpload" id="fileToUpload" placeholder="Give it a picture!">
									<input class="form-control" type="text" name="news_id" id="news_id" placeholder="Give it a Title!">
									<textarea class="form-control" id="message-text" name="message" rows="8" placeholder="Insert News Content..."></textarea>
									<input class= "form-control btn-primary" type="submit" value="Post!" name="news">
							   </form>
							   

							  </div><br>
							  	  
							  
							<div class=" col-lg-12 row">
								<div class="span4 collapse-group">
								  <h2>News Page Overlay Image:</h2><a id="image4btn" class="btn btn-primary" href="#">Open/Close</a></p>
								   <div class="collapse">
								   <div class="row">
								   <img  src="<?echo $background;?>" class="img-responsive" height="150px" width="50%">
								   <b>Use 1300x700 pixel image for the best look</b><br/>
								   <div class="col-lg-4">
								   <form  action="newsbackground.php" method="post" enctype="multipart/form-data">		
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
				
				
            </div>
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

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#news-table').DataTable({
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
