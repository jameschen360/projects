<!DOCTYPE html>
<?php
session_start();
date_default_timezone_set('America/Denver');

if(!empty($_SESSION['login_user'])) {
	echo "<meta http-equiv=\"refresh\" content=\"0; url=./\">";
} else {
?>

<html lang="en">
    <head>
      <meta charset="utf-8">
      <title>Springbank Delivery | Login</title>
        <link rel="stylesheet" href="styles/custom.css">
        <!-- Vendor styles -->
        <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.css" />
        <link rel="stylesheet" href="vendor/metisMenu/dist/metisMenu.css" />
        <link rel="stylesheet" href="vendor/animate.css/animate.css" />
        <link rel="stylesheet" href="vendor/bootstrap/dist/css/bootstrap.css" />
        <link rel="stylesheet" href="vendor/bootstrap-tour/build/css/bootstrap-tour.min.css" />

        <!-- App styles -->
        <link rel="stylesheet" href="fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css" />
        <link rel="stylesheet" href="fonts/pe-icon-7-stroke/css/helper.css" />
        <link rel="stylesheet" href="styles/style.css">
        <link rel="stylesheet" href="styles/login.css">
        <link rel="stylesheet" href="remodal/remodal.css">
        <link rel="stylesheet" href="remodal/remodal-default-theme.css">        
      <!-- Vendor scripts -->
      <script src="vendor/jquery/dist/jquery.min.js"></script>
      <script src="vendor/jquery-ui/jquery-ui.min.js"></script>
      <script src="vendor/slimScroll/jquery.slimscroll.min.js"></script>
      <script src="vendor/bootstrap/dist/js/bootstrap.min.js"></script>
      <script src="vendor/metisMenu/dist/metisMenu.min.js"></script>

      
      <script src="vendor/iCheck/icheck.min.js"></script>
      <script src="vendor/sparkline/index.js"></script>
      <script src="remodal/remodal.js"></script>

      <!-- App scripts -->
      <script src="scripts/homer.js"></script>

      <!-- Login Script -->
      <script src="js_custom/loginSignup/login.js"></script>
      <script src="js_custom/loginSignup/signup.js"></script>
      <script src="js_custom/loginSignup/passwordReset.js"></script>

      <script>
        $( document ).ready(function() {
          $(document).unbind('keydown.remodal');
          $(".signupPanel").hide();

          $( ".signUp" ).on( "click", function( event ) {           
            $(".loginPanel").hide();
            $("#loginErrorMsg").html('');
            $(".signupPanel").show();
            $(".loginText").html('Signup');
          });

          $( ".logIn" ).on( "click", function( event ) {
            $(".loginPanel").show();
            $("#signupErrorMsg").html('');
            $(".signupPanel").hide();
            $(".loginText").html('Login');
          });
          
          $(document).on('closed', '.forgetPasswordModal', function () {
            $('.passwordResetText').html('Enter Your Registered Email');
            $('#passwordResetErrorMsg').html('');
            $('#passwordForm').html('<label class="sr-only" for="passwordReset">Email</label><input type="text" name="passwordReset" placeholder="Your Email..." class="form-control" id="passwordReset">');
            $('.passwordResetButton').html('Reset Password').prop('disabled', false);
          });




        /** Document Ready Functions **/
        /********************************************************************/
          
              // Resive video
              scaleVideoContainer();
          
              initBannerVideoSize('.video-container .poster img');
              initBannerVideoSize('.video-container .filter');
              initBannerVideoSize('.video-container video');
                  
              $(window).on('resize', function() {
                  scaleVideoContainer();
                  scaleBannerVideoSize('.video-container .poster img');
                  scaleBannerVideoSize('.video-container .filter');
                  scaleBannerVideoSize('.video-container video');
              });

          /** Reusable Functions **/
          /********************************************************************/
          
          function scaleVideoContainer() {
          
              var height = $(window).height();
              var unitHeight = parseInt(height) + 'px';
              $('.homepage-hero-module').css('height',unitHeight);
          
          }
          
          function initBannerVideoSize(element){
              
              $(element).each(function(){
                  $(this).data('height', $(this).height());
                  $(this).data('width', $(this).width());
              });
          
              scaleBannerVideoSize(element);
          
          }
          
          function scaleBannerVideoSize(element){
          
              var windowWidth = $(window).width(),
                  windowHeight = $(window).height(),
                  videoWidth,
                  videoHeight;
              
              $(element).each(function(){
                  var videoAspectRatio = $(this).data('height')/$(this).data('width'),
                      windowAspectRatio = windowHeight/windowWidth;
          
                  if (videoAspectRatio > windowAspectRatio) {
                      videoWidth = windowWidth;
                      videoHeight = videoWidth * videoAspectRatio;
                      $(this).css({'top' : -(videoHeight - windowHeight) / 2 + 'px', 'margin-left' : 0});
                  } else {
                      videoHeight = windowHeight;
                      videoWidth = videoHeight / videoAspectRatio;
                      $(this).css({'margin-top' : 0, 'margin-left' : -(videoWidth - windowWidth) / 2 + 'px'});
                  }
          
                  $(this).width(videoWidth).height(videoHeight);
          
                  $('.homepage-hero-module .video-container video').addClass('fadeIn animated');
                  
          
              });
          }



        });      

      </script>
      </head>
    <body>

    
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="homepage-hero-module">
        <div class="video-container">
            <div class="title-container">
                <div class="headline">
                <h1 style="color:#FFF;"><strong>Springbank Delivery</strong> <span class="loginText">Login</span></h1>



                <div class="description">
                <div class="loginPanel">
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3 form-box">
                      <div class="form-top">
                        <div class="form-top-left">
                            <p>Enter your username and password:</p>
                        </div>
                        <div class="form-top-right">
                          <i class="fa fa-lock"></i>
                        </div>
                        </div>
                        <div class="form-bottom">
                      <form class="login-form">
                      <div id="loginErrorMsg" style="text-align:center;"></div>
                        <div class="form-group">
                          <label class="sr-only" for="loginEmail">Username (Email)</label>
                          <input type="text" name="form-username" placeholder="Username (Email)..." class="form-username form-control" id="loginEmail">
                        </div>
                        <div class="form-group">
                          <label class="sr-only" for="form-password">Password</label>
                          <input type="password" name="form-password" placeholder="Password..." class="form-password form-control" id="loginPassword">
                        </div>
                          <button class="btn loginButton">Sign in!</button>
                      </form>
                      <div style="text-align:center;">
                        <p>Not a registered yet? <a href="#" class="signUp" style="color:#E48E0D;">Sign Up Today!</a></p>
                      </div>
                    </div>
                    </div>
                </div>
              </div>
              <div class="signupPanel">
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3 form-box">
                        <div class="form-top">
                        <div class="form-top-left">
                        </div>
                        <div class="form-top-right">
                            <i class="fa fa-pencil"></i>
                        </div>
                        </div>
                        <div class="form-bottom">
                        <div id="signupErrorMsg"></div>
                        <form role="form" action="" method="post" class="login-form">
                            <div class="form-group">
                            <label class="sr-only" for="fname">First Name</label>
                            <input type="text" name="fname" placeholder="First Name..." class="form-control" id="signupFirstName">
                            </div>
                            <div class="form-group">
                            <label class="sr-only" for="lname">Last Name</label>
                            <input type="text" name="lname" placeholder="Last Name..." class="form-control" id="signupLastName">
                            </div>
                            <div class="form-group">
                            <label class="sr-only" for="form-username">Email</label>
                            <input type="text" name="form-username" placeholder="Email..." class="form-control" id="signupEmail">
                            </div>
                            <div class="form-group">
                            <label class="sr-only" for="=password">Password</label>
                            <input type="password" name="password" placeholder="Password..." class="form-control" id="signupPassword">
                            </div>
                            <div class="form-group">
                            <label class="sr-only" for="password2">Repeat Password</label>
                            <input type="password" name="password2" placeholder="Repeat Password..." class="form-control" id="signupPassword2">
                            </div>
                            <button class="btn signupButton">Sign Up!</button>
                        </form>
                        <div style="text-align:center">
                        <p>By sigining up, you will have agreed to our <a style="color:#E48E0D; cursor: pointer;" data-remodal-target="terms">Terms & Conditions.</a></p>
                        <p><a href="#" class="logIn" style="color:#E48E0D;">Login (Click Here)</a></p>           
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <p><a style="cursor: pointer; color:#FFF;" data-remodal-target="forgotPassword">Forgot your password?</a></p>               
            </div>                
                </div>   
            </div>
            <div class="filter"></div>
            <video autoplay loop class="fillWidth">
                <source src="https://s3.us-east-2.amazonaws.com/springbankdelivery/videos/fresh.mp4" type="video/mp4" />Your browser does not support the video tag. I suggest you upgrade your browser.</video>
            <div class="poster hidden">
                <img src="https://s3.us-east-2.amazonaws.com/springbankdelivery/videos/fresh.jpg" alt="">
            </div>
        </div>
    </div>
    <!-- /container -->


<!-- make request modal -->
<div id="terms" class="remodal-bg">
  <div class="remodal terms-modal" data-remodal-id="terms" data-remodal-options="hashTracking: false, closeOnOutsideClick: false">
          <h2 style="padding-top:20px;">Terms & Conditions</h2>
      <div class="modal-body" style="text-align:left;" class="form-control">
          <ul class="list-group">
              <li>Customer must be 18 years or older to submit an order. <hr></li>
              <li>Customer agrees to pay for the price of the order as per receipt plus the service fee as specified in “Service Fees” section.<hr></li>
              <li>There is no liquor or tobacco delivery service. <hr></li>
              <li>There will be no return accepted for the grocery shopping except there is a mistake by Springbankdelivery agent. <hr></li>
              <li>Customer is responsible to provide as detailed shopping list as possible, if there is not enough information provided the springbankdelivery agent is permitted to pick the item/items as close as possible to the item description in customer list and agent will not be responsible for any dispute. <hr></li>
              <li>Spribgbankdelivery is not responsible for the store products quality although Springbankdelivery agent tries to pick the best available quality items as per shopping list. <hr></li>
              <li>For the same day delivery all the Costco/Walmart orders shall be submitted by 12:00 pm and all other orders from Westspring shopping centre (No frills, Coop, Shoppers drug mart, Global pet food ,…) shall be submitted by 4:00 pm;Any orders submitted after this hours will be subject to the next day delivery. <hr></li>
              <li>All the regular service deliveries will be between 5:00 pm to 9:00 pm, there will be a 16 years old or older person available to receive the order, otherwise a desired time for delivery needs to be advised and Springbankdelivery agent try his/her best to make it happen.</li>
          </ul>
      </div>
      <div style="padding-bottom:20px;">
          <button type="button" class="btn btn-default" data-remodal-action="close">Okay</button>
      </div>	
  </div><!-- tab-content -->
</div> <!-- /form -->  

<!-- make request modal -->
<div id="terms" class="remodal-bg">
  <div class="remodal terms-modal forgetPasswordModal" data-remodal-id="forgotPassword" data-remodal-options="hashTracking: false, closeOnOutsideClick: false">
    <button data-remodal-action="close" class="remodal-close close-position" aria-label="Close"></button>
      <h2 class="passwordResetText" style="padding-top:20px;">Enter Your Registered Email</h2>
        <div class="modal-body" class="form-control">
        <div id="passwordResetErrorMsg"></div>
          <div class="form-group" id="passwordForm">
            <label class="sr-only" for="passwordReset">Email</label>
            <input type="text" name="passwordReset" placeholder="Your Email..." class="form-control" id="passwordReset">
          </div>
        </div>
        <div style="padding-bottom:20px;">
            <button class="btn btn-default passwordResetButton">Reset Password</button>
        </div>	
  </div><!-- tab-content -->
</div> <!-- /form --> 

    </body>
  </html>
<?php
      }
?>