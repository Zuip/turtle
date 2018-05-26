<?php namespace App\Services\Articles;

use App\Models\Articles\ArticleLanguageVersion;
use App\Models\Articles\IArticleLanguageVersion;

class ArticleNavigation implements IArticleNavigation {
  
  private $article;
  private $articleLanguageVersion;
  
  public function setCurrentArticle(IArticleLanguageVersion $articleLanguageVersion) {
    $this->article = $articleLanguageVersion->article()->first();
    $this->articleLanguageVersion = $articleLanguageVersion;
  }
  
  // Next article is the first published article with the same language
  // that was created before current article
  public function getPreviousArticle() {
    return ArticleLanguageVersion::join('article', 'translated_article.article_id', '=', 'article.id')
    ->where('article.timestamp', '<', $this->article->timestamp)
    ->where('translated_article.language_id', $this->articleLanguageVersion->language_id)
    ->where('translated_article.published', true)
    ->orderBy('article.timestamp', 'DESC')
    ->first();
  }
  
  public function getPreviousArticleURLName() {
    return $this->getArticleUrlName($this->getPreviousArticle());
  }
  
  // Next article is the first published article with the same language
  // that was created after current article
  public function getNextArticle() {
    return ArticleLanguageVersion::join('article', 'translated_article.article_id', '=', 'article.id')
    ->where('article.timestamp', '>', $this->article->timestamp)
    ->where('translated_article.language_id', $this->articleLanguageVersion->language_id)
    ->where('translated_article.published', true)
    ->orderBy('article.timestamp')
    ->first();
  }
  
  public function getNextArticleURLName() {
    return $this->getArticleUrlName($this->getNextArticle());
  }
  
  private function getArticleUrlName($articleLanguageVersion) {

    if($articleLanguageVersion instanceof IArticleLanguageVersion) {
      return $articleLanguageVersion->url_name;
    }
    
    return null;
  }
  
}
