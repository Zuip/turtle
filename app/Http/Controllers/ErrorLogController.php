<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;

class ErrorLogController extends Controller {

  public function post(Request $request) {

    $fp = fopen(
      '../storage/logs/frontend_errors.txt',
      'w'
    );

    fwrite(
      $fp,
      date("Y-m-d h:i", time())
      . ":\n"
      . $request->input('errorText')
    );
    
    fclose($fp);

    return Response::json([]);
  }
}