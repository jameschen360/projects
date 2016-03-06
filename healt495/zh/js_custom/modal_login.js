	$(document).ready(function() 
		{

		$('#login_modal').click(function()
		{
		var username=$("#username_modal").val();
		var password=$("#password_modal").val();
		var dataString = 'username='+username+'&password='+password;
		if($.trim(username).length>0 && $.trim(password).length>0)
		{
		$.ajax({
		type: "POST",
		url: "./services/modal_login.php",
		data: dataString,
		cache: false,
		beforeSend: function(){ $("#login_modal").val('请稍候');},
		success: function(data){
		if(data)
		{
			document.location.reload(true);
		}
		else
		{
		//Shake animation effect.

		$("#login_modal").val('Login')
		$("#error_modal").html("<span style='color:red'>错误:</span> 您输入的密码或电子邮箱不正确 ");
		}
		}
		});

		}
		return false;
		
		});

		});