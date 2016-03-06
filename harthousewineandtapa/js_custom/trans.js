    $(document).ready(function () {
      
      $("input#btn").click(function(){
        $("#balancemsg").hide()
        $.ajax({
          type: "POST",
          url: "../services/transaction.php", // 
          data: $('form.contact').serialize(),
          success: function(msg){
		  $("#balancemsg").fadeIn(600).html(msg)
		  if (msg === '<center><p class=\"alert alert-warning\" >Invalid Gift Code Entered</p></center>') {


			} else {
						$("input#btn").removeClass('btn btn-danger');
            $("input#btn").addClass('btn btn-success');
            $("input#btn").attr('disabled','disabled');
			$("input#btn").attr('value','Transaction Complete');
			}
          },
          error: function(){
            alert("failure");
          }
        });
      });
    });
