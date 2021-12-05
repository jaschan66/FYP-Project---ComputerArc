<?php
$month = date('m');
$Displaymonth = date('F');
$year = date('Y');
$searchAllAdvertisement = "SELECT * FROM advertisement_payment WHERE MONTH(paymentDate) = '$month'";

$resultAdvertisement = mysqli_query($conn, $searchAllAdvertisement);

$rowNo = 1;

$totalCommission = 0;

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
    <h3>ComputerArc - <?php echo $Displaymonth ?> of <?php echo $year ?> Advertisement Sales Report</h3>
    <table class="table table-hover ">
        <thead>
            <tr>
                <th>No.</th>
                <th>ID</th>
                <th>Amount</th>
                <th>Payment Date</th>
                <th>Advert Duration</th>
            </tr>
        </thead>
        <tbody>

            <?php
            while ($rowPayment = mysqli_fetch_array($resultAdvertisement)) {
                $searchAllCommission = "SELECT * FROM advertisement WHERE id = '" . $rowPayment['advertisementID'] . "'";
                $resultCommission = mysqli_query($conn, $searchAllCommission);
                $row = mysqli_fetch_array($resultCommission);

                $start_date = new DateTime($row["start_date"]);
                $end_date = new DateTime($row["end_date"]);

                $days_diff = $start_date->diff($end_date)->format("%a");
                // print_r($row);
                // die();
            ?>
                <tr id=" <?php echo $row["id"] ?>">
                    <td><?php echo $rowNo ?></td>
                    <td><?php echo $row["id"] ?></td>
                    <td><?php echo $rowPayment["amount"] ?></td>
                    <td><?php echo $rowPayment["paymentDate"] ?></td>
                    <td><?php echo $days_diff ?> Days</td>

                </tr>

            <?php
                $totalCommission += $rowPayment['amount'];
                $rowNo++;
            }
            ?>
        </tbody>
    </table>
    <hr>
    <p style="font-size: 20px">Total Commission Earned: <label style="text-align:right;font-size: 25px">RM<?php echo $totalCommission ?></label></p>

</div>
<button class="btn btn-dark" onclick="printReport()" style="width:100%">Print</button>