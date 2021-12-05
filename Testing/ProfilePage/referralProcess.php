<?php
include "../includes/dbh.inc.php";

$newCode = $_POST['newCode'];
if (!empty($newCode)) {
    $oldCode = $_POST['oldCode'];

    if ($oldCode != $newCode) {
        $findReferralCode = mysqli_query($conn, "SELECT * FROM `member` WHERE referralCode ='$newCode'");

        if (mysqli_num_rows($findReferralCode) > 0) {
            $findFrienddata = mysqli_fetch_assoc($findReferralCode);
            $friendID = $findFrienddata["id"];

            $updateFriendQuery = "UPDATE member SET raffleTicket = raffleTicket + 1 WHERE id = '$friendID'";
            mysqli_query($conn, $updateFriendQuery);


            $memberID = $_POST['memberID'];

            $updateQuery = "UPDATE member SET referralClaim = 1, raffleTicket = raffleTicket + 1 WHERE id = '$memberID'";

            if (mysqli_query($conn, $updateQuery)) {
                echo "Referral successfully Claimed";
            }
        }
    } else {
        echo "Please don't provide your own Referral Code";
    }
} else {
    echo "Please provide a Referral Code";
}