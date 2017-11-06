$(window).load(function() {
    var userInfo = new FormData();
    userInfo.append('user_id', localStorage.user_id);
    var url = '/portal/js_custom/functions/capitalizeWord.js';
    $.ajax({
        type: "POST",
        url: "/portal/services/userInfo/userInfoOnLoad.php",
        data: userInfo,
        contentType: false,
        processData: false,	
        cache: false,
        beforeSend: function(){},
        success: function(data) {
            $.getScript( url, function() {
                var jsonUserInfo = $.parseJSON(data);
                var firstName = capWords(jsonUserInfo.userInfo.fname);
                var lastName = capWords(jsonUserInfo.userInfo.lname);
                var email = jsonUserInfo.userInfo.email;
                var address = jsonUserInfo.userInfo.address;
                var postal = jsonUserInfo.userInfo.pcode;
                var phone = jsonUserInfo.userInfo.phone;
    
                $('.userInfoTitle').html(firstName+' '+lastName +' ('+email+')' );
                $('#address').val(address);
                $('#postal').val(postal);
                $('#phone').val(phone);

                $('.isFocus').each(function(){
                    if ($(this).val() !== "") {
                        $(this).addClass('active');
                    }    
                });	
            });
            
        }
    });
});