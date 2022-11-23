<?php
    session_save_path('./demo');
    session_start();
    // $_SESSION['user'] = 'Jerry';
    $_SESSION['password'] = 'password';
    echo $_SESSION['user'];

    echo '<br>';
    echo session_save_path();
?>