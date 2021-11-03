<?php
session_start();
?>
<!DOCTYPE html>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta charset="utf-8" />

<head>
    <title>ComputerArc - Profile Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <link rel="icon" href="Logo stuff\favicon-32x32.png" type="image/x-icon">
    <link href='https://fonts.googleapis.com/css?family=Questrial' rel='stylesheet'>

    <link href='filepond/filepond.min.css' rel='stylesheet'>
    <link href='filepond/plugins/preview/filepond-plugin-image-preview.min.css' rel='stylesheet'>
    <style>
        body {
            overflow-x: hidden;
            overflow-y: auto;
        }

        ::-webkit-scrollbar {

            width: 0.8vw;
            border-style: solid;
            border-color: #000000;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 1);
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: rgba(161, 161, 161, 0.5);
            border-radius: 10px;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: rgba(0, 0, 0, 1);

        }

        html,
        body {
            height: 100%;
        }

        a {
            color: #b5b0aa;
        }

        a:hover {
            color: #383735;
        }

        .row {
            margin: 0;
            /*padding:0;*/
        }

        .formlabel {
            color: #b5b0aa;
            font-size: 1.5vw;
        }

        .formspacing {
            padding-bottom: 2.5vh;
        }

        p {
            font-family: "Questrial";
        }

        a {
            font-family: "Questrial";
            font-size: larger;
        }

        h2 {
            font-family: "Questrial";
        }
    </style>
    <?php
    include "includes/dbh.inc.php";
    $msg = "";
    $email = $_SESSION['email'];
    $role = $_SESSION['role'];


    if (isset($_POST) && isset($_POST['btnSubmitEditProf'])) {

        $description = $_POST['description'];
        $telNo = $_POST['telNo'];
        $faxNo = $_POST['faxNo'];
        
       

        if ($_POST['telNo'] != "" && $_POST['faxNo'] != "") {

            $queryWithPicture = "";
            if ($_FILES['profilepic']['size'] > 0) {
                $ProfilePic = addslashes(file_get_contents($_FILES['profilepic']['tmp_name']));
                $queryWithPicture = ", profilepic = '$ProfilePic'";
            }
        
            $query = "UPDATE $role SET description = '$description', telNo = '$telNo', faxNo = '$faxNo' $queryWithPicture WHERE email = '$email'";
        
            if (mysqli_query($conn, $query)) {
                $msg = "<div class='alert alert-dark alert-dismissible' role='alert'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Success!</strong> Your profile are looking fresh and good.
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span>
                </button>
              </div>";
            } else {
                $msg = "<div class='alert alert-danger alert-dismissible' role='alert'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Oh No!</strong> Something went wrong when editing your profile, please try again later.
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span>
                </button>
              </div>";
              echo mysqli_error($conn);
            }
        }

        
    }

    $result = mysqli_query($conn, "SELECT * FROM `$role` WHERE email ='$email'");
    $resultimg = mysqli_query($conn, "SELECT profilepic FROM `$role` WHERE email ='$email'");

    if (mysqli_num_rows($result) > 0) {
        $name = mysqli_fetch_assoc($result);
    }


    ?>
</head>

<body>

    <!--header-->
    <?php include "includes/header.php"; ?>

    <div class="container-fluid">
        <!--top of profile page-->
        <div class="row" style="height: auto; border-bottom-style: solid;">
            <div class="col-12">
            <?php
                    
                  echo $msg;
                    ?>
            </div>
            <!--profile picture-->
            <div class="col-2" style="padding-left: 10vw">

                <?php

                while ($img = mysqli_fetch_array($resultimg)) {
                    echo '<img src="data:image/jpg;base64,' . base64_encode($img['profilepic']) . '" height="180px" width="180px" alt="Profile Picture" class="img-thumbnail img-responsive"/>';
                }

                ?>
            </div>

            <!--name and etc-->
            <div class="col-10">
                <p style="color:#000000; font-family: 'Questrial'; text-align: left; font-size: 2.5vw;"><?php echo $name['name']; ?></p>
                <hr>
                <p style="color:#b5b0aa; font-family: 'Questrial'; text-align: left; font-size: 1.5vw;">
                    <?php
                    if ($name['description'] == null) {
                        echo "Tell us more about yourself <a href='#' style='font-size: 1.5vw; color:#54524f' role='button'>here</a>";
                    } else {
                        echo $name['description'];
                    } ?>
                </p>
            </div>
        </div>

        <div class="row" style="min-height: 50vh; margin-top:1vh; margin-bottom:2vh;">
            <div class="col-2" style=" border-right-style: solid;">
                <!--Based on the role change the sidebar menu-->
                <?php
                if ($role == "member") {
                    include "ProfilePage/memberSideBar.php";
                } else if ($role == "partner") {
                    include "ProfilePage/partnerSideBar.php";
                } else {
                    //include "ProfilePage/adminSideBar.php";
                }
                ?>

            </div>

            <div class="col-10">
                <!--Based on side menu bar change its content-->
                <div class="col-1">

                </div>

                <div class="col-10">
                    <?php 
                        if($_GET['editProf'] == true){
                            include "ProfilePage/editPartnerProf.php";
                        }
                    ?>
                   
                </div>

                <div class="col-1">

                </div>
            </div>

        </div>




    </div>

    <!--footer-->
    <?php include 'includes/footer.php'; ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <script src="filepond/filepond.min.js"></script>
    <script src="filepond/filepond.jquery.js"></script>
    <script src="filepond/plugins/preview/filepond-plugin-image-preview.min.js"></script>

    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

    
</body>
<script>
        $(document).ready(function() {
            FilePond.registerPlugin(FilePondPluginImagePreview);
            const inputElement = document.querySelector('#profilepic');

            const pond = FilePond.create(inputElement, {
                storeAsFile: true
            });

            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

</html>