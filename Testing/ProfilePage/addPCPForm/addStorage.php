<?php

$msgPCP ="";
  if(isset($_POST) && isset($_POST['btnSubmitCreateStorage'])){
    include "includes/dbh.inc.php";
    session_start();

      $pcpname = $_POST['PCPname'];
      $pcpprice = $_POST['PCPprice'];
      $pcpstock = $_POST['PCPstock'];
      $pcpdesc = $_POST['PCPdesc'];
      $pcpstatus = 2;
      $pcppart = "storage";
      $pcppic = addslashes(file_get_contents($_FILES['PCPpic']['tmp_name']));
      $pcpStoragetype = $_POST['PCPStoragetype'];


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
          $insertStorageQuery = "INSERT INTO `storage` (`type`, `pcpno`) VALUES ('$pcpStoragetype', '$pcpID')";
          if(mysqli_query($conn, $insertStorageQuery)){
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
        <p class='formlabel'>Storage type</p>
        <select class="form-control" id="PCPStoragetype" name="PCPStoragetype">
                <option selected value="HDD500GB5400RPM">HDD(5400RPM) - 500GB</option>
                <option value="HDD1TB5400RPM">HDD(5400RPM) - 1TB</option>
                <option value="HDD2TB5400RPM">HDD(5400RPM) - 2TB</option>
                <option value="HDD3TB5400RPM">HDD(5400RPM) - 3TB</option>
                <option value="HDD4TB5400RPM">HDD(5400RPM) - 4TB</option>
                <option value="HDD5TB5400RPM">HDD(5400RPM) - 5TB</option>
                <option value="HDD6TB5400RPM">HDD(5400RPM) - 6TB</option>
                <option value="HDD8TB5400RPM">HDD(5400RPM) - 8TB</option>
                <option value="HDD500GB7200RPM">HDD(7200RPM) - 500GB</option>
                <option value="HDD1TB7200RPM">HDD(7200RPM) - 1TB</option>
                <option value="HDD2TB7200RPM">HDD(7200RPM) - 2TB</option>
                <option value="HDD3TB7200RPM">HDD(7200RPM) - 3TB</option>
                <option value="HDD4TB7200RPM">HDD(7200RPM) - 4TB</option>
                <option value="HDD5TB7200RPM">HDD(7200RPM) - 5TB</option>
                <option value="HDD6TB7200RPM">HDD(7200RPM) - 6TB</option>
                <option value="HDD8TB7200RPM">HDD(7200RPM) - 8TB</option>
                <option value="SATA128GB">SATA - 128GB</option>
                <option value="SATA256GB">SATA - 256GB</option>
                <option value="SATA512GB">SATA - 512GB</option>
                <option value="SATA1TB">SATA - 1TB</option>
                <option value="SATA2TB">SATA - 2TB</option>
                <option value="M.2128GB">M.2 - 128GB</option>
                <option value="M.2256GB">M.2 - 256GB</option>
                <option value="M.2512GB">M.2 - 512GB</option>
                <option value="M.21TB">M.2 - 1TB</option>
                <option value="M.22TB">M.2 - 2TB</option>
            </select>
    </div>


    <input type='submit' name='btnSubmitCreateStorage' class='btn btn-dark' style='font-size: 1vw; font-family: Questrial; width:100%; margin-bottom: 2vh;' value='Create'>

</form>