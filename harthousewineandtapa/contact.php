<?include('inc/header.php');?>
<?
	   $sql = mysql_query("SELECT * FROM contact");
	   $value = mysql_fetch_array($sql);
			$marker_pic = $value['marker'];//background url for about us
			$blurb = $value['blurb'];
			$address = $value['address'];
			$email = $value['email'];
			$phone = $value['phone'];
?>     
      <!-- Intro Block
      ============================================-->

        <!-- Container -->
        <div class="container">     
          <!-- Section Title -->

			  <head>
				<script src="https://maps.googleapis.com/maps/api/js"></script>
				<script>
				  function initialize() {
					var mapCanvas = document.getElementById('map');
					var mapOptions = {
					  center: new google.maps.LatLng(53.01889, -112.8245),
					  zoom: 15,
					  mapTypeId: google.maps.MapTypeId.ROADMAP
					}
					var map = new google.maps.Map(mapCanvas, mapOptions)
					   var styles = [
    {
        "featureType": "administrative",
        "elementType": "labels.text.fill",
        "stylers": [
            {
                "color": "#444444"
            }
        ]
    },
    {
        "featureType": "landscape",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "off"
            },
            {
                "color": "#f2f2f2"
            }
        ]
    },
    {
        "featureType": "poi",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "all",
        "stylers": [
            {
                "saturation": -100
            },
            {
                "lightness": 45
            },
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "road.arterial",
        "elementType": "labels.icon",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "transit",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "water",
        "elementType": "all",
        "stylers": [
            {
                "color": "#d6ccbc"
            },
            {
                "visibility": "on"
            }
        ]
    }
];

							map.setOptions({styles: styles});
											
					var myLatLng = {lat: 53.01889, lng: -112.8245};
					var iconBase = {
					url: '<?echo $marker_pic;?>',//url
					};
					
				  var marker = new google.maps.Marker({
						
						position: myLatLng,
						map: map,
						icon: iconBase
					  });
					
				  }
				  google.maps.event.addDomListener(window, 'load', initialize);
				</script>
			  </head>
			  <body>
				<div id="map"></div>
			  </body>

          <!-- /Section Title -->
        </div>
        <!-- /Container -->
  
      <!-- /Intro Block
      ============================================-->
      
      <!-- Content Block
      ============================================-->
	<br/>
      <section class="content-block default-bg">
        <!-- Container -->
        <div class="container no-pad-t">

          <!-- Row -->
          <div class="row">
<!-- Side Col -->
            <div class="col-sm-4 col-md-4">

              <!-- Side Widget -->
              <div class="side-widget">
              
                <h5 class="boxed-title"><font class="flam-font">Our Location</font></h5>          
                <!-- vlinks -->
                <ul class="vlinks vlinks-iconed vlinks-ruled-dots">
                  <li><i class="icon ti-home custom_round_time"></i><?echo $address;?></li>
                  <li class="centered"><i class="icon ti-email custom_round_time"></i><?echo $email;?></li>
                  <li><i class="icon ti-themify-favicon custom_round_time"></i><?echo $phone;?></li>
                </ul>
                <!-- /vlinks -->
                
              </div>
              <!-- /Side Widget -->
              
            </div>
            <!-- /Side Col -->
            <!-- Main Col -->
            <div id="main-col" class="col-sm-8 col-md-8 mgb-30-xs">
 
                <h4><font class="flam-font">Contact Us</font></h4>
                
                <p><?echo $blurb;?></p>
                
                <!-- Comment Form -->
					<div id="errmsg"></div>
					<form class="contact" name="contact">
					 

					  <div class="form-group">
						<label for="fullname" class="control-label">Full Name:</label>
						<input type="text" class="form-control" id="fullname" name="fullname" placeholder="John Doe" >
					  </div>
					  
					  <div class="form-group">
						<label for="youremail" class="control-label">Your Email:</label>
						<input type="text" class="form-control" id="youremail" name="email" placeholder="john.doe@example.com" >
					  </div>
					  
					 <div class="form-group">
					  <label for="reason" class="control-label">Reason of Contact:</label>
						<select class="form-control" id="reason" name="reason">
							<option>General Inquiries</option>
							<option>Profession Contacts</option>
							<option>Website Technical</option>
						</select>
					 </div>
					  <div class="form-group">
						<label for="message-text" class="control-label">Message:</label>
						<textarea class="form-control" id="message-text" name="message" rows="8" placeholder="Write your question here..."></textarea>
					  </div>

					  <div class="form-group">
						<label for="youremail" class="control-label">2 + 2 = ?:</label>
						<input type="text" class="form-control" id="youremail" name="anti" placeholder="Answer: 4" >
					  </div>

					</form>

					<input id="btn" type="button" class="btn btn-outline pull-right custom_round" value="Send Message!">
                <!-- /Contact Form -->
                
            </div>
            <!-- /Main Col -->
            
            

          </div>
          <!-- /Row -->
        
        </div>
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
	<script src="js_custom/contactus.js"></script>
    <!-- /JavaScript
    ================================================== -->
  </body>
</html>
