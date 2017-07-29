<?php namespace Tests\Mocks\Models\Categories\Category;

use App\Models\Categories\ICategory;

class MockCategory implements ICategory {
  
  public $id;
  public $parentCategory;
  
  public function __construct() {
    $this->parentCategory = null;
  }
  
  /*
   * Interface methods
   */
  
  public function languageVersions() { }
  public function children() { }
  public function articles() { }
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
}