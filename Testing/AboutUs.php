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
            overflow-y: scroll;
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
    <form id="form1" runat="server">

    <nav class="navbar navbar-expand-sm bg-white navbar-light" style="max-height: 3vh;margin-top: 3vh;">
            <!-- Brand/logo -->
            <a class="navbar-brand" href="homePage.html">
                <img src="Logo stuff\arc-logo-removebg-preview.png" alt="logo"
                    style="width:7vh;height:2.5vh;padding-bottom:0.3vh;background-repeat: no-repeat; background-size: cover;">
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Links -->
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav mr-auto"
                style="font-family:'Questrial">
                <li class="nav-item dropdown" style="padding-right:1vw">
                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown" style="font-size: 1vw;">
                        Products
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" style="font-size: 1vw;" href="Category.aspx?category=popurbanart">PC Part</a>
                        <a class="dropdown-item" style="font-size: 1vw;" href="Category.aspx?category=fashionicons">Pre-build PC</a>
                    </div>
                </li>
                <li class="nav-item" style="padding-right:1vw">
                    <a class="nav-link" style="font-size: 1vw;" href="Category.aspx">Build A Desktop</a>
                </li>
                <li class="nav-item" style="padding-right:1vw">
                    <a class="nav-link" style="font-size: 1vw;" href="Category.aspx">Forum</a>
                </li>
                <li class="nav-item" style="padding-right:1vw">
                    <a class="nav-link" style="font-size: 1vw;" href="Category.aspx">Raffle</a>
                </li>
                <li class="nav-item" style="padding-right:1vw">
                    <a class="nav-link" style="font-size: 1vw;" href="Category.aspx">Auction</a>
                </li>
                <li class="nav-item" style="padding-right:1vw">
                    <a class="nav-link" style="font-size: 1vw;" href="AboutUs.php">About Us</a>
                </li>
            </ul>
        
            <button id="profileBtn" class="btn" OnServerClick="Account_Click" type="button" runat="server"
                style="text-align:right;padding-right:1vw"><i class="far fa-address-card"></i></button>
            <button id="logoutBtn" class="btn" OnServerClick="Logout_Click" type="button" runat="server"
                style="text-align:right;padding-right:1vw;display: none;"><i class='fas fa-sign-out-alt'></i></button>
            <ul class="navbar-nav" style="font-family:'Questrial'">




                <li class="nav-item" style="padding-right:1vw" >

                    <a class="nav-link" href="loginPage.php" style="font-size: 1vw;" >
                        Get Started
                    </a>

                    
                </li>


            </ul>
        </div>
        </nav>
        <hr />
        <!--Content after here-->
        <div class="row" style="height:60vh;background-color:#ffffff">
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
        <div class="row" style="background-color:black;height:40vh">
            <div class="col-3 border-right border-info" style="text-align:right;padding-top:8vh;">
                <img src="Logo stuff\image-removebg-preview.png" alt="logo" style="width:20vh;height:6vh">
            </div>
            <div class="col-6 border-right border-info" style="padding-top:5vh;">
                <table class="table table-borderless text-center" style="color:white;font-family:Noto Sans,sans-serif">
                    <thead>
                        <tr>

                            <th style="font-size:1.5em;width:50%"><u>Main Menu</u></th>
                            <th style="font-size:1.5em;width:50%"><u>Social</u></th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><a class="text-decoration-none text-white" href="#">Forum</a></td>
                            <td><a class="text-decoration-none text-white" href="https://www.facebook.com">Facebook</a>
                            </td>

                        </tr>
                        <tr>
                            <td><a class="text-decoration-none text-white" href="#">Products</a></td>
                            <td><a class="text-decoration-none text-white"
                                    href="https://www.instagram.com">Instagram</a></td>

                        </tr>
                        <tr>
                            <td><a class="text-decoration-none text-white" href="#">About Us</a></td>
                            <td><a class="text-decoration-none text-white"
                                    href="https://www.https://twitter.com">Twitter</a></td>

                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-3"
                style="text-align:left;padding-top:7vh;color:white;font-size:0.7em;font-family:Noto Sans,sans-serif">
                Copyright © 2021 by ComputerArc.Co
                All rights reserved. All PC part or any portion thereof
                may not be reproduced or used in any manner whatsoever
                without the express written permission of the publisher
                except for the use of brief quotations in an product review.
            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>


    </form>
</body>

</html>