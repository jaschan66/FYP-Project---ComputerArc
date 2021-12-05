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

$itemType = $_GET['itemType'];
$idRetrieve = $_GET['idRetrieve'];
?>

<form style='font-family: Questrial; text-align: left' method='POST' id="createAuction" enctype='multipart/form-data'>
    <div class='formspacing'>
        <p class='formlabel'>Advertisement Start Date</p>
        <input type="datetime-local" placeholder="21/10/2021" required class="form-control" name="startDate" id="startDate" min="<?php echo $min; ?>">
    </div>

    <div class='formspacing'>
        <p class='formlabel'>Advertisement End Date</p>
        <input type="datetime-local" placeholder="21/10/2021" required class="form-control" name="endDate" id="endDate" min="<?php echo $min; ?>">
    </div>

    <div class="form-inline">
        <button type='button' class='btn btn-dark col-3' onclick="createAdvertisement()" style='font-size: 1vw; font-family: Questrial; margin-left:70px; margin-bottom: 2vh; margin-right: 5vw; margin-left: 3vw;'>Create</button>
        <button type="reset" name="reset" id="reset" class="btn btn-danger col-3" style='font-size: 1vw; font-family: Questrial; margin-bottom: 2vh; margin-left: 2vw; margin-right: 5vw;'>Reset</button>
    </div>
</form>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="SweetAlert/sweetalert2.min.js"></script>

<script>
    function createAdvertisement() {
        var _itemType = <?php echo $itemType ?>;
        var _idRetrieve = <?php echo $idRetrieve ?>;

        var _startDate = $("#startDate").val();
        var _endDate = $("#endDate").val();

        Swal.fire({
            title: "Create Advertisement?",
            showCancelButton: true,
            confirmButtonText: 'Yes',
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    type: "POST",
                    url: "advertisement/validateAdvertisement.php",
                    data: {
                        itemType: _itemType,
                        idRetrieve: _idRetrieve,
                        startDate: _startDate,
                        endDate: _endDate
                    },
                    success: function(result) {
                        var delay = 500
                        if (result == "Valid Advertisement") {
                            Swal.fire(result, '', 'success').then((result => {
                                if (result.isConfirmed) {
                                    window.location = "countAdvertisement.php?itemType=<?php echo $itemType ?>&idRetrieve=<?php echo $idRetrieve ?>";
                                } else {
                                    setTimeout(function() {
                                        window.location = "countAdvertisement.php?itemType=<?php echo $itemType ?>&idRetrieve=<?php echo $idRetrieve ?>";
                                    }, delay);
                                }
                            }))
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: result,
                            })
                        }
                    }
                });
            }
        })
    }
</script>