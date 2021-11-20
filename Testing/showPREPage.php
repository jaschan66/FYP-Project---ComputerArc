<?php
session_start();
?>
<!DOCTYPE html>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta charset="utf-8" />

<head>
    <title>ComputerArc - Profile Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <link rel="icon" href="Logo stuff\favicon-32x32.png" type="image/x-icon">
    <link href='https://fonts.googleapis.com/css?family=Questrial' rel='stylesheet'>

    <link href='filepond/filepond.min.css' rel='stylesheet'>
    <link href='filepond/plugins/preview/filepond-plugin-image-preview.min.css' rel='stylesheet'>
    <link href='SweetAlert/sweetalert2.min.css' rel='stylesheet'>
    <style>
        body {
            overflow-x: hidden;
            overflow-y: auto;
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

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }


        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: rgba(0, 0, 0, 1);

        }

        html,
        body {
            height: 100%;
        }


        a {
            color: #b5b0aa;
        }

        a:hover {
            color: #383735;
        }

        .row {
            margin: 0;
            /*padding:0;*/
        }

        .formlabel {
            color: #b5b0aa;
            font-size: 1.5vw;
        }

        .formspacing {
            padding-bottom: 2.5vh;
        }

        p {
            font-family: "Questrial";
        }

        a {
            font-family: "Questrial";
            font-size: larger;
        }

        h2 {
            font-family: "Questrial";
        }

        .nav-item::after {
            content: '';
            display: block;
            width: 0;
            height: 2px;
            background: #000000;
            transition: 0.2s;
        }

        .nav-item:hover::after {
            width: 100%;
        }

        #myBtn {
            display: none;
            position: fixed;
            bottom: 20px;
            right: 30px;
            z-index: 99;
            font-size: 18px;
            border: none;
            outline: none;
            background-color: #b5b0aa;
            color: white;
            cursor: pointer;
            padding: 15px;
            border-radius: 4px;
        }
    </style>

    <?php
    include "includes/dbh.inc.php";
    
    ?>
</head>

<body>

    <!--header-->
    <?php include "includes/header.php"; ?>

    <div class="container-fluid" style="min-height: 70vh; margin-top:1vh; margin-bottom:2vh;">
        <!--top of profile page-->
        

        <button onclick="topFunction()" id="myBtn" title="Go to top"><i class='fas fa-angle-up' style='font-size:36px'></i></button>

       
            <div class="col-2" style=" border-right-style: solid;">
                <!--Based on the role change the sidebar menu-->
                

            </div>

            <div class="col-10">
                <!--Based on side menu bar change its content-->
                <div class="col-1">

                </div>

                <div class="col-10">
                    


                </div>

                <div class="col-1">

                </div>
            </div>

       




    </div>

    <!--footer-->
    <?php include 'includes/footer.php'; ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>



</body>

<script>
    //Get the button
    var mybutton = document.getElementById("myBtn");

    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function() {
        scrollFunction()
    };

    function scrollFunction() {
        if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
    }

    // When the user clicks on the button, scroll to the top of the document
    function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }
</script>


</html>