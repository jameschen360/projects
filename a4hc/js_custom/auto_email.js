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
 
	function isEmail(email) {
	  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	  return regex.test(email);
	}	
	
	$('#emailing_auto_name').change('input propertychange', function() {
		var emailing_auto_name = $('#emailing_auto_name').val();
		var email_check = isEmail(emailing_auto_name)
		if (email_check == false) {	
			toastr.error('Please Input a Valid Email.','System Message:');
			$("#emailing_auto_name").removeClass("accounting-css-success").addClass("accounting-css-error");			
			check1 = 0;
		}else {
			$("#emailing_auto_name").addClass("accounting-css-success").removeClass("accounting-css-error");			
			check1 = 1;		
			toastr.remove();
		}
	});
	
	$('#emailing_save').click(function(){
		var emailing_auto_name = $('#emailing_auto_name').val();
		var email_check = isEmail(emailing_auto_name)
		if (email_check == false) {	
			toastr.error('Please Input a Valid Email.','System Message:');
			$("#emailing_auto_name").removeClass("accounting-css-success").addClass("accounting-css-error");			
			check1 = 0;
		}else {
			$("#emailing_auto_name").addClass("accounting-css-success").removeClass("accounting-css-error");			
			check1 = 1;		
			toastr.remove();
		}		
				
		if (check1 === 1) {
			var user_id = $('#user_id_settings').val();	
			var password_emailing = $('#passwor_emailing').val();	
			
			var formData = new FormData($('#emailing_info')); 
			formData.append('emailing_auto_name', emailing_auto_name);
			formData.append('password_emailing', password_emailing);
			
			$("#emailing_save").prop("disabled", true);
			$("#emailing_save").html("<span class='glyphicon glyphicon-refresh glyphicon-refresh-animate'></span> Saving...");	
			$(".close_main").prop("disabled", true);	
			$('.user_box').removeClass("accounting-css-success");	
			$.ajax({
				type: "POST",
				url: "./services/auto_email.php",
				data: formData,
				cache: false,
				contentType: false,
				processData: false,					
				beforeSend: function(){},
				success: function(data){
					$("#emailing_save").prop("disabled", false);
					$("#emailing_save").html("Save Settings");	
					$(".close_main").prop("disabled", false);					
						swal({
						  allowOutsideClick: false,
						  allowEscapeKey: false,
						  allowEnterKey: false,			
						  title: 'Auto Mailing Service Saved!',
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
	
	$('.close_main_email').click(function(){
	toastr.remove();
	var info = 'close=okay';
		$.ajax({
			type: "POST",
			url: "./services/auto_email.php",
			data: info,
			cache: false,			
			beforeSend: function(){},
			success: function(data){
				var json_return = $.parseJSON(data);//php to jquery json for payee info.
				json_return = json_return[0];
				
				var email_auto = json_return.email;
				var password_auto = json_return.pwd;
				
				$('#emailing_auto_name').val(email_auto);
				$('#passwor_emailing').val(password_auto);
				
				$('.user_box').removeClass("accounting-css-success accounting-css-error");
			}
		});			
	});	
});

