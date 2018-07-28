<?php namespace App\Services\Trips;

use App\Models\Trips\TranslatedTrip;
use App\Services\Cities\CitiesByCountryGrouper;

class TripsFetcher {
  
  public function getWithUserIdAndLanguageCode($userId, $languageCode) {

    $trips = TranslatedTrip::with([
      'base',
      'base.visits.city',
      'base.visits.city.languageVersions' => function($query) use ($languageCode) {
        $query->whereHas('language', function($query) use ($languageCode) {
          $query->where('code', $languageCode);
        });
      },
      'base.visits.city.country',
      'base.visits.city.country.languageVersions' => function($query) use ($languageCode) {
        $query->whereHas('language', function($query) use ($languageCode) {
          $query->where('code', $languageCode);
        });
      }
    ])->whereHas('base.users', function($query) use ($userId) {
      $query->where('user_id', $userId);
    })->whereHas('language', function($query) use ($languageCode) {
      $query->where('code', $languageCode);
    })->get();
    
    $formattedTrips = [];
    foreach($trips as $trip) {
      $formattedTrips[] = $this->getFormattedTrip($trip);
    }

    return $formattedTrips;
  }

  private function getFormattedTrip($trip) {

    $formattedVisits = [];
    foreach($trip->base->visits as $visit) {
      $formattedVisits[] = $this->getFormattedVisit($visit);
    }

    return [
      "id" => $trip->base->id,
      "name" => $trip->name,
      "urlName" => $trip->url_name,
      "visits" => $formattedVisits
    ];
  }

  private function getFormattedVisit($visit) {
    return [
      "start" => $visit->visit_start,
      "end" => $visit->visit_end,
      "article" => [
        "id" => $visit->article_id
      ],
      "city" => [
        "name" => $visit->city->languageVersions[0]->name,
        "country" => [
          "name" => $visit->city->country->languageVersions[0]->name
        ]
      ]
    ];
  }
}