<?php
include "../includes/dbh.inc.php";

if (!empty($_POST["idPCPReject"])) {
    $idReject = $_POST['idPCPReject'];

    $updateQuery = "UPDATE pcpart SET status = 4 WHERE id = '$idReject'";

    if (mysqli_query($conn, $updateQuery)) {
        echo "Approval Rejected";
    } 
} else if (!empty($_POST["idPREReject"])) {
    $idReject = $_POST['idPREReject'];

    $updateQuery = "UPDATE prebuildpc SET status = 4 WHERE id = '$idReject'";

    if (mysqli_query($conn, $updateQuery)) {
        echo "Approval Rejected";
    }
} else if (!empty($_POST["idAUCReject"])) {
    $idReject = $_POST["idAUCReject"];

    $updateQuery = "UPDATE auction SET status = 2 WHERE id = '$idReject'";

    if (mysqli_query($conn, $updateQuery)) {
        echo "Approval Rejected";
    }
} else {
    echo "Something went wrong when rejecting the approval, please try again later.";
    //echo mysqli_error($conn);
}
