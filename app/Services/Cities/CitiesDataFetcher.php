<?php

namespace App\Services\Cities;

use App\Integrations\Cities\Cities;
use App\Integrations\Cities\Country;

class CitiesDataFetcher {

  public function getWithLanguage($language) {

    $citiesFetcher = new Cities();
    $citiesByCountries = $citiesFetcher->getWithLanguage(
      $language
    )->getData();

    return array_values(
      $this->citiesByCountryArrayToCitiesArray($citiesByCountries) 
    );
  }

  public function getWithCountryUrlNameAndLanguage($countryUrlName, $language) {

    $countryFetcher = new Country();
    $country = $countryFetcher->getWithUrlNameAndLanguage(
      $countryUrlName,
      $language
    )->getData();

    $citiesFetcher = new Cities();
    $cities = $citiesFetcher->getWithCountryIdAndLanguage(
      $country["id"],
      $language
    )->getData();

    return $cities;
  }

  public function getWithIdsAndLanguage($cityIds, $language) {
    
    if(count($cityIds) === 0) {
      return [];
    }

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
          "latitude" => $city["latitude"],
          "longitude" => $city["longitude"],
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