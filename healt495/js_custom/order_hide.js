
$(document).ready(function () {

	$("#order").hide();
	
		$("#account_tab").click(function(){
			$("#order_tab").removeClass("btn-outline");
			$("#order_tab").addClass("btn-default");			
			$("div#order").fadeOut(40);
			$("div#account").fadeIn(800);
			$("#account_tab").removeClass("btn-default");
			$("#account_tab").addClass("btn-outline");
		
		});
		
		$("#order_tab").click(function(){
			$("#account_tab").removeClass("btn-outline");
			$("#account_tab").addClass("btn-default");				
			$("div#account").fadeOut(40);
			$("div#order").fadeIn(800);
			$("#order_tab").removeClass("btn-default");
			$("#order_tab").addClass("btn-outline");			
		
		});		
		
	
});