<?php

namespace App\Services\Cities;

use App\Integrations\Cities\CountryTranslations;

class CountryTranslationsDataFetcher {

  public function getWithId($countryId) {

    $countryTranslationsFetcher = new CountryTranslations();
    $countryTranslations = $countryTranslationsFetcher->getWithId(
      $countryId
    )->getData();

    return $countryTranslations;
  }
}