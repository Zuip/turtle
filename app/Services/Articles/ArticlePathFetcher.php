<?php

namespace App\Services\Articles;

use App\Models\ILanguage;
use App\Models\Articles\IArticleLanguageVersion;
use App\Models\Categories\ICategory;
use App\Services\Categories\ILanguageVersionFetcher;
use App\Services\Languages\ILanguageFetcher;

class ArticlePathFetcher implements IArticlePathFetcher {
  
  private $languageFetcher;
  private $categoryLanguageVersionFetcher;
  
  public function setLanguageFetcher(ILanguageFetcher $languageFetcher) {
    $this->languageFetcher = $languageFetcher;
  }
  
  public function setCategoryLanguageVersionFetcher(ILanguageVersionFetcher $categoryLanguageVersionFetcher) {
    $this->categoryLanguageVersionFetcher = $categoryLanguageVersionFetcher;
  }
  
  public function getArticlePath(IArticleLanguageVersion $articleLanguageVersion) {
    
    $article = $articleLanguageVersion->article;
    $currentCategory = $article->category;
    
    $language = $this->languageFetcher->getWithId(
      $articleLanguageVersion->language_id
    );
    
    return $this->getParentCategories($currentCategory, $language);
  }
  
  private function getParentCategories(ICategory $currentCategory, ILanguage $language) {
    
    $categoryLanguageVersion = $this->categoryLanguageVersionFetcher->findWithCategory(
      $currentCategory,
      $language
    );

    // Single category datas in array format
    $categoryData = array(
      'id' => $currentCategory->id,
      'name' => $categoryLanguageVersion->name,
      'URLName' => $categoryLanguageVersion->url_name
    );

    // If parent is root, return current category
    if($currentCategory->parentCategory === null) {
      return array($categoryData);
    }

    // Find deeper category path if it exists
    
    $parentCategories = $this->getParentCategories(
      $currentCategory->parentCategory,
      $language
    );
    
    $parentCategories[] = $categoryData;
    
    return $parentCategories;
  }
}