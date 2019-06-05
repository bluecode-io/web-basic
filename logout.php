<?php
    session_start();
    $_SESSION['user_login'] = false;

    header('location:./index.php');