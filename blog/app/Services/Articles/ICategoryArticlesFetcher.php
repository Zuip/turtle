<?php namespace App\Services\Articles;

use App\Models\Categories\ICategory;

interface ICategoryArticlesFetcher {
  public function setOrderByTimestamp($orderByTimestamp);
  public function getArticles(ICategory $category);
}