$(document).ready(function() {
    
    $(".id_edit").click(function(){
        $.ajax({
          type: "POST",
          url: "./services/edit_catagory.php",
          data: $('form.catagory_edit').serialize(),
            
          success: function(msg){
          
              if (msg === "success") {
                  $("#error_msg").hide(); 
                  $( ".id_edit" ).prop( "disabled", true );
                  window.top.location.reload();
                  
              }else {
                 $("#error_msg").fadeIn(600).html(msg); 
              }

          },
          error: function(){
            alert("failure");
          }
        });
            
    });
    
});