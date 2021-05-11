<?php

namespace Helpers;

class UniqueCodeGenerator
{
    /**
     * @return string
     */
    public static function createCode($length): string
    {
        $chars = [
            'a', 'b', 'c', 'd', 'e', 'f',
            'g', 'h', 'i', 'j', 'k', 'l',
            'm', 'n', 'o', 'p', 'r', 's',
            't', 'u', 'v', 'x', 'y', 'z',
            'A', 'B', 'C', 'D', 'E', 'F',
            'G', 'H', 'I', 'J', 'K', 'L',
            'M', 'N', 'O', 'P', 'R', 'S',
            'T', 'U', 'V', 'X', 'Y', 'Z',
            '1', '2', '3', '4', '5', '6',
            '7', '8', '9', '0', '.', ',',
            '(', ')', '[', ']', '!', '?',
            '^', '%', '@', '*', '$', '+',
            '-', '{', '}', '`', '~'
        ];

        $size = count($chars) - 1;
        $uniqueCode = '';

        for ($i = 0; $i < $length; $i++) {
            $randomChars = random_int(0, $size);
            $uniqueCode .= $chars[$randomChars];
        }
        return $uniqueCode;
    }
}