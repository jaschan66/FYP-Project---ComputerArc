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

    $email = $_SESSION['email'];
    $role = $_SESSION['role'];

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
                        echo "Tell us more about yourself <a href='#' style='font-size: 1.5vw; ' role='button'>here</a>";
                    } else {
                        echo $name['description'];
                    } ?>
                </p>
            </div>
        </div>

        <div class="row" style="height: 50vh; margin-top:1vh; margin-bottom:2vh;">
            <div class="col-2" style=" border-right-style: solid;">
                <!--Based on the role change the sidebar menu-->
                <?php 
                    if ($role == "member"){
                        include "ProfilePage/memberSideBar.php";
                    }
                    else if ($role == "partner"){
                        //include "ProfilePage/partnerSideBar.php";
                    }
                    else{
                         //include "ProfilePage/adminSideBar.php";
                    }
                ?>

            </div>

            <div class="col-10">
                <!--Based on side menu bar change its content-->
            </div>

        </div>


        <div class="row">
            <!--the side menu for profile page-->
            <div class="col-4">

            </div>

            <!--the side menu for profile page-->
            <div class="col-8">

            </div>
        </div>


    </div>

    <!--footer-->
    <?php include 'includes/footer.php'; ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</body>

</html>