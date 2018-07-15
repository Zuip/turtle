<?php namespace App\Integrations\Users;

use App\Services\CRUD\ApiGet;

class User {
  
  public function getWithId($id) {
    $apiGet = new ApiGet(env('SERVICE_USERS_URL'));
    $apiGet->callGet(
      '/api/users/' . $id
    );
    return $apiGet;
  }
  
  public function getWithUsernameAndPassword($username, $password) {
    $apiGet = new ApiGet(env('SERVICE_USERS_URL'));
    $apiGet->callGet(
      '/api/users/' . $username . '/password/' . $password
    );
    return $apiGet;
  }
}