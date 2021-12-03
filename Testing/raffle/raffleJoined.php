<?php
session_start();
$email = $_SESSION['email'];
$queryGetMemberDetail = "SELECT * FROM member WHERE email = '$email'";
$executeGetMemberDetail = mysqli_query($conn, $queryGetMemberDetail);
$getMemberID = mysqli_fetch_assoc($executeGetMemberDetail);
$memberID = $getMemberID['id'];
$progress = 0;


$queryGetRaffleDetail = "SELECT * FROM raffle_detail WHERE memberJoined = '$memberID'";
$executeGetRaffleDetail = mysqli_query($conn, $queryGetRaffleDetail);
while ($getRaffleDetail = mysqli_fetch_array($executeGetRaffleDetail)) {
    
    $raffleID = $getRaffleDetail['raffleJoined'];
    $queryGetRaffleData = "SELECT * FROM raffle WHERE id = '$raffleID'";
    $executeGetRaffleData = mysqli_query($conn, $queryGetRaffleData);
    $getRaffleData = mysqli_fetch_assoc($executeGetRaffleData);
    $progress = ($getRaffleData['currentParticipant'] / $getRaffleData['participant_num']) * 100;
?>
    <div class="col-sm-12">
        <div class="card" style="width:100%; margin-bottom:1.5vh">
            <img class="card-img-top" src="data:image/jpg;base64,<?php echo base64_encode($getRaffleData['image']) ?>" style="object-fit:contain; height:360px;" alt="Card image cap">
            <div class="card-body">
                <hr>

                <h5 class="card-title"><?php echo $getRaffleData['name'] ?></h5>
                <p class="card-text"><b>Ticket Cost:</b><?php echo $getRaffleData['ticket'] ?></p>
                <p class="card-text">End date: <?php echo $getRaffleData['end_date'] ?></p>
                <p class="card-text">Participant Capacity:</p>
                <div class="progress" style="margin-bottom:2vh">
                    <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="<?php echo $progress ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $progress ?>%">

                    </div>
                </div>
                <?php
                    if($getRaffleData['winner'] != null){
                        $winnerID = $getRaffleData['winner'];
                        $queryGetmember = "SELECT * FROM member WHERE id = '$winnerID'";
                        $executeGetMember = mysqli_query($conn,$queryGetmember);
                        $memberData = mysqli_fetch_assoc($executeGetMember);
                        ?>
                        <div class="card-footer text-center statusUp">
                        <p class="card-text">Winner: <?php echo $memberData['name']  ?></p>

                        </div>

                        <?php
                    }
                ?>
            </div>
        </div>
    </div>

<?php
}

?>