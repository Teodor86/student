<?php

namespace Helpers;

class FlashMessage
{
    public static function setFlashMessage(string $name, string $text, string $status)
    {
        $_SESSION['flash'][$name] = [
            'text' => $text,
            'status' => $status
        ];
    }

    public static function getFlashMessage(string $name)
    {
        if (isset($_SESSION['flash'][$name])) {
            $data = $_SESSION['flash'][$name];
            unset($_SESSION['flash'][$name]);

            return $msg = "<p class=" . SecurityHelper::esc($data['status']) . ">" . SecurityHelper::esc($data['text']) . "</p>";
        }

        return '';
    }
}

?>