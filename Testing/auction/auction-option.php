<div class="row" style="padding-bottom: 2vh;">
    <?php if (mysqli_num_rows($connGetTopBid) > 0) {  //Display top 3 bidders 
    ?>
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th>Current Bid (RM)</th>
                    <th>Bidder Name</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_array($connGetTopBid)) { ?>
                    <tr>
                        <td><?php echo $row["amount_bid"] ?></td>
                        <td><?php echo $row["name"] ?></td>
                    </tr>
                <?php }  ?>
            </tbody>
        </table>
    <?php } ?>

    <?php if ($resultGetData["status"] == 4) { ?>
        <button type='button' class='btn btn-dark' style='width:100%'>Auction Ended</button>

    <?php  }  else if ($resultGetData["status"] == 1) { ?>
        <button type='button' class='btn btn-dark' style='width:100%'>Auction Haven't Start</button>

    <?php } if (empty($_SESSION['role']) && $resultGetData["status"] == 3) { ?>
        <a href="loginPage.php" class='btn btn-dark' style='width: 100%;'>Sign in as Member to bid</a>

    <?php } else if ($_SESSION['role'] == "member" && mysqli_num_rows($connGetBidderData) > 0 && $resultGetData["status"] == 3) { ?>

        <b><label for="bidAmount" style="margin: 0;">Place Your Bid</label></b>
        <input type='number' id="bidAmount" required placeholder='e.g. 999.99' style="width: 100%;" class='form-control' name='bidAmount'>
        <button type='button' class='btn btn-dark mt-3' onclick="bidding(this)" id="<?php echo $resultGetData["id"] ?>">Submit Bid</button>

    <?php } else if ($_SESSION['role'] == "member" && $resultGetData["status"] == 3) { ?>
        <button type='button' class='btn btn-dark' onclick="deposit()" style='width:100%'>Bid Now</button>

    <?php } else if ($_SESSION['role'] == "partner" && $resultGetData["status"] == 2) { ?>

        <b><label for="feedback">Feebacks from Admin:</label></b>
        <textarea disabled class="form-control mb-3" rows="3" id="feedback" name="text"><?php echo $resultGetData["comment"] ?></textarea>

        <a href="profilePage.php?editAuc=3&editPRE=0&editProf=0&editPCP=0&idUpdate=<?php echo $resultGetData["id"] ?>" style="margin-left: 350px;" class="btn btn-primary">Update</a>

    <?php } else if (($_SESSION['role'] == "partner" || $_SESSION['role'] == "admin") && ($resultGetData["status"] == 3)) { ?>

        <button class='btn btn-dark' style='width: 100%;'>Sign in as Member to bid</button>

    <?php } else if ($_SESSION['role'] == "admin" && $resultGetData["status"] == 0) { ?>

        <b><label for="feedback">Provide Feeback:</label></b>
        <textarea class="form-control mb-3" rows="3" id="feedback" placeholder="Provide any necessary feeback" name="text"></textarea>

        <button type="button" class='btn btn-dark' style='width: 40%;margin-right:2vw;margin-left:1vw;' onclick="approvedApp(this)" id="<?php echo $resultGetData["id"] ?>">Approved</button>
        <button type="button" class='btn btn-danger' style='width: 40%;' onclick="rejectApp(this)" id="<?php echo $resultGetData["id"] ?>">Reject</button>
    <?php }?>
</div>