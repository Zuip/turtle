<?php namespace Tests\Mocks\Services\Categories\LanguageVersionFetcher;

use App\Models\Categories\ICategory;
use App\Models\Categories\ICategoryLanguageVersion;
use App\Services\Categories\ILanguageVersionFetcher;

class Mock implements ILanguageVersionFetcher {
  
  private $categoryLanguageVersions;
  
  public function __construct() {
    $this->categoryLanguageVersions = array();
  }
  
  /*
   * Interface methods
   */
  
  public function findWithURLName($categoryURLName, $language, $includeUnpublished = true) { }
  public function findWithCategoryId($categoryId, $language, $includeUnpublished = true) { }
  
  public function findWithCategory(ICategory $category, $language, $includeUnpublished = true) {
    
    foreach($this->categoryLanguageVersions as $categoryLanguageVersion) {
      
      if($categoryLanguageVersion->language !== $language) {
        continue;
      }
      
      if(!$includeUnpublished && !$categoryLanguageVersion->published) {
        continue;
      }
      
      if($categoryLanguageVersion->category_id === $category->id) {
        return $categoryLanguageVersion;
      }
    }
  }
  
  /*
   * Mock methods
   */
  
  public function addCategorylanguageVersion(ICategoryLanguageVersion $categoryLanguageVersion) {
    $this->categoryLanguageVersions[] = $categoryLanguageVersion;
  }
}