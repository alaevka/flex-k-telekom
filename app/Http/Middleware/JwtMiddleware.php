<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Collection;
use Ahc\Jwt\JWT;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->hasHeader('Authorization')) {
            $appJwtKeyEncoded = new JWT(
                config('app.JWT_SECRET'),
                config('app.JWT_ALGO'),
            );
            $jwtData = new Collection(
                $appJwtKeyEncoded->decode($request->bearerToken())
            );
            if ($expiredDate = $jwtData->get('exp') and time() > $expiredDate) {
                throw new AuthenticationException('Token expired.');
            }
        } else {
            throw new AuthenticationException('Auth parameters are not setted.');
        }
        return $next($request);
    }
}
