<?php namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;

class UserLanguageController extends Controller {
  
  public function put(Request $request) {

    if(!in_array($request->input("language"), ["fi", "en"])) {
      return Response::json(null, 404);
    }

    session(["language" => $request->input("language")]);

    return Response::json(null);
  }
}
