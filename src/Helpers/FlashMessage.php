<?php

namespace Helpers;

class FlashMessage
{
    public static function set(string $name, string $text, string $status): void
    {
        $_SESSION['flash'][$name] = [
            'text' => $text,
            'status' => $status
        ];
    }

    /**
     * @return bool
     */
    public static function has(string $key): bool
    {
        if (!empty($_SESSION['flash'][$key])) {
            return true;
        }
        return false;
    }

    /**
     * @return array|null
     */
    public static function get(string $name): ?array
    {
        if (isset($_SESSION['flash'][$name])) {
            $data = $_SESSION['flash'][$name];
            unset($_SESSION['flash'][$name]);

            return [
                "status" => $data['status'],
                "text" => $data['text']
            ];
        }
        return null;
    }
}