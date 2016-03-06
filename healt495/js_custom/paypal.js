
    $(document).ready(function () {
      $("#paypal_button").click(function(){
		  
		$( "#paypal_button" ).prop( "disabled", true );
		$( "#paypal_button" ).text( "Processing..." );
		var product = document.getElementById('product_array').value;
		var user = document.getElementById('user_email_id').value;
		var bname = document.getElementById('inputBillingName').value;
		var sname = document.getElementById('inputShippingName').value;
		var bemail = document.getElementById('inputBillingEmail').value;	
		var semail = document.getElementById('inputShippingEmail').value;
		var shipping_cost = document.getElementById('inputShippingAmount').value;
		var coupon = document.getElementById('inputCoupon').value;
		var baddress = document.getElementById('inputBillingAddress').value;
		var saddress = document.getElementById('inputShippingAddress').value;
		var comment = document.getElementById('inputComment').value;
		var btel = document.getElementById('inputBillingPhone').value;
		var stel = document.getElementById('inputShippingPhone').value;
		var subtotal = document.getElementById('inputSubtotal').value;
		var total = document.getElementById('inputTotal').value;
		var currency_rate = document.getElementById('inputCurrency').value;
		var is_same_shipping = document.getElementById('inputSameShipping').value;
		var currency_code = document.getElementById('inputCurrencyFactor').value;
		var invoice = document.getElementById('unique_id').value;
		var amount = document.getElementById('productamount').value;
		
		var info = 'user='+user+'&product='+product+'&bname='+bname+'&sname='+sname+'&bemail='+bemail+'&semail='+semail
			+'&shipping_cost='+shipping_cost+'&coupon='+coupon+'&baddress='+baddress+'&saddress='+saddress+'&comment='
			+comment+'&btel='+btel+'&stel='+stel+'&subtotal='+subtotal+'&currency_rate='+currency_rate+'&is_same_shipping='
			+is_same_shipping+'&currency_code='+currency_code+'&total='+total+'&invoice='+invoice+'&amount='+amount;
			
        $.ajax({
          type: "GET",
          url: "../services/paypal_order_submit.php", // 
          data: info,
          success: function(msg){
			if (msg === "good") {
				document.paypal_form.submit();
				//console.log(amount);
			}

          },
          error: function(){
            console.log('error');
          }
        });

      });
    });