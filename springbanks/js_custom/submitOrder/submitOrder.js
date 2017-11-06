$( document ).ready(function() {
    /////need to work on submit order button at the very end!
    $('#submitOrderFinal').click(function () {
        $.LoadingOverlay("show");
        orderSubmit = new FormData();
        orderSubmit.append('user_id', localStorage.user_id);
        $.ajax({
            type: "POST",
            url: "/portal/services/submitOrder/submitOrder.php",
            data: orderSubmit,
            contentType: false,
            processData: false,	
            cache: false,
            beforeSend: function(){},
            success: function(data) {  
                if (data === "error") {
                    toastr.error('Error.','System Message:');
                    $.LoadingOverlay("hide", true);
                } else {
                    $.ajax({
                        type: "POST",
                        url: "/portal/services/shoppingListClear.php",
                        data: orderSubmit,
                        cache: false,
                        contentType: false,
                        processData: false,					
                        beforeSend: function(){},
                        success: function(data){
                            if (data !== "error") {
                                localStorage.setItem('deliveryMethod', null);
                                localStorage.setItem('isCategoryModal', null);
                                localStorage.setItem('isDeliveryModal', null);
                                localStorage.setItem('mainCategory', null);
                                localStorage.setItem('store', null);
                                $('#contentloader').html(' ');
                                $('#initializationFinal').prop('disabled', false);
                                $('#initializationFinal').html('Create Shopping List!');

                                $('.cartItem').each(function(){
                                    $(this).remove();
                                    $('#hasCart, #emptyCart').hide();
                                    $('#emptyCart').show().html('Your Cart is Empty!');
                                    $('#current_main').html('');
                                });
                                $.LoadingOverlay("hide", true);	
                                $('#orderConfirm').fadeOut(450).hide();
                                $('#orderSuccess').fadeIn(450).show();
                            } else {
                                toastr.error('Something Failed O.O','System Message:');
                            }
                            $.LoadingOverlay("hide", true);	
                        }
                    }); 
                                       
                }
            }
        }); 
    });

    $('#buttonRefresh').click(function () {
        $(".wrapFilter").removeClass('active');
        $.LoadingOverlay("show");
        var formData = new FormData(); 
        formData.append('user_id', localStorage.user_id);					
        $.ajax({
            type: "POST",
            url: "/portal/services/shoppingListClear.php",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,					
            beforeSend: function(){},
            success: function(data){
                if (data !== "error") {
                    localStorage.setItem('deliveryMethod', null);
                    localStorage.setItem('isCategoryModal', null);
                    localStorage.setItem('isDeliveryModal', null);
                    localStorage.setItem('mainCategory', null);
                    localStorage.setItem('store', null);
                    $('#contentloader').html(' ');
                    $('#initializationFinal').prop('disabled', false);
                    $('#initializationFinal').html('Create Shopping List!');
                    var options = { }
                    $('[data-remodal-id=deliverySelectModal]').remodal(options).open();

                    $('.cartItem').each(function(){
                        $(this).remove();
                        $('#hasCart, #emptyCart').hide();
                        $('#emptyCart').show().html('Your Cart is Empty!');
                        $('#current_main').html('');
                    });
                    $.ajax({
                        type: "POST",
                        url: "/portal/services/previousOrder.php",
                        data: formData,
                        contentType: false,
                        processData: false,	
                        cache: false,
                        beforeSend: function(){},
                        success: function(data) {
                            var json_cart_table = $.parseJSON(data);
                            $('#previousOrderTable tbody').empty();
                            if (json_cart_table.cart_table.length != 0 ) {
                                for (var i=0; i<=json_cart_table.cart_table.length-1; i++){
                                    $('#previousOrder').append('<tr class="previousOrderItem" style="cursor:pointer;" id="previousOrderItem_'+json_cart_table.cart_table[i].id+'"><a href="#"><td class="col-sm-4">'+cFL(json_cart_table.cart_table[i].store)+'</td><td ="col-sm-5">'+json_cart_table.cart_table[i].order_time+'</td><td class="col-sm-3" style="text-align: right;">'+json_cart_table.cart_table[i].status+'</td></a></tr>');
                                }
                            }
                            if (json_cart_table.cart_table.length == 0 ) {
                                $('#previousOrderTable').html('<div style="text-align:center; padding-left:10px;">Nothing so far!</div>');
                    
                            }
                            
                        }
                    });
                } else {
                    toastr.error('Something Failed O.O','System Message:');
                }
                $.LoadingOverlay("hide", true);	
            }
        });						
    });
    function cFL(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }
});