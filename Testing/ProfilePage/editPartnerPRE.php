<form style='font-family: Questrial; text-align: left' method='POST' enctype='multipart/form-data' id='createPRE'>
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
                            <input type='number' required placeholder='e.g. 10' class='form-control' name='PREstock'>
                        </div>

                        <div class='formspacing'>
                            <p class='formlabel'>Description</p>
                            <input type='text' placeholder='e.g. A strong pre-build pc that is able to run every game in the current market.' class='form-control' name='PREdesc'>
                        </div>

                        <div class='formspacing'>
                            <p class='formlabel'>Product Picture</p>
                            <input class='filepond' id='PREpic' name='PREpic' type='file'>
                        </div>

                        <input type='submit' name='btnSubmitCreatePRE' id='btnSubmitCreatePRE' class='btn btn-dark' style='font-size: 1vw; font-family: Questrial; width:100%; margin-bottom: 2vh;' value='Create'>
                    </form>

                    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
                    <script src="SweetAlert/sweetalert2.min.js"></script>

                    <script>
    $(document).ready(function() {
        $('#btnSubmitCreatePRE').click(function(event) {
            event.preventDefault();
            var form = $('#createPRE');
            var formData = new FormData(form[0]);

            Swal.fire ({
                title: 'Create Pre-build PC?',
                showCancelButton: true,
                confirmButtonText: 'Yes',
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        type: "POST",
                        url: "ProfilePage/PRE-add.php",
                        processData: false,
                        contentType: false,
                        data: formData,
                        success: function(x) {
                            var delay = 500;
                            console.log(x);
                            if (x == "Pre-Build PC created successfuly!") {
                                Swal.fire(x, '', 'success').then((result => {
                                    if (result.isConfirmed) {
                                        window.location = "profilePage.php?editAuc=0&editPRE=1&editProf=0&editPCP=0&salesO=0";
                                    } else {
                                        setTimeout(function() {
                                            window.location = "profilePage.php?editAuc=0&editPRE=1&editProf=0&editPCP=0&salesO=0";
                                        }, delay);
                                    }
                                }))

                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Something went wrong!',
                                    html: '<pre>' + x + '</pre>',
                                    customClass: {
                                        popup: 'format-pre'
                                    }
                                })
                            }
                        }
                    });
                }
            })
        });
    });
</script>