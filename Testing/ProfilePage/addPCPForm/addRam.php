<?php

$msgPCP ="";
  if(isset($_POST) && isset($_POST['btnSubmitCreateRAM'])){
    include "includes/dbh.inc.php";
    session_start();

      $pcpname = $_POST['PCPname'];
      $pcpprice = $_POST['PCPprice'];
      $pcpstock = $_POST['PCPstock'];
      $pcpdesc = $_POST['PCPdesc'];
      $pcpstatus = 2;
      $pcppart = "RAM";
      $pcppic = addslashes(file_get_contents($_FILES['PCPpic']['tmp_name']));
      $pcpRAMmemoryspeed = $_POST['PCPRAMmemoryspeed'];
      $pcpRAMmemorysize = $_POST['PCPRAMmemorysize'];
      $pcpRAMddrgen= $_POST['PCPRAMddrgeneration'];
      $pcpRAMvoltage= $_POST['PCPRAMvoltage'];

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
          $insertRAMQuery = "INSERT INTO `ram` (`speed`, `size`, `generation`, `voltage`, `pcpno`) VALUES ('$pcpRAMmemoryspeed', '$pcpRAMmemorysize', '$pcpRAMddrgen', '$pcpRAMvoltage', '$pcpID')";
          if(mysqli_query($conn, $insertRAMQuery)){
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
        <p class='formlabel'>Memory speed (MHz)</p>
        <input class='form-control' id='PCPRAMmemoryspeed' name='PCPRAMmemoryspeed' type='text'  placeholder='e.g. 2400'>
    </div>

    <div class='formspacing'>
        <p class='formlabel'>Memory size (GB)</p>
        <input class='form-control' id='PCPRAMmemorysize' name='PCPRAMmemorysize' type='text'  placeholder='e.g. 1X16GB'>
    </div>

    <div class='formspacing'>
        <p class='formlabel'>DDR generation</p>
        <select class="form-control" id="PCPRAMddrgeneration" name="PCPRAMddrgeneration" >
                <option selected value="DDR4">DDR4</option>
                <option value="DDR3">DDR3</option>
                <option value="DDR2">DDR2</option>
                <option value="DDR">DDR</option>
            </select>
    </div>

    <div class='formspacing'>
        <p class='formlabel'>Voltage (V)</p>
        <input class='form-control' id='PCPRAMvoltage' name='PCPRAMvoltage' type='number' step=".1" placeholder='e.g. 1.2'>
    </div>



    <input type='submit' name='btnSubmitCreateRAM' class='btn btn-dark' style='font-size: 1vw; font-family: Questrial; width:100%; margin-bottom: 2vh;' value='Create'>
</form>