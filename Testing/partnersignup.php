<?php
include 'includes/dbh.inc.php';
?>

<!DOCTYPE html>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta charset=" utf-8" />

<head>
    <title>ComputerArc - partner Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <link rel="icon" href="Logo stuff\favicon-32x32.png" type="image/x-icon">
    <link href='https://fonts.googleapis.com/css?family=Questrial' rel='stylesheet'>
    <script src="https://www.google.com/recaptcha/api.js?render=6LcrZPEcAAAAAOD-gL2ox-rjslwDMlTfFn8xarIM"></script>
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
    </style>

    <?php
    if (isset($_POST) && isset($_POST["btnSubmit"])) {
        $secretKey = '6LcrZPEcAAAAADHir9dVmYUYIDN2HedLkrlqo6Fv';
        $token = $_POST["g-toekn"];
        $ip = $_SERVER['REMOTE_ADDR'];

        $url = "https://www.google.com/recaptcha/api/siteverify?secret=" . $secretKey . "&response=" . $token . "&remoteip=" . $ip;
        $request = file_get_contents($url);
        $response = json_decode($request);

        if ($response->success) {
            echo '<h1>Validation Success</h1>';
        } else {
            echo '<h1>Validation Failed</h1>';
        }
    }
    ?>
</head>

<body>
    <div class="row">
        <div class="col-6 " style="height: 100vh; background-image: linear-gradient(to right, #1f2428 80%, #2c3037 )">
            <div class="row">
                <div class="col-2">

                </div>
                <div class="col-8">
                    <form style="padding-top: 15vh;" class="form-group" method="post">
                        <input type="hidden" id="g-token" name="g-toekn" />

                        <p style="color: #b5b0aa; font-family: 'Questrial'; padding-right: 6vw;">E-mail &nbsp;<a href="#" data-toggle="tooltip" title="The email is used for sign-in and other purpose such as 2FA on our website"><i class='fas fa-question-circle'></i></a></p>
                        <input class="form-control" id="partneremail" name="partneremail" type="text" style="margin-bottom: 3vh;background-image: linear-gradient(to right, #2c3037, #1f2428); color: white;" required placeholder="e.g. Nicky@gmail.com">

                        <p style="color: #b5b0aa; font-family: 'Questrial'; padding-right: 6vw;">Password &nbsp;<a href="#" data-toggle="tooltip" title="Password must be at least 6 characters long"><i class='fas fa-question-circle'></i></a></p>
                        <input class="form-control" id="partnerpassword" name="partnerpassword" type="password" style="margin-bottom: 5vh; background-image: linear-gradient(to right, #2c3037, #1f2428); color: white;" required placeholder="e.g. abc123">

                        <p style="color: #b5b0aa; font-family: 'Questrial'; padding-right: 6vw;">Username &nbsp;<a href="#" data-toggle="tooltip" title="The username assigned is used to display on our page"><i class='fas fa-question-circle'></i></a></p>
                        <input class="form-control" id="partnerusername" name="partnerusername" type="text" style="margin-bottom: 3vh;background-image: linear-gradient(to right, #2c3037, #1f2428); color: white;" required placeholder="e.g. Nicky">

                        <p style="color: #b5b0aa; font-family: 'Questrial'; padding-right: 6vw;">Tel No.&nbsp;<a href="#" data-toggle="tooltip" title="The tel no. is used for our staff to contact you (just in case)"><i class='fas fa-question-circle'></i></a></p>
                        <input class="form-control" id="partnertelno" name="partnertelno" type="text" style="margin-bottom: 3vh;background-image: linear-gradient(to right, #2c3037, #1f2428); color: white;" pattern="[0-9]{10}" required placeholder="e.g. 0123456789">

                        <p style="color: #b5b0aa; font-family: 'Questrial'; padding-right: 6vw;">Fax No.&nbsp;<a href="#" data-toggle="tooltip" title="The Fax no. is used for our staff to contact you "><i class='fas fa-question-circle'></i></a></p>
                        <input class="form-control" id="partnerfaxno" name="partnerfaxno" type="text" style="margin-bottom: 3vh;background-image: linear-gradient(to right, #2c3037, #1f2428); color: white;" pattern="[0-9]{10}"  placeholder="e.g. 0123456789">

                        <p style="color: #b5b0aa; font-family: 'Questrial'; padding-right: 6vw;">Profile Picture</p>
                        <div class="custom-file" style="margin-bottom: 5vh;">
                            <input class="custom-file-input" id="partnerprofilepic" name="partnerprofilepic" type="file" style="background-image: linear-gradient(to right, #2c3037, #1f2428); color: white;">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                        <input type="submit" name="btnSubmit" class="btn btn-primary" style="font-size: 0.75vw; font-family: 'Questrial'; width:22.4vw; margin-bottom: 2vh;" value="Sign Up">
                        <a href="chooseSignUp.php" class="btn btn-dark" style="font-size: 0.75vw; font-family: 'Questrial'; width: 8vw;  margin-bottom: 2vh;">Back</a>

                    </form>
                </div>
                <div class="col-2">

                </div>
            </div>

        </div>
        <div class="col-6" style="height: 100vh; background-image: linear-gradient(to left ,#1f2428 80%,#2c3037);">
            <div class="row" style="padding-top: 30vh;">
                <div class="col-3">

                </div>
                <div class="col-6" style="text-align: center;">
                    <p style="color:#b5b0aa; font-family: 'Questrial'; padding-bottom: 5vh; text-align: center; font-size: 3em;">
                        Signing up as</p>
                    <p style="color:#ffffff; font-family: 'Questrial'; padding-bottom: 5vh; text-align: center; font-size: 5em;">
                        Partner</p>
                </div>
                <div class="col-3">

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

<script>
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>

<script>
    grecaptcha.ready(function() {
        grecaptcha.execute('6LcrZPEcAAAAAOD-gL2ox-rjslwDMlTfFn8xarIM', {
            action: 'homepage'
        }).then(function(token) {
            document.getElementById("g-token").value = token;
        });
    });
</script>

</html>