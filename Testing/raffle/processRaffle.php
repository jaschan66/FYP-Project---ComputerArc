<?php
include "../includes/dbh.inc.php";



$memberID = $_POST['memberid'];
$raffleJoined = $_POST['raffleid'];
$requireticket = $_POST['reqTicket'];
$availableTicket = $_POST['avaiTicket'];
$newTicketAmount = $availableTicket - $requireticket;

$queryInsertRaffleDetail = "INSERT INTO `raffle_detail` (`memberJoined`,`raffleJoined`) VALUES ('$memberID', '$raffleJoined')";
if(mysqli_query($conn,$queryInsertRaffleDetail)){
    $queryUpdateRaffleTicket = "UPDATE member SET raffleTicket = $newTicketAmount WHERE id = '$memberID'";
    $queryUpdateRaffle = "UPDATE raffle SET currentParticipant = currentParticipant + 1 WHERE id = '$raffleJoined'";
    if(mysqli_query($conn,$queryUpdateRaffle) && mysqli_query($conn,$queryUpdateRaffleTicket)){
        echo "Raffle Joined!";
        
    }
    else{
        echo "Error occured, please try again later.";
    }
}
else{
    echo "Error occured, please try again later.";
}
