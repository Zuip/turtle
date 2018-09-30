<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;

use \App\Services\DefaultLanguageFetcher;

class IndexController extends Controller {

  public function get(Request $request) {

    $defaultLanguageFetcher = new DefaultLanguageFetcher();
    $defaultLanguageFetcher->setSessionLanguage(session("language"));

    if(isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
      $defaultLanguageFetcher->setHttpAcceptLanguage(
        $_SERVER['HTTP_ACCEPT_LANGUAGE']
      );
    }

    $defaultLanguage = $defaultLanguageFetcher->getDefaultLanguage();

    return view('layout/body', [
      "browserLanguage" => $defaultLanguage
    ]);
  }
}