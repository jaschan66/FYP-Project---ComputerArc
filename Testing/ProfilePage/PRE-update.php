<?php
 $updatePREname = $_POST['updatePREname'];
 $updatePREprice = $_POST['updatePREprice'];
 $updatePREcategory = $_POST['updatePREcategory'];
 $updatePREstock = $_POST['updatePREstock'];
 $updatePREdesc = $_POST['updatePREdesc'];
 $updatePREID = $_POST['updatePREID'];

 $queryWithUpdatePicture = "";
 if ($_FILES['updatePREpic']['size'] > 0) {
     $updatePREpic = addslashes(file_get_contents($_FILES['updatePREpic']['tmp_name']));
     $queryWithUpdatePicture = ", image = '$updatePREpic'";
 }

 $updateQuery = "UPDATE prebuildpc SET name = '$updatePREname', price = '$updatePREprice', category = '$updatePREcategory', stock = '$updatePREstock',
  description = '$updatePREdesc' $queryWithUpdatePicture WHERE id = '$updatePREID'";

        $err = "";
        

        if ($updatePREname == "") {
            $err .= "-Missing Name \n";
        }

        if ($updatePREprice == "") {
            $err .= "-Missing Price \n";
        }
        
        if (!preg_match("/^\d{0,8}(.\d{1,4})?$/",$updatePREprice)) {
            $err .= "-Invalid Price Format \n";
        }
        
        if (!is_numeric($updatePREstock)){
            $err .= "-The stock should only include number\n";
        }

        if (empty($err)) {
            include "..\includes\dbh.inc.php";
           
            
            $updateQuery = "UPDATE prebuildpc SET name = '$updatePREname', price = '$updatePREprice', category = '$updatePREcategory', stock = '$updatePREstock',
            description = '$updatePREdesc' $queryWithUpdatePicture WHERE id = '$updatePREID'";
            
            if (mysqli_query($conn, $updateQuery)) {
                echo "Pre-Build PC updated successfuly!";
            } else {
                echo "Error occured: " . mysqli_error($conn);
            }
            
        } else {
            echo "$err";
        }

    ?>