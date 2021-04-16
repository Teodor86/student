<?php

namespace Helpers;

class Authorization
{
    public static function setAuthorize(string $code)
    {
        setcookie('user', $code, time() + 60 * 60 * 24 * 365, '/', null, null, true);
    }

    public static function getCookie()
    {
        if (isset($_COOKIE['user'])) {
            return $_COOKIE['user'];
        }
    }
}

?>