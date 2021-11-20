<?php 
include "includes\dbh.inc.php";
session_start();
$updatePCPID = $_GET['idUpdatePCP'];
$getPCPData = "SELECT * FROM pcpart WHERE id = '$updatePCPID'";
$conngetData = mysqli_query($conn, $getPCPData);
$resultgetData = mysqli_fetch_assoc($conngetData);

 
$pcppartname = $resultgetData['part'];

        if($pcppartname == "mobo"){
            include "updatePCPForm/updateMobo.php";
        }
        else if($pcppartname == "RAM"){
            include "updatePCPForm/updateRam.php";
        }
        else if($pcppartname == "PSU"){
            include "updatePCPForm/updatePsu.php";
        }
        else if($pcppartname == "adapter"){
            include "updatePCPForm/updateAdapter.php";
        }
        else if($pcppartname == "casing"){
            include "updatePCPForm/updateCasing.php";
        }
        else if($pcppartname == "cooler"){
            include "updatePCPForm/updateCooler.php";
        }
        else if($pcppartname == "GPU"){
            include "updatePCPForm/updateGpu.php";
        }
        else if($pcppartname == "storage"){
            include "updatePCPForm/updateStorage.php";
        }
        else if($pcppartname == "processor"){
            include "updatePCPForm/updateProcessor.php";
        }

?>