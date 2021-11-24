<?php
session_start();
?>
<!DOCTYPE html>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta charset="utf-8" />

<head>
    <title>ComputerArc - PC Part</title>
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
            display:block;
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
    $queryloadPCP = "SELECT * FROM pcpart WHERE status = 1 ";
    $queryloadPCPadapter = "SELECT * FROM pcpart WHERE status = 1 AND part = 'adapter'";
    $queryloadPCPcasing = "SELECT * FROM pcpart WHERE status = 1 AND part = 'casing'";
    $queryloadPCPcooler = "SELECT * FROM pcpart WHERE status = 1 AND part = 'cooler'";
    $queryloadPCPGPU = "SELECT * FROM pcpart WHERE status = 1 AND part = 'GPU'";
    $queryloadPCPmobo = "SELECT * FROM pcpart WHERE status = 1 AND part = 'mobo'";
    $queryloadPCPprocessor = "SELECT * FROM pcpart WHERE status = 1 AND part = 'processor'";
    $queryloadPCPPSU = "SELECT * FROM pcpart WHERE status = 1 AND part = 'PSU'";
    $queryloadPCPRAM = "SELECT * FROM pcpart WHERE status = 1 AND part = 'RAM'";
    $queryloadPCPstorage = "SELECT * FROM pcpart WHERE status = 1 AND part = 'storage'";

   
    $executePCP = mysqli_query($conn,$queryloadPCP);
        

    ?>
</head>

<body style="overflow:hidden">

    <!--header-->
    <?php include "includes/header.php"; ?>

    <div class="container-fluid" style="min-height: 70vh; margin-top:1vh; margin-bottom:2vh;">
  
        

        <button onclick="topFunction()" id="myBtn" title="Go to top"><i class='fas fa-angle-up' style='font-size:36px'></i></button>

       <div class="row" style="min-height:70vh">
       
            <div class="col-sm-2" style=" border-right-style: solid;">
            <label style="color:#b5b0aa; font-family: 'Questrial'; margin-left:4vw; font-size: 1.5vw;">Categories</label>
            <hr>
            <nav class='nav flex-column' style="text-align:center">
            <?php if(isset($_GET)){
            $category = $_GET['cate'];
            $selec1 = "";
            $selec2 = "";
            $selec3 = "";
            $selec4 = "";
            $selec5 = "";
            $selec6 = "";
            $selec7 = "";
            $selec8 = "";
            $selec9 = "";
            $selec10 = "";

            if($category == "adapter"){
               $selec1 = "style='color:#000000;'";
             }
             else if($category == "casing"){
                $selec2 = "style='color:#000000;'";
              }
              else if($category == "cooler"){
                $selec3 = "style='color:#000000;'";
              }
              else if($category == "GPU"){
                $selec4 = "style='color:#000000;'";
              }
              else if($category == "all"){
                $selec5 = "style='color:#000000;'";
              }
              else if($category == "mobo"){
                $selec6 = "style='color:#000000;'";
              }
              else if($category == "processor"){
                $selec7 = "style='color:#000000;'";
              }
              else if($category == "PSU"){
                $selec8 = "style='color:#000000;'";
              }
              else if($category == "RAM"){
                $selec9 = "style='color:#000000;'";
              }
              else if($category == "storage"){
                $selec10 = "style='color:#000000;'";
              }

            }   
            ?>
                    <a class='nav-link nav-item' href='showPCPPage.php?cate=all' <?php echo $selec5 ?>>All</a>
                    <a class='nav-link nav-item' href='showPCPPage.php?cate=adapter' <?php echo $selec1 ?>>Adapter</a>
                    <a class='nav-link nav-item' href='showPCPPage.php?cate=casing' <?php echo $selec2 ?>>Casing</a>
                    <a class='nav-link nav-item' href='showPCPPage.php?cate=cooler' <?php echo $selec3 ?>>Cooler</a>
                    <a class='nav-link nav-item' href='showPCPPage.php?cate=GPU' <?php echo $selec4 ?>>Graphic Card</a>
                    <a class='nav-link nav-item' href='showPCPPage.php?cate=mobo' <?php echo $selec6 ?>>Motherboard</a>
                    <a class='nav-link nav-item' href='showPCPPage.php?cate=processor' <?php echo $selec7 ?>>Processor</a>
                    <a class='nav-link nav-item' href='showPCPPage.php?cate=PSU' <?php echo $selec8 ?>>Power Supply</a>
                    <a class='nav-link nav-item' href='showPCPPage.php?cate=RAM' <?php echo $selec9 ?>>Memory</a>
                    <a class='nav-link nav-item' href='showPCPPage.php?cate=storage' <?php echo $selec10 ?>>Storage</a>

             </nav>
            </div>

            <div class="col-sm-10" style="overflow-y:auto;max-height:83vh">
                <div class="col-sm-1">

                </div>

                <div class="col-sm-10">
                <div class="row">
                <?php
                if(isset($_GET)){
                    
                    if($category == "adapter"){
                       $executePCP = mysqli_query($conn,$queryloadPCPadapter);
                    }
                    else if($category == "casing"){
                        $executePCP = mysqli_query($conn,$queryloadPCPcasing);
                     }
                     else if($category == "cooler"){
                        $executePCP = mysqli_query($conn,$queryloadPCPcooler);
                     }
                     else if($category == "GPU"){
                        $executePCP = mysqli_query($conn,$queryloadPCPGPU);
                     }
                     else if($category == "all"){
                        $executePCP = mysqli_query($conn,$queryloadPCP);
                     }
                     else if($category == "mobo"){
                        $executePCP = mysqli_query($conn,$queryloadPCPmobo);
                     }
                     else if($category == "processor"){
                        $executePCP = mysqli_query($conn,$queryloadPCPprocessor);
                     }
                     else if($category == "PSU"){
                        $executePCP = mysqli_query($conn,$queryloadPCPPSU);
                     }
                     else if($category == "RAM"){
                        $executePCP = mysqli_query($conn,$queryloadPCPRAM);
                     }
                     else if($category == "storage"){
                        $executePCP = mysqli_query($conn,$queryloadPCPstorage);
                     }
                }
                    while($PCPdata = mysqli_fetch_array($executePCP)){
                        echo '<div class="col-sm-4">
                        <div class="card" style="margin:1vw;">
                            <img class="card-img-top img-responsive" src="data:image/jpg;base64,' . base64_encode($PCPdata['image']) . '" height="180px" width="180px" style="object-fit: contain;" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">'.$PCPdata['name'].'</h5>
                                    <p class="card-text">RM '.$PCPdata['price'].' </p>
                                    <hr>
                                    <a href="productPage.php?pcpart=1&productID='.$PCPdata['id'].'" class="btn btn-primary" style="width:100%; background-color:#000000">Details</a>
                                </div>
                        </div>
                    </div> ';
                    }
                    ?>
                </div>                 
                    </div>
                    
                

                <div class="col-sm-1">

                </div>
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