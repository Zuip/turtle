<?php

namespace App\Services\Trips;

use App\Models\Articles\IArticleLanguageVersion;

class TripDataFetcher {
  
  private $limitToAttributes;

  public function __construct() {
    $this->limitToAttributes = [
      "name", "urlName"
    ];
  }

  public function setLimitToAttributes($limitToAttributes) {
    $this->limitToAttributes = $limitToAttributes;
  }

  public function getWithArticleLanguageVersion(IArticleLanguageVersion $articleLanguageVersion) {
    
    $language = $articleLanguageVersion->language;
    $trip = $articleLanguageVersion->article->visit->trip;

    $translatedTrip = null;
    foreach($trip->languageVersions as $languageVersion) {
      if($languageVersion->language === $language) {
        $translatedTrip = $languageVersion;
        break;
      }
    }

    $tripData = [];
    
    if($this->chosen("name")) {
      $tripData["name"] = $translatedTrip->name;
    }

    if($this->chosen("urlName")) {
      $tripData["urlName"] = $translatedTrip->url_name;
    }

    return $tripData;
  }

  private function chosen($attribute) {
    return in_array($attribute, $this->limitToAttributes);
  }
}