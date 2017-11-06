$(document).ready(function() {
    $('.signupButton').click(function() {
        var signupFirstName=$("#signupFirstName").val();
        var signupLastName=$("#signupLastName").val();
        var signupEmail=$("#signupEmail").val();
        var signupPassword=$("#signupPassword").val();
        var passwordCheck=$("#signupPassword2").val();
        var formData = new FormData(); 
        formData.append('signupFirstName', signupFirstName);       
        formData.append('signupLastName', signupLastName);       
        formData.append('signupEmail', signupEmail);       
        formData.append('signupPassword', signupPassword);       
        formData.append('passwordCheck', passwordCheck);           
        $.ajax({
            type: "POST",
            url: "/portal/services/loginSignup/signup.php",
            data: formData,
            contentType: false,
            processData: false,	
            cache: false,
            beforeSend: function(){
                $(".signupButton").prop('disabled', true); 
                $(".signupButton").html("<span class='glyphicon glyphicon-refresh glyphicon-refresh-animate'></span> Signing Up...");
            },
            success: function(data) {
                try {
                    json_userSignup_return = $.parseJSON(data);
                    var json_userSignup_return = $.parseJSON(data);
                    $("#signupErrorMsg").hide();
                    var user_id = json_userSignup_return.user_id;
                    var success = json_userSignup_return.success;
                    localStorage.clear();
                    localStorage.setItem('user_id', user_id);
                    localStorage.setItem('success', success);
                    $(".signupButton").html("<span class='glyphicon glyphicon-check'></span> Authenticating...");
                    document.location.reload(true);                     
                }
                catch(err) {
                    $(".signupButton").text("Sign Up!");
                    $(".signupButton").prop('disabled', false);
                    $("#signupErrorMsg").html(data);
                }
            }
        });
    });
});