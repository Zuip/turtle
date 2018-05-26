<?php namespace App\Services\Articles;

use App\Models\Articles\IArticle;
use App\Models\ILanguage;
use App\Services\Articles\ArticleLanguageVersionFetcher;

class ArticleEditor {
  
  private $article;
  private $language;
  private $topic;
  private $text;
  private $URLName;
  private $published;
  private $publishTime;
  
  public function setArticle(IArticle $article) {
    $this->article = $article;
  }
  
  public function setLanguage(ILanguage $language) {
    $this->language = $language;
  }
  
  public function setTopic($topic) {
    $this->topic = $topic;
  }
  
  public function setText($text) {
    $this->text = $text;
  }
  
  public function setURLName($URLName) {
    $this->URLName = $URLName;
  }
  
  public function setPublished($published) {
    $this->published = $published;
  }
  
  public function setPublishTime($publishTime) {
    $this->publishTime = $publishTime;
  }
  
  public function editArticle() {
    
    // Timestamp data is saved in Article model
    $date = \DateTime::createFromFormat('d.m.Y', $this->publishTime);
    if($date) {
      $this->article->timestamp = $date;
      $this->article->save();
    }
    
    // Find language version of article
    $articleLanguageVersionFetcher = new ArticleLanguageVersionFetcher();
    $articleLanguageVersion = $articleLanguageVersionFetcher->getWithArticleAndLanguageId(
      $this->article,
      $this->language->id
    );
    
    // Edit article language version
    $articleLanguageVersion->topic = $this->topic;
    $articleLanguageVersion->url_name = $this->URLName;
    $articleLanguageVersion->text = $this->text;
    $articleLanguageVersion->published = $this->published == "1";
    
    $articleLanguageVersion->save();
  }
}