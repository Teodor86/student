<?php

namespace Helpers;

class Pager
{
    private int $countOfUsers;
    private int $recordsPerPage;
    private string $link;

    public function __construct(int $countOfUsers, int $recordsPerPage, string $link)
    {
        $this->countOfUsers = $countOfUsers;
        $this->recordsPerPage = $recordsPerPage;;
        $this->link = $link;
    }

    /**
     * @return int
     */
    public function getTotalPages() :int
    {
        return ceil($this->countOfUsers / $this->recordsPerPage);
    }

    /**
     * @return int
     */
    public function getOffset($curPage) :int
    {
        return $skip = abs(($curPage - 1)) * $this->recordsPerPage;
    }

    /**
     * @return string
     */
    public function getLinkForPage($page): string
    {
        return $link = str_replace('{page}', $page, $this->link);
    }
}