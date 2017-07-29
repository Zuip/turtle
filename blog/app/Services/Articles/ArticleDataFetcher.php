<?php namespace App\Services\Articles;

use App\Models\Articles\IArticleLanguageVersion;
use App\Services\Articles\ArticleNavigation;
use App\Services\Articles\ArticlePathFetcher;
use App\Services\Categories\LanguageVersionFetcher;
use App\Services\Languages\LanguageFetcher;

class ArticleDataFetcher {
  
  private $isFrontpageSummaryArticle;
  
  public function __construct() {
    $this->isFrontpageSummaryArticle = false;
  }
  
  // The summary boxes in the frontpage don't need all the data
  public function setIsFrontpageSummaryArticle($isFrontpageSummaryArticle) {
    $this->isFrontpageSummaryArticle = $isFrontpageSummaryArticle;
  }
  
  public function getArticleData(IArticleLanguageVersion $articleLanguageVersion) {

    if($this->isFrontpageSummaryArticle) {
      return array(
        "topic"       => $articleLanguageVersion->topic,
        "URLName"     => $articleLanguageVersion->urlname,
        "publishtime" => $this->getPublishTime($articleLanguageVersion),
        "textSummary" => $this->getTextSummary($articleLanguageVersion)
      );
    }
    
    $articleNavigation = new ArticleNavigation();
    $articleNavigation->setCurrentArticle($articleLanguageVersion);
    
    return array(
      "id"              => $articleLanguageVersion->article->id,
      "topic"           => $articleLanguageVersion->topic,
      "URLName"         => $articleLanguageVersion->urlname,
      "text"            => $articleLanguageVersion->text,
      "published"       => $articleLanguageVersion->published,
      "path"            => $this->getArticlePath($articleLanguageVersion),
      "publishtime"     => $this->getPublishTime($articleLanguageVersion),
      "previousArticle" => $this->getArticleUrlName($articleNavigation->getPreviousArticle()),
      "nextArticle"     => $this->getArticleUrlName($articleNavigation->getNextArticle())
    );
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
  
  private function getArticleUrlName($articleLanguageVersion) {

    if($articleLanguageVersion instanceof IArticleLanguageVersion) {
      return $articleLanguageVersion->urlname;
    }
    
    return null;
  }
  
  private function getTextSummary(IArticleLanguageVersion $articleLanguageVersion) {
    return explode("[summary]", $articleLanguageVersion->text)[0];
  }
}