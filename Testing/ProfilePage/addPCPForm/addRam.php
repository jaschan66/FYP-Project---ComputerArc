<form style='font-family: Questrial; text-align: left' method='POST' enctype='multipart/form-data'>
    <div class='formspacing'>
        <p class='formlabel'>Name</p>
        <input type='text' class='form-control' id='PCPname' placeholder='PC Part Name' name='PCPname'>
    </div>

    <div class='formspacing'>
        <p class='formlabel'>Price</p>
        <input type='text' pattern='^\d+(\.|\,)\d{2}$' required placeholder='e.g. 999.99' class='form-control' name='PCPprice'>
    </div>


    <div class='formspacing'>
        <p class='formlabel'>Stock Quantity</p>
        <input type='text' pattern="[0-9]+" required placeholder='e.g. 10' class='form-control' name='PCPstock'>
    </div>

    <div class='formspacing'>
        <p class='formlabel'>Description</p>
        <input type='text' placeholder='e.g. A strong pre-build pc that is able to run every game in the current market.' class='form-control' name='PCPdesc'>
    </div>

    <div class='formspacing'>
        <p class='formlabel'>Product Picture</p>
        <input class='filepond' id='PCPpic' name='PCPpic' type='file'>
    </div>
    
    <div class='formspacing'>
        <p class='formlabel'>Memory speed (MHz)</p>
        <input class='form-control' id='PCPRAMmemoryspeed' name='PCPRAMmemoryspeed' type='text'  placeholder='2444'>
    </div>

    <div class='formspacing'>
        <p class='formlabel'>Memory size</p>
        <input class='form-control' id='PCPRAMmemorysize' name='PCPRAMmemorysize' type='text'  placeholder='1X16GB'>
    </div>

    <div class='formspacing'>
        <p class='formlabel'>DDR generation</p>
        <input class='form-control' id='PCPRAMddrgeneration' name='PCPRAMddrgeneration' type='text' placeholder='DDR4'>
    </div>

    <div class='formspacing'>
        <p class='formlabel'>Voltage (V)</p>
        <input class='form-control' id='PCPRAMvoltage' name='PCPRAMvoltage' type='text' pattern="[0-9]+" placeholder='1.2'>
    </div>



    <input type='submit' name='btnSubmitCreateRAM' class='btn btn-dark' style='font-size: 1vw; font-family: Questrial; width:100%; margin-bottom: 2vh;' value='Create'>
</form>