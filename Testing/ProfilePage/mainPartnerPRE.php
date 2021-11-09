<?php
include "includes\dbh.inc.php";
session_start();

// print_r($_POST);
// if(!empty($_POST["idDelete"])){
//     // echo $_POST["idDelete"];
//     // die();
//     $idDelete = $_POST["idDelete"];
//     $deleteById = "DELETE FROM prebuildpc WHERE id = '$idDelete'";
//     mysqli_query($conn, $deleteById);
// }
?>

<script>
    function loadTable() {
        var txt = $('#searchPRE').val();
        if (txt == '' || txt != '') {
            $.ajax({
                url: "ProfilePage/listPartnerPRE.php",
                method: "post",
                data: {
                    search: txt
                },
                dataType: "text",
                success: function(data) {
                    $('#listRes').html(data);
                }
            })
        } else {
            $('#listRes').html('');
        }
    }
    window.onload = loadTable;
</script>
<a href='profilePage.php?editPRE=2&editProf=0' class="btn btn-success" style="font-size: 0.75vw; margin-bottom:2vh;" role="button">Add Pre-Build PC</a>


<input type="text" class="form-control" size="50" placeholder="Enter Name or Category" onkeyup="PREfunction()" name="searchPRE" id="searchPRE" autofocus style="margin-bottom:2vh;">

<div id="listRes">

</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function() {
        $('#searchPRE').keyup(function() {
            var txt = $(this).val();
            if (txt == '' || txt != '') {
                $.ajax({
                    url: "ProfilePage/listPartnerPRE.php",
                    method: "post",
                    data: {
                        search: txt
                    },
                    dataType: "text",
                    success: function(data) {
                        $('#listRes').html(data);
                    }
                })
            } else {
                $('#listRes').html('');
            }
        });
    });
</script>