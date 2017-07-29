<?php namespace Tests\Mocks\Models\Articles\Article;

use App\Models\Articles\IArticle;
use App\Models\Categories\ICategory;

class MockArticle implements IArticle {
  
  public $category;
  
  /*
   *  Interface methods
   */
  
  public function languageVersions() { }
  public function writer() { }
  public function category() { }
  
  /*
   *  Mock methods
   */
  
  public function setCategory(ICategory $category) {
    $this->category = $category;
  }
}