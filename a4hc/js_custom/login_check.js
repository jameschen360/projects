$(document).ready(function() 
		{
		$("#password-reset").hide();
		$('#login').click(function()
		{
		var username=$("#username").val();
		var password=$("#password").val();
		
		var path = $('#path').val();
		var hash = $('#hash').val();
		var id = $('#id').val();
		
		var dataString = 'username='+username+'&password='+password;
		if($.trim(username).length>0 && $.trim(password).length>0)
		{
		$.ajax({
		type: "POST",
		url: "./services/login_check.php",
		data: dataString,
		cache: false,
		beforeSend: function(){ 
			$("#login").text("Authenticating...");
			$("#login").html("<span class='glyphicon glyphicon-refresh glyphicon-refresh-animate'></span> Authenticating...");
		},
		success: function(data){
			
		if(data)
		{
			if (data === "yes") {
				$("#password-reset").fadeIn(850);
				$("#login-panel").hide();
			}else {
				
				if (path == "" || hash == "" || id == "") {
					document.location.reload(true);
				}else {
					window.location.assign('http://e-business.action4hc.ca/'+path+'#'+hash+id);
				}
				
				
				
			}
		}
		else
		{
		$("#login").text("Login");
		$("#error").html("<span style='color:red'>Error:</span> Invalid username or password.");
		}
		}
		});

		}
		return false;
		
		});

});