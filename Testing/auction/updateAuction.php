<?php
date_default_timezone_set("Asia/Kuala_Lumpur"); 
$mindate=date("Y-m-d");
$mintime=date("h:i");
$min=$mindate."T".$mintime;
$maxdate=date("Y-m-d", strtotime("+12 Days"));
$maxtime=date("h:i");
$max=$maxdate."T".$maxtime;

include "includes/dbh.inc.php";
session_start();
$updateAucID = $_GET['idUpdate'];
$getAucData = "SELECT * FROM auction WHERE id = '$updateAucID'";
$connGetData = mysqli_query($conn, $getAucData);
$resultGetData = mysqli_fetch_assoc($connGetData);

if (isset($_POST['btnSubmitUpdateAuc'])) {

    $updateAucTitle = $_POST['updateAucTitle'];
    $updateAucBidPrice = $_POST['updateBidPrice'];
    $updateAucStartDate = $_POST['updateStartDate'];
    $updateAucEndDate = $_POST['updateEndDate'];


    if ($updateAucTitle != "" && $updateAucBidPrice != "" && $updateAucStartDate != "" && $updateAucEndDate != "") {
        $queryWithUpdatePicture = "";
        if ($_FILES['updateAucImage']['size'] > 0) {
            $updateAucImage = addslashes(file_get_contents($_FILES['updateAucImage']['tmp_name']));
            $queryWithUpdatePicture = ", image = '$updateAucImage'";
        }

        $updateQuery = "UPDATE auction SET title = '$updateAucTitle', starting_bid = '$updateAucBidPrice', start_date = '$updateAucStartDate', end_date = '$updateAucEndDate', status = 0 
                        $queryWithUpdatePicture WHERE id = '$updateAucID'";

        if (mysqli_query($conn, $updateQuery)) {
            echo "<script>
            window.location.href = \"profilePage.php?editAuc=1&editPRE=0&editProf=0&editPCP=0\";
            </script>";
        } else {
            $msg = "<div class='alert alert-danger alert-dismissible' role='alert'>
                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    <strong>Oh No!</strong> Something went wrong when updating your auction, please try again later.
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
        <p class='formlabel'>Auction Title</p>
        <input type='text' class='form-control' id='updateAucTitle' required placeholder='Auction Title...' name='updateAucTitle' value='<?php  echo $resultGetData['title'] ?>'>
    </div>

    <div class='formspacing'>
        <p class='formlabel'>Starting Bid</p>
        <input type='text' pattern='^\d+(\.|\,)\d{2}$' required placeholder='e.g. 999.99' class='form-control' name='updateBidPrice' value='<?php  echo $resultGetData['starting_bid'] ?>'>
    </div>

    <div class='formspacing'>
        <p class='formlabel'>Start Date</p>
        <input type="datetime-local" placeholder="21/10/2021" required class="form-control" name="updateStartDate" min="<?php echo $min; ?>" value='<?php  echo ''.date("Y-m-d H:m:s",strtotime($resultGetData["start_date"])).''?>'>
    </div>

    <div class='formspacing'>
        <p class='formlabel'>End Date</p>
        <input type="datetime-local" placeholder="21/10/2021" required class="form-control" name="updateEndDate" min="<?php echo $min; ?>" value='<?php  echo ''.date("Y-m-d H:m:s",strtotime($resultGetData["end_date"])).''?>'>
    </div>

    <div class='formspacing'>
        <p class='formlabel'>Product Picture</p>
        <input class='filepond' id='updateAucImage' name='updateAucImage' type='file'>
    </div>

    <input type='submit' name='btnSubmitUpdateAuc' class='btn btn-dark' style='font-size: 1vw; font-family: Questrial; width:100%; margin-bottom: 2vh;' value='Update'>
</form>

<script>
    $(document).ready(function() {
        $('#btnSubmitUpdateAuc').click(function(event) {
            event.preventDefault();
            var form = $('#createAuction');
            var formData = new FormData(form[0]);

            Swal.fire ({
                title: 'Update Auction?',
                showCancelButton: true,
                confirmButtonText: 'Yes',
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        type: "POST",
                        url: "includes/auction-upload.inc.php",
                        processData: false,
                        contentType: false,
                        data: formData,
                        success: function(x) {
                            var delay = 500;

                            if (x == "Auction created successfuly!") {
                                Swal.fire(x, '', 'success').then((result => {
                                    if (result.isConfirmed) {
                                        window.location = "profilePage.php?editAuc=1&editPRE=0&editProf=0&editPCP=0";
                                    } else {
                                        setTimeout(function() {
                                            window.location = "profilePage.php?editAuc=1&editPRE=0&editProf=0&editPCP=0";
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