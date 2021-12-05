<?php
$month = date('m');
$Displaymonth = date('F');
$year = date('Y');

$searchAllAuction = "SELECT * FROM auction WHERE status = 1 OR status = 3 OR status = 4 ORDER BY status DESC";

$resultAuction = mysqli_query($conn, $searchAllAuction);

$rowNo = 1;

$highestBid = 0.0;

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
    <h3>ComputerArc - <?php echo $Displaymonth ?> of <?php echo $year ?> Auction Report</h3>
    <table class="table table-hover ">
        <thead>
            <tr>
                <th>No.</th>
                <th>ID</th>
                <th>Name</th>
                <th>End Date</th>
                <th>Winner</th>
                <th>Highest Bid</th>
                <th>Status</th>

            </tr>
        </thead>
        <tbody>

            <?php
            while ($row = mysqli_fetch_array($resultAuction)) {
                if ($row['status'] == 4) {
                    $status = "concluded";
                } else if ($row['status'] == 3) {
                    $status = "on-going";
                } else if ($row['status'] == 1) {
                    $status = "haven't start";
                }

                if ($row['winner'] != null) {
                    $winnerID = $row['winner'];
                    $queryGetmember = "SELECT * FROM member WHERE id = '$winnerID'";
                    $executeGetMember = mysqli_query($conn, $queryGetmember);
                    $memberData = mysqli_fetch_assoc($executeGetMember);
                    $winnerName = $memberData['name'];

                    $getWinnerData = "SELECT * FROM auction_detail auc INNER JOIN member mem ON auc.participant_id = mem.id 
                    WHERE auc.auctionID = '".$row["id"]."' ORDER BY auc.amount_bid DESC LIMIT 1";
                    $conngetWinnerData  = mysqli_query($conn, $getWinnerData);
                    $winnerData         = mysqli_fetch_array($conngetWinnerData);
                    $highestBid = $winnerData["amount_bid"];
                } else {
                    $winnerName = "-";
                }

            ?>
                <tr id=" <?php echo $row["id"] ?>">
                    <td><?php echo $rowNo ?></td>
                    <td><?php echo $row["id"] ?></td>
                    <td><?php echo $row["title"] ?></td>
                    <td><?php echo $row["end_date"] ?></td>
                    <td><?php echo $winnerName ?></td>
                    <td><?php echo $highestBid ?></td>
                    <td><?php echo $status ?></td>


                </tr>

            <?php
                $rowNo++;
            }
            ?>
        </tbody>
    </table>
    <hr>


</div>
<button class="btn btn-dark" onclick="printReport()" style="width:100%">Print</button>