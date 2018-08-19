<?php namespace App\Integrations\Cities;

use App\Services\CRUD\ApiGet;

class Country {
  
  public function getWithUrlNameAndLanguage($urlName, $language) {

    $apiGet = new ApiGet(env('SERVICE_CITIES_URL'));

    $apiGet->callGet(
      "/api/countries/" . $urlName
        . "?language=" . $language
    );

    return $apiGet;
  }
}