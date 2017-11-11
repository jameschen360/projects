$(document).ready(function() {
    var value_input = [];
    var sub_catagory = [];
    var str;
    $( "#add_catagory" ).click(function() {
        i = 0;
        $("form#catagory_post :input").each(function(){
         var input = $(this); 
         value_input[i++] = input.val()
            
        }); 
        
        for (i = 4; i <= value_input.length-3; i++) {
               sub_catagory[i] = value_input[i];        
        }
        
        ename = value_input[0];
        zname = value_input[1];
        etext = value_input[2];
        ztext = value_input[3];
        
        for (i = 4; i <= sub_catagory.length-1; i++) {
            
            if (i == 4) {
               str = sub_catagory[i];
            }else {
                 str += ',' + sub_catagory[i];
            }       
        }

        while (str.slice(-1) === ",") {
            str = str.slice(0, -1);
        }

        var info = 'ename='+ename+'&zname='+zname+'&etext='+etext+'&ztext='+ztext+'&subname='+str;

        $.ajax({
          type: "GET",
          url: "./services/catagory_add.php",
          data: info,
          success: function(msg){
          $("span#add_msg").fadeIn(600).html(msg);
            if (msg === 'success') {
                $( "#add_catagory" ).prop( "disabled", true );
				document.location.reload(true);            
             }else {
                 
                 $("#catagory_add_modal").effect( "shake" );                 
             }   
              
          },
          error: function(){
            alert("failure");
          }
        });
        
        
    });
});