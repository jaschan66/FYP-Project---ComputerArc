<!DOCTYPE html>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta charset=" utf-8" />

<head>
    <title>ComputerArc - Member Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <link rel="icon" href="Logo stuff\favicon-32x32.png" type="image/x-icon">
    <link href='https://fonts.googleapis.com/css?family=Questrial' rel='stylesheet'>

    <link href='filepond/filepond.min.css' rel='stylesheet'>
    <link href='filepond/plugins/preview/filepond-plugin-image-preview.min.css' rel='stylesheet'>
    <link href='SweetAlert/sweetalert2.min.css' rel='stylesheet'>

    <script src="https://www.google.com/recaptcha/api.js?render=6LcrZPEcAAAAAOD-gL2ox-rjslwDMlTfFn8xarIM"></script>

    <style>
        body {
            overflow-x: hidden;
            overflow-y: auto;
        }


        .formLabel {
            font-size: 1vw;
        }

        ::-webkit-scrollbar {

            width: 0.8vw;
            border-style: solid;
            border-color: #000000;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 1);
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: rgba(161, 161, 161, 0.5);
            border-radius: 10px;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: rgba(0, 0, 0, 1);

        }

        html,
        body {
            height: 100%;
        }

        .row {
            margin: 0;
            /*padding:0;*/
        }
    </style>

    <?php

    
         
    ?>
</head>

<body style="min-height:100vh">
    <div class="container-fluid" style="padding:0;min-height:100vh ">
        <div class="row">
            <div class="col-6 " style="min-height:100vh; background-image: linear-gradient(to right, #1f2428 80%, #2c3037 )">
                <div class="row">
                    <div class="col-2">

                    </div>
                    <div class="col-8">
                        <form style="margin-top: 15vh" class="form-group" method="POST" enctype="multipart/form-data" id="signupMember">
                            <input type="hidden" id="g-token" name="g-toekn" />

                            <p style="color: #b5b0aa; font-family: 'Questrial'; padding-right: 6vw;" class="formLabel">E-mail &nbsp;<a href="#" data-toggle="tooltip" title="The email is used for sign-in and other purpose such as 2FA on our website"><i class='fas fa-question-circle'></i></a></p>
                            <input class="form-control" id="memberemail" name="memberemail" type="text" style="margin-bottom: 3vh;background-image: linear-gradient(to right, #2c3037, #1f2428); color: white;" required placeholder="e.g. Nicky@gmail.com">

                            <p style="color: #b5b0aa; font-family: 'Questrial'; padding-right: 6vw;" class="formLabel">Password &nbsp;<a href="#" data-toggle="tooltip" title="Password must be at least 6 characters long"><i class='fas fa-question-circle'></i></a></p>
                            <input class="form-control" id="memberpassword" name="memberpassword" type="password" style="margin-bottom: 5vh; background-image: linear-gradient(to right, #2c3037, #1f2428); color: white;" required placeholder="e.g. abc123">

                            <p style="color: #b5b0aa; font-family: 'Questrial'; padding-right: 6vw;" class="formLabel">Username &nbsp;<a href="#" data-toggle="tooltip" title="The username assigned is used to display on our page"><i class='fas fa-question-circle'></i></a></p>
                            <input class="form-control" id="memberusername" name="memberusername" type="text" style="margin-bottom: 3vh;background-image: linear-gradient(to right, #2c3037, #1f2428); color: white;" required placeholder="e.g. Nicky">

                            <p style="color: #b5b0aa; font-family: 'Questrial'; padding-right: 6vw;" class="formLabel">Tel No.&nbsp;<a href="#" data-toggle="tooltip" title="The tel no. is used for our partner to contact you (just in case)"><i class='fas fa-question-circle'></i></a></p>
                            <input class="form-control" id="membertelno" name="membertelno" type="text" style="margin-bottom: 3vh;background-image: linear-gradient(to right, #2c3037, #1f2428); color: white;" pattern="[0-9]{10}" required placeholder="e.g. 0123456789">

                            <p style="color: #b5b0aa; font-family: 'Questrial'; padding-right: 6vw;" class="formLabel">Profile Picture</p>
                            <input class="filepond" id="memberprofilepic" name="memberprofilepic" type="file">

                            <div class="row">
                                <div class="col-8">
                                    <input type="submit" name="btnSubmit" id="btnSubmit" class="btn btn-primary" style="font-size: 0.75vw; font-family: 'Questrial'; width:100%; margin-bottom: 2vh;" value="Sign Up">
                                </div>
                                <div class="col-4">
                                    <a href="chooseSignUp.php" class="btn btn-dark" style="font-size: 0.75vw; font-family: 'Questrial'; width: 100%;  margin-bottom: 2vh;">Back</a>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="col-2">

                    </div>
                </div>

            </div>
            <div class="col-6" style="min-height:100vh; background-image: linear-gradient(to left ,#1f2428 80%,#2c3037);">
                <div class="row">
                    <div class="col-3">

                    </div>
                    <div class="col-6" style="text-align: center; margin-top: 30vh;">
                        <p style="color:#b5b0aa; font-family: 'Questrial'; margin-bottom: 5vh; text-align: center; font-size: 2.5vw;">
                            Signing up as</p>
                        <p style="color:#ffffff; font-family: 'Questrial'; margin-bottom: 5vh; text-align: center; font-size: 4vw;">
                            Member</p>
                    </div>
                    <div class="col-3">

                    </div>
                </div>

            </div>
        </div>
    </div>






    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>





  
    <script src="filepond/filepond.min.js"></script>
    <script src="filepond/filepond.jquery.js"></script>
    <script src="filepond/plugins/preview/filepond-plugin-image-preview.min.js"></script>

</body>

<script>
    $(document).ready(function() {
        FilePond.registerPlugin(FilePondPluginImagePreview);
        const inputElement = document.querySelector('#memberprofilepic');

        const pond = FilePond.create(inputElement, {
            storeAsFile: true
        });

        
    });
</script>

<script>
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>




<script>
    grecaptcha.ready(function() {
        grecaptcha.execute('6LcrZPEcAAAAAOD-gL2ox-rjslwDMlTfFn8xarIM', {
            action: 'homepage'
        }).then(function(token) {
            document.getElementById("g-token").value = token;
        });
    });
</script>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="SweetAlert/sweetalert2.min.js"></script>

    <script>
    
        $('#btnSubmit').click(function(event) {
            event.preventDefault();
            var form = $('#signupMember');
            var formData = new FormData(form[0]);

            Swal.fire ({
                title: 'Confirm Sign Up?',
                showCancelButton: true,
                confirmButtonText: 'Yes',
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        type: "POST",
                        url: "processMemberSignUp.php",
                        processData: false,
                        contentType: false,
                        data: formData,
                        success: function(x) {
                            var delay = 500;
                            console.log(x);
                            if (x == "Sign Up Successfully!") {
                                Swal.fire(x, '', 'success').then((result => {
                                    if (result.isConfirmed) {
                                        window.location = "loginPage.php";
                                    } else {
                                        setTimeout(function() {
                                            window.location = "loginPage.php";
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
  
</script>

</html>