<?php namespace App\Services\Cities;

use App\Models\Cities\TranslatedCity;
use App\Services\Cities\CitiesByCountryGrouper;

class CitiesFetcher {
  
  public function getWithLanguage($language) {
    
    $cities = TranslatedCity::with([
      'base',
      'base.country',
      'base.country.languageVersions' => function($query) use ($language) {
        $query->whereHas('language', function($query) use ($language) {
          $query->where('code', $language);
        });
      }
    ])->whereHas('language', function($query) use ($language) {
      $query->where('code', $language);
    })->get();

    $citiesByCountryGrouper = new CitiesByCountryGrouper();
    $citiesByCountryGrouper->setCities($cities);
    return $citiesByCountryGrouper->getCitiesGroupedByCountries;
  }
}
