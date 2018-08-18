<?php namespace App\Services\Articles;

class ArticleLanguageVersionFetcher implements IArticleLanguageVersionFetcher {
  
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

  public function get($cityVisitIndex = 0) {
    
    $articleLanguageVersionsFetcher = new ArticleLanguageVersionsFetcher();
    $articleLanguageVersionsFetcher->setTripUrlName($this->tripUrlName);
    $articleLanguageVersionsFetcher->setCountryUrlName($this->countryUrlName);
    $articleLanguageVersionsFetcher->setCityUrlName($this->cityUrlName);
    $articleLanguageVersionsFetcher->setLanguage($this->language);
    $articleLanguageVersions = $articleLanguageVersionsFetcher->get();

    if(!isset($articleLanguageVersions[$cityVisitIndex - 1])) {
      return null;
    }

    $articleLanguageVersion = $articleLanguageVersions[$cityVisitIndex - 1];
    
    return $articleLanguageVersion;
  }
}