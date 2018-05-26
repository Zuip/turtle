<?php namespace Tests\Mocks\Services\Articles\ArticleLanguageVersionFetcher;

use App\Models\Articles\IArticle;
use App\Services\Articles\IArticleLanguageVersionFetcher;

class Mock implements IArticleLanguageVersionFetcher {
  
  private $allowUnpublishedFlag;
  
  public function __construct() {
    $this->allowUnpublishedFlag = false;
  }
  
  public function allowUnpublished($allowUnpublished) {
    $this->allowUnpublishedFlag = $allowUnpublished;
  }
  
  public function setThrowExceptionOnNotFound($throwExceptionOnNotFound) {
    
  }
  
  public function getWithArticleAndLanguageId(IArticle $article, $languageId) {
    
    foreach($article->languageVersions() as $articleLanguageVersion) {

      if(!$this->allowUnpublishedFlag && !$articleLanguageVersion->published) {
        continue;
      }

      if($articleLanguageVersion->language_id == $languageId) {
        return $articleLanguageVersion;
      }
    }
    
    return null;
  }
  
  public function getWithURLName($URLName) {
    
  }
}
