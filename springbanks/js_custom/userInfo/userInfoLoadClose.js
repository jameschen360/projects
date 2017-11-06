$( document ).ready(function() {
    $( document ).on('click', '.userInfoClose', function(e){
        var userInfo = new FormData();
        userInfo.append('user_id', localStorage.user_id);
        $.ajax({
            type: "POST",
            url: "/portal/services/userInfo/userInfoOnLoad.php",
            data: userInfo,
            contentType: false,
            processData: false,	
            cache: false,
            beforeSend: function(){},
            success: function(data) {
                var jsonUserInfo = $.parseJSON(data);
                var address = jsonUserInfo.userInfo.address;
                var postal = jsonUserInfo.userInfo.pcode;
                var phone = jsonUserInfo.userInfo.phone;
                $('#address').val(address);
                $('#postal').val(postal);
                $('#phone').val(phone);
                $('#passwordCurrent').val('').removeClass('active');
                $('#password1').val('').removeClass('active');
                $('#password2').val('').removeClass('active');

                if (address.length >= 1) {
                    $('#address').addClass('active');
                }

                if (postal.length >= 1) {
                    $('#postal').addClass('active');
                }

                if (phone.length >= 1) {
                    $('#phone').addClass('active');
                }


              
            }
        });
    });
});