<?php namespace Tests\Mocks\Models\Articles\Article;

use App\Models\Articles\IArticle;
use App\Models\Articles\IArticleLanguageVersion;
use App\Models\Categories\ICategory;

class MockArticle implements IArticle {
  
  public $id;
  public $created;
  public $category;
  private $languageVersions;
  
  public function __construct() {
    $this->created = '2016-08-15';
    $this->languageVersions = [];
  }
  
  /*
   *  Interface methods
   */
  
  public function languageVersions() {
    return $this->languageVersions;
  }
  
  public function writer() { }
  
  public function category() { }
  
  /*
   *  Mock methods
   */
  
  public function setId($id) {
    $this->id = $id;
  }
  
  public function setCategory(ICategory $category) {
    $this->category = $category;
  }
  
  public function addLanguageVersion(IArticleLanguageVersion $articleLanguageVersion) {
    $this->languageVersions[] = $articleLanguageVersion;
  }
}