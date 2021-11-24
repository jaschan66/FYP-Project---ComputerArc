<?php
error_reporting(E_ALL & ~E_NOTICE);
session_start();
if (empty($_SESSION['email'])) {
    $button = "<a href='#' id='profileBtn' class='btn' type='button' style='text-align:right;padding-right:1vw; display:none'><i class='far fa-address-card'></i></a>
    <a href='../Testing/includes/header.php?logout=true' id='logoutBtn' class='btn' type='button' onclick='logout()' style='text-align:right;padding-right:1vw; display:none'><i class='fas fa-sign-out-alt'></i></a>";
    $signin = "display:block";
} else {
    $button = "<a href='../Testing/profilePage.php?editProf=1&editPRE=0' id='profileBtn' class='btn' type='button' style='text-align:right;padding-right:1vw; display:block'><i class='far fa-address-card'></i></a>
    <a href='../Testing/includes/header.php?logout=true' id='logoutBtn' class='btn' type='button' onclick='logout()' style='text-align:right;padding-right:1vw'><i class='fas fa-sign-out-alt'></i></a>";

    $signin = "display:none";
}

if (isset($_GET['logout'])) {
    unset($_SESSION['email']);
    unset($_SESSION['role']);
    header("Location: ../homePage.php");
}
?>

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


    .img__wrap {
        position: relative;
        height: 50vh;
        width: 18%;
    }

    .img__description {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(245, 245, 245, 0.72);
        color: #000000;
        visibility: hidden;
        opacity: 0;
        /* transition effect. not necessary */
        transition: opacity .2s, visibility .2s;
    }

    .img__descriptionG {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(to bottom right, rgb(255, 0, 0, 0.8), rgb(0, 0, 0, 0.8));

        color: #fff;
        visibility: hidden;
        opacity: 0;
        /* transition effect. not necessary */
        transition: opacity .2s, visibility .2s;
    }

    .productTD:hover .img__description {
        visibility: visible;
        opacity: 1;
    }

    .productTD:hover .img__descriptionG {
        visibility: visible;
        opacity: 1;
    }

    .img_img {
        height: 50vh;
        width: 100%;
    }

    .productTD {
        position: relative;
        overflow: hidden;
    }

    .dlist {
        width: 100%;
        max-width: 100vw;

    }

    .logoutBtn {
        display: none;
    }

    #profileBtn {
        display: none;
    }

    .carousel-inner img {
        width: 100%;
        height: 60vh;
    }

    html,
    body {
        height: 100%;
    }

    .row {
        margin: 0;
        /*padding:0;*/
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

    .navbar-dark .navbar-nav .active>.nav-link,
    .navbar-dark .navbar-nav .nav-link.active,
    .navbar-dark .navbar-nav .nav-link.show,
    .navbar-dark .navbar-nav .show>.nav-link,
    .navbar-dark .navbar-nav .nav-link:focus,
    .navbar-dark .navbar-nav .nav-link:hover {
        color: #fec400;
    }

    .nav-link {
        transition: 0.2s;
    }

    .dropdown-item.active,
    .dropdown-item:active {
        color: #212529;
    }

    .dropdown-item:focus,
    .dropdown-item:hover {
        background: #fec400;
    }

    .carouselcover {
        object-fit: cover;
    }
</style>


<?php
echo '<nav class="navbar navbar-expand-sm bg-white navbar-light" style="max-height: 3vh;margin-top: 3vh;">
            <!-- Brand/logo -->
            <a class="navbar-brand" href="homePage.php">
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
                            <a class="dropdown-item" style="font-size: 1vw;" href="showPCPPage.php?cate=all">PC Part</a>
                            <a class="dropdown-item" style="font-size: 1vw;" href="showPREPage.php?cate=all">Pre-build PC</a>
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
                </ul>' . $button . ' 
                <ul class="navbar-nav" style="font-family:\'Questrial\'">




                    <li class="nav-item" style="padding-right:1vw">

                        <a class="nav-link" href="loginPage.php" style="font-size: 1vw;' . $signin . '">
                            Get Started
                        </a>


                    </li>


                </ul>
            </div>
        </nav>
        <hr />';
