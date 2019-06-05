<?php
    session_start();
    $_SESSION['admin_login'] = false;

    header('location:./index.html');
?>