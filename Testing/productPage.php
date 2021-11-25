<?php session_start(); ?>
<!DOCTYPE html>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta charset=" utf-8" />


<head>
    <title>ComputerArc</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <link rel="icon" href="Logo stuff\favicon-32x32.png" type="image/x-icon">
    <link href='https://fonts.googleapis.com/css?family=Questrial' rel='stylesheet'>

    <link href='SweetAlert/sweetalert2.min.css' rel='stylesheet'>
    <script src="SweetAlert/sweetalert2.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <style>
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
    </style>

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


    <?php

    if (empty($_SESSION['email']) && empty($_SESSION['role'])) {
        header("Location: homePage.php");
    }

    include "includes/dbh.inc.php";
    $productID = $_GET['productID'];
    $isPCP = $_GET['pcpart'];
    $logonEmail = $_SESSION['email'];
    $logonRole = $_SESSION['role'];





    if ($isPCP == 0) {
        $querygetProduct = "SELECT * FROM prebuildpc WHERE id = '$productID'";
        $getProductData = mysqli_query($conn, $querygetProduct);
        $productData = mysqli_fetch_assoc($getProductData);
        $productType = "prebuildpc";
    } else if ($isPCP == 1) {
        $querygetProduct = "SELECT * FROM pcpart WHERE id = '$productID'";
        $getProductData = mysqli_query($conn, $querygetProduct);
        $productData = mysqli_fetch_assoc($getProductData);
        $productType = "pcpart";
    }

    if (isset($_POST['updateStockCount'])) {
        $updateStockNumber = $_POST['Productupdatestock'];

        $queryUpdateStock = "UPDATE $productType SET stock = '$updateStockNumber' WHERE id = '$productID'";
        if (mysqli_query($conn, $queryUpdateStock)) {
            echo "<meta http-equiv='refresh' content='0'>";
        }
    }

    ?>

<body>


    <?php
    include("includes/header.php"); ?>


    <!--Content after here-->
    <div class="container">
        <div class="row">
            <div class="col-sm-7" class="img-magnifier-container">
                <img class="img-responsive" src="<?php echo 'data:image/jpg;base64,' . base64_encode($productData['image']) . '' ?>" height="512px" width="512px" style="object-fit: contain;" alt="Card image cap" id="productIMG">
            </div>
            <div class="col-sm-5">

                <h2></h2>

                <p style="font-size: 28px"><?php echo $productData['name'] ?></p>
                <p style="font-size: 20px">RM <?php echo $productData['price'] ?></p>
                <p style="font-size: 16px">Stock Left: <?php echo $productData['stock'] ?></p>
                <p style="color: gray;">_________________________________________________________________</p>


                <div class="row" style="padding-bottom: 2vh;">
                    <?php
                    if ($logonRole == "partner") {
                        $querygetID = "SELECT id FROM partner WHERE email = '$logonEmail'";
                        $getID = mysqli_query($conn, $querygetID);
                        $ID = mysqli_fetch_assoc($getID);
                    } else if ($logonRole == "member") {
                        $querygetID = "SELECT id FROM member WHERE email = '$logonEmail'";
                        $getID = mysqli_query($conn, $querygetID);
                        $ID = mysqli_fetch_assoc($getID);
                    } else if ($logonRole == "admin") {
                        $querygetID = "SELECT id FROM admin WHERE email = '$logonEmail'";
                        $getID = mysqli_query($conn, $querygetID);
                        $ID = mysqli_fetch_assoc($getID);
                    }
                    if ($productData['seller'] == $ID['id'] && $logonRole == "partner") {
                        echo "<form method='POST' enctype='multipart/form-data' style='width:100%'>
                        <div class='col-sm-12' style='margin-bottom:1vh'>
                        <input type='number' pattern='[0-9]+' required placeholder='e.g. 10' class='form-control' name='Productupdatestock' value='" . $productData['stock'] . "' style='text-align:center'>
                            </div>
                        <div class='col-sm-12'>
                        <input type='submit' class='btn btn-dark' name='updateStockCount' style='width: 100%;' value='Update Stock'>
                         </div>
                         </form>";
                    } else if ($logonRole == "member" && $productData['stock'] > 0) { ?>
                        <div class='col-sm-12' style='margin-bottom:1vh;padding:0'>
                            <input type='hidden' value='<?php echo $productData['id'] ?>' id='currentProductID'>
                            <input type='hidden' value='<?php echo $productType ?>' id='currentProductType'>
                            <input type='number' pattern='[0-9]+' required value='1' class='form-control' id='ProductPurchasestock' name='ProductPurchasestock' style='text-align:center' min='1' max='3'>
                        </div>
                        <a href='#terms' class='btn btn-outline-dark btn-block border-2 ' data-toggle='collapse' style='text-align: left;margin-bottom:1vh'>Raffle Ticket</a>
                        <div id='terms' class='collapse' style='text-align: left;'>
                            By purchasing item over RM200, you'll be rewarded with a ticket that's eligible for you to join raffle and stand a chance to win awesome reward!
                        </div>
                        <button type='button' onclick='tocheckout()' class='btn btn-dark' style='width:40%;margin-right:2vw;margin-left:1vw;'>Buy Now</button>
                        <?php if ($isPCP == 0) { ?>
                            <buttton class='btn btn-danger' style='width: 40%;' onclick="wishPRE(this)" id="<?php echo $productData["id"] ?>">Add to Wishlist</buttton>

                        <?php } else if ($isPCP == 1) { ?>
                            <buttton class='btn btn-danger' style='width: 40%;' onclick="wishPCP(this)" id="<?php echo $productData["id"] ?>">Add to Wishlist</buttton>

                        <?php } ?>
                        <div class='col-sm-12'>

                        </div>
                    <?php } else if ($logonRole == "member" && $productData['stock'] <= 0) { ?>
                        <div class='col-sm-12'>
                            <buttton class='btn btn-dark' style='width: 40%;margin-right:2vw;margin-left:1vw;'>Out of stock</buttton>
                            <?php if ($isPCP == 0) { ?>
                                <buttton class='btn btn-danger' style='width: 40%;' onclick="wishPRE(this)" id="<?php echo $productData["id"] ?>">Add to Wishlist</buttton>

                            <?php } else if ($isPCP == 1) { ?>
                                <buttton class='btn btn-danger' style='width: 40%;' onclick="wishPCP(this)" id="<?php echo $productData["id"] ?>">Add to Wishlist</buttton>

                            <?php } ?>
                        </div>

                        <?php } else if ($_SESSION['role'] == "admin") {
                        if ($isPCP == 0) { ?>
                            <button type="button" class='btn btn-dark' style='width: 40%;margin-right:2vw;margin-left:1vw;' onclick="approvedPREApp(this)" id="<?php echo $productData["id"] ?>">Approved</button>
                            <button type="button" class='btn btn-danger' style='width: 40%;' onclick="rejectPREApp(this)" id="<?php echo $productData["id"] ?>">Reject</button>
                        <?php } else if ($isPCP == 1) {  ?>
                            <button type="button" class='btn btn-dark' style='width: 40%;margin-right:2vw;margin-left:1vw;' onclick="approvedPCPApp(this)" id="<?php echo $productData["id"] ?>">Approved</button>
                            <button type="button" class='btn btn-danger' style='width: 40%;' onclick="rejectPCPApp(this)" id="<?php echo $productData["id"] ?>">Reject</button>
                    <?php }
                    } else {
                        echo "<div class='col-sm-12'>
                        <buttton class='btn btn-dark' style='width: 100%;text-align:left'>Unable to purchase with Partner account</buttton>
                         </div>";
                    }

                    ?>

                </div>



            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-sm-12" style="padding:0px">
                <h4><u>Description</u></h4>
                <p style="text-align:Left; width:auto;">
                    <?php echo $productData['description'] ?>
                </p>
            </div>
        </div>

    </div>
    </div>
    </div>
    </div>
    <!--Content ends here-->
    <?php include 'includes/footer.php'; ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script>
        /* Initiate Magnify Function
with the id of the image, and the strength of the magnifier glass:*/
        magnify("productIMG", 1.5);
    </script>

    <script>
        function tocheckout() {

            var productId = document.getElementById("currentProductID").value;
            var quantity = document.getElementById("ProductPurchasestock").value;
            var type = document.getElementById("currentProductType").value;
            const url = new URL('http://localhost/FYP--ComputerArc/Testing/checkoutPage.php')
            // url.searchParams has several function, we just use set function
            // to set a value, if you just want to append without replacing value
            // let use append function

            url.searchParams.set('qty', quantity);
            url.searchParams.set('productID', productId);
            url.searchParams.set('productType', type);

            if (quantity <= <?= $productData['stock'] ?>) {
                window.location.href = url;
            } else {
                window.alert("Purchase quantity exceed stock quantity.");
            }


            // if window.location.href has already some qs params this set function
            // modify or append key/value in it
        }
    </script>

    <script>
        //Wishlist Pre-Build PC
        function wishPRE(e) {
            var id = $(e).attr('id');
            $.ajax({
                type: "POST",
                url: "wishlist/wishlist-insert.php",
                data: {
                    wishPRE: id
                },
                success: function(result) {
                    var delay = 500
                    if (result == "Item added to wishlist") {
                        Swal.fire(result, '', 'success').then((result => {
                            if (result.isConfirmed) {
                                window.location.reload();
                            } else {
                                setTimeout(function() {
                                    window.location.reload();
                                }, delay);
                            }
                        }))
                    } else if (result == "Item removed from wishlist") {
                        Swal.fire(result, '', 'success').then((result => {
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
                            html: '<pre>' + result + '</pre>',
                            customClass: {
                                popup: 'format-pre'
                            }
                        })
                    }
                }
            });
        }

        //Wishlist Pre-Build PC
        function wishPCP(e) {
            var id = $(e).attr('id');
            $.ajax({
                type: "POST",
                url: "wishlist/wishlist-insert.php",
                data: {
                    wishPCP: id
                },
                success: function(result) {
                    var delay = 500
                    if (result == "Item added to wishlist") {
                        Swal.fire(result, '', 'success').then((result => {
                            if (result.isConfirmed) {
                                window.location.reload();
                            } else {
                                setTimeout(function() {
                                    window.location.reload();
                                }, delay);
                            }
                        }))
                    } else if (result == "Item removed from wishlist") {
                        Swal.fire(result, '', 'success').then((result => {
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
                            html: '<pre>' + result + '</pre>',
                            customClass: {
                                popup: 'format-pre'
                            }
                        })
                    }
                }
            });
        }

        //Approve Pre-Build PC
        function approvedPREApp(e) {
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
                            idPREApprove: id
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

        //Reject Pre-Build PC
        function rejectPREApp(e) {
            var id = $(e).attr('id');
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
                            idPREReject: id
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

        //Approve PC-part
        function approvedPCPApp(e) {
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
                            idPCPApprove: id
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

        //Reject PC-part
        function rejectPCPApp(e) {
            var id = $(e).attr('id');
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
                            idPCPReject: id
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
    </script>

</body>

</html>