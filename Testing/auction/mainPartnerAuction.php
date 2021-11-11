<?php
include "includes\dbh.inc.php";
session_start();
?>

<script>
    function loadTable() {
        var txt = $('#searchAuc').val();
        if (txt == '' || txt != '') {
            $.ajax({
                url: "auction/listPartnerAuc.php",
                method: "post",
                data: {
                    search: txt
                },
                dataType: "text",
                success: function(data) {
                    $('#listResAuc').html(data);
                }
            })
        } else {
            $('#listResAuc').html('');
        }
    }
    window.onload = loadTable;
</script>
<a href='profilePage.php?editAuc=2&editPRE=0&editProf=0&editPCP=0' class="btn btn-success" style="font-size: 0.75vw; margin-bottom:2vh;" role="button">Create A New Auction</a>

<input type="text" class="form-control" size="50" placeholder="Enter Name or Category" onkeyup="Aucfunction()" name="searchAuc" id="searchAuc" autofocus style="margin-bottom:2vh;">

<div id="listResAuc">

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function() {
        $('#searchAuc').keyup(function() {
            var txt = $(this).val();
            if (txt == '' || txt != '') {
                $.ajax({
                    url: "auction/listPartnerAuction.php",
                    method: "post",
                    data: {
                        search: txt
                    },
                    dataType: "text",
                    success: function(data) {
                        $('#listResAuc').html(data);
                    }
                })
            } else {
                $('#listResAuc').html('');
            }
        });
    });
</script>