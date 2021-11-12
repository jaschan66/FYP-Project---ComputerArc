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
        <p class='formlabel'>Storage type</p>
        <select class="form-control" id="PCPStoragetype" name="PCPStoragetype" style="margin-bottom:2vh">
                <option selected value="HDD500GB5400RPM">HDD(5400RPM) - 500GB</option>
                <option value="HDD1TB5400RPM">HDD(5400RPM) - 1TB</option>
                <option value="HDD2TB5400RPM">HDD(5400RPM) - 2TB</option>
                <option value="HDD3TB5400RPM">HDD(5400RPM) - 3TB</option>
                <option value="HDD4TB5400RPM">HDD(5400RPM) - 4TB</option>
                <option value="HDD5TB5400RPM">HDD(5400RPM) - 5TB</option>
                <option value="HDD6TB5400RPM">HDD(5400RPM) - 6TB</option>
                <option value="HDD8TB5400RPM">HDD(5400RPM) - 8TB</option>
                <option value="HDD500GB7200RPM">HDD(7200RPM) - 500GB</option>
                <option value="HDD1TB7200RPM">HDD(7200RPM) - 1TB</option>
                <option value="HDD2TB7200RPM">HDD(7200RPM) - 2TB</option>
                <option value="HDD3TB7200RPM">HDD(7200RPM) - 3TB</option>
                <option value="HDD4TB7200RPM">HDD(7200RPM) - 4TB</option>
                <option value="HDD5TB7200RPM">HDD(7200RPM) - 5TB</option>
                <option value="HDD6TB7200RPM">HDD(7200RPM) - 6TB</option>
                <option value="HDD8TB7200RPM">HDD(7200RPM) - 8TB</option>
                <option value="SATA128GB">SATA - 128GB</option>
                <option value="SATA256GB">SATA - 256GB</option>
                <option value="SATA512GB">SATA - 512GB</option>
                <option value="SATA1TB">SATA - 1TB</option>
                <option value="SATA2TB">SATA - 2TB</option>
                <option value="M.2128GB">M.2 - 128GB</option>
                <option value="M.2256GB">M.2 - 256GB</option>
                <option value="M.2512GB">M.2 - 512GB</option>
                <option value="M.21TB">M.2 - 1TB</option>
                <option value="M.22TB">M.2 - 2TB</option>
            </select>
    </div>


    <input type='submit' name='btnSubmitCreateStorage' class='btn btn-dark' style='font-size: 1vw; font-family: Questrial; width:100%; margin-bottom: 2vh;' value='Create'>

</form>