<?php
include "includes\dbh.inc.php";
session_start();
?>

<script>
    function loadTable() {
        var txt = $('#searchAd').val();
        if (txt == '' || txt != '') {
            $.ajax({
                url: "advertisement/listAdvertisement.php",
                method: "post",
                data: {
                    search: txt
                },
                dataType: "text",
                success: function(data) {
                    $('#listResAd').html(data);
                }
            })
        } else {
            $('#listResAd').html('');
        }
    }
    window.onload = loadTable;
</script>

<input type="text" class="form-control" size="50" placeholder="Search using Name or Category" onkeyup="Adfunction()" name="searchAd" id="searchAd" autofocus style="margin-bottom:2vh;">

<div id="listResAd">

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        $('#searchAd').keyup(function() {
            var txt = $(this).val();
            if (txt == '' || txt != '') {
                $.ajax({
                    url: "advertisement/listAdvertisement.php",
                    method: "post",
                    data: {
                        search: txt
                    },
                    dataType: "text",
                    success: function(data) {
                        $('#listResAd').html(data);
                    }
                })
            } else {
                $('#listResAd').html('');
            }
        });
    });
</script>