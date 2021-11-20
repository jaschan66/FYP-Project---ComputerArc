
<?php

$pcpid = $_GET['idUpdatePCP'];
$queryGetMobo = mysqli_query($conn, "SELECT * FROM mobo WHERE pcpno = $pcpid");
$resultGetMobo = mysqli_fetch_assoc($queryGetMobo);


if(isset($_POST['btnSubmitUpdateMobo'])){

$updatePCPname = $_POST['PCPupdatename'];
$updatePCPprice = $_POST['PCPupdateprice'];
$updatePCPstock = $_POST['PCPupdatestock'];
$updatePCPdesc = $_POST['PCPupdatedesc'];
$updatePCPmobochipset = $_POST['PCPupdateMOBOchipset'];
$updatePCPmobomemorysize = $_POST['PCPupdateMOBOmemorysize'];
$updatePCPmobomemoryspeed = $_POST['PCPupdateMOBOmemoryspeed'];
$updatePCPmobodimmslot = $_POST['PCPupdateMOBOdimmslot'];
$updatePCPmobopcieslot = $_POST['PCPupdateMOBOpcieslot'];
$updatePCPmobosizeofboard = $_POST['PCPupdateMOBOsizeofboard'];
$updatePCPmobosupportedsocket = $_POST['PCPupdateMOBOsupportedsocket'];
$updatePCPmobowifibuiltin = $_POST['PCPupdateMOBOwifibuiltin'];

if ($updatePCPname != "" && $updatePCPprice != "" && $updatePCPmobochipset != "" && $updatePCPstock != "" && $updatePCPdesc != "" && $updatePCPmobomemorysize != "" && $updatePCPmobomemoryspeed != "" && $updatePCPmobodimmslot != "" && $updatePCPmobopcieslot != "" && $updatePCPmobopcieslot != "" && $updatePCPmobosizeofboard != "" && $updatePCPmobosupportedsocket != "" && $updatePCPmobowifibuiltin != ""){
    $queryWithUpdatePicture = "";
            if ($_FILES['updatePCPpic']['size'] > 0) {
                $updatePCPpic = addslashes(file_get_contents($_FILES['updatePCPpic']['tmp_name']));
                $queryWithUpdatePicture = ", image = '$updatePCPpic'";
            }

            $updatePCPQuery = "UPDATE pcpart SET name = '$updatePCPname', price = '$updatePCPprice', description = '$updatePCPdesc', stock = '$updatePCPstock'
            $queryWithUpdatePicture WHERE id = '$pcpid'";

            $updateMoboQuery = "UPDATE mobo SET socket = '$updatePCPmobosupportedsocket', chipset = '$updatePCPmobochipset', maxmemory = '$updatePCPmobomemorysize', maxmemoryspeed = '$updatePCPmobomemoryspeed', dimmslot = '$updatePCPmobodimmslot', pcieslot = '$updatePCPmobopcieslot', size = '$updatePCPmobosizeofboard', wifiadap = '$updatePCPmobowifibuiltin'  WHERE pcpno = '$pcpid'";
             
        if (mysqli_query($conn, $updatePCPQuery) && mysqli_query($conn, $updateMoboQuery)) {
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
        <p class='formlabel'>Chipset</p>
        <input class='form-control' id='PCPupdateMOBOchipset' name='PCPupdateMOBOchipset' type='text' placeholder='e.g. B460' value='<?php  echo $resultGetMobo['chipset'] ?>'>
    </div>

    <div class='formspacing'>
        <p class='formlabel'>Max Memory Size</p>
        <input class='form-control' id='PCPupdateMOBOmemorysize' name='PCPupdateMOBOmemorysize' type='text' placeholder='e.g. 32GB' value='<?php  echo $resultGetMobo['maxmemory'] ?>'>
    </div>

    <div class='formspacing'>
        <p class='formlabel'>Max Memory Speed</p>
        <input class='form-control' id='PCPupdateMOBOmemoryspeed' name='PCPupdateMOBOmemoryspeed' type='text' placeholder='e.g. 2666' value='<?php  echo $resultGetMobo['maxmemoryspeed'] ?>'>
    </div>

    <div class='formspacing'>
        <p class='formlabel'>DIMM slot</p>
        <input class='form-control' id='PCPupdateMOBOdimmslot' name='PCPupdateMOBOdimmslot' type='text' pattern="[0-9]+" placeholder='e.g. 2' value='<?php  echo $resultGetMobo['dimmslot'] ?>'>
    </div>

    <div class='formspacing'>
        <p class='formlabel'>WiFi built in</p>
        <select class="form-control" id="PCPupdateMOBOwifibuiltin" name="PCPupdateMOBOwifibuiltin" >
        <?php  if($resultGetMobo['wifiadap'] == "no"){
          $s1 = "selected";
          $s2  = "";
        }
        else{
            $s1  = "";
            $s2  = "selected";
        }                         
         ?>
                <option <?php echo $s1 ?> value="no">No</option>
                <option <?php echo $s2 ?> value="yes">Yes</option>
            </select>
    </div>

    <div class='formspacing'>
        <p class='formlabel'>PCIE slot</p>
        <input class='form-control' id='PCPupdateMOBOpcieslot' name='PCPupdateMOBOpcieslot' type='text' pattern="[0-9]+" placeholder='e.g. 2' value='<?php  echo $resultGetMobo['pcieslot'] ?>'>
    </div>

    <div class='formspacing'>
        <p class='formlabel'>Size of board</p>
        <select class="form-control" id="PCPupdateMOBOsizeofboard" name="PCPupdateMOBOsizeofboard" >
        <?php  if($resultGetMobo['size'] == "ATX"){
          $ss1 = "selected";
          $ss2  = "";
          $ss3  = "";
        }
        else if($resultGetMobo['size'] == "MATX"){
            $ss1  = "";
            $ss2  = "selected";
            $ss3  = "";
        }
        else{
            $ss1  = "";
            $ss2  = "";
            $ss3  = "selected";
        }                         
         ?>
                <option <?php echo $ss1 ?> value="ATX">ATX</option>
                <option <?php echo $ss2 ?> value="MATX">MATX</option>
                <option <?php echo $ss3 ?> value="IATX">IATX</option>
            </select>
    </div>

    <div class='formspacing'>
        <p class='formlabel'>Supported socket&nbsp; <a href="#" data-toggle="tooltip" title="If multiple socket is supported, just add comma sign behind the consecutive type (no spacing)"><i class='fas fa-question-circle'></i></a></p>
        <input class='form-control' id='PCPupdateMOBOsupportedsocket' name='PCPupdateMOBOsupportedsocket' type='text' placeholder="e.g. LGA1151,LGA1150,LGA1366..." value='<?php  echo $resultGetMobo['socket'] ?>'>
    </div>

  <input type='submit' name='btnSubmitUpdateMobo' class='btn btn-dark' style='font-size: 1vw; font-family: Questrial; width:100%; margin-bottom: 2vh;' value='Update'>
</form>

