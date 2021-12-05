<?php
date_default_timezone_set("Asia/Kuala_Lumpur");
session_start();

$updateAucID = $_GET['idUpdate'];
$updateAucTitle = $_POST['updateAucTitle'];
$updateAucBidPrice = $_POST['updateBidPrice'];
$updateAucStartDate = $_POST['updateStartDate'];
$updateAucEndDate = $_POST['updateEndDate'];

$err = "";
$date_now = new DateTime();
$todayDate = date_format($date_now, 'Y-m-d');
$newTime = date_format($date_now, 'H:i');

if ($updateAucTitle == "") {
    $err .= "Missing Auction Title! \n";
}

if ($updateAucBidPrice == "") {
    $err .= "Missing Starting Bidding Price! \n";
} else if (!is_numeric($updateAucBidPrice) || $updateAucBidPrice <= 0) {
    $err .= "Invalid Bidding Price! \n";
}

if($updateAucStartDate == "") {
    $err .= "Missing Starting Date! \n";
} else if (!(date("Y-m-d",strtotime($updateAucStartDate) > $todayDate))) {
    $err .= "Choose a Starting Date in the future! \n";
}

if($updateAucEndDate == "") {
    $err .= "Missing Ending Date! \n";
} else if ($updateAucStartDate > $updateAucEndDate) {
    $err .= "Choose an Ending Date in the future! \n";
}

if (empty($err)) {
    include "../includes/dbh.inc.php";

    $queryWithUpdatePicture = "";
    if ($_FILES['updateAucImage']['size'] > 0) {
        $updateAucImage = addslashes(file_get_contents($_FILES['updateAucImage']['tmp_name']));
        $queryWithUpdatePicture = ", image = '$updateAucImage'";
    }

    $updateQuery = "UPDATE auction SET title = '$updateAucTitle', starting_bid = '$updateAucBidPrice', start_date = '$updateAucStartDate', end_date = '$updateAucEndDate', status = 0 
                        $queryWithUpdatePicture WHERE id = '$updateAucID'";

    header("Location: ../includes/generateApproval.php?adminType=3&itemType=3&itemName=$updateAucTitle");

    if (mysqli_query($conn, $updateQuery)) {
        echo "Approval successfully sent to Admin";
    } else {
        echo "Something went wrong when updating your auction, please try again later.";
        //echo mysqli_error($conn);
    }
} else {
    echo "$err";
}
