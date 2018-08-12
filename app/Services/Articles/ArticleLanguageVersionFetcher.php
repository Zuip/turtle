<?php namespace App\Services\Articles;

use App\Models\Articles\IArticle;
use App\Models\Articles\ArticleLanguageVersion;
use App\Services\Cities\CityDataFetcher;

class ArticleLanguageVersionFetcher implements IArticleLanguageVersionFetcher {
  
  private $throwExceptionOnNotFound;
  
  public function __construct() {
    $this->throwExceptionOnNotFound = true;
  }
  
  public function setThrowExceptionOnNotFound($throwExceptionOnNotFound) {
    $this->throwExceptionOnNotFound = $throwExceptionOnNotFound;
  }
  
  public function getWithArticleAndLanguage(IArticle $article, $language) {
    
    $articleLanguageVersion = $article->languageVersions()
                                      ->where('published', 1)
                                      ->where('language', $language)
                                      ->first();
    
    $this->validate($articleLanguageVersion);
    
    return $articleLanguageVersion;
  }
  
  public function getWithUrlNamesAndLanguage($tripUrlName, $countryUrlName, $cityUrlName, $language) {
    
    $cityDataFetcher = new CityDataFetcher();
    $city = $cityDataFetcher->getWithCountryUrlNameAndCityUrlNameAndLanguage(
      $countryUrlName,
      $cityUrlName,
      $language
    );

    $articleLanguageVersion = ArticleLanguageVersion::where('published', 1)
    ->where('language', $language)
    ->whereHas('article', function($query) use ($tripUrlName, $city, $language) {
      $query->whereHas('visit', function($query) use ($tripUrlName, $city, $language) {
        $query->whereHas('trip', function($query) use ($tripUrlName, $language) {
          $query->whereHas('languageVersions', function($query) use ($tripUrlName, $language) {
            $query->where('url_name', $tripUrlName)
            ->where('language', $language);
          });
        })->where('city_id', $city["id"]);
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