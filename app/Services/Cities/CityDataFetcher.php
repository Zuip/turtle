<?php

namespace App\Services\Cities;

use App\Models\ILanguage;
use App\Models\Articles\IArticleLanguageVersion;
use App\Models\Cities\TranslatedCity;

class CityDataFetcher {
  
  private $limitToAttributes;

  public function __construct() {
    $this->limitToAttributes = [
      "id", "country", "name"
    ];
  }

  public function getWithArticleLanguageVersion(IArticleLanguageVersion $articleLanguageVersion) {
    
    $languageId = $articleLanguageVersion->language->id;
    $city = $articleLanguageVersion->article->visit->city;

    $translatedCity = null;
    foreach($city->languageVersions as $languageVersion) {
      if($languageVersion->language->id === $languageId) {
        $translatedCity = $languageVersion;
        break;
      }
    }

    $translatedCountry = null;
    foreach($city->country->languageVersions as $languageVersion) {
      if($languageVersion->language->id === $languageId) {
        $translatedCountry = $languageVersion;
        break;
      }
    }

    $cityData = [];
    if($this->chosen("id")  ) { $cityData["id"]   = $city->id;             }
    if($this->chosen("name")) { $cityData["name"] = $translatedCity->name; }
    if($this->chosen("country")) {
      $cityData["country"] = [
        "id" => $city->country->id,
        "name" => $translatedCountry->name
      ];
    }

    return $cityData;
  }

  private function chosen($attribute) {
    return in_array($attribute, $this->limitToAttributes);
  }
}