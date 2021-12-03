<?php
session_start();

?>
<!DOCTYPE html>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta charset="utf-8" />

<head>
    <title>ComputerArc - Raffle</title>
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

        .hidescrollbar::-webkit-scrollbar {
            display: none;
        }


        html,
        body {
            height: 100%;
            font-family: "Questrial";
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
            display: block;
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
    include "checkRaffle.php";


    $queryloadRaffle = "SELECT * FROM raffle WHERE status = 1";

    $progress = 0;

    $executeRaffle = mysqli_query($conn, $queryloadRaffle);


    ?>
</head>

<body style="overflow:auto">

    <!--header-->
    <?php include "includes/header.php"; 
          
    ?>
    

    <div class="container-fluid" style="min-height: 70vh; margin-top:1vh; margin-bottom:2vh;">

        <?php
        
        if ($_SESSION['role'] == "member") {
            $email = $_SESSION['email'];

            $queryGetMemberData = "SELECT * FROM member WHERE email = '$email'";
            $executeGetMemberData = mysqli_query($conn, $queryGetMemberData);
            $getMemberData = mysqli_fetch_assoc($executeGetMemberData);
        ?>


            <button onclick="topFunction()" id="myBtn" title="Go to top"><i class='fas fa-angle-up' style='font-size:36px'></i></button>

            <div class="row" style="min-height:70vh">
                <div class="col-sm-1">

                </div>

                <div class="col-sm-10">
                    <h2 style="text-align:center">Raffle Ticket Avaialble: <label style='text-align:left;color:#1770ff'><?php echo $getMemberData['raffleTicket']  ?></label></h2>
                    <div class="row">
                        <?php
                        while ($data = mysqli_fetch_array($executeRaffle)) {
                            $progress = ($data['currentParticipant'] / $data['participant_num']) * 100;
                        ?>
                            <div class="col-sm-6">
                                <div class="card" style="width:100%; margin-bottom:1.5vh">
                                    <img class="card-img-top" src="data:image/jpg;base64,<?php echo base64_encode($data['image']) ?>" style="object-fit:contain; height:360px;" alt="Card image cap">
                                    <div class="card-body">
                                        <hr>

                                        <h5 class="card-title"><?php echo $data['name'] ?></h5>
                                        <p class="card-text"><b>Ticket Require:</b> <?php echo $data['ticket'] ?></p>
                                        <p class="card-text"><b>End Date:</b> <?php echo $data['end_date'] ?></p>
                                        <p class="card-text">Participant Capacity:</p>
                                        <div class="progress" style="margin-bottom:2vh">
                                            <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="<?php echo $progress ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $progress ?>%">

                                            </div>
                                        </div>
                                        <div class="card-footer text-center raffleID">
                                            <?php 
                                            $memberID = $getMemberData['id'];
                                            $raffleID = $data['id'];
                                            $queryCheckJoinedBefore = "SELECT * FROM raffle_detail WHERE memberJoined = '$memberID' AND raffleJoined = '$raffleID'";
                                            $executeCheckJoinedBefore = mysqli_query($conn,$queryCheckJoinedBefore);
                                            if(mysqli_num_rows($executeCheckJoinedBefore) >0){
                                                ?>
                                                <button class="btn btn-dark" disabled>Joined</button>
                                                <?php
                                            }else{
                                            ?>
                                        <input type="hidden" class="raffleIDd" value="<?php echo $data['id'] ?>" id="raffleID_<?php echo $data['id'] ?>">
                                            <button class="btn btn-primary" value="<?php echo $data['ticket'] ?>" onclick="joinRaffle(this)">Join Raffle</button>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>

                <div class="col-sm-1">

                </div>
            </div>
        <?php
        } else {
        ?>
            <div class="row">
                <div class="col-sm-3">

                </div>

                <div class="col-sm-6" style="padding-top:30vh;text-align:center">
                    <h2>To join raffle, a member role account is required.</h2>
                </div>

                <div class="col-sm-3">

                </div>
            </div>
        <?php
        }
        ?>
    </div>






    <!--footer-->
    <?php include 'includes/footer.php'; ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="SweetAlert/sweetalert2.min.js"></script>

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

<script>
    function joinRaffle(e) {
        var requireticket = $(e).val();
        var raffleJoined = $(e).closest('div').find('.raffleIDd').val();
        var availableTicket = <?php echo $getMemberData['raffleTicket'] ?>;
        var memberID = <?php echo $getMemberData['id'] ?>;
        if (availableTicket >= requireticket) {
            $.ajax({
                        type: "POST",
                        url: "raffle/processRaffle.php",
                        data: {
                            reqTicket: requireticket,
                            avaiTicket: availableTicket,
                            memberid : memberID,
                            raffleid : raffleJoined
                        },
                        success: function(x) {
                            var delay = 500;
                            console.log(x);
                            if (x == "Raffle Joined!") {
                                Swal.fire(x, '', 'success').then((result => {
                                    if (result.isConfirmed) {
                                        window.location.reload();
                                    } else {
                                        setTimeout(function() {
                                            window.location.reload();
                                        }, delay);
                                    }
                                }))

                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Something went wrong!',
                                    html: '<pre>' + x + '</pre>',
                                    customClass: {
                                        popup: 'format-pre'
                                    }
                                })
                            }
                        }
                    });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Insufficient Raffle Ticket',
                customClass: {
                    popup: 'format-pre'
                }
            })
        }


    }
</script>



</html>