<?php namespace App\Services\Articles;

use App\Models\Articles\Article;
use App\Models\Articles\ArticleLanguageVersion;
use App\Models\Categories\ICategory;
use App\Models\Language;
use App\Models\ILanguage;

class ArticleCreator {
  
  private $articleId;
  private $category;
  private $currentLanguage;
  private $topic;
  private $text;
  private $URLName;
  private $published;
  private $publishTime;
  
  public function setCategory(ICategory $category) {
    $this->category = $category;
  }
  
  public function setLanguage(ILanguage $language) {
    $this->currentLanguage = $language;
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
  
  public function getCreatedArticle() {
    return $this->article;
  }
  
  public function createArticle() {
    
    // Check that the URL name is not already in use
    if(ArticleLanguageVersion::where('urlname', $this->URLName)->first() != NULL) {
      throw new \App\Exceptions\ModelNotFoundException('URL name already in use!');
    }
    
    // Create article
    $article = new Article;
    $article->category_id = $this->category->id;
    $article->user_id = \Auth::user()->id;
    
    $date = \DateTime::createFromFormat('d.m.Y', $this->publishTime);
    if($date) {
      $article->timestamp = $date;
    }
    
    $article->save();
    
    // Create language versions for all languages
    foreach(Language::all() as $language) {
      $this->createArticleLanguageVersion($article, $language);
    }
    
    $this->article = $article;
  }
  
  private function createArticleLanguageVersion(Article $article, ILanguage $language) {
    
    $articleLanguageVersion = new ArticleLanguageVersion;
    $articleLanguageVersion->topic = $this->topic;
    $articleLanguageVersion->urlname = $this->URLName;
    $articleLanguageVersion->text = $this->text;
    $articleLanguageVersion->language_id = $language->id;
    $articleLanguageVersion->article_id = $article->id;
    $articleLanguageVersion->published = $this->getArticleLanguageVersionIsPublished($language);

    $articleLanguageVersion->save();
  }
  
  private function getArticleLanguageVersionIsPublished(ILanguage $language) {
    // Publish the article if chosen language id and user wants to publish it
    return $this->published == "1" && $language == $this->currentLanguage;
  }
}