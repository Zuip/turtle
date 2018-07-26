<?php namespace App\Services\Articles;

use App\Models\Articles\IArticleLanguageVersion;
use App\Services\Articles\ArticleNavigation;
use App\Services\Articles\ArticlePathFetcher;
use App\Services\Cities\CityDataFetcher;
use App\Services\Languages\LanguageFetcher;

class ArticleDataFetcher implements IArticleDataFetcher {
  
  private $limitToAttributes;
  
  public function __construct() {
    $this->limitToAttributes = array(
      "id", "summary", "published"
    );
  }
  
  public function limitToAttributes($limitToAttributes) {
    $this->limitToAttributes = $limitToAttributes;
  }
  
  public function getArticleData(IArticleLanguageVersion $articleLanguageVersion) {

    $articleData = array();
    if($this->chosen("id"         )) { $articleData["id"]          = $articleLanguageVersion->article->id;           }
    if($this->chosen("timestamp"  )) { $articleData["timestamp"]   = $articleLanguageVersion->article->timestamp;    }
    if($this->chosen("publishTime")) { $articleData["publishTime"] = $this->getPublishTime($articleLanguageVersion); }
    if($this->chosen("published"  )) { $articleData["published"]   = $articleLanguageVersion->published;             }
    if($this->chosen("summary"    )) { $articleData["summary"]     = $articleLanguageVersion->summary;               }
    if($this->chosen("city")) {
      $cityDataFetcher = new CityDataFetcher();
      $articleData["city"] = $cityDataFetcher->getWithArticleLanguageVersion(
        $articleLanguageVersion
      );
    }
    
    if($this->chosen("previousArticle") || $this->chosen("nextArticle")) {
      
      $articleNavigation = new ArticleNavigation();
      $articleNavigation->setCurrentArticle($articleLanguageVersion);
      
      if($this->chosen("previousArticle")) {
        $articleData["previousArticle"] = $articleNavigation->getPreviousArticleUrlName();
      }
      
      if($this->chosen("nextArticle")) {
        $articleData["nextArticle"] = $articleNavigation->getNextArticleUrlName();
      }
    }
    
    return $articleData;
  }
  
  private function getArticlePath(IArticleLanguageVersion $articleLanguageVersion) {
    $articlePathFetcher = new ArticlePathFetcher();
    $articlePathFetcher->setLanguageFetcher(new LanguageFetcher());
    $articlePathFetcher->setCategoryLanguageVersionFetcher(new LanguageVersionFetcher());
    return $articlePathFetcher->getArticlePath($articleLanguageVersion);
  }
  
  private function getPublishTime(IArticleLanguageVersion $articleLanguageVersion) {
    return date("j.n.Y", strtotime($articleLanguageVersion->article->timestamp));
  }
  
  private function chosen($attribute) {
    return in_array($attribute, $this->limitToAttributes);
  }
}