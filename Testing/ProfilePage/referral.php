<style>
    .format-pre pre {
        padding-left: 70px;
        font-size: 16px;
        text-align: left;
        font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif
    }
</style>

<?php
include "includes/dbh.local.inc.php";
session_start();
$memberEmail  = $_SESSION['email'];
$GetMemberID    = mysqli_query($conn, "SELECT * FROM `member` WHERE email ='$memberEmail'");

if (mysqli_num_rows($GetMemberID) > 0) {
    $Getresult = mysqli_fetch_assoc($GetMemberID);
    $memberID = $Getresult['id'];
    $status = $Getresult['referralClaim'];
}

$getReferralCode = "SELECT * FROM member WHERE id = " . $memberID . "";

$resultReferralCode = mysqli_query($conn, $getReferralCode);
$ReferralCode = mysqli_fetch_assoc($resultReferralCode);

$ReferralCode = $ReferralCode["referralCode"];
?>

<label class="formlabel col-md-12" style="text-align: center;">Your Referral Code</label>
<input type="text" disabled class="form-control" style="text-align: center;" value="<?php echo $ReferralCode; ?>">

<?php if ($status == 0) { ?>
    <div class='formlabel col-md-12 mt-5' style="text-align: center;">
        <p class='label'>Claim Referral Code</p>
        <input type="text" placeholder="q1d5a6fi0z" class="form-control" name="referralClaim" id="referralClaim">
    </div>

    <div class="form-inline">
        <input type='submit' name='btnCreateAuction' id='btnCreateAuction' onclick="referralClaim()" class='btn btn-dark col-3' style='font-size: 1vw; font-family: Questrial; margin: 4vh 0 0 25vw;' value='Claim Code'>
    </div>

<?php } else { ?>
    <div class='formlabel col-md-12 mt-5' style="text-align: center;">
        <p class='label'>It seems like you have already claim a Referral Code.</p>
    </div>

<?php } ?>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="SweetAlert/sweetalert2.min.js"></script>

<script>
    function referralClaim(e) {
        var newReferralCode = $("#referralClaim").val();
        var _memberID = "<?php echo $memberID ?>";
        var oldReferralCode = "<?php echo $ReferralCode ?>";

        Swal.fire({
            title: "Claim this Code?",
            text: newReferralCode,
            showCancelButton: true,
            confirmButtonText: 'Yes',
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    type: "POST",
                    url: "ProfilePage/referralProcess.php",
                    data: {
                        newCode: newReferralCode,
                        memberID: _memberID,
                        oldCode: oldReferralCode
                    },
                    success: function(result) {
                        var delay = 500
                        if (result == "Referral successfully Claimed") {
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