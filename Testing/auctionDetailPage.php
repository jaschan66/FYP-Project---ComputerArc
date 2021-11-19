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

    <?php include "auction/auction-retrieve.php"; ?>
</head>

<body>
    <!--header-->
    <?php require "includes/header.php"; ?>

    <!--Content after here-->
    <div class="container">
        <div class="row">
            <div class="col-7">

                <!--                                                                            Carousel
                    <div id="showcase" class="carousel slide" data-ride="carousel">

                    <ul class="carousel-indicators">
                        <li data-target="#showcase" data-slide-to="0" class="active"></li>
                    </ul>

                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="ywOf1GrT1600829308-700x700.png" alt="">
                        </div>
                        <div class="carousel-item ">
                            <img src="cmw8gx4m1z3200c16-1-1000x1000_1.jpg" alt="">
                        </div>
                        <div class="carousel-item ">
                            <img src="20-236-551-V01_1024x1024.jpg" alt="">
                        </div>
                    </div>

                    <a class="carousel-control-prev" href="#showcase" data-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </a>
                    <a class="carousel-control-next" href="#showcase" data-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </a>
                </div> -->
                 <?php echo' <img src="data:image/jpg;base64, '. base64_encode($resultGetData["image"]) . '" height="800px" width="800px" alt="Profile Picture" class="img-thumbnail img-responsive"/>' ?>

            </div>
            <div class="col-5">

                <?php echo' <h2>'. $resultGetData["title"] .'</h2>
                            <p>' . date("j/n/Y", strtotime($resultGetData["start_date"])) . ' - ' . date("j/n/Y", strtotime($resultGetData["end_date"])) . '</p>

                ' ?>
                <p style="color: gray;">_________________________________________________________________</p>


                <div class="row" style="padding-bottom: 2vh;">
                    <div class="col-8">
                        <buttton class="btn btn-primary">Bid Now</buttton>
                    </div>
                    <div class="col-3">
                        <!--<asp:Button ID="BtnWL" class="btn btn-danger" OnClick="BtnWL_Click" runat="server" Text="Add Wishlist" UseSubmitBehavior="False"></asp:Button>-->
                    </div>
                </div>

                <h3> </h3>

                ?>


                <a href="#terms" class="btn btn-outline-dark btn-block border-2 border-top-0 border-left-0 border-right-0 rounded-0" data-toggle="collapse" style="text-align: left;">OUR GUARANTEE TO YOU</a>
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
                                        <asp:Image CssClass="image" ID="Image1" runat="server" ImageUrl='<%# Eval("ArtPhoto") %>' height="200" width="200" />
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>


</body>

<!--footer-->
<?php require "includes/footer.php"; ?>

</html>