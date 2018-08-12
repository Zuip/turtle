<?php

namespace App\Services\Cities;

use App\Integrations\Cities\Cities;

class CitiesDataFetcher {

  public function getWithIdsAndLanguage($cityIds, $language) {
    
    $citiesFetcher = new Cities();
    $citiesByCountries = $citiesFetcher->getWithIdsAndLanguage(
      $cityIds,
      $language
    )->getData();

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