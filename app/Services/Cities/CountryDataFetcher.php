<?php

namespace App\Services\Cities;

use App\Integrations\Cities\Country;

class CountryDataFetcher {

  public function getWithUrlNameAndLanguage($countryUrlName, $language) {

    $countryFetcher = new Country();
    $country = $countryFetcher->getWithUrlNameAndLanguage(
      $countryUrlName,
      $language
    )->getData();

    return $country;
  }
}