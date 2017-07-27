<?php namespace App\Services\Categories;

use App\Models\Category;
use App\Models\CategoryLanguageVersion;
use App\Http\Controllers\LanguageController;

class CategoryHierarchyArrayCreator {
  
  private $languageCode;
  private $unpublished;
  
  public function __construct($languageCode = 'fi', $unpublished = false) {
    $this->languageCode = $languageCode;
    $this->unpublished = $unpublished;
  }
  
  /*
   * Finds categories and returns their data in array with hierarchy
   */
  public function getCategories($parent = null) {
    
    $categoryHierarchy = array();
    
    // We need the id for the language code to make queries
    $localeId = LanguageController::getLocaleIdByCode($this->languageCode);
    
    // Fetch all categories with chosen parent id
    $categories = Category::where('parent_id', $parent)->get();
    
    // Loop through all category and fetch the needed information for them
    foreach($categories as $category) {
      
      $categoryLanguageVersions = $this->getCategoryVersions($category, $localeId);
      
      // If matching language version was not found, skip to next phase of the loop
      if($categoryLanguageVersions->isEmpty()) {
        continue;
      }
      
      $categoryLanguageVersion = $categoryLanguageVersions->first();
      
      $categoryHierarchy[$category->id] = $this->getCategoryArray($category, $categoryLanguageVersion);
    }
    
    return $categoryHierarchy;
  }
  
  private function getCategoryArray($category, $categoryLanguageVersion) {
    
    $categoryArray = array(
      'name' => $categoryLanguageVersion->name,
      'id' => $category->id,
      'description' => $categoryLanguageVersion->description,
      'urlname' => $categoryLanguageVersion->urlname,
      'languageVersionId' => $categoryLanguageVersion->id,
      'children' => $this->getCategories($category->id) // Recursive call to get the hierarchy of the children categories
    );
      
    if($this->unpublished) {
      $categoryArray['published'] = $categoryLanguageVersion->published;
    }
    
    return $categoryArray;
  }
  
  private function getCategoryVersions($category, $localeId) {
    
    if($this->unpublished) {
      return CategoryLanguageVersion::where('category_id', $category->id)
                                    ->where('language_id', $localeId)
                                    ->get();
    }
    
    return CategoryLanguageVersion::where('category_id', $category->id)
                                  ->where('language_id', $localeId)
                                  ->where('published', true)
                                  ->get();
  }
}