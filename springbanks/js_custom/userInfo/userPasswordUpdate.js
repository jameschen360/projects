$( document ).ready(function() {
    $( document ).on('click', '#userPasswordSave', function(e){
        var currentPassword = $('#passwordCurrent').val();
        var password1 = $('#password1').val();
        var password2 = $('#password2').val();
        var passwordInfo = new FormData();
        passwordInfo.append('user_id', localStorage.user_id);
        passwordInfo.append('currentPassword', currentPassword);
        passwordInfo.append('password1', password1);
        passwordInfo.append('password2', password2);
        if (password1 !== "" || password2 !== "" || currentPassword !== "") {            
            $('#right-sidebar').LoadingOverlay("show");
            $.ajax({
                type: "POST",
                url: "/portal/services/userInfo/userPasswordUpdate.php",
                data: passwordInfo,
                contentType: false,
                processData: false,	
                cache: false,
                beforeSend: function(){},
                success: function(data) {
                    if (data === 'invalidCurrentPassword') {
                        toastr.error('This is not your current password!','System Message');
                        
                    } else if (data === 'notMatching') {
                        toastr.error('Your passwords do not match','System Message');
                    } else  if (data === 'tooShort') {
                        toastr.error('Your new password must be 9 characters or longer!','System Message');
                    } else {
                        toastr.success('Your password has been updated!','System Message');
                    }
                    $('#right-sidebar').LoadingOverlay("hide", true);
                }
            });
        } else {
            toastr.error('Please fill in the required password fields!','System Message');
        }

    });
});