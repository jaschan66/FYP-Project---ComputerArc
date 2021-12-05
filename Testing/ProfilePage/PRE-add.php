<?php
        $PREPrice       = $_POST['PREprice'];
        $PRECategory    = $_POST['PREcategory'];
        $PREName        = $_POST['PREname'];
        $PREDesc        = $_POST['PREdesc'];
        $PREStock       = $_POST['PREstock'];
        $PREImage          = "";
        $PREStatus      = 2;
        if(!empty($_FILES['PREpic']['tmp_name'])){
            $PREImage       = addslashes(file_get_contents($_FILES['PREpic']['tmp_name']));
        }
        $err = "";
        

        if ($PREName == "") {
            $err .= "-Missing Name \n";
        }

        if ($PREPrice == "") {
            $err .= "-Missing Price \n";
        }
        
        if (!preg_match("/^\d{0,8}(.\d{1,4})?$/",$PREPrice)) {
            $err .= "-Invalid Price Format \n";
        }
        
        if (!is_numeric($PREStock)){
            $err .= "-The stock should only include number\n";
        }
        
        if ($PREImage == "") {
            $err .= "-Please insert image \n";
        }

        if (empty($err)) {
            include "..\includes\dbh.inc.php";
            session_start();
            $email   = $_SESSION['email'];
            $role    = $_SESSION['role'];
            $resultPREID    = mysqli_query($conn, "SELECT * FROM `$role` WHERE email ='$email'");
            
            if (mysqli_num_rows($resultPREID) > 0) {
                $Getresult = mysqli_fetch_assoc($resultPREID);
                $GetOwnerID = $Getresult['id'];
            }
            
            $InsertPRE = "INSERT INTO `prebuildpc` (`price`, `category`, `name`, `description`, `stock`, `image`, `status`, `seller`) VALUES ('$PREPrice', '$PRECategory', '$PREName', '$PREDesc', '$PREStock', '$PREImage', '$PREStatus', '$GetOwnerID')";

            header("Location: ../includes/generateApproval.php?adminType=2&itemType=2&itemName=$PREName");
            
            if (mysqli_query($conn, $InsertPRE)) {
                echo "Pre-Build PC created successfuly!";
            } else {
                echo "Error occured: " . mysqli_error($conn);
            }
            
        } else {
            echo "$err";
        }

    ?>