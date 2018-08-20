<?php namespace App\Integrations\Cities;

use App\Services\CRUD\ApiGet;

class Countries {
  
  public function getWithLanguage($language) {

    $apiGet = new ApiGet(env('SERVICE_CITIES_URL'));

    $apiGet->callGet(
      "/api/countries?language=" . $language
    );

    return $apiGet;
  }
}