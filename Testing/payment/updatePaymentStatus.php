<?php
include "../includes/dbh.inc.php";
$statusUpdate = $_POST['updateStatus'];
$paymentID = $_POST['paymentId'];

$queryUpdatePaymentStatus = "UPDATE payment SET status = '$statusUpdate' WHERE id = '$paymentID'";

if(mysqli_query($conn,$queryUpdatePaymentStatus)){
    echo "Status updated successfully";
}
else{
    echo "Please try again later";
}


?>