<?php

namespace Helpers;

class Authorization
{
    /**
     * @param string $code
     */
    public static function setAuthorize(string $code): void
    {
        setcookie('user', $code, time() + 60 * 60 * 24 * 365, '/', null, null, true);
    }

    /**
     * @return string|null
     */
    public static function getUserByCookie() :?string
    {
        if (isset($_COOKIE['user'])) {
            return $_COOKIE['user'];
        }
        return null;
    }
}

?>