<?php
include "../includes/dbh.inc.php";

$feedback = $_POST['feedback'];
if (!empty($feedback)) {

    if (strlen($feedback) > 10) {

        if (!empty($_POST["idPCPReject"])) {
            $idReject = $_POST['idPCPReject'];

            $updateQuery = "UPDATE pcpart SET status = 4, comment = '$feedback' WHERE id = '$idReject'";

            if (mysqli_query($conn, $updateQuery)) {
                echo "Approval has been Rejected";
            }
        } else if (!empty($_POST["idPREReject"])) {
            $idReject = $_POST['idPREReject'];

            $updateQuery = "UPDATE prebuildpc SET status = 4, comment = '$feedback'  WHERE id = '$idReject'";

            if (mysqli_query($conn, $updateQuery)) {
                echo "Approval has been Rejected";
            } else {
                echo mysqli_error($conn);
            }
        } else if (!empty($_POST["idAUCReject"])) {
            $idReject = $_POST["idAUCReject"];

            $updateQuery = "UPDATE auction SET status = 2, comment = '$feedback' WHERE id = '$idReject'";

            if (mysqli_query($conn, $updateQuery)) {
                echo "Approval has been Rejected";
            }
        } else {
            echo "Something went wrong when rejecting the approval, please try again later.";
            echo mysqli_error($conn);
        }
    } else {
        echo "Please provide more feedback";
    }
} else {
    echo "Please provide some feedback";
}
