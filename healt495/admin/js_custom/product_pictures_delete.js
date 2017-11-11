$(document).ready(function() {

    $( "#delete_product_picture" ).click(function() {
        var id = $("#product_id_delete").val();
        var info = 'id='+id;
        //$( "#delete_product_picture" ).prop( "disabled", true );
        alert(info)
        $.ajax({
          type: "GET",
          url: "./services/product_pictures_delete.php",
          data: info,
          success: function(msg){
          

            if (msg === 'okay') {
               $( "#delete_product_picture" ).hide();
               $("span#sub_image_delete").fadeIn(600).html("Sub Images Deleted!");        
            } 
              
          },
          error: function(){
            alert("failure");
          }
        });
        
        
    });
});