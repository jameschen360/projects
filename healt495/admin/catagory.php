<?
include('inc/header.php');?>
<?

$catagory_sql = mysqli_query($db, "SELECT * FROM catagory");
?>
      <!-- Main-->
      <section>
        <!-- Content-->
        <div class="app">
          <div class="app-view-header">Categories<button id="catagory_add" class="btn btn-success btn-xs" data-toggle="modal" data-target="#catagory_add_modal">Add New Category</button><hr></div>
          <div class="row">
              
              <!-- Datatable for catagories -->
              <div class="dataTable_wrapper">
              <div class="col-lg-12 col-sm-12 col-xs-12">    
				<table class="table table-striped table-bordered table-hover" id="customer_table">
				<thead>
				    <tr>
				        <th>Categories</th>
                        <th>Categories（中文）</th>
                        <th>Subcategories</th>
                        <th>Details</th>
				    </tr>
				</thead>
				<tbody>
                    <?
                    while ($catagory_result = mysqli_fetch_assoc($catagory_sql)) {
                        $catagory_sql_id = $catagory_result['id'];
                        $catagory_sql_name = $catagory_result['name'];
                        $catagory_sql_zh_name = $catagory_result['zh_name'];
                        $catagory_sql_subname = $catagory_result['subname'];
                        $catagory_sql_zh_subname = $catagory_result['zh_subname'];
                        $catagory_sql_zh_name = $catagory_result['zh_name'];
                        $catagory_sql_sub = $catagory_result['sub']; 
                        $catagory_sql_desc = $catagory_result['desc']; 
                        $catagory_sql_zh_desc = $catagory_result['zh_desc']; 
                    ?>
				    <tr>
				        <td><?echo $catagory_sql_name;?></td>
                        <td><?echo $catagory_sql_zh_name;?></td>
                        <td><p data-toggle="info" data-placement="top" title="<?echo $catagory_sql_subname?>,<?echo $catagory_sql_zh_subname?>"><?echo $catagory_sql_sub;?></p></td>
                         <form action="iframe_cata.php" target="my-iframe" method="post">
                             <input type="hidden" name="category_id" value="<?echo $catagory_sql_id?>">
                             <input type="hidden" name="category_ename" value="<?echo $catagory_sql_name?>">
                             <input type="hidden" name="category_zname" value="<?echo $catagory_sql_zh_name?>">
                             <input type="hidden" name="category_esubname" value="<?echo $catagory_sql_subname?>">
                             <input type="hidden" name="category_zsubname" value="<?echo $catagory_sql_zh_subname?>">
                             <input type="hidden" name="category_zdesc" value="<?echo $catagory_sql_zh_desc?>">
                             <input type="hidden" name="category_edesc" value="<?echo $catagory_sql_desc?>">
    				        <td><input type="submit" class="btn btn-sm btn-default catagory_detail" value="Edit" data-toggle="modal" data-target="#iframe_modal">
                                
                            <input type="submit" id="<?echo "$catagory_sql_id"?>" class="catagory_delete btn btn-sm btn-default" value="Delete" data-toggle="modal" data-target="#<?echo "delete_$catagory_sql_id"?>"> 
                             
                            </td>          
                        </form>                       
                        <div class="modal fade modal_login_style" id="<?echo "delete_$catagory_sql_id"?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                          <div class="modal-content modal-dialog modal-sm">
                              <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                  <h4 class="modal-title text-center" id="modalla">Deleting <?echo "$catagory_sql_name/$catagory_sql_zh_name"?></span></h4>
                                  <input type="hidden" id="hidden_id" value="<?echo $catagory_sql_id;?>">
                              </div>
                              <div class="modal-body"> 
                                <div id="delete_category_msg" class="text-center">Please remove products that is under <?echo "$catagory_sql_name/$catagory_sql_zh_name"?></div>
                              </div>
                              <div class="modal-footer"> 
                                <input type="button" id="modal_hide" class="modal_hide_delete btn btn-success btn-xs" value="Okay">
                              </div>
                          </div>
                        </div>
				    </tr>	                    
                                       
                    <?}

                    ?>														
                </tbody>									
				</table>
              </div>								  
              </div>	
              <!-- /Datatable for catagories -->
		  </div>
		</div>
    </section> 


<div class="modal fade modal_login_style" id="iframe_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-content modal-dialog modal-lg">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title" id="modalla">Editing Categories<span id="edit_msg"></span></h4>
          <input type="hidden" id="hidden_id" value="<?echo $catagory_sql_id;?>">
      </div>
      <div class="modal-body"> 
        <iframe name="my-iframe" src="iframe_cata.php" width="100%" frameborder="0" onload='resizeIframe(this)'></iframe>
      </div>
  </div>
</div> 
<div class="modal fade modal_login_style" id="catagory_add_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-content modal-dialog modal-lg">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title" id="modalla">Add Category <span id="add_msg"></span></h4>
      </div>
      <div class="modal-body">
        <form id="catagory_post" class="catagory_post" name="catagory_post">
            
          <div class="row">
              <div class="form-group col-lg-6 col-sm-6 col-xs-6 javaremove" style="padding:10px;">
                <label for="ename" class="control-label">English Name:</label>
                <input type="text" class="form-control" id="ename" name="ename" value="" required>
              </div>
              <div class="form-group col-lg-6 col-sm-6 col-xs-6 javaremove" style="padding:10px;">
                <label for="zname" class="control-label">中文目录名:</label>
                <input type="text" class="form-control" id="zname" name="zname" value="" required>
              </div>              
          </div>
          <div class="row">
              <div class="form-group col-lg-6 col-sm-6 col-xs-6 javaremove" style="padding:10px;margin-top:-15px;">
                <label for="etext" class="control-label">English Text:</label>
                  <textarea class="form-control" id="etext" name="etext" required></textarea>
              </div>
              <div class="form-group col-lg-6 col-sm-6 col-xs-6 javaremove" style="padding:10px;margin-top:-15px;">
                <label for="ztext" class="control-label">中文目录解说:</label>
                  <textarea class="form-control" id="ztext" name="ztext" required></textarea>
              </div>              
          </div>            
            
 
          <div class="row" style="padding:10px;margin-top:-15px;">
              <p>Subcatagory: <a href="#" data-toggle="info" data-placement="right" title="This is for english subcatagory only"><i class="fa fa-info-circle"></i></a></p>
            <div class="multi-field-wrapper javaremove">
              <div class="multi-fields">
                <div class="multi-field">
                  <input type="text" id="sub_1" class="form-control" name="stuff[]" value="" style="margin-bottom:3px;">
                </div>
              </div>

                <button type="button" class="add-field btn btn-success btn-sm" style="margin-top:10px;">Add another subcategory</button>
                <button type="button" id="add_catagory" class="btn btn-primary btn-sm pull-right" style="margin-top:10px;">Add</button>

            </div>          
          </div>
     
        </form>  
          
      </div>
  </div>
</div>

<?include('inc/scripts.php');?>