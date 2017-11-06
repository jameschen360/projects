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
	
	var username = $('#hidden_username').val();	

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
	
	$('#payee_name').change('input propertychange', function() {
		var payee_name = $('#payee_name').val();
		if ($.trim(payee_name).length > 2) {
			$("#payee_name").removeClass("accounting-css-error");
			$("#payee_name").addClass("accounting-css-success");
			toastr.success('Payee Name Okay!','System Message:');			
		}else{ 
			$("#payee_name").removeClass("accounting-css-success");
			$("#payee_name").addClass("accounting-css-error");
			toastr.error('Please Enter a Valid Payee Name.','System Message:');						
		}	
	});
	
	$('#payee_email').change('input propertychange', function() {
		var payee_email = $('#payee_email').val();
		payee_email_check = isEmail(payee_email);
		if (payee_email_check != false) {
			$("#payee_email").removeClass("accounting-css-error");
			$("#payee_email").addClass("accounting-css-success");
			toastr.success('Payee Email Okay!','System Message:');			
		}else{ 
			$("#payee_email").removeClass("accounting-css-success");
			$("#payee_email").addClass("accounting-css-error");
			toastr.error('Please Enter a Valid Payee Email.','System Message:');						
		}	
	});	
	
	$('#payee_phone').change('input propertychange', function() {
		var payee_phone = $('#payee_phone').val();
		if (payee_phone.length == 14) {
			$("#payee_phone").removeClass("accounting-css-error");
			$("#payee_phone").addClass("accounting-css-success");
			toastr.success('Payee Phone Number Okay!','System Message:');			
		}else{ 
			$("#payee_phone").removeClass("accounting-css-success");
			$("#payee_phone").addClass("accounting-css-error");
			toastr.error('Please Enter a Valid Payee Phone Number.','System Message:');						
		}	
	});	

	$('#payee_address').change('input propertychange', function() {
		var payee_address = $('#payee_address').val();
		if ($.trim(payee_address).length > 5) {
			$("#payee_address").removeClass("accounting-css-error");
			$("#payee_address").addClass("accounting-css-success");
			toastr.success('Payee Address Okay!','System Message:');			
		}else{ 
			$("#payee_address").removeClass("accounting-css-success");
			$("#payee_address").addClass("accounting-css-error");
			toastr.error('Please Enter a Valid Payee Address.','System Message:');						
		}	
	});

	$('#payee_city').change('input propertychange', function() {
		var payee_city = $('#payee_city').val();
		if ($.trim(payee_city).length > 5) {
			$("#payee_city").removeClass("accounting-css-error");
			$("#payee_city").addClass("accounting-css-success");
			toastr.success('Payee City Okay!','System Message:');			
		}else{ 
			$("#payee_city").removeClass("accounting-css-success");
			$("#payee_city").addClass("accounting-css-error");
			toastr.error('Please Enter a Valid Payee City.','System Message:');						
		}	
	});

	$('#payee_zip').change('input propertychange', function() {
		var payee_zip = $('#payee_zip').val();
		if ($.trim(payee_zip).length == 7) {
			$("#payee_zip").removeClass("accounting-css-error");
			$("#payee_zip").addClass("accounting-css-success");
			toastr.success('Payee Postal Code Okay!','System Message:');			
		}else{ 
			$("#payee_zip").removeClass("accounting-css-success");
			$("#payee_zip").addClass("accounting-css-error");
			toastr.error('Please Enter a Valid Payee Postal Code.','System Message:');						
		}	
	});

	$('#payee_add_submit').click(function(){
	var payee_name = $('#payee_name').val();
	var payee_address = $('#payee_address').val();
	var payee_city = $('#payee_city').val();
	var payee_prov = $('#payee_prov').val();
	var payee_zip = $('#payee_zip').val();
	var payee_info = $('#payee_info').val();
	var payee_email = $('#payee_email').val();
	var payee_phone = $('#payee_phone').val();

	payee_name = capWords(payee_name);
	payee_address = capWords(payee_address);
	payee_city = capWords(payee_city);
	payee_zip = payee_zip.toUpperCase();
	
	var payee_email_check = isEmail(payee_email);
	
		if ($.trim(payee_name).length > 2) {
			$("#payee_name").removeClass("accounting-css-error");
			$("#payee_name").addClass("accounting-css-success");			
			check1 = 1;
		}else{ 
			toastr.error('Please Enter a Valid Payee Name.','System Message:');
			$("#payee_name").removeClass("accounting-css-success");
			$("#payee_name").addClass("accounting-css-error");				
			check1 = 0;	
		}

/* 		if ($.trim(payee_address).length > 5) {
			$("#payee_address").removeClass("accounting-css-error");
			$("#payee_address").addClass("accounting-css-success");			
			check2 = 1;
		}else{ 
			toastr.error('Please Enter Valid Address','System Message:');
			$("#payee_address").removeClass("accounting-css-success");
			$("#payee_address").addClass("accounting-css-error");				
			check2 = 0;
		}

		if ($.trim(payee_city).length > 5) {
			$("#payee_city").removeClass("accounting-css-error");
			$("#payee_city").addClass("accounting-css-success");			
			check3 = 1;
		}else{ 
			toastr.error('Please Enter Valid City','System Message:');
			$("#payee_city").removeClass("accounting-css-success");
			$("#payee_city").addClass("accounting-css-error");				
			check3 = 0;
		}

		if ($.trim(payee_prov).length >= 5) {			
			check4 = 1;
		}else{ 				
			check4 = 0;
		}

		if ($.trim(payee_zip).length >= 7) {
			$("#payee_zip").removeClass("accounting-css-error");
			$("#payee_zip").addClass("accounting-css-success");			
			check5 = 1;
		}else{ 
			toastr.error('Please Enter Valid Postal Code','System Message:');
			$("#payee_zip").removeClass("accounting-css-success");
			$("#payee_zip").addClass("accounting-css-error");				
			check5 = 0;
		}

		if (payee_email_check != false) {
			$("#payee_email").removeClass("accounting-css-error");
			$("#payee_email").addClass("accounting-css-success");			
			check6 = 1;
		}else{ 
			toastr.error('Please Enter Valid Payee Email.','System Message:');
			$("#payee_email").removeClass("accounting-css-success");
			$("#payee_email").addClass("accounting-css-error");				
			check6 = 0;
		}	

		if (payee_phone.length == 14) {
			$("#payee_phone").removeClass("accounting-css-error");
			$("#payee_phone").addClass("accounting-css-success");			
			check7 = 1;
		}else{ 
			toastr.error('Please Enter Valid Phone Number.','System Message:');
			$("#payee_phone").removeClass("accounting-css-success");
			$("#payee_phone").addClass("accounting-css-error");				
			check7 = 0;
		} */		

		if (check1 === 1 /* && check2 === 1 && check3 === 1 && check4 === 1 && check5 === 1 && check6 === 1 && check7 === 1 */) {
			$("#payee_add_submit").prop("disabled", true);
			$("#payee_add_submit").html("<span class='glyphicon glyphicon-refresh glyphicon-refresh-animate'></span> Processing...");	
			$(".close_main").prop("disabled", true);
			toastr.remove();			
			swal({
			  allowOutsideClick: false,
			  allowEscapeKey: false,
			  allowEnterKey: false,			
			  title: 'Add New Payee? ',
			  html: '<strong><h3>"'+payee_name+'"</strong></h3>',
			  type: 'info',
			  showCancelButton: true,
			  showLoaderOnConfirm: true,
			  confirmButtonColor: '#62cb31',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Yes!'
			}).then(function () {
					var formData = new FormData(); 
					formData.append('payee_name', payee_name);
					formData.append('payee_address', payee_address);
					formData.append('payee_city', payee_city);
					formData.append('payee_prov', payee_prov);
					formData.append('payee_zip', payee_zip);
					formData.append('payee_info', payee_info);
					formData.append('payee_email', payee_email);
					formData.append('payee_phone', payee_phone);
					formData.append('user_id', username);
					
					$.ajax({
						type: "POST",
						url: "./services/payee.php",
						data: formData,
						cache: false,
						contentType: false,
						processData: false,					
						beforeSend: function(){},
						success: function(data){
							$("#payee_add_submit").prop("disabled", true);
							$("#payee_add_submit").html("Add");
							$(".close_js").prop("disabled", true);						
							swal({
							  allowOutsideClick: false,
							  allowEscapeKey: false,
							  allowEnterKey: false,			
							  title: 'Added!',
							  html: 'Redirecting... <i class="glyphicon glyphicon-repeat gly-spin"></i>',
							  type: 'success',
							  timer: 2000,
							  showLoaderOnConfirm: true,
							  confirmButtonColor: '#62cb31',
							  confirmButtonText: 'Okie!'
							}).then (function(){
								document.location.reload(true);
							}, function (dismiss){					
									if (dismiss === 'timer') {//cancel button hit
										document.location.reload(true);
									}					
							   });
						}
					});						
					
				}, function (dismiss){					
					if (dismiss === 'cancel') {//cancel button hit
						$("#payee_add_submit").prop("disabled", false);
						$("#payee_add_submit").html("Submit");
						$(".close_main").prop("disabled", false);
						$('#payee_name').removeClass("accounting-css-success").removeClass("accounting-css-error");	
						$('#payee_address').removeClass("accounting-css-success").removeClass("accounting-css-error");	
						$('#payee_city').removeClass("accounting-css-success").removeClass("accounting-css-error");	
						$('#payee_province').removeClass("accounting-css-success").removeClass("accounting-css-error");	
						$('#payee_zip').removeClass("accounting-css-success").removeClass("accounting-css-error");	
						$('#payee_info').removeClass("accounting-css-success").removeClass("accounting-css-error");					
						$('#payee_email').removeClass("accounting-css-success").removeClass("accounting-css-error");					
						$('#payee_phone').removeClass("accounting-css-success").removeClass("accounting-css-error");							
						
					}					
				});			
		}
	
	});
	
	
	$('.close_js').click(function(){
	var payee_id = $(this).attr('id').split('_');
	var info = 'close_id='+payee_id[1];
		$.ajax({
			type: "POST",
			url: "./services/payee.php",
			data: info,
			cache: false,			
			beforeSend: function(){},
			success: function(data){
				var payee_json_return = $.parseJSON(data);//php to jquery json for payee info.
				payee_json_return = payee_json_return[0];
				
				var payee_name = payee_json_return.name;
				var payee_address = payee_json_return.address;
				var payee_city = payee_json_return.city;
				var payee_province = payee_json_return.province;
				var payee_postal = payee_json_return.postal;
				var payee_info = payee_json_return.info;
				var payee_email = payee_json_return.email;
				var payee_phone = payee_json_return.phone;
				
				$('#payee_name_'+payee_id[1]).val(payee_name);
				$('#payee_address_'+payee_id[1]).val(payee_address);
				$('#payee_city_'+payee_id[1]).val(payee_city);
				$('#payee_province_'+payee_id[1]).select2("val", payee_province);
				$('#payee_zip_'+payee_id[1]).val(payee_postal);
				$('#payee_info_'+payee_id[1]).val(payee_info);
				$('#payee_email_'+payee_id[1]).val(payee_email);
				$('#payee_phone_'+payee_id[1]).val(payee_phone);
			}
		});	
		$('#payee_name_'+payee_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");	
		$('#payee_address_'+payee_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");	
		$('#payee_city_'+payee_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");	
		$('#payee_province_'+payee_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");	
		$('#payee_zip_'+payee_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");	
		$('#payee_info_'+payee_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");					
		$('#payee_email_'+payee_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");					
		$('#payee_phone_'+payee_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");					
		toastr.remove();
		
		$('#checkbox_'+payee_id[1]).prop('checked', false);
		
		$('.readonly_'+payee_id[1]).each(function(){
			$(this).attr('disabled', 'disabled');
		});
		
		$('#switch_'+payee_id[1]).html("Viewing:");			
	});
	
	$('.close_main').click(function(){	
		$('#payee_name, #payee_address, #payee_city, #payee_zip , #payee_info, #payee_email, #payee_phone').val('');
		$('#payee_prov').select2("val", 'Alberta');
		$('#payee_name, #payee_address, #payee_city, #payee_prov, #payee_zip , #payee_info, #payee_email, #payee_phone').removeClass("accounting-css-success");		
		$('#payee_name, #payee_address, #payee_city, #payee_prov, #payee_zip , #payee_info, #payee_email, #payee_phone').removeClass("accounting-css-error");		
		toastr.remove();
	});	

	$('.remodal_view').click(function(){
		var input_array = [];
		var i = 0;
		
		var payee_name;
		var payee_address;
		var payee_city;
		var payee_province;
		var payee_zip;
		var payee_info;
		var payee_phone;
		var payee_email;
		
		var payee_id = $(this).attr('id');
		var payee_id_array = payee_id.split('_');
		
		payee_id = payee_id_array[2];
		$('.field_value_'+payee_id).each(function(){
			input_array[i] = this.value;
			i++;
		});		
		payee_name = input_array[0];
		payee_address = input_array[1];
		payee_city = input_array[4];
		payee_province = $('#payee_province_'+payee_id).find('option:selected').text();
		payee_email = input_array[2];
		payee_phone = input_array[3];
		payee_zip = input_array[5].toUpperCase();
		payee_info = input_array[6];

		$('#payee_zip_'+payee_id).mask("S9S 9S9");
		$('#payee_phone_'+payee_id).mask("(999) 999-9999");
		
		$('#payee_name_'+payee_id).change('input propertychange', function() {
			var payee_name = $('#payee_name_'+payee_id).val();
			if ($.trim(payee_name).length > 2) {
				$('#payee_name_'+payee_id).removeClass("accounting-css-error");
				$('#payee_name_'+payee_id).addClass("accounting-css-success");
				toastr.success('Payee Name Okay!','System Message:');			
			}else{ 
				$('#payee_name_'+payee_id).removeClass("accounting-css-success");
				$('#payee_name_'+payee_id).addClass("accounting-css-error");
				toastr.error('Please Enter a Valid Payee Name.','System Message:');						
			}	
		});

		$('#payee_address_'+payee_id).change('input propertychange', function() {
			var payee_address = $('#payee_address_'+payee_id).val();
			if ($.trim(payee_address).length > 5) {
				$('#payee_address_'+payee_id).removeClass("accounting-css-error");
				$('#payee_address_'+payee_id).addClass("accounting-css-success");
				toastr.success('Payee Address Okay!','System Message:');			
			}else{ 
				$('#payee_address_'+payee_id).removeClass("accounting-css-success");
				$('#payee_address_'+payee_id).addClass("accounting-css-error");
				toastr.error('Please Enter a Valid Payee Address.','System Message:');						
			}	
		});

		$('#payee_city_'+payee_id).change('input propertychange', function() {
			var payee_city = $('#payee_city_'+payee_id).val();
			if ($.trim(payee_city).length > 5) {
				$('#payee_city_'+payee_id).removeClass("accounting-css-error");
				$('#payee_city_'+payee_id).addClass("accounting-css-success");
				toastr.success('Payee City Okay!','System Message:');			
			}else{ 
				$('#payee_city_'+payee_id).removeClass("accounting-css-success");
				$('#payee_city_'+payee_id).addClass("accounting-css-error");
				toastr.error('Please Enter a Valid Payee City.','System Message:');						
			}	
		});

		$('#payee_zip_'+payee_id).change('input propertychange', function() {
			var payee_zip = $('#payee_zip_'+payee_id).val();
			if ($.trim(payee_zip).length >= 7) {
				$('#payee_zip_'+payee_id).removeClass("accounting-css-error");
				$('#payee_zip_'+payee_id).addClass("accounting-css-success");
				toastr.success('Payee Postal Code Okay!','System Message:');			
			}else{ 
				$('#payee_zip_'+payee_id).removeClass("accounting-css-success");
				$('#payee_zip_'+payee_id).addClass("accounting-css-error");
				toastr.error('Please Enter a Valid Payee Postal Code.','System Message:');						
			}	
		});
		
		$('#payee_email_'+payee_id).change('input propertychange', function() {
			var payee_email = $('#payee_email_'+payee_id).val();
			payee_email_check = isEmail(payee_email);
			if (payee_email_check != false) {
				$('#payee_email_'+payee_id).removeClass("accounting-css-error");
				$('#payee_email_'+payee_id).addClass("accounting-css-success");
				toastr.success('Payee Email Okay!','System Message:');			
			}else{ 
				$('#payee_email_'+payee_id).removeClass("accounting-css-success");
				$('#payee_email_'+payee_id).addClass("accounting-css-error");
				toastr.error('Please Enter a Valid Payee Email.','System Message:');						
			}	
		});	
		
		$('#payee_phone_'+payee_id).change('input propertychange', function() {
			var payee_phone = $('#payee_phone_'+payee_id).val();
			if (payee_phone.length == 14) {
				$('#payee_phone_'+payee_id).removeClass("accounting-css-error");
				$('#payee_phone_'+payee_id).addClass("accounting-css-success");
				toastr.success('Payee Phone Number Okay!','System Message:');			
			}else{ 
				$('#payee_phone_'+payee_id).removeClass("accounting-css-success");
				$('#payee_phone_'+payee_id).addClass("accounting-css-error");
				toastr.error('Please Enter a Valid Payee Phone Number.','System Message:');						
			}	
		});			
	});	

	$('.edit_view').click(function(){ //submit		
		var input_array = [];
		var i = 0;
		
		var payee_name;
		var payee_address;
		var payee_city;
		var payee_province;
		var payee_zip;
		var payee_info;
		var payee_phone;
		var payee_email;
		
		var payee_id = $(this).attr('id');
		var payee_id_array = payee_id.split('_');

		var check1;
		var check2;
		var check3;
		var check4;
		var check5;
		var check6;
		var check7;

		payee_id = payee_id_array[2];
		$('.field_value_'+payee_id).each(function(){
			input_array[i] = this.value;
			i++;
		});	
		
		var check_box = $('#checkbox_'+payee_id).prop('checked');
		if (check_box == false){
			toastr.error('To Save, Please Enter Edit Mode.','System Message:');		
		}else {	
			payee_name = capWords(input_array[0]);
			payee_address = capWords(input_array[1]);
			payee_city = capWords(input_array[4]);
			payee_email = input_array[2];
			payee_phone = capWords(input_array[3]);
			payee_province = $('#payee_province_'+payee_id).find('option:selected').text();
			payee_zip = input_array[5].toUpperCase();
			payee_info = input_array[6];
			if ($.trim(payee_name).length > 2) {
				$('#payee_name_'+payee_id).removeClass("accounting-css-error");
				$('#payee_name_'+payee_id).addClass("accounting-css-success");
				check1 = 1;
			}else{ 
				$('#payee_name_'+payee_id).removeClass("accounting-css-success");
				$('#payee_name_'+payee_id).addClass("accounting-css-error");
				toastr.error('Please Enter a Valid Payee Name.','System Message:');	
				check1 = 0;
			}	

/* 			if ($.trim(payee_address).length > 5) {
				$('#payee_address_'+payee_id).removeClass("accounting-css-error");
				$('#payee_address_'+payee_id).addClass("accounting-css-success");
				check2 = 1;
			}else{ 
				$('#payee_address_'+payee_id).removeClass("accounting-css-success");
				$('#payee_address_'+payee_id).addClass("accounting-css-error");
				toastr.error('Please Enter a Valid Payee Address.','System Message:');	
				check2 = 0;		
			}	

			if ($.trim(payee_city).length > 5) {
				$('#payee_city_'+payee_id).removeClass("accounting-css-error");
				$('#payee_city_'+payee_id).addClass("accounting-css-success");
				check3 = 1;
			}else{ 
				$('#payee_city_'+payee_id).removeClass("accounting-css-success");
				$('#payee_city_'+payee_id).addClass("accounting-css-error");
				toastr.error('Please Enter a Valid Payee City.','System Message:');
				check3 = 0;			
			}
			
			if ($.trim(payee_province).length >= 5) {

				check4 = 1;
			}else{ 
				check4 = 0;				
			}	

			if ($.trim(payee_zip).length >= 7) {
				$('#payee_zip_'+payee_id).removeClass("accounting-css-error");
				$('#payee_zip_'+payee_id).addClass("accounting-css-success");
				check5 = 1;
			}else{
				$('#payee_zip_'+payee_id).removeClass("accounting-css-success");
				$('#payee_zip_'+payee_id).addClass("accounting-css-error");
				toastr.error('Please Enter a Valid Payee Postal Code.','System Message:');
				check5 = 0;
			}
			
			var payee_email_check = isEmail(payee_email);
			if (payee_email_check != false) {
				$('#payee_email_'+payee_id).removeClass("accounting-css-error");
				$('#payee_email_'+payee_id).addClass("accounting-css-success");			
				check6 = 1;
			}else{ 
				toastr.error('Please Enter Valid Payee Email.','System Message:');
				$('#payee_email_'+payee_id).removeClass("accounting-css-success");
				$('#payee_email_'+payee_id).addClass("accounting-css-error");				
				check6 = 0;
			}	

			if (payee_phone.length == 14) {
				$('#payee_phone_'+payee_id).removeClass("accounting-css-error");
				$('#payee_phone_'+payee_id).addClass("accounting-css-success");			
				check7 = 1;
			}else{ 
				toastr.error('Please Enter Valid Phone Number.','System Message:');
				$('#payee_phone_'+payee_id).removeClass("accounting-css-success");
				$('#payee_phone_'+payee_id).addClass("accounting-css-error");				
				check7 = 0;
			} */		
			
			if (check1 === 1/*  && check2 === 1 && check3 === 1 && check4 === 1 && check5 === 1 && check6 === 1 && check7 === 1 */) {
				$(".edit_view").prop("disabled", true);
				$(".button_delete").prop("disabled", true);
				$(".edit_view").html("<span class='glyphicon glyphicon-refresh glyphicon-refresh-animate'></span> Processing...");	
				$(".close_js").prop("disabled", true);				
				var user = $('#hidden_username').val();
				var formData = new FormData(); 
				formData.append('payee_id', payee_id);
				formData.append('payee_name_edit', payee_name);
				formData.append('payee_address_edit', payee_address);
				formData.append('payee_city_edit', payee_city);
				formData.append('payee_prov_edit', payee_province);
				formData.append('payee_zip_edit', payee_zip);
				formData.append('payee_info_edit', payee_info);
				formData.append('payee_email_edit', payee_email);
				formData.append('payee_phone_edit', payee_phone);
				formData.append('user_id', user);

				swal({
				  allowOutsideClick: false,
				  allowEscapeKey: false,
				  allowEnterKey: false,			
				  title: 'Update it Now?',
				  type: 'info',
				  showCancelButton: true,
				  showLoaderOnConfirm: true,
				  confirmButtonColor: '#62cb31',
				  cancelButtonColor: '#d33',
				  confirmButtonText: 'Yes!'
				}).then(function () {
						$.ajax({
							type: "POST",
							url: "./services/payee.php",
							data: formData,
							cache: false,
							contentType: false,
							processData: false,				
							beforeSend: function(){},
							success: function(data){	
								swal({
								  allowOutsideClick: false,
								  allowEscapeKey: false,
								  allowEnterKey: false,			
								  title: 'Payee Info Updated!',
								  html: 'Redirecting <i class="glyphicon glyphicon-repeat gly-spin"></i>',
								  type: 'success',
								  timer: 2000,
								  showLoaderOnConfirm: true,
								  confirmButtonColor: '#62cb31',
								  confirmButtonText: 'Okie!'
								}).then (function(){
									document.location.reload(true);
								}, function (dismiss){					
										if (dismiss === 'timer') {//cancel button hit
											document.location.reload(true);
										}					
								   });   
							}
						});						
							
						
					}, function (dismiss){					
						if (dismiss === 'cancel') {//cancel button hit
							$(".edit_view").prop("disabled", false);
							$(".button_delete").prop("disabled", false);
							$(".edit_view").html("Save Changes");	
							$(".close_js").prop("disabled", false);
							$('#payee_name_'+payee_id).removeClass("accounting-css-success").removeClass("accounting-css-error");	
							$('#payee_address_'+payee_id).removeClass("accounting-css-success").removeClass("accounting-css-error");	
							$('#payee_city_'+payee_id).removeClass("accounting-css-success").removeClass("accounting-css-error");	
							$('#payee_province_'+payee_id).removeClass("accounting-css-success").removeClass("accounting-css-error");	
							$('#payee_zip_'+payee_id).removeClass("accounting-css-success").removeClass("accounting-css-error");	
							$('#payee_info_'+payee_id).removeClass("accounting-css-success").removeClass("accounting-css-error");					
							$('#payee_email_'+payee_id).removeClass("accounting-css-success").removeClass("accounting-css-error");					
							$('#payee_phone_'+payee_id).removeClass("accounting-css-success").removeClass("accounting-css-error");								
						}					
					});						

			}			
		}			
		
	})

	$('.button_delete').click(function(){
		var payee_id = $(this).attr('id');
		var payee_id_array = payee_id.split('_');

		payee_id = payee_id_array[1];		
		
		var check_box = $('#checkbox_'+payee_id).prop('checked');
		if (check_box == false){
			toastr.error('To Delete, Please Enter Edit Mode.','System Message:');
		}else {			
		$(".edit_view").prop("disabled", true);
		$(".button_delete").prop("disabled", true);
		$(".edit_view").html("<span class='glyphicon glyphicon-refresh glyphicon-refresh-animate'></span> Processing...");	
		$(".close_js").prop("disabled", true);		
		var payee_id = $(this).attr('id').split('_');
		var info = 'delete_id='+payee_id[1];
			swal({
			  allowOutsideClick: false,
			  allowEscapeKey: false,
			  allowEnterKey: false,			
			  title: 'Are you sure you want to delete this?',
			  text: 'This action is permanent!', 
			  type: 'error',
			  showCancelButton: true,
			  showLoaderOnConfirm: true,
			  confirmButtonColor: '#e60000',
			  cancelButtonColor: '#e6e6e6',
			  confirmButtonText: 'Delete'
			}).then(function () {
				$.ajax({
					type: "POST",
					url: "./services/payee.php",
					data: info,
					cache: false,			
					beforeSend: function(){},
					success: function(data){		
						swal({
						  allowOutsideClick: false,
						  allowEscapeKey: false,
						  allowEnterKey: false,			
						  title: 'Payee Deleted!',
						  html: 'Redirecting <i class="glyphicon glyphicon-repeat gly-spin"></i>',
						  type: 'success',
						  timer: 2000,
						  showLoaderOnConfirm: true,
						  confirmButtonColor: '#62cb31',
						  confirmButtonText: 'Okie!'
						}).then (function(){
							document.location.reload(true);
						}, function (dismiss){					
								if (dismiss === 'timer') {//cancel button hit
									document.location.reload(true);
								}					
						   }); 
						   
					}
				});						
					
				
			}, function (dismiss){					
				if (dismiss === 'cancel') {//cancel button hit
					$(".edit_view").prop("disabled", false);
					$(".button_delete").prop("disabled", false);
					$(".edit_view").html("Save Changes");	
					$(".close_js").prop("disabled", false);
				}					
			});	
		}	
	});

	$('.edit_mode').click(function() {
		if($(this).prop('checked')){
			var this_id = $(this).attr('id');
			var this_id_array = this_id.split('_');
			this_id = this_id_array[1];
			
			$('.readonly_'+this_id).each(function(){
				$(this).removeAttr('disabled');
			});				
			
			$('#switch_'+this_id).html("Editing:");			
		}else {
			var payee_id = $(this).attr('id').split('_');
			var info = 'close_id='+payee_id[1];
				$.ajax({
					type: "POST",
					url: "./services/payee.php",
					data: info,
					cache: false,			
					beforeSend: function(){},
					success: function(data){
						var payee_json_return = $.parseJSON(data);//php to jquery json for payee info.
						payee_json_return = payee_json_return[0];
						
						var payee_name = payee_json_return.name;
						var payee_address = payee_json_return.address;
						var payee_city = payee_json_return.city;
						var payee_province = payee_json_return.province;
						var payee_postal = payee_json_return.postal;
						var payee_info = payee_json_return.info;
						var payee_email = payee_json_return.email;
						var payee_phone = payee_json_return.phone;
						
						$('#payee_name_'+payee_id[1]).val(payee_name);
						$('#payee_address_'+payee_id[1]).val(payee_address);
						$('#payee_city_'+payee_id[1]).val(payee_city);
						$('#payee_province_'+payee_id[1]).select2("val", payee_province);
						$('#payee_zip_'+payee_id[1]).val(payee_postal);
						$('#payee_info_'+payee_id[1]).val(payee_info);
						$('#payee_email_'+payee_id[1]).val(payee_email);
						$('#payee_phone_'+payee_id[1]).val(payee_phone);
					}
				});	
				$('#payee_name_'+payee_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");	
				$('#payee_address_'+payee_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");	
				$('#payee_city_'+payee_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");	
				$('#payee_province_'+payee_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");	
				$('#payee_zip_'+payee_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");	
				$('#payee_info_'+payee_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");					
				$('#payee_email_'+payee_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");					
				$('#payee_phone_'+payee_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");					
				toastr.remove();
				
				$('#checkbox_'+payee_id[1]).prop('checked', false);
				
				$('.readonly_'+payee_id[1]).each(function(){
					$(this).attr('disabled', 'disabled');
				});
				
				$('#switch_'+payee_id[1]).html("Viewing:");		
		}
	});		
	
});

