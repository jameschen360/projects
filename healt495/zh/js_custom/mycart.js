
    $(document).ready(function () {
      $(".del_button").click(function(){
		var number = document.getElementById('change_num').innerHTML;
		var total = document.getElementById('change_total').innerHTML;
		var currency = $( "select option:selected" ).val();
		
		number = number.replace(/\D/g,'');
		number = parseInt(number, 10) - 1;
		string = '购物车 (' + number + ')';
		string2 = '购物车: ' + number + ' 件';	
		
		total = total.substring(1);
		total = total.replace(/\,/g,"");
		total = parseFloat(total);
		
		var del = this.id;
		var element = $(this);
		var info = 'product_user=' + del;
		
		var subtotal = del.split("_");
		subtotal = subtotal[3];
		subtotal = parseFloat(subtotal);

		 
		total = total - subtotal;
		total = total.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,');
		if (currency === "rmb" || currency === "RMB") {
			total = '¥' + total;
		} else {
			total = '$' + total;
		}
		
		
		
		
        $.ajax({
          type: "GET",
          url: "./services/mycart.php", // 
          data: info,
          success: function(msg){
            if (msg === 'remove') {
			  $("table.table").fadeOut(1000);
			  $("div#checkout_remove").fadeOut(1000);
			  $("div#checkout_remove").hide();
              $("table.table").hide();
			  $('a#change_num').fadeIn(4000).text('购物车: (0)');
			  $("div#cart_msg").css({"padding-bottom":"13cm"});
			  $('#shopping_num').fadeIn(4000).text('购物车: 0 件');
			  $('#cart_msg').fadeIn(4000).text('您的购物车里是空的！');
			  
            }else {
				$('#shopping_num').fadeIn(4000).text(string2);
				$('a#change_num').fadeIn(4000).text(string);
				$('td#change_total').fadeIn(4000).text(total);
				//console.log('total is:' + total);
				//console.log('subtotal :' + subtotal);
			
			}			  

          },
          error: function(){
            console.log('error');
          }
        });

      });
    });