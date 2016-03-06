
    $(document).ready(function () {
      
      $("input#signup").click(function(){
		
		var terms = document.getElementById('terms');
		if (terms.checked) {
			$.ajax({
			  type: "POST",
			  url: "../services/signup_check.php", // 
			  data: $('form.contact').serialize(),
			  success: function(msg){
				$("#errmsg").fadeIn(600).html(msg)

				if (msg === '<center><p style=\"font-size:25px;\"><font color=\"green\"><strong>Thank you for registering! You may now login!</strong></font></p></center>') {
				  $('div.javaremove').hide();
				  $('#javaemail').text('Username:');
				  $('#email').attr('disabled','disabled');
				  $('input#signup').hide();
				}
			  },
			  error: function(){
				alert("failure");
			  }
			});
		}else {
			$("#errmsg").fadeIn(600).html('<center><p><font color=\"red\"><strong>Please agree to our terms and services!</strong></font></p></center>')
			
		}

		
		
      });
    });
