    $(document).ready(function () {
      
      $("input#btn_trans").click(function(){
        $("#balancemsg").hide()
        $.ajax({
          type: "POST",
          url: "../services/transaction.php", // 
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
