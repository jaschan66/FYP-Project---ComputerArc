<?php
session_start();
?>

<!DOCTYPE html>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta charset=" utf-8" />

<head>
    <title>ComputerArc - Sign In</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <link rel="icon" href="Logo stuff\favicon-32x32.png" type="image/x-icon">
    <link href='https://fonts.googleapis.com/css?family=Questrial' rel='stylesheet'>
    <!-- <script src="https://www.google.com/recaptcha/api.js?render=6LcrZPEcAAAAAOD-gL2ox-rjslwDMlTfFn8xarIM"></script> -->
    <link href='SweetAlert/sweetalert2.min.css' rel='stylesheet'>

    <style>
        body {
            overflow-x: hidden;
            overflow-y: hidden;
        }

        .row {
            margin: 0;
        }
    </style>

    


</head>

<body>
    <div class="row">
        <div class="col-6 " style="height: 100vh; background-image: linear-gradient(to right, #1f2428 80%, #2c3037 )">
            <div class="row">
                <div class="col-3">

                </div>
                <div class="col-6">

                    <form style="padding-top: 20vh;" class="form-group" method="POST" enctype="multipart/form-data" id="submitLogin">

                        <?php
                        $_GET['resetPass'] = "";
                        if ($_GET['resetPass'] == true) {

                            echo  "<div class='alert alert-dark alert-dismissible' role='alert'>
                        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                        <strong>Success!</strong> You should try logging in with your new password now.
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                          <span aria-hidden='true'>&times;</span>
                        </button>
                      </div>";
                        }
                        ?>
                        <input type="hidden" id="g-token" name="g-toekn" />
                        <p style="color:#ffffff; font-family: 'Questrial'; padding-bottom: 5vh; text-align: center; font-size: 2.5em;">
                            SIGN IN</p>
                        <p style="color: #b5b0aa; font-family: 'Questrial'; padding-right: 6vw;">E-mail</p>
                        <input class="form-control" id="email" name="email" type="text" style="margin-bottom: 3vh;background-image: linear-gradient(to right, #2c3037, #1f2428); color: white;">
                        <p style="color: #b5b0aa; font-family: 'Questrial'; padding-right: 6vw;">Password</p>
                        <input class="form-control" id="password" name="password" type="password" style="margin-bottom: 5vh; background-image: linear-gradient(to right, #2c3037, #1f2428); color: white;">

                        <input type="submit" name="btnSubmitLogin" id="btnSubmitLogin"  class="btn btn-primary" style="font-size: 0.75vw; font-family: 'Questrial'; width:14vw;  margin-bottom: 2vh;" value="Sign In">
                        <a href="homePage.php" class="btn btn-dark" style="font-size: 0.75vw; font-family: 'Questrial'; width: 8vw;  margin-bottom: 2vh;">Back to home</a>
                        <a href="forgotYourPass.php" style="font-size: 0.75vw; font-family: 'Questrial'; width: 20vw; margin-left: 7.3vw; color: #ffffff;">Forgot
                            Your Password?</a>
                    </form>
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
                    <a href="chooseSignUp.php" class="btn btn-dark" style="font-size: 0.75vw; font-family: 'Questrial'; width: 20vw; margin-bottom: 2vh;">Join ComputerArc</a>
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

    <!-- <script>
        grecaptcha.ready(function() {
            grecaptcha.execute('6LcrZPEcAAAAAOD-gL2ox-rjslwDMlTfFn8xarIM', {
                action: 'homepage'
            }).then(function(token) {
                document.getElementById("g-token").value = token;
            });
        });
    </script> -->


    <script src="SweetAlert/sweetalert2.min.js"></script>
    <script>
    
        $('#btnSubmitLogin').click(function(event) {
            event.preventDefault();
            var form = $('#submitLogin');
            var formData = new FormData(form[0]);
                    $.ajax({
                        type: "POST",
                        url: "processLogin.php",
                        processData: false,
                        contentType: false,
                        data: formData,
                        success: function(x) {
                            var delay = 500;
                            console.log(x);
                            if (x == "Login Successfully!") {
                                window.location = "../generateTwoFA.php";
                            }else{
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Something went wrong!',
                                    html: '<pre>' + x + '</pre>',
                                    customClass: {
                                        popup: 'format-pre'
                                    }
                                })
                            }
                        }
                    });
        });
  
</script>

</body>

</html>