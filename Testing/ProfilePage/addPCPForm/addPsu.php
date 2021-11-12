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
        <p class='formlabel'>Wattage (watt)</p>
        <input class='form-control' id='PCPPSUwattage' name='PCPPSUwattage' type='text'  placeholder='e.g. 650' pattern="[0-9]+">
    </div>

    <div class='formspacing'>
        <p class='formlabel'>Efficient Grade</p>
        <select class="form-control" id="PCPPSUefficientgrade" name="PCPPSUefficientgrade" style="margin-bottom:2vh">
                <option selected value="80+">80 Plus</option>
                <option value="80+bronze">80 Plus Bronze</option>
                <option value="80+silver">80 Plus Silver</option>
                <option value="80+gold">80 Plus Gold</option>
                <option value="80+platinum">80 Plus Platinum</option>
                <option value="80+titanium">80 Plus Titanium</option>
            </select>
    </div>

    <div class='formspacing'>
        <p class='formlabel'>Dimension (mm)&nbsp; <a href="#" data-toggle="tooltip" title="Add comma sign behind the consecutive dimension value for example: width,height,depth "><i class='fas fa-question-circle'></i></a></p>
        <input class='form-control' id='PCPPSUdimension' name='PCPPSUdimension' type='text' placeholder="e.g. 150,86,140">
    </div>

    <div class='formspacing'>
        <p class='formlabel'>Fan size (mm)</p>
        <input class='form-control' id='PCPRAMvoltage' name='PCPRAMvoltage' type='text' pattern="[0-9]+" placeholder='e.g. 120'>
    </div>



    <input type='submit' name='btnSubmitCreatePSU' class='btn btn-dark' style='font-size: 1vw; font-family: Questrial; width:100%; margin-bottom: 2vh;' value='Create'>
</form>