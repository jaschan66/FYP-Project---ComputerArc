<?php

  $pcpid = $_GET['idUpdatePCP'];
  $queryGetStorage = mysqli_query($conn, "SELECT * FROM storage WHERE pcpno = $pcpid");
  $resultGetStorage = mysqli_fetch_assoc($queryGetStorage);


if(isset($_POST['btnSubmitUpdateStorage'])){

  $updatePCPname = $_POST['PCPupdatename'];
  $updatePCPprice = $_POST['PCPupdateprice'];
  $updatePCPstock = $_POST['PCPupdatestock'];
  $updatePCPdesc = $_POST['PCPupdatedesc'];
  $updatePCPstoragetype = $_POST['PCPupdateStoragetype'];
  
  
  if ($updatePCPname != "" && $updatePCPprice != "" && $updatePCPstoragetype != "" && $updatePCPstock != "" && $updatePCPdesc != "" ){
      $queryWithUpdatePicture = "";
              if ($_FILES['updatePCPpic']['size'] > 0) {
                  $updatePCPpic = addslashes(file_get_contents($_FILES['updatePCPpic']['tmp_name']));
                  $queryWithUpdatePicture = ", image = '$updatePCPpic'";
              }
  
              $updatePCPQuery = "UPDATE pcpart SET name = '$updatePCPname', price = '$updatePCPprice', description = '$updatePCPdesc', stock = '$updatePCPstock'
              $queryWithUpdatePicture WHERE id = '$pcpid'";

              $updateStorageQuery = "UPDATE storage SET type = '$updatePCPstoragetype' WHERE pcpno = '$pcpid'";
               
          if (mysqli_query($conn, $updatePCPQuery) && mysqli_query($conn, $updateStorageQuery)) {
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
        <p class='formlabel'>Storage type</p>
        <select class="form-control" id="PCPupdateStoragetype" name="PCPupdateStoragetype">
        <?php
          $s1="";
          $s2="";
          $s3="";
          $s4="";
          $s5="";
          $s6="";
          $s7="";
          $s8="";
          $s9="";
          $s10="";
          $s11="";
          $s12="";
          $s13="";
          $s14="";
          $s15="";
          $s16="";
          $s17="";
          $s18="";
          $s19="";
          $s20="";
          $s21="";
          $s22="";
          $s23="";
          $s24="";
          $s25="";
          $s26="";

        
        if($resultGetStorage['type'] == "HDD500GB5400RPM"){
            $s1  = "selected";
        }
        else if($resultGetStorage['type'] == "HDD1TB5400RPM"){
            $s2  = "selected";
        }
        else if($resultGetStorage['type'] == "HDD2TB5400RPM"){
            $s3  = "selected";
          }
          else if($resultGetStorage['type'] == "HDD3TB5400RPM"){
            $s4  = "selected";
          }
          else if($resultGetStorage['type'] == "HDD4TB5400RPM"){
            $s5  = "selected";
          }
          else if($resultGetStorage['type'] == "HDD5TB5400RPM"){
            $s6  = "selected";
          }
          else if($resultGetStorage['type'] == "HDD6TB5400RPM"){
            $s7  = "selected";
          }
          else if($resultGetStorage['type'] == "HDD8TB5400RPM"){
            $s8  = "selected";
          }
          else if($resultGetStorage['type'] == "HDD500GB7200RPM"){
            $s9  = "selected";
          }
          else if($resultGetStorage['type'] == "HDD1TB7200RPM"){
            $s10  = "selected";
          }
          else if($resultGetStorage['type'] == "HDD2TB7200RPM"){
            $s11  = "selected";
          }
          else if($resultGetStorage['type'] == "HDD3TB7200RPM"){
            $s12  = "selected";
          }
          else if($resultGetStorage['type'] == "HDD4TB7200RPM"){
            $s13  = "selected";
          }
          else if($resultGetStorage['type'] == "HDD5TB7200RPM"){
            $s14  = "selected";
          }
          else if($resultGetStorage['type'] == "HDD6TB7200RPM"){
            $s15  = "selected";
          }
          else if($resultGetStorage['type'] == "HDD8TB7200RPM"){
            $s16  = "selected";
          }
          else if($resultGetStorage['type'] == "SATA128GB"){
            $s17  = "selected";
          }
          else if($resultGetStorage['type'] == "SATA256GB"){
            $s18  = "selected";
          }
          else if($resultGetStorage['type'] == "SATA512GB"){
            $s19  = "selected";
          }
          else if($resultGetStorage['type'] == "SATA1TB"){
            $s20  = "selected";
          }
          else if($resultGetStorage['type'] == "SATA2TB"){
            $s21  = "selected";
          }
          else if($resultGetStorage['type'] == "M.2128GB"){
            $s22  = "selected";
          }
          else if($resultGetStorage['type'] == "M.2256GB"){
            $s23  = "selected";
          }
          else if($resultGetStorage['type'] == "M.21TB"){
            $s24  = "selected";
          }
          else if($resultGetStorage['type'] == "M.2256GB"){
            $s25  = "selected";
          }
        else{
            $s26  = "selected";
        }
                                  
         ?>
                <option  <?php echo $s1 ?> value="HDD500GB5400RPM">HDD(5400RPM) - 500GB</option>
                <option  <?php echo $s2 ?> value="HDD1TB5400RPM">HDD(5400RPM) - 1TB</option>
                <option  <?php echo $s3 ?> value="HDD2TB5400RPM">HDD(5400RPM) - 2TB</option>
                <option  <?php echo $s4 ?> value="HDD3TB5400RPM">HDD(5400RPM) - 3TB</option>
                <option  <?php echo $s5 ?> value="HDD4TB5400RPM">HDD(5400RPM) - 4TB</option>
                <option  <?php echo $s6 ?> value="HDD5TB5400RPM">HDD(5400RPM) - 5TB</option>
                <option  <?php echo $s7 ?> value="HDD6TB5400RPM">HDD(5400RPM) - 6TB</option>
                <option  <?php echo $s8 ?> value="HDD8TB5400RPM">HDD(5400RPM) - 8TB</option>
                <option  <?php echo $s9 ?> value="HDD500GB7200RPM">HDD(7200RPM) - 500GB</option>
                <option  <?php echo $s10 ?> value="HDD1TB7200RPM">HDD(7200RPM) - 1TB</option>
                <option  <?php echo $s11 ?> value="HDD2TB7200RPM">HDD(7200RPM) - 2TB</option>
                <option  <?php echo $s12 ?> value="HDD3TB7200RPM">HDD(7200RPM) - 3TB</option>
                <option  <?php echo $s13 ?> value="HDD4TB7200RPM">HDD(7200RPM) - 4TB</option>
                <option  <?php echo $s14 ?> value="HDD5TB7200RPM">HDD(7200RPM) - 5TB</option>
                <option  <?php echo $s15 ?> value="HDD6TB7200RPM">HDD(7200RPM) - 6TB</option>
                <option  <?php echo $s16 ?> value="HDD8TB7200RPM">HDD(7200RPM) - 8TB</option>
                <option  <?php echo $s17 ?> value="SATA128GB">SATA - 128GB</option>
                <option  <?php echo $s18 ?> value="SATA256GB">SATA - 256GB</option>
                <option  <?php echo $s19 ?> value="SATA512GB">SATA - 512GB</option>
                <option  <?php echo $s20 ?> value="SATA1TB">SATA - 1TB</option>
                <option  <?php echo $s21 ?> value="SATA2TB">SATA - 2TB</option>
                <option  <?php echo $s22 ?> value="M.2128GB">M.2 - 128GB</option>
                <option  <?php echo $s23 ?> value="M.2256GB">M.2 - 256GB</option>
                <option  <?php echo $s24 ?> value="M.2512GB">M.2 - 512GB</option>
                <option  <?php echo $s25 ?> value="M.21TB">M.2 - 1TB</option>
                <option  <?php echo $s26 ?> value="M.22TB">M.2 - 2TB</option>
            </select>
    </div>

 

    <input type='submit' name='btnSubmitUpdateStorage' class='btn btn-dark' style='font-size: 1vw; font-family: Questrial; width:100%; margin-bottom: 2vh;' value='Update'>
</form>