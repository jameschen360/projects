
    $(document).ready(function () {
      
      $("input#btn").click(function(){
        $("#errmsg").hide()
        $.ajax({
          type: "POST",
          url: "./services/send_msg.php", // 
          data: $('form.contact').serialize(),
          success: function(msg){
            $("#errmsg").fadeIn(600).html(msg)

            if (msg === '<center><p class=\"alert alert-success\" >Thank you! We will be in touch shortly!</p></center>') {
              $("input#btn").removeClass('btn btn-outline');
              $("input#btn").addClass('btn btn-success');
              $("input#btn").attr('disabled','disabled');
              $("input#btn").attr('value','Message Sent!');
            }
          },
          error: function(){
            alert("failure");
          }
        });
      });
    });
