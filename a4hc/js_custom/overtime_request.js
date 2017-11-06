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
	$('#submit_overtime').click(function(){
				
		var inst = $('[data-remodal-id=overtime_request]').remodal();//obtain status of remodal

		var reason = $('.summernote').summernote('code');//$('.summernote').code();//grabs reason text area
		// var date_from = $('#date_from').val();
		// var date_to = $('#date_to').val();
		
		// var date_check1 = Date.parseExact(date_from, "yyyy/M/d");//check if date is in sql format
		// var date_check2 = Date.parseExact(date_to, "yyyy/M/d");//check if date is in sql format	
		
		var username = $('#hidden_username').val();
		var supervisor = $('#hidden_supervisor').val();
		var hours = $('#hours').val();

		function stripHTML(dirtyString) {//function to check if reason content is with html tags
		  var container = document.createElement('div');
		  var text = document.createTextNode(dirtyString);
		  container.appendChild(text);
		  return container.innerHTML; // innerHTML will be a xss safe string
		}
		
		if ($('#hours').val() == "") {
			check_hours = 0;
			toastr.error('Needs to Input Hours','System Message:');
		}else {
			check_hours = 1;
		}
		
		var reason_check_content = stripHTML(reason);//uses stripHTML function to check for html tags

		if (check_hours == 1) { //date_check1!=null && date_check2!=null
			// $("#date_to, #date_from").removeClass("overtime-css-error");
			// $("#date_to, #date_from").addClass("overtime-css-success");
			$('remove_proposal').removeClass('pdf_remove_add');
			$(".error_msg1").hide();//hide any previous errors msg				
			if ($.trim(reason_check_content).length > 0) {// check if reason content is empty
				$(".note-editor").removeClass("summernote-css-error");
				$(".note-editor").addClass("summernote-css-success");
				$(".error_msg2").hide();//hide any previous errors msg
				$("#submit_overtime").prop("disabled", true);
				$(".close_main").prop("disabled", true);
				$("#submit_overtime").html("<span class='glyphicon glyphicon-refresh glyphicon-refresh-animate'></span> Processing...");
				swal({
				  allowOutsideClick: false,
				  allowEscapeKey: false,
				  allowEnterKey: false,			
				  title: 'Are you sure you want to submit?',
				  type: 'info',
				  showCancelButton: true,
				  showLoaderOnConfirm: true,
				  confirmButtonColor: '#62cb31',
				  cancelButtonColor: '#d33',
				  confirmButtonText: 'Yes!'
				}).then(function () {
					$("#submit_overtime").html("<span class='glyphicon glyphicon-refresh glyphicon-refresh-animate'></span> Processing...");	
					$("#submit_overtime").prop("disabled", true);
					$("#overtime_request_close").prop("disabled", true);
					var formData = new FormData(); 
					formData.append('file', $('input[id="proposal"]')[0].files[0]);//append 1 file at the 0th index of the file.
					// formData.append('date_from', date_from);
					// formData.append('date_to', date_to);
					formData.append('reason', reason);
					formData.append('username', username);
					formData.append('supervisor', supervisor);
					formData.append('hours', hours);
					$.LoadingOverlay("show");
					$.ajax({
						type: "POST",
						url: "./services/overtime_request.php",
						data: formData,
						cache: false,
						contentType: false,
						processData: false,					
						beforeSend: function(){},
						success: function(data){
							$.LoadingOverlay("hide", true);
							if (data === "Files must be less than 5MB." || data === "Only PDF files are allowed.") {
								swal({
								  allowOutsideClick: false,
								  allowEscapeKey: false,
								  allowEnterKey: false,	
								  showCancelButton: false,
								  showConfirmButton: true,								  
								  title: 'File Error!',
								  text: data,
								  type: 'error',
								  showLoaderOnConfirm: true,
								  confirmButtonColor: '#f27474',
								  confirmButtonText: 'Try Again'
								}).then (function(){
									$("#submit_overtime").prop("disabled", false);
									$("#submit_overtime").html("Submit");
									$("#overtime_request_close").prop("disabled", false);
								})
							}else {
								$.LoadingOverlay("hide", true);
								$("#submit_overtime").html("Submit");
								$("#submit_overtime").prop("disabled", true);
								console.log(data)
								swal({
								  allowOutsideClick: false,
								  allowEscapeKey: false,
								  allowEnterKey: false,			
								  title: 'Submitted!',
								  html: 'Redirecting <i class="glyphicon glyphicon-repeat gly-spin"></i>',
								  type: 'success',
								  timer: 2000,
								  showLoaderOnConfirm: true,
								  confirmButtonColor: '#62cb31',
								  confirmButtonText: 'Okie!'
								}).then (function(){
									$("#submit_overtime").html("Submit");
									$("#submit_overtime").prop("disabled", true);
									inst.close();
									$("#submit_overtime").prop("disabled", false);//enable submit button
									// $('#date_from').val('');//clear input
									// $('#date_to').val('');//clear input
									$('#overtime_file').val('');//clear input
									$(".note-editable").empty();//empty summernote
									document.location.reload(true);
								}, function (dismiss){					
										if (dismiss === 'timer') {//cancel button hit
											$("#submit_overtime").html("Submit");
											$("#submit_overtime").prop("disabled", true);
											inst.close();
											$("#submit_overtime").prop("disabled", false);//enable submit button
											// $('#date_from').val('');//clear input
											// $('#date_to').val('');//clear input
											$('#overtime_file').val('');//clear input
											$(".note-editable").empty();//empty summernot
											document.location.reload(true);
										}					
								   });							
							}
						}
					});						
					
				}, function (dismiss){					
					if (dismiss === 'cancel') {//cancel button hit
						$("#submit_overtime").prop("disabled", false);
						$('remove_proposal').addClass('pdf_remove_add');	
						$(".close_main").prop("disabled", false);
						$("#submit_overtime").html("Submit");
					}					
				});					
			}else {
				toastr.error('Please put a reason.','System Message:');
				$(".note-editor").removeClass("summernote-css-success");
				$(".note-editor").addClass("summernote-css-error");
			}		
		}else {
			// toastr.error('Please Input valid dates.','System Message:');
			// $("#date_to, #date_from").removeClass("overtime-css-success");
			// $("#date_to, #date_from").addClass("overtime-css-error");	
		}
	
	});
	
	$('.close_main').click(function(){	
		// $("#date_to, #date_from").val('');
		$('#hours').val('');
		$(".note-editable").html('<table class="table table-bordered"><tbody><tr><th>Date</th><th>Hours</th><th>Note</th></tr><tr><td>...</td><td></td><td></td></tr><tr><td>...</td><td></td><td></td></tr>');//empty summernot
		$("#proposal").val('');
		$('.text_proposal').html('Select PDF Document');
		$('.proposal_icon').html('<i class="fa fa-file-pdf-o text-danger"></i>');		
		// $("#date_to").datepicker('setDate', null);
		// $("#date_from").datepicker('setDate', null);
		$("#hours").removeClass("overtime-css-error");//#date_to, #date_from, 
		$("#hours").removeClass("overtime-css-success");//#date_to, #date_from,
		$(".note-editor").removeClass("summernote-css-error");
		$(".note-editor").removeClass("summernote-css-success");		
		toastr.remove();
	});	


	// $('#date_from, #date_to').on('change', function() {
	// 	var date_from = $('#date_from').val();
	// 	var date_to = $('#date_to').val();		
	// 	var date_check1 = Date.parseExact(date_from, "yyyy/M/d");//check if date is in sql format
	// 	var date_check2 = Date.parseExact(date_to, "yyyy/M/d");//check if date is in sql format			
	// 	//alert(date_check1);
	// 	if (date_check1!=null || date_check2!=null) {
	// 		//alert(date_check1);
	// 		toastr.success('Dates are Okay!','System Message:')
	// 		$("#date_to, #date_from").removeClass("overtime-css-error");
	// 		$("#date_to, #date_from").addClass("overtime-css-success");			
	// 	}else {
	// 		toastr.error('Please Input valid dates.','System Message:')
	// 		$("#date_to, #date_from").removeClass("overtime-css-success");
	// 		$("#date_to, #date_from").addClass("overtime-css-error");			
	// 	}		
	// });

	$('#hours').on('change', function() {
		var hours = $('#hours').val();	
		if (hours > 0) {
			toastr.success('Hours Valid.','System Message:')
			$('#hours').removeClass("overtime-css-error");
			$('#hours').addClass("overtime-css-success");			
		}else {
			$('#hours').val('');
			toastr.error('Invalid Hours was Inputted','System Message:')
			$('#hours').removeClass("overtime-css-success");
			$('#hours').addClass("overtime-css-error");			
		}		
	});
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////COMPLETE DELETE BUTTON////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	$('.button_delete').click(function(){
		var overtime_id = $(this).attr('id');
		var overtime_id_array = overtime_id.split('_');

		overtime_id = overtime_id_array[1];		
			
		$(".edit_view").prop("disabled", true);
		$(".button_delete").prop("disabled", true);
		$(".button_delete").html("<span class='glyphicon glyphicon-refresh glyphicon-refresh-animate'></span> Processing...");	
		$(".close_js").prop("disabled", true);		
		var overtime_id = $(this).attr('id').split('_');
		var username = $('#hidden_username').val();
		var info = 'delete_id='+overtime_id[1]+'&username='+username;	
		
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
					url: "./services/overtime_request.php",
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
							  title: 'Overtime Request Deleted!',
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
		var comment = $('#overtime_approval_'+id).val();
		
		if (id_purpose == "reject") {
			info = 'purpose=reject&comment='+comment+'&id='+id+'&supervisor='+supervisor_id+'&username='+username;
			var purpose_msg = 'Reject';
			var purpose_msg2 = 'Rejected';
			var symbol = 'error';
		}else {
			info = 'purpose=approve&comment='+comment+'&id='+id+'&supervisor='+supervisor_id+'&username='+username;
			var purpose_msg = 'Approve';
			var purpose_msg2 = 'Approved';
			var symbol = 'success';
		}

		swal({
		  allowOutsideClick: false,
		  allowEscapeKey: false,
		  allowEnterKey: false,			
		  title: purpose_msg+' this?',
		  type: 'warning',
		  showCancelButton: true,
		  showLoaderOnConfirm: true,
		  confirmButtonColor: '#62cb31',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Yes!'
		}).then(function () {
				$.ajax({
					type: "POST",
					url: "./services/overtime_request.php",
					data: info,
					cache: false,			
					beforeSend: function(){},
					success: function(data){
						console.log(data);
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
							  title: 'Overtime Request has been '+purpose_msg2,
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
			
	});	

});

