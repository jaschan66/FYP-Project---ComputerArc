<?php session_start(); ?>
<!DOCTYPE html>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta charset=" utf-8" />

<head>
    <title>ComputerArc</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <link rel="icon" href="Logo stuff\favicon-32x32.png" type="image/x-icon">
    <link href='https://fonts.googleapis.com/css?family=Questrial' rel='stylesheet'>
    <link href='SweetAlert/sweetalert2.min.css' rel='stylesheet'>

    <?php

    include "includes/dbh.inc.php";
    $deposit = $_GET['deposit'];
    $auctionID = $_GET['auctionID'];
    $logonEmail = $_SESSION['email'];

    $querygetAuction = "SELECT * FROM auction WHERE id = '$auctionID'";
    $getAuctionDetails = mysqli_query($conn, $querygetAuction);
    $auctionData = mysqli_fetch_assoc($getAuctionDetails);

    ?>

<body>
    <script src='https://www.paypal.com/sdk/js?client-id=AQ4hQhEivZvuuZanNqIzkb23shsqzDUcwUMPb4hRvNkf9RAlWdpH0n-rbFxFw_hDV9ctv3OPxfOXAwoV&locale=en_GB&currency=MYR'>
        // Required. Replace YOUR_CLIENT_ID with your sandbox client ID.
    </script>

    <?php
    include("includes/header.php"); ?>


    <!--Content after here-->
    <div class="container">
        <div class="row" style="min-height:70vh;">
            <div class="col-lg-5" class="img-magnifier-container">
                <img class="img-responsive" src="<?php echo 'data:image/jpg;base64,' . base64_encode($auctionData['image']) . '' ?>" height="440px" width="440px" style="object-fit: contain;" alt="Card image cap" id="productIMG">
            </div>
            <div class="col-lg-7">

                <p style="font-size: 28px"><?php echo $auctionData['title'] ?></p>

                <div class='col-sm-12' style='margin-bottom:1vh;padding:0'>
                    <input type='hidden' value='<?php echo $auctionData['id'] ?>' id='auctionID'>
                    <p>To Start Bidding you must first pay a minumum of 20% deposit</p>
                    <p style="font-size: 20px">Total Deposit(RM): <?php echo $deposit ?><label style="text-align:right;font-size: 25px" id='totalPrice'></label></p>
                </div>
                <div id="paypal-button-container"></div>

                <div class='col-sm-12'>

                </div>

            </div>
        </div>
        <hr />


    </div>
    </div>
    </div>
    </div>
    <!--Content ends here-->
    <?php include 'includes/footer.php'; ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="SweetAlert/sweetalert2.min.js"></script>

    <script>
        var getAuctionID = '<?php echo $auctionID?>';
        var getDeposit = '<?php echo $deposit?>';
    </script>

    <script>
        paypal.Buttons({
            style: {
                layout: 'vertical',
                color: 'black',
                shape: 'rect',
                label: 'paypal'
            },
            createOrder: function(data, actions) {
                // Set up the transaction
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: getDeposit
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                // This function captures the funds from the transaction.
                return actions.order.capture().then(function(details) {
                    // This function shows a transaction success message to your buyer.
                    console.log(details);

                    $.ajax({
                        type: "POST",
                        url: "processDeposit.php",
                        data: {
                            paymentDetail: details,
                            deposit: getDeposit,
                            auctionID: getAuctionID,
                        },
                        success: function(x) {
                            if (x == "Paid successfuly!") {
                                Swal.fire(x, '', 'success').then((result => {
                                    var delay = 500;
                                    if (result.isConfirmed) {
                                        window.location = "auctionDetailPage.php?idRetrieve=<?php echo $auctionID ?>";
                                    } else {
                                        setTimeout(function() {
                                            window.location = "auctionDetailPage.php?idRetrieve=<?php echo $auctionID ?>";
                                        }, delay);
                                    }
                                }))

                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Something went wrong!',
                                    html: '<pre>' + x + '</pre>',
                                    customClass: {
                                        popup: 'format-pre'
                                    }
                                })
                            }
                        }
                    });

                });
            }


        }).render('#paypal-button-container');
    </script>

</body>

</html>