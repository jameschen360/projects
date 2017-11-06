$(document).ready(function() 
		{
		$('#password-confirm').click(function()
		{

		var username=$("#username").val();
		var password1=$("#password1").val();
		var password2=$("#password2").val();
		var password=$("#password").val();
		var dataString = 'password1='+password1+'&password2='+password2+'&username='+username+'&password='+password;
		
		if($.trim(password1).length>0 && $.trim(password2).length>0)
		{
		$.ajax({
		type: "POST",
		url: "./services/update_password_initial.php",
		data: dataString,
		cache: false,
		beforeSend: function(){ 
			$("button#password-confirm").html("<span class='glyphicon glyphicon-refresh glyphicon-refresh-animate'></span> Updating...");
		},
		success: function(data){
		if(data)
		{	
			if (data === "short") {
				$("#password-confirm").text("Update Password");
				$("#error_pass").html("<span style='color:red'>Error:</span> Password needs to be longer than 9 characters.");				
			}else if (data === "contain") {
				$("#password-confirm").text("Update Password");
				$("#error_pass").html("<span style='color:red'>Error:</span> Password must contain a number and a character.");					
			}else {
				document.location.reload(true);				
			}
		}
		else
		{
		$("#password-confirm").text("Update Password");
		$("#error_pass").html("<span style='color:red'>Error:</span> Please use matching passwords.");
		}
		}
		});

		}
		return false;
		
		});

});