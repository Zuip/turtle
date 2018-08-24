<?php

namespace App\Services\Trips;

use App\Models\Trips\TranslatedTrip;

class TripTranslationsDataFetcher {

  public function getWithId($tripId) {

    $translatedTrips = TranslatedTrip::where('trip_id', $tripId)->get();

    $result = [];

    foreach($translatedTrips as $translatedTrip) {
      $result[] = [
        "id" => $translatedTrip->base->id,
        "language" => $translatedTrip->language,
        "name" => $translatedTrip->name,
        "urlName" => $translatedTrip->url_name
      ];
    }

    return $result;
  }
}