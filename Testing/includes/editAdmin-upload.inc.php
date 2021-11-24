<?php
if (isset($_POST) && isset($_POST['btnEditAdminProf'])) {

  $description = $_POST['description'];
  $twoFAStatus = $_POST['twoFAStatus'];

    $query = "UPDATE $role SET description = '$description', twoFAStatus = '$twoFAStatus' WHERE email = '$email'";

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
