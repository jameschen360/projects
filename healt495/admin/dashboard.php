<?include('inc/header.php');?>
<?
	$test = mysqli_num_rows(mysqli_query($db, "SELECT * FROM product"));
    $new_orders = mysqli_num_rows(mysqli_query($db, "SELECT * FROM order_id WHERE status='Completed'"));
    $customer = mysqli_num_rows(mysqli_query($db, "SELECT * FROM customer"));
?>
      <!-- Main-->
      <section>
        <!-- Content-->
        <div class="app">
          <div class="app-view-header">Health Supplements Plus Dashboard</div>
          <div class="row">
            <!-- START dashboard sidebar-->
            <aside class="col-lg-3 fw-boxed">
              <div class="row">
			    <a href="order.php">
                <div class="col-lg-6 col-sm-3 col-xs-6">
                  <div data-ripple="" class="panel panel-default">
                    <div class="panel-body bg-primary">
                      <h1 class="text-thin mt"><?echo $new_orders?></h1>
                      <div class="text-right text-sm text-muted">New Orders</div>
                    </div>
                  </div>
                </div>
				</a>
				
				<a href="customer.php">
                <div class="col-lg-6 col-sm-3 col-xs-6">
                  <div data-ripple="" class="panel panel-default">
                    <div class="panel-body">
                      <h1 class="text-thin mt"><?echo $customer?></h1>
                      <div class="text-right text-sm text-muted">Customers</div>
                    </div>
                  </div>
                </div>
				</a>
				
				<a href="product.php">
                <div class="col-lg-12 col-sm-6 col-xs-12">
                  <div data-ripple="" class="panel panel-default">
                    <div class="panel-body">
                      <h1 class="text-thin mt"><?echo $test?></h1>
                      <div class="text-right text-sm text-muted">Products</div>
                    </div>
                  </div>
                </div>
				</a>
                <div class="col-xs-12">
                  <div class="panel panel-default">
                    <div class="panel-body bg-primary">
                      <h2 class="text-thin mt">USD to RMB</h2>
                        <?
                            $rmb = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM currency_rate WHERE id='2'"));
                            $rmb = $rmb['currency'];
                        ?>
                        1 USD = <?echo $rmb?> CNY (RMB)
                        <sub>Updated every hour</sub>
                    </div>
                  </div>
                </div>
                <div class="col-xs-12">
                  <div class="panel panel-default">
                    <div class="panel-body bg-default">
                      <h2 class="text-thin mt">Add Coupon</h2>
                        <label>Coupon Code:</label>
                        <input type="text" class="form-control" id="coupon_code" name="coupon_code" value="">
                        <labe>Discount:</label>
                        <input type="text" class="form-control" id="coupon_discount" name="coupon_discount" value="">  
                        <labe>Expiry Date:</label>
                        <input type="text" class="form-control" id="coupon_date" name="coupon_date" value="">   
                        <div id="coupon_msg"></div>
                        <button type="button" id="coupon_btn" class="btn btn-default btn-xs pull-right" style="margin-top:12px;">Add Coupon</button>
                    </div>
                  </div>
                </div>                  
              </div>
            </aside>
            <!-- END dashboard sidebar-->		  
            <!-- START dashboard content-->
            <div class="col-lg-9 fw-boxed">
              <!-- START Tabbed panel-->

              <!-- END Tabbed panel-->
              <!-- START Panel-->

              <!-- Datatable for catagories -->
              <div class="dataTable_wrapper">
              <div class="col-lg-12 col-sm-12 col-xs-12">    
				<table class="table table-striped table-bordered table-hover" id="catagory_table">
				<thead>
				    <tr>
				        <th>Invoice</th>
                        <th>Details</th>
				    </tr>
				</thead>
				<tbody>
                    <?
                    $order_sql = mysqli_query($db, "SELECT * FROM order_id WHERE status <> 'Completed'");
                    while ($order_result = mysqli_fetch_assoc($order_sql)) {
                        $order_sql_id = $order_result['id'];
                        $order_sql_invoice = $order_result['invoice'];
                        $order_sql_email = $order_result['user'];
                        $order_sql_date = $order_result['date_created'];
                        $order_sql_status = $order_result['status'];
                    ?>
				    <tr>
				        <td><?echo $order_sql_invoice?></td>                      
                        <td>
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
                
               <!-- Datatable for catagories -->
              <div class="dataTable_wrapper">
              <div class="col-lg-12 col-sm-12 col-xs-12">    
				<table class="table table-striped table-bordered table-hover" id="coupon_table">
				<thead>
				    <tr>
				        <th>Coupon Code</th>
                        <th>Discount</th>
                        <th>Expiry Date</th>
				    </tr>
				</thead>
				<tbody>
                    <?
                    $coupon_sql = mysqli_query($db, "SELECT * FROM coupon");
                    while ($coupon_result = mysqli_fetch_assoc($coupon_sql)) {
                        $coupon_id = $coupon_result['id'];
                        $coupon_code = $coupon_result['code'];
                        $coupon_discount = $coupon_result['discount'];
                        $coupon_expire = $coupon_result['expire'];
                    ?>
				    <tr>
				        <td><?echo $coupon_code?></td>                      
                        <td><?echo $coupon_discount * 100?>%</td>
                        <td><?echo $coupon_expire?></td>  
				    </tr>	                    
                                       
                    <?}

                    ?>														
                </tbody>									
				</table>
              </div>								  
              </div>	
              <!-- /Datatable for catagories -->               
            </div>
            <!-- END dashboard content-->

          </div>
        </div>
      </section>

    </div>
 <?include('inc/scripts.php');?>
  </body>
</html>