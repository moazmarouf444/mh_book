<?php

namespace App\Http\Middleware\Api;

use Closure;
use JWTAuth;
use Exception;
use Response;
use App\Traits\ResponseTrait;

class JwtOptionalMiddleware
{
    use ResponseTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            JWTAuth::parseToken()->authenticate();
        }
        catch (Exception $e) {
            return $next($request);
        }
        return $next($request);
    }


}
