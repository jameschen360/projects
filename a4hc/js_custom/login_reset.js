$(document).on('closing', '.remodal', function (e) {

  // Reason: 'confirmation', 'cancellation'
  
	$("#username_email").removeClass("accounting-css-error");
	$("#username_email").removeClass("accounting-css-success");
	$("#username_email").val("");
	
	
	//console.log('Modal is closing' + (e.reason ? ', reason: ' + e.reason : ''));

});

$(document).ready(function(){
		
	function isEmail(email) {
	  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	  return regex.test(email);
	}
	
	
	$('#username_email').change('input propertychange', function() {
		var employee_email = $('#username_email').val();
		employee_email_check = isEmail(employee_email);
		if (employee_email_check != false) {
			$("#username_email").removeClass("accounting-css-error");
			$("#username_email").addClass("accounting-css-success");
		}else{ 
			$("#username_email").removeClass("accounting-css-success");
			$("#username_email").addClass("accounting-css-error");
		}
	});
		
	$('#password_confirm_submit').click(function(){
		var employee_email = $('#username_email').val();
		employee_email_check = isEmail(employee_email);
		if (employee_email_check != false) {
			$("#username_email").removeClass("accounting-css-error");
			$("#username_email").addClass("accounting-css-success");
			var check=1;
		}else{ 
			$("#username_email").removeClass("accounting-css-success");
			$("#username_email").addClass("accounting-css-error");
			var check=0;
		}
		
		if (check ==1){
		var username_email = $('#username_email').val();
		console.log(username_email);
			
			swal({
			  allowOutsideClick: false,
			  allowEscapeKey: false,
			  allowEnterKey: false,			
			  title: 'Reset Password? ',
			  html: '<strong><h3>'+'Send Email to ' + username_email+' ?</strong></h3>',
			  type: 'info',
			  showCancelButton: true,
			  showLoaderOnConfirm: true,
			  confirmButtonColor: '#62cb31',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Yes!'
			}).then(function () {
				var formData = new FormData();
				formData.append('email',username_email);
				$.LoadingOverlay("show");
					$.ajax({
						type: "POST",
						url: "./services/login_reset.php",
						data: formData,
						cache: false,
						contentType: false,
						processData: false,					
						beforeSend: function(){},
						success: function(data){
							$.LoadingOverlay("hide", true);
							swal({
							  allowOutsideClick: false,
							  allowEscapeKey: false,
							  allowEnterKey: false,			
							  title: 'Email Sent!',
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
				
			}); 
		} else {
			swal({
			  allowOutsideClick: false,
			  allowEscapeKey: false,
			  allowEnterKey: false,			
			  title: 'Please Enter a Valid Email',
			  type: 'info',
			  //showCancelButton: true,
			  //showLoaderOnConfirm: true,
			  confirmButtonColor: '#62cb31',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Okay'
			})
		
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		});

});