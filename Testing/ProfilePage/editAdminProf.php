<form style='font-family: Questrial; text-align: left' method='POST' enctype='multipart/form-data'>
    <div class='formspacing'>
        <p class='formlabel'>Descripiton</p>
        <input type='text' class='form-control' id='description' placeholder='A short description of yourself' name='description' value='<?php echo $name['description'] ?>'>
    </div>

    <div class='formspacing'>
        <p class='formlabel'>Two-Factor Authentication Status</p>
        <select class="form-control" id="twoFAStatus" name="twoFAStatus">
            <?php if ($name['twoFAStatus'] == "0") {
                $s1 = "selected";
                $s2  = "";
            } else {
                $s1  = "";
                $s2  = "selected";
            }
            ?>
            <option <?php echo $s1 ?> value="0">Disable</option>
            <option <?php echo $s2 ?> value="1">Enable</option>
        </select>
    </div>

    <input type='submit' name='btnEditAdminProf' class='btn btn-dark' style='font-size: 1vw; font-family: Questrial; width:100%; margin-bottom: 2vh;' value='Edit'>
</form>
