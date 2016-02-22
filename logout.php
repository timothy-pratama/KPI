<?php
    include ('script/cookie_helper.php');
    session_start();
    unset($_SESSION['login']);
    session_destroy();
    session_start();
    deleteCookie('seriesIdentifier');
    deleteCookie('token');
    header('location: login.php');
?>