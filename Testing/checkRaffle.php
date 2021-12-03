<?php
$queryGetRaffleData = "SELECT * FROM raffle WHERE status = 1";
$executeGetRaffleData = mysqli_query($conn, $queryGetRaffleData);
while ($getRaffleData = mysqli_fetch_array($executeGetRaffleData)) {
    if (strtotime((new DateTime())->format("Y-m-d H:i:s")) > strtotime($getRaffleData['end_date']) || $getRaffleData['currentParticipant'] >= $getRaffleData['participant_num'] ) {
        $raffleID = $getRaffleData['id'];
        $queryUpdateRaffleStatus = "UPDATE raffle SET status = 2 WHERE id = '$raffleID'";
        $executeUpdateRaffle = mysqli_query($conn, $queryUpdateRaffleStatus);
    }
}

$queryGetConcludedRaffleData = "SELECT * FROM raffle WHERE status = 2";
$executeGetConcludedRaffleData = mysqli_query($conn,$queryGetConcludedRaffleData);
while($getConcludedRaffleData = mysqli_fetch_array($executeGetConcludedRaffleData)){
    if($getConcludedRaffleData['winner'] == null){
        $concludedRaffleID = $getConcludedRaffleData['id'];
        $querySelectFromRaffleDetail = "SELECT * FROM raffle_detail WHERE raffleJoined = '$concludedRaffleID' ORDER BY RAND ( )
        LIMIT 1";

        $executeSelectFromRaffleDetail = mysqli_query($conn,$querySelectFromRaffleDetail);
        $getSelectFromRaffleDetail = mysqli_fetch_assoc($executeSelectFromRaffleDetail);
        $winnerID = $getSelectFromRaffleDetail['memberJoined'];

        $queryUpdateWinner = "UPDATE raffle SET winner = $winnerID WHERE id = '$concludedRaffleID'";

        $executeUpdateWinner = mysqli_query($conn,$queryUpdateWinner);

    }
}
