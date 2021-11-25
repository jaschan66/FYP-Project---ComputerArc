<?php
$rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);

include "$rootDir/FYP--ComputerArc/Testing/includes/dbh.inc.php";

date_default_timezone_set("Asia/Kuala_Lumpur");
$date_now = new DateTime();
$todayDate = date_format($date_now,"Y-m-d  H:m:s");

//echo $todayDate;

$updateStartStatus = "UPDATE auction SET status = 3 WHERE status = 1 AND start_date <= '$todayDate' ";
$updateEndStatus = "UPDATE auction SET status = 4 WHERE status = 3 AND end_date <= '$todayDate' ";

if (mysqli_query($conn, $updateStartStatus)) {

} else {
    echo "Error occured at update Start date Status: " . mysqli_error($conn);
}

if (mysqli_query($conn, $updateEndStatus)) {

} else {
    echo "Error occured at update End Date Status: " . mysqli_error($conn);
}