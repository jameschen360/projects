<?php
$message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">';

$message .= '   <head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Springbank Delivery Emailing</title>
<style type="text/css">
   /* Client-specific Styles */
   #outlook a {padding:0;} /* Force Outlook to provide a "view in browser" menu link. */
   body{width:100% !important; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; margin:0; padding:0;}
   /* Prevent Webkit and Windows Mobile platforms from changing default font sizes, while not breaking desktop design. */
   .ExternalClass {width:100%;} /* Force Hotmail to display emails at full width */
   .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;} /* Force Hotmail to display normal line spacing. */
   #backgroundTable {margin:0; padding:0; width:100% !important; line-height: 100% !important;}
   img {outline:none; text-decoration:none;border:none; -ms-interpolation-mode: bicubic;}
   a img {border:none;}
   .image_fix {display:block;}
   p {margin: 0px 0px !important;}
   table td {border-collapse: collapse;}
   table { border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; }
   a {color: #0f8aca;text-decoration: none;text-decoration:none!important;}
   /*STYLES*/
   table[class=full] { width: 100%; clear: both; }
   /*IPAD STYLES*/
   @media only screen and (max-width: 20px) {
   a[href^="tel"], a[href^="sms"] {
   text-decoration: none;
   color: #0a8cce; /* or whatever your want */
   pointer-events: none;
   cursor: default;
   }
   .mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {
   text-decoration: default;
   color: #0a8cce !important;
   pointer-events: auto;
   cursor: default;
   }
   table[class=devicewidth] {width: 440px!important;text-align:center!important;}
   table[class=devicewidthmob] {width: 420px!important;text-align:center!important;}
   table[class=devicewidthinner] {width: 420px!important;text-align:center!important;}
   img[class=banner] {width: 440px!important;height:157px!important;}
   img[class=col2img] {width: 440px!important;height:330px!important;}
   table[class="cols3inner"] {width: 100px!important;}
   table[class="col3img"] {width: 131px!important;}
   img[class="col3img"] {width: 131px!important;height: 82px!important;}
   table[class="removeMobile"]{width:10px!important;}
   img[class="blog"] {width: 420px!important;height: 162px!important;}
   }

   /*IPHONE STYLES*/
   @media only screen and (max-width: 20px) {
   a[href^="tel"], a[href^="sms"] {
   text-decoration: none;
   color: #0a8cce; /* or whatever your want */
   pointer-events: none;
   cursor: default;
   }
   .mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {
   text-decoration: default;
   color: #0a8cce !important; 
   pointer-events: auto;
   cursor: default;
   }
   table[class=devicewidth] {width: 280px!important;text-align:center!important;}
   table[class=devicewidthmob] {width: 260px!important;text-align:center!important;}
   table[class=devicewidthinner] {width: 260px!important;text-align:center!important;}
   img[class=banner] {width: 280px!important;height:100px!important;}
   img[class=col2img] {width: 280px!important;height:210px!important;}
   table[class="cols3inner"] {width: 260px!important;}
   img[class="col3img"] {width: 280px!important;height: 175px!important;}
   table[class="col3img"] {width: 280px!important;}
   img[class="blog"] {width: 260px!important;height: 100px!important;}
   td[class="padding-top-right15"]{padding:15px 15px 0 0 !important;}
   td[class="padding-right15"]{padding-right:15px !important;}
   }
   @media only screen and (min-width: 640px) {
       .footer-center {
           width: 440px!important;
           text-align: center!important;
       }
   }
   @media only screen and (max-width: 640px) {
       .footer-center {
           width: 440px!important;
           text-align: center!important;
       }
   }
   .default-text-color {
       color: #fffaec;
   }
   .email-border {
      border-style: solid;
      border-left-width: 1px;
      border-right-width: 1px;
      border-color: #FABE4E;
   }
</style>
</head>';

$message .= '<!-- Start of footer -->
<table width="100%" bgcolor="#fff" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="footer">
    <tbody>
        <tr>
            <td>
                <table width="560" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth email-border">
                <tbody>
                    <tr>
                        <td width="100%">
                            <table bgcolor="#f1b842" width="560" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                            <tbody>
                                <!-- Spacing -->
                                <tr>
                                    <td height="10" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">&nbsp;</td>
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
<!-- End of footer -->';
?>