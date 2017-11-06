$(document).ready(function(){
	$("div[class*='edit_pdf']").hide();	
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

	function capWords(str){ //CAPITALIZE EACH LETTER OF THE FIRST WORD OF THE STRING. 
	   var words = str.split(" "); 
	   for (var i=0 ; i < words.length ; i++){ 
		  var testwd = words[i]; 
		  var firLet = testwd.substr(0,1); 
		  var rest = testwd.substr(1, testwd.length -1) 
		  words[i] = firLet.toUpperCase() + rest 
	   }
		return words.join(" ");
	}
	
	function isEmail(email) { //CHECK IF IT IS EMAIL
	  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	  return regex.test(email);
	}	
	
	var upload_step;
	var upload_global;

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
	
	var upload_step_edit;
	var upload_global_edit;
	var upload_id_edit;
	$(".upload_link_edit").on('click', function(e){ //UPLOAD LINKS
		e.preventDefault();
		upload_step_edit = $(this).attr('id');
		upload_step_edit = upload_step_edit.split('_');
		upload_id_edit = upload_step_edit[2];
		upload_step_edit = upload_step_edit[1];
		$('#'+upload_step_edit+'_'+upload_id_edit+':hidden').trigger('click');	
	});	
	
		
	$('.upload_edit').change(function () { //UPLOAD LINK CHECK AND CSS UPDATE
	upload_global_edit = upload_step_edit;
	upload_global_id = upload_id_edit;
	console.log(upload_global_edit);
	console.log(upload_global_id);
		var filename = $('#'+upload_global_edit+'_'+upload_global_id+':hidden').val();
		var extension_check = $('#'+upload_global_edit+'_'+upload_global_id+':hidden').val();

		if (extension_check != null) {
			extension_check = extension_check.substr( (extension_check.lastIndexOf('.') +1) ).toLowerCase();
		}		
		filename = filename.split('\\');
		filename = filename[2];
		
		if (filename != null && extension_check == "pdf") {
			$('.text_'+upload_global_edit+'_'+upload_global_id).html(filename+ '<span><i class="fa fa-check-circle text-success"></i></span><span id="'+upload_global_edit+'_x"><a id="remove_'+upload_global_edit+'_'+upload_global_id+'" href="#" class="pdf_remove"><span class="pdf_label">X</span></a></span>');
			$('.'+upload_global_edit+'_'+'icon_'+upload_global_id).html('<i class="fa fa-file-pdf-o text-success"></i><p class="text-success">Attached</p>');
			$('#confirm_'+upload_global_edit+'_'+upload_global_id).val('attached');
			toastr.remove();
			
		}else {
			toastr.warning('Only PDF Documents are Allowed','System Message:');
			$('#'+upload_global_edit+'_'+upload_global_id+':hidden').val('');
			$('.text_'+upload_global_edit+'_'+upload_global_id).html('Select PDF Document');
			$('.'+upload_global_edit+'_'+'icon_'+upload_global_id).html('<i class="fa fa-file-pdf-o text-danger"></i>');
			$('#confirm_'+upload_global_edit+'_'+upload_global_id).val('removed');
		}
	});	
	
	
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
////////////////////////////ON CHANGE FUNCTIONS/////////////////////////////////////////////////////////////////////////////////////////////////
var alphanumers = /^[a-z\d\-_\s]+$/;	
	$('#project_name').change('input propertychange', function() {	
		var project_name = $('#project_name').val().toLowerCase();
		var info = 'project_name_code_check='+project_name;
		if(!alphanumers.test(project_name)){
			toastr.error('No Special Characters Allowed.','System Message:');
			$("#project_name").removeClass("accounting-css-success");
			$("#project_name").addClass("accounting-css-error");
		}else {
			$.ajax({
				type: "POST",
				url: "./services/projects.php",
				data: info,
				cache: false,				
				beforeSend: function(){},
				success: function(data){
					if ($.trim(project_name).length > 5 && data === "taken") {
						toastr.error('Please Enter a Valid Project Name.','System Message:');
						$("#project_name").removeClass("accounting-css-success");
						$("#project_name").addClass("accounting-css-error");					
					}else if ($.trim(project_name).length > 5 && data === "okay") {						
							toastr.success('Project Name Okay!','System Message:');	
							$("#project_name").removeClass("accounting-css-error");
							$("#project_name").addClass("accounting-css-success");							
					} else {
						toastr.error('Please Enter a Valid Project Name.','System Message:');
						$("#project_name").removeClass("accounting-css-success");
						$("#project_name").addClass("accounting-css-error");					
					}
					
				}
			});				
		}
	
	});

	$('#project_number').change('input propertychange', function() {
		var project_number = $('#project_number').val();
		var info = 'project_number_code_check='+project_number;
		
		if(!alphanumers.test(project_number)){
			toastr.error('No Special Characters Allowed.','System Message:');
			$("#project_number").removeClass("accounting-css-success");
			$("#project_number").addClass("accounting-css-error");
		}else {
			$.ajax({
				type: "POST",
				url: "./services/projects.php",
				data: info,
				cache: false,				
				beforeSend: function(){},
				success: function(data){
					if ($.trim(project_number).length > 5 && data === "taken") {
						toastr.error('Please Enter a Valid Project Number.','System Message:');
						$("#project_number").removeClass("accounting-css-success");
						$("#project_number").addClass("accounting-css-error");					
					}else if ($.trim(project_number).length > 5 && data === "okay") {						
							toastr.success('Project Number Okay!','System Message:');	
							$("#project_number").removeClass("accounting-css-error");
							$("#project_number").addClass("accounting-css-success");							
					} else {
						toastr.error('Please Enter a Valid Project Number.','System Message:');
						$("#project_number").removeClass("accounting-css-success");
						$("#project_number").addClass("accounting-css-error");					
					}
					
				}
			});
		
		}		
	
	});
	$('#project_contactname').change('input propertychange', function() {
		var project_contactname = $('#project_contactname').val();
		if ($.trim(project_contactname).length >=5 ) {
			$("#project_contactname").removeClass("accounting-css-error");
			$("#project_contactname").addClass("accounting-css-success");
			toastr.success('Client Contact Name Okay!','System Message:');			
		}else{ 
			$("#project_contactname").removeClass("accounting-css-success");
			$("#project_contactname").addClass("accounting-css-error");
			toastr.error('Please Enter a Valid Client Contact Name.','System Message:');						
		}	
	});
	$('#project_email').change('input propertychange', function() {
		var project_email = $('#project_email').val();
		project_email_check = isEmail(project_email);
		if (project_email_check != false) {
			$("#project_email").removeClass("accounting-css-error");
			$("#project_email").addClass("accounting-css-success");
			toastr.success('Client Email Okay!','System Message:');			
		}else{ 
			$("#project_email").removeClass("accounting-css-success");
			$("#project_email").addClass("accounting-css-error");
			toastr.error('Please Enter a Valid Client Email.','System Message:');						
		}	
	});	
	$('#date_from, #date_to').on('change', function() {
		var date_from = $('#date_from').val();
		var date_to = $('#date_to').val();		
		var date_check1 = Date.parseExact(date_from, "yyyy/M/d");//check if date is in sql format
		var date_check2 = Date.parseExact(date_to, "yyyy/M/d");//check if date is in sql format			
		//alert(date_check1);
		if (date_check1!=null || date_check2!=null) {
			//alert(date_check1);
			toastr.success('Dates are Okay!','System Message:')
			$("#date_to, #date_from").removeClass("accounting-css-error");
			$("#date_to, #date_from").addClass("accounting-css-success");			
		}else {
			toastr.error('Please Input valid dates.','System Message:')
			$("#date_to, #date_from").removeClass("accounting-css-success");
			$("#date_to, #date_from").addClass("accounting-css-error");			
		}		
	});	
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$('#project_add_submit').click(function(){
	var project_name = $('#project_name').val().toLowerCase();;
	var username = $('#hidden_username').val();
	var project_number = $('#project_number').val();
	var project_contactname = $('#project_contactname').val();
	var project_manager = $('#project_manager').val();
	var project_email = $('#project_email').val();
	var date_from = $('#date_from').val();
	var date_to = $('#date_to').val();
	var project_info = $('#project_info').val();
	var proposal = $('input[id="proposal"]')[0].files[0];
	var approval = $('input[id="approval"]')[0].files[0];
	var agreement = $('input[id="agreement"]')[0].files[0];

	var project_email_check = isEmail(project_email);
		if (!alphanumers.test(project_name)) {
			toastr.error('No Special Characters Allowed.','System Message:');
			$("#project_name").removeClass("accounting-css-success");
			$("#project_name").addClass("accounting-css-error");
			check1 = 0;
		}else {
			if ($.trim(project_name).length > 5) {
				$("#project_name").removeClass("accounting-css-error");
				$("#project_name").addClass("accounting-css-success");
				toastr.success('Project Name Okay!','System Message:');	
				check1 = 1;
			}else{ 
				$("#project_name").removeClass("accounting-css-success");
				$("#project_name").addClass("accounting-css-error");
				toastr.error('Please Enter a Valid Project Name.','System Message:');	
				check1 = 0;
			}		
		}

		if (!alphanumers.test(project_number)) {
			toastr.error('No Special Characters Allowed.','System Message:');
			$("#project_number").removeClass("accounting-css-success");
			$("#project_number").addClass("accounting-css-error");	
			check2 = 0;
		}else {
			if ($.trim(project_number).length >=4 ) {
				$("#project_number").removeClass("accounting-css-error");
				$("#project_number").addClass("accounting-css-success");
				toastr.success('Project Number Okay!','System Message:');
				check2 = 1;			
			}else{ 
				$("#project_number").removeClass("accounting-css-success");
				$("#project_number").addClass("accounting-css-error");
				toastr.error('Please Enter a Valid Project Number.','System Message:');		
				check2 = 0;				
			}			
		}

		if ($.trim(project_contactname).length >=5 ) {
			$("#project_contactname").removeClass("accounting-css-error");
			$("#project_contactname").addClass("accounting-css-success");
			toastr.success('Client Contact Name Okay!','System Message:');
			check3=1;
		}else{ 
			$("#project_contactname").removeClass("accounting-css-success");
			$("#project_contactname").addClass("accounting-css-error");
			toastr.error('Please Enter a Valid Client Contact Name.','System Message:');	
			check3=0;			
		}

		var project_email_check = isEmail(project_email);
		if (project_email_check != false) {
			$("#project_email").removeClass("accounting-css-error");
			$("#project_email").addClass("accounting-css-success");
			toastr.success('Client Email Okay!','System Message:');	
			check4=1;
		}else{ 
			$("#project_email").removeClass("accounting-css-success");
			$("#project_email").addClass("accounting-css-error");
			toastr.error('Please Enter a Valid Client Email.','System Message:');
			check4=0;			
		}

		var date_check1 = Date.parseExact(date_from, "yyyy/M/d");//check if date is in sql format
		var date_check2 = Date.parseExact(date_to, "yyyy/M/d");//check if date is in sql format			
		//alert(date_check1);
		if (date_check1!=null || date_check2!=null) {
			//alert(date_check1);
			toastr.success('Dates are Okay!','System Message:')
			$("#date_to, #date_from").removeClass("accounting-css-error");
			$("#date_to, #date_from").addClass("accounting-css-success");
			check5=1;
		}else {
			toastr.error('Please Input valid dates.','System Message:')
			$("#date_to, #date_from").removeClass("accounting-css-success");
			$("#date_to, #date_from").addClass("accounting-css-error");			
			check5=0;
		}		

		if (check1 === 1 && check2 === 1 && check3 === 1 && check4 === 1 && check5 === 1) {
			project_name = capWords(project_name);
			project_contactname = capWords(project_contactname);
			
			var formData = new FormData(); 
			formData.append('file_proposal',proposal);//append 1 file at the 0th index of the file.
			formData.append('file_approval',approval);//append 1 file at the 0th index of the file.
			formData.append('file_agreement',agreement);//append 1 file at the 0th index of the file.
			formData.append('date_from', date_from);
			formData.append('date_to', date_to);
			formData.append('project_info', project_info);
			formData.append('username', username);
			formData.append('project_email', project_email);
			formData.append('project_contactname', project_contactname);
			formData.append('project_number', project_number);
			formData.append('project_name', project_name);
			formData.append('project_manager', project_manager);
	
			$("#project_add_submit").prop("disabled", true);
			$("#project_add_submit").html("<span class='glyphicon glyphicon-refresh glyphicon-refresh-animate'></span> Processing...");	
			$(".close_main").prop("disabled", true);	
			toastr.remove();
			swal({
			  allowOutsideClick: false,
			  allowEscapeKey: false,
			  allowEnterKey: false,			
			  title: 'Add New Project? ',
			  html: '<strong><h3>"'+project_name+'"</strong></h3>',
			  type: 'info',
			  showCancelButton: true,
			  showLoaderOnConfirm: true,
			  confirmButtonColor: '#62cb31',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Yes!'
			}).then(function () {					
					$.ajax({
						type: "POST",
						url: "./services/projects.php",
						data: formData,
						cache: false,
						contentType: false,
						processData: false,					
						beforeSend: function(){},
						success: function(data){
							$("#project_add_submit").prop("disabled", true);
							$("#project_add_submit").html("Add");
							$(".close_js").prop("disabled", true);
							swal({
							  allowOutsideClick: false,
							  allowEscapeKey: false,
							  allowEnterKey: false,			
							  title: 'New Project Added!',
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
						$("#project_add_submit").prop("disabled", false);
						$("#project_add_submit").html("Submit");
						$(".close_main").prop("disabled", false);
						$('#project_name,#project_number,#project_contactname,#project_email,#project_name,#date_to, #date_from').removeClass("accounting-css-success accounting-css-error");								
						
					}					
				});			
		}
	
	});
	
	$('.close_main').click(function(){	
		$('#project_name,#project_number,#project_contactname,#project_email,#project_name,#date_to, #date_from, #project_info').val('');
		$('#project_name,#project_number,#project_contactname,#project_email,#project_name,#date_to, #date_from').removeClass("accounting-css-success accounting-css-error");
		$('#proposal:hidden, #approval:hidden, #agreement:hidden').val('');
		$('.text_agreement, .text_approval, .text_proposal').html('Select PDF Document');
		$('.agreement_icon, .approval_icon, .proposal_icon').html('<i class="fa fa-file-pdf-o text-danger"></i>');		
		toastr.remove();
	});		
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////EDIT MODE/////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	$('.edit_mode').click(function() {
		if($(this).prop('checked')){
			var this_id = $(this).attr('id');
			var this_id_array = this_id.split('_');
			this_id = this_id_array[1];
			
			$('.readonly_'+this_id).each(function(){
				$(this).removeAttr('disabled');
			});	

			$('#date_from_'+this_id).prop('readonly', true);
			$('#date_to_'+this_id).prop('readonly', true);
			$(".view_pdf_"+this_id).hide();
			$(".edit_pdf_"+this_id).show();
				
			
			$('#switch_'+this_id).html("Editing:");			
			
		}else {
			var this_id = $(this).attr('id');
			var this_id_array = this_id.split('_');
			this_id = this_id_array[1];
			
			$('.readonly_'+this_id).each(function(){
				$(this).attr('disabled', 'disabled');
			});	
			$(".view_pdf_"+this_id).show();
			$(".edit_pdf_"+this_id).hide();			
			$('#switch_'+this_id).html("Viewing:");	

			var project_id = $(this).attr('id').split('_');
			var info = 'close_id='+project_id[1];
			$(".view_pdf_"+project_id[1]).show();
			$(".edit_pdf_"+project_id[1]).hide();	

				$.ajax({
					type: "POST",
					url: "./services/projects.php",
					data: info,
					cache: false,			
					beforeSend: function(){},
					success: function(data){
						var project_json_return = $.parseJSON(data);//php to jquery json for payee info.
						project_json_return = project_json_return[0];
						
						var client_name = project_json_return.client_contact;
						var client_email = project_json_return.client_email;
						var project_manager = project_json_return.project_manager;
						var project_start = project_json_return.project_start;
						var project_end = project_json_return.project_end;
						var project_info = project_json_return.info;

						$('#project_contactname_'+project_id[1]).val(client_name);
						$('#project_email_'+project_id[1]).val(client_email);
						$('#date_from_'+project_id[1]).val(project_start);
						$('#date_to_'+project_id[1]).val(project_end);
						$('#project_info_'+project_id[1]).val(project_info);
						
						var project_manager_data = 'project_manager_id='+project_manager;
						$.ajax({
							type: "POST",
							url: "./services/projects.php",
							data: project_manager_data,
							cache: false,			
							beforeSend: function(){},
							success: function(data){
								
								$('#project_manager_'+project_id[1]).select2('val', project_manager);
							}
						});						

					}
				});	
				var pdf_info_id = 'pdf_info_id='+project_id[1];
				$.ajax({
					type: "POST",
					url: "./services/projects.php",
					data: pdf_info_id,
					cache: false,			
					beforeSend: function(){},
					success: function(data2){
						var pdf_return = $.parseJSON(data2);
						var length = Object.keys(pdf_return).length;
						if (length > 0 && pdf_return[0] != undefined) {
							$('#agreement_'+project_id[1]+':hidden').val('');
							$('#proposal_'+project_id[1]+':hidden').val('');
							$('#approval_'+project_id[1]+':hidden').val('');
							$('.text_agreement_'+project_id[1]).html('Select PDF Document');
							$('.text_proposal_'+project_id[1]).html('Select PDF Document');
							$('.text_approval_'+project_id[1]).html('Select PDF Document');

							$('.agreement_icon_'+project_id[1]).html('<i class="fa fa-file-pdf-o text-danger"></i>');
							$('.approval_icon_'+project_id[1]).html('<i class="fa fa-file-pdf-o text-danger"></i>');
							$('.proposal_icon_'+project_id[1]).html('<i class="fa fa-file-pdf-o text-danger"></i>');

							$('#agreement_x').hide();
							$('#approval_x').hide();
							$('#proposal_x').hide();

							$('#confirm_proposal_'+project_id[1]).val('removed');
							$('#confirm_agreement_'+project_id[1]).val('removed');
							$('#confirm_approval_'+project_id[1]).val('removed');								
							for (i = 0; i< length; i++){
								switch(pdf_return[i].data.application) {
									case "approval":
										$('.text_'+pdf_return[i].data.application+'_'+pdf_return[i].data.project_id).html(pdf_return[i].data.real_file_name+ '<span><i class="fa fa-check-circle text-success"></i></span><span id="'+pdf_return[i].data.application+'_x"><a id="remove_'+pdf_return[i].data.application+'_'+pdf_return[i].data.project_id+'" href="#" class="pdf_remove"><span class="pdf_label">X</span></a></span>');
										$('.'+pdf_return[i].data.application+'_'+'icon_'+pdf_return[i].data.project_id).html('<i class="fa fa-file-pdf-o text-success"></i><p class="text-success">Attached</p>');
										$('#confirm_'+pdf_return[i].data.application+'_'+pdf_return[i].data.project_id).val('attached');
										break;
									case "proposal":
										$('.text_'+pdf_return[i].data.application+'_'+pdf_return[i].data.project_id).html(pdf_return[i].data.real_file_name+ '<span><i class="fa fa-check-circle text-success"></i></span><span id="'+pdf_return[i].data.application+'_x"><a id="remove_'+pdf_return[i].data.application+'_'+pdf_return[i].data.project_id+'" href="#" class="pdf_remove"><span class="pdf_label">X</span></a></span>');
										$('.'+pdf_return[i].data.application+'_'+'icon_'+pdf_return[i].data.project_id).html('<i class="fa fa-file-pdf-o text-success"></i><p class="text-success">Attached</p>');
										$('#confirm_'+pdf_return[i].data.application+'_'+pdf_return[i].data.project_id).val('attached');
										break;
									case "agreement":
										$('.text_'+pdf_return[i].data.application+'_'+pdf_return[i].data.project_id).html(pdf_return[i].data.real_file_name+ '<span><i class="fa fa-check-circle text-success"></i></span><span id="'+pdf_return[i].data.application+'_x"><a id="remove_'+pdf_return[i].data.application+'_'+pdf_return[i].data.project_id+'" href="#" class="pdf_remove"><span class="pdf_label">X</span></a></span>');
										$('.'+pdf_return[i].data.application+'_'+'icon_'+pdf_return[i].data.project_id).html('<i class="fa fa-file-pdf-o text-success"></i><p class="text-success">Attached</p>');
										$('#confirm_'+pdf_return[i].data.application+'_'+pdf_return[i].data.project_id).val('attached');
										break;								
								}
							}				
						}else {
							$('#agreement_'+project_id[1]+':hidden').val('');
							$('#proposal_'+project_id[1]+':hidden').val('');
							$('#approval_'+project_id[1]+':hidden').val('');
							$('.text_agreement_'+project_id[1]).html('Select PDF Document');
							$('.text_proposal_'+project_id[1]).html('Select PDF Document');
							$('.text_approval_'+project_id[1]).html('Select PDF Document');

							$('.agreement_icon_'+project_id[1]).html('<i class="fa fa-file-pdf-o text-danger"></i>');
							$('.approval_icon_'+project_id[1]).html('<i class="fa fa-file-pdf-o text-danger"></i>');
							$('.proposal_icon_'+project_id[1]).html('<i class="fa fa-file-pdf-o text-danger"></i>');

							$('#agreement_x').hide();
							$('#approval_x').hide();
							$('#proposal_x').hide();

							$('#confirm_proposal_'+project_id[1]).val('removed');
							$('#confirm_agreement_'+project_id[1]).val('removed');
							$('#confirm_approval_'+project_id[1]).val('removed');
						}	
					}
				});

				$('#project_contactname_'+project_id[1]).removeClass("accounting-css-success accounting-css-error");	
				$('#project_email_'+project_id[1]).removeClass("accounting-css-success accounting-css-error");	
				$('#date_from_'+project_id[1]).removeClass("accounting-css-success accounting-css-error");	
				$('#date_to_'+project_id[1]).removeClass("accounting-css-success accounting-css-error");	
						
				toastr.remove();			
		}
	});
	
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////REMODAL EDIT//////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	$('.remodal_view').click(function(){
		var input_array = [];
		var i = 0;
		var project_id = $(this).attr('id');
		var project_id_array = project_id.split('_');
		
		project_id = project_id_array[2];

		$('#project_contactname_'+project_id).change('input propertychange', function() {
			var client_contact = $('#project_contactname_'+project_id).val();
			if ($.trim(client_contact).length >=5 ) {
				$('#project_contactname_'+project_id).removeClass("accounting-css-error");
				$('#project_contactname_'+project_id).addClass("accounting-css-success");
				toastr.success('Client Contact Name Okay!','System Message:');			
			}else{ 
				$('#project_contactname_'+project_id).removeClass("accounting-css-success");
				$('#project_contactname_'+project_id).addClass("accounting-css-error");
				toastr.error('Please Enter a Valid Client Contact Name.','System Message:');						
			}	
		});
		$('#project_email_'+project_id).change('input propertychange', function() {
			var client_email = $('#project_email_'+project_id).val();
			project_email_check = isEmail(client_email);
			if (project_email_check != false) {
				$('#project_email_'+project_id).removeClass("accounting-css-error");
				$('#project_email_'+project_id).addClass("accounting-css-success");
				toastr.success('Client Email Okay!','System Message:');			
			}else{ 
				$('#project_email_'+project_id).removeClass("accounting-css-success");
				$('#project_email_'+project_id).addClass("accounting-css-error");
				toastr.error('Please Enter a Valid Client Email.','System Message:');						
			}	
		});	
		$("#date_from_"+project_id).on('change', function() {
			var date_from = $("#date_from_"+project_id).val();		
			var date_check1 = Date.parseExact(date_from, "yyyy/M/d");//check if date is in sql format		
			if (date_check1!=null) {
				toastr.success('Project Start Date is Okay!','System Message:')
				$("#date_from_"+project_id).removeClass("accounting-css-error");
				$("#date_from_"+project_id).addClass("accounting-css-success");			
			}else {
				toastr.error('Please Input valid dates.','System Message:')
				$("#date_from_"+project_id).removeClass("accounting-css-success");
				$("#date_from_"+project_id).addClass("accounting-css-error");			
			}		
		});	
		$("#date_to_"+project_id).on('change', function() {
			var date_to = $("#date_to_"+project_id).val();		
			var date_check1 = Date.parseExact(date_to, "yyyy/M/d");//check if date is in sql format		
			if (date_check1!=null) {
				toastr.success('Project End Date is Okay!','System Message:')
				$("#date_to_"+project_id).removeClass("accounting-css-error");
				$("#date_to_"+project_id).addClass("accounting-css-success");			
			}else {
				toastr.error('Please Input valid dates.','System Message:')
				$("#date_to_"+project_id).removeClass("accounting-css-success");
				$("#date_to_"+project_id).addClass("accounting-css-error");			
			}		
		});
		
	});

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////EDITING SUBMIT/////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$('.edit_view').click(function(){ //submit		
		var input_array = [];
		var i = 0;
		
		var client_contact;
		var client_email;
		var project_manager;
		var project_start;
		var project_end;
		var proposal_pdf;
		var approval_pdf;
		var agreement_pdf;
		var project_info;
		
		var project_id = $(this).attr('id');
		var project_id_array = project_id.split('_');

		var check1;
		var check2;

		project_id = project_id_array[2];
		$('.field_value_'+project_id).each(function(){
			input_array[i] = this.value;
			i++;
		});	
		
		var check_box = $('#checkbox_'+project_id).prop('checked');
		if (check_box == false){
			toastr.error('To Save, Please Enter Edit Mode.','System Message:');		
		}else {	
			client_contact = capWords(input_array[0]);
			client_email = input_array[1];
			project_start = input_array[2];
			project_end = input_array[3];
			project_info = input_array[4];
			project_manager = $('#project_manager_'+project_id).find('option:selected').val();
			
		if ($.trim(client_contact).length >=5 ) {
			$("#project_contactname_"+project_id).removeClass("accounting-css-error");
			$("#project_contactname_"+project_id).addClass("accounting-css-success");
			toastr.success('Client Contact Name Okay!','System Message:');
			check1=1;
		}else{ 
			$("#project_contactname_"+project_id).removeClass("accounting-css-success");
			$("#project_contactname_"+project_id).addClass("accounting-css-error");
			toastr.error('Please Enter a Valid Client Contact Name.','System Message:');	
			check1=0;			
		}

		var client_email_check = isEmail(client_email);
		if (client_email_check != false) {
			$("#project_email_"+project_id).removeClass("accounting-css-error");
			$("#project_email_"+project_id).addClass("accounting-css-success");
			toastr.success('Client Email Okay!','System Message:');	
			check2=1;
		}else{ 
			$("#project_email_"+project_id).removeClass("accounting-css-success");
			$("#project_email_"+project_id).addClass("accounting-css-error");
			toastr.error('Please Enter a Valid Client Email.','System Message:');
			check2=0;			
		}
		var username = $('#hidden_username').val();
		var formData = new FormData(); 	
		
		var confirm_proposal = $('#confirm_proposal_'+project_id).val();
		var confirm_agreement = $('#confirm_agreement_'+project_id).val();
		var confirm_approval = $('#confirm_approval_'+project_id).val();
		
		
		if (confirm_proposal == "attached") {
			proposal_pdf = $('input[id="proposal_'+project_id+'"]')[0].files[0];
			formData.append('file_proposal_edit',proposal_pdf);//append 1 file at the 0th index of the file.
			formData.append('file_proposal_edit_msg','attached');
		}else {
			formData.append('file_proposal_edit_msg','removed');
		}
		
		if (confirm_approval == "attached") {
			approval_pdf = $('input[id="approval_'+project_id+'"]')[0].files[0];
			formData.append('file_approval_edit',approval_pdf);//append 1 file at the 0th index of the file.	
			formData.append('file_approval_edit_msg','attached');
		}else {
			formData.append('file_approval_edit_msg','removed');
		}

		if (confirm_agreement == "attached") {
			agreement_pdf = $('input[id="agreement_'+project_id+'"]')[0].files[0];
			formData.append('file_agreement_edit',agreement_pdf);//append 1 file at the 0th index of the file.		
			formData.append('file_agreement_edit_msg','attached');
		}else {
			formData.append('file_agreement_edit_msg','removed');
		}		
			
		formData.append('project_start_edit', project_start);
		formData.append('project_end_edit', project_end);
		formData.append('client_contact_edit', client_contact);
		formData.append('client_email_edit', client_email);
		formData.append('username', username);
		formData.append('project_manager_edit', project_manager);
		formData.append('project_id_edit', project_id);
		formData.append('project_info_edit', project_info);

			if (check1 === 1 && check2 === 1) {
				$(".edit_view").prop("disabled", true);
				$(".button_delete").prop("disabled", true);
				$(".edit_view").html("<span class='glyphicon glyphicon-refresh glyphicon-refresh-animate'></span> Processing...");	
				$(".close_js").prop("disabled", true);	
				$('#remove_proposal_'+project_id).removeClass('pdf_remove');
				$('#remove_approval_'+project_id).removeClass('pdf_remove');
				$('#remove_agreement_'+project_id).removeClass('pdf_remove');
				toastr.remove();
				
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
							url: "./services/projects.php",
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
								  title: 'Project Info Updated!',
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
							$("#project_contactname_"+project_id).removeClass("accounting-css-success").removeClass("accounting-css-error");	
							$("#project_email_"+project_id).removeClass("accounting-css-success").removeClass("accounting-css-error");								
							$("#date_from_"+project_id).removeClass("accounting-css-success").removeClass("accounting-css-error");								
							$("#date_to_"+project_id).removeClass("accounting-css-success").removeClass("accounting-css-error");	
							$('#remove_proposal_'+project_id).addClass('pdf_remove');
							$('#remove_approval_'+project_id).addClass('pdf_remove');
							$('#remove_agreement_'+project_id).addClass('pdf_remove');							
						}					
					});						

			}			
		}			
		
	});	
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
/////////////////////////////CLOSE JS PROJECTS/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////	
	$('.close_js').click(function(){
	var project_id = $(this).attr('id').split('_');
	var info = 'close_id='+project_id[1];
	$(".view_pdf_"+project_id[1]).show();
	$(".edit_pdf_"+project_id[1]).hide();	

		$.ajax({
			type: "POST",
			url: "./services/projects.php",
			data: info,
			cache: false,			
			beforeSend: function(){},
			success: function(data){
				var project_json_return = $.parseJSON(data);//php to jquery json for payee info.
				project_json_return = project_json_return[0];
				
				var client_name = project_json_return.client_contact;
				var client_email = project_json_return.client_email;
				var project_manager = project_json_return.project_manager;
				var project_start = project_json_return.project_start;
				var project_end = project_json_return.project_end;
				var project_info = project_json_return.info;	
				$('#project_contactname_'+project_id[1]).val(client_name);
				$('#project_email_'+project_id[1]).val(client_email);
				$('#date_from_'+project_id[1]).val(project_start);
				$('#date_to_'+project_id[1]).val(project_end);
				$('#project_info_'+project_id[1]).val(project_info);
				$('#project_manager_'+project_id[1]).select2("val", project_manager);
			}
		});	
		var pdf_info_id = 'pdf_info_id='+project_id[1];
		$.ajax({
			type: "POST",
			url: "./services/projects.php",
			data: pdf_info_id,
			cache: false,			
			beforeSend: function(){},
			success: function(data2){
				var pdf_return = $.parseJSON(data2);
				var length = Object.keys(pdf_return).length;
				if (length > 0 && pdf_return[0] != undefined) {
					$('#agreement_'+project_id[1]+':hidden').val('');
					$('#proposal_'+project_id[1]+':hidden').val('');
					$('#approval_'+project_id[1]+':hidden').val('');
					$('.text_agreement_'+project_id[1]).html('Select PDF Document');
					$('.text_proposal_'+project_id[1]).html('Select PDF Document');
					$('.text_approval_'+project_id[1]).html('Select PDF Document');

					$('.agreement_icon_'+project_id[1]).html('<i class="fa fa-file-pdf-o text-danger"></i>');
					$('.approval_icon_'+project_id[1]).html('<i class="fa fa-file-pdf-o text-danger"></i>');
					$('.proposal_icon_'+project_id[1]).html('<i class="fa fa-file-pdf-o text-danger"></i>');

					$('#agreement_x').hide();
					$('#approval_x').hide();
					$('#proposal_x').hide();

					$('#confirm_proposal_'+project_id[1]).val('removed');
					$('#confirm_agreement_'+project_id[1]).val('removed');
					$('#confirm_approval_'+project_id[1]).val('removed');					
					for (i = 0; i< length; i++){
						switch(pdf_return[i].data.application) {
							case "approval":
								$('.text_'+pdf_return[i].data.application+'_'+pdf_return[i].data.project_id).html(pdf_return[i].data.real_file_name+ '<span><i class="fa fa-check-circle text-success"></i></span><span id="'+pdf_return[i].data.application+'_x"><a id="remove_'+pdf_return[i].data.application+'_'+pdf_return[i].data.project_id+'" href="#" class="pdf_remove"><span class="pdf_label">X</span></a></span>');
								$('.'+pdf_return[i].data.application+'_'+'icon_'+pdf_return[i].data.project_id).html('<i class="fa fa-file-pdf-o text-success"></i><p class="text-success">Attached</p>');
								$('#confirm_'+pdf_return[i].data.application+'_'+pdf_return[i].data.project_id).val('attached');
								break;
							case "proposal":
								$('.text_'+pdf_return[i].data.application+'_'+pdf_return[i].data.project_id).html(pdf_return[i].data.real_file_name+ '<span><i class="fa fa-check-circle text-success"></i></span><span id="'+pdf_return[i].data.application+'_x"><a id="remove_'+pdf_return[i].data.application+'_'+pdf_return[i].data.project_id+'" href="#" class="pdf_remove"><span class="pdf_label">X</span></a></span>');
								$('.'+pdf_return[i].data.application+'_'+'icon_'+pdf_return[i].data.project_id).html('<i class="fa fa-file-pdf-o text-success"></i><p class="text-success">Attached</p>');
								$('#confirm_'+pdf_return[i].data.application+'_'+pdf_return[i].data.project_id).val('attached');
								break;
							case "agreement":
								$('.text_'+pdf_return[i].data.application+'_'+pdf_return[i].data.project_id).html(pdf_return[i].data.real_file_name+ '<span><i class="fa fa-check-circle text-success"></i></span><span id="'+pdf_return[i].data.application+'_x"><a id="remove_'+pdf_return[i].data.application+'_'+pdf_return[i].data.project_id+'" href="#" class="pdf_remove"><span class="pdf_label">X</span></a></span>');
								$('.'+pdf_return[i].data.application+'_'+'icon_'+pdf_return[i].data.project_id).html('<i class="fa fa-file-pdf-o text-success"></i><p class="text-success">Attached</p>');
								$('#confirm_'+pdf_return[i].data.application+'_'+pdf_return[i].data.project_id).val('attached');
								break;								
						}
					}				
				}else {
					$('#agreement_'+project_id[1]+':hidden').val('');
					$('#proposal_'+project_id[1]+':hidden').val('');
					$('#approval_'+project_id[1]+':hidden').val('');
					$('.text_agreement_'+project_id[1]).html('Select PDF Document');
					$('.text_proposal_'+project_id[1]).html('Select PDF Document');
					$('.text_approval_'+project_id[1]).html('Select PDF Document');

					$('.agreement_icon_'+project_id[1]).html('<i class="fa fa-file-pdf-o text-danger"></i>');
					$('.approval_icon_'+project_id[1]).html('<i class="fa fa-file-pdf-o text-danger"></i>');
					$('.proposal_icon_'+project_id[1]).html('<i class="fa fa-file-pdf-o text-danger"></i>');

					$('#agreement_x').hide();
					$('#approval_x').hide();
					$('#proposal_x').hide();

					$('#confirm_proposal_'+project_id[1]).val('removed');
					$('#confirm_agreement_'+project_id[1]).val('removed');
					$('#confirm_approval_'+project_id[1]).val('removed');
				}	
			}
		});

		$('#project_contactname_'+project_id[1]).removeClass("accounting-css-success accounting-css-error");	
		$('#project_email_'+project_id[1]).removeClass("accounting-css-success accounting-css-error");	
		$('#date_from_'+project_id[1]).removeClass("accounting-css-success accounting-css-error");	
		$('#date_to_'+project_id[1]).removeClass("accounting-css-success accounting-css-error");	
				
		toastr.remove();
		
		$('#checkbox_'+project_id[1]).prop('checked', false);
		
		$('.readonly_'+project_id[1]).each(function(){
			$(this).attr('disabled', 'disabled');
		});
		
		$('#switch_'+project_id[1]).html("Viewing:");			
	});

	$('.button_delete').click(function(){
		var project_id = $(this).attr('id');
		var project_id_array = project_id.split('_');

		project_id = project_id_array[1];		
		
		var check_box = $('#checkbox_'+project_id).prop('checked');
		if (check_box == false){
			toastr.error('To Delete, Please Enter Edit Mode.','System Message:');
		}else {			
		$(".edit_view").prop("disabled", true);
		$(".button_delete").prop("disabled", true);
		$(".edit_view").html("<span class='glyphicon glyphicon-refresh glyphicon-refresh-animate'></span> Processing...");	
		$(".close_js").prop("disabled", true);		
		var project_id = $(this).attr('id').split('_');
		var info = 'delete_id='+project_id[1];
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
					url: "./services/projects.php",
					data: info,
					cache: false,			
					beforeSend: function(){},
					success: function(data){
						swal({
						  allowOutsideClick: false,
						  allowEscapeKey: false,
						  allowEnterKey: false,			
						  title: 'Project Deleted!',
						  html: 'Redirecting <i class="glyphicon glyphicon-repeat gly-spin"></i>',
						  type: 'success',
						  //timer: 2000,
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
});