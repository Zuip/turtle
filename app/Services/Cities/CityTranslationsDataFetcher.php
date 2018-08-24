<?php

namespace App\Services\Cities;

use App\Integrations\Cities\CityTranslations;

class CityTranslationsDataFetcher {

  public function getWithId($cityId) {

    $cityTranslationsFetcher = new CityTranslations();
    $cityTranslations = $cityTranslationsFetcher->getWithId(
      $cityId
    )->getData();

    return $cityTranslations;
  }
}