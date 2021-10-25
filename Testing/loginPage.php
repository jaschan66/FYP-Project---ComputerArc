<!DOCTYPE html>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta charset=" utf-8" />

<head>
    <title>ComputerArc - Sign In</title>
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
    </style>
</head>

<body>
    <div class="row">
        <div class="col-6 "
            style="height: 100vh; background-image: linear-gradient(to right, #1f2428 80%, #2c3037 )">
            <div class="row">
                <div class="col-3">

                </div>
                <div class="col-6">
                    <form style="padding-top: 20vh;" class="form-group" method="POST">
                        <p
                            style="color:#ffffff; font-family: 'Questrial'; padding-bottom: 5vh; text-align: center; font-size: 2.5em;">
                            SIGN IN</p>
                        <p style="color: #b5b0aa; font-family: 'Questrial'; padding-right: 6vw;">Username</p>
                        <input class="form-control" id="username" type="text"
                            style="margin-bottom: 3vh;background-image: linear-gradient(to right, #2c3037, #1f2428); color: white;">
                        <p style="color: #b5b0aa; font-family: 'Questrial'; padding-right: 6vw;">Password</p>
                        <input class="form-control" id="password" type="text"
                            style="margin-bottom: 5vh; background-image: linear-gradient(to right, #2c3037, #1f2428); color: white;">
                    </form>
                    <a href="homePage.html" class="btn btn-primary"
                        style="font-size: 0.75vw; font-family: 'Questrial'; width: 20vw; margin-left: 1vw; margin-bottom: 2vh;">Sign
                        In</a>
                    <a href="#"
                        style="font-size: 0.75vw; font-family: 'Questrial'; width: 20vw; margin-left: 7.3vw; color: #ffffff;">Forgot
                        Your Password?</a>
                </div>
                <div class="col-3">

                </div>
            </div>

        </div>
        <div class="col-6" style="height: 100vh; background-image: linear-gradient(to left ,#1f2428 80%,#2c3037);">
            <div class="row" style="padding-top: 30vh;">
                <div class="col-3">

                </div>
                <div class="col-6" style="text-align: center;">
                    <p style="color: #b5b0aa; font-family: 'Questrial'; padding-left:2vw; width: 20vw;">Join ComputerArc and discover the world of PC</p>
                    <p style="color: #b5b0aa; font-family: 'Questrial'; padding-left:2vw; width: 20vw;">It's free and easy to use</p>  
                    <img src="Logo stuff\image-removebg-preview.png" alt="Logo" style="width: 20vw;padding-bottom: 5vh;">
                    <a href="chooseSignUp.php" class="btn btn-dark"
                    style="font-size: 0.75vw; font-family: 'Questrial'; width: 20vw; margin-bottom: 2vh;">Join ComputerArc</a>
                </div>
                <div class="col-3">
                    
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
</body>

</html>