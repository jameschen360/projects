
    $(document).ready(function () {
      
      $("input#comment_submit").click(function(){
        $("#comment_msg").hide()
        $.ajax({
          type: "POST",
          url: "../services/comment_post.php", // 
          data: $('form.comment_post').serialize(),
          success: function(msg){
            $("#comment_msg").fadeIn(600).html(msg)

            if (msg === '<p style=\"color:#33cc33;\" >Thanks for your review. You can refresh the page to view it!</p>') {
              $("form#comment-form").hide();
			  $("input#comment_submit").hide();
			  $('#comment_change').text('Success!');
				setTimeout(3); 
				document.location.reload(true);
            }
          },
          error: function(){
            alert("failure");
          }
        });
      });
    });
