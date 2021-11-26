<?php
include "../includes/dbh.inc.php";
session_start();
$PartnerEmail   = $_SESSION['email'];
$PartnerRole    = $_SESSION['role'];
$GetID    = mysqli_query($conn, "SELECT * FROM `$PartnerRole` WHERE email ='$PartnerEmail'");

if (mysqli_num_rows($GetID) > 0) {
    $Getresult = mysqli_fetch_assoc($GetID);
    $GetIDRes = $Getresult['id'];
}
$table = '';

$searchByName = "SELECT * FROM pcpart WHERE status = 1 AND seller = " . $GetIDRes . " AND name LIKE '%" . $_POST["search"] . "%'";
$searchByPart = "SELECT * FROM pcpart WHERE status = 1 AND seller = " . $GetIDRes . " AND part LIKE '%" . $_POST["search"] . "%'";

$resultName  = mysqli_query($conn, $searchByName);
$resultPart = mysqli_query($conn, $searchByPart);

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
       <td>' . $row["part"] . '</td>
       <td>' . $row["stock"] . '</td>
       <td>' . $row["price"] . '</td>
       <td><a href="profilePage.php?editPRE=0&editProf=0&editPCP=3&editAuc=0&idUpdatePCP='.$row["id"].'" class="btn btn-primary" >Update</a></td>
       <td><button type="button" class="btn btn-danger" onclick="deleteData(this)" id="' . $row["id"] . '">Delete</button></td>
       </tr>';
        $rowNo++;
    }
    echo $table .  "</tbody></table>";
    exit;
} else if (mysqli_num_rows($resultPart) > 0) {
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


    while ($row = mysqli_fetch_array($resultPart)) {
        $table .= '<tr id="' . $row["id"] . '">
       <td>' . $rowNo . '</td>
       <td>' . $row["id"] . '</td>
       <td><img src="data:image/jpg;base64,' . base64_encode($row['image']) . '" height="180px" width="180px" alt="Profile Picture" class="img-thumbnail img-responsive"/></td>
       <td>' . $row["name"] . '</td>
       <td>' . $row["part"] . '</td>
       <td>' . $row["stock"] . '</td>
       <td>' . $row["price"] . '</td>
       <td><a href="profilePage.php?editProf=0&editPRE=0&editPCP=3&editAuc=0&idUpdate='.$row["id"].'" class="btn btn-primary" >Update</a></td>
       <td><button type="button" class="btn btn-danger" onclick="deleteData(this)" id="' . $row["id"] . '">Delete</button></td>
       </tr>';
        $rowNo++;
    }
    echo $table .  "</tbody></table>";
    exit;
} else {
    echo "<div class='alert alert-danger alert-dismissible' role='alert'>
    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
    <strong> No record are found. </strong>
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>&times;</span>
    </button>
  </div>";
  exit;
}




?>


