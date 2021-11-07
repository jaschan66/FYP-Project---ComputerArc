<?php
include "E:\FYP\htdocs\FYP--ComputerArc\Testing\includes\dbh.inc.php";
session_start();
$PartnerEmail   = $_SESSION['email'];
$PartnerRole    = $_SESSION['role'];
$GetID    = mysqli_query($conn, "SELECT * FROM `$PartnerRole` WHERE email ='$PartnerEmail'");

if (mysqli_num_rows($GetID) > 0) {
    $Getresult = mysqli_fetch_assoc($GetID);
    $GetIDRes = $Getresult['id'];
}
$table = '';

$searchByName = "SELECT * FROM prebuildpc WHERE status = 1 AND seller = " . $GetIDRes . " AND name LIKE '%" . $_POST["search"] . "%'";
$earchByCate = "SELECT * FROM prebuildpc WHERE status = 1 AND seller = " . $GetIDRes . " AND category LIKE '%" . $_POST["search"] . "%'";

$resultName  = mysqli_query($conn, $searchByName);
$resulltCate = mysqli_query($conn, $earchByCate);

$rowNo = 1;

if (mysqli_num_rows($resultName) > 0) {
    $table .= '<div class="table-responsive">
    <table class="table table-hover ">
    <thead>
        <tr>
            <th>No.</th>
            <th>ID</th>
            <th>Image</th>
            <th>Name</th>
            <th>Category</th>
            <th>Stock</th>
            <th>Price</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>';


    while ($row = mysqli_fetch_array($resultName)) {

        $table .= '<tr id="' . $row["id"] . '">
       <td>' . $rowNo . '</td>
       <td>' . $row["id"] . '</td>
       <td><img src="data:image/jpg;base64,' . base64_encode($row['image']) . '" height="180px" width="180px" alt="Profile Picture" class="img-thumbnail img-responsive"/></td>
       <td>' . $row["name"] . '</td>
       <td>' . $row["category"] . '</td>
       <td>' . $row["stock"] . '</td>
       <td>' . $row["price"] . '</td>
       <td><a href="profilePage.php?editPRE=3&editProf=0&idUpdate='.$row["id"].'" class="btn btn-primary" >Update</a></td>
       <td><button type="button" class="btn btn-danger" onclick="deleteData(this)" id="' . $row["id"] . '">Delete</button></td>
       </tr>';
        $rowNo++;
    }
    echo $table .  "</tbody></table>";
} else if (mysqli_num_rows($resulltCate) > 0) {
    $table .= '<div class="table-responsive">
    <table class="table">
    <thead>
        <tr>
            <th>No.</th>
            <th>ID</th>
            <th>Image</th>
            <th>Name</th>
            <th>Category</th>
            <th>Stock</th>
            <th>Price</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>';


    while ($row = mysqli_fetch_array($resulltCate)) {
        $table .= '<tr id="' . $row["id"] . '">
       <td>' . $rowNo . '</td>
       <td>' . $row["id"] . '</td>
       <td><img src="data:image/jpg;base64,' . base64_encode($row['image']) . '" height="180px" width="180px" alt="Profile Picture" class="img-thumbnail img-responsive"/></td>
       <td>' . $row["name"] . '</td>
       <td>' . $row["category"] . '</td>
       <td>' . $row["stock"] . '</td>
       <td>' . $row["price"] . '</td>
       <td><a href="profilePage.php?editPRE=3&editProf=0&idUpdate='.$row["id"].'" class="btn btn-primary" >Update</a></td>
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
            url: "ProfilePage/deletePRE.php",
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

<!-- <script>
    function updateData(i) {
        var id = $(i).attr('id');
        $.ajax({
            url: "ProfilePage/updatePRE.php",
            type: "POST",
            data: {
                idUpdate: id
            },
            success: function(result){
                location.href = "profilePage.php?editPRE=3&editProf=0";
            },
            error: function(result) {
                console.log(result);
            },
        })
    }
</script> -->

<!-- <script>
    $(document).ready(function() {
        $('table tbody tr').click(function() {
            var id = $(this).attr('id');
            var url = new URL('http://localhost/NexusNet/ShowsProfilePage.php');

            url.searchParams.set('showsID', id)
            window.location.href = url

        });
    });
</script> -->