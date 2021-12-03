<?php
session_start();
?>

<?php
include "includes/dbh.inc.php";

$queryloadPartnerID = "SELECT id FROM partner WHERE email = '$email'";
$executePartnerID = mysqli_query($conn, $queryloadPartnerID);
$getPartnerID = mysqli_fetch_assoc($executePartnerID);
$partnerID = $getPartnerID['id'];
$queryloadPayment = "SELECT * FROM payment WHERE seller = '$partnerID' ORDER BY paymentDate DESC";
$executeloadPayment = mysqli_query($conn, $queryloadPayment);



?>



<div class="container-fluid" style="min-height: 70vh; margin-top:1vh; margin-bottom:2vh;">



    <button onclick="topFunction()" id="myBtn" title="Go to top"><i class='fas fa-angle-up' style='font-size:36px'></i></button>


    <div class="row">
        <?php
        while ($getPayment = mysqli_fetch_array($executeloadPayment)) {
            $productType = $getPayment['productType'];
            $productID = $getPayment['productID'];
            $queryGetProductData = "SELECT * FROM $productType WHERE id = '$productID'";
            $executeQueryProductData = mysqli_query($conn, $queryGetProductData);
            $ProductData = mysqli_fetch_assoc($executeQueryProductData);

        ?><div class="col-sm-12">
                <div class="card" style="width:100%; margin-bottom:1.5vh">
                    <img class="card-img-top" src="data:image/jpg;base64,<?php echo base64_encode($ProductData['image']) ?>" style="object-fit:contain; height:360px;" alt="Card image cap">
                    <div class="card-body">
                        <hr>

                        <h5 class="card-title"><?php echo $ProductData['name'] ?></h5>
                        <p class="card-text"><b>Total Amount:</b> RM<?php echo $getPayment['amount'] ?></p>
                        <p class="card-text"><small class="text-muted">Payment Made: <?php echo $getPayment['paymentDate'] ?></small></p>
                        <p class="card-text"><small class="text-muted">Sales ID: <?php echo $getPayment['id'] ?></small></p>
                    </div>
                    <?php
                    if ($getPayment['status'] == 1) {
                    ?>
                        <div class="card-footer text-center">

                        <p class="card-text">Waiting to ship</p>
                            <input type="hidden" class="statusUpd" value="<?php echo $getPayment['id'] ?>" id="paymentID_<?php echo $getPayment['id'] ?>">
                            <button class="btn btn-primary" value="2" onclick="receiveOrder(this)" >Shipped out</button>

                        </div>
                    <?php
                    } else if ($getPayment['status'] == 2) {
                    ?>
                        <div class="card-footer text-center statusUp">
                        <p class="card-text">Shipping in progress</p>

                        </div>

                    <?php
                    } else if ($getPayment['status'] == 3) {
                    ?>
                        <div class="card-footer text-center">

                            <p class="card-text">Completed</p>

                        </div>
                    <?php
                    }
                    ?>

                </div>
            </div>
        <?php
        }
        ?>
    </div>













</div>

<!--footer-->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



<script>
    function receiveOrder(e) {
        
        var statusUpdate = $(e).val();
        
        var paymentID = $(e).closest('div').find('.statusUpd').val();

        $.ajax({
            type: "POST",
            url: "payment/updatePaymentStatus.php",
            data: {
                updateStatus: statusUpdate,
                paymentId: paymentID
            },
            success: function(result) {
                var delay = 500
                if (result == "Status updated successfully") {
                    window.location.reload();
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



<script>
    //Get the button
    var mybutton = document.getElementById("myBtn");


    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function() {
        scrollFunction()
    };

    function scrollFunction() {
        if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
    }

    // When the user clicks on the button, scroll to the top of the document
    function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }
</script>


</html>