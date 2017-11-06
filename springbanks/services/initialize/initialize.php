<?php
    include("../../inc/db.php");
    session_start();
    $clientUser_id = mysqli_real_escape_string($db,$_POST['user_id']);
    $sessionUser_id = $_SESSION['login_user'];
    $status = "New"; //ordering status

    //initial check for existing cart
    if ($clientUser_id == $sessionUser_id && !isset($_POST['deliveryMethod']) && !isset($_POST['store']) && !isset($_POST['mainCategory'])) {
        $checkExist = "SELECT * FROM order_table WHERE user_id='$clientUser_id' AND status='$status'";
        $queryCheckExist = mysqli_query($db, $checkExist);
        $resultCheckExist = mysqli_fetch_assoc($queryCheckExist);
        $checkExistRow = mysqli_num_rows($queryCheckExist);

        $previousFilterPosition = "SELECT * FROM last_filter_position WHERE user_id='$clientUser_id'";
        $queryPreviousFilterPosition = mysqli_query($db, $previousFilterPosition);
        $resultPreviousFilterPosition = mysqli_fetch_assoc($queryPreviousFilterPosition);

        if ($checkExistRow >= 1) {
            $deliveryMethod = $resultCheckExist['delivery_method'];
            $store = $resultCheckExist['store'];
            $previousCategory = $resultPreviousFilterPosition['category'];

            echo json_encode(array(
                'deliveryMethod' => $deliveryMethod,
                'store' => $store,
                'mainCategory' => $previousCategory
              ));
        } else {
            echo "new";//is new order
        }
    }

    /////// adding new cart to database
    $deliveryMethod = mysqli_real_escape_string($db,$_POST['deliveryMethod']);
    $store = mysqli_real_escape_string($db,$_POST['store']);
    $mainCategory = mysqli_real_escape_string($db,$_POST['mainCategory']);

    if (isset($_POST['deliveryMethod']) && isset($_POST['store']) && isset($_POST['mainCategory']) ) {
        if ($clientUser_id == $sessionUser_id) {
            $insert_query = "INSERT INTO order_table (delivery_method, status, user_id, store) VALUES ('$deliveryMethod', 'New', '$clientUser_id', '$store')";
            mysqli_query($db, $insert_query);

            $insert_query = "INSERT INTO last_filter_position (user_id, category) VALUES ('$clientUser_id', '$mainCategory')";
            mysqli_query($db, $insert_query);
            
            ////////////initializing main content
            $queryCategory = "SELECT * FROM category_table WHERE category='$mainCategory'";
            $queryCategory = mysqli_query($db, $queryCategory);
            $queryCategoryNum = mysqli_num_rows($queryCategory);
            $subCategory = array();$i=0;
            while ($resultCategory = mysqli_fetch_assoc($queryCategory)) {
                $subCategory[$i] = $resultCategory['subcategory'];
                $i++;
            };
            ///needs work
            echo $subCategory;


        }
    }

    $existingCart = mysqli_real_escape_string($db,$_POST['existingCart']);       
    if ($clientUser_id == $sessionUser_id && $existingCart == "yes") {
        $checkCategoryQueryString = "SELECT * FROM mainCategory WHERE category='$mainCategory'";
        $checkCategoryNum = mysqli_num_rows(mysqli_query($db, $checkCategoryQueryString));

        if ($checkCategoryNum == 1) {
            $queryCategory = "SELECT * FROM category_table WHERE category='$mainCategory' ORDER BY sort ASC, subcategory";
            $queryCategory = mysqli_query($db, $queryCategory);
            $queryCategoryNum = mysqli_num_rows($queryCategory);
            $i=0;
            while ($resultCategory = mysqli_fetch_assoc($queryCategory)) {
                $subCategory[$i] = $resultCategory['subcategory'];
                $i++;
            };
    
            $content_result = mysqli_query($db, "SELECT * FROM product_table WHERE category='$mainCategory' ORDER BY sort ASC, subcategory");
            $data = [];
            $i=0;
            while ($row = $content_result->fetch_array()) {
                $data[] = $row;	
            }
    
            echo json_encode(array(
                'subCategory' => $subCategory,
                'contentInfo' => $data
              ));
            
            $content_result->close();
        } else {
            echo "error";
        }
    }

    $newCart = mysqli_real_escape_string($db,$_POST['newCart']);       
    if ($clientUser_id == $sessionUser_id && $newCart == "yes") {
        $checkCategoryQueryString = "SELECT * FROM mainCategory WHERE category='$mainCategory'";
        $checkCategoryNum = mysqli_num_rows(mysqli_query($db, $checkCategoryQueryString));

        if ($checkCategoryNum == 1) {
            mysqli_query($db, "UPDATE last_filter_position SET isDeliveryModal = 'yes', isCategoryModal = 'yes' WHERE user_id = '$clientUser_id'");
    
            $queryCategory = "SELECT * FROM category_table WHERE category='$mainCategory' ORDER BY sort ASC, subcategory";
            $queryCategory = mysqli_query($db, $queryCategory);
            $queryCategoryNum = mysqli_num_rows($queryCategory);
            $i=0;
            while ($resultCategory = mysqli_fetch_assoc($queryCategory)) {
                $subCategory[$i] = $resultCategory['subcategory'];
                $i++;
            };
    
            $content_result = mysqli_query($db, "SELECT * FROM product_table WHERE category='$mainCategory' ORDER BY sort ASC, subcategory");
            $data = [];
            $i=0;
            while ($row = $content_result->fetch_array()) {
                $data[] = $row;	
            }
    
            echo json_encode(array(
                'subCategory' => $subCategory,
                'contentInfo' => $data,
                'isDeliveryModal' => 'yes',
                'isCategoryModal' => 'yes'
    
              ));
            
            $content_result->close();
        } else {
            echo "error";
        }
    }
    
?>