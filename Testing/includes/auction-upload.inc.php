<?php

if (isset($_POST['btnCreateAuction'])) {
    include_once "dbh.local.inc.php";
    session_start();
    $PartnerEmail   = $_SESSION['email'];
    $PartnerRole    = $_SESSION['role'];
    $GetPartnerID    = mysqli_query($conn, "SELECT * FROM `$PartnerRole` WHERE email ='$PartnerEmail'");
    
    if (mysqli_num_rows($GetPartnerID) > 0) {
        $Getresult = mysqli_fetch_assoc($GetPartnerID);
        $GetOwnerID = $Getresult['id'];
    }

    $auctionTittle  = $_POST['aucTitle'];
    $biddingPrice   = $_POST['bidPrice'];
    $auctionStartDt = $_POST['startDate'];
    $auctionEndDt   = $_POST['endDate'];
    $image          = addslashes(file_get_contents($_FILES['auctionImage']['tmp_name']));

    $insert = "INSERT INTO auction (`title`, `starting_bid`, `image`, `start_date`, `end_date`, `owner_id`) VALUES ('$auctionTittle', '$biddingPrice', '$image', '$auctionStartDt', '$auctionEndDt', '$GetOwnerID')";

    if (mysqli_query($conn, $insert)) {
        //header("Location: auctionPage.php");
    } else {
        echo "Error occured: " . mysqli_error($conn);
    }
}