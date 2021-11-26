<?php
include "../includes/dbh.inc.php";
session_start();

if(!empty($_POST["idDelete"])){

    $idDelete = $_POST["idDelete"];
    //$deleteById = "DELETE FROM auction WHERE id = '$idDelete'";
    $deleteById = "UPDATE auction SET status = 5 WHERE id = '$idDelete'";
    if (mysqli_query($conn, $deleteById)) {
        echo "Auction deleted successful";
    }
} else {
    echo "Failed to delete Auction";
}
?>