<?php 
    if(isset($_GET['year'])){
        $year = $_GET['year'] + 1911;
    }

    if(isset($_GET['prev'])){
        $month_prev = $_GET['prev'];
    }

    if(isset($_GET['fol'])){
        $month_fol = $_GET['fol'];
    }
?>