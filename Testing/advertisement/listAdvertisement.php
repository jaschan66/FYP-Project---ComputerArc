<?php
include "../includes/dbh.local.inc.php";
session_start();
$PartnerEmail  = $_SESSION['email'];
$GetPartnerID    = mysqli_query($conn, "SELECT * FROM `partner` WHERE email ='$PartnerEmail'");

if (mysqli_num_rows($GetPartnerID) > 0) {
    $Getresult = mysqli_fetch_assoc($GetPartnerID);
    $GetOwnerID = $Getresult['id'];
}

$listPCP = "SELECT * FROM pcpart WHERE seller = " . $GetOwnerID . " AND status = 1";
$listPRE = "SELECT * FROM prebuildpc WHERE seller = " . $GetOwnerID . " AND status = 1";

// $listPCP = "SELECT * FROM pcpart pcp INNER JOIN advertisement ad ON pcp.id = ad.idRetrieve 
// WHERE itemType = 0 AND partner_id = " . $GetOwnerID . " AND ad.status = 1 AND pcp.status = 1";

// $listPRE = "SELECT * FROM prebuildpc pre INNER JOIN advertisement ad ON pre.id = ad.idRetrieve 
// WHERE itemType = 0 AND partner_id = " . $GetOwnerID . " AND ad.status = 1 AND pre.status = 1";

$resultListPCP = mysqli_query($conn, $listPCP);
$resulltListPRE = mysqli_query($conn, $listPRE);


// Search
// $searchByName = "SELECT * FROM advertisement WHERE  owner_id = " . $GetOwnerID . " AND status BETWEEN 0 AND 4 AND title LIKE '%" . $_POST["search"] . "%' ORDER BY status DESC";
// $searchByDate = "SELECT * FROM advertisement WHERE owner_id = " . $GetOwnerID . " AND status BETWEEN 0 AND 4 AND start_date LIKE '%" . $_POST["search"] . "%' ORDER BY status DESC";
// $listAuc = "SELECT * FROM advertisement WHERE status = 0";


// $resultName = mysqli_query($conn, $searchByName);
// $resulltDate = mysqli_query($conn, $searchByDate);

// $resultListAuc = mysqli_query($conn, $listAuc);
$rowNo = 1;
$adStatus = "";
$date = "";
require "advertisementStatus.php";
?>

<div class="row">
    <label class="col-md-12" style="font-weight: bold; text-align: center; font-size: 1.5em;">Advertisement</label>
    <table class="table table-hover ">
        <thead>
            <tr>
                <th>No.</th>
                <th>Image</th>
                <th>Title</th>
                <th>Start_date</th>
                <th>End_date</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php if (mysqli_num_rows($resultListPCP) > 0) {
                while ($row = mysqli_fetch_array($resultListPCP)) {
                    $checkIfGot = "SELECT * FROM advertisement WHERE itemType = 0 AND partner_id = " . $GetOwnerID . " AND idRetrieve = " . $row["id"] . " ORDER BY ID DESC LIMIT 1";
                    $resultCheck = mysqli_query($conn, $checkIfGot);
                    $rowCheck = mysqli_fetch_array($resultCheck);

                    if (isset($rowCheck["status"])) {
                        if ($rowCheck["status"] == 0) {
                            $startdate = "";
                            $enddate = "";
                            $adStatus = "-";
                            $auctionBtn = "<td><a href='profilePage.php?editAd=2&editAuc=0&editPRE=0&editProf=0&editPCP=0&itemType=0&salesO=0&idRetrieve=" . $row['id'] . "' class='btn btn-dark'>Create Advert</a></td>";
                        } else if ($rowCheck["status"] == 1) {
                            $startdate = $rowCheck["start_date"];
                            $enddate = $rowCheck["start_date"];
                            $adStatus = "Created";
                            $auctionBtn = '<td><a href="#" class="btn btn-dark">Advert Created</a></td>';
                        } else if ($rowCheck["status"] == 2) {
                            $startdate = $rowCheck["start_date"];
                            $enddate = $rowCheck["start_date"];
                            $auctionBtn = '<td><a href="#" class="btn btn-dark">Advert Created</a></td>';
                        } else if ($rowCheck["status"] == 3) {
                            $startdate = $rowCheck["start_date"];
                            $enddate = $rowCheck["start_date"];
                            $adStatus = "Ended";
                            $auctionBtn = "<td><a href='profilePage.php?editAd=2&editAuc=0&editPRE=0&editProf=0&editPCP=0&itemType=0&salesO=0&idRetrieve=" . $row['id'] . "' class='btn btn-dark'>Create Advert</a></td>";
                        }
                    } else {
                        $startdate = "";
                        $enddate = "";
                        $adStatus = "-";
                        $auctionBtn = "<td><a href='profilePage.php?editAd=2&editAuc=0&editPRE=0&editProf=0&editPCP=0&itemType=0&salesO=0&idRetrieve=" . $row['id'] . "' class='btn btn-dark'>Create Advert</a></td>";
                    } ?>

                    <tr id="<?php echo $row["id"] ?>">
                        <td><?php echo $rowNo ?></td>
                        <td><img src="data:image/jpg;base64,<?php echo base64_encode($row['image']) ?>" height="180px" width="180px" alt="Auction Image" class="img-thumbnail img-responsive" /></td>
                        <td id="auctionTitle"><?php echo $row["name"] ?></td>
                        <td><?php if ($startdate != "")
                                echo date("j/n/Y", strtotime($startdate)) ?></td>
                        <td><?php if ($enddate != "")
                                echo date("j/n/Y", strtotime($enddate)) ?></td>
                        <td><?php echo $adStatus ?></td>
                        <?php echo $auctionBtn ?>
                    </tr>
                <?php $rowNo++;
                } ?>
                <?php }
            if (mysqli_num_rows($resulltListPRE) > 0) {
                while ($row = mysqli_fetch_array($resulltListPRE)) {
                    $checkIfGot = "SELECT * FROM advertisement WHERE itemType = 1 AND partner_id = " . $GetOwnerID . " AND idRetrieve = " . $row["id"] . " ORDER BY ID DESC LIMIT 1";
                    $resultCheck = mysqli_query($conn, $checkIfGot);
                    $rowCheck = mysqli_fetch_array($resultCheck);

                    if (isset($rowCheck["status"])) {
                        if ($rowCheck["status"] == 0) {
                            $startdate = "";
                            $enddate = "";
                            $adStatus = "-";
                            $auctionBtn = "<td><a href='profilePage.php?editAd=2&editAuc=0&editPRE=0&editProf=0&editPCP=0&itemType=1&salesO=0&idRetrieve=" . $row['id'] . "' class='btn btn-dark'>Create Advert</a></td>";
                        } else if ($rowCheck["status"] == 1) {
                            $startdate = $rowCheck["start_date"];
                            $enddate = $rowCheck["start_date"];
                            $adStatus = "Created";
                            $auctionBtn = '<td><a href="#" class="btn btn-dark">Advert Created</a></td>';
                        } else if ($rowCheck["status"] == 2) {
                            $startdate = $rowCheck["start_date"];
                            $enddate = $rowCheck["start_date"];
                            $adStatus = "Showing";
                            $auctionBtn = '<td><a href="#" class="btn btn-dark">Advert Created</a></td>';
                        } else if ($rowCheck["status"] == 3) {
                            $startdate = $rowCheck["start_date"];
                            $enddate = $rowCheck["start_date"];
                            $adStatus = "Ended";
                            $auctionBtn = "<td><a href='profilePage.php?editAd=2&editAuc=0&editPRE=0&editProf=0&editPCP=0&itemType=1&salesO=0&idRetrieve=" . $row['id'] . "' class='btn btn-dark'>Create Advert</a></td>";
                        }
                    } else {
                        $startdate = "";
                        $enddate = "";
                        $adStatus = "-";
                        $auctionBtn = "<td><a href='profilePage.php?editAd=2&editAuc=0&editPRE=0&editProf=0&editPCP=0&itemType=1&salesO=0&idRetrieve=" . $row['id'] . "' class='btn btn-dark'>Create Advert</a></td>";
                    } ?>
                    <tr id="<?php echo $row["id"] ?>">
                        <td><?php echo $rowNo ?></td>
                        <td><img src="data:image/jpg;base64,<?php echo base64_encode($row['image']) ?>" height="180px" width="180px" alt="Auction Image" class="img-thumbnail img-responsive" /></td>
                        <td id="auctionTitle"><?php echo $row["name"] ?></td>
                        <td><?php if ($startdate != "")
                                echo date("j/n/Y", strtotime($startdate)) ?></td>
                        <td><?php if ($enddate != "") echo date("j/n/Y", strtotime($startdate)) ?></td>
                        <td><?php echo $adStatus ?></td>
                        <?php echo $auctionBtn ?>
                    </tr>
                <?php $rowNo++;
                } ?>
        </tbody>
    </table>

<?php } else { ?>
    <div class='alert alert-danger alert-dismissible' role='alert'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <strong> No record are found. </strong>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
    </div>
<?php } ?>
</div>