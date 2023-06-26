<?php

namespace App\Http\Middleware\Api;

use Closure;
use JWTAuth;
use Response;
use Exception;
use Carbon\Carbon;
use App\Traits\ResponseTrait;

class JwtMiddleware
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
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                 $this->response('failed',__('auth.invalid_token'));
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                 $this->response('failed',__('auth.expired_token'));
            }else{
                 $this->response('failed',__('auth.invalid_token'));
            }
        }

     //    if (auth()->check() && auth()->user()->active == false) {
     //           auth()->user()->update(['code' => 1111 , 'code_expire' => Carbon::now()->addMinute()]);
     //           $this->response('needActive' , __('auth.not_active')  ,  ['token' => $request->header('Authorization')]);
     //    }
        return $next($request);
    }


}
