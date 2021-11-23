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

<?php

include "includes/dbh.inc.php";
$qty = $_GET['qty'];
$isPCP = $_GET['productType'];
$productID = $_GET['productID'];
 $logonEmail = $_SESSION['email'];




if($isPCP == "PRE"){
    $querygetProduct = "SELECT * FROM prebuildpc WHERE id = '$productID'";
    $getProductData = mysqli_query($conn, $querygetProduct);
    $productData = mysqli_fetch_assoc($getProductData);
    $productType = "PRE";
}
else if($isPCP == "PCP"){
    $querygetProduct = "SELECT * FROM pcpart WHERE id = '$productID'";
    $getProductData = mysqli_query($conn, $querygetProduct);
    $productData = mysqli_fetch_assoc($getProductData);
    $productType = "PCP";
}

?>

<body>
<script
    src='https://www.paypal.com/sdk/js?client-id=AQ4hQhEivZvuuZanNqIzkb23shsqzDUcwUMPb4hRvNkf9RAlWdpH0n-rbFxFw_hDV9ctv3OPxfOXAwoV&currency=MYR'> // Required. Replace YOUR_CLIENT_ID with your sandbox client ID.
</script>

<?php
    include("includes/header.php");?>
    
   
        <!--Content after here-->
        <div class="container">
            <div class="row">
                <div class="col-sm-7" class="img-magnifier-container">
                <img class="img-responsive" src="<?php echo 'data:image/jpg;base64,' . base64_encode($productData['image']) . ''?>" height="512px" width="512px" style="object-fit: contain;" alt="Card image cap" id="productIMG">
                </div>
                <div class="col-sm-5">

                    <h2></h2>
                    
                    <p style="font-size: 28px"><?php echo $productData['name'] ?></p>
                    <p style="font-size: 20px">RM <?php echo $productData['price'] ?></p>
                    <p style="font-size: 16px">Stock Left: <?php echo $productData['stock'] ?></p>
                    <p style="color: gray;">_________________________________________________________________</p>


                    <div class="row" style="padding-bottom: 2vh;">
                    <?php 
                        $querygetID = "SELECT id FROM member WHERE email = '$logonEmail'";
                        $getID = mysqli_query($conn,$querygetID);
                        $ID = mysqli_fetch_assoc($getID);
                        
                    if($productData['seller'] == $ID['id'] && $logonRole == "partner"){
                        echo "<div class='col-sm-12' style='margin-bottom:1vh'>
                        <input type='number' pattern='[0-9]+' required placeholder='e.g. 10' class='form-control' name='Productupdatestock' value='".$productData['stock']."' style='text-align:center'>
                            </div>
                        <div class='col-sm-12'>
                        <buttton class='btn btn-dark' style='width: 100%;'>Update Stock</buttton>
                         </div>";
                    }else{
                        echo "<div class='col-sm-12' style='margin-bottom:1vh'>
                        <input type='hidden' value='".$productData['id']."' id='currentProductID'>
                        <input type='hidden' value='".$productType."' id='currentProductType'>
                        <input type='number' pattern='[0-9]+' required value='1' class='form-control' id='ProductPurchasestock' name='ProductPurchasestock' style='text-align:center'>
                            </div>
                            <button type='button' onclick='tocheckout()' class='btn btn-dark' style='width:100%'>Buy Now</button>
                            
                         <div class='col-sm-12'>
                         
                    </div>";
                    } 
                    
                    ?>
                       
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
        
<script>
    paypal.Buttons({
        style: {
            layout: 'vertical',
            color: 'black',
            shape: 'rect',
            label: 'paypal'
        },createOrder: function(data, actions) {
      // Set up the transaction
      return actions.order.create({
        purchase_units: [{
          amount: {
            value: '300'
          }
        }]
      });
    }
        

    }).render('#paypal-button-container');



</script>
   
</body>

</html>