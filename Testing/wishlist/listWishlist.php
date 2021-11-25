<?php
include "../includes/dbh.local.inc.php";
session_start();
$MemberEmail   = $_SESSION['email'];
$GetMemberID    = mysqli_query($conn, "SELECT * FROM `member` WHERE email ='$MemberEmail'");

if (mysqli_num_rows($GetMemberID) > 0) {
    $Getresult = mysqli_fetch_assoc($GetMemberID);
    $GetOwnerID = $Getresult['id'];
}

$listWishlist = "SELECT * FROM wishlist WHERE member_id = $GetOwnerID";

$resultWishlist = mysqli_query($conn, $listWishlist);
$rowNo = 1;

?>

<!-- Displays PC-part's Approvals -->
<div class="row">
    <table class="table table-hover ">
        <thead>
            <tr>
                <th>No.</th>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Date Added</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>

            <?php
            if (mysqli_num_rows($resultWishlist) > 0) {
                while ($row = mysqli_fetch_array($resultWishlist)) {
                    if (mysqli_num_rows($resultItem = mysqli_query($conn, "SELECT * FROM pcpart WHERE id = {$row['product_id']}")) > 0) {
                        $rowItem = mysqli_fetch_assoc($resultItem);
            ?>
                        <tr id="<?php echo $row["id"] ?>">
                            <td><?php echo $rowNo ?></td>
                            <td><img src="data:image/jpg;base64,<?php echo base64_encode($rowItem['image']) ?>" height="180px" width="180px" alt="PC-part Image" class="img-thumbnail img-responsive" /></td>
                            <td id="auctionTitle"><?php echo $rowItem["name"] ?></td>
                            <td>RM <?php echo $rowItem["price"] ?></td>
                            <td><?php echo date("j/n/Y", strtotime($row["date"])) ?></td>
                            <td><a href="productPage.php?pcpart=1&productID=<?php echo $rowItem["id"] ?>" class="btn btn-dark">View</a></td>
                            <td><button type="button" class="btn btn-danger" onclick="wishPCP(this)" id="<?php echo $rowItem["id"] ?>">Remove</button></td>
                        </tr>
                        <?php $rowNo++; ?>

                    <?php } else if (mysqli_num_rows($resultItem = mysqli_query($conn, "SELECT * FROM prebuildpc WHERE id = {$row['product_id']}")) > 0) {
                        $rowItem = mysqli_fetch_assoc($resultItem);
                    ?>
                        <tr id="<?php echo $row["id"] ?>">
                            <td><?php echo $rowNo ?></td>
                            <td><img src="data:image/jpg;base64,<?php echo base64_encode($rowItem['image']) ?>" height="180px" width="180px" alt="PC-part Image" class="img-thumbnail img-responsive" /></td>
                            <td id="auctionTitle"><?php echo $rowItem["name"] ?></td>
                            <td>RM <?php echo $rowItem["price"] ?></td>
                            <td><?php echo date("j/n/Y", strtotime($row["date"])) ?></td>
                            <td><a href="productPage.php?pcpart=0&productID=<?php echo $rowItem["id"] ?>" class="btn btn-dark">View</a></td>
                            <td><button type="button" class="btn btn-danger" onclick="wishPRE(this)" id="<?php echo $rowItem["id"] ?>">Remove</button></td>
                        </tr>
                <?php $rowNo++;
                    }
                }
            } else { ?>
        </tbody>
    </table>
    <div class='alert alert-danger alert-dismissible col-12' role='alert'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <strong> No record's are found. </strong>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
    </div>
<?php } ?>


<script>
    //Wishlist Pre-Build PC
    function wishPRE(e) {
        var id = $(e).attr('id');
        $.ajax({
            type: "POST",
            url: "wishlist/wishlist-insert.php",
            data: {
                wishPRE: id
            },
            success: function(result) {
                var delay = 500
                if (result == "Item added to wishlist") {
                    Swal.fire(result, '', 'success').then((result => {
                        if (result.isConfirmed) {
                            window.location.reload();
                        } else {
                            setTimeout(function() {
                                window.location.reload();
                            }, delay);
                        }
                    }))
                } else if (result == "Item removed from wishlist") {
                    Swal.fire(result, '', 'success').then((result => {
                        if (result.isConfirmed) {
                            window.location.reload();
                        } else {
                            setTimeout(function() {
                                window.location.reload();
                            }, delay);
                        }
                    }))
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Something went wrong!',
                        html: '<pre>' + result + '</pre>',
                        customClass: {
                            popup: 'format-pre'
                        }
                    })
                }
            }
        });
    }

    //Wishlist Pre-Build PC
    function wishPCP(e) {
        var id = $(e).attr('id');
        $.ajax({
            type: "POST",
            url: "wishlist/wishlist-insert.php",
            data: {
                wishPCP: id
            },
            success: function(result) {
                var delay = 500
                if (result == "Item added to wishlist") {
                    Swal.fire(result, '', 'success').then((result => {
                        if (result.isConfirmed) {
                            window.location.reload();
                        } else {
                            setTimeout(function() {
                                window.location.reload();
                            }, delay);
                        }
                    }))
                } else if (result == "Item removed from wishlist") {
                    Swal.fire(result, '', 'success').then((result => {
                        if (result.isConfirmed) {
                            window.location.reload();
                        } else {
                            setTimeout(function() {
                                window.location.reload();
                            }, delay);
                        }
                    }))
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Something went wrong!',
                        html: '<pre>' + result + '</pre>',
                        customClass: {
                            popup: 'format-pre'
                        }
                    })
                }
            }
        });
    }
</script>