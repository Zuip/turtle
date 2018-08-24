<?php namespace App\Integrations\Cities;

use App\Services\CRUD\ApiGet;

class CityTranslations {
  
  public function getWithId($cityId) {

    $apiGet = new ApiGet(env('SERVICE_CITIES_URL'));

    $apiGet->callGet(
      "/api/cities/" . $cityId . "/translations"
    );

    return $apiGet;
  }
}