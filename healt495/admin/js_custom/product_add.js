$(document).ready(function() {
    
$('input[name=main_image]').change(function() {
        var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            alert("Only formats are allowed : "+fileExtension.join(', '));
            $("#main_image_load").attr('src', "http://dummyimage.com/200x200/e057d7/ffffff&text=Product Image Needed!750+by 1000");
        } else {
           var files = this.files;
           var reader = new FileReader();
           var name=this.value;
           reader.onload = function (e) {
              $("#main_image_load").attr('src', e.target.result);
           };
           reader.readAsDataURL(files[0]);             
        }
   
});
    
$("form#product_post").submit(function(event){
  $(".product_add").prop('disabled', true);
  //disable the default form submission
  event.preventDefault();
 
  //grab all form data  
  var formData = new FormData($(this)[0]);
 
  $.ajax({
    url: 'product_add_sql.php',
    type: 'POST',
    data: formData,
    async: false,
    cache: false,
    contentType: false,
    processData: false,
    success: function (returndata) {
      if (returndata === "No") {
        $("#product_add_msg").fadeIn(600).html("Error has occured"); 
            $(".product_add").prop('disabled', false);
        }else {
          $("#product_add_msg").fadeIn(600).html(returndata); 
          
          $(".product_add").val("Done!");
          document.location.reload(true);         
         }
  
    }
  });
 
  return false;
});
    });