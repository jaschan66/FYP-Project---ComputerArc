<?php
date_default_timezone_set("Asia/Kuala_Lumpur");

$auctionTittle  = $_POST['aucTitle'];
$biddingPrice   = $_POST['bidPrice'];
$auctionStartDt = $_POST['startDate'];
$auctionEndDt   = $_POST['endDate'];
$image          = "";

if(!empty($_FILES['auctionImage']['tmp_name'])){
    $image      = addslashes(file_get_contents($_FILES['auctionImage']['tmp_name']));
}

$err = "";
$date_now = new DateTime();
$todayDate = date_format($date_now, 'Y-m-d');
$newTime = date_format($date_now, 'H:i');

// print_r($todayDate."\n");
// print_r($newTime. "\n");
// echo date("Y-m-d",strtotime($auctionStartDt));
// die();

if ($auctionTittle == "") {
    $err .= "Missing Auction Title! \n";
}

if ($biddingPrice == "") {
    $err .= "Missing Starting Bidding Price! \n";
} else if (!is_numeric($biddingPrice) || $biddingPrice <= 0) {
    $err .= "Invalid Bidding Price! \n";
}

if($auctionStartDt == "") {
    $err .= "Missing Starting Date! \n";
} else if (!(date("Y-m-d",strtotime($auctionStartDt) > $todayDate))) {
    $err .= "Choose a Starting Date in the future! \n";
}

if($auctionEndDt == "") {
    $err .= "Missing Ending Date! \n";
} else if ($auctionStartDt > $auctionEndDt) {
    $err .= "Choose an Ending Date in the future! \n";
}

if ($image == "") {
    $err .= "Please insert image! \n";
}

if (empty($err)) {
    include_once "dbh.local.inc.php";
    session_start();
    $PartnerEmail   = $_SESSION['email'];
    $PartnerRole    = $_SESSION['role'];
    $GetPartnerID    = mysqli_query($conn, "SELECT * FROM `$PartnerRole` WHERE email ='$PartnerEmail'");
    
    if (mysqli_num_rows($GetPartnerID) > 0) {
        $Getresult = mysqli_fetch_assoc($GetPartnerID);
        $GetOwnerID = $Getresult['id'];
    }
    
    $insert = "INSERT INTO auction (`title`, `starting_bid`, `image`, `start_date`, `end_date`, `owner_id`, `status`) VALUES ('$auctionTittle', '$biddingPrice', '$image', '$auctionStartDt', '$auctionEndDt', '$GetOwnerID', 0)";
    
    if (mysqli_query($conn, $insert)) {
        echo "Auction created successfuly!";
    } else {
        echo "Error occured: " . mysqli_error($conn);
    }
    
} else {
    echo "$err";
}