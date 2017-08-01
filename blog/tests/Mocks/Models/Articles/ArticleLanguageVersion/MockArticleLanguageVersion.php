<?php namespace Tests\Mocks\Models\Articles\ArticleLanguageVersion;

use App\Models\Articles\IArticle;
use App\Models\Articles\IArticleLanguageVersion;

class MockArticleLanguageVersion implements IArticleLanguageVersion {
  
  public $article;
  public $language_id;
  public $published;
  public $topic;
  public $urlname;
  public $text;
  
  public function __construct() {
    $this->language_id = 1;
    $this->published = true;
  }
  
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
  
  public function setTopic($topic) {
    $this->topic = $topic;
  }
  
  public function setURLName($URLName) {
    $this->urlname = $URLName;
  }
  
  public function setText($text) {
    $this->text = $text;
  }
}