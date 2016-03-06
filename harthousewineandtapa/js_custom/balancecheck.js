    $(document).ready(function () {
      
      $("input#btn").click(function(){
        $("#balancemsg").hide()
        $.ajax({
          type: "POST",
          url: "./services/balancecheck.php", // 
          data: $('form.contact').serialize(),
          success: function(msg){
            $("#balancemsg").fadeIn(600).html(msg)
          },
          error: function(){
            alert("failure");
          }
        });
      });
    });
