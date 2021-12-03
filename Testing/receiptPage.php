<?php
session_start();
include "includes/dbh.inc.php";


$quantity = $_GET['qty'];
$productID = $_GET['productID'];
$productType = $_GET['productType'];
$productName = $_GET['productName'];
$paymentAmount = $_GET['paymentAmount'];
$paymentDate = $_GET['paymentDate'];
$sellerName = $_GET['sellerName'];
$sellerTelNo = $_GET['sellerTelNo'];
$raffleticket = $_GET['raffleTicket'];


$querygetProductData = "SELECT * FROM $productType WHERE id = '$productID'";
$executeProductData = mysqli_query($conn,$querygetProductData);
$getProductData = mysqli_fetch_assoc($executeProductData);
?>

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
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            overflow-x: hidden;
            overflow-y: scroll;
            /* Add the ability to scroll */
        }


        ::-webkit-scrollbar {

            width: 0.8vw;
            border-style: solid;
            border-color: #000000;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 1);
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: rgba(161, 161, 161, 0.5);
            border-radius: 10px;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: rgba(0, 0, 0, 1);

        }

        .logoutBtn {
            display: none;
        }

        #profileBtn {
            display: none;
        }

        html,
        body {
            height: 100%;
        }

        .row {
            margin: 0;
            /*padding:0;*/
        }

        .dropdown-item.active,
        .dropdown-item:active {
            color: #212529;
        }

        .dropdown-item:focus,
        .dropdown-item:hover {
            background: #fec400;
        }
    </style>


<body>


    <?php
    include("includes/header.php"); ?>


    <!--Content after here-->
    <div class="container">
        <div class="row">
            <div class="col-lg-12" style="text-align:center;">
            <img class="img-responsive" src="../Testing/download-removebg-preview.png" height="50px" width="50px" style="object-fit: contain;" alt="Success Icon">
            &nbsp;<label style="color:#000000;font-family: 'Questrial';font-size: 2vw;vertical-align:middle;margin-bottom:0!important">Payment Success!</label>
            </div>
            
        </div>
        <hr>
        <div class="row" style="min-height:70vh;">
            <div class="col-lg-5" class="img-magnifier-container">
                <img class="img-responsive" src="<?php echo 'data:image/jpg;base64,' .base64_encode($getProductData['image']) . '' ?>" height="440px" width="440px" style="object-fit: contain;" alt="Card image cap" id="productIMG">
            </div>
            <div class="col-lg-7">



                <p style="font-size: 28px"><?php echo $productName ?></p>

                <hr>



                <div class='col-sm-12' style='margin-bottom:1vh;padding:0'>
                    <p style="font-size: 20px">Quantity: <label style="text-align:right;font-size: 25px"><?php echo $quantity ?></label></p>
                    <p style="font-size: 20px">Paid Amount(RM): <label style="text-align:right;font-size: 25px"><?php echo $paymentAmount ?></label></p>
                    <p style="font-size: 20px">Transaction Made On: <label style="text-align:right;font-size: 25px"><?php echo $paymentDate ?></label></p>
                    <p style="font-size: 20px">Seller: <label style="text-align:right;font-size: 25px"><?php echo $sellerName ?></label></p>
                    <p style="font-size: 20px">Seller Tel No: <label style="text-align:right;font-size: 25px"><?php echo $sellerTelNo ?></label></p>
                    <p style="font-size: 20px">Raffle Ticket Earned: <label style="text-align:right;font-size: 25px"><?php echo $raffleticket ?></label></p>

                </div>

            </div>
             <div class='col-sm-12'>
                    <button class="btn btn-dark" onclick="backtohome()" style="width:100%">Dismiss</button>
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



    <script>
        function backtohome() {
            window.location.href = "homePage.php";
        }
    </script>

</body>

</html>