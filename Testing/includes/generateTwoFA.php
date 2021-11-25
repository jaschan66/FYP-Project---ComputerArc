<?php 
session_start();
require '../phpmailer/PHPMailer.php';
require '../phpmailer/Exception.php';
require '../phpmailer/SMTP.php';
require '../phpmailer/credential.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer();
require 'dbh.local.inc.php';

$email = $_SESSION['email'];
$role =  $_SESSION['role'];

//Search Database
$Searchresult = mysqli_query($conn, "SELECT * FROM `$role` WHERE email ='$email'");
$resultData = mysqli_fetch_assoc($Searchresult);

if ($resultData['twoFAStatus'] == 1) {

    //Generate twoFACode
    $twoFACode = rand(100000, 999999);

    //Insert twoFACode
    $updateQuery = "UPDATE `$role` SET twoFACode = '$twoFACode' WHERE email = '$email'";
    mysqli_query($conn, $updateQuery);

    try {
        //Server settings

        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                      //Set the SMTP server to send through
        $mail->SMTPAuth   = true;
        $mail->SMTPSecure = "tls";                               //Enable SMTP authentication
        $mail->Username   = EMAIL;                              //SMTP username
        $mail->Password   = PASS;                              //SMTP password
        $mail->Port       = 587;                              //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom(EMAIL, 'ComputerArc Inc.');
        $mail->addAddress($resultData['email'], $resultData['name']);     //Add a recipient
        $mail->addReplyTo(EMAIL);

        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'ComputerArc Inc. - Two-factor authentication Code';
        $mail->Body    = "<p style='font-size: 1.2vw;'>It seems like you are trying to log in here is the code. $twoFACode </p><br><p> If you did not request this please change your password immediately, </p>";
        if ($mail->send()) {

            header("Location: processTwoFA.php");
        }
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

} else {
    header("Location: ../homePage.php");
}