<?php
include "../includes/dbh.local.inc.php";
session_start();
$PartnerEmail  = $_SESSION['email'];
$GetAdminID  = mysqli_query($conn, "SELECT * FROM admin WHERE email ='$PartnerEmail'");

if (mysqli_num_rows($GetAdminID) > 0) {
    $Getresult = mysqli_fetch_assoc($GetAdminID);
    $GetAdminType = $Getresult['adminType'];
}

$listPCP = "SELECT * FROM pcpart WHERE status = 2";
$listPRE = "SELECT * FROM prebuildpc WHERE status = 2";
$listAuc = "SELECT * FROM auction WHERE status = 0";

$resultListPCP = mysqli_query($conn, $listPCP);
$resulltListPRE = mysqli_query($conn, $listPRE);
$resultListAuc = mysqli_query($conn, $listAuc);
$rowNo = 1;

?>

<div class="row">
    <?php if ($GetAdminType == 4) { ?>
        <!-- Displays Auction's Approvals -->
        <div class="table-responsive col-4">
            <?php include "listAuctionApp.php"; ?>

            <!-- Displays Pre-Build's Approvals -->
            <div class="table-responsive col-4">
                <?php include "listPreBuildApp.php"; ?>

                <!-- Displays PC-part's Approvals -->
                <div class="table-responsive col-4">
                <?php include "listPCPartApp.php";
            }

            if ($GetAdminType == 3) { ?>
                    <!-- Displays Auction's Approvals -->
                    <div class="table-responsive">
                    <?php include "listAuctionApp.php";
                }

                if ($GetAdminType == 2) { ?>
                        <!-- Displays Pre-Build's Approvals -->
                        <div class="table-responsive">
                        <?php include "listPreBuildApp.php";
                    }

                    if ($GetAdminType == 1) { ?>
                            <!-- Displays PC-part's Approvals -->
                            <div class="table-responsive">
                            <?php include "listPCPartApp.php";
                        } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>