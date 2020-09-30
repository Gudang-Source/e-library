<?php
    session_start();

    if (empty($_SESSION['login'])) {
        header('Location: login.php');
        exit;
    }
    
    session_unset();
    session_destroy();

    header('Location: login.php');
?>