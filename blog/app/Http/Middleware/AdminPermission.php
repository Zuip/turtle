<?php

namespace App\Http\Middleware;

use Closure;

class AdminPermission {
  
  public function handle($request, Closure $next) {
    
    if (!\Auth::check() || \Auth::user()->permissionlevel != "admin") {
      return \Response::json(array("error" => "Resource does not exist"), 404);
    }
    
    return $next($request);
  }
}