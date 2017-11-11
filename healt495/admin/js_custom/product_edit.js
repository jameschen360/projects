$(document).ready(function() {
    
$('input[name=main_image_edit]').change(function() {
        var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            alert("Only formats are allowed : "+fileExtension.join(', '));
            $("#main_image_load_edit").attr('src', "http://dummyimage.com/200x200/e057d7/ffffff&text=Product Image Needed!750+by 1000");
        } else {
           var files = this.files;
           var reader = new FileReader();
           var name=this.value;
           reader.onload = function (e) {
              $("#main_image_load_edit").attr('src', e.target.result);
           };
           reader.readAsDataURL(files[0]);             
        }
   
});
    
$("form#product_edit_post").submit(function(event){
  $(".product_add_edit").prop('disabled', true);
  $(".product_delete").prop('disabled', true);
  //disable the default form submission
  event.preventDefault();
 
  //grab all form data  
  var formData = new FormData($(this)[0]);
 
  $.ajax({
    url: 'product_edit_sql.php',
    type: 'POST',
    data: formData,
    async: false,
    cache: false,
    contentType: false,
    processData: false,
    success: function (returndata) {

        if (returndata === "OKAY") {
            window.top.location.reload();
            
        }      
    }
  });
 
  return false;
});
    });