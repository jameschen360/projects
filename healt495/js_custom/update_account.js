
    $(document).ready(function () {

      $("button#update_customer").click(function(){
        $.ajax({
          type: "POST",
          url: "../services/update_account.php", // 
          data: $('form.contact').serialize(),
          success: function(msg){
			  
			  if(msg === "Success"){
				  document.location.reload(true);
			  }else {
				 $("#account_errmsg").fadeIn(1000).html(msg); 
			  }
			
          },
          error: function(){
            alert("failure");
          }
        });
      });
    });
