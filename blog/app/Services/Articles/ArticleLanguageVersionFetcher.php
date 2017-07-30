<?php namespace App\Services\Articles;

use App\Models\Articles\IArticle;
use App\Models\Articles\ArticleLanguageVersion;

class ArticleLanguageVersionFetcher {
  
  private $allowUnpublishedFlag;
  
  public function __construct() {
    $this->allowUnpublishedFlag = false;
  }
  
  public function allowUnpublished($allowUnpublished) {
    $this->allowUnpublishedFlag = $allowUnpublished;
  }
  
  public function getWithArticleAndLanguageId(IArticle $article, $languageId) {
    
    if($this->allowUnpublishedFlag) {
      $articleLanguageVersion = $article->languageVersions()
                                        ->where('language_id', $languageId)
                                        ->first();
    } else {
      $articleLanguageVersion = $article->languageVersions()
                                        ->where('published', 1)
                                        ->where('language_id', $languageId)
                                        ->first();
    }
    
    if($articleLanguageVersion === null) {
      throw new \App\Exceptions\ModelNotFoundException(
        'Article language version does not exist!'
      );
    }
    
    return $articleLanguageVersion;
  }
  
  public function getWithURLName($URLName) {
    
    // Find article language version
    if($this->allowUnpublishedFlag) {
      $articleLanguageVersion = ArticleLanguageVersion::where('urlname', $URLName)
                                                      ->first();
    } else {
      $articleLanguageVersion = ArticleLanguageVersion::where('published', 1)
                                                      ->where('urlname', $URLName)
                                                      ->first();
    }
    
    // Check that the article language version was found
    if($articleLanguageVersion == null) {
      throw new \App\Exceptions\ModelNotFoundException(
        'Article language version does not exist!'
      );
    }
    
    return $articleLanguageVersion;
  }
}