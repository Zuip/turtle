<?php namespace App\Services\Articles;

use App\Models\Articles\IArticleLanguageVersion;
use App\Services\Articles\ArticleNavigation;
use App\Services\Articles\ArticlePathFetcher;
use App\Services\Categories\LanguageVersionFetcher;
use App\Services\Languages\LanguageFetcher;

class ArticleDataFetcher {
  
  public function getArticleData(IArticleLanguageVersion $articleLanguageVersion) {
    
    // Find article's category path
    $articlePathFetcher = new ArticlePathFetcher();
    $articlePathFetcher->setLanguageFetcher(new LanguageFetcher());
    $articlePathFetcher->setCategoryLanguageVersionFetcher(new LanguageVersionFetcher());
    $articlePath = $articlePathFetcher->getArticlePath($articleLanguageVersion);
    
    $articleNavigation = new ArticleNavigation();
    $articleNavigation->setCurrentArticle($articleLanguageVersion);

    return array(
      "id"              => $articleLanguageVersion->article->id,
      "topic"           => $articleLanguageVersion->topic,
      "URLName"         => $articleLanguageVersion->urlname,
      "text"            => $articleLanguageVersion->text,
      "published"       => $articleLanguageVersion->published,
      "path"            => $articlePath,
      "publishtime"     => date("j.n.Y", strtotime($articleLanguageVersion->article->timestamp)),
      "previousArticle" => $this->getArticleUrlName($articleNavigation->getPreviousArticle()),
      "nextArticle"     => $this->getArticleUrlName($articleNavigation->getNextArticle())
    );
  }
  
  private function getArticleUrlName($articleLanguageVersion) {

    if($articleLanguageVersion instanceof IArticleLanguageVersion) {
      return $articleLanguageVersion->urlname;
    }
    
    return null;
  }
}