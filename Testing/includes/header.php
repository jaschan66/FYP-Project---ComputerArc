<?php
error_reporting(E_ALL & ~E_NOTICE);
    session_start();
if(empty($_SESSION['email'])){
    $button = "<a href='header.php?profile=true' id='profileBtn' class='btn' type='button' style='text-align:right;padding-right:1vw; display:none'><i class='far fa-address-card'></i></a>
    <a href='../Testing/includes/header.php?logout=true' id='logoutBtn' class='btn' type='button' onclick='logout()' style='text-align:right;padding-right:1vw; display:none'><i class='fas fa-sign-out-alt'></i></a>";
    $signin = "display:block";
}else{
    $button = "<a href='header.php?profile=true' id='profileBtn' class='btn' type='button' style='text-align:right;padding-right:1vw; display:block'><i class='far fa-address-card'></i></a>
    <a href='../Testing/includes/header.php?logout=true' id='logoutBtn' class='btn' type='button' onclick='logout()' style='text-align:right;padding-right:1vw'><i class='fas fa-sign-out-alt'></i></a>";

    $signin = "display:none";
}

if (isset($_GET['logout'])){
    unset($_SESSION['email']);
    unset($_SESSION['role']);
    header("Location: ../homePage.php");
}







echo '<nav class="navbar navbar-expand-sm bg-white navbar-light" style="max-height: 3vh;margin-top: 3vh;">
            <!-- Brand/logo -->
            <a class="navbar-brand" href="homePage.html">
                <img src="Logo stuff\arc-logo-removebg-preview.png" alt="logo" style="width:7vh;height:2.5vh;padding-bottom:0.3vh;background-repeat: no-repeat; background-size: cover;">
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Links -->
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav mr-auto" style="font-family:\'Questrial\'">
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
                    <a class="nav-link" style="font-size: 1vw;" href="Category.php">Build A Desktop</a>
                    </li>
                    <li class="nav-item" style="padding-right:1vw">
                        <a class="nav-link" style="font-size: 1vw;" href="forumTopic.php">Forum</a>
                    </li>
                    <li class="nav-item" style="padding-right:1vw">
                        <a class="nav-link" style="font-size: 1vw;" href="raffle.php">Raffle</a>
                    </li>
                    <li class="nav-item" style="padding-right:1vw">
                        <a class="nav-link" style="font-size: 1vw;" href="auctionPage.php">Auction</a>
                    </li>
                    <li class="nav-item" style="padding-right:1vw">
                        <a class="nav-link" style="font-size: 1vw;" href="AboutUs.php">About Us</a>
                    </li>
                </ul>'. $button .' 
                <ul class="navbar-nav" style="font-family:\'Questrial\'">




                    <li class="nav-item" style="padding-right:1vw">

                        <a class="nav-link" href="loginPage.php" style="font-size: 1vw;'.$signin.'">
                            Get Started
                        </a>


                    </li>


                </ul>
            </div>
        </nav>
        <hr />';
