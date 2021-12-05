<?php
include "../includes/dbh.inc.php";
session_start();
$advertID = $_POST['advertisementID'];
$total = $_POST['total'];
$email = $_SESSION['email'];

$err = "Error occured, please try again later.";

$paymentStatus = $_POST['paymentDetail']['status'];
$paymentAmount = $_POST['paymentDetail']['purchase_units']['0']['amount']['value'];
$paymentName = $_POST['paymentDetail']['purchase_units']['0']['shipping']['name']['full_name'];
$paymentDate = $_POST['paymentDetail']['update_time'];
$paymentAddress = $_POST['paymentDetail']['purchase_units']['0']['shipping']['address']['address_line_1'] . "," . $_POST['paymentDetail']['purchase_units']['0']['shipping']['address']['admin_area_2'] . "," . $_POST['paymentDetail']['purchase_units']['0']['shipping']['address']['admin_area_1'] . "," . $_POST['paymentDetail']['purchase_units']['0']['shipping']['address']['postal_code'];
if ($paymentStatus == "COMPLETED") {

    $queryGetPartnerData = "SELECT * FROM `partner` WHERE email = '$email'";

    if ($executePartnerQuery = mysqli_query($conn, $queryGetPartnerData)) {

        $PartnerData = mysqli_fetch_assoc($executePartnerQuery);
        $PartnerID = $PartnerData['id'];
        $queryUpdateMember = "UPDATE advertisement SET status = 1 WHERE id = '$advertID'";

        if ($executeAdvertisementDataQuery = mysqli_query($conn, $queryUpdateMember)) {

            $queryInsertDeposit = "INSERT INTO `advertisement_payment` (`amount`, `paymentDate`, `shipAddress`, `shipReceiptName`, `advertisementID`, `madeby`) VALUES ('$paymentAmount', '$paymentDate', '$paymentAddress', '$paymentName', '$advertID', '$PartnerID')";

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
