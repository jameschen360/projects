$( document ).ready(function() {
    ////show either terms of agreement or allow use to add more information
    $('.buttonSubmitOrder,.btn-springbank').click(function () {
        toastr.clear();
        $('#termsDiv, #userInfo').hide();
        $('.buttonSubmitOrder').removeClass('fa-check').addClass('fa-spinner fa-spin');
        $('.btn-springbank').html('Processing...<span class="fa fa-spinner fa-spin"></span>').prop('disabled', true);
        checkInitialCart = new FormData();
        checkInitialCart.append('user_id', localStorage.user_id);
        $.ajax({
            type: "POST",
            url: "/portal/services/cart/initialSubmitOrderButton.php",
            data: checkInitialCart,
            contentType: false,
            processData: false,	
            cache: false,
            beforeSend: function(){},
            success: function(data) {
                if (data === "noItems") {
                    $('.buttonSubmitOrder').addClass('fa-check').removeClass('fa-spinner fa-spin');
                    $('.btn-springbank').html('Submit Order <span class="glyphicon glyphicon-check"></span>').prop('disabled', false);
                    toastr.error('Your cart is empty!','System Message:');
                } else if (data === "showTerms") {
                    $('#termsDiv').show();
                    $('.btn-springbank').html('Submit Order <span class="glyphicon glyphicon-check"></span>').prop('disabled', false);
                    $('.buttonSubmitOrder').addClass('fa-check').removeClass('fa-spinner fa-spin');
                    var options = { };
                    $('[data-remodal-id=terms]').remodal(options).open();
                } else {
                    $('#userInfo').show();
                    $('.btn-springbank').html('Submit Order <span class="glyphicon glyphicon-check"></span>').prop('disabled', false);
                    $('.buttonSubmitOrder').addClass('fa-check').removeClass('fa-spinner fa-spin');
                    jsonUserInfo = $.parseJSON(data);
                    existingAddress = jsonUserInfo.address;
                    existingPostal = jsonUserInfo.pcode;
                    existingPhone = jsonUserInfo.phone;
                    $('#editAddress').val(existingAddress).addClass('active');
                    $('#editPostal').val(existingPostal).addClass('active');
                    $('#editPhone').val(existingPhone).addClass('active');
                    var options = { };
                    $('[data-remodal-id=terms]').remodal(options).open();
                }
            }
        });       
    });
});