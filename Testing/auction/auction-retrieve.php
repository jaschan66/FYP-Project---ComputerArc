<?php
include "includes/dbh.inc.php";
date_default_timezone_set("Asia/Kuala_Lumpur");

$aucID = $_GET['idRetrieve'];
$getAucData = "SELECT * FROM auction WHERE id = '$aucID'";

$connGetData = mysqli_query($conn, $getAucData);
$resultGetData = mysqli_fetch_assoc($connGetData);

$countDownDateTime = date("M d, Y H:i:s", strtotime($resultGetData["end_date"]));

if (mysqli_query($conn, $getAucData)) {

    if (!empty($resultGetData)) {

        $partnerID = $resultGetData["owner_id"];

        $getPartnerInfo = "SELECT * FROM partner WHERE id = '$partnerID'";
        $connGetData = mysqli_query($conn, $getPartnerInfo);
        $resultPartnerData = mysqli_fetch_assoc($connGetData);

        if (mysqli_query($conn, $getPartnerInfo)) {
        }
    } else {
        header("Location: error.php");
    }
} else {
    header("Location: homepage.php");
}
