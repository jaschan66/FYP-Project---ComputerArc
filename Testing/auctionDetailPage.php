<!DOCTYPE html>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta charset=" utf-8" />

<head>
    <title>ComputerArc - Auction</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <link rel="icon" href="Logo stuff\favicon-32x32.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Questrial' rel='stylesheet'>

    <link href='SweetAlert/sweetalert2.min.css' rel='stylesheet'>
    <script src="SweetAlert/sweetalert2.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <style>
        p {
            /* font-family: "Questrial"; */
            margin-bottom: 0.5rem;
        }

        h1,
        h2,
        h3 {
            margin-bottom: 1.25rem;
        }

        .img-magnifier-glass {
            position: absolute;
            border: 3px solid #000;
            border-radius: 50%;
            cursor: none;
            /*Set the size of the magnifier glass:*/
            width: 100px;
            height: 100px;
        }
    </style>

    <!--header-->
    <?php require "includes/header.php"; ?>

</head>

<body>

    <?php include "auction/auction-retrieve.php"; ?>

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
                <div class="col-sm-7" class="img-magnifier-container">
                    <img class="img-responsive" src="<?php echo 'data:image/jpg;base64,' . base64_encode($resultGetData['image']) . '' ?>" height="512px" width="512px" style="object-fit: contain;" alt="Card image cap" id="auctionImage">
                </div>

            </div>
            <div class="col-5">

                <h2>Auction Details</h2>
                <div style="margin-bottom: 1.25rem">
                    <h2><?php echo  $resultGetData["title"] ?></h2>
                    <p style="font-weight: bold;">Auction Duration:</p>
                    <p><?php echo date("j/n/Y", strtotime($resultGetData["start_date"])) ?> - <?php echo date("j/n/Y", strtotime($resultGetData["end_date"])) ?></p>
                    <p style="color: gray;">_________________________________________________________________</p>
                </div>


                <div class="row" style="padding-bottom: 2vh;">
                    <buttton class='btn btn-dark' style='width:100%'>Bid Now</buttton>
                </div>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-12" style="padding:0px">
                <h3><u>Description</u></h3>
                <h4>Partner Details</h4>
                <div>
                    <p style="font-weight: bold;">Name</p>
                    <p style><?php echo $resultPartnerData["name"] ?></p><br>
                    <p style="font-weight: bold;">Email</p>
                    <p style><?php echo $resultPartnerData["email"] ?></p><br>
                    <p style="font-weight: bold;">Phone-no</p>
                    <p style><?php echo $resultPartnerData["telNo"] ?></p><br>
                </div>
            </div>
        </div>
        <div class="row mt-3">
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
    <script>
        /* Initiate Magnify Function with the id of the image, and the strength of the magnifier glass:*/
        magnify("auctionImage", 1.5);
    </script>


</body>


<!--footer-->
<?php require "includes/footer.php"; ?>

</html>