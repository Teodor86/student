<?php

namespace Helpers;


class FormHelper
{
    /**
     * @return string
     */
    public static function buildOptions(array $options, ?string $selected = '0'): string
    {
        $text = '';
        foreach ($options as $k => $v) {
            $op = ($k == $selected) ? ' selected="selected"' : null;
            $text .= "<option value=" . SecurityHelper::esc($k) . $op . ">" . SecurityHelper::esc($v) . "</option>\n";
        }
        return $text;
    }

    /**
     * @return array
     */
    public static function getYearValues(): array
    {
        $years = [];
        $currentYears = date('Y');

        for ($i = $currentYears - 10; $i > 1919; $i--) {
            $years[$i] = $i;
        }
        return $years;
    }
}