<?php
    // database config and connect
    include('../config.php');

    $errors = [];

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['code'])){
            $code = $_POST['code'];

            if($code == ''){
                $errors['code_null'] = 'Null';
            }
        }
    }
?>