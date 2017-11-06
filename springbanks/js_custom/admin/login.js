$(document).ready(function() {
    $('#agentLogin').click(function() {
        var loginEmail=$("#username").val();
        var loginPassword=$("#password").val();
        var formData = new FormData(); 
        formData.append('username', loginEmail);       
        formData.append('password', loginPassword);       

        if($.trim(loginEmail).length > 0 && $.trim(loginPassword).length > 0) {
            $.ajax({
                type: "POST",
                url: "/portal/services/admin/login.php",
                data: formData,
                contentType: false,
                processData: false,	
                cache: false,
                beforeSend: function(){
                    $("#agentLogin").prop('disabled', true); 
                    $("#agentLogin").html("<span class='glyphicon glyphicon-refresh glyphicon-refresh-animate'></span> Authenticating...");
                },
                success: function(data) {
                    if(data) {
                        var json_userLogin_return = $.parseJSON(data);
                        var user_id = json_userLogin_return.user_id;
                        var success = json_userLogin_return.success;
                        $("#loginErrorMsg").hide();
                        localStorage.clear();
                        localStorage.setItem('admin_id', user_id);
                        localStorage.setItem('success_admin', success);
                        document.location.reload(true);      
                    }
                    else {
                        $("#agentLogin").text("Sign in!");
                        $("#agentLogin").prop('disabled', false); 
                        $("#loginErrorMsg").html("<span style='color:red'>Error:</span> Invalid username or password.");
                    }
                }
            });
        }
        return false
    });
});