<?include('inc/header.php');?>
<?

    

?>
      <!-- Main-->
      <section>
        <!-- Content-->
        <div class="app">
          <div class="app-view-header">Products<button id="catagory_add" class="btn btn-success btn-xs" data-toggle="modal" data-target="#product_add_modal">Add New Product</button><hr></div>           
          <div class="row">
              
              <div class="dataTable_wrapper">
              <div class="col-lg-12 col-sm-12 col-xs-12">    
				<table class="table table-striped table-bordered table-hover" id="product_table">
				<thead>
				    <tr>
				        <th>Products</th>
						<th>Products (中文)</th>
                        <th>Category</th>
                        <th>Details</th>

				    </tr>
				</thead>
				<tbody>
                    <?
                        $fetch_result = mysqli_query($db, "SELECT * FROM product WHERE legacy <> 'yes'");
                        while ($fetch_result_sql = mysqli_fetch_assoc($fetch_result)){
                            $id = $fetch_result_sql['id'];
                            $ename = $fetch_result_sql['name'];
                            $zname = $fetch_result_sql['zh_name'];
                            $edetail = $fetch_result_sql['detail'];
                            $zdetail = $fetch_result_sql['zh_detail'];
                            $price = $fetch_result_sql['price'];
                            $picture = $fetch_result_sql['picture'];
                            $category = $fetch_result_sql['catagory'];
                            $category_main = $fetch_result_sql['catagory_main'];
                            $keywords = $fetch_result_sql['keywords'];
                            $instock = $fetch_result_sql['instock'];
                            $discount = $fetch_result_sql['discount'];
                            $weight = $fetch_result_sql['weight'];
                            $zh_pdf = $fetch_result_sql['zh_pdf'];
                            $pdf = $fetch_result_sql['pdf'];
                            $legacy = $fetch_result_sql['legacy'];     
                    ?>
				    <tr class="remove_product">
				        <td><?echo $ename;?></td>
						<td><?echo $zname;?></td>
                        <?
                            if ($category == $category_main) {?>
                                <td><?echo $category_main;?></td>                                
                        <?  }else {?>
                                <td><?echo $category_main;?>-><?echo $category;?></td>                                
                        <?    }                        
                        ?>
				        <td>
                        <form action="iframe_product_edit.php" target="product_edit_iframe" method="POST">   
                        <input type="hidden" name="product_id" value="<?echo $id?>">      
                        <input type="submit" id="<?echo $invoice;?>" class="btn btn-sm btn-default" style="margin-left:5px;" value="Edit" data-toggle="modal" data-target="#product_edit_iframe">
                        </form>    
                        
                        </td>  
                        
				    </tr>	                    
                    <?    }
        
                    ?>
																
                </tbody>									
				</table>
              </div>								  
              </div>		  
		  
		  </div>
		</div>
<div class="modal fade modal_login_style" id="product_add_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-content modal-dialog modal-lg">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title" id="modalla">Add Product <span id="product_add_msg"></span></h4>
      </div>
      <div class="modal-body">
          
          <!--FORM PRODUCT-->
        <form id="product_post">
          <div class="row">
            <div class="form-group col-lg-6 col-sm-6 col-xs-6 javaremove" style="padding:10px;">
			<label for="main_image" class="control-label">Upload Main Image:</label><br/>
                <div class="hovereffect">
                    <img id="main_image_load" class="img-responsive" src="http://dummyimage.com/200x200/e057d7/ffffff&text=Product Image Needed!750+by 1000" alt="">
                    <div class="overlay">
                       <h2>Main Image</h2>
                       <input name="main_image" type="file" id="main_image" class="form=control btn btn-default btn-xs" data-rule-required="true" data-msg-required="You need a main product picture!">
                    </div>
                </div>    
            </div>
          </div>           
            
          <div class="row">
              <div class="form-group col-lg-6 col-sm-6 col-xs-6 javaremove" style="padding:10px;">
                <label for="ename" class="control-label">English Product Name:</label>
                <input type="text" class="form-control" id="ename" name="ename" value="" required>
              </div>
              <div class="form-group col-lg-6 col-sm-6 col-xs-6 javaremove" style="padding:10px;">
                <label for="zname" class="control-label">中文产品名:</label>
                <input type="text" class="form-control" id="zname" name="zname" value="" required>
              </div>              
          </div>
          <div class="row">
              <div class="form-group col-lg-6 col-sm-6 col-xs-6 javaremove" style="padding:10px;margin-top:-15px;">
                <label for="etext" class="control-label">English Description</label>
                  <textarea class="form-control" id="etext" name="etext" required></textarea>
              </div>
              <div class="form-group col-lg-6 col-sm-6 col-xs-6 javaremove" style="padding:10px;margin-top:-15px;">
                <label for="ztext" class="control-label">中文产品解说:</label>
                  <textarea class="form-control" id="ztext" name="ztext" required></textarea>
              </div>              
          </div>
          <div class="row">
              <div class="form-group col-lg-6 col-sm-6 col-xs-6 javaremove" style="padding:10px;margin-top:-15px;">
                <label for="etext" class="control-label">Catagory:</label>
                  <select class="form-control" id="catagory_select" name="catagory_select">
                      <?
                        $catagory_query = mysqli_query($db, "SELECT * FROM catagory");
                        while ($catagory_result = mysqli_fetch_assoc($catagory_query)){;
                        $catagory_name =  $catagory_result['name']; 
                        $catagory_sub_num =  $catagory_result['sub']; 
                        $catagory_subname =  $catagory_result['subname']; 
                        
                        $catagory_subname = explode(',',$catagory_subname);
                        $catagory_subname_size = count($catagory_subname);                                                          
                        
                        if ($catagory_sub_num == 0) {?>
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
                <label for="price" class="control-label">Price:</label>
                  <input type="text" class="form-control" id="price" id="price" name="price" value="" placeholder="eg) 45.99" required>
              </div> 
              <div class="row" style="padding:10px;">
                  <div class="form-group col-lg-6 col-sm-6 col-xs-6 javaremove" >
                    <label for="stock" class="control-label">Stock:</label>
                       <input type="text" class="form-control" id="stock" name="stock" placeholder="eg) 4" required>
                  </div>
                  <div class="form-group col-lg-6 col-sm-6 col-xs-6 javaremove" >
                    <label for="weight" class="control-label">Weight:</label>
                      <input type="text" class="form-control" id="weight" name="weight" placeholder="in pounds (lb) eg) 2" required>
                  </div>                      
              </div>
              <div class="row" style="padding:10px;">
                  <div class="form-group col-lg-6 col-sm-6 col-xs-6 javaremove">
                    <label for="discount" class="control-label">Discount:(Optional)</label>
                       <input type="text" class="form-control" id="discount" name="discount" placeholder="eg) 0.4 => 40% off">
                  </div>
                  <div class="form-group col-lg-6 col-sm-6 col-xs-6 javaremove">
                    <label for="keyword" class="control-label">Keywords:</label>
                       <input type="text" class="form-control" id="keyword" name="keyword" placeholder="eg) all,productname,hello,产品 (Make sure comma is in english)" required>
                  </div>                  
              </div>
              <div class="row" style="padding:10px;">
                  <div class="form-group col-lg-6 col-sm-6 col-xs-6 javaremove">
                    <label for="pdf" class="control-label">English PDF (Optional):</label>
                       <input type="file" class="form-control" id="pdf" name="pdf">
                  </div>
                  <div class="form-group col-lg-6 col-sm-6 col-xs-6 javaremove">
                    <label for="zpdf" class="control-label">中文 PDF (Optional):</label>
                       <input type="file" class="form-control" id="zpdf" name="zpdf">
                  </div>                  
              </div>              
          </div>            
            
 
          <div class="row" style="padding:10px;margin-top:-15px;">
              <p>Additional Pictures: Press CTRL while clicking on multiple pictures to upload</p>
                <input type="file" class="form-control" id="upload[]" name="upload[]" multiple>  
               
               <input type="submit" class="btn btn-success btn-lg pull-right product_add" value="Save" style="padding:10px;margin-top:10px;">
          </div>
          <div id="product_add_msg"></div>    
        </form>  
          
      </div>
  </div>
</div>
          
<div class="modal fade modal_login_style" id="product_edit_iframe" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-content modal-dialog modal-lg">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title" id="modalla">Editing product<span id="edit_msg"></span></h4>
      </div>
      <div class="modal-body"> 
        <iframe name="product_edit_iframe" src="iframe_product_edit.php" width="100%" height="750px" frameborder="0" ></iframe>
      </div>
  </div>
</div>
<?include('inc/scripts.php');?>