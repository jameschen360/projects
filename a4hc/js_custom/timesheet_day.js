	
	$("#month").select2();	
	$("#year").select2();	
	$("#month_select_top").select2();	
	$("#year_select_top").select2();	
	$(window).load(function() {
	var options = { };
	$('[data-remodal-id=timesheet_select_modal]').remodal(options).open();
	});
	var d = new Date(),

		n = d.getMonth()+1,//selects month

		y = d.getFullYear();
		
	$(document).ready(function(){
		
		
		$('#timesheet_continue').click(function(){
			$('#autoParam').show();
			
			$('#pdf_submit_hide').hide();
			$('#pdf_submit_show').show();
			$('#supervisor_comments').show();
			$('.infoCommentPdf').text('Insert Comments/PDFs');
			$('#comments').prop( "disabled", false );
			$('#warningText').html('**This page will reset if timesheet is not submitted. (Saving the page does not keep comments and PDF.)');
			
			$('#comments').val('');
			$('#proposal:hidden').val('');
			$('.text_proposal').html('Select PDF Document');
			$('.proposal_icon').html('<i class="fa fa-file-pdf-o text-danger"></i>');		
			toastr.remove();

			var isRejectedCheck = new FormData();
			isRejectedCheck.append('rejectedCheck', 'check');
			isRejectedCheck.append('user_id', $('#hidden_username').val());
			$.ajax({
				type: "POST",
				url: "./services/timesheet.php",
				data: isRejectedCheck,
				cache: false,
				contentType: false,
				processData: false,				
				beforeSend: function(){},
				success: function(data){
					dataTrimmed = $.trim(data);
					if (dataTrimmed === "notRejected") {
						$('.supervisor_comments').show();
						$('.supervisor_comments').html('None.');

					} else {
						$('.supervisor_comments').show();
						$('.supervisor_comments').html(data);
					}
	
				}
			});
		});			
		
		/////////////////////////
		////////////////////////
		///////////////////////
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
		/////////////////////////////
		/////////////////////////////
		//////////////////////////////
		

		
		
		var user_id = $('#hidden_username').val();
		
		$('#timesheet_slot').hide();
		$('.pdf_export').hide();
		$('#month, #month_select_top').select2("val", n);	
		$('#year, #year_select_top').select2("val", y);	
		
		$('#timesheet_continue').click(function(){
			$( "#timesheet_continue" ).prop( "disabled", true );
			$("table#timesheet_table").find("tr:gt(0)").remove();	
			var user_id = $('#hidden_username').val();
			var month_submit = $('#month').val();
			var year_submit = $('#year').val();
			
			$('.save_button').attr("id",'save_'+user_id+'_'+month_submit+'_'+year_submit);
			$('.submit_button').attr("id",'submit_'+user_id+'_'+month_submit+'_'+year_submit);
			$('.action_button').hide();
			$('.action_button').show();
			$('.pdf_export').hide();			
			$('#month, #month_select_top').select2("val", month_submit);	
			$('#year, #year_select_top').select2("val", year_submit);				
			var info = 'user_id='+user_id+'&month='+month_submit+'&year='+year_submit;
			var month = monthtoword(month_submit);
			/////new button for comment/pdf for user//////
			/////								//////
			$('#commentTextTimesheet').html('Timesheet comments & PDF for '+month+', '+year_submit);
			
			$('.defaultHours').click(function(){
				
				var dateArray = [];
				var i = 0;
				
				$('.timesheet_date').each(function(){					
					dateArray[i] = dayCalNumber($(this).html().split("(")[1].split(")")[0]);
					i++;
				});
				
				var totalArrayLength = dateArray.length;
				
				var index = 1;
				totalHoursPaidOverAll = 0;
				for (var k = 0; k < totalArrayLength; k++) {
					var sickHoursTakenUpdate = $('.t_hr_sick_'+index).val();
					var vacationHoursUpdate = $('.t_hr_vacation_'+index).val();
					var statHoursUpdate = $('.t_hr_stat_'+index).val();
					var otHoursBankedUpdate = $('.ot_hr_banked_'+index).val();
					var otHoursTakenUpdate = $('.ot_hr_taken_'+index).val();

					if (sickHoursTakenUpdate == "") {
						sickHoursTakenUpdate = 0;
					}
					if (vacationHoursUpdate == "") {
						vacationHoursUpdate = 0;
					}
					if (statHoursUpdate == "") {
						statHoursUpdate = 0;
					}
					if (otHoursBankedUpdate == "") {
						otHoursBankedUpdate = 0;
					}
					if (otHoursTakenUpdate == "") {
						otHoursTakenUpdate = 0;
					}

					if (dateArray[k] === 0 || dateArray[k] === 6) {
						$('.t_hr_worked_'+index).val(0);	
						var hoursWorkedAutoFill = 0;
					}else {
						$('.t_hr_worked_'+index).val(7.5);
						var hoursWorkedAutoFill = 7.5;
					}
					tempRowTotal = parseFloat(hoursWorkedAutoFill)+parseFloat(sickHoursTakenUpdate)+parseFloat(vacationHoursUpdate)+parseFloat(statHoursUpdate)-parseFloat(otHoursBankedUpdate)+parseFloat(otHoursTakenUpdate);

					$('.total_paid_'+index).html(tempRowTotal);
					totalHoursPaidOverAll += parseFloat(hoursWorkedAutoFill)+parseFloat(sickHoursTakenUpdate)+parseFloat(vacationHoursUpdate)+parseFloat(statHoursUpdate)-parseFloat(otHoursBankedUpdate)+parseFloat(otHoursTakenUpdate);

					index += 1; 
					
				}
				$('#total_paid_hour').html(totalHoursPaidOverAll);
				
				input_total=0;
				$('.t_hr_worked').each(function(){
					if (this.value === null) {
						input_total += 0.00;
					}else {
						input_total += parseFloat(this.value);					
					}				
					$('#total_worked_hour').html(input_total);
					
				});				
			});

			
			$.ajax({
				type: "POST",
				url: "./services/timesheet.php",
				data: info,
				cache: false,			
				beforeSend: function(){},
				success: function(data){
				data = $.trim(data);
					if (data != 'exist') {
						var inst = $('[data-remodal-id=timesheet_select_modal]').remodal();						
						inst.close();
						$("#timesheet_continue").prop( "disabled", false );
						$('#timesheet_slot').fadeIn(1000);
						$('#timesheet_action_time, #timesheet_approve_time').hide();
						$('#timesheet_title').html('Timesheet for '+month+', '+year_submit+' - Status (New)');					
						for (i = 1; i <= data; i++) {
							if (i <= 9) {
								var i_days = '0'+i;
							}else {
								var i_days = i;
							}
							var DaysOfWeek = dayCalculator(year_submit, month_submit, i);
							$("#timesheet_table").append("<tr id=\"row_"+i+"\" class=\"time_table_hover\"><td style=\"text-align: left;\" class=\"timesheet_date \">" +month+'-'+i_days+' ('+DaysOfWeek+')'+ "</td><td><input class=\"onchange_input add_sum form-control t_hr_worked t_hr_worked_"+i+"\" type=\"number\" min=\"0\" onkeypress=\"return isNumberKey(event)\"/></td><td><input class=\"onchange_input add_sum form-control t_hr_sick t_hr_sick_"+i+"\" type=\"number\" min=\"0\" onkeypress=\"return isNumberKey(event)\"/></td><td><input class=\"onchange_input add_sum form-control t_hr_vacation t_hr_vacation_"+i+"\" type=\"number\" min=\"0\" onkeypress=\"return isNumberKey(event)\"/></td><td><input class=\"onchange_input add_sum form-control t_hr_stat t_hr_stat_"+i+"\" type=\"number\" min=\"0\" onkeypress=\"return isNumberKey(event)\"/></td><td><input class=\"onchange_input form-control ot_hr_banked ot_hr_banked_"+i+"\" type=\"number\" min=\"0\" onkeypress=\"return isNumberKey(event)\"/></td><td><input class=\"onchange_input add_sum form-control ot_hr_taken ot_hr_taken_"+i+"\" type=\"number\" min=\"0\" onkeypress=\"return isNumberKey(event)\"/></td><td class=\"total_paid total_paid_"+i+"\">0</td></tr>");	
						}
							$("#timesheet_table").append("<tr><td><strong>TOTAL:</strong></td><td id=\"total_worked_hour\">0</td><td id=\"total_sick_hour\">0</td><td id=\"total_vacation_hour\">0</td><td id=\"total_stat_hour\">0</td><td id=\"total_banked_hour\">0</td><td id=\"total_ot_hour\">0</td><td id=\"total_paid_hour\">0</td></tr>");
							$("#timesheet_table").append("<tr><td></td><td>Total Hours Worked</td><td>Total Sick Hours Taken</td><td>Total Vacation Hours</td><td>Total Satutory Hours</td><td>Total O/T Hours Banked</td><td>Total O/T Taken</td><td>Total Hours Paid</td></tr>");							
							
							$(document).on('change', '.form-control', function() {
								var row_num = $(this).closest('tr').attr('id').split('_');
								var current_row = row_num[1];
								day_paid_hour = 0;
								$('#row_'+current_row+' .add_sum').each(function(){
									if (this.value === "") {
										day_paid_hour += 0.00;
									}else {
										day_paid_hour += parseFloat(this.value);				
									}											
								});		
								banked_hour = $('.ot_hr_banked_'+current_row).val();
								day_paid_hour = day_paid_hour - banked_hour;
								$('.total_paid_'+current_row).html(day_paid_hour);
								
								total_hours_worked = 0;//total_hours
								$('.t_hr_worked').each(function(){
									if (this.value === "") {
										total_hours_worked += 0.00;
									}else {
										total_hours_worked += parseFloat(this.value);				
									}											
								});
								$('#total_worked_hour').html(total_hours_worked);
								
								total_sick_hours = 0; //total sick hours
								$('.t_hr_sick').each(function(){
									if (this.value === "") {
										total_sick_hours += 0.00;
									}else {
										total_sick_hours += parseFloat(this.value);				
									}											
								});
								$('#total_sick_hour').html(total_sick_hours);

								total_vacation_hour = 0; //total vacation hours
								$('.t_hr_vacation').each(function(){
									if (this.value === "") {
										total_vacation_hour += 0.00;
									}else {
										total_vacation_hour += parseFloat(this.value);				
									}											
								});
								$('#total_vacation_hour').html(total_vacation_hour);
								
								total_stat_hour = 0; //total stat hours
								$('.t_hr_stat').each(function(){
									if (this.value === "") {
										total_stat_hour += 0.00;
									}else {
										total_stat_hour += parseFloat(this.value);				
									}											
								});
								$('#total_stat_hour').html(total_stat_hour);
								
								total_banked_hour = 0; //total stat hours
								$('.ot_hr_banked').each(function(){
									if (this.value === "") {
										total_banked_hour += 0.00;
									}else {
										total_banked_hour += parseFloat(this.value);				
									}											
								});
								$('#total_banked_hour').html(total_banked_hour);

								total_ot_hour = 0; //total stat hours
								$('.ot_hr_taken').each(function(){
									if (this.value === "") {
										total_ot_hour += 0.00;
									}else {
										total_ot_hour += parseFloat(this.value);				
									}											
								});
								$('#total_ot_hour').html(total_ot_hour);

								$('#total_paid_hour').html(total_ot_hour-total_banked_hour+total_stat_hour+total_vacation_hour+total_sick_hours+total_hours_worked);
							});						
					}else{	
						var inst = $('[data-remodal-id=timesheet_select_modal]').remodal();						
						inst.close();
						$( "#timesheet_continue" ).prop( "disabled", false );
						info = 'user_id_ex='+user_id+'&month_ex='+month_submit+'&year_ex='+year_submit;
						
						$('#timesheet_slot').fadeIn(1000);
							$.ajax({
								type: "POST",
								url: "./services/timesheet.php",
								data: info,
								cache: false,			
								beforeSend: function(){},
								success: function(data){
									var timesheet_json_return = $.parseJSON(data);
									var check_status = timesheet_json_return[0].timesheet_status;
									var check_status_approval = timesheet_json_return[0].approval_status;
									var json_length = Object.keys(timesheet_json_return).length;
									
									var month = monthtoword(month_submit);
									$('#timesheet_title').html('Timesheet for '+month+', '+year_submit+' - Status ('+check_status+')');
									$('#timesheet_action_time, #timesheet_approve_time').hide();
									if (check_status != "Saved") {
										$('#timesheet_action_time').html('<strong>Submitted on: </strong>'+timesheet_json_return[0].submitted_date);
										$('#timesheet_action_time, #timesheet_approve_time').show();

										if (check_status_approval != "") {
											$('#timesheet_approve_time').html('<strong>'+check_status_approval+' on: </strong>'+timesheet_json_return[0].action_date);
										}else {
											$('#timesheet_approve_time').hide();
										}	
																				
									}														
									if (check_status == "Saved") {
										$('.action_button').hide();
										$('.action_button').show();
										for (i=1; i <= json_length; i++){
											var from_date = timesheet_json_return[i-1].from_date;
											var hours_worked = timesheet_json_return[i-1].hours_worked;
											var sick_hours = timesheet_json_return[i-1].sick_hours;
											var vacation_hours = timesheet_json_return[i-1].vacation_hours;
											var stat_hours = timesheet_json_return[i-1].stat_hours;
											var ot_hours_banked = timesheet_json_return[i-1].ot_hours_banked;
											var ot_hours_taken = timesheet_json_return[i-1].ot_hours_taken;
											
											if (hours_worked == "") {
												hours_worked = 0;
											}
											if (sick_hours == "") {
												sick_hours = 0;
											}											
											if (vacation_hours == "") {
												vacation_hours = 0;
											}
											if (stat_hours == "") {
												stat_hours = 0;
											}
											if (ot_hours_banked == "") {
												ot_hours_banked = 0;
											}
											if (ot_hours_taken == "") {
												ot_hours_taken = 0;
											}											
											
											$("#timesheet_table").append("<tr id=\"row_"+i+"\" class=\"time_table_hover\"><td class=\"timesheet_date\">" +from_date+ "</td><td><input class=\"onchange_input add_sum form-control t_hr_worked t_hr_worked_"+i+"\" type=\"number\" value=\""+hours_worked+"\" min=\"0\" onkeypress=\"return isNumberKey(event)\"/></td><td><input class=\"onchange_input add_sum form-control t_hr_sick t_hr_sick_"+i+"\" type=\"number\" value=\""+sick_hours+"\" min=\"0\" onkeypress=\"return isNumberKey(event)\"/></td><td><input class=\"onchange_input add_sum form-control t_hr_vacation t_hr_vacation_"+i+"\" type=\"number\" value=\""+vacation_hours+"\" min=\"0\" onkeypress=\"return isNumberKey(event)\"/></td><td><input class=\"onchange_input add_sum form-control t_hr_stat t_hr_stat_"+i+"\" type=\"number\" value=\""+stat_hours+"\" min=\"0\" onkeypress=\"return isNumberKey(event)\"/></td><td><input class=\"onchange_input form-control ot_hr_banked ot_hr_banked_"+i+"\" type=\"number\" value=\""+ot_hours_banked+"\" min=\"0\" onkeypress=\"return isNumberKey(event)\"/></td><td><input class=\"onchange_input add_sum form-control ot_hr_taken ot_hr_taken_"+i+"\" type=\"number\" value=\""+ot_hours_taken+"\" min=\"0\" onkeypress=\"return isNumberKey(event)\"/></td><td class=\"total_paid total_paid_"+i+"\">0</td></tr>");

											var paid_row = parseFloat(hours_worked)+parseFloat(sick_hours)+parseFloat(vacation_hours)+parseFloat(stat_hours)-parseFloat(ot_hours_banked)+parseFloat(ot_hours_taken);
											
											$('.total_paid_'+i).html(paid_row);											
										}
											$("#timesheet_table").append("<tr><td><strong>TOTAL:</strong></td><td id=\"total_worked_hour\">0</td><td id=\"total_sick_hour\">0</td><td id=\"total_vacation_hour\">0</td><td id=\"total_stat_hour\">0</td><td id=\"total_banked_hour\">0</td><td id=\"total_ot_hour\">0</td><td id=\"total_paid_hour\">0</td></tr>");
											$("#timesheet_table").append("<tr><td></td><td>Total Hours Worked</td><td>Total Sick Hours Taken</td><td>Total Vacation Hours</td><td>Total Satutory Hours</td><td>Total O/T Hours Banked</td><td>Total O/T Taken</td><td>Total Hours Paid</td></tr>");

											total_hours_worked = 0;//total_hours
											$('.t_hr_worked').each(function(){
												if (this.value === "") {
													total_hours_worked += 0.00;
												}else {
													total_hours_worked += parseFloat(this.value);				
												}											
											});
											$('#total_worked_hour').html(total_hours_worked);
											
											total_sick_hours = 0; //total sick hours
											$('.t_hr_sick').each(function(){
												if (this.value === "") {
													total_sick_hours += 0.00;
												}else {
													total_sick_hours += parseFloat(this.value);				
												}											
											});
											$('#total_sick_hour').html(total_sick_hours);

											total_vacation_hour = 0; //total vacation hours
											$('.t_hr_vacation').each(function(){
												if (this.value === "") {
													total_vacation_hour += 0.00;
												}else {
													total_vacation_hour += parseFloat(this.value);				
												}											
											});
											$('#total_vacation_hour').html(total_vacation_hour);
											
											total_stat_hour = 0; //total stat hours
											$('.t_hr_stat').each(function(){
												if (this.value === "") {
													total_stat_hour += 0.00;
												}else {
													total_stat_hour += parseFloat(this.value);				
												}											
											});
											$('#total_stat_hour').html(total_stat_hour);
											
											total_banked_hour = 0; //total stat hours
											$('.ot_hr_banked').each(function(){
												if (this.value === "") {
													total_banked_hour += 0.00;
												}else {
													total_banked_hour += parseFloat(this.value);				
												}											
											});
											$('#total_banked_hour').html(total_banked_hour);

											total_ot_hour = 0; //total stat hours
											$('.ot_hr_taken').each(function(){
												if (this.value === "") {
													total_ot_hour += 0.00;
												}else {
													total_ot_hour += parseFloat(this.value);				
												}											
											});
											$('#total_ot_hour').html(total_ot_hour);

											$('#total_paid_hour').html(total_ot_hour-total_banked_hour+total_stat_hour+total_vacation_hour+total_sick_hours+total_hours_worked);											
									}else {
										$('.action_button').hide();//remove all buttons for saving and submitting when submitted
										$('#autoParam').hide();
										$('.pdf_export').show();
										
										var info = 'user_id_submitted='+user_id+'&month='+month_submit+'&year='+year_submit;
										$.ajax({
											type: "POST",
											url: "./services/timesheet.php",
											data: info,
											cache: false,				
											beforeSend: function(){},
											success: function(data){
												$('.pdf_export').attr('id', 'pdf_'+data)								
											}
										});										
										for (i=1; i <= json_length; i++){
											var from_date = timesheet_json_return[i-1].from_date;
											var hours_worked = timesheet_json_return[i-1].hours_worked;
											var sick_hours = timesheet_json_return[i-1].sick_hours;
											var vacation_hours = timesheet_json_return[i-1].vacation_hours;
											var stat_hours = timesheet_json_return[i-1].stat_hours;
											var ot_hours_banked = timesheet_json_return[i-1].ot_hours_banked;
											var ot_hours_taken = timesheet_json_return[i-1].ot_hours_taken;
											
											if (hours_worked == "") {
												hours_worked = 0;
											}
											if (sick_hours == "") {
												sick_hours = 0;
											}											
											if (vacation_hours == "") {
												vacation_hours = 0;
											}
											if (stat_hours == "") {
												stat_hours = 0;
											}
											if (ot_hours_banked == "") {
												ot_hours_banked = 0;
											}
											if (ot_hours_taken == "") {
												ot_hours_taken = 0;
											}											
											
											$("#timesheet_table").append("<tr id=\"row_"+i+"\" class=\"time_table_hover\"><td class=\"timesheet_date\">" +from_date+ "</td><td><input class=\"onchange_input add_sum form-control t_hr_worked t_hr_worked_"+i+"\" type=\"number\" value=\""+hours_worked+"\" disabled readonly/></td><td><input class=\"onchange_input add_sum form-control t_hr_sick t_hr_sick_"+i+"\" type=\"number\" value=\""+sick_hours+"\" disabled readonly/></td><td><input class=\"onchange_input add_sum form-control t_hr_vacation t_hr_vacation_"+i+"\" type=\"number\" value=\""+vacation_hours+"\" disabled readonly/></td><td><input class=\"onchange_input add_sum form-control t_hr_stat t_hr_stat_"+i+"\" type=\"number\" value=\""+stat_hours+"\" disabled readonly/></td><td><input class=\"onchange_input form-control ot_hr_banked ot_hr_banked_"+i+"\" type=\"number\" value=\""+ot_hours_banked+"\" disabled readonly/></td><td><input class=\"onchange_input add_sum form-control ot_hr_taken ot_hr_taken_"+i+"\" type=\"number\" value=\""+ot_hours_taken+"\" disabled readonly/></td><td class=\"total_paid total_paid_"+i+"\">0</td></tr>");

											var paid_row = parseFloat(hours_worked)+parseFloat(sick_hours)+parseFloat(vacation_hours)+parseFloat(stat_hours)-parseFloat(ot_hours_banked)+parseFloat(ot_hours_taken);
											
											$('.total_paid_'+i).html(paid_row);											
										}
											$("#timesheet_table").append("<tr><td><strong>TOTAL:</strong></td><td id=\"total_worked_hour\">0</td><td id=\"total_sick_hour\">0</td><td id=\"total_vacation_hour\">0</td><td id=\"total_stat_hour\">0</td><td id=\"total_banked_hour\">0</td><td id=\"total_ot_hour\">0</td><td id=\"total_paid_hour\">0</td></tr>");
											$("#timesheet_table").append("<tr><td></td><td>Total Hours Worked</td><td>Total Sick Hours Taken</td><td>Total Vacation Hours</td><td>Total Satutory Hours</td><td>Total O/T Hours Banked</td><td>Total O/T Taken</td><td>Total Hours Paid</td></tr>");

											total_hours_worked = 0;//total_hours
											$('.t_hr_worked').each(function(){
												if (this.value === "") {
													total_hours_worked += 0.00;
												}else {
													total_hours_worked += parseFloat(this.value);				
												}											
											});
											$('#total_worked_hour').html(total_hours_worked);
											
											total_sick_hours = 0; //total sick hours
											$('.t_hr_sick').each(function(){
												if (this.value === "") {
													total_sick_hours += 0.00;
												}else {
													total_sick_hours += parseFloat(this.value);				
												}											
											});
											$('#total_sick_hour').html(total_sick_hours);

											total_vacation_hour = 0; //total vacation hours
											$('.t_hr_vacation').each(function(){
												if (this.value === "") {
													total_vacation_hour += 0.00;
												}else {
													total_vacation_hour += parseFloat(this.value);				
												}											
											});
											$('#total_vacation_hour').html(total_vacation_hour);
											
											total_stat_hour = 0; //total stat hours
											$('.t_hr_stat').each(function(){
												if (this.value === "") {
													total_stat_hour += 0.00;
												}else {
													total_stat_hour += parseFloat(this.value);				
												}											
											});
											$('#total_stat_hour').html(total_stat_hour);
											
											total_banked_hour = 0; //total stat hours
											$('.ot_hr_banked').each(function(){
												if (this.value === "") {
													total_banked_hour += 0.00;
												}else {
													total_banked_hour += parseFloat(this.value);				
												}											
											});
											$('#total_banked_hour').html(total_banked_hour);

											total_ot_hour = 0; //total stat hours
											$('.ot_hr_taken').each(function(){
												if (this.value === "") {
													total_ot_hour += 0.00;
												}else {
													total_ot_hour += parseFloat(this.value);				
												}											
											});
											$('#total_ot_hour').html(total_ot_hour);

											$('#total_paid_hour').html(total_ot_hour-total_banked_hour+total_stat_hour+total_vacation_hour+total_sick_hours+total_hours_worked);
											
											
											var info_pull = 'requested_userid_pull='+user_id+'&month_pull='+month_submit+'&year_pull='+year_submit;
											
											$('.infoCommentPdf').text('View Comments/PDFs');
											
											$.ajax({
												type: "POST",
												url: "./services/timesheet.php",
												data: info_pull,
												cache: false,				
												beforeSend: function(){},
												success: function(data){
													var timesheet_json_return = $.parseJSON(data);
													var user_comments = timesheet_json_return[0].user_comments;
													var super_comments = timesheet_json_return[0].super_comments;
													var pdf_path = timesheet_json_return[0].pdf_path;

													$('#comments').val(user_comments);
													$('#supercomments').val(super_comments);
													$('#comments').prop( "disabled", true );
													$('#warningText').html('');
													$('#pdf_submit_show').hide();
													$('#pdf_submit_hide').show();													
													$('#supervisor_comments').show();													
													if (pdf_path == "") {
														$('#SubmitPDF').html('<p>No PDF</p>');
													}else {																
														$('#SubmitPDF').html('<div class="hpanel"><a href="#" onClick="window.open(\'pdf_view/pdf_view.php?task=timesheet&path='+pdf_path+'\',\'pagename\',\'resizable,height=1000,width=1000\'); return false;"><div class="panel-body file-body"><i class="fa fa-file-pdf-o text-success"></i></div></a></div>');//here is yes
													}
												}
											});											
																				
									}
								}
							});						
							
							$(document).on('change', '.form-control', function() {
								var row_num = $(this).closest('tr').attr('id').split('_');
								var current_row = row_num[1];
								day_paid_hour = 0;
								$('#row_'+current_row+' .add_sum').each(function(){
									if (this.value === "") {
										day_paid_hour += 0.00;
									}else {
										day_paid_hour += parseFloat(this.value);				
									}											
								});		
								banked_hour = $('.ot_hr_banked_'+current_row).val();
								day_paid_hour = day_paid_hour - banked_hour;
								$('.total_paid_'+current_row).html(day_paid_hour);
								
								total_hours_worked = 0;//total_hours
								$('.t_hr_worked').each(function(){
									if (this.value === "") {
										total_hours_worked += 0.00;
									}else {
										total_hours_worked += parseFloat(this.value);				
									}											
								});
								$('#total_worked_hour').html(total_hours_worked);
								
								total_sick_hours = 0; //total sick hours
								$('.t_hr_sick').each(function(){
									if (this.value === "") {
										total_sick_hours += 0.00;
									}else {
										total_sick_hours += parseFloat(this.value);				
									}											
								});
								$('#total_sick_hour').html(total_sick_hours);

								total_vacation_hour = 0; //total vacation hours
								$('.t_hr_vacation').each(function(){
									if (this.value === "") {
										total_vacation_hour += 0.00;
									}else {
										total_vacation_hour += parseFloat(this.value);				
									}											
								});
								$('#total_vacation_hour').html(total_vacation_hour);
								
								total_stat_hour = 0; //total stat hours
								$('.t_hr_stat').each(function(){
									if (this.value === "") {
										total_stat_hour += 0.00;
									}else {
										total_stat_hour += parseFloat(this.value);				
									}											
								});
								$('#total_stat_hour').html(total_stat_hour);
								
								total_banked_hour = 0; //total stat hours
								$('.ot_hr_banked').each(function(){
									if (this.value === "") {
										total_banked_hour += 0.00;
									}else {
										total_banked_hour += parseFloat(this.value);				
									}											
								});
								$('#total_banked_hour').html(total_banked_hour);

								total_ot_hour = 0; //total stat hours
								$('.ot_hr_taken').each(function(){
									if (this.value === "") {
										total_ot_hour += 0.00;
									}else {
										total_ot_hour += parseFloat(this.value);				
									}											
								});
								$('#total_ot_hour').html(total_ot_hour);

								$('#total_paid_hour').html(total_ot_hour-total_banked_hour+total_stat_hour+total_vacation_hour+total_sick_hours+total_hours_worked);
							});						
						
						
					}

				}
			});
			
		});
		
		$('.action_button').click(function(){
			var hours_worked_array = [];
			var sick_hours_array = [];
			var vacation_hours_array = [];
			var stat_hours_array = [];
			var ot_banked_array = [];
			var ot_taken_array = [];
			var timesheet_date_array = [];
			var action = $(this).attr('id').split('_')[0];
			var action2 = "";
			var user_id = $(this).attr('id').split('_')[1];
			var month = $(this).attr('id').split('_')[2];
			var year = $(this).attr('id').split('_')[3];
			
			var i=0;
			$('.t_hr_worked').each(function(){
				if (this.value == undefined) {
					
				}else {
					hours_worked_array[i] = this.value;
					i++;					
				}

			});
			
			var i=0;
			$('.t_hr_sick').each(function(){
				if (this.value == undefined) {
					
				}else {
					sick_hours_array[i] = this.value;
					i++;					
				}

			});

			var i=0;
			$('.t_hr_vacation').each(function(){
				if (this.value == undefined) {
					
				}else {
					vacation_hours_array[i] = this.value;
					i++;					
				}

			});

			var i=0;
			$('.t_hr_stat').each(function(){
				if (this.value == undefined) {
					
				}else {
					stat_hours_array[i] = this.value;
					i++;					
				}

			});

			var i=0;
			$('.ot_hr_banked').each(function(){
				if (this.value == undefined) {
					
				}else {
					ot_banked_array[i] = this.value;
					i++;					
				}

			});	

			var i=0;
			$('.ot_hr_taken').each(function(){
				if (this.value == undefined) {
					
				}else {
					ot_taken_array[i] = this.value;
					i++;					
				}

			});	
			
			var i=0;
			$('.timesheet_date').each(function(){
				
				timesheet_date_array[i] = $(this).html();
				i++;				
			}); 

			var formData = new FormData(); 
			formData.append('hours_worked_array',hours_worked_array);
			formData.append('sick_hours_array',sick_hours_array);			
			formData.append('vacation_hours_array',vacation_hours_array);			
			formData.append('stat_hours_array',stat_hours_array);			
			formData.append('ot_banked_array',ot_banked_array);			
			formData.append('ot_taken_array',ot_taken_array);
			formData.append('timesheet_date_array',timesheet_date_array);
			formData.append('action',action);
			formData.append('save_user_id',user_id);
			formData.append('save_month',month);
			formData.append('save_year',year);
			formData.append('file', $('input[id="proposal"]')[0].files[0]);
						
			///user & pdf section///
			///
			if ($('#comments').val() != "") {
				formData.append('comments',$('#comments').val());
			}
			////
			
			
			if (action == "save") {
				action = "Save";
				action2 = "Saved";
				message = "";
				icon = "info";
			}
			
			if (action == "submit") {
				action = "Submit";
				action2 = "Submitted";
				message = "This action CANNOT be undone! ARE YOU SURE?";
				icon = "error";
			}			
			
			swal({
			  allowOutsideClick: false,
			  allowEscapeKey: false,
			  allowEnterKey: false,			
			  title: action+' Current Timesheet? ',
			  text: message,
			  type: icon,
			  showCancelButton: true,
			  showLoaderOnConfirm: true,
			  confirmButtonColor: '#62cb31',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Yes!',
			  cancelButtonText: 'No'
			}).then(function () {
				$.LoadingOverlay("show");		
				$.ajax({
					type: "POST",
					url: "./services/timesheet.php",
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
						  title: 'Timesheet Successfully '+action2+'!',
						  type: 'success',
						  //timer: 2000,
						  showLoaderOnConfirm: true,
						  confirmButtonColor: '#62cb31',
						  confirmButtonText: 'Okie!'
						}).then (function(){
							$("table#timesheet_table").find("tr:gt(0)").remove();
							var user_id = $('#hidden_username').val();
							var month_submit = $('#month').val();
							var year_submit = $('#year').val();							
							info = 'user_id_ex='+user_id+'&month_ex='+month_submit+'&year_ex='+year_submit;
							$.ajax({
								type: "POST",
								url: "./services/timesheet.php",
								data: info,
								cache: false,			
								beforeSend: function(){},
								success: function(data){
									var timesheet_json_return = $.parseJSON(data);
									var check_status = timesheet_json_return[0].timesheet_status;
									var check_status_approval = timesheet_json_return[0].approval_status;
									var json_length = Object.keys(timesheet_json_return).length;
									
									var month = monthtoword(month_submit);
									$('#timesheet_title').html('Timesheet for '+month+', '+year_submit+' - Status ('+check_status+')');
									$('#timesheet_action_time, #timesheet_approve_time').hide();
									if (check_status != "Saved") {
										$('#timesheet_action_time').html('<strong>Submitted on: </strong>'+timesheet_json_return[0].submitted_date);
										$('#timesheet_action_time, #timesheet_approve_time').show();

										if (check_status_approval != "") {
											$('#timesheet_approve_time').html('<strong>'+check_status_approval+' on: </strong>'+timesheet_json_return[0].action_date);
										}else {
											$('#timesheet_approve_time').hide();
										}	
																				
									}														
									if (check_status == "Saved") {
										$('.action_button').hide();
										$('.action_button').show();
										for (i=1; i <= json_length; i++){
											var from_date = timesheet_json_return[i-1].from_date;
											var hours_worked = timesheet_json_return[i-1].hours_worked;
											var sick_hours = timesheet_json_return[i-1].sick_hours;
											var vacation_hours = timesheet_json_return[i-1].vacation_hours;
											var stat_hours = timesheet_json_return[i-1].stat_hours;
											var ot_hours_banked = timesheet_json_return[i-1].ot_hours_banked;
											var ot_hours_taken = timesheet_json_return[i-1].ot_hours_taken;
											
											if (hours_worked == "") {
												hours_worked = 0;
											}
											if (sick_hours == "") {
												sick_hours = 0;
											}											
											if (vacation_hours == "") {
												vacation_hours = 0;
											}
											if (stat_hours == "") {
												stat_hours = 0;
											}
											if (ot_hours_banked == "") {
												ot_hours_banked = 0;
											}
											if (ot_hours_taken == "") {
												ot_hours_taken = 0;
											}											
											
											$("#timesheet_table").append("<tr id=\"row_"+i+"\" class=\"time_table_hover\"><td class=\"timesheet_date\">" +from_date+ "</td><td><input class=\"onchange_input add_sum form-control t_hr_worked t_hr_worked_"+i+"\" type=\"number\" value=\""+hours_worked+"\" min=\"0\" onkeypress=\"return isNumberKey(event)\"/></td><td><input class=\"onchange_input add_sum form-control t_hr_sick t_hr_sick_"+i+"\" type=\"number\" value=\""+sick_hours+"\" min=\"0\" onkeypress=\"return isNumberKey(event)\"/></td><td><input class=\"onchange_input add_sum form-control t_hr_vacation t_hr_vacation_"+i+"\" type=\"number\" value=\""+vacation_hours+"\" min=\"0\" onkeypress=\"return isNumberKey(event)\"/></td><td><input class=\"onchange_input add_sum form-control t_hr_stat t_hr_stat_"+i+"\" type=\"number\" value=\""+stat_hours+"\" min=\"0\" onkeypress=\"return isNumberKey(event)\"/></td><td><input class=\"onchange_input form-control ot_hr_banked ot_hr_banked_"+i+"\" type=\"number\" value=\""+ot_hours_banked+"\" min=\"0\" onkeypress=\"return isNumberKey(event)\"/></td><td><input class=\"onchange_input add_sum form-control ot_hr_taken ot_hr_taken_"+i+"\" type=\"number\" value=\""+ot_hours_taken+"\" min=\"0\" onkeypress=\"return isNumberKey(event)\"/></td><td class=\"total_paid total_paid_"+i+"\">0</td></tr>");

											var paid_row = parseFloat(hours_worked)+parseFloat(sick_hours)+parseFloat(vacation_hours)+parseFloat(stat_hours)-parseFloat(ot_hours_banked)+parseFloat(ot_hours_taken);
											
											$('.total_paid_'+i).html(paid_row);											
										}
											$("#timesheet_table").append("<tr><td><strong>TOTAL:</strong></td><td id=\"total_worked_hour\">0</td><td id=\"total_sick_hour\">0</td><td id=\"total_vacation_hour\">0</td><td id=\"total_stat_hour\">0</td><td id=\"total_banked_hour\">0</td><td id=\"total_ot_hour\">0</td><td id=\"total_paid_hour\">0</td></tr>");
											$("#timesheet_table").append("<tr><td></td><td>Total Hours Worked</td><td>Total Sick Hours Taken</td><td>Total Vacation Hours</td><td>Total Satutory Hours</td><td>Total O/T Hours Banked</td><td>Total O/T Taken</td><td>Total Hours Paid</td></tr>");

											total_hours_worked = 0;//total_hours
											$('.t_hr_worked').each(function(){
												if (this.value === "") {
													total_hours_worked += 0.00;
												}else {
													total_hours_worked += parseFloat(this.value);				
												}											
											});
											$('#total_worked_hour').html(total_hours_worked);
											
											total_sick_hours = 0; //total sick hours
											$('.t_hr_sick').each(function(){
												if (this.value === "") {
													total_sick_hours += 0.00;
												}else {
													total_sick_hours += parseFloat(this.value);				
												}											
											});
											$('#total_sick_hour').html(total_sick_hours);

											total_vacation_hour = 0; //total vacation hours
											$('.t_hr_vacation').each(function(){
												if (this.value === "") {
													total_vacation_hour += 0.00;
												}else {
													total_vacation_hour += parseFloat(this.value);				
												}											
											});
											$('#total_vacation_hour').html(total_vacation_hour);
											
											total_stat_hour = 0; //total stat hours
											$('.t_hr_stat').each(function(){
												if (this.value === "") {
													total_stat_hour += 0.00;
												}else {
													total_stat_hour += parseFloat(this.value);				
												}											
											});
											$('#total_stat_hour').html(total_stat_hour);
											
											total_banked_hour = 0; //total stat hours
											$('.ot_hr_banked').each(function(){
												if (this.value === "") {
													total_banked_hour += 0.00;
												}else {
													total_banked_hour += parseFloat(this.value);				
												}											
											});
											$('#total_banked_hour').html(total_banked_hour);

											total_ot_hour = 0; //total stat hours
											$('.ot_hr_taken').each(function(){
												if (this.value === "") {
													total_ot_hour += 0.00;
												}else {
													total_ot_hour += parseFloat(this.value);				
												}											
											});
											$('#total_ot_hour').html(total_ot_hour);

											$('#total_paid_hour').html(total_ot_hour-total_banked_hour+total_stat_hour+total_vacation_hour+total_sick_hours+total_hours_worked);											
									}else {
										$('.action_button').hide();//remove all buttons for saving and submitting when submitted
										$('#autoParam').hide();
										$('.pdf_export').show();
										
										var info = 'user_id_submitted='+user_id+'&month='+month_submit+'&year='+year_submit;
										$.ajax({
											type: "POST",
											url: "./services/timesheet.php",
											data: info,
											cache: false,				
											beforeSend: function(){},
											success: function(data){
												$('.pdf_export').attr('id', 'pdf_'+data)								
											}
										});										
										for (i=1; i <= json_length; i++){
											var from_date = timesheet_json_return[i-1].from_date;
											var hours_worked = timesheet_json_return[i-1].hours_worked;
											var sick_hours = timesheet_json_return[i-1].sick_hours;
											var vacation_hours = timesheet_json_return[i-1].vacation_hours;
											var stat_hours = timesheet_json_return[i-1].stat_hours;
											var ot_hours_banked = timesheet_json_return[i-1].ot_hours_banked;
											var ot_hours_taken = timesheet_json_return[i-1].ot_hours_taken;
											
											if (hours_worked == "") {
												hours_worked = 0;
											}
											if (sick_hours == "") {
												sick_hours = 0;
											}											
											if (vacation_hours == "") {
												vacation_hours = 0;
											}
											if (stat_hours == "") {
												stat_hours = 0;
											}
											if (ot_hours_banked == "") {
												ot_hours_banked = 0;
											}
											if (ot_hours_taken == "") {
												ot_hours_taken = 0;
											}											
											
											$("#timesheet_table").append("<tr id=\"row_"+i+"\" class=\"time_table_hover\"><td class=\"timesheet_date\">" +from_date+ "</td><td><input class=\"onchange_input add_sum form-control t_hr_worked t_hr_worked_"+i+"\" type=\"number\" value=\""+hours_worked+"\" disabled readonly/></td><td><input class=\"onchange_input add_sum form-control t_hr_sick t_hr_sick_"+i+"\" type=\"number\" value=\""+sick_hours+"\" disabled readonly/></td><td><input class=\"onchange_input add_sum form-control t_hr_vacation t_hr_vacation_"+i+"\" type=\"number\" value=\""+vacation_hours+"\" disabled readonly/></td><td><input class=\"onchange_input add_sum form-control t_hr_stat t_hr_stat_"+i+"\" type=\"number\" value=\""+stat_hours+"\" disabled readonly/></td><td><input class=\"onchange_input form-control ot_hr_banked ot_hr_banked_"+i+"\" type=\"number\" value=\""+ot_hours_banked+"\" disabled readonly/></td><td><input class=\"onchange_input add_sum form-control ot_hr_taken ot_hr_taken_"+i+"\" type=\"number\" value=\""+ot_hours_taken+"\" disabled readonly/></td><td class=\"total_paid total_paid_"+i+"\">0</td></tr>");

											var paid_row = parseFloat(hours_worked)+parseFloat(sick_hours)+parseFloat(vacation_hours)+parseFloat(stat_hours)-parseFloat(ot_hours_banked)+parseFloat(ot_hours_taken);
											
											$('.total_paid_'+i).html(paid_row);											
										}
											$("#timesheet_table").append("<tr><td><strong>TOTAL:</strong></td><td id=\"total_worked_hour\">0</td><td id=\"total_sick_hour\">0</td><td id=\"total_vacation_hour\">0</td><td id=\"total_stat_hour\">0</td><td id=\"total_banked_hour\">0</td><td id=\"total_ot_hour\">0</td><td id=\"total_paid_hour\">0</td></tr>");
											$("#timesheet_table").append("<tr><td></td><td>Total Hours Worked</td><td>Total Sick Hours Taken</td><td>Total Vacation Hours</td><td>Total Satutory Hours</td><td>Total O/T Hours Banked</td><td>Total O/T Taken</td><td>Total Hours Paid</td></tr>");

											total_hours_worked = 0;//total_hours
											$('.t_hr_worked').each(function(){
												if (this.value === "") {
													total_hours_worked += 0.00;
												}else {
													total_hours_worked += parseFloat(this.value);				
												}											
											});
											$('#total_worked_hour').html(total_hours_worked);
											
											total_sick_hours = 0; //total sick hours
											$('.t_hr_sick').each(function(){
												if (this.value === "") {
													total_sick_hours += 0.00;
												}else {
													total_sick_hours += parseFloat(this.value);				
												}											
											});
											$('#total_sick_hour').html(total_sick_hours);

											total_vacation_hour = 0; //total vacation hours
											$('.t_hr_vacation').each(function(){
												if (this.value === "") {
													total_vacation_hour += 0.00;
												}else {
													total_vacation_hour += parseFloat(this.value);				
												}											
											});
											$('#total_vacation_hour').html(total_vacation_hour);
											
											total_stat_hour = 0; //total stat hours
											$('.t_hr_stat').each(function(){
												if (this.value === "") {
													total_stat_hour += 0.00;
												}else {
													total_stat_hour += parseFloat(this.value);				
												}											
											});
											$('#total_stat_hour').html(total_stat_hour);
											
											total_banked_hour = 0; //total stat hours
											$('.ot_hr_banked').each(function(){
												if (this.value === "") {
													total_banked_hour += 0.00;
												}else {
													total_banked_hour += parseFloat(this.value);				
												}											
											});
											$('#total_banked_hour').html(total_banked_hour);

											total_ot_hour = 0; //total stat hours
											$('.ot_hr_taken').each(function(){
												if (this.value === "") {
													total_ot_hour += 0.00;
												}else {
													total_ot_hour += parseFloat(this.value);				
												}											
											});
											$('#total_ot_hour').html(total_ot_hour);

											$('#total_paid_hour').html(total_ot_hour-total_banked_hour+total_stat_hour+total_vacation_hour+total_sick_hours+total_hours_worked);
									
									
									
											var info_pull = 'requested_userid_pull='+user_id+'&month_pull='+month_submit+'&year_pull='+year_submit;
											
											$('.infoCommentPdf').text('View Comments/PDFs');
											
											$.ajax({
												type: "POST",
												url: "./services/timesheet.php",
												data: info_pull,
												cache: false,				
												beforeSend: function(){},
												success: function(data){
													var timesheet_json_return = $.parseJSON(data);
													var user_comments = timesheet_json_return[0].user_comments;
													var super_comments = timesheet_json_return[0].super_comments;
													var pdf_path = timesheet_json_return[0].pdf_path;

													$('#comments').val(user_comments);
													$('#supercomments').val(super_comments);
													$('#comments').prop( "disabled", true );
													$('#warningText').html('');
													$('#pdf_submit_show').hide();
													$('#pdf_submit_hide').show();													
													$('#supervisor_comments').show();													
													if (pdf_path == "") {
														$('#SubmitPDF').html('<p>No PDF</p>');
													}else {																
														$('#SubmitPDF').html('<div class="hpanel"><a href="#" onClick="window.open(\'pdf_view/pdf_view.php?task=timesheet&path='+pdf_path+'\',\'pagename\',\'resizable,height=1000,width=1000\'); return false;"><div class="panel-body file-body"><i class="fa fa-file-pdf-o text-success"></i></div></a></div>');//here is yes
													}
												}
											});									
									
									}
								}
							});
							}, function (dismiss){					
									if (dismiss === 'timer') {//cancel button hit
										document.location.reload(true);
									}					
							   });
					}
				});
			});
			
			
		});						
	});
	
	
	/////////////////
	function dayCalculator(year, month, day_loop){
		var day = "";
		var a = new Date(year, month-1, day_loop, 11, 33, 30, 0);		
		DayInMonth = a.getDay();				
		switch (DayInMonth) {
			case 0:
				day = "Sun";
				break;
			case 1:
				day = "Mon";
				break;
			case 2:
				day = "Tue";
				break;
			case 3:
				day = "Wed";
				break;
			case 4:
				day = "Thu";
				break;
			case 5:
				day = "Fri";
				break;
			case 6:
				day = "Sat";					
		}
		return day;	
	}

	function dayCalNumber(string){
		var day = "";				
		switch (string) {
			case "Sun":
				day = 0;
				break;
			case "Mon":
				day = 1;
				break;
			case "Tue":
				day = 2;
				break;
			case "Wed":
				day = 3;
				break;
			case "Thu":
				day = 4;
				break;
			case "Fri":
				day = 5;
				break;
			case "Sat":
				day = 6;
				break;			
		}
		return day;	
	}		