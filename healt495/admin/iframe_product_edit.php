<?
include('../inc/db.php');

$id = $_POST['product_id'];
$product_result = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM product WHERE id='$id'"));
$name = $product_result['name'];
$zh_name = $product_result['zh_name'];
$detail = $product_result['detail'];
$zh_detail = $product_result['zh_detail'];
$picture = $product_result['picture'];
$price = $product_result['price'];
$catagory = $product_result['catagory'];
$catagory_main = $product_result['catagory_main'];
$keywords = $product_result['keywords'];
$instock = $product_result['instock'];
$discount = $product_result['discount'];
$weight = $product_result['weight'];
$zh_pdf = $product_result['zh_pdf'];
$pdf = $product_result['pdf'];
$legacy = $product_result['legacy'];
?>
<html lang="en" class="no-js"><!--<![endif]-->
  <head>
    <meta charset="utf-8">
    <title>Health Supplements Plus</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Place favicon.ico and apple-touch-icon.png in the root directory-->
    <link rel="stylesheet" href="./styles/main.css">
    <link rel="stylesheet" href="./styles/custom.css">
    <link rel="stylesheet" href="./styles/vendor.css">
    <script src="./scripts/vendor/modernizr.js"></script>
    <!-- GMaps api-->
    <script type="text/javascript" src="//maps.google.com/maps/api/js?sensor=true"></script>
  </head>
  <body style="background-color:white; padding:15px;">

          <!--FORM PRODUCT-->
        <form id="product_edit_post">
          <div class="row">
            <div class="form-group col-lg-6 col-sm-6 col-xs-6 javaremove" style="padding:10px;">
			<label for="main_image" class="control-label">Upload Main Image:</label><br/>
                    <img id="main_image_load_edit" class="img-responsive" src="images/products/<?echo $picture?>" width="150px" height="200px" alt="">
                       <h2>Update Image</h2>
                       <input name="main_image_edit" type="file" id="main_image_edit" class="form=control btn btn-default btn-xs" data-rule-required="true" data-msg-required="You need a main product picture!">
            </div>
          </div>           
          <?
            $more_picture_num = mysqli_num_rows(mysqli_query($db, "SELECT * FROM product_picture WHERE product_id = '$id'"));
                if ($more_picture_num != 0) {?>
                    <input type="button" id="delete_product_picture" class="btn btn-danger btn-xs" style="margin-bottom:12px;" value="Delete sub pictures"><br><span id="sub_image_delete"></span>
          <?     }
          ?>               
          <div class="row">
              <div class="form-group col-lg-6 col-sm-6 col-xs-6 javaremove" style="padding:10px;">
                <label for="ename" class="control-label">Update English Product Name:</label>
                <input type="text" class="form-control" id="ename" name="ename" value="<?echo $name?>" required>
              </div>
              <div class="form-group col-lg-6 col-sm-6 col-xs-6 javaremove" style="padding:10px;">
                <label for="zname" class="control-label">Update 中文产品名:</label>
                <input type="text" class="form-control" id="zname" name="zname" value="<?echo $zh_name?>" required>
              </div>              
          </div>
          <div class="row">
              <div class="form-group col-lg-6 col-sm-6 col-xs-6 javaremove" style="padding:10px;margin-top:-15px;">
                <label for="etext" class="control-label">Update English Description</label>
                  <textarea class="form-control" id="etext" name="etext" required><?echo $detail?></textarea>
              </div>
              <div class="form-group col-lg-6 col-sm-6 col-xs-6 javaremove" style="padding:10px;margin-top:-15px;">
                <label for="ztext" class="control-label">Update 中文产品解说:</label>
                  <textarea class="form-control" id="ztext" name="ztext" required><?echo $zh_detail?></textarea>
              </div>              
          </div>
          <div class="row">
              <div class="form-group col-lg-6 col-sm-6 col-xs-6 javaremove" style="padding:10px;margin-top:-15px;">
                <label for="etext" class="control-label">Update Catagory:</label>
                  <select class="form-control" id="catagory_select" name="catagory_select">
                      <?
                      if ($catagory_main != $catagory) {?>
                      <option value="<?echo $catagory_main?>_<?echo $catagory?>" selected><?echo $catagory_main?>=><?echo $catagory?></option>                 
                      <?}else {?>
                      <option value="<?echo $catagory_main?>_<?echo $catagory?>" selected><?echo $catagory_main?></option>                           
                      <?}
                      ?>

                      <?
                        $catagory_query = mysqli_query($db, "SELECT * FROM catagory");
                        while ($catagory_result = mysqli_fetch_assoc($catagory_query)){;
                        $catagory_name =  $catagory_result['name']; 
                        $catagory_sub_num =  $catagory_result['sub']; 
                        $catagory_subname =  $catagory_result['subname']; 
                        
                        $catagory_subname = explode(',',$catagory_subname);
                        $catagory_subname_size = count($catagory_subname);                                                          
   
                        
                        if ($catagory_sub_num == 0 ) {?>
                           <option value="<?echo $catagory_name?>"><?echo $catagory_name?></option>
                      <?  }else {
                        for ($i=0; $i<$catagory_subname_size;$i++) {?>
                            <option value="<?echo $catagory_name?>_<?echo $catagory_subname[$i]?>"><?echo $catagory_name?>=><?echo $catagory_subname[$i]?></option>                           
                     <?   }
                      
                      ?>
                      
                      <?
                            }
                        }
                      ?>
                  </select>
              </div>  
              <div class="form-group col-lg-6 col-sm-6 col-xs-6 javaremove" style="padding:10px;margin-top:-15px;">
                <label for="price" class="control-label">Update Price:</label>
                  <input type="text" class="form-control" id="price" id="price" name="price" value="<?echo $price?>" placeholder="eg) 45.99" required>
              </div> 
              <div class="row" style="padding:10px;">
                  <div class="form-group col-lg-6 col-sm-6 col-xs-6 javaremove" >
                    <label for="stock" class="control-label">Update Stock:</label>
                       <input type="text" class="form-control" id="stock" name="stock" value="<?echo $instock?>" placeholder="eg) 4" required>
                  </div>
                  <div class="form-group col-lg-6 col-sm-6 col-xs-6 javaremove" >
                    <label for="weight" class="control-label">Update Weight (in lb):</label>
                      <input type="text" class="form-control" id="weight" name="weight" value="<?echo $weight?>" placeholder="in pounds (lb) eg) 2" required>
                  </div>                      
              </div>
              <div class="row" style="padding:10px;">
                  <div class="form-group col-lg-6 col-sm-6 col-xs-6 javaremove">
                    <label for="discount" class="control-label">Update Discount:(Optional)</label>
                       <input type="text" class="form-control" id="discount" name="discount" value="<?echo $discount?>" placeholder="eg) 0.4 => 40% off">
                  </div>
                  <div class="form-group col-lg-6 col-sm-6 col-xs-6 javaremove">
                    <label for="keyword" class="control-label">Update Keywords:</label>
                       <input type="text" class="form-control" id="keyword" name="keyword" value="<?echo $keywords?>" placeholder="eg) all,productname,hello,产品 (Make sure comma is in english)" required>
                  </div>                  
              </div>
              <div class="row" style="padding:10px;">
                  <div class="form-group col-lg-6 col-sm-6 col-xs-6 javaremove">
                    <label for="pdf" class="control-label">Update English PDF (Optional):</label>
                       <input type="file" class="form-control" id="pdf" name="pdf">
                  </div>
                  <div class="form-group col-lg-6 col-sm-6 col-xs-6 javaremove">
                    <label for="zpdf" class="control-label">Update 中文 PDF (Optional):</label>
                       <input type="file" class="form-control" id="zpdf" name="zpdf">
                  </div>                  
              </div>              
          </div>            
            
            <input type="hidden" name="hidden_id" value="<?echo $id?>">
          <div class="row" style="padding:10px;margin-top:-15px;">
              <p>Additional Pictures: Press CTRL while clicking on multiple pictures to upload</p>
                <input type="file" class="form-control" id="upload[]" name="upload[]" multiple>  
           <span>
               <input type="submit" class="btn btn-success btn-lg pull-right product_add_edit" value="Save" style="padding:10px;margin-top:10px;">
               <input type="hidden" id="product_id_delete" value="<?echo $id?>">  
               <input type="button" class="btn btn-danger btn-xs pull-left product_delete" value="Delete Product" style="padding:10px;margin-top:10px;">

           </span> 
          </div>       
          <div id="product_add_msg"></div>    
        </form>         
   
      <?include('inc/scripts.php');?>
    </body>
</html>
