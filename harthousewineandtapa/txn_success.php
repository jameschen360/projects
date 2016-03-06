<?
	include('inc/header.php');//includes logo and navigation
?>
<?
	   $sql = mysql_query("SELECT * FROM gift");
	   $value = mysql_fetch_array($sql);
	   $reserve_pic = $value['background'];//background url for about us
	   
	   $contact = mysql_query("SELECT * FROM contact");
	   $value2 = mysql_fetch_array($contact);
	   $contact = $value2['email'];
	   
	   $txn_id_url = $_GET['tx'];
	   $gift_process = mysql_query("SELECT * FROM giftcert WHERE txn_id='$txn_id_url'");
	   while($row = mysql_fetch_array($gift_process)){ 
			$amount = $row["mc_gross"];
			$gift_code = $row["gift_code"];
			$txn_id_db = $row["txn_id"];
			$status = $row["payment_status"];
			$theiremail = $row["reciever_email"];
			$youremail = $row["payer_email"];
        }
	   if ($status == "Pending"){
		$case = "pending";   
	   } elseif ($status == "Completed") {
		$case = "completed";    
	   } else {
		$case = "error";    
	   }  
?>
	<style>
	.reserve-pic {
		background: url("admin/<? echo $reserve_pic; ?>") no-repeat center 0 fixed;
	}
	</style>
      <!-- Intro Block
      ============================================-->
      <section class="intro-block intro-page boxed-section reserve-pic overlay-dark-m">
      
        <!-- Container -->
        <div class="container">     
          <!-- Section Title -->
          <div class="section-title invert-colors no-margin-b">
            <h2><font class="italiancustom" size="20">Gift Voucher</font></h2>
          </div>
          <!-- /Section Title -->
        </div>
        <!-- /Container -->
      
      </section>
      <!-- /Intro Block
      ============================================-->
      
      <!-- Page Info Block
      ============================================-->
      <section class="page-info-block boxed-section">
        <!-- Container -->
        <div class="container cont-pad-x-15"> 
          <!-- Breadcrumb -->
          <ol class="breadcrumb pull-left">
          </ol>
          <!-- /Breadcrumb --> 
        </div>
        <!-- /Container -->
      
      </section>
      <!-- /Page Info  Block
      ============================================-->
      
      <!-- Content Block
      ============================================-->
      <section class="content-block default-bg">
		<?
			if($case == "completed") { ?>
	
			    <!-- Container -->
				<div class="container cont-pad-t-sm">
					<div class="box pull-left" style="margin-bottom:25px;">
						<div class="ribbon"><span>Voucher</span></div>
					  <div class="panel-body text-center">
				
					<!-- Row -->
					<div class="row">
					<!-- Main Col -->
					<div class="main-col">
					<h1>Hart House Wine and Tapa</h1><br>
					<h3>Gift Voucher of <b><i>$<?echo $amount;?></i></b> CAD</h3>
					<h4><?echo $gift_code;?></h4>
					<p><img alt="<?echo $gift_code;?>" src="services/barcode.php?codetype=Code128&size=50&text=<?echo $gift_code;?>" /></p>
					<p><br/>An email of the receipt is sent to <b><i><?echo $youremail?></i></b>. The electronic gift voucher code is sent to <b><i><?echo $theiremail?></i></b><br>Thank you for purchasing a gift voucher!</p>
					</div><br/>
				<!-- /Container -->

				    </div>
					</div>
					</div>
					</div>
				
		<?	} elseif ($case == "pending") {?>
			
			<!-- Container -->
				<div class="container cont-pad-t-sm">
					<div class="box pull-left" style="margin-bottom:25px;">
						<div class="ribbon"><span>Voucher</span></div>
					  <div class="panel-body text-center">
				
					<!-- Row -->
					<div class="row">
					<!-- Main Col -->
					<div class="main-col">
					<h1>Hart House Wine and Tapa</h1><br>
					<p>Thank you for purchasing a gift voucher. We are still processing your payment request and will notify you through email at <b><i><?echo $youremail?></i></b><br>Thank you for your patients!</p>
					<br><br>
					<p>If you have any questions about this purchase, feel free to <a href="contactus"><b>Contact Us</b></a> or email us at <b><i><?echo $contact?></i></b>
					</div><br/>
				<!-- /Container -->

				    </div>
					</div>
					</div>
					</div>
			
		<?} else {?>
			
			<!-- Post -->
							<!-- Error Block -->
							<div class="error-block wider">		
							  <!-- Left -->
							  <div class="left">
								<div class="vcenter">
								  <div class="vcenter-this">
								  <i class="error-icon fa fa-lock"></i>
								  </div>
								</div>
							  </div>
							  <!-- /Left -->
							  
							  <!-- Right -->
							  <div class="right">
								<h4>Uh Oh!</h4>
								<p>Looks like theres a problem :(</p>
								<?
									if ($txn_id_url!="") {
										echo "<p>If you have just purchased an electronic gift voucher, try refreshing this page!</p>";
									}
								?>
								
								<p>If you have any questions, feel free to <a href="contactus"><b>Contact Us</b></a> or email us at <b><i><?echo $contact?></i></b>
								<!-- Search -->
							  </div>
							  <!-- /Right -->
							  
							</div>
							
							<!-- /Error Block -->

              <!-- Post /END -->  
		<?} 
		?>
		
		
      </section>
    <!-- /Content Block
    ============================================-->
	<section class="page-info-block boxed-section">
        <!-- Container -->
        <div class="container cont-pad-x-15"> 
          <!-- Breadcrumb -->
          <ol class="breadcrumb pull-left">
          </ol>
          <!-- /Breadcrumb --> 
        </div>
        <!-- /Container -->
      
      </section>
	<?include('inc/footer.php');?>
      
    </div>

    <!-- /Page Wrapper
    ++++++++++++++++++++++++++++++++++++++++++++++ -->

    <!-- Javascript
    ================================================== -->
    <script src="uikit/js/jquery-latest.min.js"></script>
    <script src="uikit/js/uikit.js"></script>
	<script src="js_custom/reserve.js"></script>
	<script src="js_custom/bootstrap-timepicker.js"></script>
	<script src="js_custom/datepicker.js"></script>
	<script src="js_custom/bootstrap-formhelpers.js"></script>
    <!-- /JavaScript
    ================================================== -->
	
	<script type="text/javascript">
		$('#timepicker').timepicker();
	</script>
	<script type="text/javascript">
		$(function () {
		  $('[data-toggle="tooltip"]').tooltip()
		})
	</script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#datepick').datepicker({
				format: "dd/mm/yyyy"
			});
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('[data-toggle="tooltip"]').tooltip()
		});
	</script>
	
	
  </body>
</html>
