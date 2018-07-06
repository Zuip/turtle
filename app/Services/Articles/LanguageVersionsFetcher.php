<?php namespace App\Services\Articles;

use App\Models\Articles\ArticleLanguageVersion;
use Illuminate\Support\Facades\DB;

class LanguageVersionsFetcher {
  
  private $limit;
  private $offset;
  
  public function __construct() {
    $this->limit = null;
    $this->offset = 0;
  }
  
  public function setLimit($limit) {
    $this->limit = $limit;
  }
  
  public function setOffset($offset) {
    $this->offset = $offset;
  }
  
  public function getWithLanguageCode($languageCode) {
    
    $languageVersions = ArticleLanguageVersion::where('published', 1)
    ->join('article', 'article.id', '=', 'translated_article.article_id')
    ->whereHas('language', function ($q) use($languageCode) {
      $q->where('code', $languageCode);
    })
    ->orderBy('article.timestamp', 'desc');
    
    if(isset($this->limit)) {
      $languageVersions = $languageVersions->limit($this->limit);
    }
    
    return $languageVersions->offset($this->offset)->get();
  }
  
}