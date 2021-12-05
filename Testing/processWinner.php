<?php
include "includes/dbh.inc.php";
date_default_timezone_set("Asia/Kuala_Lumpur");
$date_now = new DateTime();
$paymentDate = date_format($date_now, 'Y-m-d H:i:s');

session_start();
$total = $_POST['total'];
$auctionID = $_POST['auctionID'];
$email = $_SESSION['email'];
$commissionRate = 0.06;

$err = "Error occured, please try again later.";


$paymentStatus = $_POST['paymentDetail']['status'];
$paymentAmount = $_POST['paymentDetail']['purchase_units']['0']['amount']['value'];
$paymentName = $_POST['paymentDetail']['purchase_units']['0']['shipping']['name']['full_name'];
//$paymentDate = $_POST['paymentDetail']['update_time'];
$paymentAddress = $_POST['paymentDetail']['purchase_units']['0']['shipping']['address']['address_line_1'] . "," . $_POST['paymentDetail']['purchase_units']['0']['shipping']['address']['admin_area_2'] . "," . $_POST['paymentDetail']['purchase_units']['0']['shipping']['address']['admin_area_1'] . "," . $_POST['paymentDetail']['purchase_units']['0']['shipping']['address']['postal_code'];
if ($paymentStatus == "COMPLETED") {

    $queryGetWinnerData = "SELECT * FROM member WHERE email = '$email'";

    if ($executeWinnerQuery = mysqli_query($conn, $queryGetWinnerData)) {

        $WinnerData = mysqli_fetch_assoc($executeWinnerQuery);
        $WinnerID = $WinnerData['id'];
        $queryGetAuctionData = "SELECT * FROM auction WHERE id = '$auctionID'";

        if ($executeAuctionDataQuery = mysqli_query($conn, $queryGetAuctionData)) {

            $AuctionData = mysqli_fetch_assoc($executeAuctionDataQuery);
            $AuctionOwner = $AuctionData['owner_id'];

            $queryInsertPayment = "INSERT INTO `auction_payment` (`amount`, `paymentDate`, `shipAddress`, `shipReceiptName`, `auctionID`, `madeby`, `owner_id`) VALUES ('$paymentAmount', '$paymentDate', '$paymentAddress', '$paymentName', '$auctionID', '$WinnerID', '$AuctionOwner')";

            if ($executeInsertPaymentQuery = mysqli_query($conn, $queryInsertPayment)) {

                $queryGetPaymentData = "SELECT * FROM `auction_payment` ORDER BY id DESC LIMIT 1";

                if ($executePaymentDataQuery = mysqli_query($conn, $queryGetPaymentData)) {

                    $commissionAmount = $paymentAmount * $commissionRate;
                    $PaymentData = mysqli_fetch_assoc($executePaymentDataQuery);
                    $PaymentID = $PaymentData['id'];
                    $queryInsertCommission = "INSERT INTO `commission` (`amount`, `date`, `rate`, `referpay`, `productType`) VALUES ('$commissionAmount', '$paymentDate', '$commissionRate', '$PaymentID', 'auction')";

                    if ($executeInsertCommissionQuery = mysqli_query($conn, $queryInsertCommission)) {
                        $_SESSION['aucPaid'] = $auctionID;
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
    } else {
        echo $err;
    }
} else {
    echo $err;
}
