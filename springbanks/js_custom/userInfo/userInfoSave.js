$( document ).ready(function() {
    $( document ).on('click', '#userInfoSave', function(e){
        var addressSave = $('#address').val().toUpperCase();;
        var postalSave = $('#postal').val().toUpperCase();;
        var phoneSave = $('#phone').val();
        var userInfo = new FormData();
        userInfo.append('user_id', localStorage.user_id);
        userInfo.append('addressSave', addressSave);
        userInfo.append('postalSave', postalSave);
        userInfo.append('phoneSave', phoneSave);
        if (addressSave === "" || postalSave === "" || phoneSave === "") {
            toastr.error('Address, Postal Code and Phone cannot be empty.','System Message');
        } else {
            $('#right-sidebar').LoadingOverlay("show");
            $.ajax({
                type: "POST",
                url: "/portal/services/userInfo/userInfoSave.php",
                data: userInfo,
                contentType: false,
                processData: false,	
                cache: false,
                beforeSend: function(){},
                success: function(data) {
                    if (data === 'success') {
                        toastr.success('Your information was saved successfully!','System Message');
                    } else {
                        toastr.error('Something Went Wrong!','System Message');
                    }
                    $('#right-sidebar').LoadingOverlay("hide", true);
                }
            });
        }
    });
});