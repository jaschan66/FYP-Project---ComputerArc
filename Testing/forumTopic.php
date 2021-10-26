<!DOCTYPE html>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta charset=" utf-8" />

<head>
    <title>ComputerArc - Forum Topics</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <link rel="icon" href="Logo stuff\favicon-32x32.png" type="image/x-icon">
    <link href='https://fonts.googleapis.com/css?family=Questrial' rel='stylesheet'>
    <style>
        body {
            overflow-x: hidden;
            overflow-y: hidden;
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
    </style>
</head>

<body>
    <form id="form1" runat="server">

        <nav class="navbar navbar-expand-sm bg-white navbar-light" style="max-height: 3vh;margin-top: 3vh;">
            <!-- Brand/logo -->
            <a class="navbar-brand" href="homePage.html">
                <img src="Logo stuff\arc-logo-removebg-preview.png" alt="logo" style="width:7vh;height:2.5vh;padding-bottom:0.3vh;background-repeat: no-repeat; background-size: cover;">
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Links -->
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav mr-auto" style="font-family:'Questrial">
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

                <button id="profileBtn" class="btn" OnServerClick="Account_Click" type="button" runat="server" style="text-align:right;padding-right:1vw"><i class="far fa-address-card"></i></button>
                <button id="logoutBtn" class="btn" OnServerClick="Logout_Click" type="button" runat="server" style="text-align:right;padding-right:1vw;display: none;"><i class='fas fa-sign-out-alt'></i></button>
                <ul class="navbar-nav" style="font-family:'Questrial'">

                    <li class="nav-item" style="padding-right:1vw">
                        <a class="nav-link" href="loginPage.php" style="font-size: 1vw;">
                            Get Started
                        </a>
                    </li>
                </ul>
            </div>
        </nav>



        <div class="row" style="padding-top: 1vh;">
            <div class="col-2">

            </div>
            <div class="col-8 " style="height: 100vh; background-image: linear-gradient(to right, #1f2428 80%, #2c3037 )">
                <div class="col-12">
                    <h2 style="color: #ffffff; text-align: center; padding-top: 5vh;">Forum</h2>

                    <div class="input-group mb-3" style="padding-top: 3vh; padding-bottom: 3vh;">
                        <input type="text" class="form-control" placeholder="Search">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">🔍</button>
                        </div>
                    </div>
                </div>

                <a href="#demo" data-toggle="collapse" style="margin-left: 63vw;">🔽</a>
                <div id="demo" class="collapse show">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-4">
                                <a style="color: #b5b0aa;">General</a>
                                <p style="color: #b5b0aa; width: 20vw;">General discussion in ComputerArc</p>
                            </div>
                            <div class="col-4" style="padding-left: 20vw;">
                                <dt style="color: #b5b0aa; width: 20vw;">500k</dt>
                                <dd style="color: #b5b0aa; width: 20vw;">posts</dd>
                            </div>
                            <div class="col-4">
                                <p style="color: #b5b0aa; width: 20vw; padding-left: 2vw">How to join Raffle?</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-2">

            </div>
        </div>


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    </form>
</body>

</html>