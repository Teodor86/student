<?php

namespace Helpers;

class SecurityHelper
{
    /**
     * @return string
     */
    public static function esc($dirty): string
    {
        return htmlspecialchars($dirty, ENT_QUOTES, 'UTF-8');
    }
}