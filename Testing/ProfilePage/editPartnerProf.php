<?php echo "<form style='font-family: 'Questrial'; text-align: left' method='POST' enctype='multipart/form-data'>
                        <div class='formspacing'>
                            <p class='formlabel'>Descripiton</p>
                            <input type='text' class='form-control' id='description' placeholder='A short description of yourself' name='description' value='".$name['description']."'>
                        </div>

                        <div class='formspacing'>
                            <p class='formlabel'>Tel No</p>
                            <input type='text' pattern='[0-9]{10}' required placeholder='e.g. 0123456789' class='form-control' name='telNo' value='".$name['telNo']."'>
                        </div>

                        <div class='formspacing'>
                            <p class='formlabel'>Fax No</p>
                            <input type='text' pattern='[0-9]{10}' required placeholder='e.g. 0123456789' class='form-control' name='faxNo' value='".$name['faxNo']."'>
                        </div>

                        <div class='formspacing'>
                            <p class='formlabel'>Change Profile Picture&nbsp;<a href='#' data-toggle='tooltip' title='Your existing profile picture will be used if no picture is uploaded' style='font-size:1.2vw'><i class='fas fa-question-circle'></i></a></p>
                            <input class='filepond' id='profilepic' name='profilepic' type='file'>
                        </div>

                        <input type='submit' name='btnSubmitEditProf' class='btn btn-dark' style='font-size: 1vw; font-family: 'Questrial'; width:100%; margin-bottom: 2vh;' value='Edit'>
                    </form>";
                    ?>