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
$mindate=date("Y-m-d");
$mintime=date("h:i");
$min=$mindate."T".$mintime;
$maxdate=date("Y-m-d", strtotime("+12 Days"));
$maxtime=date("h:i");
$max=$maxdate."T".$maxtime;
?>

<form style='font-family: Questrial; text-align: left' method='POST' id="createAuction" enctype='multipart/form-data'>
    <div class='formspacing'>
        <p class='formlabel'>Auction Title</p>
        <input type='text' class='form-control' id='aucTitle' required placeholder='Auction Title...' name='aucTitle'>
    </div>

    <div class='formspacing'>
        <p class='formlabel'>Starting Bid</p>
        <input type='number' pattern='^\d+(\.|\,)\d{2}$' required placeholder='e.g. 999.99' class='form-control' name='bidPrice'>
    </div>

    <div class='formspacing'>
        <p class='formlabel'>Start Date</p>
        <input type="datetime-local" placeholder="21/10/2021" required class="form-control" name="startDate" id="startDate" min="<?php echo $min; ?>">
    </div>

    <div class='formspacing'>
        <p class='formlabel'>End Date</p>
        <input type="datetime-local" placeholder="21/10/2021" required class="form-control" name="endDate" min="<?php echo $min; ?>">
    </div>

    <div class='formspacing'>
        <p class='formlabel'>Product Picture</p>
        <input class='filepond' id='auctionImage' name='auctionImage' type='file'>
    </div>

    <input type='submit' id="btnCreateAuction" name="btnCreateAuction" class='btn btn-dark' style='font-size: 1vw; font-family: Questrial; width:100%; margin-bottom: 2vh;' value='Create'>
</form>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="SweetAlert/sweetalert2.min.js"></script>

<script>
    $(document).ready(function() {
        $('#btnCreateAuction').click(function(event) {
            event.preventDefault();
            var form = $('#createAuction');
            var formData = new FormData(form[0]);

            Swal.fire ({
                title: 'Create Auction?',
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
                            console.log(x);
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