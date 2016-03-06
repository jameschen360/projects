$(document).ready(function() {    
    $("input.catagory_delete").click(function(){
        var delete_catagory_id = $(this).attr('id');
        var info = 'id=' + delete_catagory_id;

        $.ajax({
          type: "GET",
          url: "./services/delete_catagory.php",
          data: info,
          success: function(msg){    
          $("#delete_category_msg").fadeIn(600).html(msg);     
              if (msg === "<span style=\"color:red;\">Delete successful!</span><br/>") {                 
                  $('#delete_'+delete_catagory_id).modal('hide');
                      window.top.location.reload();
                                  
                       
              }else {
                  $("input.modal_hide_delete").click(function(){
                      $('#delete_'+delete_catagory_id).modal('hide');
                  }); 
              }          
          
          },
          error: function(){
            alert("failure");
          }
        });
            
    });
    
});