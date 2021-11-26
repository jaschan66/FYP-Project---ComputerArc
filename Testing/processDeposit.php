<?php
include "includes/dbh.inc.php";
session_start();
$auctionID = $_POST['auctionID'];
$deposit = $_POST['deposit'];
$email = $_SESSION['email'];

$err = "Error occured, please try again later.";



$paymentStatus = $_POST['paymentDetail']['status'];
$paymentAmount = $_POST['paymentDetail']['purchase_units']['0']['amount']['value'];
$paymentName = $_POST['paymentDetail']['purchase_units']['0']['shipping']['name']['full_name'];
$paymentDate = $_POST['paymentDetail']['update_time'];
$paymentAddress = $_POST['paymentDetail']['purchase_units']['0']['shipping']['address']['address_line_1'] . "," . $_POST['paymentDetail']['purchase_units']['0']['shipping']['address']['admin_area_2'] . "," . $_POST['paymentDetail']['purchase_units']['0']['shipping']['address']['admin_area_1'] . "," . $_POST['paymentDetail']['purchase_units']['0']['shipping']['address']['postal_code'];
if ($paymentStatus == "COMPLETED") {

    $queryGetBidderData = "SELECT * FROM member WHERE email = '$email'";

    if ($executeBidderQuery = mysqli_query($conn, $queryGetBidderData)) {

        $BidderrData = mysqli_fetch_assoc($executeBidderQuery);
        $BidderID = $BidderrData['id'];
        $queryGetAuctionData = "SELECT * FROM auction WHERE id = '$auctionID'";

        if ($executeAuctionDataQuery = mysqli_query($conn, $queryGetAuctionData)) {

            $auctionData = mysqli_fetch_assoc($executeAuctionDataQuery);
            $auctionOwner = $auctionData['owner_id'];

            $queryInsertDeposit = "INSERT INTO `deposit` (`amount`, `depositDate`, `shipAddress`, `bidderName`, `bidder`, `owner_id`, `auctionID`) VALUES ('$paymentAmount', '$paymentDate', '$paymentAddress', '$paymentName', '$BidderID', '$auctionOwner', '$auctionID')";

            if ($executeInsertDepositQuery = mysqli_query($conn, $queryInsertDeposit)) {
                echo "Paid successfully!";
            } else {
                echo $err;
            }
        } else {
            echo $err;
        }
    } else {
        echo $err;
    }
} else {
    echo $err;
}
