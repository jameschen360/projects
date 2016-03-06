<?
include('../inc/db.php');

$id = $_POST['category_id'];
$ename = $_POST['category_ename'];
$zname = $_POST['category_zname'];
$esubname = $_POST['category_esubname'];
$zsubname = $_POST['category_zsubname'];
$edesc = $_POST['category_edesc'];
$zdesc = $_POST['category_zdesc'];

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
      <div id="error_msg"></div>
        <form id="catagory_edit" class="catagory_edit" name="catagory_edit">
          <div class="row">
              <div class="form-group col-lg-6 col-sm-6 col-xs-6 javaremove" style="padding:10px;">
                <label for="ename" class="control-label">English Name:</label>
                <input name="ename" type="text" class="form-control" id="ename" value="<?echo $ename?>" required>
              </div>
              <div class="form-group col-lg-6 col-sm-6 col-xs-6 javaremove" style="padding:10px;">
                <label for="zname" class="control-label">中文目录名:</label>
                <input name="zname" type="text" class="form-control" id="zname"  value="<?echo $zname?>" required>
              </div>              
          </div>
          <div class="row">
              <div class="form-group col-lg-6 col-sm-6 col-xs-6 javaremove" style="padding:10px;margin-top:-15px;">
                <label for="etext" class="control-label">English Text:</label>
                  <textarea class="form-control" id="etext" name="etext" rows="4" required><?echo $edesc?></textarea>
              </div>
              <div class="form-group col-lg-6 col-sm-6 col-xs-6 javaremove" style="padding:10px;margin-top:-15px;">
                <label for="ztext" class="control-label">中文目录解说:</label>
                  <textarea class="form-control" id="ztext" name="ztext" rows="4" required><?echo $zdesc?></textarea>
              </div>              
          </div>            
          <div class="row">
              <div class="form-group col-lg-6 col-sm-6 col-xs-6 javaremove" style="padding:10px;">
                <label for="esub" class="control-label">English Sub: <i class="fa fa-info-circle" data-toggle="info" data-placement="right" title="Please separate submenus by commas ',' make sure the english submenu number match the chinese submenu number"></i></label><strong>
                  <textarea class="form-control" id="esub" name="esub" rows="4" required><?echo $esubname?></textarea>
              </div>
              <div class="form-group col-lg-6 col-sm-6 col-xs-6 javaremove" style="padding:10px;">
                <label for="zsub" class="control-label">中文 Sub: <i class="fa fa-info-circle" data-toggle="info" data-placement="right" title="Please separate submenus by commas ',' make sure the english submenu number match the chinese submenu number"></i></label>
                  <textarea class="form-control" id="zsub" name="zsub" rows="4" required><?echo $zsubname?></textarea>
             </div></strong> 
              <input type="hidden" name="hidden_id" value="<?echo $id?>">
             <button type="button" id="edit_button_catagory" class="btn btn-primary btn-sm pull-right id_edit" style="margin:10px">Update</button>  
          </div>

        </form>
      <?include('inc/scripts.php');?>
    </body>
</html>
