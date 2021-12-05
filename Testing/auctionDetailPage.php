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

        .img-magnifier-container {
            position: relative;
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

        table {
            text-align: center;
        }

        #countdown,
        label {
            margin: 20px 0px 0px 70px;
            font-family: "Questrial";
            font-size: larger;
        }
    </style>

    <!--header-->
    <?php require "includes/header.php";
    require "auction/auction-status.php";
    require "auction/auction-retrieve.php"; ?>
    <script>
        function magnify(imgID, zoom) {
            var img, glass, w, h, bw;
            img = document.getElementById(imgID);
            /*create magnifier glass:*/
            glass = document.createElement("DIV");
            glass.setAttribute("class", "img-magnifier-glass");
            /*insert magnifier glass:*/
            img.parentElement.insertBefore(glass, img);
            /*set background properties for the magnifier glass:*/
            glass.style.backgroundImage = "url('" + img.src + "')";
            glass.style.backgroundRepeat = "no-repeat";
            glass.style.backgroundSize = (img.width * zoom) + "px " + (img.height * zoom) + "px";
            bw = 3;
            w = glass.offsetWidth / 2;
            h = glass.offsetHeight / 2;
            /*execute a function when someone moves the magnifier glass over the image:*/
            glass.addEventListener("mousemove", moveMagnifier);
            img.addEventListener("mousemove", moveMagnifier);
            /*and also for touch screens:*/
            glass.addEventListener("touchmove", moveMagnifier);
            img.addEventListener("touchmove", moveMagnifier);

            function moveMagnifier(e) {
                var pos, x, y;
                /*prevent any other actions that may occur when moving over the image*/
                e.preventDefault();
                /*get the cursor's x and y positions:*/
                pos = getCursorPos(e);
                x = pos.x;
                y = pos.y;
                /*prevent the magnifier glass from being positioned outside the image:*/
                if (x > img.width - (w / zoom)) {
                    x = img.width - (w / zoom);
                }
                if (x < w / zoom) {
                    x = w / zoom;
                }
                if (y > img.height - (h / zoom)) {
                    y = img.height - (h / zoom);
                }
                if (y < h / zoom) {
                    y = h / zoom;
                }
                /*set the position of the magnifier glass:*/
                glass.style.left = (x - w) + "px";
                glass.style.top = (y - h) + "px";
                /*display what the magnifier glass "sees":*/
                glass.style.backgroundPosition = "-" + ((x * zoom) - w + bw) + "px -" + ((y * zoom) - h + bw) + "px";
            }

            function getCursorPos(e) {
                var a, x = 0,
                    y = 0;
                e = e || window.event;
                /*get the x and y positions of the image:*/
                a = img.getBoundingClientRect();
                /*calculate the cursor's x and y coordinates, relative to the image:*/
                x = e.pageX - a.left;
                y = e.pageY - a.top;
                /*consider any page scrolling:*/
                x = x - window.pageXOffset;
                y = y - window.pageYOffset;
                return {
                    x: x,
                    y: y
                };
            }
        }
    </script>

    <script>
        // Set the date we're counting down to
        var countDownDate = new Date("<?php echo $countDownDateTime ?>").getTime();

        // Update the count down every 1 second
        var x = setInterval(function() {

            // Get today's date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Output the result in an element with id="demo"
            document.getElementById("countdown").innerHTML = days + "d " + hours + "h " +
                minutes + "m " + seconds + "s ";

            // If the count down is over, write some text 
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("countdown").innerHTML = "00:00:00";
            }
        }, 1000);
    </script>

</head>

<body>

    <?php
    $aucID = $_GET['idRetrieve'];
    if (!empty($_SESSION['role'])) {
        if ($_SESSION['role'] == "member") {
            $MemberEmail   = $_SESSION['email'];
            $MemberEmail    = mysqli_query($conn, "SELECT * FROM `member` WHERE email ='$MemberEmail'");

            if (mysqli_num_rows($MemberEmail) > 0) {
                $Getresult = mysqli_fetch_assoc($MemberEmail);
                $GetBidderID = $Getresult['id'];
            }

            //Check if member has already deposit or not
            $getAucData = "SELECT * FROM deposit WHERE auctionID = '$aucID' AND bidder = '$GetBidderID'";

            $connGetBidderData = mysqli_query($conn, $getAucData);
        }
    }
    $getBidData = "SELECT * FROM auction_detail auc INNER JOIN member mem ON auc.participant_id = mem.id 
    WHERE auc.auctionID = '$aucID' ORDER BY auc.amount_bid DESC LIMIT 3";
    $getHighestBidData = "SELECT MAX(amount_bid) FROM auction_detail WHERE auctionID = '$aucID'";

    $getWinnerData = "SELECT * FROM auction_detail auc INNER JOIN member mem ON auc.participant_id = mem.id 
    WHERE auc.auctionID = '$aucID' ORDER BY auc.amount_bid DESC LIMIT 1";

    $connGetHighestBid = mysqli_query($conn, $getHighestBidData);
    $connGetTopBid     = mysqli_query($conn, $getBidData);
    $conngetWinnerData = mysqli_query($conn, $getWinnerData);

    //Get highest Bidding Price
    $highestBid = 0.00;
    $highestBid = mysqli_fetch_array($connGetHighestBid);

    if (empty($highestBid["MAX(amount_bid)"])) {
        $highestBid = $resultGetData["starting_bid"];
        $bid = false;
    } else {
        $highestBid = $highestBid["MAX(amount_bid)"];
        $bid = true;
    } ?>

    <!--Content after here-->
    <div class="container">
        <div class="row shadow p-4 mb-4 bg-white">
            <div class="col-7">
                <div class="col-sm-7" class="img-magnifier-container">
                    <img class="img-responsive" src="<?php echo 'data:image/jpg;base64,' . base64_encode($resultGetData['image']) . '' ?>" height="512px" width="512px" style="object-fit: contain;" alt="Card image cap" id="auctionImage">

                    <?php if ($resultGetData["status"] == 3 || $resultGetData["status"] == 4) { ?>
                        <b><label for="countdown">Countdown</label></b>
                        <p style="margin-top: 10px;" id="countdown"></p>
                    <?php } ?>

                    <?php //Display Auction Winner 
                    if ($resultGetData["status"] == 4) {
                        $winnerData = mysqli_fetch_array($conngetWinnerData);
                        if (empty($_SESSION['emailSent'])) {
                            include "auction/notifyWinner.php";
                        }
                        if ($_SESSION['emailSent'] == $resultGetData["id"]) {
                            if (empty($_SESSION['aucPaid'])) { ?>
                                <b><label>Winner</label></b>
                                <p style="margin-top: 10px;" id="countdown"><?php echo  $winnerData["name"] ?></p>

                                <?php if (!empty($GetBidderID)) {
                                    if ($winnerData["participant_id"] == $GetBidderID) { ?>
                                        <button type='button' class='btn btn-primary mt-3' style="margin-left:70px;" onclick="claimReward()">Claim Reward</button>
                    <?php }
                                }
                            }
                        }
                    } ?>
                </div>
            </div>
            <div class="col-5">
                <div style="margin-bottom: 1.25rem">
                    <h2 style="margin-bottom: 3vh"><?php echo  $resultGetData["title"] ?></h2>
                    <p style="font-weight: bold; font-size: 20px">Auction Duration:</p>
                    <p style="font-size: 20px; margin-bottom: 2vh"><?php echo date("j/n/Y", strtotime($resultGetData["start_date"])) ?> - <?php echo date("j/n/Y H:m", strtotime($resultGetData["end_date"])) ?></p>

                    <?php if ($bid == true) { ?>

                        <label style="font-weight: bold; font-size: 20px">Starting Bid:</label>
                        <label style="font-size: 20px" id="startingBid">RM <?php echo $resultGetData["starting_bid"] ?></label> <br>

                        <label style="font-weight: bold; font-size: 20px">Highest Bid :</label>
                        <label style="font-size: 20px" id="amountBid">RM <?php echo $highestBid ?></label>

                    <?php } else { ?>
                        <label style="font-weight: bold; font-size: 20px">Starting Bid:</label>
                        <label style="font-size: 20px" id="startingBid">RM <?php echo $resultGetData["starting_bid"] ?></label>

                    <?php } ?>
                    <p style="color: gray;">_________________________________________________________________</p>
                </div>

                <?php include "auction/auction-option.php"; ?>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-8 shadow p-4 mb-4 bg-white" style="padding:0px">
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
            <div class="col-4 shadow p-4 mb-4 bg-white">
                <h3 style="text-align: center;"><u>Advertisement</u></h3>
                <?php include "advertisement/displayAdvertisement.php"; ?>
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

<script>
    function claimReward() {
        var auctionId = '<?php echo $resultGetData["id"] ?>';
        var highestBid = '<?php echo $highestBid ?>';
        const url = new URL('http://localhost/FYP--ComputerArc/Testing/winnerPage.php')

        url.searchParams.set('highestBid', highestBid);
        url.searchParams.set('auctionID', auctionId);

        window.location.href = url;
    }
</script>

<script>
    function deposit() {
        var auctionId = '<?php echo $resultGetData["id"] ?>';
        var startingBid = '<?php echo $resultGetData["starting_bid"] ?>';
        var deposit = Math.round((startingBid * 0.10) * 100) / 100;
        const url = new URL('http://localhost/FYP--ComputerArc/Testing/auctionDeposit.php')

        url.searchParams.set('deposit', deposit);
        url.searchParams.set('auctionID', auctionId);

        window.location.href = url;
    }
</script>

<script>
    function bidding(e) {
        var id = $(e).attr('id');
        var _bidAmount = $("#bidAmount").val();
        var _highestBid = <?php echo $highestBid ?>;

        Swal.fire({
            title: "Are you sure you want to bid this amount?",
            text: "RM " + _bidAmount,
            showCancelButton: true,
            confirmButtonText: 'Yes',
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    type: "POST",
                    url: "auction/auction-bidding.php",
                    data: {
                        idAUCBid: id,
                        bidAmount: _bidAmount,
                        highestBid: _highestBid
                    },
                    success: function(result) {
                        var delay = 500
                        if (result == "Your bid has been accepted") {
                            Swal.fire(result, '', 'success').then((result => {
                                if (result.isConfirmed) {
                                    location.reload();
                                } else {
                                    setTimeout(function() {
                                        location.reload();
                                    }, delay);
                                }
                            }))
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: result,
                            })
                        }
                    }
                });
            }
        })
    }
</script>

<script>
    function approvedApp(e) {
        var id = $(e).attr('id');
        Swal.fire({
            title: 'Are you sure you want to approved this Approval?',
            showCancelButton: true,
            confirmButtonText: 'Yes',
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    type: "POST",
                    url: "admin/approveApproval.php",
                    data: {
                        idAUCApprove: id
                    },
                    success: function(result) {
                        var delay = 500

                        Swal.fire(result, '', 'success').then((result => {
                            if (result.isConfirmed) {
                                window.location = "profilePage.php?editProf=0&reviewUser=0&reviewApp=1";
                            } else {
                                setTimeout(function() {
                                    window.location = "profilePage.php?editProf=0&reviewUser=0&reviewApp=1";
                                }, delay);
                            }
                        }))
                    }
                });
            }
        })
    }

    function rejectApp(e) {
        var id = $(e).attr('id');
        var _feedback = $("#feedback").val();
        Swal.fire({
            title: 'Are you sure you want to reject this Approval?',
            showCancelButton: true,
            confirmButtonText: 'Yes',
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    type: "POST",
                    url: "admin/rejectApproval.php",
                    data: {
                        idAUCReject: id,
                        feedback: _feedback
                    },
                    success: function(result) {
                        var delay = 500
                        if (result == "Approval has been Rejected") {
                            Swal.fire(result, '', 'success').then((result => {
                                if (result.isConfirmed) {
                                    window.location = "profilePage.php?editProf=0&reviewUser=0&reviewApp=1";
                                } else {
                                    setTimeout(function() {
                                        window.location = "profilePage.php?editProf=0&reviewUser=0&reviewApp=1";
                                    }, delay);
                                }
                            }))
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: result,
                            })
                        }
                    }
                });
            }
        })
    }
</script>

</html>