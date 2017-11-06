$( document ).ready(function() {   
    $('#saveSubmitUser').click(function () {
        $('#saveSubmitUser').html('Saving...<span class="fa fa-spinner fa-spin"></span>').prop('disabled', true);
        if ($('#editAddress').val() !== "" && $('#editPostal').val() !== "" && $('#editPhone').val() !== "") {
            toastr.clear();
            var userInformation = new FormData();
            userInformation.append('user_id', localStorage.user_id);
            userInformation.append('address', $('#editAddress').val().toUpperCase());
            userInformation.append('postal', $('#editPostal').val().toUpperCase());
            userInformation.append('phone', $('#editPhone').val());

            $.ajax({
                type: "POST",
                url: "/portal/services/submitOrder/saveUserInfo.php",
                data: userInformation,
                contentType: false,
                processData: false,	
                cache: false,
                beforeSend: function(){},
                success: function(data) {
                    if (data === "proceed") {
                        $('#userInfo').fadeOut(450).hide();
                        $('#termsDiv').fadeIn(450).show();
                        $('#address').val($('#editAddress').val()).addClass('active');
                        $('#postal').val($('#editPostal').val()).addClass('active');
                        $('#phone').val($('#editPhone').val()).addClass('active');                 
                    } else {
                        $('#saveSubmitUser').html('Save & Continue').prop('disabled', false);
                        toastr.error('Please fill in all information.','System Message:');                        
                    }
                }
            });          


        } else {
            $('#saveSubmitUser').html('Save & Continue').prop('disabled', false);
            toastr.error('Please fill in all information.','System Message:');
        }

    });
});