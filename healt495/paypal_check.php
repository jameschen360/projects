<?
include('inc/db.php');
$user_id = $_SESSION['login_user'];
$user_email = mysqli_query($db, "SELECT * FROM customer WHERE id='$user_id'");
	$user_result = mysqli_fetch_assoc($user_email);
	$user_fname = $user_result['first_name'];
	$user_email = $user_result['email'];
include('inc/header.php');

$txn_id = $_GET['tx'];

$check_txn=mysqli_query($db, "SELECT * FROM order_id WHERE token = '$txn_id'");
$check_row = mysqli_num_rows($check_txn);
if ($check_row == 0 ) {?>
<!-- main-container start -->
			<!-- ================ -->
			<section class="main-container">

				<div class="container">
					<div class="row">

						<!-- main start -->
						<!-- ================ -->
						<div class="main col-md-8 col-md-offset-2">

							<!-- page-title start -->
							<!-- ================ -->
							<h1 class="page-title text-center">Error! <i class="fa fa-frown-o pl-10"></i></h1>
							<div class="separator"></div>
							<!-- page-title end -->
							<p class="lead text-center">If you have just placed an order, please refresh this page.</p>
						</div>							
						<!-- main end -->

					</div>

							<p class="text-center">
								<a href="myaccount.php" class="btn btn-default btn-lg">My Account</a>	
							</p><br/><br/><br/><br/><br/><br/><br/><br/><br/>
				</div>
			</section>
			<!-- main-container end -->
<?}else {
$user_email = mysqli_query($db, "SELECT * FROM customer WHERE id='$user_id'");
	$user_email = mysqli_fetch_assoc($user_email);
	$zh = $user_email['zh'];
	$first_name = $user_email['first_name'];
	$last_name = $user_email['last_name'];
	$user_email = $user_email['email'];	
	$order_sql = mysqli_query($db, "SELECT * FROM order_id WHERE token='$txn_id'");
	$order_sql = mysqli_fetch_assoc($order_sql);
	$email = $order_sql['user'];
	$bname = $order_sql['bname'];
	$sname = $order_sql['sname'];
	$bemail = $order_sql['bemail'];
	$semail = $order_sql['semail'];
	$btel = $order_sql['btel'];
	$stel = $order_sql['stel'];
	$baddress = $order_sql['baddress'];
	$saddress = $order_sql['saddress'];
	$total = $order_sql['total'];
	$is_shipping = $order_sql['is_same_shipping'];
	$comment = $order_sql['comment'];
	$invoice = $order_sql['invoice'];
								if ($zh == "yes") {
									$bname = "$last_name$first_name";
								}else {
									$bname = $bname;
								}	
	?>

			<!-- main-container start -->
			<!-- ================ -->
			<section class="main-container">

				<div class="container">
					<div class="row">

						<!-- main start -->
						<!-- ================ -->
						<div class="main col-md-8 col-md-offset-2">

							<!-- page-title start -->
							<!-- ================ -->
							<h1 class="page-title text-center">Payment Complete. Thank You <i class="fa fa-smile-o pl-10"></i></h1>
							<div class="separator"></div>
							<!-- page-title end -->
							<p class="lead text-center">You can check the status of your order and details in your <a href="myaccount.php">account order</a> page</p>


						</div>
						<?
							
							if ($is_shipping == "true") {?>
							<table class="table">
								<thead>
									<tr>
										<th colspan="2">Billing/Shipping Information </th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Full Name</td>
										<td class="information"><?echo $bname?></td>
									</tr>
									<tr>
										<td>Email</td>
										<td class="information"><?echo $bemail?></td>
									</tr>
									<tr>
										<td>Telephone</td>
										<td class="information"><?echo $btel?></td>
									</tr>
									<tr>
										<td>Address</td>
										<td class="information"><?echo $baddress?></td>
									</tr>
									<tr>
										<td>Additional Info</td>
										<td class="information"><?echo $comment?></td>
									</tr>
									<tr>
										<td>Total</td>
										<td class="information">$<?echo number_format($total,2);?></td>
									</tr>									
								</tbody>
							</table>
							<div class="space-bottom"></div>								
						<?	}else {?>
							<table class="table">
								<thead>
									<tr>
										<th colspan="2">Billing Information </th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Full Name</td>
										<td class="information"><?echo $bname?></td>
									</tr>
									<tr>
										<td>Email</td>
										<td class="information"><?echo $bemail?></td>
									</tr>
									<tr>
										<td>Telephone</td>
										<td class="information"><?echo $btel?></td>
									</tr>
									<tr>
										<td>Address</td>
										<td class="information"><?echo $baddress?></td>
									</tr>
									<tr>
										<td>Additional Info</td>
										<td class="information"><?echo $comment?></td>
									</tr>
									<tr>
										<td>Total</td>
										<td class="information">$<?echo number_format($total,2);?></td>
									</tr>										
								</tbody>
							</table>
							<div class="space-bottom"></div>
							<table class="table">
								<thead>
									<tr>
										<th colspan="2">Shipping Information </th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Full Name</td>
										<td class="information"><?echo $sname?> </td>
									</tr>
									<tr>
										<td>Email</td>
										<td class="information"><?echo $semail?> </td>
									</tr>
									<tr>
										<td>Telephone</td>
										<td class="information"><?echo $stel?></td>
									</tr>
									<tr>
										<td>Address</td>
										<td class="information"><?echo $saddress?></td>
									</tr>
								</tbody>
							</table>							
						<?}
						
						?>
							
						<!-- main end -->
						<p>Please allow 2-3 business days for your order to be shipped!</p>
							<p class="text-center">
								<a href="order.php?order_id=<?echo $invoice?>" class="btn btn-default btn-lg">View Order <?echo $invoice?></a>	
							</p>
					</div>
				</div>
			</section>
			<!-- main-container end -->

	
<?}

?>
		
<?include("inc/footer.php");?>
<?include("inc/scripts.php");?>