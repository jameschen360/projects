$(document).ready(function() {    
    
$(".delete_customer").hide();
    
$("input#confirm_button").click(function(){  
     $(".delete_customer").fadeIn(600); 
    $(".delete_customer").click(function(){
        $("input#confirm_button").prop("disabled", true);
        $(".delete_customer").prop("disabled", true);
        var delete_customer_id = $(this).attr('id');
        var info = 'id=' + delete_customer_id;
        $.ajax({
          type: "GET",
          url: "./services/delete_customer.php",
          data: info,
          success: function(msg){       
            
              if (msg === "success") {
                 document.location.reload(true);  
              }
           
          
          },
          error: function(){
            alert("failure");
          }
        });
            
    });
    });   
});