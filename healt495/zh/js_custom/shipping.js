
    $(document).ready(function () {
      
      $("#shipping_option").change(function(){
		  var shipping_option = $( "#shipping_option" ).val();
		  var weight = document.getElementById("weight").value;
		  var currency = $( "select option:selected" ).val();
		  var user = document.getElementById('hidden_user').value;

		  var info = 'option=' + shipping_option + '&weight=' + weight + '&currency=' + currency + '&user=' +user;						
		  var price_before_shipping	= document.getElementById("price_before_shipping").value;

		  price_before_shipping = parseFloat(price_before_shipping);
			
			if (currency === "rmb" || currency === "RMB") {
				symbol = '¥'
			} else {
				symbol = '$'
			}			
	  
			$.ajax({
			  type: "GET",
			  url: "../services/shipping.php",
			  data: info,
			  success: function(msg){
				msg = parseFloat(msg);
				var shipping_price = msg;
				var total = price_before_shipping + shipping_price;
				
				var shipping_price_formatted = symbol + shipping_price.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,');
				var total_formatted = symbol + total.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,');
				
				$("#checkout_final").val(total);
				
				$("#shipping_amount").text(shipping_price_formatted);
				$("#total_final").text(total_formatted);

			  },
			  error: function(){
				alert("failure");
			  }
			});			
      });
    });
