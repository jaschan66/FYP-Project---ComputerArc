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
                url: "auction/listPartnerAuc.php",
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
<a href='profilePage.php?editAuc=2&editPRE=0&editProf=0&editPCP=0' class="btn btn-success" style="font-size: 0.75vw; margin-bottom:2vh;" role="button">Create A New Auction</a>

<input type="text" class="form-control" size="50" placeholder="Search Name or Start Date" onkeyup="Aucfunction()" name="searchAuc" id="searchAuc" autofocus style="margin-bottom:2vh;">
<div class="form-inline">
    <a type="button" onclick="sortReset()" class="btn btn-dark col-2" style='margin-right: 6vw; margin-left: 3vw;'>Reset Sorting</a>
    <a type="button" onclick="sortName()" class='btn btn-secondary col-2' style='margin-right: 1vw;'>Sort by Name</a>
    <a type="button" onclick="sortDate()" class="btn btn-secondary col-2" style='margin-right: 1vw;'>Sort by Date</a>
    <a type="button" onclick="sortStatus()" id="sortStatus" name="sortStatus" class="btn btn-secondary col-2">Sort by Status</a>
</div>

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
                    url: "auction/listPartnerAuc.php",
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

    function sortReset() {
        console.log("test");
        var txt = "";
        $.ajax({
            url: "auction/listPartnerAuc.php",
            method: "post",
            data: {
                txt: "",
                sort: "all"
            },
        });
    }

    function sortName() {
        console.log("test");
        var txt = "";
        $.ajax({
            url: "auction/listPartnerAuc.php",
            method: "post",
            data: {
                txt: "",
                sort: "name"
            },
        });
    }

    function sortDate() {
        console.log("test");
        var txt = "";
        $.ajax({
            url: "auction/listPartnerAuc.php",
            method: "post",
            data: {
                txt: "",
                sort: "date"
            },
        });
    }

    function sortStatus() {
        console.log("test");
        var txt = "";
        $.ajax({
            url: "auction/listPartnerAuc.php",
            method: "post",
            data: {
                txt: "",
                sort: "status"
            },
        });
    }
</script>