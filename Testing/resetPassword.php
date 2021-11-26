<!DOCTYPE html>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta charset=" utf-8" />

<head>
    <title>ComputerArc - Reset Password</title>
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

        .row {
            margin: 0;
            /*padding:0;*/
        }
    </style>

    <?php

    include "includes/dbh.local.inc.php";
    if (isset($_POST) && isset($_POST["btnSubmitResetPassword"])) {

        $pass = $_POST['resetPassword'];
        $conPass = $_POST['confirmResetPassword'];
        $role = $_GET['roleget'];
        $id = $_GET['id'];


        if ($pass == $conPass) {
            if (strlen($pass) <= '6') {
                echo  "-Your Password Must Contain At Least 6 Characters!";
            }
            elseif(!preg_match("#[0-9]+#",$pass)) {
                echo "-Your Password Must Contain At Least 1 Number!";
            }
            elseif(!preg_match("#[A-Z]+#",$pass)) {
                echo "-Your Password Must Contain At Least 1 Capital Letter!";
            }
            elseif(!preg_match("#[a-z]+#",$pass)) {
                echo "-Your Password Must Contain At Least 1 Lowercase Letter!";
            }
            else{
                $result = mysqli_query($conn, "UPDATE `$role` SET pass ='$pass' WHERE id ='$id'");
                if ($result) {
                    header("Location: loginPage.php?resetPass=true");
                } else {
                    echo "something went wrong";
                }
            }
           
        } else {
            echo "Password and Re-type password are not the same";
        }
    }
    ?>
</head>

<body style="min-height:100vh">
    <div class="container-fluid" style="padding:0;min-height:100vh">
        <div class="row">
            <div class="col-6 " style="min-height:100vh; background-image: linear-gradient(to right, #1f2428 80%, #2c3037 )">
                <div class="row">
                    <div class="col-2">

                    </div>
                    <div class="col-8">
                        <form class="form-group" method="POST" enctype="multipart/form-data" style="padding-top:30vh">


                            <p style="color: #b5b0aa; font-family: 'Questrial'; padding-right: 6vw;">Password &nbsp;<a href="#" data-toggle="tooltip" title="Password must be at least 6 characters long"><i class='fas fa-question-circle'></i></a></p>
                            <input class="form-control" id="resetPassword" name="resetPassword" type="password" style="margin-bottom: 5vh; background-image: linear-gradient(to right, #2c3037, #1f2428); color: white;" required placeholder="e.g. abc123" min="6">

                            <p style="color: #b5b0aa; font-family: 'Questrial'; padding-right: 6vw;">Confirm Password &nbsp;<a href="#" data-toggle="tooltip" title="Re-type your password for confirmation purpose"><i class='fas fa-question-circle'></i></a></p>
                            <input class="form-control" id="confirmResetPassword" name="confirmResetPassword" type="password" style="margin-bottom: 5vh; background-image: linear-gradient(to right, #2c3037, #1f2428); color: white;" required placeholder="e.g. abc123" min="6">

                            <div class="row">
                                <div class="col-12">
                                    <input type="submit" name="btnSubmitResetPassword" class="btn btn-primary" style="font-size: 0.75vw; font-family: 'Questrial'; width:100%; margin-bottom: 2vh;" value="Reset Password">
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="col-2">

                    </div>
                </div>

            </div>
            <div class="col-6" style="min-height:100vh; background-image: linear-gradient(to left ,#1f2428 80%,#2c3037);">
                <div class="row">
                    <div class="col-3">

                    </div>
                    <div class="col-6" style="text-align: center; margin-top:30vh;">
                        <p style="color:#b5b0aa; font-family: 'Questrial'; padding-bottom: 5vh; text-align: center; font-size: 2.5vw;">
                            Resetting</p>
                        <p style="color:#ffffff; font-family: 'Questrial'; padding-bottom: 5vh; text-align: center; font-size: 4vw;">
                            Password</p>
                    </div>
                    <div class="col-3">

                    </div>
                </div>

            </div>
        </div>
    </div>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</body>
<script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>




</html>