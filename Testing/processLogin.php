<?php
session_start();
  include "includes/dbh.local.inc.php";
            $loginEmail = $_POST['email'];
            $loginPass = $_POST['password'];

            $sqlcheckdupnameonmember = mysqli_query($conn, "SELECT * FROM `member` WHERE email ='$loginEmail'");
            $sqlcheckdupnameonpartner = mysqli_query($conn, "SELECT * FROM `partner` WHERE email ='$loginEmail'");
            $sqlcheckdupnameonadmin = mysqli_query($conn, "SELECT * FROM `admin` WHERE email ='$loginEmail'");
            if (mysqli_num_rows($sqlcheckdupnameonmember) == 1 || mysqli_num_rows($sqlcheckdupnameonpartner) == 1 || mysqli_num_rows($sqlcheckdupnameonadmin) == 1) {
                if (mysqli_num_rows($sqlcheckdupnameonmember) > mysqli_num_rows($sqlcheckdupnameonpartner) && mysqli_num_rows($sqlcheckdupnameonmember) > mysqli_num_rows($sqlcheckdupnameonadmin)) {
                    $passwordindb = mysqli_query($conn, "SELECT pass FROM `member` WHERE email ='$loginEmail'");
                    $result = mysqli_fetch_assoc($passwordindb);
                    if ($result['pass'] == $loginPass) {

                        //Create session for member
                        $_SESSION['role'] = "member";
                        $_SESSION['email'] = $loginEmail;
                        $_SESSION['status'] = "login";
                        echo "Login Successfully!";
                        
                        
                        //header("Location: homePage.php");

                    } else {
                        echo 'Email or password entered might be wrong.';
                    }
                } else if (mysqli_num_rows($sqlcheckdupnameonpartner) > mysqli_num_rows($sqlcheckdupnameonmember) && mysqli_num_rows($sqlcheckdupnameonpartner) > mysqli_num_rows($sqlcheckdupnameonadmin)) {
                    $passwordindb = mysqli_query($conn, "SELECT pass FROM `partner` WHERE email ='$loginEmail'");
                    $result = mysqli_fetch_assoc($passwordindb);
                    if ($result['pass'] == $loginPass) {

                        //Create session for partner
                        $_SESSION['role'] = "partner";
                        $_SESSION['email'] = $loginEmail;
                        $_SESSION['status'] = "login";
                        echo "Login Successfully!";
                        
                        //header("Location: homePage.php");

                    } else {
                        echo 'Email or password entered might be wrong.';
                    }
                } else {
                    $passwordindb = mysqli_query($conn, "SELECT pass FROM `admin` WHERE email ='$loginEmail'");
                    $result = mysqli_fetch_assoc($passwordindb);
                    if ($result['pass'] == $loginPass) {

                        //Create session for admin
                        $_SESSION['role'] = "admin";
                        $_SESSION['email'] = $loginEmail;
                        $_SESSION['status'] = "login";
                        echo "Login Successfully!";
                      

                        //header("Location: homePage.php");

                    }
                }
            } else {
                echo 'Email or password entered might be wrong.';
            }

    ?>