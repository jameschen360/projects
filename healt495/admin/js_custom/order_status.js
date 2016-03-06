$(document).ready(function() {
  
    $(".order_status").change(function(){
        
        var id = $(this).attr('id');
        $(this).prop("disabled", true); 
        var status = $( '.order_status' ).val();
        if (status === "Shipped") {
            
            
            var info = "status=" + status + "&id=" + id;
            
            $.ajax({
              type: "GET",
              url: "./services/order_status.php",
              data: info,

              success: function(msg){
                $("#msg_" + id).fadeIn(600).html(msg); 
              },
              error: function(){
                alert("failure");
              }
            });
            
            
        }
    });
});