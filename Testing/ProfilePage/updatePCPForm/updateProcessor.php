<?php

  $pcpid = $_GET['idUpdatePCP'];
  $queryGetProcessor = mysqli_query($conn, "SELECT * FROM processor WHERE pcpno = $pcpid");
  $resultGetProcessor = mysqli_fetch_assoc($queryGetProcessor);


if(isset($_POST['btnSubmitUpdateProcessor'])){

  $updatePCPname = $_POST['PCPupdatename'];
  $updatePCPprice = $_POST['PCPupdateprice'];
  $updatePCPstock = $_POST['PCPupdatestock'];
  $updatePCPdesc = $_POST['PCPupdatedesc'];
  $updatePCPprocessorclockspeed = $_POST['PCPupdateProcessorclockspeed'];
  $updatePCPprocessorsocket = $_POST['PCPupdateProcessorsocket'];
  $updatePCPprocessorpowerconsumption = $_POST['PCPupdateProcessorpowerconsumption'];
  
  
  if ($updatePCPname != "" && $updatePCPprice != "" && $updatePCPprocessorclockspeed != "" && $updatePCPstock != "" && $updatePCPdesc != "" && $updatePCPprocessorsocket != "" && $updatePCPprocessorpowerconsumption != ""){
      $queryWithUpdatePicture = "";
              if ($_FILES['updatePCPpic']['size'] > 0) {
                  $updatePCPpic = addslashes(file_get_contents($_FILES['updatePCPpic']['tmp_name']));
                  $queryWithUpdatePicture = ", image = '$updatePCPpic'";
              }
  
              $updatePCPQuery = "UPDATE pcpart SET name = '$updatePCPname', price = '$updatePCPprice', description = '$updatePCPdesc', stock = '$updatePCPstock'
              $queryWithUpdatePicture WHERE id = '$pcpid'";

              $updateProcessorQuery = "UPDATE processor SET socket = '$updatePCPprocessorsocket', clockspeed = '$updatePCPprocessorclockspeed', powerconsumption = '$updatePCPprocessorpowerconsumption' WHERE pcpno = '$pcpid'";
               
          if (mysqli_query($conn, $updatePCPQuery) && mysqli_query($conn, $updateProcessorQuery)) {
              echo "<script>
              window.location.href = \"profilePage.php?editPCP=1&editProf=0&editPRE=0&editAuc=0\";
              </script>";
          } else {
              echo mysqli_error($conn);
      }
  }
  }
  

?>


<form style='font-family: Questrial; text-align: left' method='POST' enctype='multipart/form-data'>


<input type="hidden" value="<?=$PCPtype ?>" name="PCPpart" >
    <div class='formspacing'>
        <p class='formlabel'>Name</p>
        <input type='text' class='form-control' id='PCPupdatename' placeholder='PC Part Name' name='PCPupdatename' value='<?php  echo $resultgetData['name'] ?>'>
    </div>

    <div class='formspacing'>
        <p class='formlabel'>Price</p>
        <input type='text' pattern='^\d+(\.|\,)\d{2}$' required placeholder='e.g. 999.99' class='form-control' name='PCPupdateprice' value='<?php  echo $resultgetData['price'] ?>'>
    </div>


    <div class='formspacing'>
        <p class='formlabel'>Stock Quantity</p>
        <input type='text' pattern="[0-9]+" required placeholder='e.g. 10' class='form-control' name='PCPupdatestock' value='<?php  echo $resultgetData['stock'] ?>'>
    </div>

    <div class='formspacing'>
        <p class='formlabel'>Description</p>
        <input type='text' placeholder='e.g. A strong pre-build pc that is able to run every game in the current market.' class='form-control' name='PCPupdatedesc' value='<?php  echo $resultgetData['description'] ?>'>
    </div>

    <div class='formspacing'>
        <p class='formlabel'>Product Picture&nbsp;<a href='#' data-toggle='tooltip' title='Your existing picture will be used if no picture is uploaded' style='font-size:1.2vw'><i class='fas fa-question-circle'></i></a></p>
        <input class='filepond' id='updatePCPpic' name='updatePCPpic' type='file'>
    </div>

    <div class='formspacing'>
        <p class='formlabel'>Clock speed (GHz)</p>
        <input class='form-control' id='PCPupdateProcessorclockspeed' name='PCPupdateProcessorclockspeed' type='number' step=".1" placeholder='e.g. 3.0' value='<?php  echo $resultGetProcessor['clockspeed'] ?>'>
    </div>

    <div class='formspacing'>
        <p class='formlabel'>Socket</p>
        <input class='form-control' id='PCPupdateProcessorsocket' name='PCPupdateProcessorsocket' type='text' placeholder='e.g. LGA1151' value='<?php  echo $resultGetProcessor['socket'] ?>'>
    </div>

    <div class='formspacing'>
        <p class='formlabel'>Power consumption (Watts)</p>
        <input class='form-control' id='PCPupdateProcessorpowerconsumption' name='PCPupdateProcessorpowerconsumption' type='text' pattern="[0-9]+" placeholder='e.g. 85' value='<?php  echo $resultGetProcessor['powerconsumption'] ?>'>
    </div>

    <input type='submit' name='btnSubmitUpdateProcessor' class='btn btn-dark' style='font-size: 1vw; font-family: Questrial; width:100%; margin-bottom: 2vh;' value='Update'>
</form>