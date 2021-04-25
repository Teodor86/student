<?php

namespace Helpers;

class FormHelper
{
    /**
     * @param $option
     * @param int $selected
     * @return string
     */
    public static function buildOptions($options, $selected = 0): string
    {
        $text = '';

        foreach ($options as $k => $v) {

            $op = ($k == $selected) ? 'selected="selected"' : null;
            $text .= "<option value='$k' $op>" . $v . "</option>\n\t\t\t\t\t";
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

?>