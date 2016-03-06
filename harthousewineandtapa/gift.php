<?
	include('inc/header.php');//includes logo and navigation
	?>
    <?
	   $sql = mysql_query("SELECT * FROM gift");
	   $value = mysql_fetch_array($sql);
			$reserve_pic = $value['background'];//background url for about us
	$MAX = 150;	
	$initial = 50;
		$sql_contact = mysql_query("SELECT * FROM contact");
		$value2 = mysql_fetch_array($sql_contact);
		$myemail = $value2['email'];
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
		<!-- Container -->
        <div class="container cont-pad-t-sm">
			<div class="box pull-left" style="margin-bottom:25px;">
				<div class="ribbon"><span>Voucher</span></div>
			  <div class="panel-body text-center">

          <!-- Row -->
          <div class="row">

            <!-- Main Col -->
            <div class="main-col">


			<h1>Hart House Wine and Tapa</h1><p></p>
			<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
			<input type="hidden" name="cmd" value="_xclick">
			<input type="hidden" name="business" value="rotoredneck@gmail.com">
			<input type="hidden" name="item_name" value="HHWT Gift Certificate">
			<input type="hidden" name="item_number" value="2015-GC">
			<input type="hidden" name="currency_code" value="CAD">
			<div class="form-group">
			<label for="fullname1" class="control-label">To:</label>
			<input type="hidden" name="on1" value="Gift To" maxlength="200">
			<input type="text" class="form-control" id="fullname1" name="os1" placeholder="John Doe" required="true">
			</div>
			<div class="form-group">
			<label for="youremail" class="control-label">Their Email:</label>
			<input type="text" class="form-control" id="theiremail" name="custom" placeholder="their@email.com" required="true">
			</div>			
			<div class="form-group">
				<label for="amount" class="control-label">Amount (CAD):</label>
				<select class="form-control" id="amount" name="amount" data-toggle="tooltip" data-placement="bottom" title="*With every purchase of a gift voucher an activation fee will be applied.">
					<?
						for($i=50; $i<=150; $i+=10) { 

					?>
												
						<option value='<?echo $i*1.029+0.4;?>'>$<?echo $i;?>+ $<?echo $i*0.029+0.4;?> Activation Fee</option>	
												
					<?}?>
				</select>
			</div>              
			<input type="image" src="https://www.paypalobjects.com/webstatic/en_US/btn/btn_checkout_pp_142x27.png" name="paypal"  value="Pay via PayPal" >
			</form> 								    
            <!-- /Main Col -->
          <!-- /Row -->
        
        </div><br/>
        <!-- /Container -->

			  </div>
			</div>
			</div><p></p>
			<div class="text-center">
			<p><br>Have a Gift Voucher? You can check your balance here!</p>
			<center><input id="balance_btn" type="button" class="btn btn-outline custom_round" value="Check Balance" data-toggle="modal" data-target=".balance_check"></center></div>
			
			</div>
    </section><br/>
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
	
	<!-- Balance Check -->
	<div class="modal fade balance_check" tabindex="-1" role="dialog" aria-labelledby="ModalPayPal">
	        <div class="container cont-pad-t-sm">
	  <div class="modal-dialog modal-lg">
		<div class="modal-content text-center">
     
      <div class="modal-body" style="margin:10px;">

		<!-- Container -->

        <div class="row">
					<form class="contact" name="contact">
					  <center><div class="form-group">
						<label for="card_balance" class="control-label">Gift Voucher Code:</label>
						<input type="text" class="form-control text-center col-lg-6" id="code" name="code" placeholder="XXXX-XXXX-XXXX-XXXX" required="true" style="text-transform: uppercase;">
					  </div>
					</form>

		</div>
						<br>	<div class="row"><div id="balancemsg"></div></div>
					<input id="btn" type="button" class="btn btn-outline custom_round" value="Check Balance">
		
      </div>
    </div><!-- /.modal-content -->
	  </div>
	  </div>
	</div>
	<!-- /Balance Check -->
	
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
	<script src="js_custom/balancecheck.js"></script>
	<script src="js_custom/text.js"></script>
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
	<script>
		jQuery(function($){
			   $("#code").mask("aaaa-aa99-99aa-9999");
		});
	</script>	
	
  </body>
</html>
