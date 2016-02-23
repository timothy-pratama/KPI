<?php
    include ('script/cookie_helper.php');
    session_start();
    session_unset();
    session_regenerate_id();
    deleteCookie('rememberToken');
    header('location: login.php');
?>