<?php namespace App\Services\Categories;

use App\Models\Categories\Category;
use App\Models\Categories\ICategory;
use App\Models\Categories\CategoryLanguageVersion;
use App\Models\ILanguage;

/*
 * A Service for finding language versions of categories with URLName or id
 */
class LanguageVersionFetcher implements ILanguageVersionFetcher {
  
  public function findWithURLName($categoryURLName, ILanguage $language, $includeUnpublished = true) {
    
    $categoryLanguageVersions = CategoryLanguageVersion::where('url_name', $categoryURLName)->get();
    
    if(count($categoryLanguageVersions) == 0) {
      throw new \App\Exceptions\ModelNotFoundException("Category does not exist!");
    }
    
    // One or many category language versions was found. If one of them is the correct one, return it.
    foreach($categoryLanguageVersions as $categoryLanguage) {
      
      if(!$includeUnpublished && !$categoryLanguage->published) {
        // Only allow published
        continue;
      }
      
      // Check that the category language version has correct language
      if($categoryLanguage->language_id == $language->id) {
        return $categoryLanguage;
      }
    }
    
    // If the language version was wrong, find correct one and return it
    return $this->findWithCategoryId(
      $categoryLanguage->category->id,
      $language,
      $includeUnpublished
    );
  }
  
  public function findWithCategoryId($categoryId, ILanguage $language, $includeUnpublished = true) {
    
    $categories = Category::where('id', intval($categoryId))->get();
    
    if(count($categories) !== 1) {
      throw new \App\Exceptions\ModelNotFoundException('Category language version does not exist!');
    }
    
    $category = $categories->first();
 
    return $this->findWithCategory($category, $language, $includeUnpublished);
  }
  
  public function findWithCategory(ICategory $category, ILanguage $language, $includeUnpublished = true) {
    
    $categoryLanguageVersionsArray = $this->getCategoryLanguageVersionsArray(
      $category,
      $language,
      $includeUnpublished
    );
    
    if(count($categoryLanguageVersionsArray) !== 1) {
      return null;
    }
    
    return $categoryLanguageVersionsArray->first();
  }
  
  private function getCategoryLanguageVersionsArray(ICategory $category, ILanguage $language, $includeUnpublished) {
    
    if($includeUnpublished) {
      return $category
      ->languageVersions
      ->where('language_id', $language->id);
    }
    
    return $category
    ->languageVersions
    ->where('published', true)
    ->where('language_id', $language->id);
  }
}