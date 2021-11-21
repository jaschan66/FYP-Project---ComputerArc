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
        body {
            overflow-x: hidden;
            overflow-y: scroll;
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
            color: #b5b0aa;
        }

        a {
            font-family: "Questrial";
            font-size: larger;
        }

        h2 {
            font-family: "Questrial";
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
    </style>

</head>

<body>
    <!--header-->
    <?php require "includes/header.php"; ?>

    <div class="row" style="padding-top: 1vh;">
        <div class="col-1">

        </div>
        <div class="col-10 " style="height: 100vh; background-image: linear-gradient(to right, #1f2428 80%, #2c3037 )">
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
                        echo '<a href="auctionDetailPage.php?idRetrieve='.$row["id"].'">
                        <img src="data:image/jpg;base64,' . base64_encode($row["image"]) . '" alt="Auction Image""/>
                        <h4 style="margin: 12px 0px 10px 30px;">' . $row["title"] . '</h4>
                        <p style="margin: 12px 0px 10px 30px;">Starting Bid: RM ' . number_format($row["starting_bid"], 2) . '</p>
                        <p style="margin: 12px 0px 10px 30px;">' . date("j/n/Y", strtotime($row["start_date"])) . ' - ' . date("j/n/Y", strtotime($row["end_date"])) . '</p>
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
</script>

</html>