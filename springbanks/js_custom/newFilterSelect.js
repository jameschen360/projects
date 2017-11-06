$( document ).ready(function() {  
    $(document).on('change', '#filterSelect', function(e){
        var selectedFilter =  $('#filterSelect').val();
        localStorage.setItem('mainCategory', selectedFilter);

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
                if (data === "error") {
                    toastr.error('Nope.','System Message:');
                    $.LoadingOverlay("hide", true);
                } else {
                    var jsonSubCategory = $.parseJSON(data);
                    var subCategoryLength = jsonSubCategory.subCategory.length;
                    var productLength = jsonSubCategory.contentInfo.length;
                    $("#contentloader").html('');
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
                                        $('#row_'+newRowNameJ).append('<h1 class="clearfix" style="padding-left: 15px;">'+ jsonSubCategory.subCategory[i] +'<span style="padding-left:10px;" class="pull-right"><div class="hidden-xs" style="padding-right: 15px;"><button id="category_'+newRowNameJ+'" class="btn btn-warning otherProductDetail">Add Your Own Item</button></div><div class="hidden-lg hidden-md hidden-sm" style="padding-right: 15px;"><button class="btn btn-warning otherProductDetail smallLoading category_'+newRowNameJ+'" data-remodal-target="otherProductDetail"><i class="fa fa-plus"></i></button></div></span></h1><hr>')
                                    }                                                
                                } else {
                                    $('#row_'+newRowNameJ).append('<h1 class="clearfix" style="padding-left: 15px;">'+ jsonSubCategory.subCategory[i] +'<span style="padding-left:10px;" class="pull-right"><div class="hidden-xs" style="padding-right: 15px;"><button id="category_'+newRowNameJ+'" class="btn btn-warning otherProductDetail">Add Your Own Item</button></div><div class="hidden-lg hidden-md hidden-sm" style="padding-right: 15px;"><button class="btn btn-warning otherProductDetail smallLoading category_'+newRowNameJ+'" data-remodal-target="otherProductDetail"><i class="fa fa-plus"></i></button></div></span></h1><hr>')
                                }

                                $('#row_'+newRowNameJ).fadeIn( "slow" ).append('<div class="col-lg-3 col-md-4 col-sm-6"><div class="card card--big tour-2"><div class="card__image" style="background-image: url('+jsonSubCategory.contentInfo[j].image_path+')"></div><h2 class="card__title">'+jsonSubCategory.contentInfo[j].product_name+'</h2><p class="card__text">'+jsonSubCategory.contentInfo[j].description+'</p><div id="product_'+jsonSubCategory.contentInfo[j].id+'" class="card__action-bar productCartButton"><div style="text-align-center;">Add to Cart</div><div class="col-lg-4 col-md-4 col-sm-6 col-xs-6" style="padding-top:15px;"></div></div></div>');
                            }else {
                            }
                        }
                        
                    }

                    $("html, body").animate({ scrollTop: 0 }, "slow");//top of the page scroll after each refresh

                    $(".wrapFilter").removeClass('active');
                    $.LoadingOverlay("hide", true);

                    var filterPosition = new FormData(); 
                    filterPosition.append('mainCategory', localStorage.mainCategory);   
                    filterPosition.append('user_id', localStorage.user_id);  

                    $.ajax({
                        type: "POST",
                        url: "/portal/services/filterPositionUpdate.php",
                        data: filterPosition,
                        contentType: false,
                        processData: false,	
                        cache: false,
                        beforeSend: function(){},
                        success: function(data) {
                            $('#filterSelect').val(localStorage.mainCategory);                          
                        }
                    });                        
                }                            

            }
        });            
    });
});