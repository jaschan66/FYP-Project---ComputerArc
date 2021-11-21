<?php
session_start();
?>
<!DOCTYPE html>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta charset="utf-8" />

<head>
    <title>ComputerArc - Profile Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <link rel="icon" href="Logo stuff\favicon-32x32.png" type="image/x-icon">
    <link href='https://fonts.googleapis.com/css?family=Questrial' rel='stylesheet'>

    <link href='filepond/filepond.min.css' rel='stylesheet'>
    <link href='filepond/plugins/preview/filepond-plugin-image-preview.min.css' rel='stylesheet'>
    <link href='SweetAlert/sweetalert2.min.css' rel='stylesheet'>
    <style>
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
    $msg = "";
        if(empty($_SESSION['email']) && empty($_SESSION['role'])){
            header("Location: homePage.php");
        }


    $email = $_SESSION['email'];
    $role = $_SESSION['role'];


    // For edit Profile (Partner Ver)
    if (isset($_POST) && isset($_POST['btnSubmitEditProf'])) {

        $description = $_POST['description'];
        $telNo = $_POST['telNo'];
        $faxNo = $_POST['faxNo'];



        if ($_POST['telNo'] != "" && $_POST['faxNo'] != "") {

            $queryWithPicture = "";
            if ($_FILES['profilepic']['size'] > 0) {
                $ProfilePic = addslashes(file_get_contents($_FILES['profilepic']['tmp_name']));
                $queryWithPicture = ", profilepic = '$ProfilePic'";
            }

            $query = "UPDATE $role SET description = '$description', telNo = '$telNo', faxNo = '$faxNo' $queryWithPicture WHERE email = '$email'";

            if (mysqli_query($conn, $query)) {
                $msg = "<div class='alert alert-dark alert-dismissible' role='alert'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Success!</strong> Your profile are looking fresh and good.
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span>
                </button>
              </div>";
            } else {
                $msg = "<div class='alert alert-danger alert-dismissible' role='alert'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Oh No!</strong> Something went wrong when editing your profile, please try again later.
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span>
                </button>
              </div>";
                echo mysqli_error($conn);
            }
        }
    }

    // For Create PRE
    if (isset($_POST) && isset($_POST['btnSubmitCreatePRE'])) {
        $PREPrice       = $_POST['PREprice'];
        $PRECategory    = $_POST['PREcategory'];
        $PREName        = $_POST['PREname'];
        $PREDesc        = $_POST['PREdesc'];
        $PREStock       = $_POST['PREstock'];
        $PREImage       = addslashes(file_get_contents($_FILES['PREpic']['tmp_name']));
        $PREStatus      = 2;

        $resultPREID    = mysqli_query($conn, "SELECT * FROM `$role` WHERE email ='$email'");

        if (mysqli_num_rows($resultPREID) > 0) {
            $PREIDResult = mysqli_fetch_assoc($resultPREID);
            $PREID = $PREIDResult['id'];
        }


        $InsertPRE = "INSERT INTO `prebuildpc` (`price`, `category`, `name`, `description`, `stock`, `image`, `status`, `seller`) VALUES ('$PREPrice', '$PRECategory', '$PREName', '$PREDesc', '$PREStock', '$PREImage', '$PREStatus', '$PREID')";

        if (mysqli_query($conn, $InsertPRE)) {
            $msg = "<div class='alert alert-dark alert-dismissible' role='alert'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Success!</strong> Your submission are now pending approval from admin.
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span>
                </button>
              </div>";
        } else {
            $msg = "<div class='alert alert-danger alert-dismissible' role='alert'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <strong>Oh No!</strong> Something went wrong when publishing the pre-build pc, please try again later.
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
            </button>
          </div>";
        }
    }

    $result = mysqli_query($conn, "SELECT * FROM `$role` WHERE email ='$email'");
    $resultimg = mysqli_query($conn, "SELECT profilepic FROM `$role` WHERE email ='$email'");

    if (mysqli_num_rows($result) > 0) {
        $name = mysqli_fetch_assoc($result);
    }


    ?>
</head>

<body>

    <!--header-->
    <?php include "includes/header.php"; ?>

    <div class="container-fluid">
        <!--top of profile page-->
        <div class="row" style="height: auto; border-bottom-style: solid;">
            <div class="col-12">
                <?php

                echo $msg;
                ?>
            </div>
            <!--profile picture-->
            <div class="col-2" style="padding-left: 10vw">

                <?php

                while ($img = mysqli_fetch_array($resultimg)) {
                    echo '<img src="data:image/jpg;base64,' . base64_encode($img['profilepic']) . '" height="180px" width="180px" alt="Profile Picture" class="img-thumbnail img-responsive"/>';
                }

                ?>
            </div>

            <!--name and etc-->
            <div class="col-10">
                <p style="color:#000000; font-family: 'Questrial'; text-align: left; font-size: 2.5vw;"><?php echo $name['name']; ?></p>
                <hr>
                <p style="color:#b5b0aa; font-family: 'Questrial'; text-align: left; font-size: 1.5vw;">
                    <?php
                    if ($name['description'] == null) {
                        echo "Tell us more about yourself <a href='#' style='font-size: 1.5vw; color:#54524f' role='button'>here</a>";
                    } else {
                        echo $name['description'];
                    } ?>
                </p>
            </div>
        </div>

        <button onclick="topFunction()" id="myBtn" title="Go to top"><i class='fas fa-angle-up' style='font-size:36px'></i></button>

        <div class="row" style="min-height: 50vh; margin-top:1vh; margin-bottom:2vh;">
            <div class="col-2" style=" border-right-style: solid;">
                <!--Based on the role change the sidebar menu-->
                <?php
                if ($role == "member") {
                    include "ProfilePage/memberSideBar.php";
                } else if ($role == "partner") {
                    include "ProfilePage/partnerSideBar.php";
                } else {
                    //include "ProfilePage/adminSideBar.php";
                }
                ?>

            </div>

            <div class="col-10">
                <!--Based on side menu bar change its content-->
                <div class="col-1">

                </div>

                <div class="col-10">
                    <?php

                    //Partner Pages
                if ($_SESSION['role'] == "partner") {
                    if ($_GET['editProf'] == 1) {
                        include "ProfilePage/editPartnerProf.php";
                    } else if ($_GET['editPRE'] == 1) {
                        include "ProfilePage/mainPartnerPRE.php";
                    } else if ($_GET['editPRE'] == 2) {
                        include "ProfilePage/editPartnerPRE.php";
                    } else if ($_GET['editPRE'] == 3) {
                        include "ProfilePage/updatePRE.php";
                    } else if ($_GET['editPCP'] == 1) {
                        include "ProfilePage/mainPartnerPart.php";
                    } else if ($_GET['editPCP'] == 2) {
                        include "ProfilePage/editPartnerPCP.php";
                    } else if ($_GET['editPCP'] == 3) {
                        include "ProfilePage/updatePCP.php";
                    } else if ($_GET['editAuc'] == 1) {
                        include "auction/mainPartnerAuction.php";
                    } else if ($_GET['editAuc'] == 2) {
                        include "auction/editPartnerAuction.php";
                    } else if ($_GET['editAuc'] == 3) {
                        include "auction/updateAuction.php";
                    }
                } 
                else if ($_SESSION['role'] == "member") {
                    //Member Pages
                    if ($_GET['editProf'] == 1) {
                        include "ProfilePage/editMemberProf.php";
                    } 
                }
                ?>


                </div>

                <div class="col-1">

                </div>
            </div>

        </div>




    </div>

    <!--footer-->
    <?php include 'includes/footer.php'; ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="SweetAlert/sweetalert2.min.js"></script>

    <script src="filepond/filepond.min.js"></script>
    <script src="filepond/filepond.jquery.js"></script>
    <script src="filepond/plugins/preview/filepond-plugin-image-preview.min.js"></script>

    <!-- <script src="filepond/plugins/validate-size/filepond-plugin-file-validate-size.js"></script>
    <script src="filepond/plugins/validate-type/filepond-plugin-file-validate-type.js"></script> -->

    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>


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
<?php
if ($_GET['editProf'] == 1 && $_SESSION['role'] == "partner") {
    echo "<script>
        $(document).ready(function() {
           FilePond.registerPlugin(FilePondPluginImagePreview);
           const inputElement = document.querySelector('#profilepic');

           const pond = FilePond.create(inputElement, {
               storeAsFile: true
           });

          $('[data-toggle=\"tooltip\"]').tooltip();
       });
  </script>";
} else if ($_GET['editPRE'] == 1 && $_SESSION['role'] == "partner") {
    echo "<script>
   $(document).ready(function() {
       FilePond.registerPlugin(FilePondPluginImagePreview);
       const inputElement = document.querySelector('#PREpic');

       const pond = FilePond.create(inputElement, {
           storeAsFile: true
       });

      $('[data-toggle=\"tooltip\"]').tooltip();
  });
</script>";
} else if ($_GET['editPRE'] == 3 && $_SESSION['role'] == "partner") {
    echo "<script>
    $(document).ready(function() {
        FilePond.registerPlugin(FilePondPluginImagePreview);
        const inputElement = document.querySelector('#updatePREpic');
 
        const pond = FilePond.create(inputElement, {
            storeAsFile: true
        });
 
       $('[data-toggle=\"tooltip\"]').tooltip();
   });
 </script>";
} else if ($_GET['editAuc'] == 2 && $_SESSION['role'] == "partner") {
    echo "<script>
   $(document).ready(function() {
       FilePond.registerPlugin(FilePondPluginImagePreview);

       const inputElement = document.querySelector('#auctionImage');

       const pond = FilePond.create(inputElement, {
           storeAsFile: true
       });

      $('[data-toggle=\"tooltip\"]').tooltip();
  });
</script>";
} else if ($_GET['editAuc'] == 3 && $_SESSION['role'] == "partner") {
    echo "<script>
   $(document).ready(function() {
       FilePond.registerPlugin(FilePondPluginImagePreview);

       const inputElement = document.querySelector('#updateAucImage');

       const pond = FilePond.create(inputElement, {
           storeAsFile: true
       });

      $('[data-toggle=\"tooltip\"]').tooltip();
  });
</script>";
} else if ($_GET['editPCP'] == 2 && $_SESSION['role'] == "partner") {
    echo "<script>
   $(document).ready(function() {
       FilePond.registerPlugin(FilePondPluginImagePreview);
       const inputElement = document.querySelector('#PCPpic');

       const pond = FilePond.create(inputElement, {
           storeAsFile: true
       });

      $('[data-toggle=\"tooltip\"]').tooltip();
  });
</script>";
} else if ($_GET['editPCP'] == 3 && $_SESSION['role'] == "partner") {
    echo "<script>
   $(document).ready(function() {
       FilePond.registerPlugin(FilePondPluginImagePreview);
       const inputElement = document.querySelector('#updatePCPpic');

       const pond = FilePond.create(inputElement, {
           storeAsFile: true
       });

      $('[data-toggle=\"tooltip\"]').tooltip();
  });
</script>";
}

if ($_GET['editProf'] == 1 && $_SESSION['role'] == "member") {
    echo "<script>
    $(document).ready(function() {
        FilePond.registerPlugin(FilePondPluginImagePreview);
        const inputElement = document.querySelector('#profilepic');
 
        const pond = FilePond.create(inputElement, {
            storeAsFile: true
        });
 
       $('[data-toggle=\"tooltip\"]').tooltip();
   });
 </script>";
}



?>

<script>
    $(document).ready(function() {
        FilePond.registerPlugin(FilePondPluginImagePreview);
        const inputElement = document.querySelector('#PREpic');

        const pond = FilePond.create(inputElement, {
            storeAsFile: true
        });

        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

</html>