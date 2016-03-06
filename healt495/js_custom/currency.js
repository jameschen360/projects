
    $(document).ready(function () {
      
      $(".currency_change").change(function(){
		  var currency = $( '.currency_change' ).val();
		  var user = document.getElementById('hidden_user').value;
		  var ip = document.getElementById('hidden_ip').value;
		  var info = 'currency=' + currency + '&user=' + user +'&ip=' + ip;
		 	
							
			
			$.ajax({
			  type: "GET",
			  url: "../services/currency.php",
			  data: info,
			  success: function(msg){

				//console.log(currency);

				document.location.reload(true);
				
				
			  },
			  error: function(){
				alert("failure");
			  }
			});			
      });
    });
