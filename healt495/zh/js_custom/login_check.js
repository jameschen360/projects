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
		url: "./services/login_check.php",
		data: dataString,
		cache: false,
		beforeSend: function(){ $("#login").val('请稍候');},
		success: function(data){
		if(data)
		{
			document.location.reload(true);
		}
		else
		{
		//Shake animation effect.

		$("#login").val('登录')
		$("#error").html("<span style='color:red'>错误:</span> 您输入的密码或电子邮箱不正确 ");
		}
		}
		});

		}
		return false;
		
		});

		});