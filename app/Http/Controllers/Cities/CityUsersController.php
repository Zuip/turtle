<?php namespace App\Http\Controllers\Cities;

use App\Http\Controllers\Controller;
use App\Integrations\Users\Users;
use App\Services\Cities\CityDataFetcher;
use App\Models\Trips\VisitUser;
use Illuminate\Http\Request;
use Response;

class CityUsersController extends Controller {
  
  public function get(Request $request) {
    
    if(!$request->has("language")) {
      return Response::json(
        [
          "success" => false,
          "message" => "Missing language parameter"
        ],
        404
      );
    }
    
    $cityDataFetcher = new CityDataFetcher();
    $city = $cityDataFetcher->getWithCountryUrlNameAndCityUrlNameAndLanguage(
      $request->route("countryUrlName"),
      $request->route("cityUrlName"),
      $request->input("language")
    );

    $visitUsers = VisitUser::join(
      'city_visit',
      'city_visit_user.city_visit_id',
      '=',
      'city_visit.id'
    )->where(
      'city_visit.city_id',
      $city["id"]
    )->get();

    $userIds = [];
    foreach($visitUsers as $visitUser) {
      $userIds[] = $visitUser->user_id;
    }
    
    $userIds = array_unique($userIds);

    $usersFetcher = new Users();
    $users = $usersFetcher->getWithIds($userIds);

    return \Response::json($users->getData());
  }
}