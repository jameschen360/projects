$(document).ready(function() {
    $('.loginButton').click(function() {
        var loginEmail=$("#loginEmail").val();
        var loginPassword=$("#loginPassword").val();
        var formData = new FormData(); 
        formData.append('loginEmail', loginEmail);       
        formData.append('loginPassword', loginPassword);       

        if($.trim(loginEmail).length > 0 && $.trim(loginPassword).length > 0) {
            $.ajax({
                type: "POST",
                url: "/portal/services/loginSignup/login.php",
                data: formData,
                contentType: false,
                processData: false,	
                cache: false,
                beforeSend: function(){
                    $(".loginButton").prop('disabled', true); 
                    $(".loginButton").html("<span class='glyphicon glyphicon-refresh glyphicon-refresh-animate'></span> Authenticating...");
                },
                success: function(data) {
                    if(data) {
                        var json_userLogin_return = $.parseJSON(data);
                        var user_id = json_userLogin_return.user_id;
                        var success = json_userLogin_return.success;
                        $("#loginErrorMsg").hide();
                        localStorage.clear();
                        localStorage.setItem('user_id', user_id);
                        localStorage.setItem('success', success);
                        document.location.reload(true);      
                    }
                    else {
                        $(".loginButton").text("Sign in!");
                        $(".loginButton").prop('disabled', false); 
                        $("#loginErrorMsg").html("<span style='color:red'>Error:</span> Invalid username or password.");
                    }
                }
            });
        }
        return false
    });
});