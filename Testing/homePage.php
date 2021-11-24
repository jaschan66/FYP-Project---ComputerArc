<?php
session_start();

if (empty($_SESSION['status'])) {
    $_SESSION['status'] = "ignore";
}
?>
<!DOCTYPE html>
<meta name="viewport" content="width=device-width, initial-scale= 1, shrink-to-fit=no">
<meta charset=" utf-8" />

<head>
    <title>ComputerArc</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <link rel="icon" href="Logo stuff\favicon-32x32.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Questrial' rel='stylesheet'>

    <link href='SweetAlert/sweetalert2.min.css' rel='stylesheet'>
    <script src="SweetAlert/sweetalert2.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
</head>

<?php
if (($_SESSION['status']) == "login") {
    $_SESSION['status'] = "ignore";
?>
    <script>
        $(function() {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
                didOpen: (toast) => {
                }
            })

            Toast.fire({
                icon: 'success',
                title: 'Signed in successfully'
            })
        })
    </script>
<?php
} else if (($_SESSION['status']) == "logout") {
    $_SESSION['status'] = "ignore";
?>
    <script>
        $(function() {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
                didOpen: (toast) => {
                }
            })

            Toast.fire({
                icon: 'success',
                title: 'Signed out successfully'
            })
        })
    </script>
<?php
}
?>




<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

<body>


    <!--header-->
    <?php
    include("includes/header.php"); ?>


    <div class="row" style="height:70vh">
        <div class="col-12" style="padding:0">
            <div id="demo" class="carousel slide" data-ride="carousel" style="height:60vh">
                <ul class="carousel-indicators">
                    <li data-target="#demo" data-slide-to="0" class="active"></li>
                    <li data-target="#demo" data-slide-to="1"></li>
                    <li data-target="#demo" data-slide-to="2"></li>
                </ul>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="HomePage Design Photo/96b6e8d3-72e4-49b0-be3f-3c49656d1458._CR0,0,1464,600_PT0_SX1464__.jpg" alt="The Organ" width="1100" height="500" class="carouselcover">
                        <div class="carousel-caption">
                            <h3 style="font-size: 3vw;">The Organ</h3>
                            <p style="font-size: 1vw;">Powerful organ with wisdom</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="HomePage Design Photo/4a4zp609ufe51.png" alt="Dream Workspace" width="1100" height="500" class="carouselcover">
                        <div class="carousel-caption">
                            <h3 style="font-size: 3vw;">Dream Workspace</h3>
                            <p style="font-size: 1vw;">Make it your dream</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="HomePage Design Photo/image_2021-07-15_213513.png" alt="The Beast" width="1100" height="500" class="carouselcover">
                        <div class="carousel-caption">
                            <h3 style="font-size: 3vw;">The Beast</h3>
                            <p style="font-size: 1vw;">Own the beast</p>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#demo" data-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#demo" data-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </a>
            </div>
        </div>



    </div>


    <div class="row" style="height:50vh;">
        <div class="col-12" style="max-height:50vh">
            <p class="text-center" style="font-family:'Questrial'; font-size:5em;padding-top:15vh;color:black;font-size: 7vw;">
                New Arrival</p>
            <p class="text-center" style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; font-size:0.9em;color:grey">
                _________</p>
        </div>
    </div>
    <!--This is hardcoded, need to be change when coding FYP-->
    <div class="row fade" style="margin-bottom:0.5vh">

        <div class="col-3 img__wrap" style="padding:0;height:50vh">



            <table style="width:100vw;">
                <tr>
                    <td class="productTD" style="width:25vw">
                        <img class="img_img" src="Product Photo/20190316104702_53156.jpg" alt="Colourful Kudan" style="object-fit:contain;">
                        <p class="img__description text-center" style="padding-top:20vh;height:50.2vh;width:25.1vw;color:black;font-weight:700;font-size: 1vw;">
                            Colourful Kudan<br /><br />RM 9999.00<br /><br />
                            <a href="ProductPage.aspx?ID=&Category=" class="btn btn-dark" style="font-size: 0.75vw;" role="button">Detail</a>
                        </p>
                    </td>
                    <td class="productTD" style="width:25vw">
                        <img class="img_img" src="Product Photo/20-236-551-V01_1024x1024.jpg" alt="Corsair Vengeance RGB PRO" width="25vw" style="object-fit:contain;">
                        <p class="img__description text-center" style="padding-top:20vh;height:50.2vh;width:25.1vw;color:black;font-weight:700;font-size: 1vw;">
                            Corsair Vengeance RGB PRO<br /><br />RM 799.00<br /><br />
                            <a href="ProductPage.aspx?ID=&Category=" class="btn btn-dark" style="font-size: 0.75vw;" role="button">Detail</a>
                        </p>
                    </td>
                    <td class="productTD" style="width:25vw">
                        <img class="img_img" src="Product Photo/DIY-CAS-SEGOTEP-LUX2-BLK-1-1_1024x1024.jpg" alt="Segotep Lux II PC Casing" style="object-fit:contain;">
                        <p class="img__description text-center" style="padding-top:20vh;height:50.2vh;width:25.1vw;color:black;font-weight:700;font-size: 1vw;">
                            Segotep Lux II PC Casing<br /><br />RM 178.00<br /><br />
                            <a href="ProductPage.aspx?ID=&Category=" class="btn btn-dark" style="font-size: 0.75vw;" role="button">Detail</a>
                        </p>
                    </td>
                    <td class="productTD" style="width:25vw">
                        <img class="img_img" src="Product Photo/69d9e63f0cc4edd000bfd61b7e646811.jpg" alt="Asrock H470M-HDV MATX" style="object-fit:contain;">
                        <p class="img__description text-center" style="padding-top:20vh;height:50.2vh;width:25.1vw;color:black;font-weight:700;font-size: 1vw;">
                            Asrock H470M-HDV MATX<br /><br />RM 319.00<br /><br />
                            <a href="ProductPage.aspx?ID=&Category=" class="btn btn-dark" style="font-size: 0.75vw;" role="button">Detail</a>
                        </p>
                    </td>

                </tr>

            </table>



        </div>


    </div>

    <div class="row fade">
        <div class="col-3 img__wrap" style="padding:0;height:50vh">



            <table style="width:100vw">
                <tr>
                    <td class="productTD" style="width:25vw">
                        <img class="img_img" src="Product Photo/Toshiba_3.5Hdd_F-700x700.png" alt="TOSHIBA HDD 3.5 1TB SATA" style="object-fit:contain;">
                        <p class="img__description text-center" style="padding-top:20vh;height:50.2vh;width:25.1vw;color:black;font-weight:700;font-size: 1vw;">
                            TOSHIBA HDD 3.5" 1TB SATA<br /><br />RM 175.00<br /><br />
                            <a href="ProductPage.aspx?ID=&Category=" class="btn btn-dark" style="font-size: 0.75vw;" role="button">Detail</a>
                        </p>
                    </td>
                    <td class="productTD" style="width:25vw">
                        <img class="img_img" src="Product Photo/SAM-970EvoPlus_SSD_F2-700x700.png" alt="SAMSUNG SSD M.2 970EVO PLUS 1TB" style="object-fit:contain;">
                        <p class="img__description text-center" style="padding-top:20vh;height:50.2vh;width:25.1vw;color:black;font-weight:700;font-size: 1vw;">
                            SAMSUNG SSD M.2 970EVO PLUS 1TB<br /><br />RM 749.00<br /><br />
                            <a href="ProductPage.aspx?ID=&Category=" class="btn btn-dark" style="font-size: 0.75vw;" role="button">Detail</a>
                        </p>
                    </td>
                    <td class="productTD" style="width:25vw">
                        <img class="img_img" src="Product Photo/0b08551e285ed6831acf2970df0e951f-1.jpg" alt="Corsair CV CV450 80 Plus Bronze" style="object-fit:contain;">
                        <p class="img__description text-center" style="padding-top:20vh;height:50.2vh;width:25.1vw;color:black;font-weight:700;font-size: 1vw;">
                            Corsair CV CV450 80 Plus Bronze<br /><br />RM 165.00<br /><br />
                            <a href="ProductPage.aspx?ID=&Category=" class="btn btn-dark" style="font-size: 0.75vw;" role="button">Detail</a>
                        </p>
                    </td>
                    <td class="productTD" style="width:25vw">
                        <img class="img_img" src="Product Photo/66558456_7640314848.jpg" alt="Corsair Internal Power Individually Sleeved PSU Cables Pro Kit - White" style="object-fit:contain;">
                        <p class="img__description text-center" style="padding-top:20vh;height:50.2vh;width:25.1vw;color:black;font-weight:700;font-size: 1vw;">
                            Corsair Internal Power Individually Sleeved PSU Cables Pro Kit - White<br /><br />RM
                            459.00<br /><br />
                            <a href="ProductPage.aspx?ID=&Category=" class="btn btn-dark" style="font-size: 0.75vw;" role="button">Detail</a>
                        </p>
                    </td>

                </tr>

            </table>




        </div>
    </div>

    <div class="row" style="height:50vh">
        <div class="col-12" style="max-height:50vh">
            <p class="text-center" style="font-family:'Questrial'; font-size:7vw;padding-top:15vh;color:black">
                Daily Discovery</p>
            <p class="text-center" style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; font-size:1.5vw;color:grey">
                _________</p>
        </div>
    </div>

    <div class="row fade">
        <div class="col-3 img__wrap" style="padding:0;height:50vh">



            <table style="width:100vw">
                <tr>
                    <td class="productTD" style="width:25vw">
                        <img class="img_img" src="Product Photo/Toshiba_3.5Hdd_F-700x700.png" alt="TOSHIBA HDD 3.5 1TB SATA" style="object-fit:contain;">
                        <p class="img__description text-center" style="padding-top:20vh;height:50.2vh;width:25.1vw;color:black;font-weight:700;font-size: 1vw;">
                            TOSHIBA HDD 3.5" 1TB SATA<br /><br />RM 175.00<br /><br />
                            <a href="ProductPage.aspx?ID=&Category=" class="btn btn-dark" style="font-size: 0.75vw;" role="button">Detail</a>
                        </p>
                    </td>
                    <td class="productTD" style="width:25vw">
                        <img class="img_img" src="Product Photo/SAM-970EvoPlus_SSD_F2-700x700.png" alt="SAMSUNG SSD M.2 970EVO PLUS 1TB" style="object-fit:contain;">
                        <p class="img__description text-center" style="padding-top:20vh;height:50.2vh;width:25.1vw;color:black;font-weight:700;font-size: 1vw;">
                            SAMSUNG SSD M.2 970EVO PLUS 1TB<br /><br />RM 749.00<br /><br />
                            <a href="ProductPage.aspx?ID=&Category=" class="btn btn-dark" style="font-size: 0.75vw;" role="button">Detail</a>
                        </p>
                    </td>
                    <td class="productTD" style="width:25vw">
                        <img class="img_img" src="Product Photo/0b08551e285ed6831acf2970df0e951f-1.jpg" alt="Corsair CV CV450 80 Plus Bronze" style="object-fit:contain;">
                        <p class="img__description text-center" style="padding-top:20vh;height:50.2vh;width:25.1vw;color:black;font-weight:700;font-size: 1vw;">
                            Corsair CV CV450 80 Plus Bronze<br /><br />RM 165.00<br /><br />
                            <a href="ProductPage.aspx?ID=&Category=" class="btn btn-dark" style="font-size: 0.75vw;" role="button">Detail</a>
                        </p>
                    </td>
                    <td class="productTD" style="width:25vw">
                        <img class="img_img" src="Product Photo/66558456_7640314848.jpg" alt="Corsair Internal Power Individually Sleeved PSU Cables Pro Kit - White" style="object-fit:contain;">
                        <p class="img__description text-center" style="padding-top:20vh;height:50.2vh;width:25.1vw;color:black;font-weight:700;font-size: 1vw;">
                            Corsair Internal Power Individually Sleeved PSU Cables Pro Kit - White<br /><br />RM
                            459.00<br /><br />
                            <a href="ProductPage.aspx?ID=&Category=" class="btn btn-dark" style="font-size: 0.75vw;" role="button">Detail</a>
                        </p>
                    </td>

                </tr>

            </table>




        </div>
    </div>

    <div class="row" style="height:50vh">
        <div class="col-12" style="max-height:50vh">
            <p class="text-center" style="font-family:'Questrial'; font-size:7vw;padding-top:15vh;color:black">
                Shop by Categories</p>
            <p class="text-center" style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; font-size:1.5vw;color:grey">
                _________</p>
        </div>
    </div>

    <div class="row" style="height:100vh;">
        <div class="col-6  text-center" style="background-image: url('HomePage Design Photo/martin-katler-7wCxlBfGMdk-unsplash (4).jpg'); font-family:'Questrial'; max-width:100%;
                max-height:100%; background-repeat: no-repeat; background-size: cover; ">
            <p class="text-center fade" style=" font-size:4vw;padding-top:45vh;color:white">PC Parts</p>
            <a href="Category.aspx?category=popurbanart" class="btn" style="background-color:black;color:white;font-size:1vw">Shop Now</a>

        </div>
        <div class="col-6 text-center" style="background-image: url('HomePage Design Photo/Verification (2) (1) (1).png'); font-family:'Questrial'; background-size: cover;">

            <p class=" text-center fade" style=" font-size:4vw;padding-top:45vh;color:white">Pre-Build PC</p>
            <a href="Category.aspx?category=fashionicons" class="btn" style="background-color:black;color:white;font-size:1vw">Shop Now</a>
        </div>

    </div>

    <div class="row" style="height:100vh;background-image: url('HomePage Design Photo/5437549.jpg');background-repeat: no-repeat; background-size: cover;height:100vh">
        <div class="col-12" style="max-height: 50vh;">
            <p class="text-center fade" style="font-family:'Questrial'; font-size:7vw;padding-top:15vh;color:white">
                Game With Confidence</p>
            <p class="text-center fade" style="font-family:'Questrial'; font-size:2vw;color:white">
                A frame matters, don't lose it</p>
            <p class="text-center" style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; font-size:1.5vw;color:white">
                _________</p>
        </div>

        <div class="col-12 fade" style="max-height:50vh;padding:0">
            <div class="col-3 img__wrap" style="padding:0;height:50vh">



                <table style="width:100vw;">
                    <tr>
                        <td class="productTD" style="width:25vw">
                            <img class="img_img" src="Product Photo/20190316104702_53156_adobespark.png" alt="Colourful Kudan" style="object-fit:contain;">
                            <p class="img__descriptionG text-center" style="padding-top:20vh;height:50.2vh;width:25.1vw;color:white;font-weight:700;font-size: 1vw;">
                                Colourful Kudan<br /><br />RM 9999.00<br /><br />
                                <a href="ProductPage.aspx?ID=&Category=" class="btn" role="button" style="background-color: rgb(243,7,25);font-size: 0.75vw;">Detail</a>
                            </p>
                        </td>
                        <td class="productTD" style="width:25vw">
                            <img class="img_img" src="Product Photo/20-236-551-V01_1024x1024_adobespark.png" alt="Corsair Vengeance RGB PRO" width="25vw" style="object-fit:contain;">
                            <p class="img__descriptionG text-center" style="padding-top:20vh;height:50.2vh;width:25.1vw;color:white;font-weight:700;font-size: 1vw;">
                                Corsair Vengeance RGB PRO<br /><br />RM 799.00<br /><br />
                                <a href="ProductPage.aspx?ID=&Category=" class="btn" role="button" style="background-color: rgb(243,7,25);font-size: 0.75vw;">Detail</a>
                            </p>
                        </td>
                        <td class="productTD" style="width:25vw">
                            <img class="img_img" src="Product Photo/DIY-CAS-SEGOTEP-LUX2-BLK-1-1_1024x1024-removebg.png" alt="Segotep Lux II PC Casing" style="object-fit:contain;">
                            <p class="img__descriptionG text-center" style="padding-top:20vh;height:50.2vh;width:25.1vw;color:white;font-weight:700;font-size: 1vw;">
                                Segotep Lux II PC Casing<br /><br />RM 178.00<br /><br />
                                <a href="ProductPage.aspx?ID=&Category=" class="btn" role="button" style="background-color: rgb(243,7,25);font-size: 0.75vw;">Detail</a>
                            </p>
                        </td>
                        <td class="productTD" style="width:25vw">
                            <img class="img_img" src="Product Photo/107451fcf9f5193bd8ec16daa91b75ea_adobespark.png" alt="sus ROG Strix B460-F ATX Gaming Motherboard" style="object-fit:contain;">
                            <p class="img__descriptionG text-center" style="padding-top:20vh;height:50.2vh;width:25.1vw;color:white;font-weight:700;font-size: 1vw;">
                                Asus ROG Strix B460-F ATX Gaming Motherboard<br /><br />RM 849.00<br /><br />
                                <a href="ProductPage.aspx?ID=&Category=" class="btn" role="button" style="background-color: rgb(243,7,25);font-size: 0.75vw;">Detail</a>
                            </p>
                        </td>

                    </tr>

                </table>



            </div>


        </div>

    </div>



    <div class="col-12" style="font-family:'Questrial';height:50vh">
        <p class="text-center" style=" font-size:3.5vw;padding-top:20vh;color:black">Why should you buy from us?</p>
        <p class="text-center" style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; font-size:1.5vw;color:grey">
            _________</p>
        <p class="fade" style="font-size:1vw;color:#5c5a5a;text-align:center">
            ComputerArc, An online all-in-one PC platfrom for those who need knowledge on PC or simple finding the
            PC they need. We offer a wide range of
            PC just for our customers to fulfilled their needs. </p>

    </div>

    <!--footer-->
    <?php include 'includes/footer.php'; ?>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script>
        $(window).on("load", function() {
            $(window).scroll(function() {
                var windowBottom = $(this).scrollTop() + $(this).innerHeight();
                $(".fade").each(function() {
                    /* Check the location of each desired element */
                    var objectBottom = $(this).offset().top + $(this).outerHeight();

                    /* If the element is completely within bounds of the window, fade it in */
                    if (objectBottom < windowBottom) { //object comes into view (scrolling down)
                        if ($(this).css("opacity") == 0) {
                            $(this).fadeTo(300, 1);
                        }
                    } else { //object goes out of view (scrolling up)
                        if ($(this).css("opacity") == 1) {
                            $(this).fadeTo(300, 0);
                        }
                    }
                });
            }).scroll(); //invoke scroll-handler on page-load
        });
    </script>
    <script>
        window.onbeforeunload = function() {
            window.scrollTo(0, 0);
        }
    </script>

</body>

</html>