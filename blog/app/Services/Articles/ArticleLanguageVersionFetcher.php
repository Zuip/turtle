<?php namespace App\Services\Articles;

use App\Models\Articles\IArticle;
use App\Models\Articles\ArticleLanguageVersion;

class ArticleLanguageVersionFetcher implements IArticleLanguageVersionFetcher {
  
  private $allowUnpublishedFlag;
  private $throwExceptionOnNotFound;
  
  public function __construct() {
    $this->allowUnpublishedFlag = false;
    $this->throwExceptionOnNotFound = true;
  }
  
  public function allowUnpublished($allowUnpublished) {
    $this->allowUnpublishedFlag = $allowUnpublished;
  }
  
  public function setThrowExceptionOnNotFound($throwExceptionOnNotFound) {
    $this->throwExceptionOnNotFound = $throwExceptionOnNotFound;
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
    
    $this->validate($articleLanguageVersion);
    
    return $articleLanguageVersion;
  }
  
  public function getWithURLName($URLName) {
    
    if($this->allowUnpublishedFlag) {
      $articleLanguageVersion = ArticleLanguageVersion::where('urlname', $URLName)
                                                      ->first();
    } else {
      $articleLanguageVersion = ArticleLanguageVersion::where('published', 1)
                                                      ->where('urlname', $URLName)
                                                      ->first();
    }
    
    $this->validate($articleLanguageVersion);
    
    return $articleLanguageVersion;
  }
  
  private function validate($articleLanguageVersion) {
    
    if(!$this->throwExceptionOnNotFound) {
      return;
    }
    
    if($articleLanguageVersion == null) {
      throw new \App\Exceptions\ModelNotFoundException(
        'Article language version does not exist!'
      );
    }
  }
}