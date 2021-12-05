<?php

include "includes/dbh.local.inc.php";

$memberEmail = $_POST['memberemail'];
$memberPass = $_POST['memberpassword'];
$memberUsername = $_POST['memberusername'];
$memberTelno = $_POST['membertelno'];
$memberStatus = 1;
$memberJoineddate = date("Y/m/d");


$sqlcheckdupname = mysqli_query($conn, "SELECT * FROM `member` WHERE name ='$memberUsername'");



$err = "";

if ($_FILES['memberprofilepic']['size'] > 0) {
    $memberProfilepic = addslashes(file_get_contents($_FILES['memberprofilepic']['tmp_name']));
} else {
    $err .= "-Image should not be empty\n";
}

if (mysqli_num_rows($sqlcheckdupname) > 0) {
    $err .= "-Username has already been used\n";
}

if (!filter_var($memberEmail, FILTER_VALIDATE_EMAIL)) {
    $err = "-Invalid email format\n";
}

if ($memberTelno == "") {
    $err .= "-Missing Tel No \n";
}

if (!filter_var($memberTelno, FILTER_SANITIZE_NUMBER_INT)) {
    $err .= "-Invalid Tel No Format \n";
}

if ($memberUsername == "") {
    $err .= "-Missing Username \n";
}

if ($memberEmail == "") {
    $err .= "-Missing email \n";
}

if ($memberPass == "") {
    $err .= "-Missing password \n";
}

if (strlen($memberPass) <= '6') {
    $err .= "-Your Password Must Contain At Least 6 Characters!\n";
} elseif (!preg_match("#[0-9]+#", $memberPass)) {
    $err .= "-Your Password Must Contain At Least 1 Number!\n";
} elseif (!preg_match("#[A-Z]+#", $memberPass)) {
    $err .= "-Your Password Must Contain At Least 1 Capital Letter!\n";
} elseif (!preg_match("#[a-z]+#", $memberPass)) {
    $err .= "-Your Password Must Contain At Least 1 Lowercase Letter!\n";
}



if (empty($err)) {
    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
    // Output: 54esmdr0qf
    $referralCode = substr(str_shuffle($permitted_chars), 0, 10);

    $insert = "INSERT INTO `member` (`name`, `email`,  `pass`, `telNo`, `status`, `datejoined`, `profilepic`, `referralCode`) VALUES ('$memberUsername', '$memberEmail',  '$memberPass', '$memberTelno', '$memberStatus', '$memberJoineddate', '$memberProfilepic', '$referralCode')";


    if (mysqli_query($conn, $insert)) {
        echo "Sign Up Successfully!";
    } else {
        echo $err;
    }
} else {
    echo $err;
}
