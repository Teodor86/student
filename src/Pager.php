<?php
class Pager 
{
  private $countOfUsers;
  private $perPage;
  private $link;
    
  function __construct($countOfUsers, $perPage, $link) {
    $this->countOfUsers     = $countOfUsers;
    $this->perPage          = $perPage;
    $this->link             = $link;
  }
  
  function getTotalPages() {
    return ceil($this->countOfUsers/$this->perPage);
  }
  
  function getOffset($cur_page) {
    $skip = abs(($cur_page - 1)) * $this->perPage;
    return $skip;
  }
  
  public function getLinkForPage($number, $order) {
    $parameters = ['{order}', '{page}'];
    $values = [$order, $number];
    $link = str_replace($parameters, $values, $this->link);
    return $link;
  }
}
?>