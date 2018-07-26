<?php namespace App\Integrations\Users;

use App\Services\CRUD\ApiGet;

class User {
  
  public function getWithId($id) {
    $apiGet = new ApiGet(env('SERVICE_USERS_URL'));
    $apiGet->callGet(
      '/api/users/' . urlencode($id)
    );
    return $apiGet;
  }

  public function getWithUsername($username) {
    $apiGet = new ApiGet(env('SERVICE_USERS_URL'));
    $apiGet->callGet(
      '/api/users?username=' . urlencode($username)
    );
    return $apiGet;
  }
  
  public function getWithUsernameAndPassword($username, $password) {
    $apiGet = new ApiGet(env('SERVICE_USERS_URL'));
    $apiGet->callGet(
      '/api/users'
      . '?username=' . urlencode($username)
      . '&password=' . urlencode($password)
    );
    return $apiGet;
  }
}