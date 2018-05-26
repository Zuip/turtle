<?php namespace App\Services\Categories;

use App\Models\Categories\ICategory;

class CategoryLanguageVersionFetcher {
  
  public function getWithCategoryAndLanguageId(ICategory $category, $languageId) {
    
    $categoryLanguageVersion = $category->languageVersions()
                                        ->where('language_id', $languageId)
                                        ->first();
    
    if($categoryLanguageVersion === null) {
      throw new \App\Exceptions\ModelNotFoundException(
        'Language version of category does not exist!'
      );
    }
    
    return $categoryLanguageVersion;
  }
}