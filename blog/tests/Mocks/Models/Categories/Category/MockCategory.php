<?php namespace Tests\Mocks\Models\Categories\Category;

use App\Models\Articles\IArticle;
use App\Models\Categories\ICategory;

class MockCategory implements ICategory {
  
  public $id;
  public $parentCategory;
  private $articles;
  
  public function __construct() {
    $this->parentCategory = null;
    $this->articles = array();
  }
  
  /*
   * Interface methods
   */
  
  public function languageVersions() { }
  
  public function children() { }
  
  public function articles() {
    return $this->articles;
  }
  
  public function parentCategory() { }
  
  /*
   * Mock methods
   */
  
  public function setId($id) {
    $this->id = $id;
  }
  
  public function setParentCategory(ICategory $parentCategory) {
    $this->parentCategory = $parentCategory;
  }
  
  public function addArticle(IArticle $article) {
    $this->articles[] = $article;
  }
}