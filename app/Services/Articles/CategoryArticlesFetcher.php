<?php namespace App\Services\Articles;

use App\Models\Categories\ICategory;

class CategoryArticlesFetcher implements ICategoryArticlesFetcher {
  
  private $orderByTimestamp;
  
  public function __construct() {
    $this->orderByTimestamp = false;
  }
  
  public function setOrderByTimestamp($orderByTimestamp) {
    $this->orderByTimestamp = $orderByTimestamp;
  }
  
  public function getArticles(ICategory $category) {
    
    if($this->orderByTimestamp) {
      return $category->articles()->orderBy('timestamp')->get();
    }
    
    return $category->articles()->get();
  }
  
}