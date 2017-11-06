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
	
	$('.action_button').click(function(){
		$(".action_button").prop("disabled", true);	
		$(this).html("<span class='glyphicon glyphicon-refresh glyphicon-refresh-animate'></span> Processing...");			
		$(".close_js").prop("disabled", true);
		var id_array = $(this).attr('id');
		id_array = id_array.split('_');
		id_purpose = id_array[0];
		id = id_array[1];

		var info;
		var super_comments = $('#supervisor_comment_'+id).val();
		
		var username = $('#hidden_username').val();
		
		if (id_purpose == "reject") {
			info = 'purpose=reject&id='+id+'&username='+'&super_comments='+super_comments;
			var purpose_msg = 'Approve';
			var purpose_msg = 'Reject';
			var purpose_msg2 = 'Rejected';
			var symbol = 'error';
		}else {
			info = 'purpose=approve&id='+id+'&username='+username+'&super_comments='+super_comments;
			var purpose_msg = 'Approve';
			var purpose_msg2 = 'Approved';
			var symbol = 'success';
		}
		swal({
		  allowOutsideClick: false,
		  allowEscapeKey: false,
		  allowEnterKey: false,			
		  title: purpose_msg+' Timesheet?',
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
				url: "./services/timesheet.php",
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
						  title: 'Timesheet Submission has been '+purpose_msg2,
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

