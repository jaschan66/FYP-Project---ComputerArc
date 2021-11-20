<?php
include "..\includes\dbh.inc.php";
session_start();
$result = array( 
    'status' => FALSE,
    'message' => 'Could not connect to the database.'
); 
if(!empty($_POST["idDeletePRE"])){
    $idDelete = $_POST["idDeletePRE"];
    $deleteById = "UPDATE prebuildpc SET status = 3 WHERE id = '$idDelete'";
    if(mysqli_query($conn, $deleteById)){
        $result['status'] = TRUE;
    }
}
echo json_encode($result);
?>