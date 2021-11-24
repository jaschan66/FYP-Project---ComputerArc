<?php
include "includes\dbh.inc.php";
session_start();
$updatePREID = $_GET['idUpdate'];
$getPREData = "SELECT * FROM prebuildpc WHERE id = '$updatePREID'";
$conngetData = mysqli_query($conn, $getPREData);
$resultgetData = mysqli_fetch_assoc($conngetData);




?>

<form style='font-family: Questrial; text-align: left' method='POST' enctype='multipart/form-data' id='updatePRE'>
                            <input type='hidden' name='updatePREID' value='<?php echo $updatePREID  ?>'>
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
                        <p class='formlabel'>Product Picture&nbsp;<a href='#' data-toggle='tooltip' title='Your existing picture will be used if no picture is uploaded' style='font-size:1.2vw'><i class='fas fa-question-circle'></i></a></p>
                            <input class='filepond' id='updatePREpic' name='updatePREpic' type='file'>
                        </div>

                        <input type='submit' name='btnSubmitUpdatePRE' id='btnSubmitUpdatePRE' class='btn btn-dark' style='font-size: 1vw; font-family: Questrial; width:100%; margin-bottom: 2vh;' value='Update'>
                    </form>

                    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
                    <script src="SweetAlert/sweetalert2.min.js"></script>

                    <script>
    $(document).ready(function() {
        $('#btnSubmitUpdatePRE').click(function(event) {
            event.preventDefault();
            var form = $('#updatePRE');
            var formData = new FormData(form[0]);

            Swal.fire ({
                title: 'Update Pre-build PC?',
                showCancelButton: true,
                confirmButtonText: 'Yes',
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        type: "POST",
                        url: "ProfilePage/PRE-update.php",
                        processData: false,
                        contentType: false,
                        data: formData,
                        success: function(x) {
                            var delay = 500;
                            console.log(x);
                            if (x == "Pre-Build PC updated successfuly!") {
                                Swal.fire(x, '', 'success').then((result => {
                                    if (result.isConfirmed) {
                                        window.location = "profilePage.php?editAuc=0&editPRE=1&editProf=0&editPCP=0";
                                    } else {
                                        setTimeout(function() {
                                            window.location = "profilePage.php?editAuc=0&editPRE=1&editProf=0&editPCP=0";
                                        }, delay);
                                    }
                                }))

                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Something went wrong!',
                                    html: '<pre>' + x + '</pre>',
                                    customClass: {
                                        popup: 'format-pre'
                                    }
                                })
                            }
                        }
                    });
                }
            })
        });
    });
</script>