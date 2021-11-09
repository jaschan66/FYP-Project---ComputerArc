<?php
include "includes\dbh.inc.php";
session_start();
print_r($_POST);
if(!empty($_POST["idDelete"])){
    // echo $_POST["idDelete"];
    // die();
    $idDelete = $_POST["idDelete"];
    $deleteById = "DELETE FROM prebuildpc WHERE id = '$idDelete'";
    mysqli_query($conn, $deleteById);
}
?>