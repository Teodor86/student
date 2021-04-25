<?php

namespace Helpers;

class Pager
{
    /** @var int */
    private $countOfUsers;

    /** @var int */
    private $recordsPerPage;

    /** @var string */
    private $link;

    /**
     * Pager constructor.
     * @param int $countOfUsers
     * @param int $recordsPerPage
     * @param string $link
     */
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
     * @param $curPage
     * @return int
     */
    public function getOffset($curPage) :int
    {
        return $skip = abs(($curPage - 1)) * $this->recordsPerPage;
    }

    /**
     * @param $page
     * @return string
     */
    public function getLinkForPage($page): string
    {
        return $link = str_replace('{page}', $page, $this->link);
    }
}

?>