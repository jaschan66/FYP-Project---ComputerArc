<?php
date_default_timezone_set("Asia/Kuala_Lumpur");
session_start();

$startDate = $_POST['startDate'];
$endDate = $_POST['endDate'];
$itemType = $_POST['itemType'];
$idRetrieve = $_POST['idRetrieve'];

$date_now = new DateTime();
$todayDate = date_format($date_now, 'Y-m-d');
$newTime = date_format($date_now, 'H:i');
$err = "";

if (empty($startDate)) {
    $err .= "Missing Starting Date! \n";
} else if (!(date("Y-m-d", strtotime($startDate) > $todayDate))) {
    $err .= "Choose a Starting Date in the future! \n";
}

if (empty($endDate)) {
    $err .= "Missing Ending Date! \n";
} else if ($startDate > $endDate) {
    $err .= "Choose an Ending Date in the future! \n";
}

if (empty($err)) {
    include "../includes/dbh.inc.php";
    $PartnerEmail  = $_SESSION['email'];
    $GetPartnerID  = mysqli_query($conn, "SELECT * FROM `partner` WHERE email ='$PartnerEmail'");

    if (mysqli_num_rows($GetPartnerID) > 0) {
        $Getresult = mysqli_fetch_assoc($GetPartnerID);
        $GetOwnerID = $Getresult['id'];
    }

    $insert = "INSERT INTO advertisement (`start_date`, `end_date`, `itemType`, `idRetrieve`, `partner_id`, `status`) VALUES ('$startDate', '$endDate', '$itemType', '$idRetrieve', '$GetOwnerID', 0)";

    if (mysqli_query($conn, $insert)) {
        echo "Valid Advertisement";
    }
} else {
    echo "$err";
}
