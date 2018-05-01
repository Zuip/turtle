<?php namespace App\Services\Articles;

use App\Services\Languages\LanguageFetcher;
use App\Models\Articles\ArticleLanguageVersion;
use App\Services\Articles\ArticleDataFetcher;

class FrontpageArticlesDataFetcher {
  
  public function getData($languageCode) {

    $languageFetcher = new LanguageFetcher();
    $language = $languageFetcher->getWithCode($languageCode);
    
    // Create the latest article data
    $latestArticle = $this->getLatestArticle($language->id);
    $latestArticleDataFetcher = new ArticleDataFetcher();
    $latestArticleDataFetcher->limitToAttributes(array(
      "topic", "URLName", "publishTime", "textSummary"
    ));
    $latestArticleData = $latestArticleDataFetcher->getArticleData($latestArticle);
    $latestArticleData['boxTopic'] = \Lang::get('views.frontPage.latestArticle', array(), $languageCode);
    $latestArticleData['type'] = 'latest-article';
    
    // First article
    $firstArticle = $this->getFirstArticle($language->id);
    $firstArticleDataFetcher = new ArticleDataFetcher();
    $firstArticleDataFetcher->limitToAttributes(array(
      "topic", "URLName", "publishTime", "textSummary"
    ));
    $firstArticleData = $firstArticleDataFetcher->getArticleData($firstArticle);
    $firstArticleData['boxTopic'] = \Lang::get('views.frontPage.startFromBeginning', array(), $languageCode);
    $firstArticleData['type'] = 'first-article';
    
    return array(
      $latestArticleData,
      $firstArticleData
    );
  }
  
  private function getLatestArticle($languageId) {
    
    $latestArticle = ArticleLanguageVersion::join('article', 'translated_article.article_id', '=', 'article.id')
                     ->where('translated_article.language_id', $languageId)
                     ->where('translated_article.published', true)
                     ->orderBy('article.timestamp', 'DESC')
                     ->first();
    
    if($latestArticle === null) {
      throw new \App\Exceptions\ModelNotFoundException('No articles exists!');
    }
    
    return $latestArticle;
  }
  
  private function getFirstArticle($languageId) {
    
    $firstArticle = ArticleLanguageVersion::join('article', 'translated_article.article_id', '=', 'article.id')
                    ->where('translated_article.language_id', $languageId)
                    ->where('translated_article.published', true)
                    ->orderBy('article.timestamp')
                    ->first();
    
    if($firstArticle === NULL) {
      throw new \App\Exceptions\ModelNotFoundException('No articles exists!');
    }
    
    return $firstArticle;
  }
}