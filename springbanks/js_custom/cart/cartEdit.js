$( document ).ready(function() {
    ///////////remove button on cart
    $(document).on('click', '.cartRemove', function(e){
        toastr.clear();
        $(this).prop('disabled', true).html('<span class="fa fa-spinner fa-spin"></span>');
        var cartID = $(this).closest( "tr" ).attr('id').split('_')[1];
        var deleteCartForm = new FormData();
        deleteCartForm.append('user_id', localStorage.user_id);
        deleteCartForm.append('cartID', cartID);
        deleteCartForm.append('remove', 'remove');
        $.ajax({
            type: "POST",
            url: "/portal/services/cart/editCart.php",
            data: deleteCartForm,
            cache: false,
            contentType: false,
            processData: false,					
            beforeSend: function(){},
            success: function(data){
                if (data === "error") {
                    toastr.error('Error.','System Message:');
                    $('.cartRemove').prop('disabled', false).html('<span class="glyphicon glyphicon-remove"></span>');
                } else {
                    $('#cartID_'+cartID).fadeOut(400);
                    if (data < 1) {
                        $('#hasCart').hide();
                        $('#current_main').html('');
                        $('#emptyCart').show().html('Your Cart is Empty!');
                    } else {
                        $('.badge-notify').html(data);
                        
                    }
                }
            }
        });
    });

    //////////when amount changes per item
    $(document).on('change', '.editAmount', function(e){
        toastr.clear();

        var cartID = $(this).closest( "tr" ).attr('id').split('_')[1];
        var amount = $(this).val();

        if (amount <= 0 ) {
            toastr.error('Invalid amount.','System Message:');
        } else {
            $(this).LoadingOverlay("show");
            var editAmountForm = new FormData();
            editAmountForm.append('user_id', localStorage.user_id);
            editAmountForm.append('cartID', cartID);
            editAmountForm.append('amount', amount);
            editAmountForm.append('edit', 'edit');
            $.ajax({
                type: "POST",
                url: "/portal/services/cart/editCart.php",
                data: editAmountForm,
                cache: false,
                contentType: false,
                processData: false,					
                beforeSend: function(){},
                success: function(data){
                    if (data === "error") {
                        toastr.error('Error.','System Message:');
                    } else {
                        $('.editAmount').LoadingOverlay("hide", true);
                        toastr.success('Item amount updated!','System Message:');
                    }
                }
            });
        }

    }); 
    
    
    //////////when unit changes per item
    $(document).on('change', '.unitSelected', function(e){
        toastr.clear();
        var cartID = $(this).closest( "tr" ).attr('id').split('_')[1];
        var unit = $(this).val();

        $(this).LoadingOverlay("show");
        var editUnitForm = new FormData();
        editUnitForm.append('user_id', localStorage.user_id);
        editUnitForm.append('cartID', cartID);
        editUnitForm.append('unit', unit);
        editUnitForm.append('editUnit', 'editUnit');
        $.ajax({
            type: "POST",
            url: "/portal/services/cart/editCart.php",
            data: editUnitForm,
            cache: false,
            contentType: false,
            processData: false,					
            beforeSend: function(){},
            success: function(data){
                if (data === "error") {
                    toastr.error('Error.','System Message:');
                } else {
                    $('.unitSelected').LoadingOverlay("hide", true);
                    toastr.success('Unit updated!','System Message:');
                }
            }
        });
        

    });
});