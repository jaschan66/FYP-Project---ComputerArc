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
?>

<form style='font-family: Questrial; text-align: left' method='POST' id="createRaffle" enctype='multipart/form-data'>
    <div class='formspacing'>
        <p class='formlabel'>Raffle Title</p>
        <input type='text' class='form-control' id='rafTitle' required placeholder='Raffle Title...' autofocus name='rafTitle'>
    </div>

    <div class='formspacing'>
        <p class='formlabel'>Required Ticket</p>
        <input type='number' required placeholder='e.g. 5' class='form-control' name='reqTicket'>
    </div>

    <div class='formspacing'>
        <p class='formlabel'>Maximum Participant</p>
        <input type='number' required placeholder='e.g. 100' class='form-control' name='maxParti'>
    </div>

    <div class='formspacing'>
        <p class='formlabel'>End Date</p>
        <input type="datetime-local" placeholder="21/10/2021" required class="form-control" name="endDate" min="<?php echo $min; ?>">
    </div>

    <div class='formspacing'>
        <p class='formlabel'>Raffle Prize Picture</p>
        <input class='filepond' id='raffleImage' name='raffleImage' type='file'>
    </div>
    
    <div class="form-inline">
        <input type='submit' name='btnCreateAuction' id='btnCreateRaffle' class='btn btn-dark col-12' style='font-size: 1vw; font-family: Questrial; margin-bottom: 2vh;' value='Create'>
    </div>

</form>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="SweetAlert/sweetalert2.min.js"></script>

<script>
    $(document).ready(function() {
        $('#btnCreateRaffle').click(function(event) {
            event.preventDefault();
            var form = $('#createRaffle');
            var formData = new FormData(form[0]);

            Swal.fire ({
                title: 'Create Raffle?',
                showCancelButton: true,
                confirmButtonText: 'Yes',
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        type: "POST",
                        url: "raffle/createRaffle.php",
                        processData: false,
                        contentType: false,
                        data: formData,
                        success: function(x) {
                            var delay = 500;
                            console.log(x);
                            if (x == "Raffle created successfuly!") {
                                Swal.fire(x, '', 'success').then((result => {
                                    if (result.isConfirmed) {
                                        window.location = "profilePage.php?editProf=0&reviewUser=0&reviewApp=0&comm=0&report=0&raffle=1";
                                    } else {
                                        setTimeout(function() {
                                            window.location = "profilePage.php?editProf=0&reviewUser=0&reviewApp=0&comm=0&report=0&raffle=1";
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