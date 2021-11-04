<form style='font-family: Questrial; text-align: left' method='POST' enctype='multipart/form-data'>
                        <div class='formspacing'>
                            <p class='formlabel'>Name</p>
                            <input type='text' class='form-control' id='PREname' placeholder='Alienware G10' name='PREname'>
                        </div>

                        <div class='formspacing'>
                            <p class='formlabel'>Price</p>
                            <input type='text' pattern='^\d+(\.|\,)\d{2}$' required placeholder='e.g. 999.99' class='form-control' name='PREprice'>
                        </div>

                        <div class='formspacing'>
                            <p class='formlabel'>Category</p>
                            <select class="form-control" id="PREcategory" name="PREcategory">
                                <option selected>Gaming</option>
                                <option>Office-Used</option>
                                <option>Streaming</option>
                                <option>Graphic Designing</option>
                            </select>
                        </div>

                        <div class='formspacing'>
                            <p class='formlabel'>Stock Quantity</p>
                            <input type='text' pattern="[0-9]+" required placeholder='e.g. 10' class='form-control' name='PREstock'>
                        </div>

                        <div class='formspacing'>
                            <p class='formlabel'>Description</p>
                            <input type='text' placeholder='e.g. A strong pre-build pc that is able to run every game in the current market.' class='form-control' name='PREdesc'>
                        </div>

                        <div class='formspacing'>
                            <p class='formlabel'>Product Picture</p>
                            <input class='filepond' id='PREpic' name='PREpic' type='file'>
                        </div>

                        <input type='submit' name='btnSubmitCreatePRE' class='btn btn-dark' style='font-size: 1vw; font-family: Questrial; width:100%; margin-bottom: 2vh;' value='Create'>
                    </form>