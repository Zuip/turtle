<?php namespace App\Integrations\Cities;

use App\Services\CRUD\ApiGet;

class Cities {
  
  public function getWithIdsAndLanguage($cityIds, $language) {
    $apiGet = new ApiGet(env('SERVICE_CITIES_URL'));
    $apiGet->callGet(
      "/api/cities?language=" . $language
      . "&ids=" . implode(",", $cityIds)
    );
    return $apiGet;
  }

  public function getWithCountryIdAndLanguage($countryId, $language) {
    $apiGet = new ApiGet(env('SERVICE_CITIES_URL'));
    $apiGet->callGet(
      "/api/countries/" . $countryId . "/cities?language=" . $language
    );
    return $apiGet;
  }
}