
    $(document).ready(function () {
      
      $("input#addcart").click(function(){
		var number = document.getElementById('change_num').innerHTML;
		number = number.replace(/\D/g,'');
		number = parseInt(number, 10) + 1;
		string = '购物车 (' + number + ')';
        $("#cart_msg").hide()
        $.ajax({
          type: "POST",
          url: "./services/addcart.php", // 
          data: $('form.addcart').serialize(),
          success: function(msg){
            $("#cart_msg").fadeIn(600).html(msg)

            if (msg === '<p class=\"pull-right\" style=\"color:#33cc33;\" >产品以加进购物车里！</p>') {
				$('a#change_num').fadeIn(4000).text(string);
				//document.location.reload(true);
            }
          },
          error: function(){
            alert("failure");
          }
        });
      });
    });