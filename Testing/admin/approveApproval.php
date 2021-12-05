<?php
include "../includes/dbh.inc.php";

if (!empty($_POST["idPCPApprove"])) {
    $idApprove = $_POST['idPCPApprove'];

    $updateQuery = "UPDATE pcpart SET status = 1 WHERE id = '$idApprove'";

    if (mysqli_query($conn, $updateQuery)) {
        echo "Item is now on listing";
    } 
} else if (!empty($_POST["idPREApprove"])) {
    $idApprove = $_POST['idPREApprove'];

    $updateQuery = "UPDATE prebuildpc SET status = 1 WHERE id = '$idApprove'";

    if (mysqli_query($conn, $updateQuery)) {
        echo "Item is now on listing";
    }
} else if (!empty($_POST["idAUCApprove"])) {
    $idApprove = $_POST["idAUCApprove"];

    $updateQuery = "UPDATE auction SET status = 1 WHERE id = '$idApprove'";

    if (mysqli_query($conn, $updateQuery)) {
        echo "Item is now on listing";
    }
} else {
    echo "Something went wrong when approving the approval, please try again later.";
    //echo mysqli_error($conn);
}
