$(function () {
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
	function multiply(array) {
		var sum = 1;
		for (var i = 0; i < array.length; i++) {
			sum = sum * array[i];
		}
		return sum;
	}		
	$(".expense_code_1").select2();	
	$(".expense_payee").select2();	
	$(".project_name_1").select2();
	$(".supervisor").select2();
	
	var tax_rate = 0.05;//change tax rate here
	var count = 2;
	var count_index = 2;
	var total_amount = 0;
	var input_total=0;
	var input_gst=0;
	var i=0;

	$('#table_form').hide();
	$('#revert_table').hide();
	$('#submit_expense').prop( "disabled", true );
	
	$('#payee_new').hide();
	$('#select_payee').hide();
	
	$(document).on('change', '.total_check', function() {
		var amount = $(this).val();
		if (amount <= 0) {
			$(this).addClass("accounting-css-error").removeClass("accounting-css-success");
			$(this).val('');	
			toastr.error('Please Enter Valid Number.','System Message:');
		}else {
			$(this).addClass("accounting-css-success").removeClass("accounting-css-error");
		}
	});
	
	$('#continue_table').click(function (event) {
		var total_amount_entered = parseFloat($('#total_amount_entered').val());
		var total_gst_entered = parseFloat($('#total_gst_entered').val());

		var payee_picked_name = $('#payee_name').val();
		var payee_input_name = $('#new_payee_input').val();
		
		if (total_amount_entered > 0 && total_gst_entered > 0) {
			if (total_gst_entered > total_amount_entered) {
				$('#total_gst_entered').addClass("accounting-css-error").removeClass("accounting-css-success");
				toastr.error('GST Cannot Be Greater Than Total Amount.','System Message:');
			}else {
				if ($('#payee_name').val() == 'Select a Payee' && $('#new_payee_input').val() == "") {
					toastr.error('Please Select a Payee or Input a Payee','System Message:');
				}else {
					
					if ($('#payee_name').val() != 'Select a Payee') {

						$('#payee_picked_name').val(payee_picked_name);
						$('#payee_name').prop( "disabled", true );
						$('#payee_new').hide();
						$('#payee_type').val('database');
					}else {
						$('#payee_picked_name').val(payee_input_name);
						$('#new_payee_input').prop( "disabled", true );
						$('#payee_original').hide();
						$('#payee_type').val('new');
						
					}
					$('#select_payee').hide();
					$('#new_payee').hide();	
					
					$('#table_form').fadeIn(600);
					$('.total_check').prop( "disabled", true ).removeClass("accounting-css-success");
					$('#continue_table').hide();$('#revert_table').show();$('#submit_expense').prop( "disabled", false );					
				}				
			}
		}else {
			if ($('#total_amount_entered').val() < 0 || $('#total_amount_entered').val() == "") {
				$('#total_amount_entered').addClass("accounting-css-error").removeClass("accounting-css-success");
				$('#total_amount_entered').val('');	
				toastr.error('Please Enter Valid Number.','System Message:');
			}
			if ($('#total_gst_entered').val() < 0 || $('#total_gst_entered').val() == "") {
				$('#total_gst_entered').addClass("accounting-css-error").removeClass("accounting-css-success");
				$('#total_gst_entered').val('');	
				toastr.error('Please Enter Valid Number.','System Message:');
			}			
		}
	});
	
	$('#revert_table').click(function (event) {
		$('#table_form').hide();
		$('#revert_table').hide();
		$('#continue_table').show();
		$('.total_check').prop( "disabled", false );
		$('#submit_expense').prop( "disabled", true );
		$('.amount_distr').val(0);
		$('.gst_expense, .gst_rebate, .gst_total, .amount_all, .gst_e, .gst_r, .gst_all').html("0.00");
		$("table#expense_table").find("tr:gt(1)").remove();	
		$('.amount_distr').removeClass("accounting-css-success accounting-css-error");	
		$('#select_payee').hide();
		$('#new_payee').show();	
		$('#new_payee_input').val('');	
		$('#payee_original').show();$('#payee_new').hide();
		$('#payee_name, #new_payee_input').prop( "disabled", false );
	});
	
	$(document).on('change', '.amount_distr', function() {
		var amount = $(this).val();
		var total_amount_entered = $('#total_amount_entered').val();
		var total_gst_entered = $('#total_gst_entered').val();		
		if (amount <0) {
			toastr.error('Cannot Have Negative Numbers.','System Message:');
			$(this).val(0);				
		}else {
			if (!$.isNumeric(amount)) {
				$(this).val(0);
			}
			input_total=0;
			$('.amount_distr').each(function(){
				if (this.value === null) {
					input_total += 0.00;
				}else {
					input_total += parseFloat(this.value);					
				}				
				$('.amount_all').html(input_total.toFixed(2));
			});			
			if (input_total > total_amount_entered){
				toastr.error('Please Make Sure Total Adds to $'+parseFloat(total_amount_entered).toFixed(2),'System Message:');	
				$(this).val(0);		
				input_total=0;
				$('.amount_distr').each(function(){
					input_total += parseFloat(this.value);									
				});					
					$('.amount_all').html(input_total.toFixed(2));
					var gst_all = input_total*tax_rate;
					var gst_r = input_total*tax_rate/2;
					var gst_e = gst_all-gst_r;
					var total_after = input_total+gst_all;
					
					$('.gst_all').html(gst_all.toFixed(2));
					$('.gst_r').html(gst_r.toFixed(2));
					$('.gst_e').html(gst_e.toFixed(2));	
					$('.total_after').html(total_after.toFixed(2));		
					
					var row_num = $(this).closest('tr').attr('id').split('_');
					var current_row = row_num[1];					
					$('#row_'+current_row+' .gst_expense').html("0.00");
					$('#row_'+current_row+' .gst_rebate').html("0.00");
					$('#row_'+current_row+' .gst_total').html("0.00");

					var gst_all=0;
					$('.gst_total').each(function(){		
						gst_all += parseFloat($(this).html());
						gst_e = (gst_all/2).toFixed(2);
						gst_r = (gst_all-gst_e).toFixed(2);
						total_after = (input_total+gst_all).toFixed(2);
						
						$('.gst_all').html(gst_all.toFixed(2));	
						$('.gst_e').html(gst_e);	
						$('.gst_r').html(gst_r);	
						$('.total_after').html(total_after);	
					});					
			}else {
		
				var total_expense_input = total_gst_entered/2;
				var gst_total = (amount*total_gst_entered/total_amount_entered).toFixed(2);
				var gst_expense = (amount*total_expense_input/total_amount_entered).toFixed(2);
				var gst_rebate = (gst_total-gst_expense).toFixed(2);
				
				var row_num = $(this).closest('tr').attr('id').split('_');
				var current_row = row_num[1];
				$('#row_'+current_row).find('.gst_expense').html(gst_expense);
				$('#row_'+current_row).find('.gst_rebate').html(gst_rebate);
				$('#row_'+current_row).find('.gst_total').html(gst_total);

				var gst_all=0;
				$('.gst_total').each(function(){		
					gst_all += parseFloat($(this).html());
					gst_e = (gst_all/2).toFixed(2);
					gst_r = (gst_all-gst_e).toFixed(2);
					total_after = (input_total+gst_all).toFixed(2);
					
					$('.gst_all').html(gst_all.toFixed(2));	
					$('.gst_e').html(gst_e);	
					$('.gst_r').html(gst_r);	
					$('.total_after').html(total_after);	
				});					
				
			}			
		}
	
	});	

	$('#add_button').click(function (event) {
		$(".expense_code_1").select2("destroy");
		$(".project_name_1").select2("destroy");
		var $table = $(this).prev('table#expense_table'),
			$nrow = $table.find('tr:eq(1)').clone().attr('id','row_'+count);
		$table.append($nrow);
		
		$('#row_'+count+' .amount_distr').val(0.00).removeClass("accounting-css-success accounting-css-error");
		$('#row_'+count+' .gst_expense').html("0.00");
		$('#row_'+count+' .gst_rebate').html("0.00");
		$('#row_'+count+' .gst_total').html("0.00");

		$('.project_name_1').select2();
		$(".expense_code_1").select2();
		count++;						
		count_index++;			
	});	
///////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////	
	$(document).on('click','.remove_link', function(e) {
		
		var row = count_index-1;
		if (row <=1) {
			toastr.error('Cannot Delete.','System Message:');
			count_index = 2;
			count = 2;
		}else {
			var whichtr = $(this).closest("tr");
			whichtr.remove(); 
			count_index = row;
		}

		input_total=0;
		$('.amount_distr').each(function(){
			input_total += parseFloat(this.value);									
		});					
			$('.amount_all').html(input_total.toFixed(2));
			var gst_all = input_total*tax_rate;
			var gst_r = input_total*tax_rate/2;
			var gst_e = gst_all-gst_r;
			var total_after = input_total+gst_all;
			
			$('.gst_all').html(gst_all.toFixed(2));
			$('.gst_r').html(gst_r.toFixed(2));
			$('.gst_e').html(gst_e.toFixed(2));	
			$('.total_after').html(total_after.toFixed(2));	
			var gst_all=0;
			$('.gst_total').each(function(){		
				gst_all += parseFloat($(this).html());
				gst_e = (gst_all/2).toFixed(2);
				gst_r = (gst_all-gst_e).toFixed(2);
				total_after = (input_total+gst_all).toFixed(2);
				
				$('.gst_all').html(gst_all.toFixed(2));	
				$('.gst_e').html(gst_e);	
				$('.gst_r').html(gst_r);	
				$('.total_after').html(total_after);	
			});				
	});		

	$(".upload_link").on('click', function(e){ //UPLOAD LINKS
		e.preventDefault();
		upload_step = $(this).attr('id');
		upload_step = upload_step.split('_');
		upload_step = upload_step[1];
		$('#'+upload_step+':hidden').trigger('click');	
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
	

	$('#submit_expense').click(function(){	
	var array_check = [];
	var array_amount = [];
	var project_array = [];
	var expense_array = [];
	var i = 0;		
	var j = 0;		
	var k = 0;		
	var l = 0;		
	var check1 = 0;
	var check2 = 0;
	var filename = $('#proposal').val();
	var user = $('#hidden_user').val();
	var username = $('#hidden_username').val();
	var total_amount_insert = parseFloat($('#total_amount_entered').val());
	var total_after = parseFloat($('.amount_all').html());
	var total_gst_insert = parseFloat($('#total_gst_entered').val());	
	
		$('.amount_distr').each(function(){
			if (this.value == 0) {
				array_check[i] = 0;
				toastr.warning('Amount Cannot be Zero.','System Message:');				
				$(this).addClass("accounting-css-error");
				$(this).removeClass("accounting-css-success");
				i++;
			}else {
				array_check[i] = 1;
				$(this).addClass("accounting-css-success");
				$(this).removeClass("accounting-css-error");
				i++;
			}
			array_amount[j] = this.value;
			j++;
		});		

		$('.project_name_1').each(function(){
			if (this.value == undefined) {
				
			}else {
				project_array[k] = this.value;
				k++;					
			}
		});

		$('.expense_code_1').each(function(){
			if (this.value == undefined) {
				
			}else {
				expense_array[l] = this.value;
				l++;					
			}

		});			

		var array_check_final = multiply(array_check);
		if (array_check_final != 0) {
			check1 = 1;	
		}else {
			toastr.error('Amount Cannot be Zero.','System Message:');
			check1 = 0;					
		}
		
		if (filename == "") {
			check2 = 0;
			toastr.error('Please Provide Invoice PDF.','System Message:');				
		}else {
			check2 = 1;	
		}
		
		if (total_amount_insert != total_after) {
			toastr.error('Amount Does Not Add Up.','System Message:');
			check3 = 0;
		}else {
			check3 = 1;
		}
		
		if (check1 == 1 && check2 == 1 && check3 == 1) {
			$("#submit_expense").prop("disabled", true);
			$("#revert_table").prop("disabled", true);
			$("#add_button").prop("disabled", true);
			$('remove_proposal').removeClass('pdf_remove_add');	
			$("#submit_expense").html("<span class='glyphicon glyphicon-refresh glyphicon-refresh-animate'></span> Processing...");	
			$(".close_main").prop("disabled", true);				
			toastr.remove();
			var payee_name = $('#payee_picked_name').val();
			var supervisor_name = $('#supervisor').val();
			var payee_type = $('#payee_type').val();
			var invoice = $('input[id="proposal"]')[0].files[0];
			 
			var formData = new FormData(); 
			formData.append('invoice',invoice);//append 1 file at the 0th index of the file.
			formData.append('project_array',project_array);
			formData.append('expense_array',expense_array);
			formData.append('payee_name', payee_name);
			formData.append('supervisor_name', supervisor_name);
			formData.append('array_amount', array_amount);
			formData.append('user', user);
			formData.append('username', username);
			formData.append('total_amount_insert', total_amount_insert);
			formData.append('total_gst_insert', total_gst_insert);
			formData.append('payee_type', payee_type);
			swal({
			  allowOutsideClick: false,
			  allowEscapeKey: false,
			  allowEnterKey: false,			
			  title: 'Make this Expense Claim? ',
			  type: 'info',
			  showCancelButton: true,
			  showLoaderOnConfirm: true,
			  confirmButtonColor: '#62cb31',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Yes!'
			}).then(function () {
				var supervisor_id_2 = $('#supervisor_id_2').val();
				if (supervisor_name == supervisor_id_2) {
					$.LoadingOverlay("show");
					$.ajax({
						type: "POST",
						url: "./services/expense_claim.php",
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
							  title: 'Expense Claim Submitted!',
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
				}else {
					swal({
					  allowOutsideClick: false,
					  allowEscapeKey: false,
					  allowEnterKey: false,
					  text: 'Are you sure you want to continue?',
					  title: 'The supervisor you have selected is not your default supervisor. ',
					  type: 'warning',
					  showCancelButton: true,
					  showLoaderOnConfirm: true,
					  confirmButtonColor: '#62cb31',
					  cancelButtonColor: '#d33',
					  confirmButtonText: 'Yes!'
					}).then (function () {
					$.LoadingOverlay("show");
					$.ajax({
						type: "POST",
						url: "./services/expense_claim.php",
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
							  title: 'Expense Claim Submitted!',
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
							$("#submit_expense").prop("disabled", false);
							$("#revert_table").prop("disabled", false);
							$("#submit_expense").html("Submit");
							$(".close_main").prop("disabled", false);
							$('#project_name,#project_number,#project_contactname,#project_email,#project_name,#date_to, #date_from').removeClass("accounting-css-success accounting-css-error");
							$("#add_button").prop("disabled", false);
							$('remove_proposal').addClass('pdf_remove_add');								
							
						}					
					});						
				}							
					
				}, function (dismiss){					
					if (dismiss === 'cancel') {//cancel button hit
						$("#submit_expense").prop("disabled", false);
						$("#revert_table").prop("disabled", false);
						$("#submit_expense").html("Submit");
						$(".close_main").prop("disabled", false);
						$('#project_name,#project_number,#project_contactname,#project_email,#project_name,#date_to, #date_from').removeClass("accounting-css-success accounting-css-error");
						$("#add_button").prop("disabled", false);
						$('remove_proposal').addClass('pdf_remove_add');							
						
					}					
				});			
		}
		
	});
	
	$('.close_main').click(function(){			
		$('.amount_distr').val(0);
		$('.gst_expense, .gst_rebate, .gst_total, .amount_all, .gst_e, .gst_r, .gst_all').html("0.00");
		$("table#expense_table").find("tr:gt(1)").remove();	
		$('.amount_distr').removeClass("accounting-css-success accounting-css-error");
		$('#total_amount_entered, #total_gst_entered').removeClass("accounting-css-success accounting-css-error");
		$('#proposal:hidden').val('');
		$('.text_proposal').html('Select PDF Document');
		$('.proposal_icon').html('<i class="fa fa-file-pdf-o text-danger"></i>');	
		$('.total_after').html("0.00");
		$('#table_form').hide();
		$('#revert_table').hide();
		$('#continue_table').show();
		$('.total_check').prop( "disabled", false );
		$('#submit_expense').prop( "disabled", true );	
		$('#total_amount_entered').val('');
		$('#total_gst_entered').val('');	
		$('#payee_name').select2('val', 'Select a Payee');	

		$('#table_form').hide();
		$('#revert_table').hide();
		$('#continue_table').show();
		$('.total_check').prop( "disabled", false );
		$('#submit_expense').prop( "disabled", true );
		$('#select_payee').hide();
		$('#new_payee').show();	
		$('#new_payee_input').val('');	
		$('#payee_original').show();$('#payee_new').hide();
		$('#payee_name, #new_payee_input').prop( "disabled", false );	

		count=2;						
		count_index=2;			
		toastr.remove();
	});	

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////COMPLETE DELETE BUTTON////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	$('.button_delete').click(function(){
		var expense_id = $(this).attr('id');
		var expense_id_array = expense_id.split('_');
		var username = $('#hidden_username').val();
		expense_id = expense_id_array[1];		
			
		$(".edit_view").prop("disabled", true);
		$(".button_delete").prop("disabled", true);
		$(".button_delete").html("<span class='glyphicon glyphicon-refresh glyphicon-refresh-animate'></span> Processing...");	
		$(".close_js").prop("disabled", true);		
		var expense_id = $(this).attr('id').split('_');
		var info = 'delete_id='+expense_id[1]+'&username='+username;	
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
					url: "./services/expense_claim.php",
					data: info,
					cache: false,			
					beforeSend: function(){},
					success: function(data){
						if (data === "no") {
							$(".edit_view").prop("disabled", false);
							$(".button_delete").prop("disabled", false);
							$(".button_delete").html("Delete");	
							$(".close_js").prop("disabled", false);							
							toastr.error('Something went wrong.','System Message:');	
						}else {
							swal({
							  allowOutsideClick: false,
							  allowEscapeKey: false,
							  allowEnterKey: false,			
							  title: 'Expense Claim Deleted!',
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
					}
				});						
					
				
			}, function (dismiss){					
				if (dismiss === 'cancel') {//cancel button hit
					$(".edit_view").prop("disabled", false);
					$(".button_delete").prop("disabled", false);
					$(".button_delete").html("Delete");	
					$(".close_js").prop("disabled", false);
				}					
			});	
			
	});
	
	$('.action_button').click(function(){
		$(".action_button").prop("disabled", true);	
		$(this).html("<span class='glyphicon glyphicon-refresh glyphicon-refresh-animate'></span> Processing...");			
		$(".close_js").prop("disabled", true);			
		var id_array = $(this).attr('id');
		id_array = id_array.split('_');
		id_purpose = id_array[0];
		id = id_array[1];
		var info;
		var supervisor_id = $('#hidden_user').val();
		var username = $('#hidden_username').val();
		var payee_name_selection = $('#payee_name_'+id).val();	
		var comment = $('#expense_approval_'+id).val();
		
		if (id_purpose == "reject") {
			info = 'purpose=reject&comment='+comment+'&id='+id+'&supervisor='+supervisor_id+'&username='+username;
			var purpose_msg = 'Reject';
			var purpose_msg2 = 'Rejected';
			var symbol = 'error';
		}else {
			info = 'purpose=approve&comment='+comment+'&id='+id+'&supervisor='+supervisor_id+'&username='+username+'&payee_name_selection='+payee_name_selection;
			var purpose_msg = 'Approve';
			var purpose_msg2 = 'Approved';
			var symbol = 'success';
		}
		
		if (payee_name_selection == "Select a Payee" && id_purpose == "approve") {
			info = 'purpose=approve&comment='+comment+'&id='+id+'&supervisor='+supervisor_id+'&username='+username+'&payee_name_selection='+payee_name_selection+'&notify_admin=yes';
			swal({
			  allowOutsideClick: false,
			  allowEscapeKey: false,
			  allowEnterKey: false,			
			  title: 'Approve This?',
			  text: 'You are about to approve an Expense Claim which a Payee has not been properly added!',
			  type: 'warning',
			  showCancelButton: true,
			  showLoaderOnConfirm: true,
			  confirmButtonColor: '#62cb31',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Yes!'
			}).then(function () {
				$.LoadingOverlay("show");
					$.ajax({
						type: "POST",
						url: "./services/expense_claim.php",
						data: info,
						cache: false,			
						beforeSend: function(){},
						success: function(data){
							$.LoadingOverlay("hide", true);
							if (data === "no") {
								toastr.error('Something went wrong.','System Message:');
								$(".action_button").prop("disabled", false);
								$('#approve_'+id).html("Approve");
								$('#reject_'+id).html("Reject");					
								$(".close_js").prop("disabled", false);								
							}else {
								swal({
								  allowOutsideClick: false,
								  allowEscapeKey: false,
								  allowEnterKey: false,			
								  title: 'Expense Claim has been '+purpose_msg2,
								  html: 'Redirecting <i class="glyphicon glyphicon-repeat gly-spin"></i>',
								  type: symbol,
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
	  
						}
					});						
						
					
				}, function (dismiss){					
					if (dismiss === 'cancel') {//cancel button hit
						$(".action_button").prop("disabled", false);
						$('#approve_'+id).html("Approve");
						$('#reject_'+id).html("Reject");					
						$(".close_js").prop("disabled", false);								
					}					
				});			
			
			$(".action_button").prop("disabled", false);
			$('#approve_'+id).html("Approve");
			$('#reject_'+id).html("Reject");					
			$(".close_js").prop("disabled", false);		
		}else {
			toastr.remove();
			swal({
			  allowOutsideClick: false,
			  allowEscapeKey: false,
			  allowEnterKey: false,			
			  title: purpose_msg+' this?',
			  text: 'You cannot undo this action.',
			  type: 'warning',
			  showCancelButton: true,
			  showLoaderOnConfirm: true,
			  confirmButtonColor: '#62cb31',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Yes!'
			}).then(function () {
				$.LoadingOverlay("show");
					$.ajax({
						type: "POST",
						url: "./services/expense_claim.php",
						data: info,
						cache: false,			
						beforeSend: function(){},
						success: function(data){
							$.LoadingOverlay("hide", true);
							if (data === "no") {
								toastr.error('Something went wrong.','System Message:');
								$(".action_button").prop("disabled", false);
								$('#approve_'+id).html("Approve");
								$('#reject_'+id).html("Reject");					
								$(".close_js").prop("disabled", false);								
							}else {
								swal({
								  allowOutsideClick: false,
								  allowEscapeKey: false,
								  allowEnterKey: false,			
								  title: 'Expense Claim has been '+purpose_msg2,
								  html: 'Redirecting <i class="glyphicon glyphicon-repeat gly-spin"></i>',
								  type: symbol,
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
	  
						}
					});						
						
					
				}, function (dismiss){					
					if (dismiss === 'cancel') {//cancel button hit
						$(".action_button").prop("disabled", false);
						$('#approve_'+id).html("Approve");
						$('#reject_'+id).html("Reject");					
						$(".close_js").prop("disabled", false);								
					}					
				});				
		}

			
	});	
	
	$('#new_payee').click(function(){

		$('#payee_original').hide(200);
		$('#payee_new').show(200);
		$('#select_payee').show();
		$('#new_payee').hide();
		$("#payee_name").select2('val','Select a Payee');	
	});
	
	$('#select_payee').click(function(){

		$('#payee_original').show(200);
		$('#payee_new').hide(200);
		$('#select_payee').hide();
		$('#new_payee').show();
		$('#new_payee_input').val('');
		
	});	
});