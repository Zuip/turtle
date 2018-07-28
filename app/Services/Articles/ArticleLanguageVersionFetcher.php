<?php namespace App\Services\Articles;

use App\Models\Articles\IArticle;
use App\Models\Articles\ArticleLanguageVersion;

class ArticleLanguageVersionFetcher implements IArticleLanguageVersionFetcher {
  
  private $throwExceptionOnNotFound;
  
  public function __construct() {
    $this->throwExceptionOnNotFound = true;
  }
  
  public function setThrowExceptionOnNotFound($throwExceptionOnNotFound) {
    $this->throwExceptionOnNotFound = $throwExceptionOnNotFound;
  }
  
  public function getWithArticleAndLanguageId(IArticle $article, $languageId) {
    
    $articleLanguageVersion = $article->languageVersions()
                                      ->where('published', 1)
                                      ->where('language_id', $languageId)
                                      ->first();
    
    $this->validate($articleLanguageVersion);
    
    return $articleLanguageVersion;
  }
  
  public function getWithUrlNamesAndLanguageId($tripUrlName, $countryUrlName, $cityUrlName, $languageId) {
    
    $articleLanguageVersion = ArticleLanguageVersion::where('published', 1)
    ->where('language_id', $languageId)
    ->whereHas('article', function($query) use ($tripUrlName, $countryUrlName, $cityUrlName, $languageId) {
      $query->whereHas('visit', function($query) use ($tripUrlName, $countryUrlName, $cityUrlName, $languageId) {
        $query->whereHas('trip', function($query) use ($tripUrlName, $languageId) {
          $query->whereHas('languageVersions', function($query) use ($tripUrlName, $languageId) {
            $query->where('url_name', $tripUrlName)
            ->where('language_id', $languageId);
          });
        })->whereHas('city', function($query) use ($countryUrlName, $cityUrlName, $languageId) {
          $query->whereHas('languageVersions', function($query) use ($cityUrlName, $languageId) {
            $query->where('url_name', $cityUrlName)
            ->where('language_id', $languageId);
          })->whereHas('country', function($query) use ($countryUrlName, $languageId) {
            $query->whereHas('languageVersions', function($query) use ($countryUrlName, $languageId) {
              $query->where('url_name', $countryUrlName)
              ->where('language_id', $languageId);
            });
          });;
        });
      });
    })
    ->first();

    $this->validate($articleLanguageVersion);
    
    return $articleLanguageVersion;
  }
  
  private function validate($articleLanguageVersion) {
    
    if(!$this->throwExceptionOnNotFound) {
      return;
    }
    
    if($articleLanguageVersion == null) {
      throw new \App\Exceptions\ModelNotFoundException(
        'Article language version does not exist!'
      );
    }
  }
}