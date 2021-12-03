<?php

  $pcpid = $_GET['idUpdatePCP'];
  $queryGetCooler = mysqli_query($conn, "SELECT * FROM cooler WHERE pcpno = $pcpid");
  $resultGetCooler = mysqli_fetch_assoc($queryGetCooler);


if(isset($_POST['btnSubmitUpdateCooler'])){

  $updatePCPname = $_POST['PCPupdatename'];
  $updatePCPprice = $_POST['PCPupdateprice'];
  $updatePCPstock = $_POST['PCPupdatestock'];
  $updatePCPdesc = $_POST['PCPupdatedesc'];
  $updatePCPcoolertype = $_POST['PCPupdateCoolertype'];
  $updatePCPcoolersupportedsocket = $_POST['PCPupdateCoolersupportedsocket'];
  
  
  if ($updatePCPname != "" && $updatePCPprice != "" && $updatePCPcoolertype != "" && $updatePCPstock != "" && $updatePCPdesc != "" && $updatePCPcoolersupportedsocket != ""){
      $queryWithUpdatePicture = "";
              if ($_FILES['updatePCPpic']['size'] > 0) {
                  $updatePCPpic = addslashes(file_get_contents($_FILES['updatePCPpic']['tmp_name']));
                  $queryWithUpdatePicture = ", image = '$updatePCPpic'";
              }
  
              $updatePCPQuery = "UPDATE pcpart SET name = '$updatePCPname', price = '$updatePCPprice', description = '$updatePCPdesc', stock = '$updatePCPstock'
              $queryWithUpdatePicture WHERE id = '$pcpid'";

              $updateCoolerQuery = "UPDATE cooler SET type = '$updatePCPcoolertype', supportsocket = '$updatePCPcoolersupportedsocket' WHERE pcpno = '$pcpid'";
               
          if (mysqli_query($conn, $updatePCPQuery) && mysqli_query($conn, $updateCoolerQuery)) {
              echo "<script>
              window.location.href = \"profilePage.php?editPCP=1&editProf=0&editPRE=0&editAuc=0&salesO=0\";
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
        <p class='formlabel'>Cooler type</p>
        <select class="form-control" id="PCPupdateCoolertype" name="PCPupdateCoolertype" >
        <?php  if($resultGetCooler['type'] == "aircooler"){
          $s1 = "selected";
          $s2  = "";
        }
        else{
            $s1  = "";
            $s2  = "selected";
        }                         
         ?>
                <option <?php echo $s1 ?> value="aircooler">Air Cooler</option>
                <option <?php echo $s2 ?> value="aiocooler">AIO Cooler</option>
            </select>
    </div>

    <div class='formspacing'>
        <p class='formlabel'>Supported socket&nbsp; <a href="#" data-toggle="tooltip" title="If multiple socket is supported, just add comma sign behind the consecutive type (no spacing)"><i class='fas fa-question-circle'></i></a></p>
        <input class='form-control' id='PCPupdateCoolersupportedsocket' name='PCPupdateCoolersupportedsocket' type='text' placeholder="e.g. LGA1151,LGA1150,LGA1366..." value='<?php  echo $resultGetCooler['supportsocket'] ?>'>
    </div>

    <input type='submit' name='btnSubmitUpdateCooler' class='btn btn-dark' style='font-size: 1vw; font-family: Questrial; width:100%; margin-bottom: 2vh;' value='Update'>
</form>