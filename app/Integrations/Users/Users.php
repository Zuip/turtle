<?php namespace App\Integrations\Users;

use App\Services\CRUD\ApiGet;

class Users {
  
  public function getWithIds($ids) {
    $apiGet = new ApiGet(env('SERVICE_USERS_URL'));
    $apiGet->callGet(
      '/api/users?ids=' . $this->urlFormatIds($ids)
    );
    return $apiGet;
  }

  private function urlFormatIds($ids) {
    return urlencode(
      implode(
        ',',
        $ids
      )
    );
  }
}