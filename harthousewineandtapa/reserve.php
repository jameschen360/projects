<?
	include('inc/header.php');//includes logo and navigation
	?>
    <?
	   $sql = mysql_query("SELECT * FROM reserve");
	   $value = mysql_fetch_array($sql);
			$reserve_pic = $value['background'];//background url for about us
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
            <h2><font class="italiancustom" size="20">Make a Reservation</font></h2>
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
		<div class="flam-font"><center><font size="5">Reservations are for groups of 20+</font></center></div>
        <div class="container cont-pad-t-sm">

          <!-- Row -->
          <div class="row">

            <!-- Main Col -->
            <div class="main-col">
            
			<div class="reserve_form">
             <!-- Comment Form -->
					<div id="reserve_error"></div>
					<form class="reserve " name="contact">
					 
					<div class="row">
					  <div class="form-group col-md-6">
						<label for="fullname" class="control-label">Your Name:</label>
						<input type="text" class="form-control" id="fullname" name="fullname" placeholder="John Doe" >
					  </div>
					  
					  <div class="form-group col-md-6">
						<label for="phonenumber" class="control-label">Phone Number:</label>
						<input type="text" class="form-control" id="phonenumber" name="phonenumber">
					  </div>
					 </div> 
					<div class="row">
					  <div class="form-group col-md-6">
						<label for="email" class="control-label">Email:</label>
						<input type="text" class="form-control" id="email" name="email" placeholder="john.doe@example.com" >
					  </div>
					  
					  <div class="form-group col-md-6">
						<label for="peoplenum" class="control-label">Number of People:</label>
						<select class="form-control" id="peoplenum" name="peoplenum">
							<option>20</option>
							<option>21</option>
							<option>22</option>
							<option>23</option>
							<option>24</option>
							<option>25</option>
							<option>26</option>
							<option>27</option>
							<option>28</option>
							<option>29</option>
							<option>30+ (Please Contact)</option>
						</select>
					  </div>
					 </div> 
					 
					 <div class="row">
					  <div class="form-group col-md-6">
						<label for="datepick" class="control-label">Date:</label>
						<input  type="text" class="form-control" placeholder="Select a Date" id="datepick" name="datepick">
					  </div>
					  
					  <div class="form-group col-md-6">
						<label for="timepicker" class="control-label">Time:</label>
						<div class="input-group bootstrap-timepicker">
							<span class="input-group-addon custom_round"><i class="ti-timer"></i></span>
							<input id="timepicker" type="text" name="timepicker" class="form-control" data-toggle="tooltip" data-placement="bottom" title="Click the clock to pick a time!">
						</div>
					  </div>
					 </div> 
					 
					  <div class="form-group">
						<label for="message-text" class="control-label">Special Requests:</label>
						<textarea class="form-control" id="message-text" name="message" rows="8" placeholder="Please tell us your requests here..."></textarea>
					  </div>

					  <div class="form-group">
						<label for="anti" class="control-label">2 + 2 = ?:</label>
						<input type="text" class="form-control" id="anti" name="anti" placeholder="Answer: 4" >
					  </div>

					</form>
					<center>
					<input id="reserve_btn" type="button" class="btn btn-outline custom_round" value="Reserve Now!"></center>
                <!-- /Contact Form -->
              </div>
            <!-- /Main Col -->

          </div>
          <!-- /Row -->
        
        </div><br/>
        <!-- /Container -->
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
	<script src="js_custom/text.js" type="text/javascript"></script>
    <!-- /JavaScript
    ================================================== -->
	
	<script type="text/javascript">
		jQuery(function($){
		   $("#phonenumber").mask("(999) 999-9999");
		});
	</script>
	<script type="text/javascript">
		$('#timepicker').timepicker();
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
