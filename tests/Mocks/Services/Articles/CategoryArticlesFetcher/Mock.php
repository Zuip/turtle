<?php namespace Tests\Mocks\Services\Articles\CategoryArticlesFetcher;

use App\Models\Categories\ICategory;
use App\Services\Articles\ICategoryArticlesFetcher;

class Mock implements ICategoryArticlesFetcher {
  
  public function setOrderByTimestamp($orderByTimestamp) {
    
  }
  
  public function getArticles(ICategory $category) {
    return $category->articles();
  }
}