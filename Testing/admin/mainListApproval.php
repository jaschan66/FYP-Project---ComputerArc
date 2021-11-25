<?php
include "includes\dbh.inc.php";
session_start();
?>

<script>
    function loadTable() {
        var txt = $('#searchApp').val();
        if (txt == '' || txt != '') {
            $.ajax({
                url: "admin/listApproval.php",
                method: "post",
                data: {
                    search: txt
                },
                dataType: "text",
                success: function(data) {
                    $('#listResApp').html(data);
                }
            })
        } else {
            $('#listResApp').html('');
        }
    }
    window.onload = loadTable;
</script>

<input type="text" class="form-control" size="50" placeholder="Search using Name or Category" onkeyup="Appfunction()" name="searchApp" id="searchApp" autofocus style="margin-bottom:2vh;">

<div id="listResApp">

</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function() {
        $('#searchApp').keyup(function() {
            var txt = $(this).val();
            if (txt == '' || txt != '') {
                $.ajax({
                    url: "admin/listApproval.php",
                    method: "post",
                    data: {
                        search: txt
                    },
                    dataType: "text",
                    success: function(data) {
                        $('#listResApp').html(data);
                    }
                })
            } else {
                $('#listResApp').html('');
            }
        });
    });
</script>