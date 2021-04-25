<?php

namespace Helpers;

class SecurityHelper
{
    /**
     * @param $text
     * @return string
     */
    public static function esc($text) :string
    {
        return htmlspecialchars($text, ENT_QUOTES);
    }
}

?>