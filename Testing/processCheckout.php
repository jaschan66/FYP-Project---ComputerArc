<?php
include "includes/dbh.inc.php";
session_start();
$productType = $_POST['productType'];
$productID = $_POST['productID'];
$productQty = $_POST['productQty'];
$email = $_SESSION['email'];
$commissionRate = 0.06;

$err ="Error occured, please try again later.";



$paymentStatus= $_POST['paymentDetail']['status'];
$paymentAmount = $_POST['paymentDetail']['purchase_units']['0']['amount']['value'];
$paymentName = $_POST['paymentDetail']['purchase_units']['0']['shipping']['name']['full_name'];
$paymentDate = $_POST['paymentDetail']['update_time'];
$paymentAddress = $_POST['paymentDetail']['purchase_units']['0']['shipping']['address']['address_line_1'].",".$_POST['paymentDetail']['purchase_units']['0']['shipping']['address']['admin_area_2'].",".$_POST['paymentDetail']['purchase_units']['0']['shipping']['address']['admin_area_1'].",".$_POST['paymentDetail']['purchase_units']['0']['shipping']['address']['postal_code'];
if($paymentStatus == "COMPLETED"){
    $queryGetBuyerData = "SELECT * FROM member WHERE email = '$email'";
    if($executeBuyerQuery = mysqli_query($conn,$queryGetBuyerData)){
        $BuyerData = mysqli_fetch_assoc($executeBuyerQuery);
        $BuyerID = $BuyerData['id'];
        $queryGetProductData = "SELECT * FROM $productType WHERE id = '$productID'";
        if($executeProductDataQuery = mysqli_query($conn,$queryGetProductData)){
            $ProductData = mysqli_fetch_assoc($executeProductDataQuery);
            $ProductSeller = $ProductData['seller'];
            $productStockQty = $ProductData['stock'];
            $newStockQty = $productStockQty - $productQty;
            $queryUpdateStock = "UPDATE $productType SET stock = '$newStockQty' WHERE id='$productID'";
            if($executeUpdateStockQuery = mysqli_query($conn,$queryUpdateStock)){
                $queryInsertPayment = "INSERT INTO `payment` (`amount`, `paymentDate`, `shipAddress`, `shipReceiptName`, `madeby`, `seller`) VALUES ('$paymentAmount', '$paymentDate', '$paymentAddress', '$paymentName', '$BuyerID', '$ProductSeller')";
                if($executeInsertPaymentQuery = mysqli_query($conn,$queryInsertPayment)){
                    $queryGetPaymentData = "SELECT * FROM payment ORDER BY id DESC LIMIT 1 ";
                    if($executePaymentDataQuery = mysqli_query($conn,$queryGetPaymentData)){
                        $commissionAmount = $paymentAmount * $commissionRate;
                        $PaymentData = mysqli_fetch_assoc($executePaymentDataQuery);
                        $PaymentID = $PaymentData['id'];
                        $queryInsertCommission = "INSERT INTO `commission` (`date`,`rate`,`amount`,`referpay`) VALUES ('$paymentDate', '$commissionRate', '$commissionAmount', '$PaymentID')";
                            if ($executeInsertCommissionQuery = mysqli_query($conn, $queryInsertCommission)) {
                            echo "Paid successfully!";
                                }
                        else{
                       echo $err;
                        }
                    }
                    else{
                        echo $err;
                    }
                
                }
                else{
                    echo $err;
                }
            }else{
            echo $err;
            }
        }
        else{
            echo $err;
        }
    }else{
        echo $err;
    }   
}else{
    echo $err;
}
