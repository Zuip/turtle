<?php namespace App\Services\Articles;

use App\Http\Controllers\LanguageController;
use App\Models\Articles\ArticleLanguageVersion;
use App\Services\Articles\ArticleDataFetcher;

class FrontpageArticlesDataFetcher {
  
  public function getData($languageCode) {

    $languageId = LanguageController::getLocaleIdByCode($languageCode);
    
    // Create the latest article data
    $latestArticle = $this->getLatestArticle($languageId);
    $latestArticleDataFetcher = new ArticleDataFetcher();
    $latestArticleDataFetcher->limitToAttributes(array(
      "topic", "URLName", "publishtime", "textSummary"
    ));
    $latestArticleData = $latestArticleDataFetcher->getArticleData($latestArticle);
    $latestArticleData['boxTopic'] = \Lang::get('views.home.latestArticle', array(), $languageCode);
    
    // First article
    $firstArticle = $this->getFirstArticle($languageId);
    $firstArticleDataFetcher = new ArticleDataFetcher();
    $firstArticleDataFetcher->limitToAttributes(array(
      "topic", "URLName", "publishtime", "textSummary"
    ));
    $firstArticleData = $firstArticleDataFetcher->getArticleData($firstArticle);
    $firstArticleData['boxTopic'] = \Lang::get('views.home.startFromBeginning', array(), $languageCode);
    
    return array(
      'latestArticle' => $latestArticleData,
      'firstArticle'  => $firstArticleData
    );
  }
  
  private function getLatestArticle($languageId) {
    
    $latestArticle = ArticleLanguageVersion::join('article', 'articletext.article_id', '=', 'article.id')
                     ->where('articletext.language_id', $languageId)
                     ->where('articletext.published', true)
                     ->orderBy('article.timestamp', 'DESC')
                     ->first();
    
    if($latestArticle === null) {
      throw new \App\Exceptions\ModelNotFoundException('No articles exists!');
    }
    
    return $latestArticle;
  }
  
  private function getFirstArticle($languageId) {
    
    $firstArticle = ArticleLanguageVersion::join('article', 'articletext.article_id', '=', 'article.id')
                    ->where('articletext.language_id', $languageId)
                    ->where('articletext.published', true)
                    ->orderBy('article.timestamp')
                    ->first();
    
    if($firstArticle === NULL) {
      throw new \App\Exceptions\ModelNotFoundException('No articles exists!');
    }
    
    return $firstArticle;
  }
}