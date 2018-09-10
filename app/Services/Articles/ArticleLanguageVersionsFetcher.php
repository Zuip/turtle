<?php namespace App\Services\Articles;

use App\Models\Articles\IArticle;
use App\Models\Articles\ArticleLanguageVersion;
use App\Services\Cities\CityDataFetcher;

class ArticleLanguageVersionsFetcher implements IArticleLanguageVersionsFetcher {
  
  private $cityUrlName;
  private $countryUrlName;
  private $language;
  private $tripUrlName;

  public function __construct() {
    $this->cityUrlName = null;
    $this->countryUrlName = null;
    $this->language = null;
    $this->tripUrlName = null;
  }

  public function setCityUrlName($cityUrlName) {
    $this->cityUrlName = $cityUrlName;
  }

  public function setCountryUrlName($countryUrlName) {
    $this->countryUrlName = $countryUrlName;
  }

  public function setLanguage($language) {
    $this->language = $language;
  }

  public function setTripUrlName($tripUrlName) {
    $this->tripUrlName = $tripUrlName;
  }

  public function get() {
    
    $tripUrlName = $this->tripUrlName;
    $language = $this->language;

    $city = null;
    if($this->countryUrlName !== null && $this->cityUrlName !== null) {
      $cityDataFetcher = new CityDataFetcher();
      $city = $cityDataFetcher->getWithCountryUrlNameAndCityUrlNameAndLanguage(
        $this->countryUrlName,
        $this->cityUrlName,
        $language
      );
    }

    return ArticleLanguageVersion::join(
      'article',
      'translated_article.article_id',
      '=',
      'article.id'
    )
    ->where('translated_article.language', $language)
    ->whereNotNull('translated_article.published')
    ->whereHas('article.visit', function($query) use ($tripUrlName, $city, $language) {
      
      $a = $query->whereHas('trip', function($query) use ($tripUrlName, $language) {
        $query->whereHas('languageVersions', function($query) use ($tripUrlName, $language) {
          $query->where('url_name', $tripUrlName)
          ->where('language', $language);
        });
      });

      if($city !== null) {
        $a->where('city_id', $city["id"]);
      }
    })
    ->orderBy('translated_article.published')
    ->get();
  }
}