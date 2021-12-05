<?php
session_start();
require 'phpmailer/PHPMailer.php';
require 'phpmailer/Exception.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/credential.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer();
require 'includes/dbh.local.inc.php';

//Search Database
$getWinnerData = "SELECT * FROM auction_detail auc INNER JOIN member mem ON auc.participant_id = mem.id 
WHERE auc.auctionID = '$aucID' ORDER BY auc.amount_bid DESC LIMIT 1";

$getAuctionOwnerData = "SELECT * FROM auction auc INNER JOIN partner part ON auc.owner_id = part.id WHERE auc.id = '$aucID'";
$auctionData = "SELECT * FROM auction WHERE id = '$aucID'";

$conngetWinnerData       = mysqli_query($conn, $getWinnerData);
$conngetAuctionOwnerData = mysqli_query($conn, $getAuctionOwnerData);
$conngetAuctionData      = mysqli_query($conn, $auctionData);

$winnerData       = mysqli_fetch_array($conngetWinnerData);
$auctionOwnerData = mysqli_fetch_array($conngetAuctionOwnerData);
$auctionData      = mysqli_fetch_array($conngetAuctionData);

$updateAuctionQuery = "UPDATE auction SET winner = '".$winnerData['id']."' WHERE id = '$aucID'";
mysqli_query($conn, $updateAuctionQuery);

// print_r($winnerData["email"]);
// print_r($auctionOwnerData["email"]);
// die();

// Send email to Auction Owner
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
    $mail->addAddress($auctionOwnerData["email"], $auctionOwnerData["name"]); //Add Auction owner
    $mail->addReplyTo(EMAIL);

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'ComputerArc Inc. - Auction has ended';
    $mail->Body    = '
        <p style="font-size: 1.2vw;">One of your auction has ended please check if you have a winner and get ready to send out the reward.</p><br>
        <p>Auction ID: ' . $auctionData["id"] . '</p>
        <p>Auction Tittle: ' . $auctionData["title"] . '</p>
        <a style="background-color: #137cf3;border: none;color: white;padding: 10px 20px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;"
         href="localhost/FYP--ComputerArc/Testing/auctionDetailPage.php?idRetrieve=' . $auctionData["id"] . '">Review Item</a>';

    if ($mail->send()) {
        //echo "Email successfully sent to Owner";
    }
} catch (Exception $e) {
    echo "Message could not be sent to Auction Owner. Mailer Error: {$mail->ErrorInfo}";
}


// Send email to Auction Winner
if (!empty($winnerData["name"])) {
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
        $mail->addAddress($winnerData["email"], $winnerData["name"]); //Add Winner Email
        $mail->addReplyTo(EMAIL);

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'ComputerArc Inc. - Auction has ended';
        $mail->Body    = '
        <p style="font-size: 1.2vw;">Congratulations you have won for one of the auction that you have bid in.</p><br>
        <p>Auction ID: ' . $auctionData["id"] . '</p>
        <p>Auction Tittle: ' . $auctionData["title"] . '</p>
        <a style="background-color: #137cf3;border: none;color: white;padding: 10px 20px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;"
         href="localhost/FYP--ComputerArc/Testing/auctionDetailPage.php?idRetrieve=' . $auctionData["id"] . '">Review Item</a>';

        if ($mail->send()) {
            $_SESSION['emailSent'] = $auctionData["id"];
            //echo "Email successfully sent to Winner";
        }
    } catch (Exception $e) {
        echo "Message could not be sent Winner. Mailer Error: {$mail->ErrorInfo}";
    }
}
