<?php

namespace Helpers;

class FlashMessage
{
    /**
     * @param string $name
     * @param string $text
     * @param string $status
     */
    public static function setFlashMessage(string $name, string $text, string $status)
    {
        $_SESSION['flash'][$name] = [
            'text' => $text,
            'status' => $status
        ];
    }

    /**
     * @param string $name
     * @return string
     */
    public static function getFlashMessage(string $name): string
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