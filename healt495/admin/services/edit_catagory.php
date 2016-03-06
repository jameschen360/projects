<?php
include('../inc/db.php');
//grab all post variables
$ename = mysqli_real_escape_string($db,strip_tags($_POST['ename']));
$zname = mysqli_real_escape_string($db,strip_tags($_POST['zname']));
$etext = mysqli_real_escape_string($db,htmlspecialchars($_POST['etext']));
$ztext = mysqli_real_escape_string($db,htmlspecialchars($_POST['ztext']));
$esub = mysqli_real_escape_string($db,strip_tags($_POST['esub']));
$zsub = mysqli_real_escape_string($db,strip_tags($_POST['zsub']));
$id = mysqli_real_escape_string($db,strip_tags($_POST['hidden_id']));

$esub = rtrim($esub, ",");
$zsub = rtrim($zsub, ",");
$zsub_ex = explode(',' , $zsub);
$esub_ex = explode(',' , $esub);

$z_count = count(explode(',' , $esub));
$e_count = count(explode(',' , $zsub));



if (!empty($ename)) {
    if (!empty($zname)) {
        if (!empty($etext)) {
            if (!empty($ztext)) {
                if (!empty($esub)) {
                    if (!empty($zsub)) {
                        if ($z_count == $e_count) {                          

                                $product_num_result = mysqli_num_rows(mysqli_query($db, "SELECT * FROM product WHERE legacy <> 'yes' AND catagory_main='$ename'"));
              
                                if ($arraysum != 0) {
                                    echo "<span class=\"pull-left\" style=\"color:red;\">Please delete all products under $ename to modify this catagory!</span><br/>";
                                }else {
                                   $check = mysqli_query($db, "UPDATE catagory SET `name`='$ename',`zh_name`='$zname',`sub`='$z_count',`subname`='$esub',`zh_subname`='$zsub',`desc`='$etext',`zh_desc`='$ztext' WHERE id='$id'"); 
                                    echo "success";
                                }
                            
                            
                        }else {
                            echo "<span class=\"pull-left\" style=\"color:red;\">Make sure English and Chinese submenu has the same number of entries</span><br/>";                             
                        }    
                    }else {
                        echo "<span class=\"pull-left\" style=\"color:red;\">Chinese submenus cannot be blank</span><br/>"; 
                    }
                }else {
                    echo "<span class=\"pull-left\" style=\"color:red;\">English submenus cannot be blank</span><br/>"; 
                }
            }else {
                echo "<span class=\"pull-left\" style=\"color:red;\">Chinese text cannot be blank</span><br/>"; 
            }
        }else {
            echo "<span class=\"pull-left\" style=\"color:red;\">English text cannot be blank</span><br/>"; 
        }
    }else {
       echo "<span class=\"pull-left\" style=\"color:red;\">Chinese name cannot be blank</span><br/>"; 
    }   
}else {
    echo "<span class=\"pull-left\" style=\"color:red;\">English name cannot be blank</span><br/>";
}

?>