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
            overflow-y: hidden;
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

            $result = mysqli_query($conn,"SELECT * FROM `$role` WHERE email ='$email'");
            $resultimg = mysqli_query($conn,"SELECT profilepic FROM `$role` WHERE email ='$email'");

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
        <div class="row" style="height: 20vh;">
            <!--profile picture-->
            <div class="col-4">
                <?php
            while ($img = mysqli_fetch_array($resultimg)) {
                   echo '<img src="data:image/jpg;base64,' . base64_encode($img['profilepic']) . '" height="512px" width="512px"/>';
                }
                ?>
            </div>

            <!--name and etc-->
            <div class="col-8">
            <p style="color:#b5b0aa; font-family: 'Questrial'; padding-bottom: 5vh; text-align: left; font-size: 2.5vw;"><?php echo $name['name']; ?></p>
            
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