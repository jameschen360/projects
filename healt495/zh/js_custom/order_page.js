
$(document).ready(function () {
	
		$(".order_invoice").click(function(){
			var del = this.id;
			var element = $(this);
			var info = 'order_id=' + del;
			window.location.replace('order.php?'+info);
		
		});
		
		
	
});