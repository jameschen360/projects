



$(document).ready(function(){
	
$(document).unbind('keydown.remodal');

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

var username = $('#hidden_username').val();

	function isEmail(email) {
	  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	  return regex.test(email);
	}


p_code = $('#employee_p_code').val();
p_code = p_code.toUpperCase();



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


	$('#fname').change('input propertychange', function() {
		var f_name = $('#fname').val();
		if ($.trim(f_name).length > 1) {
			$("#fname").removeClass("accounting-css-error");
			$("#fname").addClass("accounting-css-success");		
		}else{ 
			$("#fname").removeClass("accounting-css-success");
			$("#fname").addClass("accounting-css-error");
			toastr.error('Please Enter a Valid First Name.','System Message:');						
		}	
	});
	
	$('#lname').change('input propertychange', function() {
		var l_name = $('#lname').val();
		if ($.trim(l_name).length > 1) {
			$("#lname").removeClass("accounting-css-error");
			$("#lname").addClass("accounting-css-success");
		}else{ 
			$("#lname").removeClass("accounting-css-success");
			$("#lname").addClass("accounting-css-error");
			toastr.error('Please Enter a Valid Last Name.','System Message:');						
		}	
	});	
	
	$('#email').change('input propertychange', function() {
		var employee_email = $('#email').val();
		employee_email_check = isEmail(employee_email);
		if (employee_email_check != false) {
			//$("#email").removeClass("accounting-css-error");
			//$("#email").addClass("accounting-css-success");
			
			var formData = new FormData();
			formData.append('email', employee_email);
			formData.append('email_check', employee_email);
			$.ajax({
						type: "POST",
						url: "./services/employees.php",
						data: formData,
						cache: false,
						contentType: false,
						processData: false,					
						beforeSend: function(){},
						success: function(data){
							if (data == 0){
								$("#email").removeClass("accounting-css-error");
								$("#email").addClass("accounting-css-success");
							} else{
								$("#email").removeClass("accounting-css-success");
								$("#email").addClass("accounting-css-error");
								toastr.error('Email has been used. Please enter an unregistered email.','System Message:');
							}
						}
							
						
					});	
		}else{ 
			$("#email").removeClass("accounting-css-success");
			$("#email").addClass("accounting-css-error");
			toastr.error('Please Enter a Valid Email.','System Message:');
		}
	});

	$('#ep_super').change('select propertychange', function() {
		var ep_super = $('#ep_super').val();
		if (ep_super != null) {
			$("#ep_super").removeClass("accounting-css-error");
			$("#ep_super").addClass("accounting-css-success");
		}else{ 
			$("#ep_super").removeClass("accounting-css-success");
			$("#ep_super").addClass("accounting-css-error");
			toastr.error('Please Enter a Supervisor.','System Message:');						
		}	
	});
	
	// $('#password').change('input propertychange', function() {
	// 	var password= $('#password').val();
	// 	if (password.length > 5) {
	// 		$("#password").removeClass("accounting-css-error");
	// 		$("#password").addClass("accounting-css-success");
	// 	}else{ 
	// 		$("#password").removeClass("accounting-css-success");
	// 		$("#password").addClass("accounting-css-error");
	// 		toastr.error('Please Enter a Valid Password.','System Message:');
	// 	}	
	// });
	
	// $('#repeat_password').change('input propertychange', function() {
	// 	var repeat_password = $('#repeat_password').val();
	// 	var password= $('#password').val();
	// 	if (password==repeat_password) {
	// 		$("#repeat_password").removeClass("accounting-css-error");
	// 		$("#repeat_password").addClass("accounting-css-success");
	// 	}else{ 
	// 		$("#repeat_password").removeClass("accounting-css-success");
	// 		$("#repeat_password").addClass("accounting-css-error");
	// 		toastr.error('Please Matching Password.','System Message:');
	// 	}	
	// });

	// $('#employee_m_phone').change('input propertychange', function() {
	// 	var employee_m_phone = $('#employee_m_phone').val();
	// 	if (employee_m_phone.length == 14) {
	// 		$("#employee_m_phone").removeClass("accounting-css-error");
	// 		$("#employee_m_phone").addClass("accounting-css-success");
	// 	}else{ 
	// 		$("#employee_m_phone").removeClass("accounting-css-success");
	// 		$("#employee_m_phone").addClass("accounting-css-error");
	// 		toastr.error('Please Enter a Valid Phone Number.','System Message:');						
	// 	}	
	// });
	
	// $('#employee_h_phone').change('input propertychange', function() {
	// 	var employee_h_phone = $('#employee_h_phone').val();
	// 	if (employee_h_phone.length == 14) {
	// 		$("#employee_h_phone").removeClass("accounting-css-error");
	// 		$("#employee_h_phone").addClass("accounting-css-success");
	// 	}else{ 
	// 		$("#employee_h_phone").removeClass("accounting-css-success");
	// 		$("#employee_h_phone").addClass("accounting-css-error");
	// 		toastr.error('Please Enter a Valid Phone Number.','System Message:');						
	// 	}	
	// });

	// $('#employee_address').change('input propertychange', function() {
	// 	var employee_address = $('#employee_address').val();
	// 	if ($.trim(employee_address).length > 5) {
	// 		$("#employee_address").removeClass("accounting-css-error");
	// 		$("#employee_address").addClass("accounting-css-success");		
	// 	}else{ 
	// 		$("#employee_address").removeClass("accounting-css-success");
	// 		$("#employee_address").addClass("accounting-css-error");
	// 		toastr.error('Please Enter a Valid Address.','System Message:');						
	// 	}	
	// });

	// $('#employee_city').change('input propertychange', function() {
	// 	var employee_city = $('#employee_city').val();
	// 	if ($.trim(employee_city).length > 2) {
	// 		$("#employee_city").removeClass("accounting-css-error");
	// 		$("#employee_city").addClass("accounting-css-success");		
	// 	}else{ 
	// 		$("#employee_city").removeClass("accounting-css-success");
	// 		$("#employee_city").addClass("accounting-css-error");
	// 		toastr.error('Please Enter a Valid City.','System Message:');						
	// 	}	
	// });
	
	// $('#employee_country').change('input propertychange', function() {
	// 	var employee_country = $('#employee_country').val();
	// 	if ($.trim(employee_country).length > 3) {
	// 		$("#employee_country").removeClass("accounting-css-error");
	// 		$("#employee_country").addClass("accounting-css-success");	
	// 	}else{ 
	// 		$("#employee_country").removeClass("accounting-css-success");
	// 		$("#employee_country").addClass("accounting-css-error");
	// 		toastr.error('Please Enter a Valid Country.','System Message:');						
	// 	}	
	// });

	// $('#employee_p_code').change('input propertychange', function() {
	// 	var employee_p_code = $('#employee_p_code').val();
	// 	if ($.trim(employee_p_code).length == 7) {
	// 		$("#employee_p_code").removeClass("accounting-css-error");
	// 		$("#employee_p_code").addClass("accounting-css-success");
	// 	}else{ 
	// 		$("#employee_p_code").removeClass("accounting-css-success");
	// 		$("#employee_p_code").addClass("accounting-css-error");
	// 		toastr.error('Please Enter a Valid Postal Code.','System Message:');						
	// 	}	
	// });
	
	// $('#employee_vacation').change('input propertychange', function() {
	// 	var employee_vacation = $('#employee_vacation').val();
	// 	if ($.trim(employee_vacation).length > 2 || $.trim(employee_vacation).length < 1) {
	// 		$("#employee_vacation").removeClass("accounting-css-success");
	// 		$("#employee_vacation").addClass("accounting-css-error");
	// 		toastr.error('Please Enter a Valid Vacation Percentage.','System Message:');
	// 	}else{ 
	// 		$("#employee_vacation").removeClass("accounting-css-error");
	// 		$("#employee_vacation").addClass("accounting-css-success");
	// 	}	
	// });	
	
	// $('#employee_dob').change('input propertychange', function() {
	// 	var employee_dob = $('#employee_dob').val();
	// 	if ($.trim(employee_dob).length >= 8) {
	// 		$("#employee_dob").removeClass("accounting-css-error");
	// 		$("#employee_dob").addClass("accounting-css-success");	
	// 	}else{ 
	// 		$("#employee_dob").removeClass("accounting-css-success");
	// 		$("#employee_dob").addClass("accounting-css-error");
	// 		toastr.error('Please Select an Employee Type.','System Message:');						
	// 	}	
	// });

	// $('#employee_sin').change('input propertychange', function() {
	// 	var employee_sin = $('#employee_sin').val();
	// 	if ($.trim(employee_sin).length == 11) {
	// 		$("#employee_sin").removeClass("accounting-css-error");
	// 		$("#employee_sin").addClass("accounting-css-success");	
	// 	}else{ 
	// 		$("#employee_sin").removeClass("accounting-css-success");
	// 		$("#employee_sin").addClass("accounting-css-error");
	// 		toastr.error('Please Enter a Valid SIN number.','System Message:');						
	// 	}	
	// });

	// $('#position').change('input propertychange', function() {
	// 	var position = $('#position').val();
	// 	if ($.trim(position).length > 1) {
	// 		$("#position").removeClass("accounting-css-error");
	// 		$("#position").addClass("accounting-css-success");		
	// 	}else{ 
	// 		$("#position").removeClass("accounting-css-success");
	// 		$("#position").addClass("accounting-css-error");
	// 		toastr.error('Please Fill in Employee Position.','System Message:');						
	// 	}	
	// });
	
	// $('#employee_status').change('input propertychange', function() {
	// 	var employee_status = $('#employee_status').val();
	// 	if ($.trim(employee_status).length > 1) {
	// 		$("#employee_status").removeClass("accounting-css-error");
	// 		$("#employee_status").addClass("accounting-css-success");		
	// 	}else{ 
	// 		$("#employee_status").removeClass("accounting-css-success");
	// 		$("#employee_status").addClass("accounting-css-error");
	// 		toastr.error('Please Select Employee Status.','System Message:');						
	// 	}	
	// });	
	
	// $('#u_auth').change('input propertychange', function() {
	// 	var u_auth = $('#u_auth').val();
	// 	if ($.trim(u_auth).length > 1) {
	// 		$("#u_auth").removeClass("accounting-css-error");
	// 		$("#u_auth").addClass("accounting-css-success");		
	// 	}else{ 
	// 		$("#u_auth").removeClass("accounting-css-success");
	// 		$("#u_auth").addClass("accounting-css-error");
	// 		toastr.error('Please Enter a Valid Supervisor ID.','System Message:');						
	// 	}	
	// });
	
	
	
	
	
	
	
	
	
	
	
	
	
// $('#ep_type').change('input propertychange', function() {

// 		var contract_end_date = $('#contract_end_date').val();
// 		var contract_start_date = $('#contract_start_date').val();
// 		var date_check1 = Date.parseExact(contract_end_date, "yyyy/M/d");//check if date is in sql format
// 		var date_check2 = Date.parseExact(contract_start_date, "yyyy/M/d");//check if date is in sql format			
// 		//alert(date_check1);
// 		var ep_type = $("#ep_type").val();
// 		if (ep_type === "Contract") {
// 					$("#contract_dates").html('<div class="input-daterange row form-group text-center" style="padding-left:20px;" id="datepicker" >									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">										<div class="form-group">											<label class="control-label" for="date_from">Contract Start Date:<i class="text-danger"></i><span class="text-danger error_msg1"></span></label>											<a href="#"><input id="contract_start_date" placeholder="Click me to select a Date" type="text" value="" class="form-control type_info" name="start" readonly></a>										</div>									</div>									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">										<div class="form-group">											<label class="control-label text-center" for="date_to">Contract End Date:<i class="text-danger"></i><span class="text-danger error_msg1"></span></label>											<a href="#"><input id="contract_end_date" placeholder="Click me to select a Date" type="text" value="" class="form-control pull-right type_info" name="end" readonly></a>										</div>									</div>								</div>');
					
					
// 						$(function () {
// 							$('#project_table').dataTable({
// 								"aaSorting": [ [0,'desc'] ]
								
// 							});	

// 							// Initialize Date
// 							$('.input-daterange').datepicker({
// 								todayBtn: "linked",
// 								format: 'yyyy/m/d',
// 								autoclose: true,
								
// 							});	
							
							
// 							$(".project_select").select2();	
							
// 						});
					
// 					if (date_check1!=null || date_check2!=null) {
// 						//alert(date_check1);
						
						
// 						$("#contract_start_date, #contract_end_date").removeClass("accounting-css-error");
// 						$("#contract_start_date, #contract_end_date").addClass("accounting-css-success");
// 						check10 = 1;
						
// 							//if (filename) {
// 							//	alert(date_check1);
// 							//	check10 = 1;
// 							//}else {
// 							//	check10 = 0;
// 							//	toastr.error('Please Upload a Contract PDF.','System Message:')
// 							//}
								
// 					}else {
// 						//toastr.error('Please Input valid dates.','System Message:')
// 						//$("#contract_start_date, #contract_end_date").removeClass("accounting-css-success");
// 						//$("#contract_start_date, #contract_end_date").addClass("accounting-css-error");
// 						check10 = 0;
// 					}
// 		}else if (ep_type == "Other-specify in comments") {
// 			$("#contract_dates").html('');
// 			if ($.trim(employee_comments).length >= 1){
// 			$("#employee_comments").removeClass("accounting-css-error");
// 			$("#employee_comments").addClass("accounting-css-success");
// 			check10 = 1;
// 			} else{
// 			toastr.error('Please fill in comments!','System Message:')
// 			$("#employee_comments").removeClass("accounting-css-success");
// 			$("#employee_comments").addClass("accounting-css-error");
// 			check10 = 0;
// 			}
// 		}else{
// 			$("#contract_dates").html('');
// 			//$("#ep_type").removeClass("accounting-css-error");
// 			//$("#ep_type").addClass("accounting-css-success");
// 			check10 = 1;
// 		}
// 	});
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	/*$('#contract_end_date, #contract_start_date').on('change', function() {
		var contract_end_date = $('#contract_end_date').val();
		var contract_start_date = $('#contract_start_date').val();		
		var date_check1 = Date.parseExact(contract_end_date, "yyyy/M/d");//check if date is in sql format
		var date_check2 = Date.parseExact(contract_start_date, "yyyy/M/d");//check if date is in sql format			
		//alert(date_check1);
		if (date_check1!=null || date_check2!=null) {
			//alert(date_check1);
			$("#contract_start_date, #contract_end_date").removeClass("accounting-css-error");
			$("#contract_start_date, #contract_end_date").addClass("accounting-css-success");			
		}else {
			toastr.error('Please Input valid dates.','System Message:')
			$("#contract_start_date, #contract_end_date").removeClass("accounting-css-success");
			$("#contract_start_date, #contract_end_date").addClass("accounting-css-error");			
		}		
	});*/



		$('btn_tab1').on('shown.bs.tab', function (e) {
			if ($.trim(f_name).length == 0){
			$(".error_msg").html("Please fill in all fields");
			} else {
			$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
				$('a[data-toggle="tab"]').removeClass('btn-primary');
				$('a[data-toggle="tab"]').addClass('btn-default');
				$(this).removeClass('btn-default');
				$(this).addClass('btn-primary');
			})
			}
		})
	

		
        $('.next').click(function(){
		var next_id = $(this).attr('id');

		if (next_id == "next_new"){
			
		var fname = $('#fname').val();
		var lname = $('#lname').val();
		var employee_dob = $('#employee_dob').val();
		var employee_sin = $('#employee_sin').val();
		var email = $('#email').val();
		var employee_h_phone = $('#employee_h_phone').val();
		var employee_m_phone = $('#employee_m_phone').val();
		var employee_address = $('#employee_address').val();
		var employee_city = $('#employee_city').val();
		var employee_province = $('#employee_province').val();
		var employee_country = $('#employee_country').val();
		var employee_p_code = $('#employee_p_code').val();
		var ep_type = $('#ep_type').val();
		var employee_hours = $('#employee_hours').val();
		var employee_status = $('#email').val();
		var uauth = $('#uauth').val();

		fname = capWords(fname);
		lname = capWords(lname);
		employee_city= capWords(employee_city);
		employee_country= capWords(employee_country);
		employee_p_code = employee_p_code.toUpperCase();	
		
		var email_check = isEmail(email);
		var date_check1 = Date.parseExact(employee_dob, "yyyy/M/d");//check if date is in sql format		
		
		
		if ($.trim(fname).length > 1) {
			$("#fname").removeClass("accounting-css-error");
			$("#fname").addClass("accounting-css-success");			
			check1 = 1;
		}else{ 
			$("#fname").removeClass("accounting-css-success");
			$("#fname").addClass("accounting-css-error");				
			check1 = 0;	
		}

		if ($.trim(lname).length > 1) {
			$("#lname").removeClass("accounting-css-error");
			$("#lname").addClass("accounting-css-success");			
			check2 = 1;
		}else{ 
			$("#lname").removeClass("accounting-css-success");
			$("#lname").addClass("accounting-css-error");				
			check2 = 0;	
		}
			
		//alert(date_check1);
		// if (date_check1!=null) {
		// 	//alert(date_check1);
		// 	$("#employee_dob").removeClass("accounting-css-error");
		// 	$("#employee_dob").addClass("accounting-css-success");
		// 	check10 = 1;			
		// }else {
		// 	$("#employee_dob").removeClass("accounting-css-success");
		// 	$("#employee_dob").addClass("accounting-css-error");
		// 	check10 = 0;
		// }

		// if ($.trim(employee_sin).length == 11) {
		// 	$("#employee_sin").removeClass("accounting-css-error");
		// 	$("#employee_sin").addClass("accounting-css-success");	
		// 	check11 = 1;
		// }else{ 
		// 	$("#employee_sin").removeClass("accounting-css-success");
		// 	$("#employee_sin").addClass("accounting-css-error");
		// 	check11 = 0;
		// }	
		
		
		if (email_check != false) {
			
			var formData = new FormData();
			formData.append('email', email);
			formData.append('email_check', email);
			$.ajax({
						type: "POST",
						url: "./services/employees.php",
						data: formData,
						cache: false,
						contentType: false,
						processData: false,					
						beforeSend: function(){},
						success: function(data){
							if (data == 0){
								$("#email").removeClass("accounting-css-error");
								$("#email").addClass("accounting-css-success");
								check3 = 1;
								
							// if (employee_h_phone.length == 14) {
							// 	$("#employee_h_phone").removeClass("accounting-css-error");
							// 	$("#employee_h_phone").addClass("accounting-css-success");			
							// 	check4 = 1;
							// }else{ 
							// 	$("#employee_h_phone").removeClass("accounting-css-success");
							// 	$("#employee_h_phone").addClass("accounting-css-error");				
							// 	check4 = 0;
							// }
							
							// if (employee_m_phone.length == 14) {
							// 	$("#employee_m_phone").removeClass("accounting-css-error");
							// 	$("#employee_m_phone").addClass("accounting-css-success");			
							// 	check12 = 1;
							// }else{ 
							// 	$("#employee_m_phone").removeClass("accounting-css-success");
							// 	$("#employee_m_phone").addClass("accounting-css-error");				
							// 	check12 = 0;
							// }
							
							// if ($.trim(employee_address).length > 5) {
							// 	$("#employee_address").removeClass("accounting-css-error");
							// 	$("#employee_address").addClass("accounting-css-success");			
							// 	$("#employee_address").addClass("accounting-css-success");			
							// 	check5 = 1;
							// }else{ 
							// 	$("#employee_address").removeClass("accounting-css-success");
							// 	$("#employee_address").addClass("accounting-css-error");				
							// 	check5 = 0;
							// }

							// if ($.trim(employee_city).length > 2) {
							// 	$("#employee_city").removeClass("accounting-css-error");
							// 	$("#employee_city").addClass("accounting-css-success");			
							// 	check6 = 1;
							// }else{ 
							// 	$("#employee_city").removeClass("accounting-css-success");
							// 	$("#employee_city").addClass("accounting-css-error");				
							// 	check6 = 0;
							// }

							// if ($.trim(employee_province).length >= 5) {
							// 	check7 = 1;
							// }else{			
							// 	check7 = 0;
							// }
							
							// if ($.trim(employee_country).length > 5) {
							// 	$("#employee_country").removeClass("accounting-css-error");
							// 	$("#employee_country").addClass("accounting-css-success");			
							// 	check8 = 1;
							// }else{ 
							// 	$("#employee_country").removeClass("accounting-css-success");
							// 	$("#employee_country").addClass("accounting-css-error");				
							// 	check8 = 0;
							// }
							
							// if ($.trim(employee_p_code).length >= 7) {
							// 	$("#employee_p_code").removeClass("accounting-css-error");
							// 	$("#employee_p_code").addClass("accounting-css-success");			
							// 	check9 = 1;
							// }else{ 
							// 	$("#employee_p_code").removeClass("accounting-css-success");
							// 	$("#employee_p_code").addClass("accounting-css-error");				
							// 	check9 = 0;
							// }
							/*
							var password= $('#password').val();
							if (password.length > 5) {
								$("#password").removeClass("accounting-css-error");
								$("#password").addClass("accounting-css-success");
								check13 = 1;
							}else{ 
								$("#password").removeClass("accounting-css-success");
								$("#password").addClass("accounting-css-error");
								toastr.error('Please Enter a Valid Password.','System Message:');
								check13 = 0;
							}
							
							var repeat_password = $('#repeat_password').val();
							if (password==repeat_password) {
								$("#repeat_password").removeClass("accounting-css-error");
								$("#repeat_password").addClass("accounting-css-success");
								check14 = 1;
							}else{ 
								$("#repeat_password").removeClass("accounting-css-success");
								$("#repeat_password").addClass("accounting-css-error");
								toastr.error('Please Matching Password.','System Message:');
								check14 = 0;
							}	
					*/
					/*
						console.log(check1);
						console.log(check2);
						console.log(check3);
						console.log(check4);
						console.log(check5);
						console.log(check6);
						console.log(check7);
						console.log(check8);
						console.log(check9);
						console.log(check10);
						console.log(check11);
						console.log(check12);
						*/
					
							if (check1 === 1 && check2 === 1 && check3 === 1 /*&& check4 === 1 && check5 === 1 && check6 === 1 && check7 === 1 && check8 === 1 && check9 === 1 && check10 === 1 && check11 === 1 && check12 === 1 && check13 === 1 && check14 === 1*/){
									var nextId = $('#next_new').parents('.tab-pane').next().attr("id");
									var href_next = 'a[href="#'+ nextId +'"'+']';
									$(href_next).tab('show');
									$('.type_info1').removeClass("accounting-css-success").removeClass("accounting-css-error");	
								}			
								else{
								toastr.error('Please make sure all fields are filled in correctly','System Message:');	
								}							
								
				
								
							} else{
								$("#email").removeClass("accounting-css-success");
								$("#email").addClass("accounting-css-error");
								check3 = 0;
								toastr.error('Email has been used. Please enter an unregistered email.','System Message:');
							}
						}
							
						
					});	
		}else{
			$("#email").removeClass("accounting-css-success");
			$("#email").addClass("accounting-css-error");
			toastr.error('Please Enter a Valid Email.','System Message:');
			check3 = 0;
		}
		


			
		} else {

 		var nextId2 = $(this).parents('.tab-pane2').next().attr("id");
		var ep_id = $(this).attr('id').split('_');	
		ep_id=ep_id[2];
		
		var fname = $('#fname_'+ep_id).val();
		var lname = $('#lname_'+ep_id).val();
		var employee_dob = $('#employee_dob_'+ep_id).val();
		var employee_sin = $('#employee_sin_'+ep_id).val();
		var email = $('#email_'+ep_id).val();
		var employee_h_phone = $('#employee_h_phone_'+ep_id).val();
		var employee_m_phone = $('#employee_m_phone_'+ep_id).val();
		var employee_address = $('#employee_address_'+ep_id).val();
		var employee_city = $('#employee_city_'+ep_id).val();
		var employee_province = $('#employee_province_'+ep_id).val();
		var employee_country = $('#employee_country_'+ep_id).val();
		var employee_p_code = $('#employee_p_code_'+ep_id).val();
		var ep_type = $('#ep_type_'+ep_id).val();
		var employee_hours = $('#employee_hours_'+ep_id).val();
		var employee_status = $('#email_'+ep_id).val();
		var uauth = $('#uauth_'+ep_id).val();
		
		
		fname = capWords(fname);
		lname = capWords(lname);
		employee_city= capWords(employee_city);
		employee_country= capWords(employee_country);
		employee_p_code = employee_p_code.toUpperCase();	
		
		var email_check = isEmail(email);	
		var date_check1 = Date.parseExact(employee_dob, "yyyy/M/d");//check if date is in sql format		
		
		
		if ($.trim(fname).length > 1) {
			$("#fname").removeClass("accounting-css-error");
			$("#fname").addClass("accounting-css-success");			
			check1 = 1;
		}else{ 
			$("#fname").removeClass("accounting-css-success");
			$("#fname").addClass("accounting-css-error");				
			check1 = 0;	
		}

		if ($.trim(lname).length > 1) {
			$("#lname").removeClass("accounting-css-error");
			$("#lname").addClass("accounting-css-success");			
			check2 = 1;
		}else{ 
			$("#lname").removeClass("accounting-css-success");
			$("#lname").addClass("accounting-css-error");				
			check2 = 0;	
		}		
			
		
		// if (date_check1!=null) {
		// 	$("#employee_dob").removeClass("accounting-css-error");
		// 	$("#employee_dob").addClass("accounting-css-success");
		// 	check3 = 1;			
		// }else {
		// 	$("#employee_dob").removeClass("accounting-css-success");
		// 	$("#employee_dob").addClass("accounting-css-error");
		// 	check3 = 0;
		// }

		// if ($.trim(employee_sin).length == 11) {
		// 	$("#employee_sin").removeClass("accounting-css-error");
		// 	$("#employee_sin").addClass("accounting-css-success");	
		// 	check4 = 1;
		// }else{ 
		// 	$("#employee_sin").removeClass("accounting-css-success");
		// 	$("#employee_sin").addClass("accounting-css-error");
		// 	check4 = 0;
		// }	
		
		if (email_check != false) {
			$("#email").removeClass("accounting-css-error");
			$("#email").addClass("accounting-css-success");			
			check5 = 1;
		}else{ 
			$("#email").removeClass("accounting-css-success");
			$("#email").addClass("accounting-css-error");				
			check5 = 0;
		}
		
		// if (employee_h_phone.length == 14) {
		// 	$("#employee_h_phone").removeClass("accounting-css-error");
		// 	$("#employee_h_phone").addClass("accounting-css-success");			
		// 	check6 = 1;
		// }else{ 
		// 	$("#employee_h_phone").removeClass("accounting-css-success");
		// 	$("#employee_h_phone").addClass("accounting-css-error");				
		// 	check6 = 0;
		// }
		
		// if (employee_m_phone.length == 14) {
		// 	$("#employee_m_phone").removeClass("accounting-css-error");
		// 	$("#employee_m_phone").addClass("accounting-css-success");			
		// 	check7 = 1;
		// }else{ 
		// 	$("#employee_m_phone").removeClass("accounting-css-success");
		// 	$("#employee_m_phone").addClass("accounting-css-error");				
		// 	check7 = 0;
		// }
		
		// if ($.trim(employee_address).length > 5) {
		// 	$("#employee_address").removeClass("accounting-css-error");
		// 	$("#employee_address").addClass("accounting-css-success");			
		// 	$("#employee_address").addClass("accounting-css-success");			
		// 	check8 = 1;
		// }else{ 
		// 	$("#employee_address").removeClass("accounting-css-success");
		// 	$("#employee_address").addClass("accounting-css-error");				
		// 	check8 = 0;
		// }

		// if ($.trim(employee_city).length > 2) {
		// 	$("#employee_city").removeClass("accounting-css-error");
		// 	$("#employee_city").addClass("accounting-css-success");			
		// 	check9 = 1;
		// }else{ 
		// 	$("#employee_city").removeClass("accounting-css-success");
		// 	$("#employee_city").addClass("accounting-css-error");				
		// 	check9 = 0;
		// }

		// if ($.trim(employee_province).length >= 5) {
		// 	check10 = 1;
		// }else{			
		// 	check10 = 0;
		// }
		
		// if ($.trim(employee_country).length > 5) {
		// 	$("#employee_country").removeClass("accounting-css-error");
		// 	$("#employee_country").addClass("accounting-css-success");			
		// 	check11 = 1;
		// }else{ 
		// 	$("#employee_country").removeClass("accounting-css-success");
		// 	$("#employee_country").addClass("accounting-css-error");				
		// 	check11 = 0;
		// }
		
		// if ($.trim(employee_p_code).length >= 7) {
		// 	$("#employee_p_code").removeClass("accounting-css-error");
		// 	$("#employee_p_code").addClass("accounting-css-success");			
		// 	check12 = 1;
		// }else{ 
		// 	$("#employee_p_code").removeClass("accounting-css-success");
		// 	$("#employee_p_code").addClass("accounting-css-error");				
		// 	check12 = 0;
		// }
			

			 
 

 
		if (check1 === 1 && check2 === 1 && check5 === 1 /*&& check6 === 1 && check7 === 1 && check8 === 1 && check9 === 1 && check10 === 1 && check11 === 1 && check12 === 1*/){
				var ep_id = $(this).attr('id').split('_');	
				ep_id = ep_id[2];
				
				var nextId2 = $(this).parents('.tab-pane').next().attr("id");
				var href_next = 'a[href="#'+ nextId2 +'"'+']';
				$(href_next).tab('show');
				$('.type_info1').removeClass("accounting-css-success").removeClass("accounting-css-error");	
			}			
			else{
			toastr.error('Please fill in requried fields','System Message:');	
			}
		}
		
		})
	
		
        $('.prev').click(function(){
            var prevId = $(this).parents('.tab-pane').prev().attr("id");
            var href_prev = 'a[href="#'+ prevId +'"'+']';
			$(href_prev).tab('show');
			
			var tabId = prevId;

        })

	var upload_step_edit;
	var upload_global_edit;
	var upload_id_edit;

	$(".upload_link").on('click', function(e){ //UPLOAD LINKS
		e.preventDefault();
		upload_step = $(this).attr('id');
		upload_step = upload_step.split('_');
		upload_step = upload_step[1];
		$('#'+upload_step+':hidden').trigger('click');
	});	
	
	$(".upload_link_edit").on('click', function(e){ //UPLOAD LINKS
		e.preventDefault();
		
		var ep_id = $(this).attr('id').split('_');	
		ep_id=ep_id[2];
		
		upload_step_edit = $(this).attr('id');
		upload_step_edit = upload_step_edit.split('_');
		upload_id_edit = upload_step_edit[2];
		upload_step_edit = upload_step_edit[1];
		
		$('#'+upload_step_edit+'_'+upload_id_edit+':hidden').trigger('click');
	
	});	

	$('.upload_edit').change(function () { //UPLOAD LINK CHECK AND CSS UPDATE
	upload_global_edit = upload_step_edit;
	upload_global_id = upload_id_edit;
		var filename = $('#'+upload_global_edit+'_'+upload_global_id+':hidden').val();
		var extension_check = $('#'+upload_global_edit+'_'+upload_global_id+':hidden').val();

		if (extension_check != null) {
			extension_check = extension_check.substr( (extension_check.lastIndexOf('.') +1) ).toLowerCase();
		}		
		filename = filename.split('\\');
		filename = filename[2];
		
		if (filename != null && extension_check == "pdf") {
			$('.text_'+upload_global_edit+'_'+upload_global_id).html(filename+ '<span><i class="fa fa-check-circle text-success"></i></span><span id="'+upload_global_edit+'_x"><a id="remove_'+upload_global_edit+'_'+upload_global_id+'" href="#" class="pdf_remove"></a></span>');
			$('.'+upload_global_edit+'_'+'icon_'+upload_global_id).html('<i class="fa fa-file-pdf-o text-success"></i><p class="text-success">Attached</p>');
			$('#confirm_'+upload_global_edit+'_'+upload_global_id).val('attached');
			toastr.remove();
			
		}else {
			toastr.warning('Only PDF Documents are Allowed','System Message:');
			//$('#'+upload_global_edit+'_'+upload_global_id+':hidden').val('');
			//$('.text_'+upload_global_edit+'_'+upload_global_id).html('Select PDF Document');
			//$('.'+upload_global_edit+'_'+'icon_'+upload_global_id).html('<i class="fa fa-file-pdf-o text-danger"></i>');
			//$('#confirm_'+upload_global_edit+'_'+upload_global_id).val('removed');
		}
	});	
	
	$('.upload').change(function () { //UPLOAD LINK CHECK AND CSS UPDATE
		upload_global = upload_step;
		var filename = $('#'+upload_global+':hidden').val();
		var extension_check = $('#'+upload_global+':hidden').val();
		
		if (extension_check != null) {
			extension_check = extension_check.substr( (extension_check.lastIndexOf('.') +1) ).toLowerCase();
		}
		
		filename = filename.split('\\');
		filename = filename[2]
		
		if (filename != null && extension_check == "pdf") {
			$('.'+upload_global+'_icon').html('<i class="fa fa-file-pdf-o text-success"></i><p class="text-success">Attached</p>');
			$('.text_'+upload_global).html(filename+ '<span><i class="fa fa-check-circle text-success"></i></span><span id="'+upload_global+'_z"><a id="remove_'+upload_global+'" href="#" class="pdf_remove_add"><span class="pdf_label">X</span></a></span>');
			toastr.remove();
			
		}else {
			toastr.warning('Only PDF Documents are Allowed','System Message:');
			$('#'+upload_global+':hidden').val('');
			$('.text_'+upload_global).html('Select PDF Document');
			$('.'+upload_global+'_icon').html('<i class="fa fa-file-pdf-o text-danger"></i>');
		}
	});
	
	$(document).on('click', '.pdf_remove_add', function () {
		var id_array = $(this).attr('id');
		
		id_array = id_array.split('_');
		var pdf_id = id_array[1];
		
		$('#'+pdf_id+':hidden').val('');
		var inserts = 'Select PDF Document<span id="'+pdf_id+'_z"><a id="remove_'+pdf_id+'" href="" class="pdf_remove_add"><span class="pdf_label">X</span></a></span>';	
		$('.text_'+pdf_id).html(inserts);
		$('#'+pdf_id+'_z').hide();
		$('.'+pdf_id+'_icon').html('<i class="fa fa-file-pdf-o text-danger"></i>');
		
		toastr.warning('Document Removed.','System Message:');
		
	});
		/*
	$(document).on('click', '.pdf_remove', function () {
		var id_array = $(this).attr('id');
		id_array = id_array.split('_');
		var pdf_id = id_array[2];
		var pdf_type = id_array[1];
		
		
		$('#'+pdf_type+'_'+pdf_id+':hidden').val('');
		var inserts = 'Select PDF Document<span id="'+pdf_type+'_x"><a id="remove_'+pdf_type+'_'+pdf_id+'" href="" class="pdf_remove"><span class="pdf_label">X</span></a></span>';		
		$('.text_'+pdf_type+'_'+pdf_id).html(inserts);
		$('#'+pdf_type+'_x').hide();
		$('.'+pdf_type+'_'+'icon_'+pdf_id).html('<i class="fa fa-file-pdf-o text-danger"></i>');
		$('#confirm_'+pdf_type+'_'+pdf_id).val('removed');
		toastr.warning('Document Removed.','System Message:');
		
	});
	*/
 	$('#employee_submit').click(function(){
	var fname = $('#fname').val();
	var lname = $('#lname').val();
	var email = $('#email').val();
	var employee_dob = $('#employee_dob').val();
	var employee_sin = $('#employee_sin').val();
	var employee_h_phone = $('#employee_h_phone').val();
	var employee_m_phone = $('#employee_m_phone').val();
	var employee_address = $('#employee_address').val();
	var employee_city = $('#employee_city').val();
	var employee_province = $('#employee_province').val();
	var employee_country = $('#employee_country').val();
	var employee_p_code = $('#employee_p_code').val();
	var position= $('#position').val();
	var timesheet_type= $('#timesheet_type').val();
	var ep_type = $('#ep_type').val();
	var employee_status = $('#employee_status').val();
	var employee_hours = $('#employee_hours').val();
	var contract_start_date = $('#contract_start_date').val();
	var contract_end_date = $('#contract_end_date').val();
	var uauth = $('#uauth').val();
	var ep_super = $('#ep_super').val();
	var employee_vacation =$('#employee_vacation').val();
	var employee_comments =$('#employee_comments').val();
	var proposal=$('#proposal').val();
	var filename=$('#contract').val();
	/*var password= $('#password').val();
	var repeat_password = $('#repeat_password').val();*/
	

	fname = capWords(fname);
	lname = capWords(lname);
	employee_city= capWords(employee_city);
	employee_country= capWords(employee_country);
	employee_p_code = employee_p_code.toUpperCase();
	
	/*Reme,ber to uppercase all other appropriate shit*/
	
	var email_check = isEmail(email);
	var dob_check = Date.parseExact(employee_dob, "yyyy/M/d");//check if date is in sql format		
	
		if ($.trim(fname).length > 1) {
			$("#fname").removeClass("accounting-css-error");
			$("#fname").addClass("accounting-css-success");			
			check1 = 1;
		}else{ 
			$("#fname").removeClass("accounting-css-success");
			$("#fname").addClass("accounting-css-error");				
			check1 = 0;	
		}

		if ($.trim(lname).length > 1) {
			$("#lname").removeClass("accounting-css-error");
			$("#lname").addClass("accounting-css-success");			
			check2 = 1;
		}else{ 
			$("#lname").removeClass("accounting-css-success");
			$("#lname").addClass("accounting-css-error");				
			check2 = 0;	
		}		


		// if (dob_check!=null) {
		// 	//alert(date_check1);
		// 	$("#employee_dob").removeClass("accounting-css-error");
		// 	$("#employee_dob").addClass("accounting-css-success");
		// 	check15 = 1;			
		// }else {
		// 	$("#employee_dob").removeClass("accounting-css-success");
		// 	$("#employee_dob").addClass("accounting-css-error");
		// 	check15 = 0;
		// }

		// if ($.trim(employee_sin).length == 11) {
		// 	$("#employee_sin").removeClass("accounting-css-error");
		// 	$("#employee_sin").addClass("accounting-css-success");	
		// 	check16 = 1;
		// }else{ 
		// 	$("#employee_sin").removeClass("accounting-css-success");
		// 	$("#employee_sin").addClass("accounting-css-error");
		// 	check16 = 0;
		// }

		
		/*if (email_check != false) {
			$("#email").removeClass("accounting-css-error");
			$("#email").addClass("accounting-css-success");			
			check3 = 1;
		}else{ 
			$("#email").removeClass("accounting-css-success");
			$("#email").addClass("accounting-css-error");				
			check3 = 0;
		}*/
		
		if (email_check != false) {
			
			var formData = new FormData();
			formData.append('email', email);
			formData.append('email_check', email);
			$.ajax({
						type: "POST",
						url: "./services/employees.php",
						data: formData,
						cache: false,
						contentType: false,
						processData: false,					
						beforeSend: function(){},
						success: function(data){
							if (data == 0){
								$("#email").removeClass("accounting-css-error");
								$("#email").addClass("accounting-css-success");
								check3 = 1;
							} else{
								$("#email").removeClass("accounting-css-success");
								$("#email").addClass("accounting-css-error");
								check3 = 0;
								toastr.error('Email has been used. Please enter an unregistered email.','System Message:');
							}
						}
							
						
					});	
		}else{ 
			$("#email").removeClass("accounting-css-success");
			$("#email").addClass("accounting-css-error");
			toastr.error('Please Enter a Valid Email.','System Message:');
		}

		if (ep_super.length > 1) {
			$("#ep_super").removeClass("accounting-css-error");
			$("#ep_super").addClass("accounting-css-success");
			check4 = 1;
		}else{ 
			$("#ep_super").removeClass("accounting-css-success");
			$("#ep_super").addClass("accounting-css-error");
			toastr.error('Please Enter a Supervisor.','System Message:');
			check4 = 0;
		}
		
		// if (employee_h_phone.length == 14) {
		// 	$("#employee_h_phone").removeClass("accounting-css-error");
		// 	$("#employee_h_phone").addClass("accounting-css-success");			
		// 	check4 = 1;
		// }else{ 
		// 	$("#employee_h_phone").removeClass("accounting-css-success");
		// 	$("#employee_h_phone").addClass("accounting-css-error");				
		// 	check4 = 0;
		// }
		
		// if (employee_m_phone.length == 14) {
		// 	$("#employee_m_phone").removeClass("accounting-css-error");
		// 	$("#employee_m_phone").addClass("accounting-css-success");			
		// 	check4 = 1;
		// }else{ 
		// 	$("#employee_m_phone").removeClass("accounting-css-success");
		// 	$("#employee_m_phone").addClass("accounting-css-error");				
		// 	check4 = 0;
		// }
		
		// if ($.trim(employee_address).length > 5) {
		// 	$("#employee_address").removeClass("accounting-css-error");
		// 	$("#employee_address").addClass("accounting-css-success");
		// 	check5 = 1;
		// }else{ 
		// 	$("#employee_address").removeClass("accounting-css-success");
		// 	$("#employee_address").addClass("accounting-css-error");
		// 	check5 = 0;
		// }

		// if ($.trim(employee_city).length > 2) {
		// 	$("#employee_city").removeClass("accounting-css-error");
		// 	$("#employee_city").addClass("accounting-css-success");			
		// 	check6 = 1;
		// }else{ 
		// 	$("#employee_city").removeClass("accounting-css-success");
		// 	$("#employee_city").addClass("accounting-css-error");				
		// 	check6 = 0;
		// }

		// if ($.trim(employee_province).length >= 5) {
		// 	$("#employee_province").removeClass("accounting-css-error");
		// 	$("#employee_province").addClass("accounting-css-success");			
		// 	check7 = 1;
		// }else{
		// 	$("#employee_province").removeClass("accounting-css-success");
		// 	$("#employee_province").addClass("accounting-css-error");				
		// 	check7 = 0;
		// }
		
		// if ($.trim(employee_country).length > 5) {
		// 	$("#employee_country").removeClass("accounting-css-error");
		// 	$("#employee_country").addClass("accounting-css-success");			
		// 	check8 = 1;
		// }else{ 
		// 	$("#employee_country").removeClass("accounting-css-success");
		// 	$("#employee_country").addClass("accounting-css-error");				
		// 	check8 = 0;
		// }
		
		// if ($.trim(employee_p_code).length == 7) {
		// 	$("#employee_p_code").removeClass("accounting-css-error");
		// 	$("#employee_p_code").addClass("accounting-css-success");			
		// 	check9 = 1;
		// }else{ 
		// 	$("#employee_p_code").removeClass("accounting-css-success");
		// 	$("#employee_p_code").addClass("accounting-css-error");				
		// 	check9 = 0;
		// }

		// if ($.trim(ep_type).length >= 5){		
		// var date_check1 = Date.parseExact(contract_end_date, "yyyy/M/d");//check if date is in sql format
		// var date_check2 = Date.parseExact(contract_start_date, "yyyy/M/d");//check if date is in sql format
		// //alert(date_check1);
		// if (ep_type == "Contract") {
		// 			if (date_check1!=null || date_check2!=null) {
		// 				//alert(date_check1);
		// 				$("#contract_start_date, #contract_end_date").removeClass("accounting-css-error");
		// 				$("#contract_start_date, #contract_end_date").addClass("accounting-css-success");
		// 				check10 = 1;

								
						
		// 			}else {
		// 				toastr.error('Please Input valid dates.','System Message:')
		// 				$("#contract_start_date, #contract_end_date").removeClass("accounting-css-success");
		// 				$("#contract_start_date, #contract_end_date").addClass("accounting-css-error");
		// 				check10 = 0;
		// 			}
		// }else if (ep_type == "Other-specify in comments") {
		// 	if ($.trim(employee_comments).length >= 1){
		// 	$("#employee_comments").removeClass("accounting-css-error");
		// 	$("#employee_comments").addClass("accounting-css-success");
		// 	check10 = 1;
		// 	} else{
		// 	toastr.error('Please fill in comments!','System Message:')
		// 	$("#employee_comments").removeClass("accounting-css-success");
		// 	$("#employee_comments").addClass("accounting-css-error");
		// 	check10 = 0;
		// 	}
		// }else{
		// 	//$("#ep_type").removeClass("accounting-css-error");
		// 	//$("#ep_type").addClass("accounting-css-success");
		// 	check10 = 1;
		// }
		
		// }
		
		// if ($.trim(proposal).length > 0) {
		// 	//alert(date_check1);
		// 	check19 = 1;
		// }else {
		// 	check19 = 0;
		// 	toastr.error('Please Upload a Contract PDF.','System Message:')
		// 	console.log('iamssad');
		// }


		// if ($.trim(position).length > 1) {
		// 	$("#position").removeClass("accounting-css-error");
		// 	$("#position").addClass("accounting-css-success");
		// 	check17 = 1;			
		// }else{ 
		// 	$("#position").removeClass("accounting-css-success");
		// 	$("#position").addClass("accounting-css-error");
		// 	check17 = 0;
		// }			
		
		// 	if ($.trim(employee_hours).length >= 5) {
		// 			if (employee_hours == "Other-specify in comments") {
		// 				if ($.trim(employee_comments).length >= 1){
		// 				$('#employee_comments').removeClass("accounting-css-error");
		// 				$('#employee_comments').addClass("accounting-css-success");
		// 				check11 = 1;
		// 				} else{
		// 				toastr.error('Please fill in comments!','System Message:')
		// 				$('#employee_comments').removeClass("accounting-css-success");
		// 				$('#employee_comments').addClass("accounting-css-error");
		// 				check11 = 0;
		// 				}
		// 			} else{
		// 			check11 = 1;
		// 			}
		// 	}else{ 
		// 			$('#employee_hours').removeClass("accounting-css-success");
		// 			$('#employee_hours').addClass("accounting-css-error");	
		// 			check11 = 0;
		// 	}
		

		// 	if ($.trim(employee_status).length >= 5) {
		// 			if (employee_status== "Other-specify in comments") {
		// 				if ($.trim(employee_comments).length >= 1){
		// 				$('#employee_comments').removeClass("accounting-css-error");
		// 				$('#employee_comments').addClass("accounting-css-success");
		// 				check12 = 1;
		// 				} else{
		// 				toastr.error('Please fill in comments!','System Message:')
		// 				$('#employee_comments').removeClass("accounting-css-success");
		// 				$('#employee_comments').addClass("accounting-css-error");
		// 				check12 = 0;
		// 				}
		// 			} else{
		// 			check12 = 1;
		// 			}
		// 	}else{ 
		// 			$('#employee_status').removeClass("accounting-css-success");
		// 			$('#employee_status').addClass("accounting-css-error");	
		// 			check12 = 0;
		// 	}		
		
		
		// if ($.trim(uauth).length >= 5) {
		// 	if (uauth == "Employee"){
		// 		var uauth = 'regular';
		// 	}	else if(uauth == "Supervisor"){
		// 		var uauth = 'super';
		// 	}  else if(uauth == "Admin"){
		// 		var uauth = 'admin';
		// 	}
		// 	check13 = 1;
		// }else{ 	
		// 	check13 = 0;
		// }
		
		// if ($.trim(employee_vacation).length > 2 || $.trim(employee_vacation).length < 1) {
		// 	$("#employee_vacation").removeClass("accounting-css-success");
		// 	$("#employee_vacation").addClass("accounting-css-error");
		// 	check14 = 0;
		// }else{ 
		// 	$("#employee_vacation").removeClass("accounting-css-error");
		// 	$("#employee_vacation").addClass("accounting-css-success");
		// 	check14 = 1;
		// }
		
		// if ($.trim(proposal).length > 3) {
		// 	check18 = 1;
		// }else{ 
		// 	check18 = 0;
		// 	toastr.error('Please Upload Employee Contract.','System Message:');
		// }
		

		/*if (password.length > 5) {
			$("#password").removeClass("accounting-css-error");
			$("#password").addClass("accounting-css-success");
			check19 = 1;
		}else{ 
			$("#password").removeClass("accounting-css-success");
			$("#password").addClass("accounting-css-error");
			toastr.error('Please Enter a Valid Password.','System Message:');
			check19 = 0;
		}
		
		if (password==repeat_password) {
			$("#repeat_password").removeClass("accounting-css-error");
			$("#repeat_password").addClass("accounting-css-success");
			check20 = 1;
		}else{ 
			$("#repeat_password").removeClass("accounting-css-success");
			$("#repeat_password").addClass("accounting-css-error");
			toastr.error('Please Matching Password.','System Message:');
			check20 = 0;
		}	
		password=$('#md5_password').val();*/
		
		if (check1 === 1 && check2 === 1 && check3 === 1 && check4 === 1 /*&& check5 === 1 && check6 === 1 && check7 === 1 && check8 === 1 && check9 === 1 && check10 === 1 && check11 === 1 && check12 === 1  && check13 === 1 && check14 === 1 && check15 === 1 && check16 === 1 && check17 === 1 && check18 === 1 && check19 === 1 && check20 === 1*/) {
			$("#employee_submit").prop("disabled", true);
			$("#employee_submit").html("<span class='glyphicon glyphicon-refresh glyphicon-refresh-animate'></span> Processing...");	
			$(".close_main").prop("disabled", true);
			toastr.remove();
			var file_contract = $('#proposal')[0].files[0];
			swal({
			  allowOutsideClick: false,
			  allowEscapeKey: false,
			  allowEnterKey: false,			
			  title: 'Add New Employee? ',
			  html: '<strong><h3>'+fname+ ' '+lname+'</strong></h3>',
			  type: 'info',
			  showCancelButton: true,
			  showLoaderOnConfirm: true,
			  confirmButtonColor: '#62cb31',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Yes!'
			}).then(function () {
					var formData = new FormData();
					formData.append('fname', fname);
					formData.append('lname', lname);
					formData.append('email', email);
					formData.append('employee_dob', employee_dob);
					formData.append('employee_sin', employee_sin);
					formData.append('employee_h_phone', employee_h_phone);
					formData.append('employee_m_phone', employee_m_phone);
					formData.append('employee_address', employee_address);
					formData.append('employee_city', employee_city);
					formData.append('employee_province', employee_province);
					formData.append('employee_country', employee_country);
					formData.append('employee_p_code', employee_p_code);
					formData.append('position', position);
					formData.append('timesheet_type', timesheet_type);
					formData.append('ep_type', ep_type);
					formData.append('employee_hours', employee_hours);
					formData.append('employee_status', employee_status);
					formData.append('contract_start_date', contract_start_date);
					formData.append('contract_end_date', contract_end_date);
					formData.append('uauth', uauth);
					formData.append('ep_super', ep_super);
					formData.append('employee_vacation', employee_vacation);
					formData.append('employee_comments', employee_comments);
					formData.append('user_id', username);
					formData.append('file_contract', file_contract);
					/*formData.append('password', password);*/
					$.LoadingOverlay("show");
					$.ajax({
						type: "POST",
						url: "./services/employees.php",
						data: formData,
						cache: false,
						contentType: false,
						processData: false,					
						beforeSend: function(){},
						success: function(data){
							$.LoadingOverlay("hide", true);
							$("#employee_submit").prop("disabled", true);
							$("#employee_submit").html("Add");
							$(".close_js").prop("disabled", true);
							$(".prev").prop("disabled",true);

							if (data === 'registered'){
								toastr.error('E-mail is already in use. Change employee information or use a different e-mail.','System Message:');								
							} else {
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
										document.location.reload(true);}}
										);
										
										
										
							}
							}//else statement
					});						
					
				}, function (dismiss){					
					if (dismiss === 'cancel') {//cancel button hit
						$("#employee_submit").prop("disabled", false);
						$("#employee_submit").html("Submit");
						$(".close_main").prop("disabled", false);
						$('.type_info').removeClass("accounting-css-success").removeClass("accounting-css-error");	
						$('.type_info').removeClass("accounting-css-success").removeClass("accounting-css-error");								
						
					}					
				});			
		}
	
	});
 
 	$('.close_js').click(function(){
	var ep_id = $(this).attr('id').split('_');
	var info = 'close_id='+ep_id[1];
		$.ajax({
			type: "POST",
			url: "./services/employees.php",
			data: info,
			cache: false,			
			beforeSend: function(){},
			success: function(data){
				var ep_json_return = $.parseJSON(data);//php to jquery json for payee info.
				
				ep_json_return = ep_json_return[0];
				
						var ep_fname = ep_json_return.fname;
						var ep_lname = ep_json_return.lname;
						var email = ep_json_return.username;
						var employee_dob = ep_json_return.dob;
						var employee_sin  = ep_json_return.sin;
						var employee_h_phone = ep_json_return.h_phone;
						var employee_m_phone = ep_json_return.m_phone;
						var employee_address = ep_json_return.address;
						var employee_city = ep_json_return.city;
						var employee_province = ep_json_return.province;
						var employee_country = ep_json_return.country;
						var employee_p_code = ep_json_return.p_code;
						var position = ep_json_return.position;
						var ep_type = ep_json_return.ep_type;
						var employee_hours = ep_json_return.hours;
						var employee_status = ep_json_return.status;
						var contract_start_date = ep_json_return.start_date;
						var contract_end_date = ep_json_return.end_date;
						var uauth = ep_json_return.uauth;
						var ep_super = ep_json_return.ep_super;
						var employee_vacation = ep_json_return.vacation;
						var employee_comments = ep_json_return.comments;
				
						$('#fname_'+ep_id[1]).val(ep_fname);
						$('#lname_'+ep_id[1]).val(ep_lname);
						$('#email_'+ep_id[1]).val(email);
						$('#employee_dob_'+ep_id[1]).val(employee_dob);
						$('#employee_sin_'+ep_id[1]).val(employee_sin);
						$('#employee_h_phone_'+ep_id[1]).val(employee_h_phone);
						$('#employee_m_phone_'+ep_id[1]).val(employee_m_phone);
						$('#employee_address_'+ep_id[1]).val(ep_address);
						$('#employee_city_'+ep_id[1]).val(employee_city);
						$('#employee_province_'+ep_id[1]).select2("val", employee_province);
						$('#employee_country_'+ep_id[1]).val(employee_country);
						$('#employee_p_code_'+ep_id[1]).val(employee_p_code);
						$('#position_'+ep_id[1]).val(position);
						$('#ep_type_'+ep_id[1]).val(ep_type);
						$('#employee_hours_'+ep_id[1]).val(employee_hours);
						$('#employee_status_'+ep_id[1]).val(employee_status);
						$('#countract_start_date_'+ep_id[1]).val(contract_start_date);
						$('#countract_end_date_'+ep_id[1]).val(contract_end_date);
						$('#uauth_'+ep_id[1]).val(uauth);
						$('#ep_super_'+ep_id[1]).val(ep_super);
						$('#employee_vacation_'+ep_id[1]).val(employee_vacation);
						$('#employee_comments_'+ep_id[1]).val(employee_comments);
			}
		});
		
		$.ajax({
			type: "POST",
			url: "./services/employees.php",
			data: info,
			cache: false,			
			beforeSend: function(){},
			success: function(data){
				var ep_json_return = $.parseJSON(data);//php to jquery json for payee info.
				ep_json_return = ep_json_return[0];
				
						var fname = ep_json_return.fname;
						var lname = ep_json_return.lname;
						var email = ep_json_return.email;
						var employee_dob = ep_json_return.dob;
						var employee_sin  = ep_json_return.sin;
						var employee_h_phone = ep_json_return.h_phone;
						var employee_m_phone = ep_json_return.m_phone;
						var employee_address = ep_json_return.address;
						var employee_city = ep_json_return.city;
						var employee_province = ep_json_return.province;
						var employee_country = ep_json_return.country;
						var employee_p_code = ep_json_return.p_code;
						var position = ep_json_return.position;
						var ep_type = ep_json_return.ep_type;
						var employee_hours = ep_json_return.hours;
						var employee_status = ep_json_return.status;
						var contract_start_date = ep_json_return.start_date;
						var contract_end_date = ep_json_return.end_date;
						var uauth = ep_json_return.uauth;
						var ep_super = ep_json_return.ep_super;
						var employee_vacation = ep_json_return.vacation;
						var employee_comments = ep_json_return.comments;
				
						$('#fname_'+ep_id[1]).val(fname);
						$('#lname_'+ep_id[1]).val(lname);
						$('#email_'+ep_id[1]).val(email);
						$('#employee_dob_'+ep_id[1]).val(employee_dob);
						$('#employee_sin_'+ep_id[1]).val(employee_sin);
						$('#employee_h_phone_'+ep_id[1]).val(employee_h_phone);
						$('#employee_m_phone_'+ep_id[1]).val(employee_m_phone);
						$('#employee_address_'+ep_id[1]).val(ep_address);
						$('#employee_city_'+ep_id[1]).val(employee_city);
						$('#employee_province_'+ep_id[1]).select2("val", employee_province);
						$('#employee_country_'+ep_id[1]).val(employee_country);
						$('#employee_p_code_'+ep_id[1]).val(employee_p_code);
						$('#position_'+ep_id[1]).val(position);
						$('#ep_type_'+ep_id[1]).val(ep_type);
						$('#employee_hours_'+ep_id[1]).val(employee_hours);
						$('#employee_status_'+ep_id[1]).val(employee_status);
						$('#countract_start_date_'+ep_id[1]).val(contract_start_date);
						$('#countract_end_date_'+ep_id[1]).val(contract_end_date);
						$('#uauth_'+ep_id[1]).val(uauth);
						$('#ep_super_'+ep_id[1]).val(ep_super);
						$('#employee_vacation_'+ep_id[1]).val(employee_vacation);
						$('#employee_comments_'+ep_id[1]).val(employee_comments);
			}
		});
		
						$('#fname_'+ep_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");
						$('#lname_'+ep_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");
						$('#email_'+ep_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");
						$('#employee_dob_'+ep_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");
						$('#employee_sin_'+ep_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");
						$('#employee_h_phone_'+ep_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");
						$('#employee_m_phone_'+ep_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");
						$('#employee_address_'+ep_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");
						$('#employee_city_'+ep_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");
						$('#employee_province_'+ep_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");
						$('#employee_country_'+ep_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");
						$('#employee_p_code_'+ep_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");
						$('#position_'+ep_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");
						$('#ep_type_'+ep_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");
						$('#employee_hours_'+ep_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");
						$('#employee_status_'+ep_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");
						$('#countract_start_date_'+ep_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");
						$('#countract_end_date_'+ep_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");
						$('#uauth_'+ep_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");
						$('#ep_super_'+ep_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");
						$('#employee_vacation_'+ep_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");
						$('#employee_comments_'+ep_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");
						
		toastr.remove();
		
		$('#checkbox_'+ep_id[1]).prop('checked', false);
		
		$('.readonly_'+ep_id[1]).each(function(){
			$(this).attr('disabled', 'disabled');
		});
		
		$('#switch_'+ep_id[1]).html("Viewing:");			
	});
 
 	$('.remodal_view').click(function(){
		var input_array = [];
		var i = 0;
		
		var fname;
		var lname;
		var email;
		var employee_dob;
		var employee_sin;
		var employee_h_phone;
		var employee_m_phone;
		var employee_address;
		var employee_city;
		var employee_province;
		var employee_country;
		var employee_p_code;
		var position;
		var ep_type;
		var employee_hours;
		var employee_status;
		var contract_start_date;
		var contract_end_date;
		var uauth;
		var ep_super;
		var employee_vacation;
		var employee_comments;
		var user_id;
		
		var ep_id = $(this).attr('id');
		var ep_id_array = ep_id.split('_');
		
			
			
		ep_id = ep_id_array[2];
		
		$(".view_pdf_"+ep_id).show();
		$(".edit_pdf_"+ep_id).hide();
		
		$('.field_value_'+ep_id).each(function(){
			input_array[i] = this.value;
			i++;2
		});		
		fname = input_array[0];
		lname = input_array[1];
		email = input_array[2];
		employee_phone = input_array[3];
		employee_address = input_array[4];
		employee_city = input_array[5];
		employee_province = $('#employee_province_'+ep_id).find('option:selected').text();
		employee_country = input_array[6];
		employee_p_code = input_array[7];
		ep_type = input_array[8];
		employee_hours = input_array[9];
		employee_status = input_array[5];

		$('#employee_p_code_'+ep_id).mask("S9S 9S9");
		$(".province_select_"+ep_id).select2();	
		$("#employee_h_phone_"+ep_id).mask("(999) 999-9999");
		$("#employee_m_phone_"+ep_id).mask("(999) 999-9999");
		$("#employee_sin_"+ep_id).mask("999-999-999");
		$("#employee_vacation_"+ep_id).mask("99");
		
		$('#fname_'+ep_id).change('input propertychange', function() {
			var fname = $('#fname_'+ep_id).val();
			if ($.trim(fname).length > 1) {
				$('#fname_'+ep_id).removeClass("accounting-css-error");
				$('#fname_'+ep_id).addClass("accounting-css-success");
				toastr.success('Employee First Name Okay!','System Message:');			
			}else{ 
				$('#fname_'+ep_id).removeClass("accounting-css-success");
				$('#fname_'+ep_id).addClass("accounting-css-error");
				toastr.error('Please Enter a Valid First Name.','System Message:');						
			}	
		});

		$('#lname_'+ep_id).change('input propertychange', function() {
			var fname = $('#lname_'+ep_id).val();
			if ($.trim(fname).length > 2) {
				$('#lname_'+ep_id).removeClass("accounting-css-error");
				$('#lname_'+ep_id).addClass("accounting-css-success");
				toastr.success('Employee Last Name Okay!','System Message:');			
			}else{ 
				$('#lname_'+ep_id).removeClass("accounting-css-success");
				$('#lname_'+ep_id).addClass("accounting-css-error");
				toastr.error('Please Enter a Valid Last Name.','System Message:');						
			}	
		});
		
		$('#email_'+ep_id).change('input propertychange', function() {
			var fname = $('#email_'+ep_id).val();
			if ($.trim(fname).length > 2) {
				$('#email_'+ep_id).removeClass("accounting-css-error");
				$('#email_'+ep_id).addClass("accounting-css-success");
				toastr.success('Employee Email Okay!','System Message:');			
			}else{ 
				$('#email_'+ep_id).removeClass("accounting-css-success");
				$('#email_'+ep_id).addClass("accounting-css-error");
				toastr.error('Please Enter a Email.','System Message:');						
			}	
		});

		// $('#employee_dob_'+ep_id).change('input propertychange', function() {
		// 	var fname = $('#employee_dob_'+ep_id).val();
		// 	if ($.trim(fname).length > 2) {
		// 		$('#employee_dob_'+ep_id).removeClass("accounting-css-error");
		// 		$('#employee_dob_'+ep_id).addClass("accounting-css-success");
		// 	}else{ 
		// 		$('#employee_dob_'+ep_id).removeClass("accounting-css-success");
		// 		$('#employee_dob_'+ep_id).addClass("accounting-css-error");
		// 		toastr.error('Please Enter a Valid Date-of-Birth.','System Message:');						
		// 	}	
		// });
		
		// $('#employee_sin_'+ep_id).change('input propertychange', function() {
		// 	var fname = $('#employee_sin_'+ep_id).val();
		// 	if ($.trim(fname).length > 2) {
		// 		$('#employee_sin_'+ep_id).removeClass("accounting-css-error");
		// 		$('#employee_sin_'+ep_id).addClass("accounting-css-success");
		// 	}else{ 
		// 		$('#employee_sin_'+ep_id).removeClass("accounting-css-success");
		// 		$('#employee_sin_'+ep_id).addClass("accounting-css-error");
		// 		toastr.error('Please Enter a Valid SIN.','System Message:');						
		// 	}	
		// });
		
		// $('#employee_h_phone_'+ep_id).change('input propertychange', function() {
		// 	var fname = $('#employee_h_phone_'+ep_id).val();
		// 	if ($.trim(fname).length > 2) {
		// 		$('#employee_h_phone_'+ep_id).removeClass("accounting-css-error");
		// 		$('#employee_h_phone_'+ep_id).addClass("accounting-css-success");
		// 	}else{ 
		// 		$('#employee_h_phone_'+ep_id).removeClass("accounting-css-success");
		// 		$('#employee_h_phone_'+ep_id).addClass("accounting-css-error");
		// 		toastr.error('Please Enter a Valid Home Phone Number.','System Message:');						
		// 	}	
		// });

		// $('#employee_m_phone_'+ep_id).change('input propertychange', function() {
		// 	var fname = $('#employee_m_phone_'+ep_id).val();
		// 	if ($.trim(fname).length > 2) {
		// 		$('#employee_m_phone_'+ep_id).removeClass("accounting-css-error");
		// 		$('#employee_m_phone_'+ep_id).addClass("accounting-css-success");
		// 	}else{ 
		// 		$('#employee_m_phone_'+ep_id).removeClass("accounting-css-success");
		// 		$('#employee_m_phone_'+ep_id).addClass("accounting-css-error");
		// 		toastr.error('Please Enter a Valid Mobile Phone Number.','System Message:');						
		// 	}	
		// });		
		
		// $('#employee_address_'+ep_id).change('input propertychange', function() {
		// 	var fname = $('#employee_address_'+ep_id).val();
		// 	if ($.trim(fname).length > 5) {
		// 		$('#employee_address_'+ep_id).removeClass("accounting-css-error");
		// 		$('#employee_address_'+ep_id).addClass("accounting-css-success");
		// 	}else{ 
		// 		$('#employee_address_'+ep_id).removeClass("accounting-css-success");
		// 		$('#employee_address_'+ep_id).addClass("accounting-css-error");
		// 		toastr.error('Please Enter a Valid Address.','System Message:');						
		// 	}	
		// });

		// $('#employee_city_'+ep_id).change('input propertychange', function() {
		// 	var fname = $('#employee_city_'+ep_id).val();
		// 	if ($.trim(fname).length > 2) {
		// 		$('#employee_city_'+ep_id).removeClass("accounting-css-error");
		// 		$('#employee_city_'+ep_id).addClass("accounting-css-success");
		// 	}else{ 
		// 		$('#employee_city_'+ep_id).removeClass("accounting-css-success");
		// 		$('#employee_city_'+ep_id).addClass("accounting-css-error");
		// 		toastr.error('Please Enter a Valid City.','System Message:');						
		// 	}	
		// });

		// $('#employee_province_'+ep_id).change('input propertychange', function() {
		// 	var fname = $('#employee_province_'+ep_id).val();
		// 	if ($.trim(fname).length > 2) {
		// 		$('#employee_province_'+ep_id).removeClass("accounting-css-error");
		// 		$('#employee_province_'+ep_id).addClass("accounting-css-success");
		// 	}else{ 
		// 		$('#employee_province_'+ep_id).removeClass("accounting-css-success");
		// 		$('#employee_province_'+ep_id).addClass("accounting-css-error");
		// 		toastr.error('Please Enter a Valid Province.','System Message:');						
		// 	}	
		// });

		// $('#employee_country_'+ep_id).change('input propertychange', function() {
		// 	var fname = $('#employee_country_'+ep_id).val();
		// 	if ($.trim(fname).length > 2) {
		// 		$('#employee_country_'+ep_id).removeClass("accounting-css-error");
		// 		$('#employee_country_'+ep_id).addClass("accounting-css-success");
		// 	}else{ 
		// 		$('#employee_country_'+ep_id).removeClass("accounting-css-success");
		// 		$('#employee_country_'+ep_id).addClass("accounting-css-error");
		// 		toastr.error('Please Enter a Valid Country.','System Message:');						
		// 	}	
		// });

		// $('#employee_p_code_'+ep_id).change('input propertychange', function() {
		// 	var fname = $('#employee_p_code_'+ep_id).val();
		// 	if ($.trim(fname).length > 2) {
		// 		$('#employee_p_code_'+ep_id).removeClass("accounting-css-error");
		// 		$('#employee_p_code_'+ep_id).addClass("accounting-css-success");
		// 	}else{ 
		// 		$('#employee_p_code_'+ep_id).removeClass("accounting-css-success");
		// 		toastr.error('Please Enter a Valid Postal Code.','System Message:');						
		// 		$('#employee_p_code_'+ep_id).addClass("accounting-css-error");
		// 	}	
		// });

		// $('#position_'+ep_id).change('input propertychange', function() {
		// 	var fname = $('#position_'+ep_id).val();
		// 	if ($.trim(fname).length > 2) {
		// 		$('#position_'+ep_id).removeClass("accounting-css-error");
		// 		$('#position_'+ep_id).addClass("accounting-css-success");
		// 	}else{ 
		// 		$('#position_'+ep_id).removeClass("accounting-css-success");
		// 		$('#position_'+ep_id).addClass("accounting-css-error");
		// 		toastr.error('Please Enter a Valid Position.','System Message:');						
		// 	}	
		// });

		// $('#ep_type_'+ep_id).change('input propertychange', function() {
		// 	var fname = $('#ep_type_'+ep_id).val();
		// 	if ($.trim(fname).length > 2) {
		// 		$('#ep_type_'+ep_id).removeClass("accounting-css-error");
		// 		$('#ep_type_'+ep_id).addClass("accounting-css-success");
		// 	}else{ 
		// 		$('#ep_type_'+ep_id).removeClass("accounting-css-success");
		// 		$('#ep_type_'+ep_id).addClass("accounting-css-error");
		// 	}	
		// });
		
		
		
		
		
		
		
		// var contract_end_date_edit = $('#contract_end_date_'+ep_id).val();
		// var contract_start_date_edit = $('#contract_start_date_+ep_id').val();
		// var date_check1 = Date.parseExact(contract_end_date, "yyyy/M/d");//check if date is in sql format
		// var date_check2 = Date.parseExact(contract_start_date, "yyyy/M/d");//check if date is in sql format			
		// //alert(date_check1);
		// var ep_type_edit = $("#ep_type_"+ep_id).val();
		// if (ep_type_edit === "Contract") {
		// var contract_start_date_edit = $('#contract_start_date_'+ep_id).val();
		// 			$(".contract_dates_edit").attr('style','display: block;');
					
		// 				$(function () {
		// 					$('#project_table').dataTable({
		// 						"aaSorting": [ [0,'desc'] ]
								
		// 					});	

		// 					// Initialize Date
		// 					$('.input-daterange').datepicker({
		// 						todayBtn: "linked",
		// 						format: 'yyyy/m/d',
		// 						autoclose: true,
								
		// 					});	
							
							
		// 					$(".project_select").select2();	
							
		// 				});
					
		// 			if (date_check1!=null || date_check2!=null) {
		// 				//alert(date_check1);
						
						
		// 				$("#contract_start_date_"+ep_id, "#contract_end_date_"+ep_id).removeClass("accounting-css-error");
		// 				$("#contract_start_date_"+ep_id, "#contract_end_date_"+ep_id).addClass("accounting-css-success");
		// 				check10 = 1;
						
		// 					//if (filename) {
		// 					//	alert(date_check1);
		// 					//	check10 = 1;
		// 					//}else {
		// 					//	check10 = 0;
		// 					//	toastr.error('Please Upload a Contract PDF.','System Message:')
		// 					//}
								
						
		// 			}else {
		// 				//toastr.error('Please Input valid dates.','System Message:')
		// 				//$("#contract_start_date, #contract_end_date").removeClass("accounting-css-success");
		// 				//$("#contract_start_date, #contract_end_date").addClass("accounting-css-error");
		// 				check10 = 0;
		// 			}
					
		// }else if (ep_type == "Other-specify in comments") {
		// 	$(".contract_dates_edit").attr('style','display: none;');
		// 	if ($.trim(employee_comments).length >= 1){
		// 	$("#employee_comments").removeClass("accounting-css-error");
		// 	$("#employee_comments").addClass("accounting-css-success");
		// 	check10 = 1;
		// 	} else{
		// 	toastr.error('Please fill in comments!','System Message:')
		// 	$("#employee_comments").removeClass("accounting-css-success");
		// 	$("#employee_comments").addClass("accounting-css-error");
		// 	check10 = 0;
		// 	}
		// }else{
		// 	$(".contract_dates_edit").attr('style','display: none;');
		// 	//$("#ep_type").removeClass("accounting-css-error");
		// 	//$("#ep_type").addClass("accounting-css-success");
		// 	check10 = 1;
		// }
		
		
		
		
		
		
		
	// 	$('#ep_type_'+ep_id).change('input propertychange', function() {

	// 	var contract_end_date_edit = $('#contract_end_date_'+ep_id).val();
	// 	var contract_start_date_edit = $('#contract_start_date_+ep_id').val();
	// 	var date_check1 = Date.parseExact(contract_end_date, "yyyy/M/d");//check if date is in sql format
	// 	var date_check2 = Date.parseExact(contract_start_date, "yyyy/M/d");//check if date is in sql format			
	// 	//alert(date_check1);
	// 	var ep_type_edit = $("#ep_type_"+ep_id).val();
	// 	if (ep_type_edit === "Contract") {
	// 	var contract_start_date_edit = $('#contract_start_date_'+ep_id).val();
	// 				$(".contract_dates_edit").attr('style','display: block;');
					
	// 					$(function () {
	// 						$('#project_table').dataTable({
	// 							"aaSorting": [ [0,'desc'] ]
								
	// 						});	

	// 						// Initialize Date
	// 						$('.input-daterange').datepicker({
	// 							todayBtn: "linked",
	// 							format: 'yyyy/m/d',
	// 							autoclose: true,
								
	// 						});	
							
							
	// 						$(".project_select").select2();	
							
	// 					});
					
	// 				if (date_check1!=null || date_check2!=null) {
	// 					//alert(date_check1);
						
						
	// 					$("#contract_start_date_"+ep_id, "#contract_end_date_"+ep_id).removeClass("accounting-css-error");
	// 					$("#contract_start_date_"+ep_id, "#contract_end_date_"+ep_id).addClass("accounting-css-success");
	// 					check10 = 1;
						
	// 						//if (filename) {
	// 						//	alert(date_check1);
	// 						//	check10 = 1;
	// 						//}else {
	// 						//	check10 = 0;
	// 						//	toastr.error('Please Upload a Contract PDF.','System Message:')
	// 						//}
								
						
	// 				}else {
	// 					//toastr.error('Please Input valid dates.','System Message:')
	// 					//$("#contract_start_date, #contract_end_date").removeClass("accounting-css-success");
	// 					//$("#contract_start_date, #contract_end_date").addClass("accounting-css-error");
	// 					check10 = 0;
	// 				}
					
	// 	}else if (ep_type == "Other-specify in comments") {
	// 		$(".contract_dates_edit").attr('style','display: none;');
	// 		if ($.trim(employee_comments).length >= 1){
	// 		$("#employee_comments").removeClass("accounting-css-error");
	// 		$("#employee_comments").addClass("accounting-css-success");
	// 		check10 = 1;
	// 		} else{
	// 		toastr.error('Please fill in comments!','System Message:')
	// 		$("#employee_comments").removeClass("accounting-css-success");
	// 		$("#employee_comments").addClass("accounting-css-error");
	// 		check10 = 0;
	// 		}
	// 	}else{
	// 		$(".contract_dates_edit").attr('style','display: none;');
	// 		//$("#ep_type").removeClass("accounting-css-error");
	// 		//$("#ep_type").addClass("accounting-css-success");
	// 		check10 = 1;
	// 	}
	// });
		
		

	// 	$('#employee_hours_'+ep_id).change('input propertychange', function() {
	// 		var fname = $('#employee_hours_'+ep_id).val();
	// 		if ($.trim(fname).length > 2) {
	// 			$('#employee_hours_'+ep_id).removeClass("accounting-css-error");
	// 			$('#employee_hours_'+ep_id).addClass("accounting-css-success");
	// 		}else{ 
	// 			$('#employee_hours_'+ep_id).removeClass("accounting-css-success");
	// 			$('#employee_hours_'+ep_id).addClass("accounting-css-error");
	// 		}	
	// 	});

	// 	$('#employee_status_'+ep_id).change('input propertychange', function() {
	// 		var fname = $('#employee_status_'+ep_id).val();
	// 		if ($.trim(fname).length > 2) {
	// 			$('#employee_status_'+ep_id).removeClass("accounting-css-error");
	// 			$('#employee_status_'+ep_id).addClass("accounting-css-success");
	// 		}else{ 
	// 			$('#employee_status_'+ep_id).removeClass("accounting-css-success");
	// 			$('#employee_status_'+ep_id).addClass("accounting-css-error");
	// 		}	
	// 	});

	// 	$('#contract_start_date_'+ep_id).change('input propertychange', function() {
	// 		var fname = $('#contract_start_date_'+ep_id).val();
	// 		if ($.trim(fname).length > 2) {
	// 			$('#contract_start_date_'+ep_id).removeClass("accounting-css-error");
	// 			$('#contract_start_date_'+ep_id).addClass("accounting-css-success");
	// 		}else{ 
	// 			$('#contract_start_date_'+ep_id).removeClass("accounting-css-success");
	// 			$('#contract_start_date_'+ep_id).addClass("accounting-css-error");
	// 		}	
	// 	});

	// 	$('#contract_end_date_'+ep_id).change('input propertychange', function() {
	// 		var fname = $('#contract_end_date_'+ep_id).val();
	// 		if ($.trim(fname).length > 2) {
	// 			$('#contract_end_date_'+ep_id).removeClass("accounting-css-error");
	// 			$('#contract_end_date_'+ep_id).addClass("accounting-css-success");
	// 		}else{ 
	// 			$('#contract_end_date_'+ep_id).removeClass("accounting-css-success");
	// 			$('#contract_end_date_'+ep_id).addClass("accounting-css-error");
	// 		}	
	// 	});

	// 	$('#uauth_'+ep_id).change('input propertychange', function() {
	// 		var fname = $('#uauth_'+ep_id).val();
	// 		if ($.trim(fname).length > 2) {
	// 			/*$('#uauth_'+ep_id).removeClass("accounting-css-error");
	// 			$('#uauth_'+ep_id).addClass("accounting-css-success");*/
	// 		}else{ 
	// 			/*$('#uauth_'+ep_id).removeClass("accounting-css-success");
	// 			$('#uauth_'+ep_id).addClass("accounting-css-error");*/
	// 		}	
	// 	});

		$('#ep_super_'+ep_id).change('input propertychange', function() {
			var ep_super = $('#ep_super_'+ep_id).val();
			if ($.trim(ep_super).length > 2) {
				$('#ep_super_'+ep_id).removeClass("accounting-css-error");
				$('#ep_super_'+ep_id).addClass("accounting-css-success");
			}else{
				$('#ep_super_'+ep_id).removeClass("accounting-css-success");
				$('#ep_super_'+ep_id).addClass("accounting-css-error");
			}	
		});

	// 	$('#employee_vacation_'+ep_id).change('input propertychange', function() {
	// 		var fname = $('#employee_vacation_'+ep_id).val();
	// 		if ($.trim(fname).length > 2) {
	// 			$('#employee_vacation_'+ep_id).removeClass("accounting-css-error");
	// 			$('#employee_vacation_'+ep_id).addClass("accounting-css-success");
	// 		}else{ 
	// 			$('#employee_vacation_'+ep_id).removeClass("accounting-css-success");
	// 			$('#employee_vacation_'+ep_id).addClass("accounting-css-error");
	// 		}	
	// 	});

	// 	$('#employee_comments_'+ep_id).change('input propertychange', function() {
	// 		var fname = $('#employee_comments_'+ep_id).val();
	// 		if ($.trim(fname).length > 2) {
	// 			$('#employee_comments_'+ep_id).removeClass("accounting-css-error");
	// 			$('#employee_comments_'+ep_id).addClass("accounting-css-success");
	// 		}else{ 
	// 			$('#employee_comments_'+ep_id).removeClass("accounting-css-success");
	// 			$('#employee_comments_'+ep_id).addClass("accounting-css-error");		
	// 		}	
	// 	});		
	});
 
 	$('.edit_view').click(function(){ //submit		
		var input_array = [];
		var i = 0;
		var user_id;
		var ep_id = $(this).attr('id');
		var ep_id_array = ep_id.split('_');
		ep_id = ep_id_array[2];
		user_id = ep_id_array[3];

		
		var fname = $('#fname_'+ep_id).val();
		var lname = $('#lname_'+ep_id).val();
		var email = $('#email_'+ep_id).val();
		var employee_dob = $('#employee_dob_'+ep_id).val();
		var employee_sin = $('#employee_sin_'+ep_id).val();
		var employee_h_phone = $('#employee_h_phone_'+ep_id).val();
		var employee_m_phone = $('#employee_m_phone_'+ep_id).val();
		var employee_address = $('#employee_address_'+ep_id).val();
		var employee_city = $('#employee_city_'+ep_id).val();
		var employee_province = $('#employee_province_'+ep_id).val();
		var employee_country = $('#employee_country_'+ep_id).val();
		var employee_p_code = $('#employee_p_code_'+ep_id).val();
		var position= $('#position_'+ep_id).val();
		var ep_type = $('#ep_type_'+ep_id).val();
		var employee_hours = $('#employee_hours_'+ep_id).val();
		var employee_status = $('#employee_status_'+ep_id).val();
		var contract_start_date = $('#contract_start_date_'+ep_id).val();
		var contract_end_date = $('#contract_end_date_'+ep_id).val();
		var uauth = $('#uauth_'+ep_id).val();
		var ep_super = $('#ep_super_'+ep_id).val();
		var employee_vacation =$('#employee_vacation_'+ep_id).val();
		var employee_comments =$('#employee_comments_'+ep_id).val();

	
		var check1;
		var check2;
		var check3;
		var check4;
		var check5;
		var check6;
		var check7;
		var check8;
		var check9;
		var check10;
		var check11;
		var check12;
		var check13;
		var check14;
		var check15;
		var check16;
		var check17;
		var check18;
		var check19;

		
		
		

		
		var check_box = $('#checkbox_'+ep_id).prop('checked');
		if (check_box == false){
			toastr.error('To Save, Please Enter Edit Mode.','System Message:');
		} else {
			
			var dob_check = Date.parseExact(employee_dob, "yyyy/M/d");//check if date is in sql format		
			var employee_email_check = isEmail(email);
			
			if ($.trim(fname).length > 1) {
				$('#fname_'+ep_id).removeClass("accounting-css-error");
				$('#fname_'+ep_id).addClass("accounting-css-success");
				check1 = 1;
			}else{ 
				$('#fname_'+ep_id).removeClass("accounting-css-success");
				$('#fname_'+ep_id).addClass("accounting-css-error");	
				check1 = 0;
			}
			
			if ($.trim(lname).length > 1) {
				$('#lname_'+ep_id).removeClass("accounting-css-error");
				$('#lname_'+ep_id).addClass("accounting-css-success");
				check2 = 1;
			}else{ 
				$('#lname_'+ep_id).removeClass("accounting-css-success");
				$('#lname_'+ep_id).addClass("accounting-css-error");	
				check2 = 0;
			}
			
			if (employee_email_check != false) {
				$('#email_'+ep_id).removeClass("accounting-css-error");
				$('#email_'+ep_id).addClass("accounting-css-success");
				check3 = 1;
			}else{ 
				$('#email_'+ep_id).removeClass("accounting-css-success");
				$('#email_'+ep_id).addClass("accounting-css-error");	
				check3 = 0;
			}

			if (ep_super != null) {
				$("#ep_super").removeClass("accounting-css-error");
				$("#ep_super").addClass("accounting-css-success");
				check4 = 1;
			}else{ 
				$("#ep_super").removeClass("accounting-css-success");
				$("#ep_super").addClass("accounting-css-error");
				toastr.error('Please Enter a Supervisor.','System Message:');
				check4 = 0;
			}	

			// if (dob_check!=null) {
			// 	$('#employee_dob_'+ep_id).removeClass("accounting-css-error");
			// 	$('#employee_dob_'+ep_id).addClass("accounting-css-success");
			// 	check4 = 1;
			// }else{ 
			// 	$('#employee_dob_'+ep_id).removeClass("accounting-css-success");
			// 	$('#employee_dob_'+ep_id).addClass("accounting-css-error");	
			// 	check4 = 0;
			// }			
			
			// if ($.trim(employee_sin).length == 11) {
			// 	$('#employee_sin_'+ep_id).removeClass("accounting-css-error");
			// 	$('#employee_sin_'+ep_id).addClass("accounting-css-success");
			// 	check5 = 1;
			// }else{ 
			// 	$('#employee_sin_'+ep_id).removeClass("accounting-css-success");
			// 	$('#employee_sin_'+ep_id).addClass("accounting-css-error");	
			// 	check5 = 0;
			// }
			
			// if ($.trim(employee_h_phone).length == 14) {
			// 	$('#employee_h_phone_'+ep_id).removeClass("accounting-css-error");
			// 	$('#employee_h_phone_'+ep_id).addClass("accounting-css-success");
			// 	check6 = 1;
			// }else{ 
			// 	$('#employee_h_phone_'+ep_id).removeClass("accounting-css-success");
			// 	$('#employee_h_phone_'+ep_id).addClass("accounting-css-error");	
			// 	check6 = 0;
			// }			
			
			// if ($.trim(employee_m_phone).length == 14) {
			// 	$('#employee_m_phone_'+ep_id).removeClass("accounting-css-error");
			// 	$('#employee_m_phone_'+ep_id).addClass("accounting-css-success");
			// 	check7 = 1;
			// }else{ 
			// 	$('#employee_m_phone_'+ep_id).removeClass("accounting-css-success");
			// 	$('#employee_m_phone_'+ep_id).addClass("accounting-css-error");	
			// 	check7 = 0;
			// }			
			
			// if ($.trim(employee_address).length > 5) {
			// 	$('#employee_address_'+ep_id).removeClass("accounting-css-error");
			// 	$('#employee_address_'+ep_id).addClass("accounting-css-success");
			// 	check8 = 1;
			// }else{ 
			// 	$('#employee_address_'+ep_id).removeClass("accounting-css-success");
			// 	$('#employee_address_'+ep_id).addClass("accounting-css-error");
			// 	toastr.error('Please Enter a Valid Payee Address.','System Message:');	
			// 	check8 = 0;		
			// }	

			// if ($.trim(employee_city).length > 5) {
			// 	$('#employee_city_'+ep_id).removeClass("accounting-css-error");
			// 	$('#employee_city_'+ep_id).addClass("accounting-css-success");
			// 	check9 = 1;
			// }else{ 
			// 	$('#employee_city_'+ep_id).removeClass("accounting-css-success");
			// 	$('#employee_city_'+ep_id).addClass("accounting-css-error");
			// 	toastr.error('Please Enter a Valid Payee City.','System Message:');
			// 	check9 = 0;			
			// }
			
			// if ($.trim(employee_province).length > 2) {
			// 	check10 = 1;
			// }else{ 
			// 	check10 = 0;
			// }
			
			// if ($.trim(employee_country).length > 3) {
			// 	$('#employee_country_'+ep_id).removeClass("accounting-css-error");
			// 	$('#employee_country_'+ep_id).addClass("accounting-css-success");
			// 	check11 = 1;
			// }else{ 
			// 	$('#employee_country_'+ep_id).removeClass("accounting-css-success");
			// 	$('#employee_country_'+ep_id).addClass("accounting-css-error");	
			// 	check11 = 0;
			// }			
			
			// if ($.trim(employee_p_code).length == 7) {
			// 	$('#employee_p_code_'+ep_id).removeClass("accounting-css-error");
			// 	$('#employee_p_code_'+ep_id).addClass("accounting-css-success");
			// 	check12 = 1;
			// }else{ 
			// 	$('#employee_p_code_'+ep_id).removeClass("accounting-css-success");
			// 	$('#employee_p_code_'+ep_id).addClass("accounting-css-error");	
			// 	check12 = 0;
			// }
			
			// if ($.trim(position).length > 1) {
			// 	$('#position_'+ep_id).removeClass("accounting-css-error");
			// 	$('#position_'+ep_id).addClass("accounting-css-success");
			// 	check13 = 1;
			// }else{ 
			// 	$('#position_'+ep_id).removeClass("accounting-css-success");
			// 	$('#position_'+ep_id).addClass("accounting-css-error");	
			// 	check13 = 0;
			// }
			
			// if ($.trim(ep_type).length >= 5){
			// var date_check1 = Date.parseExact(contract_end_date, "yyyy/M/d");//check if date is in sql format
			// var date_check2 = Date.parseExact(contract_start_date, "yyyy/M/d");//check if date is in sql format			
			// //alert(date_check1);
			// 	if (ep_type == "Contract") {
			// 				if (date_check1!=null || date_check2!=null) {
			// 					//alert(date_check1);
			// 				$("#contract_start_date, #contract_end_date").removeClass("accounting-css-error");
			// 				$("#contract_start_date, #contract_end_date").addClass("accounting-css-success");
			// 					check14 =1;			
			// 				}else {
			// 				toastr.error('Please Input valid dates.','System Message:')
			// 				$("#contract_start_date, #contract_end_date").removeClass("accounting-css-success");
			// 				$("#contract_start_date, #contract_end_date").addClass("accounting-css-error");
			// 					check14 = 0;
			// 				}
			// 	}else if (ep_type == "Other-specify in comments") {
			// 		if ($.trim(employee_comments).length >= 1){
			// 		$('#employee_comments_'+ep_id).removeClass("accounting-css-error");
			// 		$('#employee_comments_'+ep_id).addClass("accounting-css-success");
			// 		check14 = 1;
			// 		} else{
			// 		toastr.error('Please fill in comments!','System Message:')
			// 		$('#employee_comments_'+ep_id).removeClass("accounting-css-success");
			// 		$('#employee_comments_'+ep_id).addClass("accounting-css-error");
			// 		check14 = 0;
			// 		}
			// 	}else{
			// 		//$("#ep_type").removeClass("accounting-css-error");
			// 		//$("#ep_type").addClass("accounting-css-success");
			// 		check14 = 1;
			// 	}
			
			// }
			
			
			// if ($.trim(employee_hours).length > 2) {
			// 		if (employee_hours == "Other-specify in comments") {
			// 			if ($.trim(employee_comments).length >= 1){
			// 			$('#employee_comments_'+ep_id).removeClass("accounting-css-error");
			// 			$('#employee_comments_'+ep_id).addClass("accounting-css-success");
			// 			check15 = 1;
			// 			} else{
			// 			toastr.error('Please fill in comments!','System Message:')
			// 			$('#employee_comments_'+ep_id).removeClass("accounting-css-success");
			// 			$('#employee_comments_'+ep_id).addClass("accounting-css-error");
			// 			check15 = 0;
			// 			}
			// 		} else{
			// 		check15 = 1;
			// 		}
			// }else{ 
			// 		$('#employee_hours_'+ep_id).removeClass("accounting-css-success");
			// 		$('#employee_hours_'+ep_id).addClass("accounting-css-error");	
			// 		check15 = 0;
			// }

			
			// if ($.trim(employee_status).length > 2) {
			// 	 if (employee_status == "Other-specify in comments") {
			// 		if ($.trim(employee_comments).length >= 1){
			// 		$('#employee_comments_'+ep_id).removeClass("accounting-css-error");
			// 		$('#employee_comments_'+ep_id).addClass("accounting-css-success");
			// 		check16 = 1;
			// 		} else{
			// 		toastr.error('Please fill in comments!','System Message:')
			// 		$('#employee_comments_'+ep_id).removeClass("accounting-css-success");
			// 		$('#employee_comments_'+ep_id).addClass("accounting-css-error");
			// 		check16 = 0;
			// 		}
			// 	} else{
			// 		check16 = 1;
			// 	}
			// }else{
			// 	$('#employee_status_'+ep_id).removeClass("accounting-css-success");
			// 	$('#employee_status_'+ep_id).addClass("accounting-css-error");	
			// 	check16 = 0;
			// }
			
			
			// if ($.trim(uauth).length > 1) {
			// 	//$("#uauth").removeClass("accounting-css-error");
			// 	//$("#uauth").addClass("accounting-css-success");
			// 	if (uauth == "Employee"){
			// 		var uauth = 'regular';
			// 	}	else if(uauth == "Supervisor"){
			// 		var uauth = 'super';
			// 	}  else if(uauth == "Admin"){
			// 		var uauth = 'admin';
			// 	}
			// 	check17 = 1;
			// }else{ 
			// 	//$("#uauth").removeClass("accounting-css-success");
			// 	//$("#uauth").addClass("accounting-css-error");		
			// 	check17 = 0;
			// }
			
			// if ($.trim(ep_super).length >= 1) {
			// 	check18 = 1;
			// }else{ 
			// 	check18 = 0;
			// }
			
			// if ($.trim(employee_vacation).length > 2 || $.trim(employee_vacation).length < 1) {
			// 	$("#employee_vacation").removeClass("accounting-css-success");
			// 	$("#employee_vacation").addClass("accounting-css-error");
			// 	check19 = 0;
			// }else{ 
			// 	$("#employee_vacation").removeClass("accounting-css-error");
			// 	$("#employee_vacation").addClass("accounting-css-success");
			// 	check19 = 1;			
			// }
		
			var username = $('#hidden_username').val();
			var formData = new FormData(); 			
			var confirm_proposal = $('#confirm_proposal_'+ep_id).val();
			var proposal_pdf;
			
			
			if (confirm_proposal == "attached") {
				proposal_pdf = $('input[id="proposal_'+ep_id+'"]')[0].files[0];
				formData.append('file_proposal_edit',proposal_pdf);//append 1 file at the 0th index of the file.
				formData.append('file_proposal_edit_msg','attached');
			}else {
				formData.append('file_proposal_edit_msg','removed');
			}
						


		if (check1 === 1 && check2 === 1 && check3 === 1 && check4 === 1 /*&& check5 === 1 && check6 === 1 && check7 === 1 && check8 === 1 && check9 === 1 && check10 === 1 && check11 === 1 && check12 === 1 && check13 === 1 && check14 === 1 && check15 === 1 && check16 === 1 && check17 === 1 && check18 === 1 && check19 === 1*/) {
				$(".edit_view").prop("disabled", true);
				$(".button_delete").prop("disabled", true);
				$(".edit_view").html("<span class='glyphicon glyphicon-refresh glyphicon-refresh-animate'></span> Processing...");
				$(".close_js").prop("disabled", true);
				var user = $('#hidden_username').val();
				var file_proposal_edit = $('#proposal_'+ep_id)[0].files[0];
				var formData = new FormData();
					formData.append('ep_id', ep_id);
					formData.append('fname', fname);
					formData.append('lname', lname);
					formData.append('email', email);
					formData.append('employee_dob_edit', employee_dob);
					formData.append('employee_sin_edit', employee_sin);
					formData.append('employee_h_phone_edit', employee_h_phone);
					formData.append('employee_m_phone_edit', employee_m_phone);
					formData.append('employee_address_edit', employee_address);
					formData.append('employee_city_edit', employee_city);
					formData.append('employee_province_edit', employee_province);
					formData.append('employee_country_edit', employee_country);
					formData.append('employee_p_code_edit', employee_p_code);
					formData.append('position_edit', position);
					formData.append('ep_type_edit', ep_type);
					formData.append('employee_hours_edit', employee_hours);
					formData.append('employee_status_edit', employee_status);
					formData.append('contract_start_date_edit', contract_start_date);
					formData.append('contract_end_date_edit', contract_end_date);
					formData.append('uauth_edit', uauth);
					formData.append('ep_super_edit', ep_super);
					formData.append('employee_vacation_edit', employee_vacation);
					formData.append('employee_comments_edit', employee_comments);
					formData.append('user_id2', user_id);
					formData.append('file_proposal_edit', file_proposal_edit);

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
					$.LoadingOverlay("show");
						$.ajax({
							type: "POST",
							url: "./services/employees.php",
							data: formData,
							cache: false,
							contentType: false,
							processData: false,				
							beforeSend: function(){},
							success: function(data){
								console.log(data);
								$.LoadingOverlay("hide", true);
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
							$('#fname_'+ep_id).removeClass("accounting-css-success").removeClass("accounting-css-error");	
							$('#employee_address_'+ep_id).removeClass("accounting-css-success").removeClass("accounting-css-error");	
							$('#payee_city_'+ep_id).removeClass("accounting-css-success").removeClass("accounting-css-error");	
							$('#payee_province_'+ep_id).removeClass("accounting-css-success").removeClass("accounting-css-error");	
							$('#payee_zip_'+ep_id).removeClass("accounting-css-success").removeClass("accounting-css-error");	
							$('#payee_info_'+ep_id).removeClass("accounting-css-success").removeClass("accounting-css-error");					
							$('#payee_email_'+ep_id).removeClass("accounting-css-success").removeClass("accounting-css-error");					
							$('#payee_phone_'+ep_id).removeClass("accounting-css-success").removeClass("accounting-css-error");								
						}					
					});						

			}			
		}			
		
	})
 
 

 	$('.edit_mode').click(function() {

		var check_box = $('#checkbox_'+ep_id).prop('checked');
		var ep_id = $(this).attr('id').split('_');
		
			$(".view_pdf_"+ep_id[1]).show();
			$(".edit_pdf_"+ep_id[1]).hide();
			
		if($(this).prop('checked')){
			var this_id = $(this).attr('id');
			var this_id_array = this_id.split('_');
			var ep_id = $(this).attr('id').split('_');
			var ep_id = ep_id[1];
			this_id = this_id_array[1];
			
			$(".view_pdf_"+ep_id).hide();
			$(".edit_pdf_"+ep_id).show();
			
			$('.readonly_'+this_id).each(function(){
				$(this).removeAttr('disabled');
			});				
			
			$('#switch_'+this_id).html("Editing:");
			
			
		}else {
			var ep_id = $(this).attr('id').split('_');	
			var hidden_userid = $('#hidden_userid_'+ep_id[1]).val();
			var info = 'close_id='+hidden_userid;
			
			$(".view_pdf_"+ep_id[1]).show();
			$(".edit_pdf_"+ep_id[1]).hide();			
			$('#switch_'+ep_id[1]).html("Viewing:");
			
				$.ajax({
					type: "POST",
					url: "./services/employees.php",
					data: info,
					cache: false,			
					beforeSend: function(){},
					success: function(data){
						var ep_json_return = $.parseJSON(data);//php to jquery json for payee info.
						ep_json_return = ep_json_return[0];
						
						var fname = ep_json_return.fname;
						var lname = ep_json_return.lname;
						var email = ep_json_return.username;
						var position = ep_json_return.position;
						var uauth = ep_json_return.auth;
						var ep_super = ep_json_return.supervisor;
						
						$('#fname_'+ep_id[1]).val(fname);
						$('#lname_'+ep_id[1]).val(lname);
						$('#email_'+ep_id[1]).val(email);
						$('#position_'+ep_id[1]).val(position);
						$('#uauth_'+ep_id[1]).val(uauth);
						$('#ep_super_'+ep_id[1]).val(ep_super);

					}
				});
				
			var info = 'close_id2='+hidden_userid;
				$.ajax({
					type: "POST",
					url: "./services/employees.php",
					data: info,
					cache: false,			
					beforeSend: function(){},
					success: function(data){
						var ep_json_return = $.parseJSON(data);//php to jquery json for payee info.
						ep_json_return = ep_json_return[0];
						
						var employee_dob = ep_json_return.dob;
						var employee_sin  = ep_json_return.sin;
						var employee_h_phone = ep_json_return.h_phone;
						var employee_m_phone = ep_json_return.m_phone;
						var employee_address = ep_json_return.address;
						var employee_city = ep_json_return.city;
						var employee_province = ep_json_return.province;
						var employee_country = ep_json_return.country;
						var employee_p_code = ep_json_return.p_code;
						var position = ep_json_return.position;
						var ep_type = ep_json_return.employee_type;
						var employee_hours = ep_json_return.hours;
						var employee_status = ep_json_return.employee_status;
						var contract_start_date = ep_json_return.contract_start_date;
						var contract_end_date = ep_json_return.contract_end_date;
						var uauth = ep_json_return.uauth;
						var employee_vacation = ep_json_return.employee_vacation;
						var employee_comments = ep_json_return.comments;
						
						$('#employee_dob_'+ep_id[1]).val(employee_dob);
						$('#employee_sin_'+ep_id[1]).val(employee_sin);
						$('#employee_h_phone_'+ep_id[1]).val(employee_h_phone);
						$('#employee_m_phone_'+ep_id[1]).val(employee_m_phone);
						$('#employee_address_'+ep_id[1]).val(employee_address);
						$('#employee_city_'+ep_id[1]).val(employee_city);
						$('#employee_province_'+ep_id[1]).select2("val", employee_province);
						$('#employee_country_'+ep_id[1]).val(employee_country);
						$('#employee_p_code_'+ep_id[1]).val(employee_p_code);
						$('#ep_type_'+ep_id[1]).val(ep_type);
						$('#employee_hours_'+ep_id[1]).val(employee_hours);
						$('#employee_status_'+ep_id[1]).val(employee_status);
						$('#countract_start_date_'+ep_id[1]).val(contract_start_date);
						$('#countract_end_date_'+ep_id[1]).val(contract_end_date);
						$('#employee_vacation_'+ep_id[1]).val(employee_vacation);
						$('#employee_comments_'+ep_id[1]).val(employee_comments);

					}
				});
				
						$('#fname_'+ep_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");
						$('#lname_'+ep_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");
						$('#email_'+ep_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");
						$('#employee_dob_'+ep_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");
						$('#employee_sin_'+ep_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");
						$('#employee_h_phone_'+ep_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");
						$('#employee_m_phone_'+ep_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");
						$('#employee_address_'+ep_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");
						$('#employee_city_'+ep_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");
						$('#employee_province_'+ep_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");
						$('#employee_country_'+ep_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");
						$('#employee_p_code_'+ep_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");
						$('#position_'+ep_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");
						$('#ep_type_'+ep_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");
						$('#employee_hours_'+ep_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");
						$('#employee_status_'+ep_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");
						$('#countract_start_date_'+ep_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");
						$('#countract_end_date_'+ep_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");
						$('#uauth_'+ep_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");
						$('#ep_super_'+ep_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");
						$('#employee_vacation_'+ep_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");
						$('#employee_comments_'+ep_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");			
				toastr.remove();
				
				$('#checkbox_'+ep_id[1]).prop('checked', false);
				
				$('.readonly_'+ep_id[1]).each(function(){
					$(this).attr('disabled', 'disabled');
				});
				
				$('#switch_'+ep_id[1]).html("Viewing:");

				$("#description, #accounting_code, .type_info1").removeClass("accounting-css-success");
				$("#description, #accounting_code, .type_info1").removeClass("accounting-css-error");
				
		}
	});
		
	$('.close_main').click(function(){	
			$('#fname, .type_info').val('');
			$('#province_select').select2("val", 'Alberta');
			$('#employee_province').select2("val", 'Alberta');
			$('#ep_type').select2("val", 'Permanent');
			$('#ep_hours').select2("val", 'Salary');
			$('#employee_status').select2("val", 'Working');
			$('#uauth').select2("val", 'Employee');
			
			$('.text_agreement, .text_approval, .text_proposal').html('Select PDF Document');
			$('.agreement_icon, .approval_icon, .proposal_icon').html('<i class="fa fa-file-pdf-o text-danger"></i>');	
			$("#description, #accounting_code, .type_info").removeClass("accounting-css-success");
			$("#description, #accounting_code, .type_info").removeClass("accounting-css-error");
			$("#description, #accounting_code, .type_info1").removeClass("accounting-css-success");
			$("#description, #accounting_code, .type_info1").removeClass("accounting-css-error");
			toastr.remove();
			$('a[href="#step1"]').tab('show');
			
			var prevId = $(this).parents('.tab-pane').prev().attr("id");
            var href_prev = 'a[href="#'+ prevId +'"'+']';
			$(href_prev).tab('show');
			
			var tabId = prevId;
	});	
		



	$('.close_edit').click(function() {
		
			var ep_id = $(this).attr('id').split('_');			
			var hidden_userid = $('#hidden_userid_'+ep_id[1]).val();
			var info = 'close_id='+hidden_userid;
				$.ajax({
					type: "POST",
					url: "./services/employees.php",
					data: info,
					cache: false,			
					beforeSend: function(){},
					success: function(data){
						var ep_json_return = $.parseJSON(data);//php to jquery json for payee info.
						ep_json_return = ep_json_return[0];
						
						var fname = ep_json_return.fname;
						var lname = ep_json_return.lname;
						var email = ep_json_return.username;
						var position = ep_json_return.position;
						var uauth = ep_json_return.auth;
						var ep_super = ep_json_return.supervisor;
						
						if (uauth=='admin'){
							uauth = 'Admin';
						} else if (uauth='super') {
							uauth = 'Supervisor';
						} else if (uauth='regular'){
							uauth = 'Employee';
						}
						
						$('#fname_'+ep_id[1]).val(fname);
						$('#lname_'+ep_id[1]).val(lname);
						$('#email_'+ep_id[1]).val(email);
						$('#position_'+ep_id[1]).val(position);
						$('#uauth_'+ep_id[1]).val(uauth);
						$('#ep_super_'+ep_id[1]).val(ep_super);

					}
				});
				
			var info = 'close_id2='+hidden_userid;
				$.ajax({
					type: "POST",
					url: "./services/employees.php",
					data: info,
					cache: false,			
					beforeSend: function(){},
					success: function(data){
						var ep_json_return = $.parseJSON(data);//php to jquery json for payee info.
						ep_json_return = ep_json_return[0];
						
						var employee_dob = ep_json_return.dob;
						var employee_sin  = ep_json_return.sin;
						var employee_h_phone = ep_json_return.h_phone;
						var employee_m_phone = ep_json_return.m_phone;
						var employee_address = ep_json_return.address;
						var employee_city = ep_json_return.city;
						var employee_province = ep_json_return.province;
						var employee_country = ep_json_return.country;
						var employee_p_code = ep_json_return.p_code;
						var ep_type = ep_json_return.employee_type;
						var employee_hours = ep_json_return.hours;
						var employee_status = ep_json_return.employee_status;
						var contract_start_date = ep_json_return.contract_start_date;
						var contract_end_date = ep_json_return.contract_end_date;
						var employee_vacation = ep_json_return.employee_vacation;
						var employee_comments = ep_json_return.comments;
						
						$('#employee_dob_'+ep_id[1]).val(employee_dob);
						$('#employee_sin_'+ep_id[1]).val(employee_sin);
						$('#employee_h_phone_'+ep_id[1]).val(employee_h_phone);
						$('#employee_m_phone_'+ep_id[1]).val(employee_m_phone);
						$('#employee_address_'+ep_id[1]).val(employee_address);
						$('#employee_city_'+ep_id[1]).val(employee_city);
						$('#employee_province_'+ep_id[1]).select2("val", employee_province);
						$('#employee_country_'+ep_id[1]).val(employee_country);
						$('#employee_p_code_'+ep_id[1]).val(employee_p_code);
						$('#ep_type_'+ep_id[1]).val(ep_type);
						$('#employee_hours_'+ep_id[1]).val(employee_hours);
						$('#employee_status_'+ep_id[1]).val(employee_status);
						$('#countract_start_date_'+ep_id[1]).val(contract_start_date);
						$('#countract_end_date_'+ep_id[1]).val(contract_end_date);
						$('#employee_vacation_'+ep_id[1]).val(employee_vacation);
						$('#employee_comments_'+ep_id[1]).val(employee_comments);

					}
				});
				
						$('#fname_'+ep_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");
						$('#lname_'+ep_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");
						$('#email_'+ep_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");
						$('#employee_dob_'+ep_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");
						$('#employee_sin_'+ep_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");
						$('#employee_h_phone_'+ep_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");
						$('#employee_m_phone_'+ep_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");
						$('#employee_address_'+ep_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");
						$('#employee_city_'+ep_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");
						$('#employee_province_'+ep_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");
						$('#employee_country_'+ep_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");
						$('#employee_p_code_'+ep_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");
						$('#position_'+ep_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");
						$('#ep_type_'+ep_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");
						$('#employee_hours_'+ep_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");
						$('#employee_status_'+ep_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");
						$('#countract_start_date_'+ep_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");
						$('#countract_end_date_'+ep_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");
						$('#uauth_'+ep_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");
						$('#ep_super_'+ep_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");
						$('#employee_vacation_'+ep_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");
						$('#employee_comments_'+ep_id[1]).removeClass("accounting-css-success").removeClass("accounting-css-error");			
				toastr.remove();

				
				$('a[href="#step1"]').tab('show');


				$('#checkbox_'+ep_id[1]).prop('checked', false);
				
				$('.readonly_'+ep_id[1]).each(function(){
					$(this).attr('disabled', 'disabled');
				});
				
				$('#switch_'+ep_id[1]).html("Viewing:");

				
			//switches to first tab
			var prevId = $(this).parents('.tab-pane').prev().attr("id");
            var href_prev = 'a[href="#'+ prevId +'"'+']';
			$(href_prev).tab('show');
			
			var tabId = prevId;
	});
		
		

});


