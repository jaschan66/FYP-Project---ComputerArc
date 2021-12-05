<?php
$month = date('m');
$Displaymonth = date('F');
$year = date('Y');

$searchAllPCP = "SELECT * FROM pcpart WHERE status = 1";
$searchAllPRE = "SELECT * FROM prebuildpc WHERE status = 1";


$resultPCP = mysqli_query($conn, $searchAllPCP);
$resultPRE = mysqli_query($conn, $searchAllPRE);

$rowNo = 1;

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
    <h3>ComputerArc - <?php echo $Displaymonth ?> of <?php echo $year ?> Inventory Report</h3>
    <table class="table table-hover ">
        <thead>
            <tr>
                <th>No.</th>
                <th>ID</th>
                <th>Price</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Seller Name</th>

            </tr>
        </thead>
        <tbody>

            <?php
            while ($row = mysqli_fetch_array($resultPCP)) {
                $sellerID = $row['seller'];
                $queryGetSeller   = "SELECT * FROM partner WHERE id = '$sellerID'";
                $executeGetSeller = mysqli_query($conn, $queryGetSeller);
                $sellerData = mysqli_fetch_assoc($executeGetSeller);
                $sellerName = $sellerData['name'];
            ?>
                <tr id=" <?php echo $row["id"] ?>">
                    <td><?php echo $rowNo ?></td>
                    <td><?php echo $row["id"] ?></td>
                    <td><?php echo $row["price"] ?></td>
                    <td><?php echo $row['name'] ?></td>
                    <td><?php echo $row["stock"] ?></td>
                    <td><?php echo $sellerName ?></td>
                </tr>

            <?php
                $rowNo++;
            }
            ?>

            <?php
            while ($row = mysqli_fetch_array($resultPRE)) {
                $sellerID = $row['seller'];
                $queryGetSeller   = "SELECT * FROM partner WHERE id = '$sellerID'";
                $executeGetSeller = mysqli_query($conn, $queryGetSeller);
                $sellerData = mysqli_fetch_assoc($executeGetSeller);
                $sellerName = $sellerData['name'];
            ?>
                <tr id=" <?php echo $row["id"] ?>">
                    <td><?php echo $rowNo ?></td>
                    <td><?php echo $row["id"] ?></td>
                    <td><?php echo $row["price"] ?></td>
                    <td><?php echo $row['name'] ?></td>
                    <td><?php echo $row["stock"] ?></td>
                    <td><?php echo $sellerName ?></td>
                </tr>

            <?php
                $rowNo++;
            }
            ?>
        </tbody>
    </table>

</div>
<button class="btn btn-dark" onclick="printReport()" style="width:100%">Print</button>