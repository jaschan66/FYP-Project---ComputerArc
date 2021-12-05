<?php
include "../includes/dbh.inc.php";
date_default_timezone_set("Asia/Kuala_Lumpur");
if (!empty($_POST["idAUCBid"])) {
    $idAUC = $_POST['idAUCBid'];

    if (!empty($_POST["bidAmount"])) {
        $bidAmount = $_POST['bidAmount'];

        if (is_numeric($bidAmount) && $bidAmount > 0) {
            $highestBid = $_POST['highestBid'];

            if ($bidAmount > $highestBid) {
                session_start();
                $MemberEmail  = $_SESSION['email'];
                $GetMemberID = mysqli_query($conn, "SELECT * FROM `member` WHERE email ='$MemberEmail'");

                if (mysqli_num_rows($GetMemberID) > 0) {
                    $Getresult = mysqli_fetch_assoc($GetMemberID);
                    $GetBidderID = $Getresult['id'];
                }
                $date_now = new DateTime();
                $todayDate = date_format($date_now, 'Y-m-d H:i:s');

                $insertQuery = "INSERT INTO auction_detail (`auctionID`,`date_join`,`amount_bid`,`participant_id`) VALUES ('$idAUC','$todayDate','$bidAmount','$GetBidderID')";

                if (mysqli_query($conn, $insertQuery)) {
                    echo "Your bid has been accepted";
                }
            } else {
                echo "Your Bid amount is lower than the highest bidder";
            }

        } else {
            echo "Invalid bid amount";
        }
    } else {
        echo "Please place your bid";
    }
} else {
    echo "Something went wrong when placing your bidding, please try again later.";
    //echo mysqli_error($conn);
}
