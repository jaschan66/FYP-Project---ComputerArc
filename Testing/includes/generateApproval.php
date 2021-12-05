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

$adminType = $_GET['adminType'];
$itemType  = $_GET['itemType'];
$itemName  = $_GET['itemName'];

//Search Database
$listHighestAdmin = "SELECT * FROM admin WHERE adminType = 4";
$resultListHighestAdmin = mysqli_query($conn, $listHighestAdmin);

$listAdmin = "SELECT * FROM admin WHERE adminType = '$adminType'";
$resultListAdmin = mysqli_query($conn, $listAdmin);

if ($itemType == 3) {
    $item = "SELECT * FROM auction WHERE title = '$itemName'";
    $resultItem = mysqli_query($conn, $item);
    $resultItemData = mysqli_fetch_array($resultItem);

} else if ($itemType == 2) {
    $item = "SELECT * FROM prebuildpc WHERE name = '$itemName'";
    $resultItem = mysqli_query($conn, $item);
    $resultItemData = mysqli_fetch_array($resultItem);

} else if ($itemType == 1) {
    $item = "SELECT * FROM pcpart WHERE name = '$itemName'";
    $resultItem = mysqli_query($conn, $item);
    $resultItemData = mysqli_fetch_array($resultItem);
}

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

    while ($resultData = mysqli_fetch_array($resultListHighestAdmin)) {
        $mail->addAddress($resultData["email"], $resultData["name"]); //Add Highest Admin
    }

    while ($resultData = mysqli_fetch_array($resultListAdmin)) {
        $mail->addAddress($resultData["email"], $resultData["name"]); //Add Admin
    }

    $mail->addReplyTo(EMAIL);

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'ComputerArc Inc. - New Item Waiting for Approval';
    if ($itemType == 3) {
        $mail->Body    = '
        <p style="font-size: 1.2vw;">A new item is waiting for your approval.</p><br>
        <p>item ID: ' .$resultItemData["id"]. '</p>
        <p>Item Name: '.$resultItemData["title"].'</p>
        <p>Item Starting Bid: '.$resultItemData["starting_bid"].'</p>
        <a style="background-color: #137cf3;border: none;color: white;padding: 10px 20px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;"
         href="localhost/FYP--ComputerArc/Testing/auctionDetailPage.php?idRetrieve=' . $resultItemData["id"] . '">Review Item</a>';

         if ($mail->send()) {
            echo "Approval successfully sent to Admin";
        }

    } else if ($itemType == 2) {
        $mail->Body    = '
        <p style="font-size: 1.2vw;">A new item is waiting for your approval.</p><br>
        <p>item ID:' . $resultItemData["id"] . '</p>
        <p>Item Name: '.$resultItemData["name"].'</p>
        <p>Item Name: '.$resultItemData["price"].'</p>
        <a style="background-color: #137cf3;border: none;color: white;padding: 10px 20px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;"
        href="localhost/FYP--ComputerArc/Testing/productPage.php?pcpart=0&productID=' . $resultItemData["id"] . '">Review Item</a>';

        if ($mail->send()) {
            echo "Pre-Build PC created successfuly!";
        }

    } else if ($itemType == 1) {
        $mail->Body    = '
        <p style="font-size: 1.2vw;">A new item is waiting for your approval.</p><br>
        <p>item ID:' . $resultItemData["id"] . '</p>
        <p>Item Name: '.$resultItemData["name"].'</p>
        <p>Item Name: '.$resultItemData["price"].'</p>
        <a style="background-color: #137cf3;border: none;color: white;padding: 10px 20px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;"
        href="localhost/FYP--ComputerArc/Testing/auctionDetailPage.php?idRetrieve=' . $resultItemData["id"] . '">Review Item</a>';
    }
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}