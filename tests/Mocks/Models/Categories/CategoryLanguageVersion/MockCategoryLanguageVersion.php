<?php namespace Tests\Mocks\Models\Categories\CategoryLanguageVersion;

use App\Models\Categories\ICategoryLanguageVersion;

class MockCategoryLanguageVersion implements ICategoryLanguageVersion {
  
  public $id;
  public $name;
  public $description;
  public $url_name;
  public $published;
  public $language;
  public $category_id;
  
  public function __construct() {
    $this->language = 'fi';
    $this->published = true;
  }
  
  /*
   * Interface methods
   */
  
  public function category() { }
  
  /*
   * Mock methods
   */
  
  public function setCategoryId($categoryId) {
    $this->category_id = $categoryId;
  }
  
  public function setName($name) {
    $this->name = $name;
  }
  
  public function setURLName($URLName) {
    $this->url_name = $URLName;
  }
  
}