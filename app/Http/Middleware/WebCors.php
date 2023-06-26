<?php

namespace App\Http\Middleware;

use Closure;

class WebCors {
  public function handle($request, Closure $next) {
    $headers = [
      "Access-Control-Allow-Origin"  => "*",
      "Access-Control-Allow-Headers" => "Cache-Control, Content-Type, Accept, Access-Control-Request-Method",
      "Access-Control-Allow-Methods" => "POST, GET, OPTIONS, PUT, DELETE",
      "Access-Control-Max-Age"       => "1000",
    ];


    $response = $next($request);

    foreach ($headers as $key => $value) {
      $response->header($key, $value);
    }

    return $response;
  }
}
