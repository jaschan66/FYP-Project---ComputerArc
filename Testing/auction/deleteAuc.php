<?php
include "../includes/dbh.inc.php";
session_start();

if(!empty($_POST["idDelete"])){

    $idDelete = $_POST["idDelete"];
    $deleteById = "DELETE FROM auction WHERE id = '$idDelete'";
    if (mysqli_query($conn, $deleteById)) {
        echo "Auction deleted successful";
    }
}
?>