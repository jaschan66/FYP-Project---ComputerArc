<?php
$rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);
include "$rootDir/FYP--ComputerArc/Testing/includes/dbh.inc.php";

require "advertisement/advertisementStatus.php";

$getAllAdvertQuery = "SELECT * FROM advertisement WHERE status = 2 ORDER BY RAND() LIMIT 4";
$getAllAdvert = mysqli_query($conn, $getAllAdvertQuery);
$getAllAdvertCheck = mysqli_fetch_array($getAllAdvert);

if (mysqli_num_rows($getAllAdvert) > 0) {
    $getAllAdvertQuery = "SELECT * FROM advertisement WHERE status = 2";
    $getAllAdvert = mysqli_query($conn, $getAllAdvertQuery);

    while ($rowCheck = mysqli_fetch_array($getAllAdvert)) {
        if ($rowCheck["itemType"] == 0) {
            $getItemQuery = "SELECT * FROM  pcpart WHERE id = " . $rowCheck["idRetrieve"] . " AND status = 1";
            $resultCheck = mysqli_query($conn, $getItemQuery);
            $row = mysqli_fetch_array($resultCheck); ?>

            <div class="card">
                <img class="card-img-top img-responsive" src="data:image/jpg;base64,<?php echo base64_encode($row['image']) ?>" height="180px" width="180px" style="object-fit: contain;" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $row['name'] ?></h5>
                    <p class="card-text">RM <?php echo $row['price'] ?></p>
                    <hr>
                    <a href="productPage.php?pcpart=1&productID=<?php echo $row['id'] ?>" class="btn btn-primary" style="width:100%; background-color:#000000">Details</a>
                </div>
            </div>

        <?php  } else if ($rowCheck["itemType"] == 1) {
            $getItemQuery = "SELECT * FROM prebuildpc WHERE id = " . $rowCheck["idRetrieve"] . " AND  status = 1";
            $resultCheck = mysqli_query($conn, $getItemQuery);
            $row = mysqli_fetch_array($resultCheck); ?>

            <div class="card">
                <img class="card-img-top img-responsive" src="data:image/jpg;base64,<?php echo base64_encode($row['image']) ?>" height="180px" width="180px" style="object-fit: contain;" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $row['name'] ?></h5>
                    <p class="card-text">RM <?php echo $row['price'] ?></p>
                    <hr>
                    <a href="productPage.php?pcpart=0&productID=<?php echo $row['id'] ?>" class="btn btn-primary" style="width:100%; background-color:#000000">Details</a>
                </div>
            </div>
        <?php }
        ?>
<?php }
} ?>