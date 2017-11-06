$(document).ready (function() {
    $(window).load(function() {
        var adminUser = new FormData();
        adminUser.append('admin_id', localStorage.admin_id);
        var t = $('#deliveredTable').DataTable({
        });
        
        $.ajax({
            type: "POST",
            url: "/portal/services/admin/tables/deliveredTable.php",
            data: adminUser,
            contentType: false,
            processData: false,	
            cache: false,
            beforeSend: function(){},
            success: function(data) {
                var jsonOrderData = $.parseJSON(data);
                for (var i = 0; i < jsonOrderData.orderData.length; i++) {
                    t.row.add( [
                        jsonOrderData.orderData[i].id,
                        jsonOrderData.orderData[i].order_time,
                        jsonOrderData.orderData[i].status,
                        '<button id="button_'+jsonOrderData.orderData[i].id+'" class="btn btn-primary openMeDelivered">View</button>'
                    ] ).draw( false );
                }
            }
        });
    });

    $( document ).on('click', '.openMeDelivered', function(e){
        $('#deliveredTable').LoadingOverlay("show");
        var orderID = $(this).attr('id').split('_')[1];
        orderIDSubmit = new FormData();
        orderIDSubmit.append('admin_id', localStorage.admin_id);
        orderIDSubmit.append('order_id', orderID);
        orderIDSubmit.append('delivered', 'delivered');
        $.ajax({
            type: "POST",
            url: "/portal/services/admin/cartDetails.php",
            data: orderIDSubmit,
            contentType: false,
            processData: false,	
            cache: false,
            beforeSend: function(){},
            success: function(data) {
                var jsonCartData = $.parseJSON(data);
                var userfullName = jsonCartData.userInfo.fname+' '+jsonCartData.userInfo.lname;
                var userEmail = jsonCartData.userInfo.email;
                var userAddress = jsonCartData.userInfo.address+',<br/>'+jsonCartData.userInfo.pcode;
                var userPhone = jsonCartData.userInfo.phone;
                var purchaseStatus = jsonCartData.orderInfo.status;
                var deliveryType = jsonCartData.orderInfo.delivery_method;
                var storeName = jsonCartData.orderInfo.store;
                var orderTime = jsonCartData.orderInfo.order_time;
                var totalAmount = jsonCartData.orderInfo.totalAmount;
                var deliveredTime = jsonCartData.orderInfo.deliveredTime;
                
                $('#userFullNameDelivered').html(userfullName);
                $('#userAddressDelivered').html(userEmail);
                $('#userEmailDelivered').html(userAddress);
                $('#userPhoneDelivered').html(userPhone);

                $('.totalFinal').html(totalAmount);
                $('.deliveredTime').html(deliveredTime);

                $('#orderTimeDelivered').html('<h4 class="col-sm-4" id="orderTime" style="text-align:center;">Order Time: '+orderTime+'</h4>');
                $('#deliveryTypeDelivered').html('<h4 class="col-sm-4" id="deliveryType" style="text-align:center;">Type: '+cFL(deliveryType)+'</h4>');
                $('#storeNameDelivered').html('<h4 class="col-sm-4" id="storeName" style="text-align:center;">Store: '+cFL(storeName)+'</h4>');
                $('#deliveredOrderTableDetail tbody').empty();

                for (var i = 0; i < jsonCartData.cartData.length; i++) {
                    if (jsonCartData.cartData[i].isCustomUnit == "") {
                        var unit = jsonCartData.product[i].unit;
                    } else {
                        var unit = jsonCartData.cartData[i].isCustomUnit;
                    }
                    if (jsonCartData.cartData[i].isCustom == "1") {
                        var productName = jsonCartData.product[i];
                    } else {
                        var productName = jsonCartData.product[i].product_name;
                    }
                    $('#deliveredOrderTableDetail tbody').append('<tr id="cartID_'+jsonCartData.cartData[i].id+'" class="cartItem"><td class="col-sm-8 col-md-6"><div class="media-body"><h4 class="media-heading pull-left">'+productName+'</h4></div><div style="text-align: left;"><p class="media-heading">'+jsonCartData.cartData[i].description+'</p></div></td><td class="col-sm-1 col-md-1" style="text-align: center"><span>'+jsonCartData.cartData[i].amount+'</span></td><td class="col-sm-1 col-md-1" style="text-align: left"><span>'+unit+'</span></td></tr>');
                }                

                var options = {}
                $('[data-remodal-id=deliveredTableModal]').remodal(options).open();
                $('#orderIDDelivered').html('You are Viewing Order ID: '+orderID);
                $('#deliveredTable').LoadingOverlay("hide", true);
                
            }
        });

    });
    function cFL(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }
});