<?php
include "../includes/dbh.inc.php";
include "auction-status.php";
session_start();
$PartnerEmail   = $_SESSION['email'];
$PartnerRole    = $_SESSION['role'];
$GetPartnerID    = mysqli_query($conn, "SELECT * FROM `$PartnerRole` WHERE email ='$PartnerEmail'");

if (mysqli_num_rows($GetPartnerID) > 0) {
    $Getresult = mysqli_fetch_assoc($GetPartnerID);
    $GetOwnerID = $Getresult['id'];
}

$table = '';

$searchByName = "SELECT * FROM auction WHERE  owner_id = " . $GetOwnerID . " AND title LIKE '%" . $_POST["search"] . "%' ORDER BY status DESC";
$searchByDate = "SELECT * FROM auction WHERE owner_id = " . $GetOwnerID . " AND start_date LIKE '%" . $_POST["search"] . "%' ORDER BY status DESC";

$resultName = mysqli_query($conn, $searchByName);
$resulltDate = mysqli_query($conn, $searchByDate);

$rowNo = 1;

if (mysqli_num_rows($resultName) > 0) {
    $table .= '<div class="table-responsive">
    <table class="table table-hover ">
    <thead>
        <tr>
            <th>No.</th>
            <th>ID</th>
            <th>Image</th>
            <th>Title</th>
            <th>Starting Bid</th>
            <th>Winner</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Status</th>
            <th></th>
        </tr>
    </thead>
    <tbody>';


    while ($row = mysqli_fetch_array($resultName)) {

        if ($row["status"] == 0) {
            $aucstatus = "<td>Pending approval</td>";
            $auctionBtn = '<td></td><td></td>';
        } else if($row["status"] == 1) {
            $aucstatus = "<td>Approved</td>";
            $auctionBtn = '<td><a href="profilePage.php?editAuc=3&editPRE=0&editProf=0&editPCP=0&idUpdate=' . $row["id"] . '" class="btn btn-primary" >Update</a></td>
            <td><button type="button" class="btn btn-danger" onclick="deleteAuction(this)" id="' . $row["id"] . '">Delete</button></td>';
        } else if($row["status"] == 2) {
            $aucstatus = "<td>Rejected</td>";
            $auctionBtn = '<td><a href="profilePage.php?editAuc=3&editPRE=0&editProf=0&editPCP=0&idUpdate=' . $row["id"] . '" class="btn btn-primary" >Update</a></td>
            <td><button type="button" class="btn btn-danger" onclick="deleteAuction(this)" id="' . $row["id"] . '">Delete</button></td>';
        } else if($row["status"] == 3) {
            $aucstatus = "<td>Auction Started</td>";
            $auctionBtn = '<td></td><td></td>';
        } else if($row["status"] == 4) {
            $aucstatus = "<td>Auction Ended</td>";
            $auctionBtn = '<td></td><td></td>';
        }

        $table .= '<tr id="' . $row["id"] . '">
       <a href="auctionDetailPage.php?idRetrieve=' . $row["id"] . '">
       <td>' . $rowNo . '</td>
       <td>' . $row["id"] . '</td>
       <td><img src="data:image/jpg;base64,' . base64_encode($row['image']) . '" height="180px" width="180px" alt="Auction Image" class="img-thumbnail img-responsive"/></td>
       <td>' . $row["title"] . '</td>
       <td>RM ' . number_format($row["starting_bid"], 2) . '</td>
       <td>' . $row["winner"] . '</td>
       <td>' . date("j/n/Y", strtotime($row["start_date"])) . '</td>
       <td>' . date("j/n/Y", strtotime($row["end_date"])) . '</td>
       '. $aucstatus .'
       </a>
       '. $auctionBtn .'
       </tr>';
        $rowNo++;
    }
    echo $table .  "</tbody></table>";
} else if (mysqli_num_rows($resulltDate) > 0) {
    $table .= '<div class="table-responsive">
    <table class="table">
    <thead>
        <tr>
            <th>No.</th>
            <th>ID</th>
            <th>Image</th>
            <th>Title</th>
            <th>Starting bid</th>
            <th>Winner</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Status</th>
            <th></th>
        </tr>
    </thead>
    <tbody>';


    while ($row = mysqli_fetch_array($resulltDate)) {

        if ($row["status"] == 0) {
            $aucstatus = "<td>Pending approval</td>";
            $auctionBtn = '<td></td><td></td>';
        } else if($row["status"] == 1) {
            $aucstatus = "<td>Approved</td>";
            $auctionBtn = '<td><a href="profilePage.php?editAuc=3&editPRE=0&editProf=0&editPCP=0&idUpdate=' . $row["id"] . '" class="btn btn-primary" >Update</a></td>
            <td><button type="button" class="btn btn-danger" onclick="deleteAuction(this)" id="' . $row["id"] . '">Delete</button></td>';
        } else if($row["status"] == 2) {
            $aucstatus = "<td>Rejected</td>";
            $auctionBtn = '<td><a href="profilePage.php?editAuc=3&editPRE=0&editProf=0&editPCP=0&idUpdate=' . $row["id"] . '" class="btn btn-primary" >Update</a></td>
            <td><button type="button" class="btn btn-danger" onclick="deleteAuction(this)" id="' . $row["id"] . '">Delete</button></td>';
        } else if($row["status"] == 3) {
            $aucstatus = "<td>Auction Started</td>";
            $auctionBtn = '<td></td><td></td>';
        } else if($row["status"] == 4) {
            $aucstatus = "<td>Auction Ended</td>";
            $auctionBtn = '<td></td><td></td>';
        }

        $table .= '<tr id="' . $row["id"] . '"> 
        <a href="auctionDetailPage.php?idRetrieve=' . $row["id"] . '">
        <td>' . $rowNo . '</td>
        <td>' . $row["id"] . '</td>
        <td><img src="data:image/jpg;base64,' . base64_encode($row['image']) . '" height="180px" width="180px" alt="Auction Image" class="img-thumbnail img-responsive"/></td>
        <td>' . $row["title"] . '</td>
        <td>RM ' . number_format($row["starting_bid"], 2) . '</td>
        <td>' . $row["winner"] . '</td> 
        <td>' . date("j/n/Y", strtotime($row["start_date"])) . '</td>
        <td>' . date("j/n/Y", strtotime($row["end_date"])) . '</td>
        '. $aucstatus .'
        </a>
        '. $auctionBtn .'
       </tr>';
        $rowNo++;
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