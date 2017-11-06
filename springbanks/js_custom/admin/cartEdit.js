$( document ).ready(function() {
    ///////////remove button on cart
    $(document).on('click', '.cartRemove', function(e){
        toastr.clear();
        $(this).prop('disabled', true).html('<span class="fa fa-spinner fa-spin"></span>');
        var cartID = $(this).closest( "tr" ).attr('id').split('_')[1];
        var deleteCartForm = new FormData();
        deleteCartForm.append('admin_id', localStorage.admin_id);
        deleteCartForm.append('cartID', cartID);
        deleteCartForm.append('remove', 'remove');
        swal({
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: false,			
            title: 'Are you sure you want to delete this?',
            html: 'You cannot undo this action!',
            type: 'question',
            confirmButtonColor: '#ffb606',
            cancelButtonColor: '#e87164',
            confirmButtonText: 'Yes!',
            showCancelButton: true,
            showLoaderOnConfirm: true,
            preConfirm: function () {
                
            }
            }).then(function () {
                $.ajax({
                    type: "POST",
                    url: "/portal/services/admin/editCart.php",
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
                            if (data === "notAllowed") {
                                toastr.error('This is not allowed!', 'System Message');
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
                    }
                });
            }, function (dismiss){if(dismiss === 'cancel'){
                $('.cartRemove').prop('disabled', false).html('<span class="glyphicon glyphicon-remove"></span>');
            }});
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
            editAmountForm.append('admin_id', localStorage.admin_id);
            editAmountForm.append('cartID', cartID);
            editAmountForm.append('amount', amount);
            editAmountForm.append('edit', 'edit');
            $.ajax({
                type: "POST",
                url: "/portal/services/admin/editCart.php",
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
});