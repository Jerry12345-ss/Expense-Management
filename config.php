<?php
    // Database config
    $hostname = 'localhost';
    $username = 'root';
    $password = 'jerry@81325';
    $database = 'expense_management';

    $con = mysqli_connect('localhost', 'root', 'jerry@81325', 'expense_management');

    if(!$con){
        die('Error : Unable connect to MySQL !');
    }
?>