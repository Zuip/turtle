<?php

namespace App\Services\Cities;

use App\Integrations\Cities\Cities;
use App\Integrations\Cities\Country;

class CitiesDataFetcher {

  public function getWithCountryUrlNameAndLanguage($countryUrlName, $language) {

    $countryFetcher = new Country();
    $country = $countryFetcher->getWithUrlNameAndLanguage(
      $countryUrlName,
      $language
    )->getData();

    $citiesFetcher = new Cities();
    $citiesByCountries = $citiesFetcher->getWithCountryIdAndLanguage(
      $country["id"],
      $language
    )->getData();

    return $citiesByCountries;
  }

  public function getWithIdsAndLanguage($cityIds, $language) {
    
    $citiesFetcher = new Cities();
    $citiesByCountries = $citiesFetcher->getWithIdsAndLanguage(
      $cityIds,
      $language
    )->getData();

    return $this->citiesByCountryArrayToCitiesArray($citiesByCountries);
  }

  private function citiesByCountryArrayToCitiesArray($citiesByCountries) {

    $citiesData = [];

    foreach($citiesByCountries as $country) {
      foreach($country["cities"] as $city) {
        $citiesData[$city["id"]] = [
          "id" => $city["id"],
          "name" => $city["name"],
          "urlName" => $city["urlName"],
          "country" => [
            "id" => $country["id"],
            "name" => $country["name"],
            "urlName" => $country["urlName"]
          ]
        ];
      }
    }

    return $citiesData;
  }
}