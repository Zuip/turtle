<?php namespace App\Services\Articles;

use App\Models\Articles\ArticleLanguageVersion;

class LanguageVersionsFetcher {
  
  private $limit;
  private $offset;
  private $userId;
  
  public function __construct() {
    $this->limit = null;
    $this->offset = 0;
    $this->userId = null;
  }
  
  public function setLimit($limit) {
    $this->limit = $limit;
  }
  
  public function setOffset($offset) {
    $this->offset = $offset;
  }

  public function setUserId($userId) {
    $this->userId = $userId;
  }
  
  public function getWithLanguage($language) {
    
    $languageVersions = ArticleLanguageVersion::where('published', 1)
    ->where('language', $language)
    ->join('article', 'article.id', '=', 'translated_article.article_id');

    $userId = $this->userId;
    if($userId !== null) {
      $languageVersions = $languageVersions->whereHas('article.visit', function($query) use ($userId) {
        $query->whereHas('visitUsers', function($query) use ($userId) {
          $query->where('user_id', $userId);
        });
      });
    }

    $languageVersions = $languageVersions->orderBy('article.timestamp', 'desc');
    
    if(isset($this->limit)) {
      $languageVersions = $languageVersions->limit($this->limit);
    }
    
    return $languageVersions->offset($this->offset)->get();
  }
  
}