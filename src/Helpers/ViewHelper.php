<?php

namespace Helpers;

class ViewHelper
{
    /**
     * @return string
     */
    public static function getSortingLink(string $search, int $page, string $sort): string
    {
        $link = "index.php?" . http_build_query([
                'q' => $search,
                'page' => $page,
                'sort' => $sort
            ]);
        return strval($link);
    }
}
