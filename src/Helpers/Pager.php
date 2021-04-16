<?php

namespace Helpers;

class Pager
{
    private $countOfUsers;
    private $recordsPerPage;
    private $link;

    public function __construct(int $countOfUsers, int $recordsPerPage, string $link)
    {
        $this->countOfUsers = $countOfUsers;
        $this->recordsPerPage = $recordsPerPage;;
        $this->link = $link;
    }

    public function getTotalPages()
    {
        return ceil($this->countOfUsers / $this->recordsPerPage);
    }

    public function getOffset($curPage)
    {
        return $skip = abs(($curPage - 1)) * $this->recordsPerPage;
    }

    public function getLinkForPage($page): string
    {
        return $link = str_replace('{page}', $page, $this->link);
    }
}

?>