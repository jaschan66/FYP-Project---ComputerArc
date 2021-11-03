<?php

if (isset($_POST['btnSubmit'])) {
    include_once "dbh.local.inc.php";

    $auctionTittle  = $_POST['aucTitle'];
    $biddingPrice   = $_POST['bidPrice'];
    $auctionStartDt = $_POST['startDate'];
    $auctionEndDt   = $_POST['endDate'];
    $image          = addslashes(file_get_contents($_FILES['memberprofilepic']['tmp_name']));

    $insert = "INSERT INTO auction (`title`, `starting_bid`, `image`, `start_date`, `end_date`) VALUES ('$auctionTittle', '$biddingPrice', '$image', '$auctionStartDt', '$auctionEndDt')";

    if (mysqli_query($conn, $insert)) {
        header("Location: auctionPage.php");
    } else {
        echo "Error occured: " . mysqli_error($conn);
    }
}