<!DOCTYPE html>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta charset=" utf-8" />

<head>
    <title>ComputerArc - About Us</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <link rel="icon" href="Logo stuff\favicon-32x32.png" type="image/x-icon">
    <link href='https://fonts.googleapis.com/css?family=Questrial' rel='stylesheet'>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            overflow-x: hidden;
            overflow-y: hidden;
            /* Add the ability to scroll */
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

        .logoutBtn {
            display: none;
        }

        #profileBtn {
            display: none;
        }

        html,
        body {
            height: 100%;
        }

        .row {
            margin: 0;
            /*padding:0;*/
        }

        .dropdown-item.active,
        .dropdown-item:active {
            color: #212529;
        }

        .dropdown-item:focus,
        .dropdown-item:hover {
            background: #fec400;
        }
    </style>

<body>
        <?php require "includes/header.php"; ?>

    
        <!--Content after here-->
        <div class="row" style="height:61vh;background-color:#ffffff">
            <div class="col-12 text-center" style="padding-top:5vh">
                <img  src="Logo stuff\arc-logo-removebg-preview.png"  alt="Logo" style="width:20vw;height:10vh;"/>
                  <p  style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; font-size:0.9em;color:grey">________________________________________</p>
                <p  style="font-family:Noto Sans,sans-serif; font-size:2em;padding-top:1.5vh">All About Us</p>
                 <p  style="font-family:Noto Sans,sans-serif; font-size:1.2em;color:grey;padding-left:25vw;padding-right:25vw;text-align:justify">&emsp;ComputerArc is the all-in-one PC website. We've been helping people to sell PC Parts and Pre-build PC
                    2021 and are home to hundreds of thousands of PC retailers. Mooreover, we would like to grow our community as large as possible which we include forum for people to discuss, seek help and ask for opinion. Last but not least, we provide raffle and auctionas entertainment in our webside to keep visitors entertained.</p>
                 <p  style="font-family:Noto Sans,sans-serif; font-size:1.2em;color:grey;padding-left:25vw;padding-right:25vw;text-align:justify">&emsp;With just a few clicks, retailers can upload their images to our platform, set their prices for hundreds of different PC components, and then instantly sell those products to large amount audience of online, mobile, and real-world buyers. ComputerArc fulfills each order on behalf of the retailers.</p>
            </div>
        
           
        </div>
        <!--Content ends here-->
        <?php require "includes/footer.php"; ?>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>

</html>