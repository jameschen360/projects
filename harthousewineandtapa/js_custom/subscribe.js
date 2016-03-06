
    $(document).ready(function () {
      
      $("input#subscribe").click(function(){
        $("#error").hide()
        $.ajax({
          type: "POST",
          url: "./services/subscribe.php", // 
          data: $('form.subscribe').serialize(),
          success: function(msg){
            $("#error").fadeIn(600).html(msg)

            if (msg === '<center><p class=\"alert alert-success\" >We will confirm your reservation shortly! Thank you!</p></center>') {
              $("input#subscribe").removeClass('btn btn-primary');
              $("input#subscribe").addClass('btn btn-success');
              $("input#subscribe").attr('disabled','disabled');
              $("input#subscribe").attr('value','Subscribed!');
            }
          },
          error: function(){
            alert("failure");
          }
        });
      });
    });
