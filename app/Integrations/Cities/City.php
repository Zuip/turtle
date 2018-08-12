<?php namespace App\Integrations\Cities;

use App\Services\CRUD\ApiGet;

class City {
  
  public function getWithIdAndLanguage($id, $language) {
    $apiGet = new ApiGet(env('SERVICE_CITIES_URL'));
    $apiGet->callGet(
      "/api/cities/" . urlencode($id) . "?language=" . $language
    );
    return $apiGet;
  }

  public function getWithCountryUrlNameAndCityUrlNameAndLanguage($countryUrlName, $cityUrlName, $language) {
    $apiGet = new ApiGet(env('SERVICE_CITIES_URL'));
    $apiGet->callGet(
      "/api/countries/" . $countryUrlName
        . "/cities/" . $cityUrlName
        . "?language=" . $language
    );
    return $apiGet;
  }
}