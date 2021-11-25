<?php
include "includes\dbh.inc.php";
session_start();
?>
<style>
    .form-inline a {
        font-size: 1vw;
        color: white;
        font-family: Questrial;
        margin-bottom: 2vh;
    }
</style>

<script>
    function loadTable() {
        var txt = $('#searchAuc').val();
        if (txt == '' || txt != '') {
            $.ajax({
                url: "auction/listMemberAuction.php",
                method: "post",
                data: {
                    search: txt,
                    sort: "all"
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

<input type="text" class="form-control" size="50" placeholder="Search Name or Start Date" onkeyup="Aucfunction()" name="searchAuc" id="searchAuc" autofocus style="margin-bottom:2vh;">

<div id="listResAuc">

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        $('#searchAuc').keyup(function() {
            var txt = $(this).val();
            if (txt == '' || txt != '') {
                $.ajax({
                    url: "auction/listMemberAuction.php",
                    method: "post",
                    data: {
                        search: txt,
                        sort: "all"
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