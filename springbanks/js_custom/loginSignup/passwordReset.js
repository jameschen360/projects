$(document).ready(function() {
    $('.passwordResetButton').click(function() {
        var passwordReset=$("#passwordReset").val();
        var formData = new FormData(); 
        formData.append('passwordReset', passwordReset);       

        $.ajax({
            type: "POST",
            url: "/portal/services/loginSignup/passwordReset.php",
            data: formData,
            contentType: false,
            processData: false,	
            cache: false,
            beforeSend: function(){
                $("#passwordResetErrorMsg").html("");
                $(".passwordResetButton").prop('disabled', true); 
                $(".passwordResetButton").html("<span class='glyphicon glyphicon-refresh glyphicon-refresh-animate'></span> Loading...");
            },
            success: function(data) {
                if(data) {
                    $(".passwordResetText").html('Password reset has been sent!'); 
                    $("#passwordForm").html('Please check your registered email inbox now. If you do not see the email, please also check your junk folder.');
                    $(".passwordResetButton").html("<span class='glyphicon glyphicon-check'></span> Done!");
                }
                else {
                    $(".passwordResetButton").text("Reset Password");
                    $(".passwordResetButton").prop('disabled', false); 
                    $("#passwordResetErrorMsg").html("<span style='color:red'>Error:</span> Something went wrong!");
                }
            }
        });
    });
});