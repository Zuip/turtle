<?php namespace App\Http\Controllers;

use App\Integrations\Users\User;
use Illuminate\Http\Request;
use Response;

class SessionController extends Controller {
  
  public function login(Request $request) {
    
    if(!$request->has('username') || !$request->has('password')) {
      return Response::json(null, 404);
    }
    
    $userFetcher = new User();
    $user = $userFetcher->getWithUsernameAndPassword(
      $request->get('username'),
      $request->get('password')
    );
    
    if($user->getCode() !== 200) {
      return Response::json(
        null,
        $user->getCode()
      );
    }
    
    $userData = $user->getData();
    
    $request->session()->put("userId", $userData["id"]);
    
    return Response::json($userData);
  }
  
  public function logout(Request $request) {
    $request->session()->forget('userId');
    return Response::json(null);
  }
  
  public function getCurrentUser(Request $request) {
    
    if(!$request->session()->has('userId')) {
      return Response::json(null, 404);
    }
    
    $userFetcher = new User();
    $user = $userFetcher->getWithId(
      $request->session()->get('userId')
    );
    
    return Response::json($user->getData());
  }
}
