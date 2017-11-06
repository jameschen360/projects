$( document ).ready(function() {
    $(document).on('click', '.sel__box__options--black-panther3', function(e){
        $('.sel--black-panther2').LoadingOverlay("show");      
        var deliveryOption = $(this).html();

        deliveryOptionPost = new FormData();
        deliveryOptionPost.append('deliveryOption', deliveryOption);
        deliveryOptionPost.append('user_id', localStorage.user_id);
        $.ajax({
            type: "POST",
            url: "/portal/services/initialize/deliverySelect.php",
            data: deliveryOptionPost,
            cache: false,
            contentType: false,
            processData: false,					
            beforeSend: function(){},
            success: function(data){
                jsonDataShops = $.parseJSON(data);
                var length = jsonDataShops.shopOptions.length;
                $('.sel__box--black-panther2').empty();
                $('#selectShop').empty();
                $('#selectShop').html('<option value="default" disabled="" selected="">Select the Shop</option>');

                for (var i = 0; i < length; i++) {
                    $('.sel__box--black-panther2').append('<span class="sel__box__options sel__box__options--black-panther2">'+jsonDataShops.shopOptions[i].shop_name+'</span>');
                    $('#selectShop').append('<option value="'+jsonDataShops.shopOptions[i].shop_value+'">'+jsonDataShops.shopOptions[i].shop_name+'</option>');
                }
                $('.sel--black-panther2').LoadingOverlay("hide", true);

            }
        });
    });
});