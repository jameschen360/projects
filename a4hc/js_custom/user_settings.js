$(document).ready(function(){
	$(document).unbind('keydown.remodal');
	// Toastr options
	toastr.options = {
	  "closeButton": true,
	  "debug": false,
	  "newestOnTop": false,
	  "progressBar": false,
	  "positionClass": "toast-top-center",
	  "preventDuplicates": true,
	  "onclick": null,
	  "showDuration": "300",
	  "hideDuration": "1000",
	  "timeOut": "5000",
	  "extendedTimeOut": "1000",
	  "showEasing": "swing",
	  "hideEasing": "linear",
	  "showMethod": "fadeIn",
	  "hideMethod": "fadeOut"
	};	

	function capWords(str){ 
	   var words = str.split(" "); 
	   for (var i=0 ; i < words.length ; i++){ 
		  var testwd = words[i]; 
		  var firLet = testwd.substr(0,1); 
		  var rest = testwd.substr(1, testwd.length -1) 
		  words[i] = firLet.toUpperCase() + rest 
	   }
		return words.join(" ");
	} 
	function isEmail(email) {
	  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	  return regex.test(email);
	}	
	
	// $('#sin_u').change('input propertychange', function() {
	// 	var sin_u = $('#sin_u').val();
	// 	if ($.trim(sin_u).length < 11) {	
	// 		toastr.error('Please Input a Valid Social Insurance Number.','System Message:');
	// 		$("#sin_u").removeClass("accounting-css-success").addClass("accounting-css-error");			
	// 		check3 = 0;
	// 	}else {
	// 		$("#sin_u").addClass("accounting-css-success").removeClass("accounting-css-error");			
	// 		check3 = 1;		
	// 		toastr.remove();
	// 	}
	// });

	$('#dob_u').change('input propertychange', function() {
		var dob_u = $('#dob_u').val();
		if ($.trim(dob_u).length < 9) {	
			toastr.error('Please Input a Valid Date of Birth.','System Message:');
			$("#dob_u").removeClass("accounting-css-success").addClass("accounting-css-error");			
			check3 = 0;
		}else {
			$("#dob_u").addClass("accounting-css-success").removeClass("accounting-css-error");			
			check3 = 1;		
			toastr.remove();
		}
	});

	$('#home_address_u').change('input propertychange', function() {
		var home_address_u = $('#home_address_u').val();
		if ($.trim(home_address_u).length < 6) {	
			toastr.error('Please Input a Valid Address.','System Message:');
			$("#home_address_u").removeClass("accounting-css-success").addClass("accounting-css-error");			
			check5 = 0;
		}else {
			$("#home_address_u").addClass("accounting-css-success").removeClass("accounting-css-error");			
			check5 = 1;		
			toastr.remove();
		}
	});		
	$('#city_u').change('input propertychange', function() {
		var city_u = $('#city_u').val();
		if ($.trim(city_u).length < 3) {	
			toastr.error('Please Input a Valid City.','System Message:');
			$("#city_u").removeClass("accounting-css-success").addClass("accounting-css-error");			
			check6 = 0;
		}else {
			$("#city_u").addClass("accounting-css-success").removeClass("accounting-css-error");			
			check6 = 1;		
			toastr.remove();
		}
	});		
	$('#postal_u').change('input propertychange', function() {
		var postal_u = $('#postal_u').val();
		if ($.trim(postal_u).length < 7) {	
			toastr.error('Please Input a Valid Postal Code.','System Message:');
			$("#postal_u").removeClass("accounting-css-success").addClass("accounting-css-error");			
			check7 = 0;
		}else {
			$("#postal_u").addClass("accounting-css-success").removeClass("accounting-css-error");			
			check7 = 1;	
			toastr.remove();
		}
	});	
	$('#hphone_u').change('input propertychange', function() {
		var hphone_u = $('#hphone_u').val();
		if ($.trim(hphone_u).length < 14) {	
			toastr.error('Please Input a Valid Home Phone.','System Message:');
			$("#hphone_u").removeClass("accounting-css-success").addClass("accounting-css-error");			
			check8 = 0;
		}else {
			$("#hphone_u").addClass("accounting-css-success").removeClass("accounting-css-error");			
			check8 = 1;	
			toastr.remove();
		}
	});		
	$('#personal_cphone_u').change('input propertychange', function() {
		var personal_cphone_u = $('#personal_cphone_u').val();
		if ($.trim(personal_cphone_u).length < 14) {	
			toastr.error('Please Input a Valid Cell Phone.','System Message:');
			$("#personal_cphone_u").removeClass("accounting-css-success").addClass("accounting-css-error");			
			check9 = 0;
		}else {
			$("#personal_cphone_u").addClass("accounting-css-success").removeClass("accounting-css-error");			
			check9 = 1;	
			toastr.remove();
		}
	});	

	$('#password1_u').change('input propertychange', function() {	
		var password1_u = $('#password1_u').val();
		var matches = password1_u.match(/^(?=.*[A-Za-z])(?=.*[0-9])([A-Za-z0-9_!@#$%^&*-\[\]])+$/);
		if (matches != null && $.trim(password1_u).length > 8) {	
			$("#password1_u").addClass("accounting-css-success").removeClass("accounting-css-error");			
			check11 = 1;
			toastr.remove();
		}else {
			toastr.error('Please Input a Valid Password Containing Numbers/Characters and Having more than 9 Characters.','System Message:');
			$("#password1_u").removeClass("accounting-css-success").addClass("accounting-css-error");			
			check11 = 0;
		}
	});
	$('#password2_u').change('input propertychange', function() {	
		var password2_u = $('#password2_u').val();
		var password1_u = $('#password1_u').val();
		if (password2_u != password1_u) {
			toastr.error('Passwords Does not Match.','System Message:');
			$("#password2_u").removeClass("accounting-css-success").addClass("accounting-css-error");			
			check12 = 0;			
		}else {
			$("#password2_u").addClass("accounting-css-success").removeClass("accounting-css-error");			
			check12 = 1;
			toastr.remove();
		}

	});
	$('#fullname_emergency_u').change('input propertychange', function() {
		var fullname_emergency_u = $('#fullname_emergency_u').val();
		if ($.trim(fullname_emergency_u).length < 3) {	
			toastr.error('Please Input a Full Name.','System Message:');
			$("#fullname_emergency_u").removeClass("accounting-css-success").addClass("accounting-css-error");			
			check13 = 0;
		}else {
			$("#fullname_emergency_u").addClass("accounting-css-success").removeClass("accounting-css-error");			
			check13 = 1;		
			toastr.remove();
		}
	});	
	$('#emergency_address_u').change('input propertychange', function() {
		var emergency_address_u = $('#emergency_address_u').val();
		if ($.trim(emergency_address_u).length < 6) {	
			toastr.error('Please Input a Valid Address.','System Message:');
			$("#emergency_address_u").removeClass("accounting-css-success").addClass("accounting-css-error");			
			check14 = 0;
		}else {
			$("#emergency_address_u").addClass("accounting-css-success").removeClass("accounting-css-error");			
			check14 = 1;		
			toastr.remove();
		}
	});
	$('#emergency_hphone_u').change('input propertychange', function() {
		var emergency_hphone_u = $('#emergency_hphone_u').val();
		if ($.trim(emergency_hphone_u).length < 14) {	
			toastr.error('Please Input a Valid Home Phone.','System Message:');
			$("#emergency_hphone_u").removeClass("accounting-css-success").addClass("accounting-css-error");			
			check15 = 0;
		}else {
			$("#emergency_hphone_u").addClass("accounting-css-success").removeClass("accounting-css-error");			
			check15 = 1;	
			toastr.remove();
		}
	});
	$('#emergency_cphone_u').change('input propertychange', function() {
		var emergency_cphone_u = $('#emergency_cphone_u').val();
		if ($.trim(emergency_cphone_u).length < 14) {	
			toastr.error('Please Input a Valid Home Phone.','System Message:');
			$("#emergency_cphone_u").removeClass("accounting-css-success").addClass("accounting-css-error");			
			check16 = 0;
		}else {
			$("#emergency_cphone_u").addClass("accounting-css-success").removeClass("accounting-css-error");			
			check16 = 1;	
			toastr.remove();
		}
	});
	$('#health_care_number').change('input propertychange', function() {
		var health_care_number = $('#health_care_number').val();
		if ($.trim(health_care_number).length < 10) {	
			toastr.error('Please Input a Valid Health Care Number.','System Message:');
			$("#health_care_number").removeClass("accounting-css-success").addClass("accounting-css-error");			
			check17 = 0;
		}else {
			$("#health_care_number").addClass("accounting-css-success").removeClass("accounting-css-error");			
			check17 = 1;		
			toastr.remove();
		}
	});	
	$('#doctor_fullname_u').change('input propertychange', function() {
		var doctor_fullname_u = $('#doctor_fullname_u').val();
		if ($.trim(doctor_fullname_u).length < 5) {	
			toastr.error('Please Input a Valid Full Name.','System Message:');
			$("#doctor_fullname_u").removeClass("accounting-css-success").addClass("accounting-css-error");			
			check18 = 0;
		}else {
			$("#doctor_fullname_u").addClass("accounting-css-success").removeClass("accounting-css-error");			
			check18 = 1;		
			toastr.remove();
		}
	});
	$('#doctor_address_u').change('input propertychange', function() {
		var doctor_address_u = $('#doctor_address_u').val();
		if ($.trim(doctor_address_u).length < 6) {	
			toastr.error('Please Input a Valid Address.','System Message:');
			$("#doctor_address_u").removeClass("accounting-css-success").addClass("accounting-css-error");			
			check19 = 0;
		}else {
			$("#doctor_address_u").addClass("accounting-css-success").removeClass("accounting-css-error");			
			check19 = 1;	
			toastr.remove();
		}
	});
	$('#doctor_phone_u').change('input propertychange', function() {
		var doctor_phone_u = $('#doctor_phone_u').val();
		if ($.trim(doctor_phone_u).length < 14) {	
			toastr.error('Please Input a Valid Phone Number.','System Message:');
			$("#doctor_phone_u").removeClass("accounting-css-success").addClass("accounting-css-error");			
			check20 = 0;
		}else {
			$("#doctor_phone_u").addClass("accounting-css-success").removeClass("accounting-css-error");			
			check20 = 1;	
			toastr.remove();
		}
	});	
	
	$('.close_main').click(function(){			
		$('.user_box').removeClass("accounting-css-success accounting-css-error");	
		toastr.remove();
		var user_id = $('#user_id_settings').val();
		var info1 = 'user_id_close1='+user_id;
		var info2 = 'user_id_close2='+user_id;
		var info3 = 'user_id_close3='+user_id;
		var info4 = 'user_id_close4='+user_id;
		var user_info_json1 = 0;
		var user_info_json2 = 0;
		var user_info_json3 = 0;
		var user_info_json4 = 0;		
		$.ajax({
			type: "POST",
			url: "./services/user_settings.php",
			data: info1,
			cache: false,				
			beforeSend: function(){},
			success: function(data){
				user_info_json1 = $.parseJSON(data);//php to jquery json user table
				user_info_json1 = user_info_json1[0];				
				$('#fname_u').val(user_info_json1.fname);
				$('#lname_u').val(user_info_json1.lname);
				$('#email_u').val(user_info_json1.username);
				$('#password2_u, #password1_u').val('');
			}
		});		
		$.ajax({
			type: "POST",
			url: "./services/user_settings.php",
			data: info2,
			cache: false,				
			beforeSend: function(){},
			success: function(data){
				user_info_json2 = $.parseJSON(data);//php to jquery json employee_info table
				user_info_json2 = user_info_json2[0];	
				$('#sin_u').val(user_info_json2.sin);				
				$('#dob_u').val(user_info_json2.dob);				
				$('#home_address_u').val(user_info_json2.address);				
				$('#city_u').val(user_info_json2.city);				
				$('.province_select_u').select2("val", user_info_json2.province);			
				$('#postal_u').val(user_info_json2.p_code);				
				$('#hphone_u').val(user_info_json2.h_phone);				
				$('#personal_cphone_u').val(user_info_json2.m_phone);							
			}
		});
		$.ajax({
			type: "POST",
			url: "./services/user_settings.php",
			data: info3,
			cache: false,				
			beforeSend: function(){},
			success: function(data){
				user_info_json3 = $.parseJSON(data);//php to jquery json emergency table
				user_info_json3 = user_info_json3[0];
				$('#fullname_emergency_u').val(user_info_json3.full_name);
				$('#emergency_address_u').val(user_info_json3.address);
				$('#emergency_hphone_u').val(user_info_json3.home_phone);
				$('#emergency_cphone_u').val(user_info_json3.cell_phone);
			}
		});
		$.ajax({
			type: "POST",
			url: "./services/user_settings.php",
			data: info4,
			cache: false,				
			beforeSend: function(){},
			success: function(data){
				user_info_json4 = $.parseJSON(data);//php to jquery json medical table
				user_info_json4 = user_info_json4[0];
				$('#health_care_number').val(user_info_json4.health_care_number);
				$('#doctor_fullname_u').val(user_info_json4.doctor_name);
				$('#doctor_address_u').val(user_info_json4.address);
				$('#doctor_phone_u').val(user_info_json4.phone);
			}
		});	
	});	
		
	var check10=0;
	$('#personal_save').click(function(){
		var fname_u = $('#fname_u').val();
		var province_u = $('#province_u').val();
		
		// var sin_u = $('#sin_u').val();
		// if ($.trim(sin_u).length < 11) {
		// 	toastr.error('Please Input a Valid Social Insurance Number.','System Message:');
		// 	$("#sin_u").removeClass("accounting-css-success").addClass("accounting-css-error");			
		// 	check3 = 0;
		// } else {
		// 	$("#sin_u").addClass("accounting-css-success").removeClass("accounting-css-error");			
		// 	check3 = 1;		
		// 	toastr.remove();
		// }

		var dob_u = $('#dob_u').val();
		if ($.trim(dob_u).length < 8) {	
			toastr.error('Please Input a Valid Date of Birth.','System Message:');
			$("#dob_u").removeClass("accounting-css-success").addClass("accounting-css-error");			
			check3 = 0;
		}else {
			$("#dob_u").addClass("accounting-css-success").removeClass("accounting-css-error");			
			check3 = 1;		
			toastr.remove();
		}
		var home_address_u = $('#home_address_u').val();
		if ($.trim(home_address_u).length < 6) {	
			toastr.error('Please Input a Valid Address.','System Message:');
			$("#home_address_u").removeClass("accounting-css-success").addClass("accounting-css-error");			
			check5 = 0;
		}else {
			$("#home_address_u").addClass("accounting-css-success").removeClass("accounting-css-error");			
			check5 = 1;		
			toastr.remove();
		}
		var city_u = $('#city_u').val();
		if ($.trim(city_u).length < 3) {	
			toastr.error('Please Input a Valid City.','System Message:');
			$("#city_u").removeClass("accounting-css-success").addClass("accounting-css-error");			
			check6 = 0;
		}else {
			$("#city_u").addClass("accounting-css-success").removeClass("accounting-css-error");			
			check6 = 1;		
			toastr.remove();
		}	
		var postal_u = $('#postal_u').val();
		if ($.trim(postal_u).length < 7) {	
			toastr.error('Please Input a Valid Postal Code.','System Message:');
			$("#postal_u").removeClass("accounting-css-success").addClass("accounting-css-error");			
			check7 = 0;
		}else {
			$("#postal_u").addClass("accounting-css-success").removeClass("accounting-css-error");			
			check7 = 1;	
			toastr.remove();
		}
		var hphone_u = $('#hphone_u').val();
		if ($.trim(hphone_u).length < 14) {	
			toastr.error('Please Input a Valid Home Phone.','System Message:');
			$("#hphone_u").removeClass("accounting-css-success").addClass("accounting-css-error");			
			check8 = 0;
		}else {
			$("#hphone_u").addClass("accounting-css-success").removeClass("accounting-css-error");			
			check8 = 1;	
			toastr.remove();
		}	
		var personal_cphone_u = $('#personal_cphone_u').val();
		if ($.trim(personal_cphone_u).length < 14) {	
			toastr.error('Please Input a Valid Cell Phone.','System Message:');
			$("#personal_cphone_u").removeClass("accounting-css-success").addClass("accounting-css-error");			
			check9 = 0;
		}else {
			$("#personal_cphone_u").addClass("accounting-css-success").removeClass("accounting-css-error");			
			check9 = 1;	
			toastr.remove();
		}	
		var email_u = $('#email_u').val();
		var user_id_2 = $('#user_id_settings').val();
		
		var formData = new FormData(); 		
		formData.append('email_check', email_u);
		formData.append('user_id_check', user_id_2);		
		
		var password1_u = $('#password1_u').val();
		var matches = password1_u.match(/^(?=.*[A-Za-z])(?=.*[0-9])([A-Za-z0-9_!@#$%^&*-\[\]])+$/);
		if (matches != null && $.trim(password1_u).length > 8) {	
			$("#password1_u").addClass("accounting-css-success").removeClass("accounting-css-error");			
			check11 = 1;
			toastr.remove();
		}else {
			toastr.error('Please Input a Valid Password Containing Numbers/Characters and Having more than 9 Characters.','System Message:');
			$("#password1_u").removeClass("accounting-css-success").addClass("accounting-css-error");			
			check11 = 0;
		}	
		var password2_u = $('#password2_u').val();
		if (password2_u != password1_u || password2_u == "") {
			toastr.error('Passwords Does not Match.','System Message:');
			$("#password2_u").removeClass("accounting-css-success").addClass("accounting-css-error");			
			check12 = 0;			
		}else {
			$("#password2_u").addClass("accounting-css-success").removeClass("accounting-css-error");			
			check12 = 1;
			toastr.remove();
		}
	
				
		if (check3 === 1 && check5 === 1 && check6 === 1 && check7 === 1 && check8 === 1 && check9 === 1 && check11 === 1 && check12 === 1) {
			var user_id = $('#user_id_settings').val();	
			city_u = capWords(city_u);	
			home_address_u = capWords(home_address_u);	
			postal_u = postal_u.toUpperCase();	
			$('.user_box').removeClass("accounting-css-success");	
			var formData = new FormData(); 
			formData.append('dob_u', dob_u);
			formData.append('home_address_u', home_address_u);
			formData.append('city_u', city_u);
			formData.append('province_u', province_u);
			formData.append('postal_u', postal_u);
			formData.append('hphone_u', hphone_u);
			formData.append('personal_cphone_u', personal_cphone_u);
			formData.append('password_u', password1_u);
			formData.append('user_id', user_id);
			
			$("#personal_save").prop("disabled", true);
			$("#personal_save").html("<span class='glyphicon glyphicon-refresh glyphicon-refresh-animate'></span> Saving...");	
			$(".close_main").prop("disabled", true);	

			$.ajax({
				type: "POST",
				url: "./services/user_settings.php",
				data: formData,
				cache: false,
				contentType: false,
				processData: false,					
				beforeSend: function(){},
				success: function(data){
					$("#personal_save").prop("disabled", false);
					$("#personal_save").html("Save Personal Information");	
					$(".close_main").prop("disabled", false);	
					console.log(data)
						swal({
						  allowOutsideClick: false,
						  allowEscapeKey: false,
						  allowEnterKey: false,			
						  title: 'Personal Information Successfully Saved!',
						  type: 'success',
						  showCancelButton: false,
						  showLoaderOnConfirm: true,
						  confirmButtonColor: '#62cb31',
						  confirmButtonText: 'Okay!'
						})						
				}
			});			
			
		}
	
	});
	
	$('#emergency_save').click(function(){
		var fullname_emergency_u = $('#fullname_emergency_u').val();
		if ($.trim(fullname_emergency_u).length < 5) {	
			toastr.error('Please Input a Valid Name.','System Message:');
			$("#fullname_emergency_u").removeClass("accounting-css-success").addClass("accounting-css-error");			
			check1 = 0;
		}else {
			$("#fullname_emergency_u").addClass("accounting-css-success").removeClass("accounting-css-error");			
			check1 = 1;		
			toastr.remove();
		}
		var emergency_address_u = $('#emergency_address_u').val();
		if ($.trim(emergency_address_u).length < 6) {	
			toastr.error('Please Input a Valid Address.','System Message:');
			$("#emergency_address_u").removeClass("accounting-css-success").addClass("accounting-css-error");			
			check2 = 0;
		}else {
			$("#emergency_address_u").addClass("accounting-css-success").removeClass("accounting-css-error");			
			check2 = 1;		
			toastr.remove();
		}
		var emergency_hphone_u = $('#emergency_hphone_u').val();
		if ($.trim(emergency_hphone_u).length < 14) {	
			toastr.error('Please Input a Valid Home Phone.','System Message:');
			$("#emergency_hphone_u").removeClass("accounting-css-success").addClass("accounting-css-error");			
			check3 = 0;
		}else {
			$("#emergency_hphone_u").addClass("accounting-css-success").removeClass("accounting-css-error");			
			check3 = 1;		
			toastr.remove();
		}	
		var emergency_cphone_u = $('#emergency_cphone_u').val();
		if ($.trim(emergency_cphone_u).length < 14) {	
			toastr.error('Please Input a Valid Cell Phone.','System Message:');
			$("#emergency_cphone_u").removeClass("accounting-css-success").addClass("accounting-css-error");			
			check4 = 0;
		}else {
			$("#emergency_cphone_u").addClass("accounting-css-success").removeClass("accounting-css-error");			
			check4 = 1;		
			toastr.remove();
		}	
				
		if (check1 === 1 && check2 === 1 && check3 === 1 && check4 === 1) {
			var user_id = $('#user_id_settings').val();
			fullname_emergency_u = capWords(fullname_emergency_u);	
			
			var formData = new FormData(); 
			formData.append('fullname_emergency_u', fullname_emergency_u);
			formData.append('emergency_address_u', emergency_address_u);
			formData.append('emergency_hphone_u', emergency_hphone_u);
			formData.append('emergency_cphone_u', emergency_cphone_u);
			formData.append('user_id', user_id);
			
			$("#emergency_save").prop("disabled", true);
			$("#emergency_save").html("<span class='glyphicon glyphicon-refresh glyphicon-refresh-animate'></span> Saving...");	
			$(".close_main").prop("disabled", true);	
			$('.user_box').removeClass("accounting-css-success");	
			$.ajax({
				type: "POST",
				url: "./services/user_settings.php",
				data: formData,
				cache: false,
				contentType: false,
				processData: false,					
				beforeSend: function(){},
				success: function(data){
					$("#emergency_save").prop("disabled", false);
					$("#emergency_save").html("Save Personal Information");	
					$(".close_main").prop("disabled", false);
					
						swal({
						  allowOutsideClick: false,
						  allowEscapeKey: false,
						  allowEnterKey: false,			
						  title: 'Emergency Contact Successfully Saved!',
						  type: 'success',
						  showCancelButton: false,
						  showLoaderOnConfirm: true,
						  confirmButtonColor: '#62cb31',
						  confirmButtonText: 'Okay!'
						})						
				}
			});				
			
		}
	
	});	
	
	$('#medical_save').click(function(){
		var health_care_number = $('#health_care_number').val();
		if ($.trim(health_care_number).length < 10) {	
			toastr.error('Please Input a Valid Health Care Number.','System Message:');
			$("#health_care_number").removeClass("accounting-css-success").addClass("accounting-css-error");			
			check1 = 0;
		}else {
			$("#health_care_number").addClass("accounting-css-success").removeClass("accounting-css-error");			
			check1 = 1;		
			toastr.remove();
		}
		var doctor_fullname_u = $('#doctor_fullname_u').val();
		if ($.trim(doctor_fullname_u).length < 6) {	
			toastr.error('Please Input a Valid Name.','System Message:');
			$("#doctor_fullname_u").removeClass("accounting-css-success").addClass("accounting-css-error");			
			check2 = 0;
		}else {
			$("#doctor_fullname_u").addClass("accounting-css-success").removeClass("accounting-css-error");			
			check2 = 1;		
			toastr.remove();
		}
		var doctor_address_u = $('#doctor_address_u').val();
		if ($.trim(doctor_address_u).length < 6) {	
			toastr.error('Please Input a Valid Address.','System Message:');
			$("#doctor_address_u").removeClass("accounting-css-success").addClass("accounting-css-error");			
			check3 = 0;
		}else {
			$("#doctor_address_u").addClass("accounting-css-success").removeClass("accounting-css-error");			
			check3 = 1;		
			toastr.remove();
		}	
		var doctor_phone_u = $('#doctor_phone_u').val();
		if ($.trim(doctor_phone_u).length < 14) {	
			toastr.error('Please Input a Valid Phone Number.','System Message:');
			$("#doctor_phone_u").removeClass("accounting-css-success").addClass("accounting-css-error");			
			check4 = 0;
		}else {
			$("#doctor_phone_u").addClass("accounting-css-success").removeClass("accounting-css-error");			
			check4 = 1;		
			toastr.remove();
		}	
				
		if (check1 === 1 && check2 === 1 && check3 === 1 && check4 === 1) {
			var user_id = $('#user_id_settings').val();
			doctor_fullname_u = capWords(doctor_fullname_u);	
			
			var formData = new FormData(); 
			formData.append('doctor_fullname_u', doctor_fullname_u);
			formData.append('doctor_address_u', doctor_address_u);
			formData.append('doctor_phone_u', doctor_phone_u);
			formData.append('health_care_number', health_care_number);
			formData.append('user_id', user_id);
			
			$("#medical_save").prop("disabled", true);
			$("#medical_save").html("<span class='glyphicon glyphicon-refresh glyphicon-refresh-animate'></span> Saving...");	
			$(".close_main").prop("disabled", true);	
			$('.user_box').removeClass("accounting-css-success");	
			$.ajax({
				type: "POST",
				url: "./services/user_settings.php",
				data: formData,
				cache: false,
				contentType: false,
				processData: false,					
				beforeSend: function(){},
				success: function(data){
					$("#medical_save").prop("disabled", false);
					$("#medical_save").html("Save Medical Information");	
					$(".close_main").prop("disabled", false);
					
						swal({
						  allowOutsideClick: false,
						  allowEscapeKey: false,
						  allowEnterKey: false,			
						  title: 'Medical Information Successfully Saved!',
						  type: 'success',
						  showCancelButton: false,
						  showLoaderOnConfirm: true,
						  confirmButtonColor: '#62cb31',
						  confirmButtonText: 'Okay!'
						})						
				}
			});				
			
		}
	
	});	
});

