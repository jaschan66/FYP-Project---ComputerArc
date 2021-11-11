<?php include "includes/auction-upload.inc.php"; ?>

<form style='font-family: Questrial; text-align: left' method='POST' enctype='multipart/form-data'>
    <div class='formspacing'>
        <p class='formlabel'>Auction Title</p>
        <input type='text' class='form-control' id='aucTitle' required placeholder='Auction Title...' name='aucTitle'>
    </div>

    <div class='formspacing'>
        <p class='formlabel'>Starting Bid</p>
        <input type='text' pattern='^\d+(\.|\,)\d{2}$' required placeholder='e.g. 999.99' class='form-control' name='bidPrice'>
    </div>

    <div class='formspacing'>
        <p class='formlabel'>Start Date</p>
        <input type="date" placeholder="21/10/2021" required class="form-control" name="startDate">
    </div>

    <div class='formspacing'>
        <p class='formlabel'>End Date</p>
        <input type="date" placeholder="21/10/2021" required class="form-control" name="endDate">
    </div>

    <div class='formspacing'>
        <p class='formlabel'>Product Picture</p>
        <input class='filepond' id='auctionImage' name='auctionImage' type='file'>
    </div>

    <input type='submit' name='btnCreateAuction' class='btn btn-dark' style='font-size: 1vw; font-family: Questrial; width:100%; margin-bottom: 2vh;' value='Create'>
</form>