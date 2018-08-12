<?php namespace Tests\Mocks\Models\Articles\ArticleLanguageVersion;

use App\Models\Articles\IArticle;
use App\Models\Articles\IArticleLanguageVersion;

class MockArticleLanguageVersion implements IArticleLanguageVersion {
  
  public $article;
  public $language;
  public $published;
  public $topic;
  public $url_name;
  public $text;
  
  public function __construct() {
    $this->language = 'fi';
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
  
  public function setLanguage($language) {
    $this->language = $language;
  }
  
  public function setTopic($topic) {
    $this->topic = $topic;
  }
  
  public function setURLName($URLName) {
    $this->url_name = $URLName;
  }
  
  public function setText($text) {
    $this->text = $text;
  }
}