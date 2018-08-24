<?php

namespace App\Services\Cities;

use App\Integrations\Cities\City;
use App\Models\Articles\IArticleLanguageVersion;
use App\Models\Cities\TranslatedCity;

class CityDataFetcher {

  public function getWithIdAndLanguage($cityId, $language) {
    
    $cityFetcher = new City();
    $city = $cityFetcher->getWithIdAndLanguage(
      $cityId,
      $language
    )->getData();

    return $this->getCityData($city);
  }

  public function getWithArticleLanguageVersion(IArticleLanguageVersion $articleLanguageVersion) {
    
    $language = $articleLanguageVersion->language;
    $cityId = $articleLanguageVersion->article->visit->city_id;

    $cityFetcher = new City();
    $city = $cityFetcher->getWithIdAndLanguage(
      $cityId,
      $language
    )->getData();

    return $this->getCityData($city);
  }

  public function getWithCountryUrlNameAndCityUrlNameAndLanguage($countryUrlName, $cityUrlName, $language) {

    $cityFetcher = new City();
    $city = $cityFetcher->getWithCountryUrlNameAndCityUrlNameAndLanguage(
      $countryUrlName,
      $cityUrlName,
      $language
    )->getData();

    return $this->getCityData($city);
  }

  private function getCityData($city) {
    return [
      "id" => $city["id"],
      "name" => $city["name"],
      "urlName" => $city["urlName"],
      "country" => [
        "id" => $city["country"]["id"],
        "name" => $city["country"]["name"],
        "urlName" => $city["country"]["urlName"]
      ]
    ];
  }
}