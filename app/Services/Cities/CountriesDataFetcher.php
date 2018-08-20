<?php

namespace App\Services\Cities;

use App\Integrations\Cities\Countries;

class CountriesDataFetcher {

  public function getWithLanguage($language) {

    $countriesFetcher = new Countries();
    $countries = $countriesFetcher->getWithLanguage(
      $language
    )->getData();

    return $countries;
  }
}