<?php namespace App\Services\Articles;

use App\Models\Articles\ArticleLanguageVersion;

class LanguageVersionsFetcher {
  
  private $cityIds;
  private $limit;
  private $offset;
  private $tripId;
  private $userId;
  
  public function __construct() {
    $this->cityIds = [];
    $this->limit = null;
    $this->offset = 0;
    $this->tripId = null;
    $this->userId = null;
  }

  public function setCityIds($cityIds) {
    $this->cityIds = $cityIds;
  }
  
  public function setLimit($limit) {
    $this->limit = $limit;
  }
  
  public function setOffset($offset) {
    $this->offset = $offset;
  }

  public function setTripId($tripId) {
    $this->tripId = $tripId;
  }

  public function setUserId($userId) {
    $this->userId = $userId;
  }
  
  public function getWithLanguage($language) {
    
    $languageVersions = ArticleLanguageVersion::where('language', $language)
    ->join('article', 'article.id', '=', 'translated_article.article_id')
    ->whereNotNull('translated_article.published');

    $cityIds = $this->cityIds;
    if($cityIds !== []) {
      $languageVersions = $languageVersions->whereHas('article.visit', function($query) use ($cityIds) {
        $query->whereIn('city_id', $cityIds);
      });
    }

    $tripId =  $this->tripId;
    if($tripId !== null) {
      $languageVersions = $languageVersions->whereHas('article.visit', function($query) use ($tripId) {
        $query->where('trip_id', $tripId);
      });
    }

    $userId = $this->userId;
    if($userId !== null) {
      $languageVersions = $languageVersions->whereHas('article.visit', function($query) use ($userId) {
        $query->whereHas('visitUsers', function($query) use ($userId) {
          $query->where('user_id', $userId);
        });
      });
    }

    $languageVersions = $languageVersions->orderBy('translated_article.published', 'desc');
    
    if(isset($this->limit)) {
      $languageVersions = $languageVersions->limit($this->limit);
    }
    
    return $languageVersions->offset($this->offset)->get();
  }
  
}