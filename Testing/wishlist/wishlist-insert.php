<?php
include "../includes/dbh.inc.php";
date_default_timezone_set("Asia/Kuala_Lumpur");
$date_now = new DateTime();
$todayDate = date_format($date_now, 'Y-m-d');

session_start();
$MemberEmail   = $_SESSION['email'];
$GetMemberID    = mysqli_query($conn, "SELECT * FROM `member` WHERE email ='$MemberEmail'");

if (mysqli_num_rows($GetMemberID) > 0) {
    $Getresult = mysqli_fetch_assoc($GetMemberID);
    $GetOwnerID = $Getresult['id'];
}

if (!empty($_POST["wishPCP"])) {
    $idWish = $_POST['wishPCP'];
    $findDupp = mysqli_query($conn, "SELECT * FROM wishlist WHERE productType = 0 AND product_id = $idWish AND member_id = '$GetOwnerID'");

    if (mysqli_num_rows($findDupp) <= 0) {
        $insert = "INSERT INTO wishlist (`productType`, `product_id`, `member_id`, `date`) VALUES (0, '$idWish', '$GetOwnerID', '$todayDate')";

        if (mysqli_query($conn, $insert)) {
            echo "Item added to wishlist";
        }

    } else {
        $remove = mysqli_query($conn, "DELETE FROM wishlist WHERE productType = 0 AND product_id = $idWish AND member_id = '$GetOwnerID'");
        mysqli_query($conn, $remove);

        echo "Item removed from wishlist";
    }

} else if (!empty($_POST["wishPRE"])) {
    $idWish = $_POST['wishPRE'];
    $findDupp = mysqli_query($conn, "SELECT * FROM wishlist WHERE productType = 1 AND product_id = $idWish AND member_id = '$GetOwnerID'");

    if (mysqli_num_rows($findDupp) <= 0) {
        $insert = "INSERT INTO wishlist (`productType`, `product_id`, `member_id`, `date`) VALUES (1, '$idWish', '$GetOwnerID', '$todayDate')";

        if (mysqli_query($conn, $insert)) {
            echo "Item added to wishlist";
        }
        
    } else {
        $remove = mysqli_query($conn, "DELETE FROM wishlist WHERE productType = 1 AND product_id = $idWish AND member_id = '$GetOwnerID'");
        mysqli_query($conn, $remove);

        echo "Item removed from wishlist";
    }
} else {
    echo "Something went wrong when wishing this product, please try again later.";
    //echo mysqli_error($conn);
}