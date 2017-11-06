$( document ).ready(function() {
    $('#resetShoppingList_main, #resetShoppingList_small').click(function() {
        //$("html, body").animate({ scrollTop: 0 }, "slow");//top of the page scroll after each refresh
        $(".wrapFilter").removeClass('active');
        swal({
        allowOutsideClick: false,
        allowEscapeKey: false,
        allowEnterKey: false,			
        title: 'Clear Current Shopping List?',
        html: 'You cannot undo this action!',
        type: 'info',
        showCancelButton: true, 
        confirmButtonText: 'Yes!',      
        confirmButtonColor: '#ffb606',
        cancelButtonColor: '#e87164',
        showLoaderOnConfirm: true,
        preConfirm: function () {
            
        }
        
        }).then(function () {
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

                    } else {
                        toastr.error('Something Failed O.O','System Message:');
                    }
                    $.LoadingOverlay("hide", true);	
                }
            });						
            
        }, function (dismiss){if(dismiss === 'cancel'){}});
    })
})