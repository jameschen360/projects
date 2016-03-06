
    $(document).ready(function () {
      
      $("input#signup").click(function(){
		
		var terms = document.getElementById('terms');
		if (terms.checked) {
			$.ajax({
			  type: "POST",
			  url: "./services/signup_check.php", // 
			  data: $('form.contact').serialize(),
			  success: function(msg){
				$("#errmsg").fadeIn(600).html(msg)

				if (msg === '<center><p style=\"font-size:25px;\"><font color=\"green\"><strong>您现在可以登录到我们的官网了！</strong></font></p></center>') {
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
			$("#errmsg").fadeIn(600).html('<center><p><font color=\"red\"><strong>请同意我们的条款和服务</strong></font></p></center>')
			
		}

		
		
      });
    });
