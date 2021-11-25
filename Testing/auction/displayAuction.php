<?php
if ($row["status"] == 0) {
    $aucstatus = "<td>Pending approval</td>";
    $auctionBtn = '<td></td><td></td>';
} else if ($row["status"] == 1) {
    $aucstatus = "<td>Approved</td>";
    $auctionBtn = '<td><a href="auctionDetailPage.php?idRetrieve=' . $row["id"] . '" class="btn btn-dark" >View</a></td>
            <td><a href="profilePage.php?editAuc=3&editPRE=0&editProf=0&editPCP=0&idUpdate=' . $row["id"] . '" class="btn btn-primary" >Update</a></td>
            <td><button type="button" class="btn btn-danger" onclick="deleteAuction(this)" id="' . $row["id"] . '">Delete</button></td>';
} else if ($row["status"] == 2) {
    $aucstatus = "<td>Rejected</td>";
    $auctionBtn = '<td><a href="profilePage.php?editAuc=3&editPRE=0&editProf=0&editPCP=0&idUpdate=' . $row["id"] . '" class="btn btn-primary" >Update</a></td>
            <td><button type="button" class="btn btn-danger" onclick="deleteAuction(this)" id="' . $row["id"] . '">Delete</button></td>';
} else if ($row["status"] == 3) {
    $aucstatus = "<td>Auction Started</td>";
    $auctionBtn = '<td><a href="auctionDetailPage.php?idRetrieve=' . $row["id"] . '" class="btn btn-dark" >View</a></td>
            <td></td><td></td>';
} else if ($row["status"] == 4) {
    $aucstatus = "<td>Auction Ended</td>";
    $auctionBtn = '<td><a href="auctionDetailPage.php?idRetrieve=' . $row["id"] . '" class="btn btn-dark" >View</a></td>
            <td></td><td></td>';
}

$table .= '<a href="auctionDetailPage.php?idRetrieve=' . $row["id"] . '">
<tr id="' . $row["id"] . '">  
<td>' . $rowNo . '</td>
<td>' . $row["id"] . '</td>
<td><img src="data:image/jpg;base64,' . base64_encode($row['image']) . '" height="180px" width="180px" alt="Auction Image" class="img-thumbnail img-responsive"/></td>
<td id="auctionTitle">' . $row["title"] . '</td>
<td>RM ' . number_format($row["starting_bid"], 2) . '</td>
<td>' . date("j/n/Y", strtotime($row["start_date"])) . '</td>
<td>' . date("j/n/Y", strtotime($row["end_date"])) . '</td>
' . $aucstatus . '   
' . $auctionBtn . '
</tr>
</a>';
$rowNo++;
