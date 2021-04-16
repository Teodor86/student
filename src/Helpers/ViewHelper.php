<?php

namespace Helpers;

class ViewHelper
{
    public static function getSortingLink($search, $page, $sort)
    {
        $link = "index.php?" . http_build_query([
                'q' => $search,
                'page' => $page,
                'sort' => $sort
            ]);

        return strval($link);
    }
}
