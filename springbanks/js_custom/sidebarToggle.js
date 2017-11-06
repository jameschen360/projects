$( document ).ready(function() {
    $('.buttonFilter').on('click', function(){
        $('.wrapFilter, buttonFilter').toggleClass('active');       
        return false;
    });

    $('#previous_main, #previous_small').on('click', function() {
        $('.previousOrder, .currentItem, .userSettings').hide();
        $('.previousOrder').show();
    });

    $('#current_main, #current_small').on('click', function() {
        $('.previousOrder, .currentItem, .userSettings').hide();
        $('.currentItem').show();
    });
    $('#user_main, #user_small').on('click', function() {
        $('.previousOrder, .currentItem, .userSettings').hide();
        $('.userSettings').show();
    });
});