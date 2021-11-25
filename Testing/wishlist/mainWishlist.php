<?php
include "includes\dbh.inc.php";
session_start();
?>

<script>
    function loadTable() {
        var txt = $('#searchWish').val();
        if (txt == '' || txt != '') {
            $.ajax({
                url: "wishlist/listWishlist.php",
                method: "post",
                data: {
                    search: txt
                },
                dataType: "text",
                success: function(data) {
                    $('#listWishlist').html(data);
                }
            })
        } else {
            $('#listWishlist').html('');
        }
    }
    window.onload = loadTable;
</script>

<input type="text" class="form-control" size="50" placeholder="Search using Name or Category" onkeyup="Wishlistfunction()" name="searchWish" id="searchWish" autofocus style="margin-bottom:2vh;">

<div id="listWishlist">

</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function() {
        $('#searchWish').keyup(function() {
            var txt = $(this).val();
            if (txt == '' || txt != '') {
                $.ajax({
                    url: "wishlist/listWishlist.php",
                    method: "post",
                    data: {
                        search: txt
                    },
                    dataType: "text",
                    success: function(data) {
                        $('#listWishlist').html(data);
                    }
                })
            } else {
                $('#listWishlist').html('');
            }
        });
    });
</script>