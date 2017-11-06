$(document).on('click', '.setStatus', function(e){
    var table = $('#processingTable').DataTable();
    $(this).html('Processing...<span class="fa fa-spinner fa-spin"></span>');
    var orderID = $(this).attr('id').split('_')[1];
    var totalFinal = $('.totalFinal').val();

    var markAsDelivered = new FormData();
    markAsDelivered.append('admin_id', localStorage.admin_id);
    markAsDelivered.append('totalFinal', totalFinal);
    markAsDelivered.append('orderID', orderID);
    
    if (totalFinal > 0) {
        swal({
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: false,			
            title: 'Are you sure you want to mark as DELIVERED?',
            html: 'You cannot undo this action!',
            type: 'question',
            showCancelButton: true,
            showLoaderOnConfirm: true,
            confirmButtonColor: '#ffb606',
            cancelButtonColor: '#e87164',
            confirmButtonText: 'Yes!'
            }).then(function () {
                $.LoadingOverlay("show");
                $.ajax({
                    type: "POST",
                    url: "/portal/services/admin/submitOrderChange.php",
                    data: markAsDelivered,
                    cache: false,
                    contentType: false,
                    processData: false,					
                    beforeSend: function(){},
                    success: function(data){
                        var jsonOrderData = $.parseJSON(data);

                        table
                        .row( $('#button_'+orderID).parents('tr') )
                        .remove()
                        .draw();
                        $('.setStatus').html('Mark as Delivered');
                        $('.totalFinal').val('');

                        var t = $('#deliveredTable').DataTable({
                            destroy: true
                        });
                        t.row.add( [
                            jsonOrderData.orderInfo.id,
                            jsonOrderData.orderInfo.order_time,
                            jsonOrderData.orderInfo.status,
                            '<button id="button_'+jsonOrderData.orderInfo.id+'" class="btn btn-primary openMeDelivered">View</button>'
                        ] ).draw( false );


                        var options = {}
                        $('[data-remodal-id=processingTableModal]').remodal(options).close();
                        $.LoadingOverlay("hide", true);
                    }
                });
            }, function (dismiss){if(dismiss === 'cancel'){
                $('.setStatus').html('Mark as Delivered');
            }});

    } else {
        toastr.error('You need to enter an total amount for this order.', 'System Message');
        $(this).html('Mark as Delivered');
    }
});