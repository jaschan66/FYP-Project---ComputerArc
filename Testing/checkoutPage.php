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




if($isPCP == "prebuildpc"){
    $querygetProduct = "SELECT * FROM prebuildpc WHERE id = '$productID'";
    $getProductData = mysqli_query($conn, $querygetProduct);
    $productData = mysqli_fetch_assoc($getProductData);
    $productType = "prebuildpc";
}
else if($isPCP == "pcpart"){
    $querygetProduct = "SELECT * FROM pcpart WHERE id = '$productID'";
    $getProductData = mysqli_query($conn, $querygetProduct);
    $productData = mysqli_fetch_assoc($getProductData);
    $productType = "pcpart";
}

?>

<body>
<script
    src='https://www.paypal.com/sdk/js?client-id=AQ4hQhEivZvuuZanNqIzkb23shsqzDUcwUMPb4hRvNkf9RAlWdpH0n-rbFxFw_hDV9ctv3OPxfOXAwoV&locale=en_GB&currency=MYR'> // Required. Replace YOUR_CLIENT_ID with your sandbox client ID.
</script>

<?php
    include("includes/header.php");?>
    
   
        <!--Content after here-->
        <div class="container">
            <div class="row" style="min-height:70vh;">
                <div class="col-lg-5" class="img-magnifier-container">
                <img class="img-responsive" src="<?php echo 'data:image/jpg;base64,' . base64_encode($productData['image']) . ''?>" height="440px" width="440px" style="object-fit: contain;" alt="Card image cap" id="productIMG">
                </div>
                <div class="col-lg-7">

                   
                    
                    <p style="font-size: 28px"><?php echo $productData['name'] ?></p>
                    
                    


                   
                        <div class='col-sm-12' style='margin-bottom:1vh;padding:0'>
                        <input type='hidden' value='<?php echo $productData['id'] ?>' id='productID'>
                        <input type='hidden' value='<?php echo $isPCP ?>' id='productType'>
                        <input type='number' pattern='[0-9]+'  required value='<?php echo $qty ?>' class='form-control' id='ProductPurchasestock' name='ProductPurchasestock' onchange="changeTotal(this)" style='text-align:center' min='1' max='3'>
                        <p style="font-size: 20px">Total(RM):  <label style="text-align:right;font-size: 25px" id='totalPrice'></label></p>
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
         $(document).ready(function() {
             changeTotal(document.getElementById("ProductPurchasestock"));
         })

         var producttype = document.getElementById("productType").value;
        var productid = document.getElementById("productID").value;
        var productQty = document.getElementById("ProductPurchasestock").value;

        </script>
        


<script>
    var total = 0;
function changeTotal(e){
        var qty = $(e).val();
        var unitPrice = <?= $productData['price'] ?>;
        // let unitPriceId = '#up_'.idIndex;
        // var unitPrice = $(unitPriceId).val();
        total = qty * unitPrice;

        $('#totalPrice').html(total.toFixed(2));
    }



</script>

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
            value: total
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
                        url: "processCheckout.php",
                        data: {
                        paymentDetail: details,
                        productType: producttype,
                        productID: productid,
                        productQty: productQty,
                    },
                        success: function(x) {
                            if (x == "Paid successfuly!") {
                                Swal.fire(x, '', 'success').then((result => {
                                    var delay = 500;
                                    if (result.isConfirmed) {
                                        window.location = "homePage.php";
                                    } else {
                                        setTimeout(function() {
                                            window.location = "homePage.php";
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