<?php

$msgPCP ="";
  if(isset($_POST) && isset($_POST['btnSubmitCreateMOBO'])){
    include "includes/dbh.inc.php";
    session_start();

      $pcpname = $_POST['PCPname'];
      $pcpprice = $_POST['PCPprice'];
      $pcpstock = $_POST['PCPstock'];
      $pcpdesc = $_POST['PCPdesc'];
      $pcpstatus = 2;
      $pcppart = "mobo";
      $pcppic = addslashes(file_get_contents($_FILES['PCPpic']['tmp_name']));
      $pcpmobochipset = $_POST['PCPMOBOchipset'];
      $pcpmobomaxmemorysize = $_POST['PCPMOBOmemorysize']; 
      $pcpmobomaxmemoryspeed = $_POST['PCPMOBOmemoryspeed']; 
      $pcpmobodimmslot = $_POST['PCPMOBOdimmslot']; 
      $pcpmobowifibuiltin = $_POST['PCPMOBOwifibuiltin']; 
      $pcpmobopcieslot = $_POST['PCPMOBOpcieslot']; 
      $pcpmobosize = $_POST['PCPMOBOsizeofboard'];
      $pcpmobosupportsocket = $_POST['PCPMOBOsupportedsocket'];

      $selleremail = $_SESSION['email'];
      $getIDquery = mysqli_query($conn,"SELECT id FROM partner where email ='$selleremail'");
      $getID = mysqli_fetch_assoc($getIDquery);
      $id = $getID['id'];

      $insertPCPQuery = "INSERT INTO `pcpart` (`price`, `name`, `description`, `stock`, `image`, `status`, `seller`, `part`) VALUES ('$pcpprice', '$pcpname', '$pcpdesc', '$pcpstock', '$pcppic', '$pcpstatus', '$id', '$pcppart')";
      if(mysqli_query($conn, $insertPCPQuery)){
          $selectpcpartIDquery = "SELECT * FROM pcpart where name ='$pcpname'";
          $executepcpartID = mysqli_query($conn, $selectpcpartIDquery);
          $resultpcpID = mysqli_fetch_assoc($executepcpartID);
          $pcpID = $resultpcpID['id'];
          $insertMOBOQuery = "INSERT INTO `mobo` (`socket`, `chipset`, `maxmemory`, `maxmemoryspeed`, `dimmslot`, `wifiadap`, `pcieslot`, `size`, `pcpno`) VALUES ('$pcpmobosupportsocket', '$pcpmobochipset', '$pcpmobomaxmemorysize', '$pcpmobomaxmemoryspeed', '$pcpmobodimmslot', '$pcpmobowifibuiltin', '$pcpmobopcieslot', '$pcpmobosize', '$pcpID')";
          if(mysqli_query($conn, $insertMOBOQuery)){
            $msgPCP = "<div class='alert alert-dark alert-dismissible' role='alert'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <strong>Success!</strong> Your PC part has been sent to admin for approval.
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
            </button>
          </div>";
          }
          else{
            $msgPCP = "<div class='alert alert-danger alert-dismissible' role='alert'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <strong>Oh No!</strong> Something went wrong when creating PC part, please try again later.
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
            </button>
          </div>";
          }
      }
  }

?>


<form style='font-family: Questrial; text-align: left' method='POST' enctype='multipart/form-data'>
<?php

echo $msgPCP;
?>
<input type="hidden" value="<?=$PCPtype ?>" name="PCPpart" >
    <div class='formspacing'>
        <p class='formlabel'>Name</p>
        <input type='text' class='form-control' id='PCPname' placeholder='PC Part Name' name='PCPname'>
    </div>

    <div class='formspacing'>
        <p class='formlabel'>Price</p>
        <input type='text' pattern='^\d+(\.|\,)\d{2}$' required placeholder='e.g. 999.99' class='form-control' name='PCPprice'>
    </div>


    <div class='formspacing'>
        <p class='formlabel'>Stock Quantity</p>
        <input type='text' pattern="[0-9]+" required placeholder='e.g. 10' class='form-control' name='PCPstock'>
    </div>

    <div class='formspacing'>
        <p class='formlabel'>Description</p>
        <input type='text' placeholder='e.g. A strong pre-build pc that is able to run every game in the current market.' class='form-control' name='PCPdesc'>
    </div>

    <div class='formspacing'>
        <p class='formlabel'>Product Picture</p>
        <input class='filepond' id='PCPpic' name='PCPpic' type='file'>
    </div>
    
    <div class='formspacing'>
        <p class='formlabel'>Chipset</p>
        <input class='form-control' id='PCPMOBOchipset' name='PCPMOBOchipset' type='text' placeholder='e.g. B460'>
    </div>

    <div class='formspacing'>
        <p class='formlabel'>Max Memory Size</p>
        <input class='form-control' id='PCPMOBOmemorysize' name='PCPMOBOmemorysize' type='text' placeholder='e.g. 32GB'>
    </div>

    <div class='formspacing'>
        <p class='formlabel'>Max Memory Speed</p>
        <input class='form-control' id='PCPMOBOmemoryspeed' name='PCPMOBOmemoryspeed' type='text' placeholder='e.g. 2666'>
    </div>

    <div class='formspacing'>
        <p class='formlabel'>DIMM slot</p>
        <input class='form-control' id='PCPMOBOdimmslot' name='PCPMOBOdimmslot' type='text' pattern="[0-9]+" placeholder='e.g. 2'>
    </div>

    <div class='formspacing'>
        <p class='formlabel'>WiFi built in</p>
        <select class="form-control" id="PCPMOBOwifibuiltin" name="PCPMOBOwifibuiltin" >
                <option selected value="no">No</option>
                <option value="yes">Yes</option>
            </select>
    </div>

    <div class='formspacing'>
        <p class='formlabel'>PCIE slot</p>
        <input class='form-control' id='PCPMOBOpcieslot' name='PCPMOBOpcieslot' type='text' pattern="[0-9]+" placeholder='e.g. 2'>
    </div>

    <div class='formspacing'>
        <p class='formlabel'>Size of board</p>
        <select class="form-control" id="PCPMOBOsizeofboard" name="PCPMOBOsizeofboard" >
                <option selected value="ATX">ATX</option>
                <option value="MATX">MATX</option>
                <option value="IATX">IATX</option>
            </select>
    </div>

    <div class='formspacing'>
        <p class='formlabel'>Supported socket&nbsp; <a href="#" data-toggle="tooltip" title="If multiple socket is supported, just add comma sign behind the consecutive type (no spacing)"><i class='fas fa-question-circle'></i></a></p>
        <input class='form-control' id='PCPMOBOsupportedsocket' name='PCPMOBOsupportedsocket' type='text' placeholder="e.g. LGA1151,LGA1150,LGA1366...">
    </div>

   



   

    <input type='submit' name='btnSubmitCreateMOBO' class='btn btn-dark' style='font-size: 1vw; font-family: Questrial; width:100%; margin-bottom: 2vh;' value='Create'>
</form>