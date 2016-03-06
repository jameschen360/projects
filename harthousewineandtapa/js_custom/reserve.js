
    $(document).ready(function () {
      
      $("input#reserve_btn").click(function(){
        $("#reserve_error").hide()
        $.ajax({
          type: "POST",
          url: "./services/reserve_msg.php", // 
          data: $('form.reserve').serialize(),
          success: function(msg){
            $("#reserve_error").fadeIn(600).html(msg)

            if (msg === '<center><p class=\"alert alert-success\" >We will confirm your reservation and Email you shortly! Thank you!</p></center>') {
              $("input#reserve_btn").removeClass('btn btn-outline');
              $("input#reserve_btn").addClass('btn btn-success');
              $("input#reserve_btn").attr('disabled','disabled');
              $("input#reserve_btn").attr('value','Reservation Request Sent!');
            }
          },
          error: function(){
            alert("failure");
          }
        });
      });
    });
