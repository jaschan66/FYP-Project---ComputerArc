<?php 
    $PCPtype = $_POST['PCPpart'];
?>


<?php 
        if($PCPtype == "mobo"){
            include "addPCPForm/addMobo.php";
        }
        else if($PCPtype == "ram"){
            include "addPCPForm/addRam.php";
        }
        else if($PCPtype == "psu"){
            include "addPCPForm/addPsu.php";
        }
        else if($PCPtype == "adapter"){
            include "addPCPForm/addAdapter.php";
        }
        else if($PCPtype == "casing"){
            include "addPCPForm/addCasing.php";
        }
        else if($PCPtype == "cooler"){
            include "addPCPForm/addCooler.php";
        }
        else if($PCPtype == "gpu"){
            include "addPCPForm/addGpu.php";
        }
        else if($PCPtype == "storage"){
            include "addPCPForm/addStorage.php";
        }
        else if($PCPtype == "processor"){
            include "addPCPForm/addProcessor.php";
        }

    
    ?>

    

