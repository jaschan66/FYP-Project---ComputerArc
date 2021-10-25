<!DOCTYPE html>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta charset=" utf-8" />

<head>
    <title>ComputerArc</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <link rel="icon" href="Logo stuff\favicon-32x32.png" type="image/x-icon">
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

        <nav class="navbar navbar-expand-sm bg-white navbar-light">
            <!-- Brand/logo -->
            <a class="navbar-brand" href="homePage.html">
                <img src="Logo stuff\arc-logo-removebg-preview.png" alt="logo"
                    style="width:7vh;height:2.5vh;padding-bottom:0.3vh;background-repeat: no-repeat; background-size: cover;">
            </a>

            <!-- Links -->
            <ul class="navbar-nav mr-auto"
                style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                <li class="nav-item dropdown" style="padding-right:1vw">
                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        Products
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="Category.aspx?category=popurbanart">PC Part</a>
                        <a class="dropdown-item" href="Category.aspx?category=fashionicons">Pre-build PC</a>
                    </div>
                </li>
                <li class="nav-item" style="padding-right:1vw">
                    <a class="nav-link" href="Category.aspx">Build A Desktop</a>
                </li>
                <li class="nav-item" style="padding-right:1vw">
                    <a class="nav-link" href="Category.aspx">Forum</a>
                </li>
                <li class="nav-item" style="padding-right:1vw">
                    <a class="nav-link" href="Category.aspx">Raffle</a>
                </li>
                <li class="nav-item" style="padding-right:1vw">
                    <a class="nav-link" href="Category.aspx">Auction</a>
                </li>
                <li class="nav-item" style="padding-right:1vw">
                    <a class="nav-link" href="AboutUs.html">About Us</a>
                </li>
            </ul>
            <button id="profileBtn" class="btn" OnServerClick="Account_Click" type="button" runat="server"
                style="text-align:right;padding-right:1vw"><i class="far fa-address-card"></i></button>
            <button id="logoutBtn" class="btn" OnServerClick="Logout_Click" type="button" runat="server"
                style="text-align:right;padding-right:1vw;display: none;"><i class='fas fa-sign-out-alt'></i></button>
            <ul class="navbar-nav" style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">




                <li class="nav-item dropdown" style="padding-right:1vw" runat="server" id="loginDDL">

                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop1" data-toggle="dropdown">
                        Login
                    </a>

                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="signInCustomer.aspx">Login as Customer</a>
                        <a class="dropdown-item" href="signInArtist.aspx">Login as Artist</a>

                    </div>
                </li>

                <li class="nav-item" style="padding-right:1vw">
                    <asp:Label runat="server" ID="hypLink2">
                        <a class="nav-link hypLink" href="signUp.aspx">Sign up</a>

                    </asp:Label>
                </li>

            </ul>

        </nav>
        <hr />
        <!--Content after here-->
        <div class="container">
            <div class="row">
                <div class="col-7">
                    <div id="showcase" class="carousel slide" data-ride="carousel">

                        <ul class="carousel-indicators">
                            <li data-target="#showcase" data-slide-to="0" class="active"></li>
                        </ul>

                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="ywOf1GrT1600829308-700x700.png"
                                alt="" >
                            </div>
                            <div class="carousel-item ">
                                <img src="cmw8gx4m1z3200c16-1-1000x1000_1.jpg"
                                alt="" >
                            </div>
                            <div class="carousel-item ">
                                <img src="20-236-551-V01_1024x1024.jpg"
                                alt="" >
                            </div>
                        </div>

                        <a class="carousel-control-prev" href="#showcase" data-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </a>
                        <a class="carousel-control-next" href="#showcase" data-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </a>
                    </div>
                </div>
                <div class="col-5">

                    <h2></h2>
                    <asp:Label ID="lblCate" runat="server" Text=''></asp:Label>
                    <p style="font-size: 28px"></p>
                    Stock: 10 <asp:label runat="server" id="stock" Text=''></asp:label>
                    <p style="color: gray;">_________________________________________________________________</p>


                    <div class="row" style="padding-bottom: 2vh;">
                        <div class="col-8">
                            <buttton class="btn btn-primary">Buy Now</buttton>
                        </div>
                        <div class="col-3">
                            <!--<asp:Button ID="BtnWL" class="btn btn-danger" OnClick="BtnWL_Click" runat="server" Text="Add Wishlist" UseSubmitBehavior="False"></asp:Button>-->
                        </div>
                    </div>
                    </ItemTemplate>
                    </asp:Repeater>

                    <a href="#terms"
                        class="btn btn-outline-dark btn-block border-2 border-top-0 border-left-0 border-right-0 rounded-0"
                        data-toggle="collapse" style="text-align: left;">OUR GUARANTEE TO YOU</a>
                    <div id="terms" class="collapse" style="text-align: center;">
                        We are so confident you will love our products that we offer a full 30 days 100% risk free. If
                        for any reason you don't like our products or they are not as you expected, we will refund you
                        100%.
                    </div>
                </div>
            </div>
            <hr />
            <div class="row">
                <div class="col-12" style="padding:0px">
                    <h4><u>Description</u></h4>
                    <p style="text-align:Left; width:auto;">OPTIMIZED FOR INTEL® AND AMD®<br>
                        CORSAIR VENGEANCE RGB PRO SL DDR4 memory lights up your PC with dynamic, individually addressable RGB lighting, while delivering peak performance in a compact form factor.
                        <br><br>
                        INTELLIGENT CONTROL, UNLIMITED POSSIBILITIES<br>
                        Take control with CORSAIR iCUE software and synchronize lighting with other CORSAIR RGB products, including coolers, keyboards and fans.
                        <br><br>
                        Switch through various profiles.
                        <br><br>
                        WAVE SPIRAL RAIN VISOR SEQUENTIAL<br>
                        PERFORMANCE HERITAGE<br>
                        Each Vengeance RGB PRO SL module starts with our custom performance PCB and tightly screened memory chips to provide incredible frequencies, for maximum bandwidth and tight response times on all platforms.
                        <br><br>
                        COMPACT FORM FACTOR<br>
                        Standing at just 44mm tall for wider compatibility with air coolers and smaller form factor chassis, each module looks great from any angle.
                        <br><br>
                        ONE STEP OVERCLOCKING<br>
                        With Intel® XMP 2.0 support, a single BIOS setting is all that’s required to set your memory to its ideal performance settings.
                        <br><br>
                        LIMITED LIFETIME WARRANTY<br>
                        For complete peace of mind and years of worry-free performance.
                       </p>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-12">
                    <h2>Recommendations for you.</h2>
                    <asp:DataList ID="dtlDisplay" runat="server" RepeatColumns="4">
                        <ItemTemplate>
                            <table>
                                <tr>
                                    <td>
                                        <a href="#">
                                            <asp:Image CssClass="image" ID="Image1" runat="server"
                                                ImageUrl='<%# Eval("ArtPhoto") %>' height="200" width="200" />
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </ItemTemplate>
                    </asp:DataList>
                </div>
            </div>
        </div>
        </div>
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