<?php

$searchAllRaffle = "SELECT * FROM raffle ORDER BY status ASC";


$resultRaffle = mysqli_query($conn, $searchAllRaffle);

$rowNo = 1;

$status= "";

$winner = "";

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
    <h3>ComputerArc - Raffle Report</h3>
    <table class="table table-hover ">
        <thead>
            <tr>
                <th>No.</th>
                <th>ID</th>
                <th>Name</th>
                <th>Max Participant</th>
                <th>Current Participant</th>
                <th>End Date</th>
                <th>Winner</th>
                <th>Status</th>


            </tr>
        </thead>
        <tbody>

            <?php
            while ($row = mysqli_fetch_array($resultRaffle)) {
                if($row['status'] == 2){
                    $status = "concluded";
                }
                else if($row['status'] == 1){
                    $status = "on-going";
                }

                if($row['winner'] != null){
                    $winnerID = $row['winner'];
                        $queryGetmember = "SELECT * FROM member WHERE id = '$winnerID'";
                        $executeGetMember = mysqli_query($conn,$queryGetmember);
                        $memberData = mysqli_fetch_assoc($executeGetMember);
                        $winnerName = $memberData['name'];
                }else{
                    $winnerName = "-";
                }
                
            ?>
                <tr id=" <?php echo $row["id"] ?>">
                    <td><?php echo $rowNo ?></td>
                    <td><?php echo $row["id"] ?></td>
                    <td><?php echo $row["name"] ?></td>
                    <td><?php echo $row["participant_num"] ?></td>
                    <td><?php echo $row["currentParticipant"] ?></td>
                    <td><?php echo $row["end_date"] ?></td>
                    <td><?php echo $winnerName ?></td>
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
    

    