<?php
$month = date('m');
$searchAllCommission = "SELECT * FROM commission WHERE MONTH(date) = '$month'";


$resultCommission = mysqli_query($conn, $searchAllCommission);

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
    <h3>ComputerArc - Monthly Commission Report</h3>
    <table class="table table-hover ">
        <thead>
            <tr>
                <th>No.</th>
                <th>ID</th>
                <th>Amount</th>
                <th>Date</th>
                <th>Commission Rate</th>
                <th>Ref.Payment ID</th>


            </tr>
        </thead>
        <tbody>

            <?php
            while ($row = mysqli_fetch_array($resultCommission)) {
            ?>
                <tr id=" <?php echo $row["id"] ?>">
                    <td><?php echo $rowNo ?></td>
                    <td><?php echo $row["id"] ?></td>
                    <td><?php echo $row["amount"] ?></td>
                    <td><?php echo $row["date"] ?></td>
                    <td><?php echo $row["rate"] ?></td>
                    <td><?php echo $row["referpay"] ?></td>


                </tr>

            <?php
                $totalCommission += $row['amount'];
                $rowNo++;
            }
            ?>
        </tbody>
    </table>
    <hr>
    <p style="font-size: 20px">Total Commission Earned: <label style="text-align:right;font-size: 25px">RM<?php echo $totalCommission ?></label></p>
   
</div>
 <button class="btn btn-dark" onclick="printReport()" style="width:100%">Print</button>
    

    