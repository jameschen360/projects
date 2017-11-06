    <!-- Right sidebar -->
    <div id="right-sidebar" class="animated fadeInRight">

        <div class="p-m">
			<button id="sidebar-close" class="right-sidebar-toggle sidebar-button btn btn-default m-b-md"><i class="pe pe-7s-close"></i>
			</button>
		<?if ($auth == "admin" or $auth == "super"){?>
		<div style="text-align:center;">
			<span class="text-primary">
				<strong><h4>Notifications</h4></strong>
			</span>	
		</div>		
		<?
		$sidebar_query = mysqli_query($db, "SELECT * FROM notification WHERE supervisor_id='$user' AND supervisor_viewed='no'");
		$sidebar_num = mysqli_num_rows($sidebar_query);		
		if ($sidebar_num >= 1) {
			while($row = mysqli_fetch_assoc($sidebar_query)){
				$sidebar_userid = $row['user_id'];
				$sidebar_taskid = $row['task_id'];
				$sidebar_task = $row['task'];
				$sidebar_date = $row['date'];
				
				$user_query = mysqli_query($db, "SELECT * FROM user WHERE id='$sidebar_userid'");
				$user_result = mysqli_fetch_assoc($user_query);
				$user_fname = $user_result['fname'];
				$user_lname = $user_result['lname'];
				$user_fullname = "$user_fname $user_lname";						
		?>
			<div style="text-align:left; padding-left:10px;">	
				<tr>
					<td>
						<?
						switch ($sidebar_task) {
							case "expense":
								?>
								<span class="label label-info">Expense</span>											
								<?
								break;
							case "vacation":
								?>
								<span class="label label-success">Vacation</span>														
								<?
								break;
							case "overtime":
								?>
								<span class="label label-warning">Overtime</span>													
								<?
								break;
							case "timesheet":
								?>
								<span class="label label-primary">Timesheet</span>													
								<?
								break;													
						}
						?>
					</td>
					<td>
					<div class="pull-right" styl="padding-right:15px;">
						<?
						switch ($sidebar_task) {
							case "expense":
								?>
								<a href="expenseapproval#expense_claim_<?echo $sidebar_taskid?>"><button class="btn btn-danger btn-xs"> View</button></a>										
								<?
								break;
							case "vacation":
								?>
								<a href="vacationapproval#vacation_request_view_<?echo $sidebar_taskid?>"><button class="btn btn-danger btn-xs"> View</button></a>													
								<?
								break;
							case "overtime":
								?>
								<a href="overtimeapproval#overtime_request_view_<?echo $sidebar_taskid?>"><button class="btn btn-danger btn-xs"> View</button></a>													
								<?
								break;
							case "timesheet":
								?>
								<a href="timesheetapproval#timesheet_submission_<?echo $sidebar_taskid?>"><button class="btn btn-danger btn-xs"> View</button></a>												
								<?
								break;													
						}
						?>
					</div>	
					</td><br/>
					<tr class="issue-info">
						<small>
						<?
						switch ($sidebar_task) {
							case "expense":
								?>
								Expense Claim was submitted to you from <?echo $user_fullname?> on <?echo $sidebar_date?>. Click "View" to see details										
								<?
								break;
							case "vacation":
								?>
								Vacation Request was submitted to you from <?echo $user_fullname?> on <?echo $sidebar_date?>. Click "View" to see details													
								<?
								break;
							case "overtime":
								?>
								Overtime Request was submitted to you from <?echo $user_fullname?> on <?echo $sidebar_date?>. Click "View" to see details													
								<?
								break;
							case "timesheet":
								?>
								Timesheet was submitted to you from <?echo $user_fullname?> on <?echo $sidebar_date?>. Click "View" to see details													
								<?
								break;													
						}
						?>																							
						</small>
					</tr>
				</tr>
				<hr/>				
			</div>
		<?}		
		?>			
		<?}else {?>
			<div style="text-align:center; padding-left:10px;">
				
			</div>
		<?}	
		?>				
		<?}?>

		
		<?
		if ($auth == "regular") {?>
		<div style="text-align:center;">
			<span class="text-primary">
				<strong><h4>Notifications</h4></strong>
			</span>	
		</div>				
		<?}
		
		?>
		
		
		<?
		$sidebar_query = mysqli_query($db, "SELECT * FROM notification WHERE user_id='$user' AND supervisor_viewed='yes' AND final_status<>'complete'");
		$sidebar_num = mysqli_num_rows($sidebar_query);		
		if ($sidebar_num >= 1) {
			while($row = mysqli_fetch_assoc($sidebar_query)){
				$sidebar_userid = $row['user_id'];
				$sidebar_taskid = $row['task_id'];
				$sidebar_task = $row['task'];
				$sidebar_date = $row['date'];
				
				$user_query = mysqli_query($db, "SELECT * FROM user WHERE id='$sidebar_userid'");
				$user_result = mysqli_fetch_assoc($user_query);
				$user_fname = $user_result['fname'];
				$user_lname = $user_result['lname'];
				$user_fullname = "$user_fname $user_lname";						
		?>
			<div class="<?echo $sidebar_taskid?>_<?echo $sidebar_task?>" style="text-align:left; padding-left:10px;">	
				<tr>
					<td>
						<?
						switch ($sidebar_task) {
							case "expense":
								?>
								<span class="label label-info">Expense</span>											
								<?
								break;
							case "vacation":
								?>
								<span class="label label-success">Vacation</span>														
								<?
								break;
							case "overtime":
								?>
								<span class="label label-warning">Overtime</span>													
								<?
								break;
							case "timesheet":
								?>
								<span class="label label-primary">Timesheet</span>													
								<?
								break;													
						}
						?>
					</td>
					<td>
					<div class="pull-right" style="padding-right:15px;">
						<?
						switch ($sidebar_task) {
							case "expense":
								?>
								<a href="expenseclaim#expense_claim_<?echo $sidebar_taskid?>"><button class="btn btn-danger btn-xs view_button" id="<?echo $sidebar_taskid?>_expense"> View</button></a>										
								<?
								break;
							case "vacation":
								?> 
								<a href="myvacation#vacation_request_view_<?echo $sidebar_taskid?>"><button class="btn btn-danger btn-xs view_button" id="<?echo $sidebar_taskid?>_vacation"> View</button></a>													
								<?
								break;
							case "overtime":
								?>
								<a href="myovertime#overtime_request_view_<?echo $sidebar_taskid?>"><button class="btn btn-danger btn-xs view_button" id="<?echo $sidebar_taskid?>_overtime"> View</button></a>													
								<?
								break;
							case "timesheet":
								?>
								<button class="btn btn-danger btn-xs view_button" id="<?echo $sidebar_taskid?>_timesheet"> Dismiss</button>												
								<?
								break;													
						}
						?>
					</div>					
					</td><br/>
					<tr class="issue-info">
						<small>
						<?
						switch ($sidebar_task) {
							case "expense":
								?>
								Expense Claim status was changed on <?echo $sidebar_date?>. Click "View" to see details										
								<?
								break;
							case "vacation":
								?>
								Vacation Request status was changed on <?echo $sidebar_date?>. Click "View" to see details													
								<?
								break;
							case "overtime":
								?>
								Overtime Request status was changed on <?echo $sidebar_date?>. Click "View" to see details													
								<?
								break;
							case "timesheet":
								?>
								Timesheet was approved on <?echo $sidebar_date?>.												
								<?
								break;													
						}
						?>																							
						</small>
					</tr>
				</tr>
				<hr/>				
			</div>
		<?}
		}else {
			if ($auth == "regular") {?>
			<div style="text-align:center; padding-left:10px;">
				
			</div>
		<?}
		}		
		?>
		
        </div>
    </div>
	<script>
		$(function () {						
			$('.view_button').click(function(){
				var notification_indicator = $(this).attr('id');
				var task_array = notification_indicator.split('_');
				var task_id = task_array[0];
				var task = task_array[1];
				var info = 'task_id_update='+task_id+'&task_update='+task;
				$.ajax({
					type: "POST",
					url: "./services/notification.php",
					data: info,
					cache: false,				
					beforeSend: function(){},
					success: function(data){
						$('.'+task_id+'_'+task).hide();
						
						var notification_count = $('.notification_count').html();						
						notification_count = notification_count - 1;						
						if (notification_count == 0) {
							$('.notification_count').hide();
						}else {
							$('.notification_count').html(notification_count);
						}
						
					}
				});				
			});		
			
		});
	</script>	