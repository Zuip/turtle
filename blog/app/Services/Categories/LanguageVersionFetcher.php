<?php namespace App\Services\Categories;

use App\Models\Category;
use App\Models\CategoryLanguageVersion;
use App\Models\Language;

/*
 * A Service for finding language versions of categories with URLName or id
 */
class LanguageVersionFetcher {
  
  public function findWithURLName($categoryURLName, $languageCode, $includeUnpublished = true) {
    
    $categoryLanguageVersions = CategoryLanguageVersion::where('urlname', $categoryURLName)->get();
    
    if(count($categoryLanguageVersions) == 0) {
      return array();
    }
    
    // One or many category language versions was found. If one of them is the correct one, return it.
    foreach($categoryLanguageVersions as $categoryLanguage) {
      
      if(!$includeUnpublished && !$categoryLanguage->published) {
        // Only allow published
        continue;
      }
      
      // Check that the category language version has correct language
      if($categoryLanguage->language_id == Language::where('code', $languageCode)->first()->id) {
        return $categoryLanguage;
      }
    }
    
    // If the language version was wrong, find correct one and return it
    return $this->findWithCategoryId(
      $categoryLanguage->category->id,
      $languageCode,
      $includeUnpublished
    );
  }
  
  public function findWithCategoryId($categoryId, $languageCode, $includeUnpublished = true) {
    
    $categories = Category::where('id', intval($categoryId))->get();
    
    if(count($categories) === 0) {
      return array('error' => 'Category does not exist!', 400);
    }
    
    $categoryLanguageVersionsArray = $this->getCategoryLanguageVersionsArray(
      $categories,
      $languageCode,
      $includeUnpublished
    );
    
    if(count($categoryLanguageVersionsArray) !== 1) {
      return null;
    }
    
    return $categoryLanguageVersionsArray->first();
  }
  
  private function getCategoryLanguageVersionsArray($categories, $languageCode, $includeUnpublished) {
    
    if($includeUnpublished) {
      return $categories->first()
             ->languageVersions
             ->where(
               'language_id',
               Language::where('code', $languageCode)->first()->id
             );
    }
    
    return $categories->first()
           ->languageVersions
           ->where('published', true)
           ->where(
             'language_id',
             Language::where('code', $languageCode)->first()->id
           );
  }
}