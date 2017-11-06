$( document ).ready(function() {

    // -------------- Click on list function -------------- //
    $(document).on('click', '.previousOrderItem', function(e) {
        $('#previousOrderTable').LoadingOverlay("show"); 
        $('#archived_cart_list').html('');
        $('#addItem').html('');
        $('.previousOrderItem').prop('disabled', true);
        $('#purchase_date').html('');
        $('#purchase_total').html('');
        $('#deliveryInfo').html('');
        var options = { };
        var user_id=localStorage.user_id;
        var order_id = this.id.split('_')[1];
        var cart_info = new FormData(); 
        cart_info.append('user_id',user_id);
        cart_info.append('order_id',order_id);
        $.ajax({
            type: "POST",
            url: "/portal/services/previousOrderList.php",
            data: cart_info,
            contentType: false,
            processData: false,	
            cache: false,
            beforeSend: function(){},
            success: function(data) {

            var json_cart_list = $.parseJSON(data);

            for (i=0; i<json_cart_list.cart_table.length; i++) {
                var amount = json_cart_list.cart_table[i].amount;
                var cart_id = json_cart_list.cart_table[i].id;
                var status = json_cart_list.order_info_array.status;
                var product_name = json_cart_list.product_info[i];
                var product_unit = json_cart_list.product_unit[i];
                var product_description = json_cart_list.cart_table[i].description
                var can_edit = json_cart_list.can_edit;
                var isCustom = json_cart_list.cart_table[i].isCustom;
                var item_id = json_cart_list.cart_table[i].item_id;
                var isCustomUnit = json_cart_list.cart_table[i].isCustomUnit;
                var delivery_method = json_cart_list.order_info_array.delivery_method;
                var order_time = json_cart_list.order_info_array.order_time;
                var totalAmount = json_cart_list.order_info_array.totalAmount;
                var storeName = json_cart_list.order_info_array.store;
                
                if (isCustom == 1) {
                    product_name=item_id;
                }

                if (isCustomUnit == "") {
                    var unit = product_unit;
                } else {
                    var unit = isCustomUnit;
                }

                if (status =='Delivered') {
                    $('#archived_cart_list').append('<tr><th class="col-sm-6"><h4>'+product_name+'</h4><p>'+product_description+'</p></th><th class="col-sm-3"><h4>'+amount+'</h4></div></th><th class="col-sm-3"><h4>'+unit+'</h4></th></tr>');
                    $('#saveButton').html('');

                    $('#deliveryInfo').html('<th class="col-sm-8"><h4><strong>Purchase Time</strong></h4><p id="purchase_date"></p></th><th class="col-sm-4"><div style="padding:0px 20px 0px 0px"><h4><strong>Your total</strong></h4></div><div class="col-10"  style="padding:0px 20px 0px 0px"><p id="purchase_total"></p></div></th>');
                    $('#purchase_date').html('<p>'+order_time+'</p>');
                    $('#purchase_total').html('<p>$'+totalAmount+'</p>');
                    $('#purchaseStatus').html('<h4 class="col-sm-4" id="purchaseStatus" style="text-align:center;">Status: Delivered</h4>');
                    $('#deliveryType').html('<h4 class="col-sm-4" id="deliveryType" style="text-align:center;">Type: '+cFL(delivery_method)+'</h4>');
                    $('#storeName').html('<h4 class="col-sm-4" id="storeName" style="text-align:center;">Store: '+cFL(storeName)+'</h4>');
                    $('#saveButtonSpan').html('');

                } else if (status =='Processing') {

                    if (can_edit == 'yes'){
                    $('#archived_cart_list').append('<tr id="itemID_'+cart_id+'"><th class="col-sm-8"><h4>'+product_name+'</h4><p>'+product_description+'</p></th><th class="col-sm-2"><input type="number" id="cartId_'+cart_id+'" class="form-control edit_list_item editAmount_'+order_id+'" value="'+amount+'" pattern="\\d*"/><div></div><th class="col-sm-4">'+unit+'</th><th class="col-sm-2"><button type="button" class="btn btn-danger itemRemove itemRemove_'+order_id+'" id="itemRemove_'+cart_id+'"><span class="glyphicon glyphicon-remove"></span></button></div></th></tr>');

                    $('#addItem').html('<th class="col-sm-8"><h4><strong><input class="form-control" type="text" placeholder="Product Name" id="addProductName"></strong></h4><p><input class="form-control" type="text" placeholder="Product Description" id="addProductDescription"></p></th><th class="col-sm-4" style="padding-top:17px"><input type="number" id="addProductAmount" class="form-control" value="0"></th><th class="col-sm-2"></th><th class="col-sm-2"><button ="button" class="itemAdd_'+order_id+' btn btn-primary" id="addProductButton"><span class="glyphicon glyphicon-plus"></span></button></th>');

                    $('#deliveryInfo').html('<th class="col-sm-8 col-xs-10"><h4><strong>Purchase Time</strong></h4><p id="purchase_date"></p></th><th class="col-sm-2 col-xs-2"><div style="padding:0px 20px 0px 0px"><h4><strong></strong></h4></div><div style="padding:0px 20px 0px 0px"></div></th>');
                    $('#purchase_date').html('<p>'+order_time+'</p>');
                    $('#purchaseStatus').html('<h4 class="col-sm-4" id="purchaseStatus" style="text-align:center;">Status: Processing</h4>');
                    $('#deliveryType').html('<h4 class="col-sm-4" id="deliveryType" style="text-align:center;">Type: '+cFL(delivery_method)+'</h4>');
                    $('#storeName').html('<h4 class="col-sm-4" id="storeName" style="text-align:center;">Store: '+cFL(storeName)+'</h4>');
                    $('#saveButtonSpan').html('<button  type="button" id="saveButton" class="btn btn-primary btn-lg orderID_'+order_id+'">Save</button>');
                    //data-remodal-action="close"
                    } else {
                        $('#saveButtonSpan').html('');
                    }

                    if (can_edit == 'no'){
                    $('#archived_cart_list').append('<tr><th class="col-sm-6"><h4>'+product_name+'</h4><p>'+product_description+'</p></th><th class="col-sm-3"><h4>'+amount+'</h4></div></th><th class="col-sm-3"><h4>'+unit+'</h4></th></tr>');
                    $('#deliveryInfo').html('<th class="col-sm-8"><h4><strong>Purchase Time</strong></h4><p id="purchase_date"></p></th><th class="col-sm-2"><div style="padding:0px 20px 0px 0px"><h4><strong></strong></h4></div><div class="col-10"  style="padding:0px 20px 0px 0px"></div></th>');
                    $('#purchase_date').html('<p>'+order_time+'</p>');
                    $('#purchaseStatus').html('<h4 class="col-sm-4" id="purchaseStatus" style="text-align:center;">Status: Processing</h4>');
                    $('#deliveryType').html('<h4 class="col-sm-4" id="deliveryType" style="text-align:center;">Type: '+cFL(delivery_method)+'</h4>');
                    $('#storeName').html('<h4 class="col-sm-4" id="storeName" style="text-align:center;">Store: '+cFL(storeName)+'</h4>');
                    $('#saveButtonSpan').html('');
                    }

                }
                
                
                
            }

            $('#previousOrderTable').LoadingOverlay("hide", true);
            $('[data-remodal-id=previousOrder]').remodal(options).open();
            $('.previousOrderItem').prop('disabled', false);
            }
        });
    });

    // -------------- Change amount of items function -------------- //
    // $(document).on('change', '.edit_list_item', function(e) {
    //     var user_id = localStorage.user_id;
    //     var cart_id = this.id.split('_')[1];
    //     var order_id = this.className.split(' ')[2].split('_')[1];
    //     var amount = $(this).val();

    //     var item_info = new FormData();
    //     item_info.append('user_id',user_id);
    //     item_info.append('order_id',order_id);
    //     item_info.append('cart_id',cart_id);
    //     item_info.append('amount', amount);
    //     item_info.append('editType', 'edit');

    //     $.ajax({
    //         type: "POST",
    //         url: "/portal/services/previousOrderListChange.php",
    //         data: item_info,
    //         contentType: false,
    //         processData: false,	
    //         cache: false,
    //         beforeSend: function(){},
    //         success: function(data) {
    //             if (data === "error") {
    //                 toastr.error('Error.','System Message:');
    //             } else {
    //                 $('.editAmount').LoadingOverlay("hide", true);
    //                 toastr.success('Item amount updated!','System Message:');
    //             }

    //         }
    //     });
    // });

    // -------------- Delete item function -------------- //
    $(document).on('click', '#addProductButton', function(e) {

        var user_id = localStorage.user_id;
        var order_id = this.className.split(' ')[0].split('_')[1];
        var productName = $('#addProductName').val();
        var description = $('#addProductDescription').val();
        var amount = $('#addProductAmount').val();

        if ( productName != null && description != null && amount != null && amount > 0 ){
    
            var item_info = new FormData();
            item_info.append('user_id',user_id);
            item_info.append('order_id',order_id);
            item_info.append('productName', productName);
            item_info.append('description',description);
            item_info.append('amount',amount);
            item_info.append('editType', 'add');

                $.ajax({
                    type: "POST",
                    url: "/portal/services/previousOrderListChange.php",
                    data: item_info,
                    contentType: false,
                    processData: false,	
                    cache: false,
                    beforeSend: function(){},
                    success: function(data) {
    
                        var json_cart_list = $.parseJSON(data);
    
                        cart_id = json_cart_list.new_id_query['MAX(id)'];
    
    
                        if (data === "error") {
                            toastr.error('Error.','System Message:');
                        } else {
                            $('.editAmount').LoadingOverlay("hide", true);
                            toastr.success('Item Added Into Cart!','System Message:');
    
                            $('#archived_cart_list').append('<tr id="itemID_'+cart_id+'"><th class="col-sm-8"><h4>'+productName+'</h4><p>'+description+'</p></th><th class="col-sm-2"><input type="number" id="cartId_'+cart_id+'" class="form-control edit_list_item editAmount_'+order_id+'" value="'+amount+'" pattern="\\d*"/><div></div><th class="col-sm-4">Each</th><th class="col-sm-2"><button type="button" class="btn btn-danger itemRemove itemRemove_'+order_id+'" id="itemRemove_'+cart_id+'"><span class="glyphicon glyphicon-remove"></span></button></div></th></tr>');
                        }
                    },
                    error: function(e){
                    }
                });
                $('#addProductAmount').val('0');
                $('#addProductName').val('');
                $('#addProductDescription').val('');
        } else {
            toastr.error('Please fill in all fields.','System Message:');
        }
    });

    // -------------- Add item function -------------- //
    $(document).on('click', '.itemRemove', function(e) {

        var user_id = localStorage.user_id;
        var cart_id = this.id.split('_')[1];
        var order_id = this.className.split(' ')[3].split('_')[1];

        var item_info = new FormData();
        item_info.append('user_id',user_id);
        item_info.append('order_id',order_id);
        item_info.append('cart_id',cart_id);
        item_info.append('editType', 'remove');

            $.ajax({
                type: "POST",
                url: "/portal/services/previousOrderListChange.php",
                data: item_info,
                contentType: false,
                processData: false,	
                cache: false,
                beforeSend: function(){},
                success: function(data) {

                    var json_cart_list = $.parseJSON(data);

                    if (json_cart_list.status != 'empty'){
                        $('.editAmount').LoadingOverlay("hide", true);
                        toastr.success('Item Removed from Cart!','System Message:');
                        $('#itemID_'+cart_id).fadeOut(400);
                    } else if (json_cart_list.status == 'empty') {
                        toastr.error('Cart cannot be Empty!','System Message:');
                    }

                    if (data === "error") {
                        toastr.error('Error.','System Message:');
                    }
                        
                    



                },
                error: function(e){

                }
            });

    });


    $(document).on('click', '#saveButton', function(e) {
        var i = 0;
        var listArray = [];
        var user_id = localStorage.user_id;
        var cartIDArray = [];
        var order_id = this.className.split(' ')[3].split('_')[1];
        

        $('.edit_list_item').each(function(){
        listArray[i]= this.value;
        cartIDArray[i] = this.id.split('_')[1];
        i++;
        });

        var item_info = new FormData();
        item_info.append('listArray',listArray);
        item_info.append('user_id',user_id);
        item_info.append('order_id',order_id);
        item_info.append('cartIDArray',cartIDArray);
        item_info.append('editType', 'save');

        $.ajax({
            type: "POST",
            url: "/portal/services/previousOrderListChange.php",
            data: item_info,
            contentType: false,
            processData: false,	
            cache: false,
            beforeSend: function(){},
            success: function(data) {
                var json_cart_list = $.parseJSON(data);
                if (data === "error") {
                    toastr.error('Error.','System Message:');
                } else {
                    $('.editAmount').LoadingOverlay("hide", true);
                    toastr.success('Cart updated!','System Message:');
                }

            }
        });

    });


    function cFL(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }


    // -------------- Loads up list -------------- //
    $(document).unbind('keydown.remodal');
    
    var user_id = localStorage.user_id;
    var previousOrder = new FormData(); 
    previousOrder.append('user_id', user_id);
    var cart_id_json;
    var cart_id_length;
    var data;

    $.ajax({
        type: "POST",
        url: "/portal/services/previousOrder.php",
        data: previousOrder,
        contentType: false,
        processData: false,	
        cache: false,
        beforeSend: function(){},
        success: function(data) {
                                        
        
        var json_cart_table = $.parseJSON(data);
        if (json_cart_table.cart_table.length != 0 ) {
            for (var i=0; i<=json_cart_table.cart_table.length-1; i++){

                var date = json_cart_table.date[i];
                
                $('#previousOrder').append('<tr class="previousOrderItem" style="cursor: pointer;" id="previousOrderItem_'+json_cart_table.cart_table[i].id+'"><a href="#"><td class="col-sm-4"><strong>'+cFL(json_cart_table.cart_table[i].store)+'</strong></td><td ="col-sm-5">'+date+'</td><td class="col-sm-3" style="text-align: right;">'+json_cart_table.cart_table[i].status+'</td></a></tr>');
            }
        }
        if (json_cart_table.cart_table.length == 0 ) {
            $('#previousOrderTable').html('<div style="text-align:center; padding-left:10px;">Nothing so far!</div>');

        }


        }
    });










});