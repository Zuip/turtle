<?php namespace App\Http\Controllers;

use App\Integrations\Users\User;
use Illuminate\Http\Request;
use Response;

class UsersController extends Controller {
  
  public function get(Request $request) {
    
    if(!$request->has('username')) {
      // Here will later be a functionality for fetching
      // a list of users
      return Response::json([]);
    }

    // If name parameter is set, return only one user

    $userFetcher = new User();
    $user = $userFetcher->getWithUsername(
      $request->get('username')
    );
    
    if($user->getCode() !== 200) {
      return Response::json(
        null,
        $user->getCode()
      );
    }
    
    $userData = $user->getData();
    
    return Response::json($userData);
  }
}
