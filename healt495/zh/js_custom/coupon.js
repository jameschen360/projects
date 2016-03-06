$(document).ready(function(){
	$('#coupon').bind('input propertychange', function() {

		var output = document.getElementById('coupon').value;
		var total_final = document.getElementById('change_total').innerHTML;
		var user_email = document.getElementById('hidden_user').value;
		  total_final = total_final.substring(1);
		  total_final = total_final.replace(/\,/g,"");
		  total_final = parseFloat(total_final);		
		
		
		var info = 'msg=' + output + '&user=' + user_email; 
		var currency = $( "select option:selected" ).val();
		if (currency === "rmb" || currency === "RMB") {
			symbol = '¥'
		} else {
			symbol = '$'
		}
		var shipping_price = parseFloat(shipping_price);
        $.ajax({
          type: "GET",
          url: "./services/coupon.php", // 
          data: info,
          success: function(msg){
				
				if (msg === "invalid") {
					var msg_str = $('#output').html("折扣卷码错误！");
					$('#output').attr('style','color: red;');
					$('#coupon_amount').fadeIn(4000).text('--');
					var total_string = total_final.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,');
					total_string = symbol + total_string;
					$('#total_final').fadeIn(4000).text(total_string);
					
				}else {

					var discount = parseFloat(msg);
					var discount_percentage = 10-(discount*10);
					var msg_str = $('#output').html('折扣卷已使用!'+' '+discount_percentage+'折');
					$('#output').attr('style','color: green;');					
					var new_subtotal_difference = total_final * discount;
					var difference = new_subtotal_difference.toFixed(2);
					var string_output = '-' + symbol + difference;
					var total_amount = (total_final - new_subtotal_difference).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,');
					total_amount = symbol + total_amount;
					$('#coupon').prop('disabled', true);
					$('.del_button').prop('disabled', true);
					$('#coupon_amount').fadeIn(4000).text(string_output);
					$('#change_total').fadeIn(4000).text(total_amount);
					$('#msg_coupon').fadeIn(4000).text("想删除产品，请刷新！");
					$("#post_amount").val(total_amount);
					$("#discount_amount").val(output);
				}

          },
          error: function(){
            console.log('error');
          }
        });		
		
		
	});
	
});