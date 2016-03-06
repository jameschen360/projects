<script src="./scripts/vendor.js"></script>
<script src="./scripts/plugins.js"></script>
<script src="./scripts/main.js"></script>
<script src="./js_custom/jquery.dataTables.min.js"></script>
<script src="./js_custom/dataTables.bootstrap.min.js"></script>
<script>
var rowNum =0;
$(document).ready(function() {

    
    $('[data-toggle="info"]').tooltip(); 
    
    $('#catagory_table').DataTable({
            responsive: true
    });
    $('#product_table').DataTable({
            responsive: true
    });     
    $('#customer_table').DataTable({
            responsive: true
    });  
    $('#order_table').DataTable({
            responsive: true
    });  
    $('#coupon_table').DataTable({
            responsive: true
    });     
    
    var rowNum =2;
    $('.multi-field-wrapper').each(function() {
    var $wrapper = $('.multi-fields', this);
    $(".add-field", $(this)).click(function(e) {
        $('.multi-field:first-child', $wrapper).clone(true).appendTo($wrapper).find('input').val('').attr('id', 'sub' + '_' + rowNum).focus();
        rowNum++;
        
    });
    });
 
    $("#chinese_tab").hide();
    
$( "#english_order" ).click(function() {
    $("#chinese_order").removeClass("btn-default");
    $("#chinese_order").addClass("btn-success");    
    $("#chinese_tab").hide();
    $("#english_tab").fadeIn(1000);
    $("#english_order").removeClass("btn-success");
    $("#english_order").addClass("btn-default");
});

$( "#chinese_order" ).click(function() {
    $("#english_order").removeClass("btn-default");
    $("#english_order").addClass("btn-success");   
    $("#english_tab").hide();
    $("#chinese_tab").fadeIn(1000);
    $("#chinese_order").removeClass("btn-success");
    $("#chinese_order").addClass("btn-default");    
});


});   
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#coupon_date').datepicker({
            format: "dd/mm/yyyy"
        });
    });
</script>
<script src="./js_custom/catagory_add.js"></script>
<script src="./js_custom/edit_catagory.js"></script>
<script src="./js_custom/delete_catagory.js"></script>
<script src="./js_custom/product_add.js"></script>
<script src="./js_custom/delete_customer.js"></script>
<script src="./js_custom/order_status.js"></script>
<script src="./js_custom/product_edit.js"></script>
<script src="./js_custom/product_delete.js"></script>
<script src="./js_custom/login.js"></script>
<script src="./js_custom/datepicker.js"></script>
<script src="./js_custom/coupon.js"></script>
<script src="./js_custom/product_pictures_delete.js"></script>
		<!-- Initialization of Plugins -->
<script type="text/javascript" src="./js_custom/template.js"></script>
