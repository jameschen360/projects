$( document ).ready(function() {
    ////////WHEN PRODUCT MODAL IS CLOSING DO THE FOLLOWING STUFFS
    $(document).on('closing', '.product-modal-size', function (e) {
        $('.productCartButton').html('<div style="text-align-center;">Add to Cart</div><div class="col-lg-4 col-md-4 col-sm-6 col-xs-6" style="padding-top:15px;"></div>').prop('disabled', false);
        $('#productAmount, #productDescription').val('').blur();;
        toastr.clear();
    });
    ////////WHEN Other PRODUCT MODAL IS CLOSING DO THE FOLLOWING STUFFS
    $(document).on('closing', '.product-modal-size2', function (e) {
        $('.otherProductDetail').html('Add Your Own Item').prop('disabled', false);
        $('.smallLoading').html('<i class="fa fa-plus"></i>').prop('disabled', false);
        $('#otherName, #otherDescription, #otherAmount').val('').blur();;
        toastr.clear();
    });
    
    //////////////check for negatives
    $(document).on('change', '#productAmount, #otherAmount', function(e) {
        if ($(this).val() <= 0) {
            toastr.warning('Please enter a valid amount.','System Message:');
            
        }else {
            toastr.clear();
        }
    }); 
    /////////////////add to cart button for custom items Modal///////////////////
    $(document).on('click', '.otherProductDetail', function(e) {
        $(this).html('Processing...<span class="fa fa-spinner fa-spin"></span>').prop('disabled', true);
        $('.smallLoading').html('<span class="fa fa-spinner fa-spin"></span>').prop('disabled', true);       
        var options = { };
        $('[data-remodal-id=otherProductDetail]').remodal(options).open(); 
    });
    $(document).on('click', '.smallLoading', function(e) {
        $('.otherProductDetail').html('Processing...<span class="fa fa-spinner fa-spin"></span>').prop('disabled', true);
        $(this).html('<span class="fa fa-spinner fa-spin"></span>').prop('disabled', true);

        
        var options = { };
        $('[data-remodal-id=otherProductDetail]').remodal(options).open(); 
    });
    ///////////////////////////////////////////////////////////////////////////////


    ////////////////////////individual products///////////////////
    $(document).on('click', '.productCartButton', function(e) {
        toastr.clear();
        var productID = $(this).attr('id').split('_')[1];
        $(this).html('<div style="text-align-center;">Add to Cart <span class="fa fa-spinner fa-spin"></span></div><div class="col-lg-4 col-md-4 col-sm-6 col-xs-6" style="padding-top:15px;"></div>').prop('disabled', true);
        var options = { };            
        productData = new FormData();
        productData.append('product_id', productID);
        productData.append('user_id', localStorage.user_id);
        
        $.ajax({
            type: "POST",
            url: "/portal/services/productGet.php",
            data: productData,
            cache: false,
            contentType: false,
            processData: false,					
            beforeSend: function(){},
            success: function(data){
                if (data === "error") {
                    toastr.error('Error.','System Message:');
                    $('.productCartButton').html('<div style="text-align-center;">Add to Cart</div><div class="col-lg-4 col-md-4 col-sm-6 col-xs-6" style="padding-top:15px;"></div>');
                } else {
                    jsonProductInformtion = $.parseJSON(data);
                    $('#productName').html(jsonProductInformtion.productName);
                    $('.productAddCartConfirm').attr('id','productAdd_'+jsonProductInformtion.productID);
                    var productUnit = capWords(jsonProductInformtion.productUnit);
                    $('#productAmountLabel').html('Amount: '+jsonProductInformtion.productUnit);   

                    $('[data-remodal-id=productDetail]').remodal(options).open(); 
                }
            }
        });

    });

    ///////////////add to cart button for individual products/////////////
    $(document).on('click', '.productAddCartConfirm', function(e) {
        $('.productAddCartConfirm').html('Processing...<span class="fa fa-spinner fa-spin"></span>').prop('disabled', true);
        toastr.clear();
        var productID = $(this).attr('id').split('_')[1];
        if ($('#productAmount').val() > 0 && $('#productDescription').val().length >= 5) {
            var productAmount = $('#productAmount').val();
            var productDescription = $('#productDescription').val();
            var userID = new FormData();
            userID.append('user_id', localStorage.user_id);
            userID.append('product_id', productID);
            userID.append('product_amount', productAmount);
            userID.append('product_description', productDescription);
            $.ajax({
                type: "POST",
                url: "/portal/services/cart/addToCart.php",
                data: userID,
                cache: false,
                contentType: false,
                processData: false,					
                beforeSend: function(){},
                success: function(data){
                    if (data === "error") {
                        toastr.error('Error.','System Message:');
                        $('.productAddCartConfirm').html('Confirm').prop('disabled', false);
                    } else {
                        var options = {}
                        $('[data-remodal-id=productDetail]').remodal(options).close();
                        toastr.success('Added to cart!','System Message:');
                        $('.productAddCartConfirm').html('Confirm').prop('disabled', false);

                        $('#emptyCart').hide();
                        $('#hasCart').show();
                        jsonParse = $.parseJSON(data);

                        $('#shoppingCart').append('<tr id="cartID_'+jsonParse.cartID+'" class="cartItem"><td class="col-lg-4 col-sm-4 col-md-4 col-xs-4"><div class="media-body text-left"><h4 class="media-heading pull-left">'+jsonParse.productName.product_name+'</h4></div><div style="text-align: left;"><p class="media-heading">'+productDescription+'</p></div></td><td class="col-sm-1 col-md-1" style="text-align: center"><input type="number" class="form-control editAmount" value="'+productAmount+'" pattern="\\d*"/></td><td class="col-lg-3 col-sm-3 col-md-3 col-xs-4" style="text-align: center"><select id="select_'+jsonParse.cartID+'" class="form-control unitSelected"></select></td><td class="col-sm-1 col-md-1"><button type="button" class="btn btn-danger cartRemove"><span class="glyphicon glyphicon-remove"></span></button></td></tr>').fadeIn("slow");

                        for (var i=0; i < jsonParse.units.length; i++) {
                            if (jsonParse.units[i].unit == jsonParse.productName.unit) {
                                $('#select_'+jsonParse.cartID).append('<option value="'+jsonParse.units[i].unit+'" selected>'+jsonParse.units[i].unit+'</option>');
                            } else {
                                $('#select_'+jsonParse.cartID).append('<option value="'+jsonParse.units[i].unit+'">'+jsonParse.units[i].unit+'</option>');
                            }                    
                        }
                        
                        $('#current_main').html('<span class="badge-notify">'+jsonParse.totalCartNumber+'</span>');
                    }
                }
            });
        } else {
            toastr.warning('Please fill all the information correctly!','System Message:');
            $('.productAddCartConfirm').html('Confirm').prop('disabled', false);
        }

    });      
    
    ///////////////add to cart to DB for custom items after modal
    $(document).on('click', '#addToCartOther', function(e) {
        $('#addToCartOther').html('Processing...<span class="fa fa-spinner fa-spin"></span>').prop('disabled', true);
        if ($('#otherAmount').val() > 0 && $('#otherDescription').val().length >= 5 && $('#otherName').val().length >= 3) {

            var otherAmount = $('#otherAmount').val();
            var otherDescription = $('#otherDescription').val();
            $.getScript( '/portal/js_custom/functions/capitalizeWord.js', function() {});
            var otherName = capWords($('#otherName').val());

            var addToCartData = new FormData();
            addToCartData.append('otherAmount', otherAmount);
            addToCartData.append('otherName', otherName);
            addToCartData.append('otherDescription', otherDescription);
            addToCartData.append('user_id', localStorage.user_id);
            $.ajax({
                type: "POST",
                url: "/portal/services/cart/addToCart.php",
                data: addToCartData,
                cache: false,
                contentType: false,
                processData: false,					
                beforeSend: function(){},
                success: function(data){
                    if (data === "error") {
                        toastr.error('Error.','System Message:');
                        $('#addToCartOther').html('Confirm').prop('disabled', false);
                    } else {
                        var options = {}
                        $('[data-remodal-id=otherProductDetail]').remodal(options).close();
                        toastr.success('Added to cart!','System Message:');
                        $('#addToCartOther').html('Confirm').prop('disabled', false);
                        $('#emptyCart').hide();
                        $('#hasCart').show();
                        jsonParse = $.parseJSON(data);

                        $('#shoppingCart').append('<tr id="cartID_'+jsonParse.cartID+'" class="cartItem"><td class="col-lg-4 col-sm-4 col-md-4 col-xs-4"><div class="media-body"><h4 class="media-heading pull-left">'+otherName+'</h4></div><div style="text-align: left;"><p class="media-heading">'+otherDescription+'</p></div></td><td class="col-sm-1 col-md-1" style="text-align: center"><input type="number" class="form-control editAmount" value="'+otherAmount+'" pattern="\\d*"/></td><td class="col-lg-3 col-sm-3 col-md-3 col-xs-4" style="text-align: center"><select id="select_'+jsonParse.cartID+'" class="form-control unitSelected"></select></td><td class="col-sm-1 col-md-1"><button type="button" class="btn btn-danger cartRemove"><span class="glyphicon glyphicon-remove"></span></button></td></tr>').fadeIn("slow");

                        for (var i=0; i < jsonParse.units.length; i++) {
                            if (jsonParse.units[i].unit == 'Each') {
                                $('#select_'+jsonParse.cartID).append('<option value="'+jsonParse.units[i].unit+'" selected>'+jsonParse.units[i].unit+'</option>');
                            } else {
                                $('#select_'+jsonParse.cartID).append('<option value="'+jsonParse.units[i].unit+'">'+jsonParse.units[i].unit+'</option>');
                            }                    
                        }

                        $('#current_main').html('<span class="badge-notify">'+jsonParse.totalCartNumber+'</span>');
                    }
                }
            });
        } else {
            toastr.warning('Please fill all the information correctly!','System Message:');
            $('#addToCartOther').html('Confirm').prop('disabled', false);
        }
    });
});    