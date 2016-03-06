(function($) {
    var element = $('#floating'),
        originalY = element.offset().top;
    
    // Space between element and top of screen (when scrolling)
    var topMargin = 65;
    
    // Should probably be set in CSS; but here just for emphasis
    element.css('position', 'relative');
    
    $(window).on('scroll', function(event) {
        var scrollTop = $(window).scrollTop();
        
        element.stop(false, false).animate({
            top: scrollTop < originalY
                    ? 0
                    : scrollTop - originalY + topMargin
        }, 150);
			
    if ($(window).scrollTop() == $(document).height()-$(window).height()){
		$(".catagory_acr").removeClass("collapse in");
		$(".catagory_acr").addClass("collapse");
    }else {
		$(".catagory_acr").removeClass("collapse");
		$(".catagory_acr").addClass("collapse in");		
	}
	
    });
})(jQuery);