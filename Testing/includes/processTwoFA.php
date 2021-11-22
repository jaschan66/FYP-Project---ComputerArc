<!DOCTYPE html>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta charset=" utf-8" />

<head>
    <title>ComputerArc - two-authentication</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <link rel="icon" href="Logo stuff\favicon-32x32.png" type="image/x-icon">
    <link href='https://fonts.googleapis.com/css?family=Questrial' rel='stylesheet'>
    <link href='../SweetAlert/sweetalert2.min.css' rel='stylesheet'>

    <script src="../SweetAlert/sweetalert2.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

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
    session_start();
    require 'dbh.local.inc.php';
    if (isset($_POST) && isset($_POST["btnSubmitTwoFA"])) {

        $email = $_SESSION['email'];
        $role =  $_SESSION['role'];

        $getTwoFA = mysqli_query($conn, "SELECT `twoFACode` FROM `$role` WHERE email ='$email'");

        $resultData = mysqli_fetch_assoc($getTwoFA);

        $twoFA = $_POST['twoFA'];

        if ($twoFA == $resultData['twoFACode']) {

            header("Location: ../homePage.php");
        } else {
    ?>
            <script>
                $(function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'The Two-factor authentication Code is not match!',
                        customClass: {
                            popup: 'format-pre'
                        }
                    })
                })
            </script>
    <?php
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
                        <form class="form-group" method="POST" enctype="multipart/form-data" style="padding-top:34vh">
                            <p style="color: #b5b0aa; font-family: 'Questrial'; padding-right: 6vw;">Two-factor authentication Code &nbsp;
                                <a href="#" data-toggle="tooltip" title="Please use the Two-factor authentication Code that has been sent to youe email."><i class='fas fa-question-circle'></i></a>
                            </p>
                            <input class="form-control" id="twoFA" name="twoFA" type="number" style="margin-bottom: 3vh;background-image: linear-gradient(to right, #2c3037, #1f2428); color: white;" required placeholder="e.g 123456">

                            <div class="row">
                                <div class="col-8">
                                    <input type="submit" name="btnSubmitTwoFA" class="btn btn-primary" style="font-size: 0.75vw; font-family: 'Questrial'; width:100%; margin-bottom: 2vh;" value="Submit">
                                </div>
                                <div class="col-4">
                                    <a href="../loginPage.php" class="btn btn-dark" style="font-size: 0.75vw; font-family: 'Questrial'; width: 100%;  margin-bottom: 2vh;">Back</a>
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

                        <p style="color:#ffffff; font-family: 'Questrial'; padding-bottom: 5vh; text-align: center; font-size: 4vw;">
                            Two-factor authentication</p>
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

    <script>
        $('[data-toggle="tooltip"]').tooltip();
    </script>

</body>


</html>