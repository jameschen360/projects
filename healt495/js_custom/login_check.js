	$(document).ready(function() 
		{

		$('#login').click(function()
		{
		var username=$("#username").val();
		var password=$("#password").val();
		var dataString = 'username='+username+'&password='+password;
		if($.trim(username).length>0 && $.trim(password).length>0)
		{
		$.ajax({
		type: "POST",
		url: "../services/login_check.php",
		data: dataString,
		cache: false,
		beforeSend: function(){ $("#login").val('Authenticating...');},
		success: function(data){
		if(data)
		{
			document.location.reload(true);
		}
		else
		{
		//Shake animation effect.

		$("#login").val('Login')
		$("#error").html("<span style='color:red'>Error:</span> Invalid username or password. ");
		}
		}
		});

		}
		return false;
		
		});

		});