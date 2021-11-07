<?php
include "E:\FYP\htdocs\FYP--ComputerArc\Testing\includes\dbh.inc.php";
session_start();
$updatePREID = $_GET['idUpdate'];
$getPREData = "SELECT * FROM prebuildpc WHERE id = '$updatePREID'";
$conngetData = mysqli_query($conn, $getPREData);
$resultgetData = mysqli_fetch_assoc($conngetData);

if(isset($_POST['btnSubmitUpdatePRE'])){

$updatePREname = $_POST['updatePREname'];
$updatePREprice = $_POST['updatePREprice'];
$updatePREcategory = $_POST['updatePREcategory'];
$updatePREstock = $_POST['updatePREstock'];
$updatePREdesc = $_POST['updatePREdesc'];


if ($updatePREname != "" && $updatePREprice != "" && $updatePREcategory != "" && $updatePREstock != ""){
    $queryWithUpdatePicture = "";
            if ($_FILES['updatePREpic']['size'] > 0) {
                $updatePREpic = addslashes(file_get_contents($_FILES['updatePREpic']['tmp_name']));
                $queryWithUpdatePicture = ", image = '$updatePREpic'";
            }

            $updateQuery = "UPDATE prebuildpc SET name = '$updatePREname', price = '$updatePREprice', category = '$updatePREcategory', stock = '$updatePREstock',
             description = '$updatePREdesc' $queryWithUpdatePicture WHERE id = '$updatePREID'";
             
        if (mysqli_query($conn, $updateQuery)) {
            echo "<script>
            window.location.href = \"profilePage.php?editPRE=1&editProf=0\";
            </script>";
        } else {
            $msg = "<div class='alert alert-danger alert-dismissible' role='alert'>
    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
    <strong>Oh No!</strong> Something went wrong when editing your profile, please try again later.
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>&times;</span>
    </button>
  </div>";
            echo mysqli_error($conn);
    }
}
}


?>

<form style='font-family: Questrial; text-align: left' method='POST' enctype='multipart/form-data'>
                        <div class='formspacing'>
                            <p class='formlabel'>Name</p>
                            <input type='text' class='form-control' id='PREname' placeholder='Alienware G10' name='updatePREname' value='<?php  echo $resultgetData['name'] ?>'>
                        </div>

                        <div class='formspacing'>
                            <p class='formlabel'>Price</p>
                            <input type='text' pattern='^\d+(\.|\,)\d{2}$' required placeholder='e.g. 999.99' class='form-control' name='updatePREprice'  value='<?php echo $resultgetData['price'] ?>'>
                        </div>

                        <div class='formspacing'>
                            <p class='formlabel'>Category</p>
                            <select class="form-control" id="updatePREcategory" name="updatePREcategory">
                                <?php  if($resultgetData['category'] == "Gaming"){
                                    $s1 = "selected";
                                    $s2 = $s3 = $s4 = "";
                                } else if ($resultgetData['category'] == "Office-Used") {
                                    $s1 = $s3 = $s4 = "";
                                    $s2 = "selected";
                                }else if ($resultgetData['category'] == "Streaming") {
                                    $s1 = $s2 = $s4 = "";
                                    $s3 = "selected";
                                }
                                else{
                                    $s1 = $s2 = $s3 = "";
                                    $s4 = "selected";
                                }
                                 ?>
                                <option <?php echo $s1 ?>>Gaming</option>
                                <option <?php echo $s2 ?>>Office-Used</option>
                                <option <?php echo $s3 ?>>Streaming</option>
                                <option <?php echo $s4 ?>>Graphic Designing</option>
                            </select>
                        </div>

                        <div class='formspacing'>
                            <p class='formlabel'>Stock Quantity</p>
                            <input type='text' pattern="[0-9]+" required placeholder='e.g. 10' class='form-control' name='updatePREstock'  value='<?php echo $resultgetData['stock'] ?>'>
                        </div>

                        <div class='formspacing'>
                            <p class='formlabel'>Description</p>
                            <input type='text' placeholder='e.g. A strong pre-build pc that is able to run every game in the current market.' class='form-control' name='updatePREdesc' value='<?php echo $resultgetData['description'] ?>'>
                            </div>

                        <div class='formspacing'>
                        <p class='formlabel'>Product Picture&nbsp;<a href='#' data-toggle='tooltip' title='Your existing profile picture will be used if no picture is uploaded' style='font-size:1.2vw'><i class='fas fa-question-circle'></i></a></p>
                            <input class='filepond' id='updatePREpic' name='updatePREpic' type='file'>
                        </div>

                        <input type='submit' name='btnSubmitUpdatePRE' class='btn btn-dark' style='font-size: 1vw; font-family: Questrial; width:100%; margin-bottom: 2vh;' value='Update'>
                    </form>