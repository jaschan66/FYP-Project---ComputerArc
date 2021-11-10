<?php
include "../includes/dbh.inc.php";
session_start();
$PartnerEmail   = $_SESSION['email'];
$PartnerRole    = $_SESSION['role'];
$GetPartnerID    = mysqli_query($conn, "SELECT * FROM `$PartnerRole` WHERE email ='$PartnerEmail'");

if (mysqli_num_rows($GetPartnerID) > 0) {
    $Getresult = mysqli_fetch_assoc($GetPartnerID);
    $GetOwnerID = $Getresult['id'];
}

$table = '';

$searchByName = "SELECT * FROM auction WHERE owner_id = " . $GetOwnerID . " AND title LIKE '%" . $_POST["search"] . "%'";
$searchByDate = "SELECT * FROM auction WHERE owner_id = " . $GetOwnerID . " AND start_date LIKE '%" . $_POST["search"] . "%'";

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
            <th>Current Bid</th>
            <th>Winner</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th></th>
        </tr>
    </thead>
    <tbody>';


    while ($row = mysqli_fetch_array($resultName)) {

       $table .= '<tr id="' . $row["id"] . '">
       <td>' . $rowNo . '</td>
       <td>' . $row["id"] . '</td>
       <td><img src="data:image/jpg;base64,' . base64_encode($row['image']) . '" height="180px" width="180px" alt="Profile Picture" class="img-thumbnail img-responsive"/></td>
       <td>' . $row["title"] . '</td>
       <td>RM ' . $row["starting_bid"] . '</td>
       <td>RM ' . $row["current_bid"] . '</td>
       <td>' . $row["winner"] . '</td>
       <td>'.date("j/n/Y",strtotime($row["start_date"])).'</td>
       <td>'.date("j/n/Y",strtotime($row["end_date"])).'</td>
       <td><a href="profilePage.php?editAuc=3&editPRE=0&editProf=0&editPCP=0&idUpdate='.$row["id"].'" class="btn btn-primary" >Update</a></td>
       <td><button type="button" class="btn btn-danger" onclick="deleteData(this)" id="' . $row["id"] . '">Delete</button></td>
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
            <th>Current Bid</th>
            <th>Winner</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th></th>
        </tr>
    </thead>
    <tbody>';


    while ($row = mysqli_fetch_array($resulltDate)) {
        $table .= '<tr id="' . $row["id"] . '">
        <td>' . $rowNo . '</td>
        <td>' . $row["id"] . '</td>
        <td><img src="data:image/jpg;base64,' . base64_encode($row['image']) . '" height="180px" width="180px" alt="Profile Picture" class="img-thumbnail img-responsive"/></td>
        <td>' . $row["title"] . '</td>
        <td>RM ' . $row["starting_bid"] . '</td>
        <td>RM ' . $row["current_bid"] . '</td>
        <td>' . $row["winner"] . '</td> 
        <td>'.date("j/n/Y",strtotime($row["start_date"])).'</td>
        <td>'.date("j/n/Y",strtotime($row["end_date"])).'</td>
        <td><a href="profilePage.php?editAuc=3&editPRE=0&editProf=0&editPCP=0&idUpdate='.$row["id"].'" class="btn btn-primary" >Update</a></td>
        <td><button type="button" class="btn btn-danger" onclick="deleteData(this)" id="' . $row["id"] . '">Delete</button></td>
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
    function deleteData(e) {
        var id = $(e).attr('id');
        $.ajax({
            url: "ProfilePage/deleteAuc.php",
            type: "POST",
            data: {
                idDelete: id
            },
            success: function(result) {
                window.location.reload();
            },
            error: function(result) {
                console.log(result);
            },
        })
    }
</script>
