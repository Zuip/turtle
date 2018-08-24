<?php namespace App\Integrations\Cities;

use App\Services\CRUD\ApiGet;

class CountryTranslations {
  
  public function getWithId($countryId) {

    $apiGet = new ApiGet(env('SERVICE_CITIES_URL'));

    $apiGet->callGet(
      "/api/countries/" . $countryId . "/translations"
    );

    return $apiGet;
  }
}