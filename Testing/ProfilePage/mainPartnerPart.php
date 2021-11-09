<?php
include "includes/dbh.inc.php";
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
<form>
    <select class="form-control" id="PCPpart" name="PCPpart">
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
</form>


<?php 
    if(isset($_REQUEST['PCPpart']) && $_REQUEST['PCPpart'] == 'mobo'){
        $addPart = "mobo";
    }
    else if(isset($_REQUEST['PCPpart']) && $_REQUEST['PCPpart'] == 'processor'){
        $addPart = "processor";
    }
    else if(isset($_REQUEST['PCPpart']) && $_REQUEST['PCPpart'] == 'ram'){
        $addPart = "ram";
    }
    else if(isset($_REQUEST['PCPpart']) && $_REQUEST['PCPpart'] == 'psu'){
        $addPart = "psu";
    }
    else if(isset($_REQUEST['PCPpart']) && $_REQUEST['PCPpart'] == 'adapter'){
        $addPart = "adapter";
    }
    else if(isset($_REQUEST['PCPpart']) && $_REQUEST['PCPpart'] == 'casing'){
        $addPart = "casing";
    }
    else if(isset($_REQUEST['PCPpart']) && $_REQUEST['PCPpart'] == 'cooler'){
        $addPart = "cooler";
    }
    else if(isset($_REQUEST['PCPpart']) && $_REQUEST['PCPpart'] == 'gpu'){
        $addPart = "gpu";
    }
    else{
        $addPart = "storage";
    }
?>


<a href='profilePage.php?editAuc=0&editPRE=0&editProf=0&editPCP=2&addPart=<?php echo $addPart ?>' class="btn btn-success" style="font-size: 0.75vw; margin-bottom:2vh;" role="button">Add PC Part</a>


<input type="text" class="form-control" size="50" placeholder="Enter Name or Category" onkeyup="PCPfunction()" name="searchPCP" id="searchPCP" autofocus style="margin-bottom:2vh;">

<div id="listResPCP">

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<script>
    $(document).ready(function() { 
    $('#PCPpart').on('change', getValue); 
}); 
 
function getValue() { 
    var selected = $('#PCPpart').val(); 
    $.ajax({ 
        url:        '/you/php/script.php', 
        type:       'POST', 
        dataType:   'json', 
        data:       { value: selected }, 
        success:    function(data) { 
            $('#some_div').html(data); 
        } 
    }); 
} 
</script>
<script>
    $(document).ready(function() {
        $('#searchPCP').keyup(function() {
            var txt = $(this).val();
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
                $('#listResPCP').html('');
            }
        });
    });
</script>