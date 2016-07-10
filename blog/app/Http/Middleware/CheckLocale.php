<?php

namespace App\Http\Middleware;

use Closure;

class CheckLocale {
  
  public function handle($request, Closure $next) {
    
    if (!\App\Http\Controllers\LanguageController::localeExists($request->language)) {
      return \Response::json(array("error" => "Locale does not exist"), 404);
    }

    return $next($request);
  }
}