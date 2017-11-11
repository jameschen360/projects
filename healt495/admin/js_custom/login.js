	$(document).ready(function() 
		{

		$('#login_admin').click(function()
		{
		var username=$("#exampleInputEmail1").val();
		var password=$("#exampleInputPassword1").val();
		var dataString = 'username='+username+'&password='+password;
		if($.trim(username).length>0 && $.trim(password).length>0)
		{
		$.ajax({
		type: "POST",
		url: "./services/login.php",
		data: dataString,
		cache: false,
		beforeSend: function(){ $("#login_admin").val('Authenticating...');},
		success: function(data){
		if(data === "OKAY")
		{
			document.location.reload(true);
		}
		else
		{
		//Shake animation effect.

		$("#login_admin").val('Login')
		$("#login_msg").html("<span style='color:red'>Error:</span> Invalid username or password. ");
		}
		}
		});

		}
		return false;
		
		});

		});