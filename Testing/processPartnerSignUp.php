<?php

include "includes/dbh.local.inc.php";

            $partnerEmail = $_POST['partneremail'];
            $partnerPass = $_POST['partnerpassword'];
            $partnerUsername = $_POST['partnerusername'];
            $partnerTelno = $_POST['partnertelno'];
            $partnerFaxNo = $_POST['partnerfaxno'];
           
            $partnerStatus = 1;
            $partnerJoineddate = date("Y/m/d");

            $sqlcheckdupname = mysqli_query($conn, "SELECT * FROM `partner` WHERE name ='$partnerUsername'");



            $err= "";

            if ($_FILES['partnerprofilepic']['size'] > 0) {
                $partnerProfilepic = addslashes(file_get_contents($_FILES['partnerprofilepic']['tmp_name']));
            }
            else{
                $err.="-Image should not be empty\n";
            }

            if (mysqli_num_rows($sqlcheckdupname) > 0){
                $err.="-Username has already been used\n";
            }

            if (!filter_var($partnerEmail, FILTER_VALIDATE_EMAIL)) {
                $err = "-Invalid email format\n";
              }
    
            if ($partnerTelno == "") {
                $err .= "-Missing Tel No \n";
            }

            if (!filter_var($partnerTelno, FILTER_SANITIZE_NUMBER_INT)) {
                $err .= "-Invalid Tel No Format \n";
            }

            if ($partnerUsername == "") {
                $err .= "-Missing Username \n";
            }

            if ($partnerEmail == "") {
                $err .= "-Missing email \n";
            }

            if ($partnerPass == "") {
                $err .= "-Missing password \n";
            }
            
            if (strlen($partnerPass) <= '6') {
                $err .= "-Your Password Must Contain At Least 6 Characters!\n";
            }
            elseif(!preg_match("#[0-9]+#",$partnerPass)) {
                $err .= "-Your Password Must Contain At Least 1 Number!\n";
            }
            elseif(!preg_match("#[A-Z]+#",$partnerPass)) {
                $err .= "-Your Password Must Contain At Least 1 Capital Letter!\n";
            }
            elseif(!preg_match("#[a-z]+#",$partnerPass)) {
                $err .= "-Your Password Must Contain At Least 1 Lowercase Letter!\n";
            } 

           
    
            if (empty($err)) {
                

                $insert = "INSERT INTO `partner` (`name`, `email`, `pass`, `telNo`, `faxNo`, `status`, `datejoined`, `profilepic`) VALUES ('$partnerUsername', '$partnerEmail', '$partnerPass', '$partnerTelno', '$partnerFaxNo', '$partnerStatus', '$partnerJoineddate', '$partnerProfilepic')";
                
                if (mysqli_query($conn, $insert)) {
                    echo "Sign Up Successfully!";
                } else {
                    echo $err;
                }
                
            }else{
                echo $err;
            }

    
    ?>