
    $(document).ready(function () {
      
      $("input#passwordreset").click(function(){
        $("#password_msg").hide()
        $.ajax({
          type: "POST",
          url: "./services/passwordreset.php", // 
          data: $('form.reset_pass').serialize(),
          success: function(msg){
            $("#password_msg").fadeIn(600).html(msg)

            if (msg === '<center><p style=\"font-size:25px;\"><font color=\"green\"><strong>A new password has been sent to your registered email!</strong></font></p></center>') {
              $("input#passwordreset").hide();
			  $("p.msg_pass").hide();
			  $("input#email").attr('disabled','disabled');
            }
          },
          error: function(){
            alert("failure");
          }
        });
      });
    });
