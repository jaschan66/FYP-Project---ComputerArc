<?php

$pcpid = $_GET['idUpdatePCP'];
  

$queryGetCasing = mysqli_query($conn, "SELECT * FROM casing WHERE pcpno = '$pcpid'");
$resultGetCasing = mysqli_fetch_assoc($queryGetCasing);

if(isset($_POST['btnSubmitUpdateCasing'])){

  $updatePCPname = $_POST['PCPupdatename'];
  $updatePCPprice = $_POST['PCPupdateprice'];
  $updatePCPcasingsize = $_POST['PCPupdateCasingsize'];
  $updatePCPcasingsidepanel = $_POST['PCPupdateCasingsidepanel'];
  $updatePCPstock = $_POST['PCPupdatestock'];
  $updatePCPdesc = $_POST['PCPupdatedesc'];
  

  
  
  
  if ($updatePCPname != "" && $updatePCPprice != "" && $updatePCPcasingsize != "" && $updatePCPstock != "" && $updatePCPdesc != "" && $updatePCPcasingsidepanel != ""){
      $queryWithUpdatePicture = "";
              if ($_FILES['updatePCPpic']['size'] > 0) {
                  $updatePCPpic = addslashes(file_get_contents($_FILES['updatePCPpic']['tmp_name']));
                  $queryWithUpdatePicture = ", image = '$updatePCPpic'";
              }
  
              $updatePCPQuery = "UPDATE pcpart SET name = '$updatePCPname', price = '$updatePCPprice', description = '$updatePCPdesc', stock = '$updatePCPstock'
              $queryWithUpdatePicture WHERE id = '$pcpid'";

              $updateCasingQuery = "UPDATE casing SET size = '$updatePCPcasingsize', sidepanel = '$updatePCPcasingsidepanel' WHERE pcpno = '$pcpid'";
               
          if (mysqli_query($conn, $updatePCPQuery) && mysqli_query($conn, $updateCasingQuery)) {
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
        <p class='formlabel'>Size</p>
        <select class="form-control" id="PCPupdateCasingsize" name="PCPupdateCasingsize">
        <?php  if($resultGetCasing['size'] == "fulltower"){
          $s1 = "selected";
          $s2  = "";
          $s3  = "";
        }
        else if($resultGetCasing['size'] == "midtower"){
          $s1  = "";
          $s2  = "selected";
          $s3  = "";
        }
        else{
            $s1  = "";
            $s2  = "";
            $s3  = "selected";
        }
                                  
         ?>
                <option <?php echo $s1 ?> value="fulltower">Full Tower</option>
                <option <?php echo $s2 ?> value="midtower">Mid Tower</option>
                <option <?php echo $s3 ?> value="miniitx">mini-ITX</option>
            </select>
    </div>

    <div class='formspacing'>
        <p class='formlabel'>Side Panel</p>
        <input type='text' placeholder='e.g. Tempered glass on the left side panel.' class='form-control' name='PCPupdateCasingsidepanel' value='<?php  echo $resultGetCasing['sidepanel'] ?>'>
    </div>

    <input type='submit' name='btnSubmitUpdateCasing' class='btn btn-dark' style='font-size: 1vw; font-family: Questrial; width:100%; margin-bottom: 2vh;' value='Create'>