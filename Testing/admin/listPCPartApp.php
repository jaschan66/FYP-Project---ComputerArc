    <label class="col-md-12" style="font-weight: bold; text-align: center; font-size: 1.5em;">PC Part</label>
    <table class="table table-hover ">
        <thead>
            <tr>
                <th>No.</th>
                <th>ID</th>
                <th>Image</th>
                <th>Title</th>
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
                    </tr>
            <?php $rowNo++;
                }
            } ?>
        </tbody>
    </table>
</div>