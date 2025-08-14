<?php
include 'xyz.php';
if(isset($_POST['dataPipe'])){
    echo $linkr->show_grade_rank( $_POST['dataPipe']);
}

if(isset($_POST['selState'])){
    echo $linkr->show_sel_LGA( $_POST['selState']);
}


?>