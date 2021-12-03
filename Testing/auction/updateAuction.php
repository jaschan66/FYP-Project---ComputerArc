<style>
    .format-pre pre {
        padding-left: 70px;
        font-size: 16px;
        text-align: left;
        font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif
    }
</style>

<?php
date_default_timezone_set("Asia/Kuala_Lumpur");
$mindate = date("Y-m-d");
$mintime = date("h:i");
$min = $mindate . "T" . $mintime;
$maxdate = date("Y-m-d", strtotime("+12 Days"));
$maxtime = date("h:i");
$max = $maxdate . "T" . $maxtime;

include "includes/dbh.inc.php";
require "auction-status.php";
session_start();
$updateAucID = $_GET['idUpdate'];
$getAucData = "SELECT * FROM auction WHERE id = '$updateAucID'";
$connGetData = mysqli_query($conn, $getAucData);
$resultGetData = mysqli_fetch_assoc($connGetData);
?>

<form style='font-family: Questrial; text-align: left' method='POST' id="updateAuction" enctype='multipart/form-data'>
    <div class='formspacing'>
        <p class='formlabel'>Auction Title</p>
        <input type='text' class='form-control' id='updateAucTitle' required placeholder='Auction Title...' name='updateAucTitle' value='<?php echo $resultGetData['title'] ?>'>
    </div>

    <div class='formspacing'>
        <p class='formlabel'>Starting Bid</p>
        <input type='text' pattern='^\d+(\.|\,)\d{2}$' required placeholder='e.g. 999.99' class='form-control' name='updateBidPrice' value='<?php echo $resultGetData['starting_bid'] ?>'>
    </div>

    <div class='formspacing'>
        <p class='formlabel'>Start Date</p>
        <input type="datetime-local" placeholder="21/10/2021" required class="form-control" name="updateStartDate" min="<?php echo $min; ?>" value='<?php echo '' . date("Y-m-d\TH:m", strtotime($resultGetData["start_date"])) . '' ?>'>
    </div>

    <div class='formspacing'>
        <p class='formlabel'>End Date</p>
        <input type="datetime-local" placeholder="21/10/2021" required class="form-control" name="updateEndDate" min="<?php echo $min; ?>" value='<?php echo '' . date("Y-m-d\TH:m", strtotime($resultGetData["end_date"])) . '' ?>'>
    </div>

    <div class='formspacing'>
        <p class='formlabel'>Product Picture</p>
        <input class='filepond' id='updateAucImage' name='updateAucImage' type='file'>
    </div>
    <div class="form-inline">
        <input type='submit' name='btnSubmitUpdateAuc' id='btnSubmitUpdateAuc' class='btn btn-dark col-3' style='font-size: 1vw; font-family: Questrial; margin-bottom: 2vh; margin-right: 5vw; margin-left: 3vw;' value='Update'>
        <button type="reset" name="reset" id="reset" class="btn btn-danger col-3" style='font-size: 1vw; font-family: Questrial; margin-bottom: 2vh; margin-right: 5vw;'>Reset</button>
        <button type="reset" onclick="history.back();" name="reset" id="reset" class="btn btn-secondary col-3" style='font-size: 1vw; font-family: Questrial; margin-bottom: 2vh;'>Back</button>
    </div>
</form>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        $('#btnSubmitUpdateAuc').click(function(event) {
            event.preventDefault();
            var form = $('#updateAuction');
            var formData = new FormData(form[0]);

            Swal.fire({
                title: 'Update Auction?',
                text: 'Please note that by updating your Auction it will have to go through Admin\'s approval again.',
                showCancelButton: true,
                confirmButtonText: 'Yes',
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        type: "POST",
                        url: "auction/auction-update.inc.php?idUpdate=<?php echo $updateAucID ?>",
                        processData: false,
                        contentType: false,
                        data: formData,
                        success: function(x) {
                            var delay = 500;

                            if (x == "Auction updated successfuly!") {
                                Swal.fire(x, '', 'success').then((result => {
                                    if (result.isConfirmed) {
                                        window.location = "profilePage.php?editAuc=1&editPRE=0&editProf=0&editPCP=0&salesO=0";
                                    } else {
                                        setTimeout(function() {
                                            window.location = "profilePage.php?editAuc=1&editPRE=0&editProf=0&editPCP=0&salesO=0";
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