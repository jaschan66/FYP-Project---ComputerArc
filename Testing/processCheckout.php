<?php
include "includes/dbh.inc.php";
session_start();

$productType = $_POST['productType'];
$productID = $_POST['productID'];
$productQty = $_POST['productQty'];
$email = $_SESSION['email'];
$commissionRate = 0.06;
date_default_timezone_set("Asia/Kuala_Lumpur");

$err = "Error occured, please try again later.";


$paymentStatus = $_POST['paymentDetail']['status'];
$paymentAmount = $_POST['paymentDetail']['purchase_units']['0']['amount']['value'];
$raffleTicket = floor($paymentAmount/200);
$paymentName = $_POST['paymentDetail']['purchase_units']['0']['shipping']['name']['full_name'];
$paymentDate = date("Y-m-d h:i:s");
$paymentStatus = 1;
$paymentAddress = $_POST['paymentDetail']['purchase_units']['0']['shipping']['address']['address_line_1'] . "," . $_POST['paymentDetail']['purchase_units']['0']['shipping']['address']['admin_area_2'] . "," . $_POST['paymentDetail']['purchase_units']['0']['shipping']['address']['admin_area_1'] . "," . $_POST['paymentDetail']['purchase_units']['0']['shipping']['address']['postal_code'];
    $queryGetBuyerData = "SELECT * FROM member WHERE email = '$email'";
    if ($executeBuyerQuery = mysqli_query($conn, $queryGetBuyerData)) {
        $BuyerData = mysqli_fetch_assoc($executeBuyerQuery);
        $BuyerID = $BuyerData['id'];
        $queryGetProductData = "SELECT * FROM $productType WHERE id = '$productID'";
        if ($executeProductDataQuery = mysqli_query($conn, $queryGetProductData)) {
            $ProductData = mysqli_fetch_assoc($executeProductDataQuery);
            $ProductSeller = $ProductData['seller'];
            $productStockQty = $ProductData['stock'];
            $newStockQty = $productStockQty - $productQty;
            $queryUpdateStock = "UPDATE $productType SET stock = stock - '$productQty' WHERE id='$productID'";
            if ($executeUpdateStockQuery = mysqli_query($conn, $queryUpdateStock) && $newStockQty >=0) {
                $queryInsertPayment = "INSERT INTO `payment` (`amount`, `paymentDate`, `shipAddress`, `shipReceiptName`, `madeby`, `seller`, `productType`, `productID`, `productQty`, `status`) VALUES ('$paymentAmount', '$paymentDate', '$paymentAddress', '$paymentName', '$BuyerID', '$ProductSeller','$productType', '$productID', '$productQty', '$paymentStatus')";
                if ($executeInsertPaymentQuery = mysqli_query($conn, $queryInsertPayment)) {
                    $queryGetPaymentData = "SELECT * FROM payment ORDER BY id DESC LIMIT 1 ";
                    if ($executePaymentDataQuery = mysqli_query($conn, $queryGetPaymentData)) {
                        $commissionAmount = $paymentAmount * $commissionRate;
                        $PaymentData = mysqli_fetch_assoc($executePaymentDataQuery);
                        $PaymentID = $PaymentData['id'];
                        $PaymentSeller = $PaymentData['seller'];
                        $queryInsertCommission = "INSERT INTO `commission` (`date`,`rate`,`amount`,`referpay`,`productType`) VALUES ('$paymentDate', '$commissionRate', '$commissionAmount', '$PaymentID', '$productType')";
                        if ($executeInsertCommissionQuery = mysqli_query($conn, $queryInsertCommission) && $productType != "") {
                            $queryUpdateMember = "UPDATE member SET raffleTicket = raffleticket + '$raffleTicket' WHERE id = '$BuyerID'";
                            if($executeUpdateMember = mysqli_query($conn,$queryUpdateMember)){
                            $queryGetSellerData = "SELECT * FROM partner WHERE id = $PaymentSeller";
                            $executeSellerData = mysqli_query($conn,$queryGetSellerData);
                            $getSellerData = mysqli_fetch_assoc($executeSellerData); 
                            $transactionData = [
                                "raffleTicket" => $raffleTicket,
                                "productID" => $productID,
                                "productType" => $productType,
                                "productName" => $ProductData['name'],
                                "quantity" => $productQty,
                                "paymentAmount" => $paymentAmount,
                                "paymentDate" =>$paymentDate,
                                "sellerName" => $getSellerData['name'],
                                "sellerTelNo" => $getSellerData['telNo']
                            ];
                            echo json_encode($transactionData);
                            exit();
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
}else{
    echo $err;
}

?>
