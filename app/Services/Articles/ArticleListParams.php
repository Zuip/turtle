<?php namespace App\Services\Articles;

class ArticleListParams {

  private $defaultResults;
  private $maxResults;

  public function __construct() {
    $this->defaultResults = 5;
    $this->maxResults = 10;
  }

  public function parseLimit($rawLimit) {
    
    if($rawLimit === null) {
      return $this->defaultResults;
    }
    
    $limit = abs((int)$rawLimit);
    
    if($limit > $this->maxResults) {
      return $this->maxResults;
    }
    
    return $limit;
  }
  
  public function parseOffset($offset) {
    
    if($offset === null) {
      return 0;
    }
    
    return abs((int)$offset);
  }
}