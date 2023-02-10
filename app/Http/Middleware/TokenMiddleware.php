<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Firebase\JWT\JWT;
use Firebase\JWT\SignatureInvalidException;
use Firebase\JWT\BeforeValidException;
use Firebase\JWT\ExpiredException;
use DomainException;
use InvalidArgumentException;
use UnexpectedValueException;
use Firebase\JWT\Key;

class TokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $key = 'keytestaaaaaaaaa';
        $base = $request->header('Authorization');
        $separated = explode(" ", $base);
        $token = $separated[1];
        
        $decoded = JWT::decode($token, new Key($key, 'HS256'));
        if ( $request->email = $decoded->user){
            return $next($request);
        }
        return response()->json(['message' => 'nope'], 418);
        
        
        /*$user = Auth::user();
        if ( $user != null && $user->email == 'juan@juan.es' ) {
            return $next($request);
        }
        return response()->json(['message' => 'User is not Juan'], 418);*/
    }
}
