<?php namespace App\Services\Trips;

use App\Models\Trips\TranslatedTrip;

class TripFetcher {

  public function getWithUrlNameAndLanguage($urlName, $language) {
    return TranslatedTrip::where('url_name', $urlName)
                         ->where('language', $language)
                         ->first();
  }

}