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
        <p class='formlabel'>Clock speed (GHz)</p>
        <input class='form-control' id='PCPMOBOmemoryspeed' name='PCPMOBOmemoryspeed' type='text' placeholder='e.g. 3.5'>
    </div>

    <div class='formspacing'>
        <p class='formlabel'>Wattage (watt)</p>
        <input class='form-control' id='PCPPSUwattage' name='PCPPSUwattage' type='text'  placeholder='e.g. 650' pattern="[0-9]+">
    </div>


    <input type='submit' name='btnSubmitCreateGPU' class='btn btn-dark' style='font-size: 1vw; font-family: Questrial; width:100%; margin-bottom: 2vh;' value='Create'>

</form>