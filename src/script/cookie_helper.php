<?php

    function addCookie($name, $value)
    {
        $expire = time() + 24*3600*7;
        setcookie($name, $value, $expire, '/', null, false, true);
    }

    function deleteCookie($name)
    {
        $expire = time() - 1;
        setcookie($name, 0, $expire, '/', null, false, true);
    }
?>