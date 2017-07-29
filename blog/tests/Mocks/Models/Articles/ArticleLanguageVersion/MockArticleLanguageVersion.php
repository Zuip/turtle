<?php namespace Tests\Mocks\Models\Articles\ArticleLanguageVersion;

use App\Models\Articles\IArticle;
use App\Models\Articles\IArticleLanguageVersion;

class MockArticleLanguageVersion implements IArticleLanguageVersion {
  
  public $article;
  public $language_id;
  
  /*
   * Interface methods
   */
  
  public function article() { }
  
  /*
   * Mock methods
   */
  
  public function setArticle(IArticle $article) {
    $this->article = $article;
  }
  
  public function setLanguageId($languageId) {
    $this->language_id = $languageId;
  }
}