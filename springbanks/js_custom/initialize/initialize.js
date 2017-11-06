$( document ).ready(function() {
    $(document).unbind('keydown.remodal');
    $('#filterSelect').val(localStorage.mainCategory);
    //initialize the name or user
    var usernameGet = new FormData(); 
    usernameGet.append('user_id', localStorage.user_id);
    var url = '/portal/js_custom/functions/capitalizeWord.js';
    
    $.ajax({
        type: "POST",
        url: "/portal/services/nameGet.php",
        data: usernameGet,
        contentType: false,
        processData: false,	
        cache: false,
        beforeSend: function(){},
        success: function(data) {
            $.getScript( url, function() {
                var firstName = capWords(data);
                $('#usernameGreet').html('Hi, '+firstName)
            });
        }
    });

    $(window).load(function() {

        var initialModalStatus = new FormData(); 
        initialModalStatus.append('user_id', localStorage.user_id);  
        $.ajax({
            type: "POST",
            url: "/portal/services/initialize/initialModalStatus.php",
            data: usernameGet,
            contentType: false,
            processData: false,	
            cache: false,
            beforeSend: function(){},
            success: function(data) {
                var jsonModalStatus = $.parseJSON(data);
                localStorage.setItem('isDeliveryModal', jsonModalStatus.isDeliveryModal);                
                localStorage.setItem('isCategoryModal', jsonModalStatus.isCategoryModal);             
            }
        });

        //THIS IS FOR when cart exists
        var existingCartCheck = new FormData(); 
        existingCartCheck.append('user_id', localStorage.user_id);
        $.ajax({
            type: "POST",
            url: "/portal/services/initialize/initialize.php",
            data: existingCartCheck,
            contentType: false,
            processData: false,	
            cache: false,
            beforeSend: function(){},
            success: function(data) {
                if (data != "new") {
                    //if it is json format, existing cart exists...
                    var jsonExistingOrder = $.parseJSON(data);
                    localStorage.setItem('deliveryMethod', jsonExistingOrder.deliveryMethod);
                    localStorage.setItem('store', jsonExistingOrder.store);
                    localStorage.setItem('mainCategory', jsonExistingOrder.mainCategory);

                    var contentLoadingForm = new FormData(); 
                    contentLoadingForm.append('user_id', localStorage.user_id);                                             
                    contentLoadingForm.append('mainCategory', localStorage.mainCategory);                                             
                    contentLoadingForm.append('existingCart', 'yes'); 
                    $.LoadingOverlay("show");                                            
                    $.ajax({
                        type: "POST",
                        url: "/portal/services/initialize/initialize.php",
                        data: contentLoadingForm,
                        contentType: false,
                        processData: false,	
                        cache: false,
                        beforeSend: function(){},
                        success: function(data) {                            
                            var jsonSubCategory = $.parseJSON(data);
                            var subCategoryLength = jsonSubCategory.subCategory.length;
                            var productLength = jsonSubCategory.contentInfo.length;

                            for (i = 0; i < subCategoryLength; i++) {
                                var newRowNameI_1 = jsonSubCategory.subCategory[i].replace(/\s+/g, '').substring(0, 3);
                                var newRowNameI_2 = jsonSubCategory.subCategory[i].replace(/\s+/g, '').substr(jsonSubCategory.subCategory[i].length - 3);
                                newRowNameI = newRowNameI_1+newRowNameI_2;

                                $("#contentloader").append('<div id="row_'+newRowNameI+'" class="row"></div>');
                                for (j = 0; j < productLength; j++) {
                                    if (jsonSubCategory.contentInfo[j].subcategory === jsonSubCategory.subCategory[i]) {
                                        var newRowNameJ_1 = jsonSubCategory.contentInfo[j].subcategory.replace(/\s+/g, '').substring(0, 3);
                                        var newRowNameJ_2 = jsonSubCategory.contentInfo[j].subcategory.replace(/\s+/g, '').substr(jsonSubCategory.contentInfo[j].subcategory.length - 3);
                                        newRowNameJ = newRowNameJ_1+newRowNameJ_2;

                                        if (j > 0) {
                                            if (jsonSubCategory.contentInfo[j-1].subcategory !== jsonSubCategory.contentInfo[j].subcategory) {
                                                $('#row_'+newRowNameJ).append('<h1 class="clearfix" style="padding-left: 15px;">'+ jsonSubCategory.subCategory[i] +'<span style="padding-left:10px;" class="pull-right"><div class="hidden-xs" style="padding-right: 15px;"><button id="category_'+newRowNameJ+'" class="btn btn-warning otherProductDetail">Add Your Own Item</button></div><div class="hidden-lg hidden-md hidden-sm" style="padding-right: 15px;"><button class="btn btn-warning otherProductDetail smallLoading category_'+newRowNameJ+'" data-remodal-target="otherProductDetail"><i class="fa fa-plus"></i></button></div></span></h1><hr>');
                                            }                                                
                                        } else {
                                            $('#row_'+newRowNameJ).append('<h1 class="clearfix" style="padding-left: 15px;">'+ jsonSubCategory.subCategory[i] +'<span style="padding-left:10px;" class="pull-right"><div class="hidden-xs" style="padding-right: 15px;"><button id="category_'+newRowNameJ+'" class="btn btn-warning otherProductDetail">Add Your Own Item</button></div><div class="hidden-lg hidden-md hidden-sm" style="padding-right: 15px;"><button class="btn btn-warning otherProductDetail smallLoading category_'+newRowNameJ+'" data-remodal-target="otherProductDetail"><i class="fa fa-plus"></i></button></div></span></h1><hr>');
                                        }

                                        $('#row_'+newRowNameJ).fadeIn( "slow" ).append('<div class="col-lg-3 col-md-4 col-sm-6"><div class="card card--big tour-2"><div class="card__image" style="background-image: url('+jsonSubCategory.contentInfo[j].image_path+')"></div><h2 class="card__title">'+jsonSubCategory.contentInfo[j].product_name+'</h2><p class="card__text">'+jsonSubCategory.contentInfo[j].description+'</p><div id="product_'+jsonSubCategory.contentInfo[j].id+'" class="card__action-bar productCartButton"><div style="text-align-center;">Add to Cart</div><div class="col-lg-4 col-md-4 col-sm-6 col-xs-6" style="padding-top:15px;"></div></div></div>');
                                    }else {
                                    }
                                }
                                
                            }
                            $.LoadingOverlay("hide", true);

                        }
                    });                       

                } else {
                    if (localStorage.isCategoryModal !== "yes" && localStorage.isDeliveryModal !== "yes") {
                        //when error caught assume new cart order
                        var options = { };
                        $('[data-remodal-id=deliverySelectModal]').remodal(options).open();
                    }

                }

            }
        });

        $( document ).on('click', '#initializationFinal', function(e){
            var selectedShop = $('#selectShop').val();
            var selectedCategory = $('#selectCategory').val();
            var deliveryOptionSelected = $('#deliveryOption').val();
            if (selectedShop != null && selectedCategory != null && deliveryOptionSelected != null) {
                $.LoadingOverlay("show");
                $("#initializationFinal").prop('disabled', true);
                $("#initializationFinal").html("<span class='glyphicon glyphicon-refresh glyphicon-refresh-animate'></span> Generating...");
                toastr.clear();
                var options = { };
                localStorage.setItem('store', selectedShop);
                localStorage.setItem('mainCategory', selectedCategory);
                localStorage.setItem('deliveryMethod', deliveryOptionSelected);
                $('[data-remodal-id=deliverySelectModal]').remodal(options).close();                 
                var newCartInfo = new FormData(); 
                newCartInfo.append('deliveryMethod', localStorage.deliveryMethod);
                newCartInfo.append('store', localStorage.store);
                newCartInfo.append('mainCategory', localStorage.mainCategory);
                newCartInfo.append('user_id', localStorage.user_id);
                
                $.ajax({
                    type: "POST",
                    url: "/portal/services/initialize/initialize.php",
                    data: newCartInfo,
                    contentType: false,
                    processData: false,	
                    cache: false,
                    beforeSend: function(){},
                    success: function(data) {
                        var contentLoadingForm = new FormData(); 
                        contentLoadingForm.append('user_id', localStorage.user_id);                                             
                        contentLoadingForm.append('mainCategory', localStorage.mainCategory);                                             
                        contentLoadingForm.append('newCart', 'yes');                                             
                        $.ajax({
                            type: "POST",
                            url: "/portal/services/initialize/initialize.php",
                            data: contentLoadingForm,
                            contentType: false,
                            processData: false,	
                            cache: false,
                            beforeSend: function(){},
                            success: function(data) {
                                if (data === "error") {
                                    toastr.error('Nope.','System Message:');
                                    $.LoadingOverlay("hide", true);
                                } else {
                                    var jsonSubCategory = $.parseJSON(data);
                                    var subCategoryLength = jsonSubCategory.subCategory.length;
                                    var productLength = jsonSubCategory.contentInfo.length;
    
                                    localStorage.setItem('isDeliveryModal', jsonSubCategory.isDeliveryModal);
                                    localStorage.setItem('isCategoryModal', jsonSubCategory.isCategoryModal);
    
                                    for (i = 0; i < subCategoryLength; i++) {
                                        var newRowNameI_1 = jsonSubCategory.subCategory[i].replace(/\s+/g, '').substring(0, 3);
                                        var newRowNameI_2 = jsonSubCategory.subCategory[i].replace(/\s+/g, '').substr(jsonSubCategory.subCategory[i].length - 3);
                                        newRowNameI = newRowNameI_1+newRowNameI_2;
        
                                        $("#contentloader").append('<div id="row_'+newRowNameI+'" class="row"></div>');
                                        for (j = 0; j < productLength; j++) {
                                            if (jsonSubCategory.contentInfo[j].subcategory === jsonSubCategory.subCategory[i]) {
                                                var newRowNameJ_1 = jsonSubCategory.contentInfo[j].subcategory.replace(/\s+/g, '').substring(0, 3);
                                                var newRowNameJ_2 = jsonSubCategory.contentInfo[j].subcategory.replace(/\s+/g, '').substr(jsonSubCategory.contentInfo[j].subcategory.length - 3);
                                                newRowNameJ = newRowNameJ_1+newRowNameJ_2;
        
                                                if (j > 0) {
                                                    if (jsonSubCategory.contentInfo[j-1].subcategory !== jsonSubCategory.contentInfo[j].subcategory) {
                                                        $('#row_'+newRowNameJ).append('<h1 class="clearfix" style="padding-left: 15px;">'+ jsonSubCategory.subCategory[i] +'<span style="padding-left:10px;" class="pull-right"><div class="hidden-xs" style="padding-right: 15px;"><button id="category_'+newRowNameJ+'" class="btn btn-warning otherProductDetail">Add Your Own Item</button></div><div class="hidden-lg hidden-md hidden-sm" style="padding-right: 15px;"><button class="btn btn-warning otherProductDetail smallLoading category_'+newRowNameJ+'" data-remodal-target="otherProductDetail"><i class="fa fa-plus"></i></button></div></span></h1><hr>');
                                                    }                                                
                                                } else {
                                                    $('#row_'+newRowNameJ).append('<h1 class="clearfix" style="padding-left: 15px;">'+ jsonSubCategory.subCategory[i] +'<span style="padding-left:10px;" class="pull-right"><div class="hidden-xs" style="padding-right: 15px;"><button id="category_'+newRowNameJ+'" class="btn btn-warning otherProductDetail">Add Your Own Item</button></div><div class="hidden-lg hidden-md hidden-sm" style="padding-right: 15px;"><button class="btn btn-warning otherProductDetail smallLoading category_'+newRowNameJ+'" data-remodal-target="otherProductDetail"><i class="fa fa-plus"></i></button></div></span></h1><hr>');
                                                }
        
                                                $('#row_'+newRowNameJ).fadeIn( "slow" ).append('<div class="col-lg-3 col-md-4 col-sm-6"><div class="card card--big tour-2"><div class="card__image" style="background-image: url('+jsonSubCategory.contentInfo[j].image_path+')"></div><h2 class="card__title">'+jsonSubCategory.contentInfo[j].product_name+'</h2><p class="card__text">'+jsonSubCategory.contentInfo[j].description+'</p><div id="product_'+jsonSubCategory.contentInfo[j].id+'" class="card__action-bar productCartButton"><div style="text-align-center;">Add to Cart</div><div class="col-lg-4 col-md-4 col-sm-6 col-xs-6" style="padding-top:15px;"></div></div></div>');
                                            }else {
                                            }
                                        }
                                        
                                    }
                                    $.LoadingOverlay("hide", true);
                                    $('#filterSelect').val(localStorage.mainCategory);
                                }                            

                            }
                        });

                    }
                });

            } else {
                toastr.error('Please select all fields!','System Message:');
            }
        });

    });

    $(document).on('click', '.closeMe', function(e){
        document.location.reload(true);
    });
});