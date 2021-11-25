<?php
include "../includes/dbh.local.inc.php";

$listPCP = "SELECT * FROM pcpart WHERE status = 2";
$listPRE = "SELECT * FROM prebuildpc WHERE status = 2";
$listAuc = "SELECT * FROM auction WHERE status = 0";

$resultListPCP = mysqli_query($conn, $listPCP);
$resulltListPRE = mysqli_query($conn, $listPRE);
$resultListAuc = mysqli_query($conn, $listAuc);
$rowNo = 1;

?>

<!-- Displays PC-part's Approvals -->
<div class="row">
    <div class="table-responsive col-4">
        <label  class="col-md-12" style="font-weight: bold; text-align: center; font-size: 1.5em;">PC Part</label>
        <table class="table table-hover ">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>

                <?php
                if (mysqli_num_rows($resultListPCP) > 0) {
                    while ($row = mysqli_fetch_array($resultListPCP)) { ?>
                        <tr id="<?php echo $row["id"] ?>">
                            <td><?php echo $rowNo ?></td>
                            <td><?php echo $row["id"] ?></td>
                            <td><img src="data:image/jpg;base64,<?php echo base64_encode($row['image']) ?>" height="180px" width="180px" alt="PC-part Image" class="img-thumbnail img-responsive" /></td>
                            <td id="auctionTitle"><?php echo $row["name"] ?></td>
                            <td><a href="productPage.php?pcpart=1&productID=<?php echo $row["id"] ?>" class="btn btn-dark">View</a></td>
                            <td><button type="button" class="btn btn-danger" onclick="rejectPCPApp(this)" id="<?php echo $row["id"] ?>">Reject</button></td>
                        </tr>
                <?php $rowNo++;
                    }
                } ?>
            </tbody>
        </table>
    </div>

    <!-- Displays Pre-Build's Approvals -->
    <div class="table-responsive col-4">
        <label class="col-md-12" style="font-weight: bold; text-align: center; font-size: 1.5em;">Pre-Build PC</label>
        <table class="table table-hover ">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>

                <?php if (mysqli_num_rows($resulltListPRE) > 0) {
                    while ($row = mysqli_fetch_array($resulltListPRE)) { ?>

                        <tr id="<?php echo $row["id"] ?>">
                            <td><?php echo $rowNo ?></td>
                            <td><?php echo $row["id"] ?></td>
                            <td><img src="data:image/jpg;base64,<?php echo base64_encode($row['image']) ?>" height="180px" width="180px" alt="Pre-Build Image" class="img-thumbnail img-responsive" /></td>
                            <td id="auctionTitle"><?php echo $row["name"] ?>'</td>
                            <td><a href="productPage.php?pcpart=0&productID=<?php echo $row["id"] ?>" class="btn btn-dark">View</a></td>
                            <td><button type="button" class="btn btn-danger" onclick="rejectPREApp(this)" id="<?php echo $row["id"] ?>">Reject</button></td>
                        </tr>
                <?php $rowNo++;
                    }
                } ?>
            </tbody>
        </table>
    </div>

    <!-- Displays Auction's Approvals -->
    <div class="table-responsive col-4">
        <label  class="col-md-12" style="font-weight: bold; text-align: center; font-size: 1.5em;">Auction</label>
        <table class="table table-hover ">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>

                <?php if (mysqli_num_rows($resultListAuc) > 0) {
                    while ($row = mysqli_fetch_array($resultListAuc)) { ?>

                        <tr id="<?php echo $row["id"]?>">
                            <td><?php echo $rowNo ?></td>
                            <td><?php echo $row["id"]?></td>
                            <td><img src="data:image/jpg;base64,<?php echo base64_encode($row['image']) ?>" height="180px" width="180px" alt="Auction Image" class="img-thumbnail img-responsive" /></td>
                            <td id="auctionTitle"><?php echo $row["title"] ?></td>
                            <td><a href="auctionDetailPage.php?idRetrieve=<?php echo $row["id"]?>" class="btn btn-dark">View</a></td>
                            <td><button type="button" class="btn btn-danger" onclick="rejectAuctionApp(this)" id="<?php echo $row["id"]?>">Reject</button></td>
                        </tr>
                    <?php $rowNo++;
                    }
                } else { ?>
            </tbody>
        </table>
    </div>
    <div class='alert alert-danger alert-dismissible' role='alert'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <strong> No record's are found. </strong>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
    </div>
<?php } ?>


<script>
    //Reject PC-Part Application
    function rejectPCPApp(e) {
        var id = $(e).attr('id');
        Swal.fire({
            title: 'Are you sure you want to reject this Approval?',
            showCancelButton: true,
            confirmButtonText: 'Yes',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "admin/rejectApproval.php",
                    data: {
                        idPCPReject: id
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
<script>
    //Reject Pre-Build PC Application
    function rejectPREApp(e) {
        var id = $(e).attr('id');
        Swal.fire({
            title: 'Are you sure you want to reject this Approval?',
            showCancelButton: true,
            confirmButtonText: 'Yes',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "admin/rejectApproval.php",
                    data: {
                        idPREReject: id
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
<script>
    //Reject Auction Application
    function rejectAuctionApp(e) {
        var id = $(e).attr('id');
        Swal.fire({
            title: 'Are you sure you want to reject this Approval?',
            showCancelButton: true,
            confirmButtonText: 'Yes',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "admin/rejectApproval.php",
                    data: {
                        idAUCReject: id
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