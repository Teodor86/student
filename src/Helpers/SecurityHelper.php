<?php

namespace Helpers;

class SecurityHelper
{
    public static function esc($text)
    {
        return htmlspecialchars($text, ENT_QUOTES);
    }
}

?>