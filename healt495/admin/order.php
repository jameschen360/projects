<?include('inc/header.php');
$order_sql = mysqli_query($db, "SELECT * FROM order_id ORDER BY date_created DESC");
?>

      <!-- Main-->
      <section>
        <!-- Content-->
        <div class="app">
          <div class="app-view-header">Orders</div>
          <div class="row">
              <!-- Datatable for catagories -->
              <div class="dataTable_wrapper">
              <div class="col-lg-12 col-sm-12 col-xs-12">    
				<table class="table table-striped table-bordered table-hover" id="catagory_table">
				<thead>
				    <tr>
				        <th>Invoice</th>
                        <th>Order Date</th>
                        <th>Email</th>
                        <th>Details</th>
				    </tr>
				</thead>
				<tbody>
                    <?
                    while ($order_result = mysqli_fetch_assoc($order_sql)) {
                        $order_sql_id = $order_result['id'];
                        $order_sql_invoice = $order_result['invoice'];
                        $order_sql_email = $order_result['user'];
                        $order_sql_date = $order_result['date_created'];
                        $order_sql_status = $order_result['status'];
                    ?>
				    <tr>
				        <td><?echo $order_sql_invoice?></td>
                        <td><?echo $order_sql_date;?></td>
				        <td><?echo $order_sql_email?></td>                        
                        <td>
                        <form action="iframe_order.php" target="order_iframe" method="POST">
                        <input type="hidden" name="order_id" value="<?echo $order_sql_invoice?>">
                        <input type="hidden" name="user_email" value="<?echo $order_sql_email?>">
                        <input type="submit" class="btn btn-sm btn-default catagory_detail" value="View" data-toggle="modal" data-target="#iframe_modal_order">  
                        </form>
                        <?
                            if ($order_sql_status == "Shipped") {?>
                        <select id="<?echo $order_sql_invoice?>" class="form-control order_status"  disabled>
                            <option value="Shipped">Shipped</option>
                        </select>                                
                        <?    }else {?>
                        <select id="<?echo $order_sql_invoice?>" class="form-control order_status">
                            <option value="<?echo $order_sql_status?>" selected><?echo $order_sql_status?></option> 
                            <option value="Shipped">Shipped</option>
                        </select>                                
                        <?    }    
                        ?>
                        <span id="msg_<?echo $order_sql_invoice?>"></span>
                       </td>     
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
          
<div class="modal fade modal_login_style" id="iframe_modal_order" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-content modal-dialog modal-lg">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title" id="modalla">Editing Categories<span id="edit_msg"></span></h4>
          <input type="hidden" id="hidden_id" value="<?echo $catagory_sql_id;?>">
      </div>
      <div class="modal-body"> 
        <iframe name="order_iframe" src="iframe_order.php" width="100%" height="750px" frameborder="0"></iframe>
      </div>
  </div>
</div>
          
<?include('inc/scripts.php');?>