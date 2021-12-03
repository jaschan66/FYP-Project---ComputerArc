<?php
$month = date('m');
$searchAllSales = "SELECT * FROM payment WHERE MONTH(paymentDate) = '$month' AND status=3";


$resultSales = mysqli_query($conn, $searchAllSales);

$rowNo = 1;

$totalSales = 0;

?>
    
    <script>
        function printReport() {
            var divContents = document.getElementById("reportContent").innerHTML;
            var a = window.open('', '', 'height=1024, width=1024');
            a.document.write('<html>');
            a.document.write(' <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">');
            a.document.write('<body >');
            a.document.write(divContents);
            a.document.write('</body></html>');
            a.document.close();
            a.print();
        }
        </script>

<div class="table-responsive" id="reportContent" style="text-align:center">
    <h3>ComputerArc - Monthly Sales Report</h3>
    <table class="table table-hover ">
        <thead>
            <tr>
                <th>No.</th>
                <th>ID</th>
                <th>Amount</th>
                <th>Date</th>
                <th>Product Name</th>
                <th>Quantity</th>


            </tr>
        </thead>
        <tbody>

            <?php
            while ($row = mysqli_fetch_array($resultSales)) {
                $producttype = $row['productType'];
                $productId = $row['productID'];
                $querygetproductdata = "SELECT * FROM $producttype WHERE id = '$productId'";
                $executeProductData = mysqli_query($conn,$querygetproductdata);
                $productData = mysqli_fetch_assoc($executeProductData);
            ?>
                <tr id=" <?php echo $row["id"] ?>">
                    <td><?php echo $rowNo ?></td>
                    <td><?php echo $row["id"] ?></td>
                    <td><?php echo $row["amount"] ?></td>
                    <td><?php echo $row["paymentDate"] ?></td>
                    <td><?php echo $productData['name'] ?></td>
                    <td><?php echo $row["productQty"] ?></td>


                </tr>

            <?php
                $totalSales += $row['amount'];
                $rowNo++;
            }
            ?>
        </tbody>
    </table>
    <hr>
    <p style="font-size: 20px">Total Sales Gained: <label style="text-align:right;font-size: 25px">RM<?php echo $totalSales ?></label></p>
   
</div>
 <button class="btn btn-dark" onclick="printReport()" style="width:100%">Print</button>
    

    