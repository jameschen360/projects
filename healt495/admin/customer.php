<?include('inc/header.php');
$customer_sql = mysqli_query($db, "SELECT * FROM customer");
?>

      <!-- Main-->
      <section>
        <!-- Content-->
        <div class="app">
          <div class="app-view-header">Customers</div>
          <div class="row">
		  
              <!-- Datatable for catagories -->
              <div class="dataTable_wrapper">
              <div class="col-lg-12 col-sm-12 col-xs-12">    
				<table class="table table-striped table-bordered table-hover" id="catagory_table">
				<thead>
				    <tr>
				        <th>Name</th>
                        <th>Email</th>
                        <th>Details</th>
				    </tr>
				</thead>
				<tbody>
                    <?
                    while ($customer_result = mysqli_fetch_assoc($customer_sql)) {
                        $customer_sql_id = $customer_result['id'];
                        $customer_sql_fname = $customer_result['first_name'];
                        $customer_sql_lname = $customer_result['last_name'];
                        $customer_sql_email = $customer_result['email'];
                        $customer_sql_address = $customer_result['address'];
                        $customer_sql_city = $customer_result['city'];
                        $customer_sql_country = $customer_result['country'];
                        $customer_sql_province = $customer_result['province'];
                        $customer_sql_phone = $customer_result['phone'];
                        $customer_sql_zh = $customer_result['zh'];
                        $customer_sql_postal = $customer_result['postal_code'];

                        if ($customer_sql_zh == "yes") {
                           $name =  "$customer_sql_lname$customer_sql_fname";
                        }else {
                           $name =   "$customer_sql_fname $customer_sql_lname";
                        }
                    ?>
				    <tr>
				        <td><?echo $name?></td>
                        <td><?echo $customer_sql_email;?></td>
                        <td>

                        <input type="submit" class="btn btn-sm btn-default catagory_detail" value="View" data-toggle="modal" data-target="#modal_<?echo $customer_sql_id?>">
                        <div class="modal fade modal_login_style" id="modal_<?echo $customer_sql_id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                          <div class="modal-content modal-dialog modal-lg">
                              
                        <div class="panel-heading">
                              <h3 class="panel-title"><?echo $name?> Customer Details
                              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>                
                                </h3>
                            </div>
                            <div class="panel-body">
                              <div class="row">                
                                <div class=" col-md-12 col-lg-12 "> 
                                  <table class="table table-user-information">
                                    <tbody>
                                      <tr>
                                        <td>Name:</td>
                                        <td><?echo $name?></td>
                                      </tr>
                                      <tr>
                                        <td>Email:</td>
                                        <td><a href="mailto:<?echo $customer_sql_email?>"><?echo $customer_sql_email?></a></td>
                                      </tr>
                                      <tr>
                                        <td>Address:</td>
                                        <td><?echo $customer_sql_address?></td>
                                      </tr>

                                         <tr>
                                             <tr>
                                        <td>City:</td>
                                        <td><?echo $customer_sql_city?></td>
                                      </tr>
                                        <tr>
                                        <td>Province:</td>
                                        <td><?echo $customer_sql_province?></td>
                                      </tr>
                                      <tr>
                                        <td>Country:</td>
                                        <td><?echo $customer_sql_country?></td>
                                      </tr>  
                                      <tr>
                                        <td>Postal Code:</td>
                                        <td><?echo $customer_sql_postal?></td>
                                      </tr>                                          
                                        <td>Others:</td>
                                        <td>
                                            <?
                                            if ($customer_sql_zh == "yes") {
                                                echo "This customer registered via the Chinese web portion";
                                            }else {
                                                echo "N/A";
                                            }
                                            ?>
                                        </td>

                                      </tr>

                                    </tbody>
                                  </table>
                                                                        
                                <div class="row" style="margin:10px;">
                                  <input type="button" id="confirm_button" class="btn btn-primary pull-right" value="Delete Customer"></div>
                                
                                  <div class="row" style="margin:10px;"><input type="button" id="<?echo $customer_sql_id?>" class="delete_customer btn btn-primary btn-xs pull-right" value="Confirm"></div>
                                </div>
                              </div>
                            </div>
            

                              </div>
                        </div>                         
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
<?include('inc/scripts.php');?>