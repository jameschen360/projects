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
				 $auth = $row['auth'];
				 $name = "$firstname $lastname";
			}
		}
	}
	}
    else
    {
        header( 'Location: index.php' ) ;
    }
	
	
	include('inc/header.php');
	
	$sql = mysql_query("SELECT isconfirmed FROM reservation WHERE isconfirmed='no'");
	$number = mysql_num_rows($sql);
	$gift_sql = mysql_query("SELECT payment_status FROM giftcert WHERE payment_status='Completed'");
	$number_card = mysql_num_rows($gift_sql);
?>


        <div id="page-wrapper">
		
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">This is HHWT's Dashboard</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?echo $number;?></div>
                                    <div>New Reservations</div>
                                </div>
                            </div>
                        </div>
                        <a href="request.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
               
			</div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-dollar fa-5x"></i>
                                </div>
                                <div class="col-xs-6">
                                    <div id="balancemsg"></div><br>
                                </div>								
                                <div class="col-xs-3 text-right">
                                    <div class="huge"><?echo $number_card;?></div>
                                    <div>Active Gift Cards</div>
                                </div>
                            </div>
                        </div>
                            <div class="panel-footer">
								
								<div class="row">
											<form class="contact" name="contact">
											  <div class="form-group col-lg-6">
												<label for="card_balance" class="control-label">Gift Voucher Code:</label>
												<input type="text" class="form-control text-center col-xs-9" id="code" name="code" placeholder="XXXX-XXXX-XXXX-XXXX" style="text-transform: uppercase;" required="true" style="margin:50px;">
											  </div>
											  <div class="form-group col-lg-6">
												<label for="card_balance" class="control-label">Bill Total ($):</label>
												<input type="text" class="form-control text-center col-xs-9" id="amount" name="amount" placeholder="To Check Balance, Leave as 0 or blank" style="text-transform: uppercase;" required="true" style="margin:50px;">
											  </div>	
												<input type="hidden" name="name" id="name" value="<? echo $name;?>">
											</form>
											<br>
											<center><input id="btn" type="button" class="btn btn-danger" value="Process Transaction" style="margin:20px;">
											<p><b>Refresh this page to enable button again</b></p></center>
								</div>								
								
								
                            <div class="clearfix"></div>
                            </div>
                    </div>
                </div>  
			</div>	
			
	<?if ($auth == 1) {?>
			<div class="panel panel-success">
			  <div class="panel-heading">
				<h3 class="panel-title">Gift Card Transaction History</h3>
			  </div>
			  <div class="panel-body">
				                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="transaction">
                                    <thead>
                                        <tr>
                                            <th>Gift Code</th>
                                            <th>Amount Deducted</th>
											<th>Action By</th>
											<th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>

										<?php
											//get rows query
											$query = mysql_query("SELECT * FROM transaction");
											
											//number of rows
											$rowCount = mysql_num_rows($query);
											
											if($rowCount > 0){ 
												while($row = mysql_fetch_assoc($query)){ 
													$trans_gift_code = 	$row['gift_code'];
													$trans_amount = 	$row['amount'];
													$trans_action = 	$row['action_by'];
													$trans_date = 	$row['date'];
											?>
												        <tr>
															<td><?echo$trans_gift_code;?></td>
															<td>$<?echo $trans_amount;?></td>
															<td><?echo $trans_action;?></td>
															<td><?echo $trans_date?></td>
														</tr>
										<?php }

											}?>
										
                                        
                                    </tbody>
									
                                </table>
							  
                            </div>
			  </div>
			</div>
	<?}?>

		
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
	
	<script src="../js_custom/text.js"></script>

	<script src="../js_custom/trans.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="bower_components/raphael/raphael-min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>
    <!-- DataTables JavaScript -->
    <script src="bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
	<script>
		jQuery(function($){
			   $("#code").mask("aaaa-aa99-99aa-9999");
		});
	</script>
    <script>
    $(document).ready(function() {
        $('#transaction').DataTable({
                responsive: true
        });
    });
    </script>

</body>

</html>
