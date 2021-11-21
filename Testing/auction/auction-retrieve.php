<?php
include "includes/dbh.inc.php";
session_start();
$aucID = $_GET['idRetrieve'];
$getAucData = "SELECT * FROM auction WHERE id = '$aucID'";
$connGetData = mysqli_query($conn, $getAucData);
$resultGetData = mysqli_fetch_assoc($connGetData);

if (mysqli_query($conn, $getAucData)) {

} else {
    header("Location: homepage.php");
}
