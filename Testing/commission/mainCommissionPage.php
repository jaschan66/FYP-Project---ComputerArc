<?php
session_start();
?>

<?php
include "includes/dbh.inc.php";
if($_SESSION['role'] == "partner"){
$queryloadPartnerID = "SELECT id FROM partner WHERE email = '$email'";
$executePartnerID = mysqli_query($conn, $queryloadPartnerID);
$getPartnerID = mysqli_fetch_assoc($executePartnerID);
$partnerID = $getPartnerID['id'];
$queryloadPayment = "SELECT * FROM payment WHERE seller = '$partnerID' ORDER BY paymentDate DESC";
$executeloadPayment = mysqli_query($conn, $queryloadPayment);
$totalAmount = 0;

?>



<div class="container-fluid" style="min-height: 70vh; margin-top:1vh; margin-bottom:2vh;">



    <button onclick="topFunction()" id="myBtn" title="Go to top"><i class='fas fa-angle-up' style='font-size:36px'></i></button>


    <div class="row">
        <?php
        while ($getPayment = mysqli_fetch_array($executeloadPayment)) {
            $paymentID = $getPayment['id'];
            $querygetCommissionData = "SELECT * FROM commission WHERE referpay = '$paymentID'";
            $executeCommissionData = mysqli_query($conn,$querygetCommissionData);
            $getCommissionData = mysqli_fetch_assoc($executeCommissionData);
            $productType = $getPayment['productType'];
            $productID = $getPayment['productID'];
            $queryGetProductData = "SELECT * FROM $productType WHERE id = '$productID'";
            $executeQueryProductData = mysqli_query($conn, $queryGetProductData);
            $ProductData = mysqli_fetch_assoc($executeQueryProductData);
            $totalearn = $getPayment['amount'] - $getCommissionData['amount'];
            $totalAmount += $getCommissionData['amount'];

        ?><div class="col-sm-12">
          
                <div class="card" style="width:100%; margin-bottom:1.5vh">
                    <div class="card-body">

                        <h5 class="card-title"><?php echo $ProductData['name'] ?></h5>
                        <p class="card-text"><b>Transaction Amount:</b> RM<?php echo $getPayment['amount'] ?></p>
                        <p class="card-text"><b>Commission Taken:</b> RM<?php echo $getCommissionData['amount'] ?></p>
                        <p class="card-text"><b>Total Earn:</b> RM<?php echo $totalearn ?></p>
                        <p class="card-text"><small class="text-muted">Payment Made: <?php echo $getPayment['paymentDate'] ?></small></p>
                        <p class="card-text"><small class="text-muted">Reference Sales ID: <?php echo $getPayment['id'] ?></small></p>
                    </div>

                </div>
            </div>
        <?php
        }
        ?>
        <h4>Total Commission Earned: RM<?php echo $totalAmount ?></h4>
    </div>
    <?php
}else if ($_SESSION['role'] == "admin"){
$queryloadPayment = "SELECT * FROM payment ORDER BY paymentDate DESC";
$executeloadPayment = mysqli_query($conn, $queryloadPayment);
$totalAmount = 0;
     ?>
<div class="container-fluid" style="min-height: 70vh; margin-top:1vh; margin-bottom:2vh;">



<button onclick="topFunction()" id="myBtn" title="Go to top"><i class='fas fa-angle-up' style='font-size:36px'></i></button>


<div class="row">

    
    
    <?php
    while ($getPayment = mysqli_fetch_array($executeloadPayment)) {
        $paymentID = $getPayment['id'];
        $querygetCommissionData = "SELECT * FROM commission WHERE referpay = '$paymentID'";
        $executeCommissionData = mysqli_query($conn,$querygetCommissionData);
        $getCommissionData = mysqli_fetch_assoc($executeCommissionData);
        $productType = $getPayment['productType'];
        $productID = $getPayment['productID'];
        $queryGetProductData = "SELECT * FROM $productType WHERE id = '$productID'";
        $executeQueryProductData = mysqli_query($conn, $queryGetProductData);
        $ProductData = mysqli_fetch_assoc($executeQueryProductData);
        $totalearn = $getPayment['amount'] - $getCommissionData['amount'];
        $totalAmount += $getCommissionData['amount'];

    ?><div class="col-sm-12">
        
            <div class="card" style="width:100%; margin-bottom:1.5vh">
                <div class="card-body">
                
                    <h5 class="card-title"><?php echo $ProductData['name'] ?></h5>
                    <p class="card-text"><b>Transaction Amount:</b> RM<?php echo $getPayment['amount'] ?></p>
                    <p class="card-text"><b>Commission Taken:</b> RM<?php echo $getCommissionData['amount'] ?></p>
                    <p class="card-text"><b>Total Earn:</b> RM<?php echo $getPayment['amount'] - $getCommissionData['amount'] ?></p>
                    <p class="card-text"><small class="text-muted">Payment Made: <?php echo $getPayment['paymentDate'] ?></small></p>
                    <p class="card-text"><small class="text-muted">Reference Sales ID: <?php echo $getPayment['id'] ?></small></p>
                </div>

            </div>
        </div>
    <?php
    }
    ?>

    <h4>Total Commission Earned: RM<?php echo $totalAmount ?></h4>
</div>
<?php
}
?>

   












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