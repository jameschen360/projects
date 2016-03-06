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
	include('inc/header.php');
?>


        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Reservation Listings</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
				
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Reservation Table
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
							<b>First Table is New and Unconfirmed Reservations</b>
                                <table class="table table-striped table-bordered table-hover" id="reservation-no">
                                    <thead>
                                        <tr>
                                            <th>Position/ID</th>
                                            <th>NAME</th>
											<th>Phone</th>
											<th>Email</th>
                                            <th>People</th>
											<th>DATE</th>
											<th>TIME</th>
											<th>REQUEST COMMENT</th>
                                        </tr>
                                    </thead>
                                    <tbody>

										<?php
											//get rows query
											$query = mysql_query("SELECT * FROM reservation WHERE isconfirmed='no'");
											
											//number of rows
											$rowCount = mysql_num_rows($query);
											
											if($rowCount > 0){ 
												while($row = mysql_fetch_assoc($query)){ 
													$res_id = 	$row['id'];
													$res_name = 	$row['name'];
													$res_number = 	$row['number'];
													$res_email = 	$row['email'];
													$res_people = 	$row['people'];
													$res_date = 	$row['date'];
													$res_time = 	$row['time'];
													$res_comment = 	$row['comment'];
											?>
												        <tr>
															<td><?echo $res_id;?></td>
															<td><?echo $res_name;?></td>
															<td><?echo $res_number;?></td>
															<td><?echo $res_email;?></td>
															<td><?echo $res_people;?></td>
															<td><?echo $res_date;?></td>
															<td><?echo $res_time;?></td>
															<td><?echo $res_comment;?></td>>

														</tr>
										<?php }

											}?>
										
                                        
                                    </tbody>
									
                                </table>
								
								
								<div class="dataTable_wrapper">
								<b>Second table is for confirmed reservations</b>
                                <table class="table table-striped table-bordered table-hover" id="reservation-yes">
                                    <thead>
                                        <tr>
                                            <th>Position/ID</th>
                                            <th>NAME</th>
											<th>Phone</th>
											<th>Email</th>
                                            <th>People</th>
											<th>DATE</th>
											<th>TIME</th>
											<th>REQUEST COMMENT</th>
											<th>Confirmed?</th>
											<th>Action By</th>
                                        </tr>
                                    </thead>
                                    <tbody>

										<?php
											//get rows query
											$query = mysql_query("SELECT * FROM reservation WHERE isconfirmed='yes'");
											
											//number of rows
											$rowCount = mysql_num_rows($query);
											
											if($rowCount > 0){ 
												while($row = mysql_fetch_assoc($query)){ 
													$res_id = 	$row['id'];
													$res_name = 	$row['name'];
													$res_number = 	$row['number'];
													$res_email = 	$row['email'];
													$res_people = 	$row['people'];
													$res_date = 	$row['date'];
													$res_time = 	$row['time'];
													$res_comment = 	$row['comment'];
													$res_confirm = 	$row['isconfirmed'];
													$res_action = 	$row['action'];
											?>
												        <tr>
															<td><?echo $res_id;?></td>
															<td><?echo $res_name;?></td>
															<td><?echo $res_number;?></td>
															<td><?echo $res_email;?></td>
															<td><?echo $res_people;?></td>
															<td><?echo $res_date;?></td>
															<td><?echo $res_time;?></td>
															<td><?echo $res_comment;?></td>
															<td><?echo $res_confirm;?></td>
															<td><?echo $res_action?></td>

														</tr>
										<?php }

											}?>
										
                                        
                                    </tbody>
									
                                </table>
							  
							  
                            </div>
                            <!-- /.table-responsive -->

														<div class="col-lg-6" style="padding:15px;">

							   <b>Confirm Guests by ID:</b><br/>
							   
							   <form  action="confirm.php" method="post" enctype="multipart/form-data">		
									<div class="row">
									<input class="form-control" type="text" name="confirm_status" id="confirm_status" placeholder="eg)1">
									<input class= "form-control btn-primary" type="submit" value="Confirm" name="confirm">
									</div>
							   </form>
							   

							  </div>
							  <div class="col-lg-6" style="padding:15px;">

							   <b>Delete Reservation by ID:</b><br/>
							   
							   <form  action="reservationdelete.php" method="post" enctype="multipart/form-data">		
									<div class="row">
									<input class="form-control" type="text" name="delete_status" id="delete_status" placeholder="eg)1">
									<input class= "form-control btn-primary" type="submit" value="Delete" name="delete">
									</div>
							   </form>
							   

							  </div>	
							
							
							
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
        $('#reservation-no').DataTable({
                responsive: true
        });
    });
    </script>
	<script>
    $(document).ready(function() {
        $('#reservation-yes').DataTable({
                responsive: true
        });
    });
    </script>

</body>

</html>
