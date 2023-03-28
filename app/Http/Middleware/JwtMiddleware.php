<?php

namespace App\Http\Middleware;

use App\Http\Traits\HttpResponse;
use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use JWTAuth;
use Exception;


class JwtMiddleware
{
    use HttpResponse;
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return $this->responseJson(null,'Token is Invalid',false);

            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return $this->responseJson(null,'Token is Expired',false);
            }else{
                return $this->responseJson(null,'Authorization Token not found',false);
            }
        }
        return $next($request);


    }
}
