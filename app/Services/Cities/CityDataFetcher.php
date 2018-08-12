<?php

namespace App\Services\Cities;

use App\Integrations\Cities\City;
use App\Models\Articles\IArticleLanguageVersion;
use App\Models\Cities\TranslatedCity;

class CityDataFetcher {

  public function getWithArticleLanguageVersion(IArticleLanguageVersion $articleLanguageVersion) {
    
    $language = $articleLanguageVersion->language;
    $cityId = $articleLanguageVersion->article->visit->city_id;

    $cityFetcher = new City();
    $city = $cityFetcher->getWithIdAndLanguage($cityId, $language)->getData();

    $cityData = [
      "id" => $city["id"],
      "name" => $city["name"],
      "urlName" => $city["urlName"],
      "country" => [
        "id" => $city["country"]["id"],
        "name" => $city["country"]["name"],
        "urlName" => $city["country"]["urlName"]
      ]
    ];

    return $cityData;
  }

  public function getWithCountryUrlNameAndCityUrlNameAndLanguage($countryUrlName, $cityUrlName, $language) {

    $cityFetcher = new City();
    $city = $cityFetcher->getWithCountryUrlNameAndCityUrlNameAndLanguage(
      $countryUrlName,
      $cityUrlName,
      $language
    )->getData();

    $cityData = [
      "id" => $city["id"],
      "name" => $city["name"],
      "urlName" => $city["urlName"],
      "country" => [
        "id" => $city["country"]["id"],
        "name" => $city["country"]["name"],
        "urlName" => $city["country"]["urlName"]
      ]
    ];

    return $cityData;
  }
}