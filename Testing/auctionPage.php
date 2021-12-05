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
            color: #000000;
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

        h5 {
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
include "includes/dbh.local.inc.php";
$querySort = "SELECT * FROM auction WHERE status = 1 OR status = 3 OR status = 4";
$querySortName = "SELECT * FROM auction WHERE status = 1 OR status = 3  OR status = 4 ORDER BY title ASC";
$querySortDate = "SELECT * FROM auction WHERE status = 1 OR status = 3  OR status = 4 ORDER BY start_date ASC";
$querySortPrice = "SELECT * FROM auction WHERE status = 1 OR status = 3 OR status = 4 ORDER BY starting_bid ASC";

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
                <label style="color:#b5b0aa; font-family: 'Questrial'; margin-left:5vw; font-size: 1.5vw;">Auction</label>
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
                    <a class='nav-link nav-item' href='auctionPage.php?sort=all' <?php echo $option1 ?>>Reset Sort</a>
                    <a class='nav-link nav-item' href='auctionPage.php?sort=name' <?php echo $option2 ?>>Sort by Name</a>
                    <a class='nav-link nav-item' href='auctionPage.php?sort=date' <?php echo $option3 ?>>Sort by Date</a>
                    <a class='nav-link nav-item' href='auctionPage.php?sort=price' <?php echo $option4 ?>>Sort by Price</a>
                </nav>
            </div>

            <div class="col-sm-10" style="overflow-y:auto;max-height:83vh">
                <div class="col-sm-1">
                </div>

                <div class="col-sm-10">
                    <div class="row">
                        <?php
                        if (isset($_GET)) {
                            if ($sortBy == "all") {
                                $executeSort = mysqli_query($conn, $querySort);
                            } else if ($sortBy == "name") {
                                $executeSort = mysqli_query($conn, $querySortName);
                            } else if ($sortBy == "date") {
                                $executeSort = mysqli_query($conn, $querySortDate);
                            } else if ($sortBy == "price") {
                                $executeSort = mysqli_query($conn, $querySortPrice);
                            }
                        }
                        while ($row = mysqli_fetch_array($executeSort)) {
                        ?>
                            <div class="col-sm-4">
                                <div class="card" style="margin:1vw;">
                                    <img class="card-img-top img-responsive" src="data:image/jpg;base64,<?php echo base64_encode($row['image']) ?>" height="180px" width="180px" style="object-fit: contain;" alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $row['title'] ?></h5>
                                        <p class="card-text">Starting Bid: RM <?php echo $row['starting_bid'] ?></p>
                                        <p class="card-text"><?php echo date("j/n/Y", strtotime($row["start_date"])) . ' - ' . date("j/n/Y", strtotime($row["end_date"])) ?></p>
                                        <hr>
                                        <a href="auctionDetailPage.php?idRetrieve=<?php echo  $row['id'] ?>" class="btn btn-primary" style="width:100%; background-color:#000000">Details</a>
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