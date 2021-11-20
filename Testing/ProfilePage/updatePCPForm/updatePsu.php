<?php

  $pcpid = $_GET['idUpdatePCP'];
  $queryGetPsu = mysqli_query($conn, "SELECT * FROM psu WHERE pcpno = $pcpid");
  $resultGetPsu = mysqli_fetch_assoc($queryGetPsu);


if(isset($_POST['btnSubmitUpdatePsu'])){

  $updatePCPname = $_POST['PCPupdatename'];
  $updatePCPprice = $_POST['PCPupdateprice'];
  $updatePCPstock = $_POST['PCPupdatestock'];
  $updatePCPdesc = $_POST['PCPupdatedesc'];
  $updatePCPpsuwattage = $_POST['PCPupdatePSUwattage'];
  $updatePCPpsuefficientgrade = $_POST['PCPupdatePSUefficientgrade'];
  $updatePCPpsufansize = $_POST['PCPupdatePSUfansize'];
  
  
  if ($updatePCPname != "" && $updatePCPprice != "" && $updatePCPpsuwattage != "" && $updatePCPstock != "" && $updatePCPdesc != "" && $updatePCPpsuefficientgrade != "" && $updatePCPpsufansize != ""){
      $queryWithUpdatePicture = "";
              if ($_FILES['updatePCPpic']['size'] > 0) {
                  $updatePCPpic = addslashes(file_get_contents($_FILES['updatePCPpic']['tmp_name']));
                  $queryWithUpdatePicture = ", image = '$updatePCPpic'";
              }
  
              $updatePCPQuery = "UPDATE pcpart SET name = '$updatePCPname', price = '$updatePCPprice', description = '$updatePCPdesc', stock = '$updatePCPstock'
              $queryWithUpdatePicture WHERE id = '$pcpid'";

              $updatePsuQuery = "UPDATE psu SET wattage = '$updatePCPpsuwattage', efficientgrade = '$updatePCPpsuefficientgrade', fansize = '$updatePCPpsufansize' WHERE pcpno = '$pcpid'";
               
          if (mysqli_query($conn, $updatePCPQuery) && mysqli_query($conn, $updatePsuQuery)) {
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
        <p class='formlabel'>Wattage (watt)</p>
        <input class='form-control' id='PCPupdatePSUwattage' name='PCPupdatePSUwattage' type='text'  placeholder='e.g. 650' pattern="[0-9]+" value='<?php  echo $resultGetPsu['wattage'] ?>'>
    </div>

    <div class='formspacing'>
        <p class='formlabel'>Efficient Grade</p>
        <select class="form-control" id="PCPupdatePSUefficientgrade" name="PCPupdatePSUefficientgrade" >
        <?php  if($resultGetPsu['efficientgrade'] == "80+"){
          $s1 = "selected";
          $s2  = "";
          $s3  = "";
          $s4  = "";
          $s5  = "";
          $s6  = "";
        }
        else if($resultGetCasing['efficientgrade'] == "80+bronze"){
          $s1  = "";
          $s2  = "selected";
          $s3  = "";
          $s4  = "";
          $s5  = "";
          $s6  = "";
        }
        else if($resultGetCasing['efficientgrade'] == "80+silver"){
          $s1  = "";
          $s2  = "";
          $s3  = "selected";
          $s4  = "";
          $s5  = "";
          $s6  = "";
          }
          else if($resultGetCasing['efficientgrade'] == "80+gold"){
          $s1  = "";
          $s2  = "";
          $s3  = "";
          $s4  = "selected";
          $s5  = "";
          $s6  = "";
          }
          else if($resultGetCasing['efficientgrade'] == "80+platinum"){
          $s1  = "";
          $s2  = "";
          $s3  = "";
          $s4  = "";
          $s5  = "selected";
          $s6  = "";
          }
        else{
          $s1  = "";
          $s2  = "";
          $s3  = "";
          $s4  = "";
          $s5  = "";
          $s6  = "selected";
        }
                                  
         ?>
               
                <option <?php echo $s1 ?> value="80+">80 Plus</option>
                <option <?php echo $s2 ?> value="80+bronze">80 Plus Bronze</option>
                <option <?php echo $s3 ?> value="80+silver">80 Plus Silver</option>
                <option <?php echo $s4 ?> value="80+gold">80 Plus Gold</option>
                <option <?php echo $s5 ?> value="80+platinum">80 Plus Platinum</option>
                <option <?php echo $s6 ?> value="80+titanium">80 Plus Titanium</option>
            </select>
    </div>

    <div class='formspacing'>
        <p class='formlabel'>Fan size (mm)</p>
        <input class='form-control' id='PCPupdatePSUfansize' name='PCPupdatePSUfansize' type='text' pattern="[0-9]+" placeholder='e.g. 120' value='<?php  echo $resultGetPsu['fansize'] ?>'>
    </div>

    <input type='submit' name='btnSubmitUpdatePsu' class='btn btn-dark' style='font-size: 1vw; font-family: Questrial; width:100%; margin-bottom: 2vh;' value='Update'>
</form>