
    $(document).ready(function () {
      
      $("input#passwordreset").click(function(){
        $("#password_msg").hide()
        $.ajax({
          type: "POST",
          url: "./services/passwordreset.php", // 
          data: $('form.reset_pass').serialize(),
          success: function(msg){
            $("#password_msg").fadeIn(600).html(msg)

            if (msg === '<center><p style=\"font-size:15px;\"><font color=\"green\"><strong>新密码已发送到您注册的电子信箱里</strong></font></p></center>') {
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
