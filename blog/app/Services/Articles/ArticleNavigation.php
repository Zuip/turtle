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
    return ArticleLanguageVersion::join('article', 'articletext.article_id', '=', 'article.id')
    ->where('article.timestamp', '<', $this->article->timestamp)
    ->where('articletext.language_id', $this->articleLanguageVersion->language_id)
    ->where('articletext.published', true)
    ->orderBy('article.timestamp', 'DESC')
    ->first();
  }
  
  // Next article is the first published article with the same language
  // that was created after current article
  public function getNextArticle() {
    return ArticleLanguageVersion::join('article', 'articletext.article_id', '=', 'article.id')
    ->where('article.timestamp', '>', $this->article->timestamp)
    ->where('articletext.language_id', $this->articleLanguageVersion->language_id)
    ->where('articletext.published', true)
    ->orderBy('article.timestamp')
    ->first();
  }
  
}
