<?php
    require_once ('script/cookie_helper.php');
    session_start();
    session_unset();
    session_destroy();
    session_regenerate_id();
    deleteCookie('rememberToken');
    header('location: login.php');
?>