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
        <p class='formlabel'>Cooler type</p>
        <select class="form-control" id="PCPCoolertype" name="PCPCoolertype" style="margin-bottom:2vh">
                <option selected value="aircooler">Air Cooler</option>
                <option value="aiocooler">AIO Cooler</option>
            </select>
    </div>

    <div class='formspacing'>
        <p class='formlabel'>Supported socket&nbsp; <a href="#" data-toggle="tooltip" title="If multiple socket is supported, just add comma sign behind the consecutive type (no spacing)"><i class='fas fa-question-circle'></i></a></p>
        <input class='form-control' id='PCPCoolersupportedsocket' name='PCPCoolersupportedsocket' type='text' placeholder="e.g. LGA1151,LGA1150,LGA1366...">
    </div>

    <input type='submit' name='btnSubmitCreateCooler' class='btn btn-dark' style='font-size: 1vw; font-family: Questrial; width:100%; margin-bottom: 2vh;' value='Create'>
</form>