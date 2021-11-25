<?php
include "../includes/dbh.inc.php";
require "auction-status.php";
session_start();
$PartnerEmail   = $_SESSION['email'];
$PartnerRole    = $_SESSION['role'];
$GetPartnerID    = mysqli_query($conn, "SELECT * FROM `$PartnerRole` WHERE email ='$PartnerEmail'");

if (mysqli_num_rows($GetPartnerID) > 0) {
    $Getresult = mysqli_fetch_assoc($GetPartnerID);
    $GetOwnerID = $Getresult['id'];
}

$table = '';

$searchByName = "SELECT * FROM auction WHERE  owner_id = " . $GetOwnerID . " AND title LIKE '%" . $_POST["search"] . "%'";
$searchByDate = "SELECT * FROM auction WHERE owner_id = " . $GetOwnerID . " AND start_date LIKE '%" . $_POST["search"] . "%'";


$sortByName = "SELECT * FROM auction WHERE owner_id = " . $GetOwnerID . "ORDER BY title ASC";
$sortByDate = "SELECT * FROM auction WHERE owner_id = " . $GetOwnerID . "ORDER BY start_date ASC";
$sortByStatus = "SELECT * FROM auction WHERE owner_id = " . $GetOwnerID . "ORDER BY status ASC";

$resultName = mysqli_query($conn, $searchByName);
$resulltDate = mysqli_query($conn, $searchByDate);

$rowNo = 1;
?>
<style>
    .auctionTitle {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>
<?php
$sort = $_POST["sort"];

if ($sort == "all") {
    $executeSort = mysqli_query($conn, $searchByName);
} else if ($sort == "name") {
    $executeSort = mysqli_query($conn, $sortByName);
} else if ($sort == "date") {
    $executeSort = mysqli_query($conn, $sortByDate);
} else if ($sort == "status") {
    $executeSort = mysqli_query($conn, $sortByStatus);
}
//echo $sort;
// if ($sort == "name"|| $sort == "date" || $sort == "status") {
 
// }

$table .= '<div class="table-responsive">
    <table class="table table-hover ">
    <thead>
        <tr>
            <th>No.</th>
            <th>ID</th>
            <th>Image</th>
            <th>Title</th>
            <th>Starting Bid</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Status</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>';
if (mysqli_num_rows($resultName) > 0) {
    
    while ($row = mysqli_fetch_array($resultName)) {
        include "displayAuction.php";
    }
    echo $table .  "</tbody></table>";
} else if (mysqli_num_rows($resulltDate) > 0) {

    while ($row = mysqli_fetch_array($resulltDate)) {
        include "displayAuction.php";
    }
    echo $table .  "</tbody></table>";
} else if (mysqli_num_rows($executeSort) > 0) {

    while ($row = mysqli_fetch_array($executeSort)) {
        include "displayAuction.php";
    }
    echo $table .  "</tbody></table>";

} else {
    echo "<div class='alert alert-danger alert-dismissible' role='alert'>
    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
    <strong> No record are found. </strong>
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>&times;</span>
    </button>
  </div>";
}


?>

<script>
    function deleteAuction(e) {
        var id = $(e).attr('id');
        Swal.fire({
            title: 'Do you want to delete this Auction?',
            showCancelButton: true,
            confirmButtonText: 'Yes',
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    type: "POST",
                    url: "auction/deleteAuc.php",
                    data: {
                        idDelete: id
                    },
                    success: function(result) {
                        var delay = 500

                        Swal.fire(result, '', 'success').then((result => {
                            if (result.isConfirmed) {
                                window.location.reload();
                            } else {
                                setTimeout(function() {
                                    window.location.reload();
                                }, delay);
                            }
                        }))
                    }
                });
            }
        })
    }
</script>