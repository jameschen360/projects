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
	
	var check1 = 0;
	var check2 = 0;
	var check3 = 0;
	var description;
	var accounting_code;
	var dup;
	var username = $('#hidden_username').val();	
	var data_1;

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
	
	$('#accounting_code').change('input propertychange', function() {
		accounting_code = $('#accounting_code').val();
		var info = 'code_check='+accounting_code;
		$.ajax({
			type: "POST",
			url: "./services/accounting_code_check.php",
			data: info,
			cache: false,				
			beforeSend: function(){},
			success: function(data){
				data_1 = data;
				if ($.trim(accounting_code).length >= 4 && data === "taken") {
					dup = "yes";	
					toastr.error('Please Input a valid Code.','System Message:');
					$("#accounting_code").removeClass("accounting-css-success");
					$("#accounting_code").addClass("accounting-css-error");					
					check2 = 0;
				}else if ($.trim(accounting_code).length >= 4 && data === "okay") {
					dup = "no";						
						toastr.success('Expense Code is Valid!','System Message:');
						$("#accounting_code").removeClass("accounting-css-error");
						$("#accounting_code").addClass("accounting-css-success");							
						check2 = 1;
				} else {
					toastr.error('Please Input a valid Code.','System Message:');
					$("#accounting_code").removeClass("accounting-css-success");
					$("#accounting_code").addClass("accounting-css-error");					
					check2 = 0;
				}
				
			}
		});		
	});

	$('#description').change('input propertychange', function() {
		accounting_desc_check = $('#description').val();
		if ($.trim(accounting_desc_check).length > 0) {
			$("#description").removeClass("accounting-css-error");
			$("#description").addClass("accounting-css-success");			
		}else {
			toastr.error('Please Input a valid Expense Item Description.','System Message:');
			$("#description").removeClass("accounting-css-success");
			$("#description").addClass("accounting-css-error");				
		}		
	});	
	
	$('#accounting_add_submit').click(function(){
	description = capWords($('#description').val());
	accounting_code = $('#accounting_code').val();
	var check_2 = check2;
	var data1 = data_1;
		if ($.trim(description).length > 0) {
			$(".error_msg2").html("");
			$("#description").removeClass("accounting-css-error");
			$("#description").addClass("accounting-css-success");			
			check1 = 1;
		}else{ 
			toastr.error('Please Input a valid Expense Item Description.','System Message:');
			$("#description").removeClass("accounting-css-success");
			$("#description").addClass("accounting-css-error");				
			check1 = 0;	
		}
		if ($.trim(accounting_code).length >= 4 && data1 === "okay") {
			$(".error_msg2").html("");
			$("#accounting_code").removeClass("accounting-css-error");
			$("#accounting_code").addClass("accounting-css-success");			
			check_2 = 1;
		}else{ 
			toastr.error('Please Input a valid Code.','System Message:');
			$("#accounting_code").removeClass("accounting-css-success");
			$("#accounting_code").addClass("accounting-css-error");				
			check_2 = 0;
		}		
		if ($.trim(username).length > 0) {
			check3 = 1;
		}		
		if (check1 === 1 && check_2 === 1 && check3 === 1) {
			$("#accounting_add_submit").prop("disabled", true);
			$("#accounting_add_submit").html("<span class='glyphicon glyphicon-refresh glyphicon-refresh-animate'></span> Processing...");	
			$(".close_main").prop("disabled", true);			
			swal({
			  allowOutsideClick: false,
			  allowEscapeKey: false,
			  allowEnterKey: false,			
			  title: 'Add New Expense Code?',
			  html: '<strong><h3>"'+accounting_code+'"</strong></h3>',
			  type: 'info',
			  showCancelButton: true,
			  showLoaderOnConfirm: true,
			  confirmButtonColor: '#62cb31',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Yes!'
			}).then(function () {
					var formData = new FormData(); 
					formData.append('description', description);
					formData.append('accounting_code', accounting_code);
					formData.append('username', username);
					
					$.ajax({
						type: "POST",
						url: "./services/accounting_code.php",
						data: formData,
						cache: false,
						contentType: false,
						processData: false,					
						beforeSend: function(){},
						success: function(data){	
							$("#accounting_add_submit").prop("disabled", true);
							$("#accounting_add_submit").html("Submit");
							$(".close_js").prop("disabled", true);						
							swal({
							  allowOutsideClick: false,
							  allowEscapeKey: false,
							  allowEnterKey: false,			
							  title: 'Added!',
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
						$("#accounting_add_submit").prop("disabled", false);
						$("#accounting_add_submit").html("Submit");
						$(".close_main").prop("disabled", false);
					}					
				});			
		}
	
	});
	

	$('.remodal_view').click(function(){
		
		var input_array = [];
		var i = 0;
		
		var accounting_desc;
		var accounting_code;
		
		var accounting_id = $(this).attr('id');
		var accounting_id_array = accounting_id.split('_');
		
		accounting_id = accounting_id_array[2];

		$('.field_value_'+accounting_id).each(function(){
			input_array[i] = this.value;
			i++;
		});		
		
		accounting_code = input_array[0];
		accounting_desc = input_array[1];
		accounting_desc = capWords(accounting_desc);
		

		$('#code_'+accounting_id).change('input propertychange', function() {
			var accounting_code = $('#code_'+accounting_id).val();
			var check_dup = 'check_code='+accounting_code+'&check_id='+accounting_id;	
			var check_result = $.ajax({
				type: "POST",
				url: "./services/accounting_code.php",
				data: check_dup,
				cache: false,
				async:false,
				global: false,
				beforeSend: function(){},
				success: function(data){	
					return data;
				}
			}).responseText;
			if ($.trim(accounting_code).length ==4 && check_result === "okay") {
				$('#code_'+accounting_id).removeClass("accounting-css-error");
				$('#code_'+accounting_id).addClass("accounting-css-success");
				toastr.success('Expense Code Okay!','System Message:');			
			}else{ 
				$('#code_'+accounting_id).removeClass("accounting-css-success");
				$('#code_'+accounting_id).addClass("accounting-css-error");
				toastr.error('Please Enter a Valid Expense Code.','System Message:');						
			}	
		});

		$('#desc_'+accounting_id).change('input propertychange', function() {
			var accounting_desc = $('#desc_'+accounting_id).val();
			if ($.trim(accounting_desc).length > 0) {
				$('#desc_'+accounting_id).removeClass("accounting-css-error");
				$('#desc_'+accounting_id).addClass("accounting-css-success");
				toastr.success('Accounting Description Okay!','System Message:');			
			}else{ 
				$('#desc_'+accounting_id).removeClass("accounting-css-success");
				$('#desc_'+accounting_id).addClass("accounting-css-error");
				toastr.error('Please Enter a Valid Description.','System Message:');						
			}	
		});
	});

	
	$('.close_js').click(function(){
	var accounting_id = $(this).attr('id').split('_');
	var info = 'id='+accounting_id[1];
		$.ajax({
			type: "POST",
			url: "./services/accounting_code_replace.php",
			data: info,
			cache: false,			
			beforeSend: function(){},
			success: function(data){						
				var data_split = data.split('_');
				var response_code = data_split[0];
				var response_desc = data_split[1];
				$('#code_'+accounting_id[1]).val(response_code);
				$('#desc_'+accounting_id[1]).val(response_desc);	
			}
		});	
		$('#code_'+accounting_id[1]).removeClass("accounting-css-success accounting-css-error");		
		$('#desc_'+accounting_id[1]).removeClass("accounting-css-success accounting-css-error");
		
		$('#checkbox_'+accounting_id[1]).prop('checked', false);
		
		$('.readonly_'+accounting_id[1]).each(function(){
			$(this).attr('disabled', 'disabled');
		});	
		$('#switch_'+accounting_id[1]).html("Viewing:");			
		toastr.remove();
	});
	
	$('.close_main').click(function(){	
		$('#accounting_code, #description').val('');
		$("#description, #accounting_code").removeClass("accounting-css-success");		
		$("#description, #accounting_code").removeClass("accounting-css-error");		
		toastr.remove();
	});	
	
	$('.edit_view').click(function(){		
		var input_array = [];
		var i = 0;
		
		var accounting_desc;
		var accounting_code;
		
		var accounting_id = $(this).attr('id');
		var accounting_id_array = accounting_id.split('_');
		
		accounting_id = accounting_id_array[2];
		$('.field_value_'+accounting_id).each(function(){
			input_array[i] = this.value;
			i++;
		});		
		
		var check_box = $('#checkbox_'+accounting_id).prop('checked');
		if (check_box == false){
			toastr.error('To Save, Please Enter Edit Mode.','System Message:');
		}else {				
		accounting_code = input_array[0];
		accounting_desc = input_array[1];
		accounting_desc = capWords(accounting_desc);
		var check_dup = 'check_code='+accounting_code+'&check_id='+accounting_id;
		var result = $.ajax({
			type: "POST",
			url: "./services/accounting_code.php",
			data: check_dup,
			cache: false,
			async:false,
			global: false,
			beforeSend: function(){},
			success: function(data){	
				return data;
			}
		}).responseText;	
		

		if ($.trim(accounting_code).length >= 4 && result === "okay") {
			$('#code_'+accounting_id).addClass("accounting-css-success");
			$('#code_'+accounting_id).removeClass("accounting-css-error");			
			check1 = 1;		
		}else{
			toastr.error('Invalid Expense Code','System Message:');
			$('#code_'+accounting_id).removeClass("accounting-css-success");
			$('#code_'+accounting_id).addClass("accounting-css-error");				
			check1 = 0;	
		}
		
		if ($.trim(accounting_desc).length > 0) {
			$('#desc_'+accounting_id).addClass("accounting-css-success");
			$('#desc_'+accounting_id).removeClass("accounting-css-error");				
			check2 = 1;
		}else{
			toastr.error('Please Input a valid Expense Item Description.','System Message:');
			$('#desc_'+accounting_id).removeClass("accounting-css-success");
			$('#desc_'+accounting_id).addClass("accounting-css-error");				
			check2 = 0;
		}		
		
		if (check1 === 1 && check2 === 1) {
			$(".edit_view").prop("disabled", true);
			$(".button_delete").prop("disabled", true);
			$(".edit_view").html("<span class='glyphicon glyphicon-refresh glyphicon-refresh-animate'></span> Processing...");	
			$(".close_js").prop("disabled", true);				
			var user = $('#hidden_username').val();
			var edit_change = 'id='+accounting_id+'&code='+accounting_code+'&desc='+accounting_desc+'&username='+user;

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
						url: "./services/accounting_code.php",
						data: edit_change,
						cache: false,			
						beforeSend: function(){},
						success: function(data){		
			 				swal({
							  allowOutsideClick: false,
							  allowEscapeKey: false,
							  allowEnterKey: false,			
							  title: 'Accounting Info Updated!',
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
						$('#desc_'+accounting_id).removeClass("accounting-css-success").removeClass("accounting-css-error");	
						$('#code_'+accounting_id).removeClass("accounting-css-success").removeClass("accounting-css-error");						
					}					
				});						

		}
		}
		
	})

	$('.button_delete').click(function(){
		var accounting_id = $(this).attr('id');
		var accounting_id_array = accounting_id.split('_');

		accounting_id = accounting_id_array[1];		
		
		var check_box = $('#checkbox_'+accounting_id).prop('checked');
		if (check_box == false){
			toastr.error('To Delete, Please Enter Edit Mode.','System Message:');
		}else {			
		
		$(".edit_view").prop("disabled", true);
		$(".button_delete").prop("disabled", true);
		$(".edit_view").html("<span class='glyphicon glyphicon-refresh glyphicon-refresh-animate'></span> Processing...");	
		$(".close_js").prop("disabled", true);		
		var accounting_id = $(this).attr('id').split('_');
		var info = 'delete_id='+accounting_id[1];
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
					url: "./services/accounting_code.php",
					data: info,
					cache: false,			
					beforeSend: function(){},
					success: function(data){		
						swal({
						  allowOutsideClick: false,
						  allowEscapeKey: false,
						  allowEnterKey: false,			
						  title: 'Expense Code Deleted!',
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
			var accounting_id = $(this).attr('id').split('_');
			var info = 'id='+accounting_id[1];
				$.ajax({
					type: "POST",
					url: "./services/accounting_code_replace.php",
					data: info,
					cache: false,			
					beforeSend: function(){},
					success: function(data){						
						var data_split = data.split('_');
						var response_code = data_split[0];
						var response_desc = data_split[1];
						$('#code_'+accounting_id[1]).val(response_code);
						$('#desc_'+accounting_id[1]).val(response_desc);	
					}
				});	
				$('#code_'+accounting_id[1]).removeClass("accounting-css-success accounting-css-error");		
				$('#desc_'+accounting_id[1]).removeClass("accounting-css-success accounting-css-error");
				
				$('#checkbox_'+accounting_id[1]).prop('checked', false);
				
				$('.readonly_'+accounting_id[1]).each(function(){
					$(this).attr('disabled', 'disabled');
				});	
				$('#switch_'+accounting_id[1]).html("Viewing:");			
				toastr.remove();			
		}
	});	
});

