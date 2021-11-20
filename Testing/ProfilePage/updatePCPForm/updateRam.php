<?php

  $pcpid = $_GET['idUpdatePCP'];
  $queryGetRam = mysqli_query($conn, "SELECT * FROM ram WHERE pcpno = $pcpid");
  $resultGetRam = mysqli_fetch_assoc($queryGetRam);


if(isset($_POST['btnSubmitUpdateRam'])){

  $updatePCPname = $_POST['PCPupdatename'];
  $updatePCPprice = $_POST['PCPupdateprice'];
  $updatePCPstock = $_POST['PCPupdatestock'];
  $updatePCPdesc = $_POST['PCPupdatedesc'];
  $updatePCPrammemoryspeed = $_POST['PCPupdateRAMmemoryspeed'];
  $updatePCPrammemorysize = $_POST['PCPupdateRAMmemorysize'];
  $updatePCPramddrgen = $_POST['PCPupdateRAMddrgeneration'];
  $updatePCPramvoltage = $_POST['PCPupdateRAMvoltage'];
  
  if ($updatePCPname != "" && $updatePCPprice != "" && $updatePCPrammemoryspeed != "" && $updatePCPstock != "" && $updatePCPdesc != "" && $updatePCPrammemorysize != "" && $updatePCPramddrgen != "" && $updatePCPramvoltage != ""){
      $queryWithUpdatePicture = "";
              if ($_FILES['updatePCPpic']['size'] > 0) {
                  $updatePCPpic = addslashes(file_get_contents($_FILES['updatePCPpic']['tmp_name']));
                  $queryWithUpdatePicture = ", image = '$updatePCPpic'";
              }
  
              $updatePCPQuery = "UPDATE pcpart SET name = '$updatePCPname', price = '$updatePCPprice', description = '$updatePCPdesc', stock = '$updatePCPstock'
              $queryWithUpdatePicture WHERE id = '$pcpid'";

              $updateRamQuery = "UPDATE ram SET speed = '$updatePCPrammemoryspeed', size = '$updatePCPrammemorysize', generation = '$updatePCPramddrgen', voltage = '$updatePCPramvoltage' WHERE pcpno = '$pcpid'";
               
          if (mysqli_query($conn, $updatePCPQuery) && mysqli_query($conn, $updateRamQuery)) {
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
        <p class='formlabel'>Memory speed (MHz)</p>
        <input class='form-control' id='PCPupdateRAMmemoryspeed' name='PCPupdateRAMmemoryspeed' type='text'  placeholder='e.g. 2400' value='<?php  echo $resultGetRam['speed'] ?>'>
    </div>

    <div class='formspacing'>
        <p class='formlabel'>Memory size (GB)</p>
        <input class='form-control' id='PCPupdateRAMmemorysize' name='PCPupdateRAMmemorysize' type='text'  placeholder='e.g. 1X16GB' value='<?php  echo $resultGetRam['size'] ?>'>
    </div>

    <div class='formspacing'>
        <p class='formlabel'>DDR generation</p>
        <select class="form-control" id="PCPupdateRAMddrgeneration" name="PCPupdateRAMddrgeneration" >
        <?php  if($resultGetRam['generation'] == "DDR4"){
          $s1 = "selected";
          $s2  = "";
          $s3  = "";
          $s4  = "";
        }
        else if($resultGetRam['generation'] == "DDR3"){
          $s1  = "";
          $s2  = "selected";
          $s3  = "";
          $s4  = "";
        }
        else if($resultGetRam['generation'] == "DDR2"){
          $s1  = "";
          $s2  = "";
          $s3  = "selected";
          $s4  = "";
          }
        else{
          $s1  = "";
          $s2  = "";
          $s3  = "";
          $s4  = "selected";
        }
        ?>
                <option <?php echo $s1 ?> value="DDR4">DDR4</option>
                <option <?php echo $s2 ?> value="DDR3">DDR3</option>
                <option <?php echo $s3 ?> value="DDR2">DDR2</option>
                <option <?php echo $s4 ?> value="DDR">DDR</option>
            </select>
    </div>

    <div class='formspacing'>
        <p class='formlabel'>Voltage (V)</p>
        <input class='form-control' id='PCPupdateRAMvoltage' name='PCPupdateRAMvoltage' type='number' step=".1" placeholder='e.g. 1.2' value='<?php  echo $resultGetRam['voltage'] ?>'>
    </div>


    <input type='submit' name='btnSubmitUpdateRam' class='btn btn-dark' style='font-size: 1vw; font-family: Questrial; width:100%; margin-bottom: 2vh;' value='Update'>
</form>