<form style='font-family: Questrial; text-align: left' method='POST' enctype='multipart/form-data'>
    <div class='formspacing'>
        <p class='formlabel'>Descripiton</p>
        <input type='text' class='form-control' id='description' placeholder='A short description of yourself' autofocus name='description' value='<?php echo $name['description'] ?>'>
    </div>

    <div class='formspacing'>
        <p class='formlabel'>Tel No</p>
        <input type='text' pattern='[0-9]{10}' required placeholder='e.g. 0123456789' class='form-control' name='telNo' value='<?php echo $name['telNo'] ?>'>
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

     <div class='formspacing'>
        <p class='formlabel'>Change Profile Picture&nbsp;<a href='#' data-toggle='tooltip' title='Your existing profile picture will be used if no picture is uploaded' style='font-size:1.2vw'><i class='fas fa-question-circle'></i></a></p>
        <input class='filepond' id='profilepic' name='profilepic' type='file'>
     </div>

    <input type='submit' name='btnEditMemProf' class='btn btn-dark' style='font-size: 1vw; font-family: Questrial; width:100%; margin-bottom: 2vh;' value='Edit'>
</form>
