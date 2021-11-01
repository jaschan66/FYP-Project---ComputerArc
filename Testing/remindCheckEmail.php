<?php
  session_start();
?>

<!DOCTYPE html>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta charset=" utf-8" />

<head>
    <title>ComputerArc - Remind Check Email</title>
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


</head>

<body>
    <div class="row">
        <div class="col-6 " style="height: 100vh; background-image: linear-gradient(to right, #1f2428 80%, #2c3037 )">
            <div class="row" style="padding-top: 35vh;">
                <div class="col-3">

                </div>
                <div class="col-6">
    
                    <a href="loginPage.php" class="btn btn-dark" style="font-size: 2vw; font-family: 'Questrial'; width: 20vw;  margin-bottom: 2vh;">Back to Login Page</a>
                    
                </div>
                <div class="col-3">

                </div>
            </div>

        </div>
        <div class="col-6" style="height: 100vh; background-image: linear-gradient(to left ,#1f2428 80%,#2c3037);">
            <div class="row" style="padding-top: 30vh;">
                <div class="col-2">

                </div>
                <div class="col-8" style="text-align: center;">
                    <p style="color: #b5b0aa; font-family: 'Questrial'; padding-left:2vw; width: 30vw; font-size:1.5vw">A reset password link has been sent to your respective email, please check your email and reset your passowrd . We hope you have a good experiencce spending time with us.</p>

                </div>
                <div class="col-2">

                </div>
            </div>
            <div class="row">
            </div>
            <div class="row">
            </div>

        </div>
    </div>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script>
    grecaptcha.ready(function() {
        grecaptcha.execute('6LcrZPEcAAAAAOD-gL2ox-rjslwDMlTfFn8xarIM', {
            action: 'homepage'
        }).then(function(token) {
            document.getElementById("g-token").value = token;
        });
    });
</script>
</body>

</html>