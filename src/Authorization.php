<?php
class Authorization
{
    static function setAuthorize($code) {
        if(isset($code)) {
            setcookie('user', $code, time() + 60 * 60 * 24 * 365, '/', null, null, true);
        }
    }

    static function getCookie() {
        if(isset($_COOKIE['user'])) {
            return $_COOKIE['user'];
        }
    }
}	
?>