<?php
$message .= '<table width="100%" bgcolor="#FFF" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="banner">
<tbody>
   <tr>
      <td>
         <table width="560" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth email-border">
            <tbody>
               <tr>
                  <td width="100%">
                     <table width="560" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth">
                        <tbody>
                           <tr>
                              <!-- start of image -->
                              <td align="center" st-image="banner-image">
                                 <div class="imgpop">
                                    <a target="_blank" href="#"><img width="50%" border="0" height="50%" alt="" border="0" style="display:block; border:none; outline:none; text-decoration:none;" src="'.$logo.'" class="banner"></a>
                                 </div>
                              </td>
                           </tr>
                           <tr>
                               
                           </tr>
                        </tbody>
                     </table>
                     <!-- end of image -->                        
                     <p style="padding:20px 20px 0px 20px"><strong>Hi there, <br></strong> </p>
                     <p style="padding:20px">Someone has submitted a new order with the order ID: <strong>'.$orderID.'</strong>, and is waiting for you to process!</p>
                  </td>
               </tr>
            </tbody>
         </table>
      </td>
   </tr>
</tbody>
</table>
<!-- End of main-banner -->';
?>