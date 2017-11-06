$(window).load(function() {
    $('#hasCart, #emptyCart').hide();
    var shoppingCartInitialize = new FormData();
    shoppingCartInitialize.append('user_id', localStorage.user_id);
    $.ajax({
        type: "POST",
        url: "/portal/services/cart/shoppingCart.php",
        data: shoppingCartInitialize,
        contentType: false,
        processData: false,	
        cache: false,
        beforeSend: function(){},
        success: function(data) {
            if (data === "empty") {
                $('#emptyCart').show().html('Your Cart is Empty!');
            } else { 
                $('#hasCart').show();                                     
                jsonMyCartData = $.parseJSON(data);

                for (var i = 0; i < jsonMyCartData.myCartData.length; i++) {
                    if (jsonMyCartData.myCartData[i].isCustomUnit == "") {
                        var unit = 'Each';
                    } else {
                        var unit = jsonMyCartData.myCartData[i].isCustomUnit;
                    }

                    if (jsonMyCartData.myCartData[i].isCustom == "1") {
                        var productName = jsonMyCartData.product[i];
                    } else {
                        var productName = jsonMyCartData.product[i].product_name;
                    }

                    $('#shoppingCart').append('<tr id="cartID_'+jsonMyCartData.myCartData[i].id+'" class="cartItem"><td class="col-lg-4 col-sm-4 col-md-4 col-xs-4"><div class="media-body text-left"><h4 class="media-heading pull-left">'+productName+'</h4></div><div style="text-align: left;"><p class="media-heading">'+jsonMyCartData.myCartData[i].description+'</p></div></td><td class="col-sm-1 col-md-1" style="text-align: center"><input type="number" class="form-control editAmount" value="'+jsonMyCartData.myCartData[i].amount+'" pattern="\\d*"/></td><td class="col-lg-3 col-sm-3 col-md-3 col-xs-4" style="text-align: center"><select id="select_'+jsonMyCartData.myCartData[i].id+'" class="form-control unitSelected"></select></td><td class="col-sm-1 col-md-1"><button type="button" class="btn btn-danger cartRemove"><span class="glyphicon glyphicon-remove"></span></button></td></tr>');

                    for (var j=0; j < jsonMyCartData.units.length; j++) {
                        if (jsonMyCartData.units[j].unit == unit) {
                            $('#select_'+jsonMyCartData.myCartData[i].id).append('<option value="'+jsonMyCartData.units[j].unit+'" selected>'+jsonMyCartData.units[j].unit+'</option>');  
                        } else {
                            $('#select_'+jsonMyCartData.myCartData[i].id).append('<option value="'+jsonMyCartData.units[j].unit+'">'+jsonMyCartData.units[j].unit+'</option>');                       

                        }
                    }

                    $('#current_main').html('<span class="badge-notify">'+jsonMyCartData.totalCartNumber+'</span>');
                }

            }
        }
    });

});