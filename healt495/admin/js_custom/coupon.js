$(document).ready(function() {
    $( "#coupon_btn" ).click(function() { 
        
        var code = $("#coupon_code").val();
        var discount = $("#coupon_discount").val();
        var date = $("#coupon_date").val();       
        var info = 'code='+code+'&discount='+discount+'&date='+date;
        $.ajax({
          type: "GET",
          url: "./services/coupon.php",
          data: info,
          success: function(msg){
              if (msg === "success") {
                  $("#coupon_btn").prop("disabled", true);
                  document.location.reload(true);         
              }else {
                  $("#coupon_msg").fadeIn(600).html(msg); 
              }
                
              
          },
          error: function(){
            alert("failure");
          }
        });     
    });
});