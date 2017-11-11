$(document).ready(function() {
    
    $(".product_delete").click(function(event){
      $(".product_add_edit").prop('disabled', true);
      $(".product_delete").prop('disabled', true);
      var id = $('#product_id_delete').val();
        var info = "id="+id;
        $.ajax({
          type: "GET",
          url: "./services/product_delete.php",
          data: info,
          success: function(msg){
              window.top.location.reload();
          },
          error: function(){
            alert("failure");
          }
        });

      return false;
    });
});