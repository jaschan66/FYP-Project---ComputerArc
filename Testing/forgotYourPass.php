<!DOCTYPE html>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta charset=" utf-8" />

<head>
    <title>ComputerArc - Forgot Password</title>
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

        .row {
            margin: 0;
            /*padding:0;*/
        }
    </style>

<?php 
require 'phpmailer\PHPMailer.php';
require 'phpmailer\Exception.php';
require 'phpmailer\SMTP.php';
require 'phpmailer\credential.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
USE PHPMailer\PHPMailer\Exception; 

if(isset($_POST) && isset($_POST["btnSubmitResetPass"])) {
    
        $mail = new PHPMailer();
        require 'includes/dbh.local.inc.php';

        $email = $_POST['resetpassemail'];

        $resultOnPartner = mysqli_query($conn,"SELECT * FROM `partner` WHERE email ='$email'");
        $resultOnMember = mysqli_query($conn,"SELECT * FROM `member` WHERE email ='$email'");

        $numOnPartner = mysqli_num_rows($resultOnPartner);
        $numOnMember = mysqli_num_rows($resultOnMember);

        if ($numOnPartner == 1 ) {
            $resultdata = mysqli_fetch_assoc($resultOnPartner);
            $roleget = "partner";
        }
        elseif ($numOnMember == 1) {
            $resultdata = mysqli_fetch_assoc($resultOnMember);
            $roleget = "member";
        }
        else{
            echo "The email entered seems to have no account associated in our side.";
        }
        try {
            //Server settings
            
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;
            $mail->SMTPSecure = "tls";                                   //Enable SMTP authentication
            $mail->Username   = EMAIL;                     //SMTP username
            $mail->Password   = PASS;                               //SMTP password
            $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
            //Recipients
            $mail->setFrom(EMAIL,'ComputerArc Inc.');
            $mail->addAddress($resultdata['email'], $resultdata['name']);     //Add a recipient
            $mail->addReplyTo(EMAIL);
        
            //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
        
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'ComputerArc Inc. - Forgot Password';
            $mail->Body    = 'It seems like you\'ve have forgot your password, you can then reset your password with the <a href=\'http://localhost/FYP--ComputerArc/Testing/resetPassword.php?id='.$resultdata['id'].'&roleget='.$roleget.'\' style=\'font-size: 1.5vw; \' role=\'button\'>link </a>here';
            if($mail->send()){
                header("Location: remindCheckEmail.php");
            }
            
           
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
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
                            <p style="color: #b5b0aa; font-family: 'Questrial'; padding-right: 6vw;">E-mail &nbsp;<a href="#" data-toggle="tooltip" title="This will validate if you already have account on our server and send the reset password url to you"><i class='fas fa-question-circle'></i></a></p>
                            <input class="form-control" id="resetpassemail" name="resetpassemail" type="text" style="margin-bottom: 3vh;background-image: linear-gradient(to right, #2c3037, #1f2428); color: white;" required placeholder="e.g. Nicky@gmail.com">
    
                            <div class="row">
                                    <div class="col-8">
                                        <input type="submit" name="btnSubmitResetPass" class="btn btn-primary" style="font-size: 0.75vw; font-family: 'Questrial'; width:100%; margin-bottom: 2vh;" value="Reset My Password">
                                    </div>
                                    <div class="col-4">
                                        <a href="loginPage.php" class="btn btn-dark" style="font-size: 0.75vw; font-family: 'Questrial'; width: 100%;  margin-bottom: 2vh;">Back</a>
                                    </div>
                                </div>
    
                        </form>
                    </div>
                    <div class="col-2">
    
                    </div>
                </div>
    
            </div>
            <div class="col-6" style="min-height:100vh; background-image: linear-gradient(to left ,#1f2428 80%,#2c3037);">
                <div class="row" >
                    <div class="col-3">
    
                    </div>
                    <div class="col-6" style="text-align: center; margin-top:30vh;">
                        
                        <p style="color:#ffffff; font-family: 'Questrial'; padding-bottom: 5vh; text-align: center; font-size: 4vw;">
                            Forgot Password</p>
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

