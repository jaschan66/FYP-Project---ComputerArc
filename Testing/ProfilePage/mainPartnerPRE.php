<?php
include "includes\dbh.inc.php";
session_start();

// print_r($_POST);
// if(!empty($_POST["idDelete"])){
//     // echo $_POST["idDelete"];
//     // die();
//     $idDelete = $_POST["idDelete"];
//     $deleteById = "DELETE FROM prebuildpc WHERE id = '$idDelete'";
//     mysqli_query($conn, $deleteById);
// }
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    function loadTable() {
         var txt = $('#searchPRE').val();
        if (txt == '' || txt != '') {
            $.ajax({
                url: "ProfilePage/listPartnerPRE.php",
                method: "post",
                data: {
                    search: txt
                },
                dataType: "text",
                success: function(data) {
                    $('#listRes').html(data);
                }
            })
        } else {
            $('#listRes').html('');
        }
    }
    window.onload = loadTable;
    </script>

<a href='profilePage.php?editPRE=2&editProf=0&editAuc=0&editPCP=0' class="btn btn-success" style="font-size: 0.75vw; margin-bottom:2vh;" role="button">Add Pre-Build PC</a>

<input type="text" class="form-control" size="50" placeholder="Search using Name or Category"  name="searchPRE" id="searchPRE" autofocus style="margin-bottom:2vh;">

<div id="listRes"></div>

<script>
    $(document).ready(function() {
        $('#searchPRE').keyup(function() {
            loadTable();
        });
    });
</script>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="SweetAlert/sweetalert2.min.js"></script>

<script>
    function deleteData(e) {
        Swal.fire({
  title: 'Do you want to delete the data?',
  showDenyButton: true,
  confirmButtonText: 'Delete',
  denyButtonText: "Don't delete",
}).then((result) => {
  /* Read more about isConfirmed, isDenied below */
  if (result.isConfirmed) {
    var id = $(e).attr('id');
        $.ajax({
            url: "ProfilePage/deletePRE.php",
            type: "POST",
            data: {
                idDeletePRE: id
            },
            success: function(result) {
                var obj = JSON.parse(result)
                console.log(obj.status);
                if(obj.status){
                window.location.reload();
            }
            else{
                Swal.fire({
            title: 'Error',
            text: obj.message,
            icon: 'error',
            confirmButtonColor: '#866a60',
            confirmButtonText: 'OK',
            allowOutsideClick: 1,
        });
            }
            },
            error: function(result) {
                console.log(result);
            },
        })
  } 
})
       
}    
</script>
