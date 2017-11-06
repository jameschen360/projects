<?php
$orderTableResult = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM order_table WHERE id='$orderID'"));
$deliveryMethod = $orderTableResult['delivery_method'];
$orderTime = $orderTableResult['order_time'];
$store = ucfirst($orderTableResult['store']);

if ($deliveryMethod == "rush") {
      $method = "Rush Delivery";
} else {
      $method = "Regular Delivery";
}

$message .= '<!-- 3-columns -->  
<table width="100%" bgcolor="#fff" cellpadding="0" cellspacing="0" border="0" id="backgroundTable">
   <tbody>
      <tr>
         <td>
            <table width="560" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
               <tbody>
                  <tr>
                     <td width="100%">
                        <table bgcolor="#f1b842" width="560" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                           <tbody>
                              <!-- Spacing -->
                              <tr>
                                 <td height="5" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">&nbsp;</td>
                              </tr>
                              <!-- Spacing -->
                              <tr>
                                 <td>
                                    <table width="520" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidthinner">
                                       <tbody>
                                          <tr>
                                             <td>
                                                <!-- col 1 -->
                                                <table width="160" align="left" border="0" cellpadding="0" cellspacing="0" class="col3img">
                                                   <tbody>
                                                      <!-- image 2 -->
                                                      <tr>
                                                            <p class="default-text-color"><br><strong>Deliver Address: </strong>'.$address.', '.$postal.'</p>
                                                            <p class="default-text-color"><strong>Email: </strong>'.$userEmail.'</p>
                                                            <p class="default-text-color"><strong>Phone: </strong>'.$phone.'<br><br></p>
                                                      </tr>
                                                      <tr>  
                                                            <p class="default-text-color"><strong>Method: </strong>'.$method.'</p>
                                                            <p class="default-text-color"><strong>Ordered Date: </strong>'.$orderTime.'</p>
                                                            <p class="default-text-color"><strong>Store: </strong>'.$store.'</p>
                                                      </tr>
                                                      <!-- end of image2 -->
                                                   </tbody>
                                                </table>

                                             </td>
                                          </tr>
                                       </tbody>
                                    </table>
                                 </td>
                              </tr>
                              <!-- Spacing -->
                              <tr>
                                 <td height="20" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">&nbsp;</td>
                              </tr>
                              <!-- Spacing -->
                           </tbody>
                        </table>
                     </td>
                  </tr>
               </tbody>
            </table>
         </td>
      </tr>
   </tbody>
</table>
<!-- end of 3-columns -->';

$cartInfoQuery = mysqli_query($db, "SELECT * FROM cart_table WHERE order_id='$orderID'");
while ($row = mysqli_fetch_assoc($cartInfoQuery)) {
      $productID = $row['item_id'];
      $amount = $row['amount'];
      $description = $row['description'];
      $isCustom = $row['isCustom'];
      $isCustomUnit = $row['isCustomUnit'];

      if ($isCustom == 0) {//not custom
            $productResult = mysqli_fetch_assoc(mysqli_query($db, "SELECT product_name FROM product_table WHERE id='$productID'"));
            $productName = $productResult['product_name'];
           
      } else {
            $productName = $productID;
      }

      if ($isCustomUnit == "") {
            $productResult = mysqli_fetch_assoc(mysqli_query($db, "SELECT unit FROM product_table WHERE id='$productID'"));
            $unit = $productResult['unit'];           
      } else {
            $unit = $isCustomUnit;
      }

      
      $message .= '
      <!-- leftimage -->
      <table width="100%" bgcolor="#fff" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="left-image">
         <tbody>
            <tr>
               <td>
                  <table width="560" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                     <tbody>
                        <tr>
                           <td width="100%">
                              <table bgcolor="#ffffff" width="560" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth email-border">
                                 <tbody>
                                    <!-- Spacing -->
                                    <tr>
                                       <td height="14" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">&nbsp;</td>
                                    </tr>
                                    <!-- Spacing -->
                                    <tr>
                                       <td>
                                          <table width="520" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                                             <tbody>
                                                <tr>
                                                   <td>
                                                      <!-- start of right column -->
                                                      <table width="60%" align="left" border="0" cellpadding="0" cellspacing="0" class="devicewidthmob">
                                                         <tbody>
                                                            <tr>
                                                               <td style="font-family: Helvetica, arial, sans-serif; font-size: 18px; color: #f1b842; text-align:left; line-height: 24px;" class="padding-top-right15">
                                                                  '.$productName.'
                                                               </td>
                                                            </tr>
                                                            <!-- end of title -->
                                                            <!-- Spacing -->
                                                            <tr>
                                                               <td width="100%" height="1" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">&nbsp;</td>
                                                            </tr>
                                                            <!-- /Spacing -->
                                                            <!-- content -->
                                                            <tr>
                                                               <td style="font-family: Helvetica, arial, sans-serif; font-size: 14px; color: #7a6e67; text-align:left; line-height: 24px;" class="padding-right15">
                                                                  '.$description.'
                                                               </td>
                                                            </tr>
                                                            <!-- end of content -->
                                                            <!-- content -->
                                                         </tbody>
                                                      </table>
                                                      <!-- end of right column -->
                                                      <!-- start of right column -->
                                                      <table width="20%" align="right" border="0" cellpadding="0" cellspacing="0" class="devicewidthmob">
                                                         <tbody>
                                                            <tr>
                                                               <td style="font-family: Helvetica, arial, sans-serif; font-size: 18px; color: #f1b842; text-align:left; line-height: 24px;" class="padding-top-right15">
                                                                  Unit
                                                               </td>
                                                            </tr>
                                                            <!-- end of title -->
                                                            <!-- Spacing -->
                                                            <tr>
                                                               <td width="100%" height="1" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">&nbsp;</td>
                                                            </tr>
                                                            <!-- /Spacing -->
                                                            <!-- content -->
                                                            <tr>
                                                               <td style="font-family: Helvetica, arial, sans-serif; font-size: 14px; color: #7a6e67; text-align:left; line-height: 24px;" class="padding-right15">
                                                                  '.$unit.' 
                                                               </td>
                                                            </tr>
                                                            <!-- end of content -->
                                                            <!-- content -->
                                                         </tbody>
                                                      </table>
                                                      <!-- end of right column -->
                                                      <!-- start of right column -->
                                                      <table width="20%" align="right" border="0" cellpadding="0" cellspacing="0" class="devicewidthmob">
                                                         <tbody>
                                                            <tr>
                                                               <td style="font-family: Helvetica, arial, sans-serif; font-size: 18px; color: #f1b842; text-align:left; line-height: 24px;" class="padding-top-right15">
                                                                  Amount
                                                               </td>
                                                            </tr>
                                                            <!-- end of title -->
                                                            <!-- Spacing -->
                                                            <tr>
                                                               <td width="100%" height="1" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">&nbsp;</td>
                                                            </tr>
                                                            <!-- /Spacing -->
                                                            <!-- content -->
                                                            <tr>
                                                               <td style="font-family: Helvetica, arial, sans-serif; font-size: 14px; color: #7a6e67; text-align:left; line-height: 24px;" class="padding-right15">
                                                                  '.$amount.'
                                                               </td>
                                                            </tr>
                                                            <!-- end of content -->
                                                            <!-- content -->
                                                         </tbody>
                                                      </table>
                                                      <!-- end of right column -->
                                                   </td>
                                                </tr>
                                             </tbody>
                                          </table>
                                       </td>
                                    </tr>
                                    <!-- Spacing -->
                                    <tr>
                                       <td height="14" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">&nbsp;</td>
                                    </tr>
                                    <!-- Spacing -->
                                      <!-- Spacing -->
                                      <tr>
                                          <td height="2" bgcolor="#f1b842" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">&nbsp;</td>
                                      </tr>
                                      <!-- Spacing -->                              
                                 </tbody>
                              </table>
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </td>
            </tr>
         </tbody>
      </table>
      <!-- end of left image -->';
}

?>