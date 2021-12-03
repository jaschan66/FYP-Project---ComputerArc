<?php
date_default_timezone_set("Asia/Kuala_Lumpur");

$raffleTitle  = $_POST['rafTitle'];
$requireTicket   = $_POST['reqTicket'];
$maxPartici     = $_POST['maxParti'];
$raffleEndDt   = $_POST['endDate'];
$image          = "";

if(!empty($_FILES['raffleImage']['tmp_name'])){
    $image      = addslashes(file_get_contents($_FILES['raffleImage']['tmp_name']));
}

$err = "";
$date_now = new DateTime();
$todayDate = date_format($date_now, 'Y-m-d');
$newTime = date_format($date_now, 'H:i');



if ($raffleTitle == "") {
    $err .= "-Missing Raffle Title! \n";
}

if ($maxPartici == "") {
    $err .= "-Missing maximum number of participant! \n";
} else if (!is_numeric($maxPartici) || $maxPartici <= 0) {
    $err .= "-Invalid maximum number of participant! \n";
}

if ($requireTicket == "") {
    $err .= -"Missing require ticket Price! \n";
} else if (!is_numeric($requireTicket) || $requireTicket <= 0) {
    $err .= "-Invalid require ticket! \n";
}

if($raffleEndDt == "") {
    $err .= "-Missing Ending Date! \n";
} else if ($todayDate > $raffleEndDt) {
    $err .= "-Choose an Ending Date in the future! \n";
}

if ($image == "") {
    $err .= "-Please insert image! \n";
}

if (empty($err)) {
    include "../includes/dbh.local.inc.php";
    session_start();
    
    $insert = "INSERT INTO raffle (`name`, `ticket`, `image`, `end_date`, `participant_num`, `status`) VALUES ('$raffleTitle', '$requireTicket', '$image', '$raffleEndDt', '$maxPartici', 1)";
    
    if (mysqli_query($conn, $insert)) {
        echo "Raffle created successfuly!";
    } else {
        echo "Error occured: " . mysqli_error($conn);
    }
    
} else {
    echo "$err";
}