<!DOCTYPE html>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta charset=" utf-8" />

<head>
    <title>ComputerArc - Auction</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <link rel="icon" href="Logo stuff\favicon-32x32.png" type="image/x-icon">
    <link href='https://fonts.googleapis.com/css?family=Questrial' rel='stylesheet'>

    <link href='filepond/filepond.min.css' rel='stylesheet'>
    <link href='filepond/plugins/preview/filepond-plugin-image-preview.min.css' rel='stylesheet'>

    <style>
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
            color: #b5b0aa;
        }

        a {
            font-family: "Questrial";
            font-size: larger;
            color: #b5b0aa;
        }

        a:hover {
            color: #383735;
        }

        h2 {
            font-family: "Questrial";
        }

        h4, h5 {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .auction-container a img {
            width: 100%;
            height: 235px;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .auction-container a h4 {
            font-family: "Questrial";
            font-size: 20px;
            font-weight: 700;
            color: #ffffff;
        }

        .auction-container a:hover {
            opacity: 0.8;
        }

        .auction-container a {
            height: 420px;
            width: 360px;
            margin: 20px 10px 0;
            background-color: rgba(161, 161, 161, 0.5);
        }

        .auction-container {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            justify-content: flex-start;
            align-content: flex-start;
            margin-left: 10px;
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

</head>

<?php
include "includes/dbh.inc.php";
$queryloadPRE = "SELECT * FROM prebuildpc WHERE status = 1 ";
$queryloadstreamPRE = "SELECT * FROM prebuildpc WHERE status = 1 AND category = 'Streaming'";
$queryloadgamePRE = "SELECT * FROM prebuildpc WHERE status = 1 AND category = 'Gaming'";
$queryloadofficePRE = "SELECT * FROM prebuildpc WHERE status = 1 AND category = 'Office-Used'";
$queryloadgraphicPRE = "SELECT * FROM prebuildpc WHERE status = 1 AND category = 'Graphic Designing'";

$executePRE = mysqli_query($conn, $queryloadPRE);
?>

<body>
    <!--header-->
    <?php 
    require "includes/header.php"; 
    require "auction/auction-status.php";
    ?>

    <div class="container-fluid" style="min-height: 70vh; margin-top:1vh; margin-bottom:2vh;">


        <button onclick="topFunction()" id="myBtn" title="Go to top"><i class='fas fa-angle-up' style='font-size:36px'></i></button>

        <div class="row" style="min-height:70vh">

            <div class="col-sm-2" style=" border-right-style: solid;">
                <label style="color:#b5b0aa; font-family: 'Questrial'; margin-left:4vw; font-size: 1.5vw;">Auction</label>
                <hr>
                <nav class='nav flex-column' style="text-align:center">
                    <?php if (isset($_GET)) {
                        $sortBy = $_GET['sort'];
                        $option1 = "";
                        $option2 = "";
                        $option3 = "";
                        $option4 = "";

                        if ($sortBy == "all") {
                            $option1 = "style='color:#000000;'";
                        } else if ($sortBy == "name") {
                            $option2 = "style='color:#000000;'";
                        } else if ($sortBy == "date") {
                            $option3 = "style='color:#000000;'";
                        } else if ($sortBy == "price") {
                            $option4 = "style='color:#000000;'";
                        }
                    }
                    ?>
                    <a class='nav-link nav-item' href='showPREPage.php?cate=all' <?php echo $option1 ?>>All</a>
                    <a class='nav-link nav-item' href='showPREPage.php?cate=name' <?php echo $option2 ?>>Sort by Name</a>
                    <a class='nav-link nav-item' href='showPREPage.php?cate=date' <?php echo $option3 ?>>Sort by Date</a>
                    <a class='nav-link nav-item' href='showPREPage.php?cate=price' <?php echo $option4 ?>>Sort by Price</a>
                </nav>
            </div>

            <div class="col-sm-10" style="overflow-y:auto;max-height:83vh">
                <div class="col-sm-1">
                </div>

                <div class="col-sm-10">
                    <div class="row">
                        <?php
                        if (isset($_GET)) {

                            if ($sortBy == "name") {
                                $executePRE = mysqli_query($conn, $queryloadofficePRE);
                            } else if ($sortBy == "date") {
                                $executePRE = mysqli_query($conn, $queryloadgraphicPRE);
                            } else if ($sortBy == "price") {
                                $executePRE = mysqli_query($conn, $queryloadgamePRE);
                            } else if ($sortBy == "all") {
                                $executePRE = mysqli_query($conn, $queryloadPRE);
                            }
                        }
                        while ($PREdata = mysqli_fetch_array($executePRE)) {
                        ?>
                            <div class="col-sm-4">
                                <div class="card" style="margin:1vw;">
                                    <img class="card-img-top img-responsive" src="data:image/jpg;base64,<?php echo base64_encode($PREdata['image']) ?>" height="180px" width="180px" style="object-fit: contain;" alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $PREdata['name'] ?></h5>
                                        <p class="card-text">Starting Bid: RM <?php echo $PREdata['price'] ?></p>
                                        <p class="card-text"><?php echo $PREdata['price'] ?></p>
                                        <hr>
                                        <a href="productPage.php?pcpart=0&productID=<?php echo  $PREdata['id'] ?>" class="btn btn-primary" style="width:100%; background-color:#000000">Details</a>
                                    </div>
                                </div>
                            </div>
                        <?php }
                        ?>
                    </div>
                </div>
                <div class="col-sm-1">

                </div>
            </div>
        </div>
    </div>

    <div class="row" style="padding-top: 1vh; padding-bottom: 1vh;">
        <div class="col-1">

        </div>
        <div class="col-10 " style="height:auto; background-image: linear-gradient(to right, #1f2428 80%, #2c3037 )">
            <div class="col-12">
                <h2 style="color: #ffffff; text-align: center; padding-top: 5vh;">Auction</h2>

                <div class="input-group mb-3" style="padding-top: 3vh; padding-bottom: 3vh;">
                    <input class="form-control" id="searchAuction" type="text" placeholder="Search..">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">🔍</button>
                    </div>
                </div>
            </div>

            <div class="auction-container">
                <?php
                include_once "includes/dbh.local.inc.php";

                $sql = "SELECT * FROM auction ORDER BY 'start_date'";
                $stmt = mysqli_stmt_init($conn);

                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    echo "SQL statement failed!";
                } else {
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);

                    while ($row = mysqli_fetch_array($result)) {
                        echo '<a href="auctionDetailPage.php?idRetrieve=' . $row["id"] . '">
                        <img src="data:image/jpg;base64,' . base64_encode($row["image"]) . '" alt="Auction Image""/>
                        <h4 style="margin: 12px 30px 10px 30px;">' . $row["title"] . '</h4>
                        <p style="margin: 12px 30px 10px 30px;">Starting Bid: RM ' . number_format($row["starting_bid"], 2) . '</p>
                        <p style="margin: 12px 30px 10px 30px;">' . date("j/n/Y", strtotime($row["start_date"])) . ' - ' . date("j/n/Y", strtotime($row["end_date"])) . '</p>
                    </a>';
                    }
                }
                ?>
            </div>

        </div>
        <div class="col-1">

        </div>
    </div>

</body>

<!--footer-->
<?php require "includes/footer.php"; ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        $("#searchAuction").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#auctionList *").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });

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