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
    date_default_timezone_set("Asia/Kuala_Lumpur");
    require "includes/header.php";
    include "includes/dbh.inc.php";
    $itemType = $_GET['itemType'];
    $idRetrieve = $_GET['idRetrieve'];
    $logonEmail = $_SESSION['email'];

    $querygetAd = "SELECT * FROM advertisement WHERE itemType = '$itemType' AND idRetrieve = '$idRetrieve' ORDER BY id DESC LIMIT 1";
    $getAdDetails = mysqli_query($conn, $querygetAd);
    $AdData = mysqli_fetch_assoc($getAdDetails);

    $advertID = $AdData["id"];

    //Calculate Date and Price
    $start_date = new DateTime($AdData["start_date"]);
    $end_date = new DateTime($AdData["end_date"]);

    $days_diff = $start_date->diff($end_date)->format("%a");
    $total = $days_diff * 100;

    if ($itemType == 0) {
        $querygetProduct = "SELECT * FROM pcpart WHERE id = '$idRetrieve'";
        $getProductDetails = mysqli_query($conn, $querygetProduct);
        $ProductData = mysqli_fetch_assoc($getProductDetails);
    } else if ($itemType == 1) {
        $querygetProduct = "SELECT * FROM prebuildpc WHERE id = '$idRetrieve'";
        $getProductDetails = mysqli_query($conn, $querygetProduct);
        $ProductData = mysqli_fetch_assoc($getProductDetails);
    } ?>

<body>
    <script src='https://www.paypal.com/sdk/js?client-id=AQ4hQhEivZvuuZanNqIzkb23shsqzDUcwUMPb4hRvNkf9RAlWdpH0n-rbFxFw_hDV9ctv3OPxfOXAwoV&locale=en_GB&currency=MYR'>
        // Required. Replace YOUR_CLIENT_ID with your sandbox client ID.
    </script>

    <!--Content after here-->
    <div class="container">
        <div class="row" style="min-height:70vh;">
            <div class="col-lg-5" class="img-magnifier-container">
                <img class="img-responsive" src="<?php echo 'data:image/jpg;base64,' . base64_encode($ProductData['image']) . '' ?>" height="440px" width="440px" style="object-fit: contain;" alt="Card image cap" id="productIMG">
            </div>
            <div class="col-lg-7">

                <p style="font-size: 28px"><?php echo $ProductData['name'] ?></p>

                <div class='col-sm-12' style='margin-bottom:1vh;padding:0'>
                    <input type='hidden' value='<?php echo $ProductData['id'] ?>' id='auctionID'>
                    <p>To Have your Item to be advertisement on our website you must first pay this amount</p>
                    <p>Advertisement Duration: <?php echo date("j/n/Y", strtotime($AdData["start_date"])) ?> - <?php echo date("j/n/Y", strtotime($AdData["end_date"])) ?></p>
                    <p>RM 100 * <?php echo $days_diff ?> per day</p>
                    <p style="font-size: 20px">Total (RM): <?php echo $total ?><label style="text-align:right;font-size: 25px" id='totalPrice'></label></p>
                    <button type="reset" onclick="history.back();" name="reset" id="reset" class="btn btn-secondary col-3" style='font-size: 1vw; font-family: Questrial; margin-bottom: 2vh;'>Back</button>
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="SweetAlert/sweetalert2.min.js"></script>

    <script>
        var getAdID = '<?php echo $advertID ?>';
        var getTotal = '<?php echo $total ?>';
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
                            value: getTotal
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
                        url: "advertisement/processAdvertisement.php",
                        data: {
                            paymentDetail: details,
                            total: getTotal,
                            advertisementID: getAdID,
                        },
                        success: function(x) {
                            if (x == "Paid successfully!") {
                                Swal.fire(x, '', 'success').then((result => {
                                    var delay = 500;
                                    if (result.isConfirmed) {
                                        window.location = "profilePage.php?sort=all&editAuc=0&editPRE=0&editProf=0&editPCP=0&editAd=1&salesO=0";
                                    } else {
                                        setTimeout(function() {
                                            window.location = "profilePage.php?sort=all&editAuc=0&editPRE=0&editProf=0&editPCP=0&editAd=1&salesO=0";
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
<!--footer-->
<?php require "includes/footer.php"; ?>

</html>