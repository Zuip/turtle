<?php

namespace App\Http\Middleware;

use Closure;
use \App\Services\Languages\LanguageService;
use \Illuminate\Http\Request;

class CheckLocale {
  
  public function handle(Request $request, Closure $next) {
    
    $language = $this->getLanguageFromRequest($request);

    if (!LanguageService::localeExists($language)) {
      return \Response::json(
        [ "error" => "Locale does not exist" ],
        404
      );
    }

    return $next($request);
  }
  
  private function getLanguageFromRequest(Request $request) {
    
    if(isset($request->language)) {
      return $request->language;
    }
    
    $a = \Illuminate\Support\Facades\Input::all();
    
    if($request->has('language')) {
      return $request->input('language');
    }
    
    return null;
  }
}