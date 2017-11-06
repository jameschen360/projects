$( document ).ready(function() {
    $('#acceptTerms').click(function () {
        $('#acceptTerms').html('Processing...<span class="fa fa-spinner fa-spin"></span>').prop('disabled', true);
        $('#orderConfirm, #orderSuccess').hide();
        var getCart = new FormData();
        getCart.append('user_id', localStorage.user_id);
        $.ajax({
            type: "POST",
            url: "/portal/services/submitOrder/reCart.php",
            data: getCart,
            contentType: false,
            processData: false,	
            cache: false,
            beforeSend: function(){},
            success: function(data) {
                $('#acceptTerms').html('Accept').prop('disabled', false);
                if (data === "error") {
                    toastr.error('Error.','System Message:');
                } else {
                    $('#orderConfirm').show();
                    var json_cart_table = $.parseJSON(data);
                    var deliveryType = json_cart_table.orderInfo.delivery_method;
                    var storeName = json_cart_table.orderInfo.store;

                    $('#deliveryTypeSubmit').html('<h4 class="col-sm-4" style="text-align:center;">Type: '+cFL(deliveryType)+'</h4>');
                    $('#storeNameSubmit').html('<h4 class="col-sm-4" style="text-align:center;">Store: '+cFL(storeName)+'</h4>');

                    $('#cartReview tbody').empty();
                    for (var i=0; i<json_cart_table.cartData.length; i++){
                        if (json_cart_table.cartData[i].isCustomUnit == "") {
                            var unit = json_cart_table.productUnit[i]
                        } else {
                            var unit = json_cart_table.cartData[i].isCustomUnit;
                        }


                        $('#cartReview').append('<tr><th class="col-sm-8"><h4>'+json_cart_table.product[i]+'</h4><p>'+json_cart_table.cartData[i].description+'</p></th><th class="col-sm-2"><div class="col-10" style="padding:10px 20px 0px 0px"><h4>'+json_cart_table.cartData[i].amount+'</h4></div></th><th class="col-sm-2"><div class="col-10" style="padding:10px 20px 0px 0px"><h4>'+unit+'</h4></div></th></tr>');
                                              
                    }
                    $('.reviewAddress').html(json_cart_table.userInfo.address+', '+json_cart_table.userInfo.pcode);

                    var options = { };
                    $('[data-remodal-id=submitOrderModal]').remodal(options).open();
                }

            }
        }); 
               
    });
    function cFL(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }

});