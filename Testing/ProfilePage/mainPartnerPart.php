<?php
include "includes/dbh.inc.php";
session_start();




?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    function loadTable() {
         var txt = $('#searchPCP').val();
        if (txt == '' || txt != '') {
            $.ajax({
                url: "ProfilePage/listPartnerPCP.php",
                method: "post",
                data: {
                    search: txt
                },
                dataType: "text",
                success: function(data) {
                    $('#listResPCP').html(data);
                }
            })
        } else {
            $('#listRes').html('');
        }
    }
    window.onload = loadTable;
</script>

<form method="POST" action="profilePage.php?editAuc=0&editPRE=0&editProf=0&editPCP=2&salesO=0">
    <div class="row">
        <div class="col-6" style="padding:0">
            <select class="form-control" id="PCPpart" name="PCPpart" style="margin-bottom:2vh">
                <option selected value="mobo">Motherboard</option>
                <option value="processor">Processor</option>
                <option value="ram">RAM</option>
                <option value="psu">PSU</option>
                <option value="adapter">Adapter</option>
                <option value="casing">Casing</option>
                <option value="cooler">Cooler</option>
                <option value="gpu">GPU</option>
                <option value="storage">Storage</option>
            </select>
        </div>

        <div class="col-6">
            <input type="submit" class="btn btn-success" style="font-size: 0.75vw; margin-bottom:5vh;" value="Add PC Part">
        </div>
    </div>


</form>
<hr>



<input type="text" class="form-control" size="50" placeholder="Enter Name or Category" name="searchPCP" id="searchPCP" autofocus style="margin-bottom:2vh;">

<div id="listResPCP">

</div>


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
            url: "ProfilePage/deletePCP.php",
            type: "POST",
            data: {
                idDeletePCP: id
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




<script>
    $(document).ready(function() {
        $('#searchPCP').keyup(function() {
           loadTable();
        });
    });
</script>