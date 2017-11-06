var idleTime = 0;
$(document).ready(function () {
	//Increment the idle time counter every minute.
	var idleInterval = setInterval(timerIncrement, 60000); // 1 minute
	//Zero the idle timer on mouse movement.
	$(this).mousemove(function (e) {
		idleTime = 0;
	});
	$(this).keypress(function (e) {
		idleTime = 0;
	});
});

function timerIncrement() {
	idleTime = idleTime + 1;
	if (idleTime > 10) { // 10 minutes
		$.ajax({
			type: "POST",
			url: "./logout.php",
			cache: false,
			beforeSend: function(){},
			success: function(data){
			}
		});
		$('.swal2-modal').disableSelection();		
		swal({
		  allowOutsideClick: false,
		  allowEscapeKey: false,
		  allowEnterKey: false,
		  showCloseButton: false,
		  title: 'You were inactive for 10min!',
		  type: 'warning',
		  html:
			'So we decided to log you out.' +
			'<br/>If you wish to continue, please re-login. ',
		  showLoaderOnConfirm: true,
		  confirmButtonText:
			'<i class="fa fa-fa-lock"></i> Re-login'
		}).then(function () {
			document.location.reload(true);
		})	
	}
}
