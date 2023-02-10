<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;

class ApiAuthController extends Controller {

    function __construct(){
        $this->middleware('auth:api')->only(['request', 'logout']);
    }
    
    function login(Request $request) {
        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $user = Auth::user(); //$request->user();
        $tokenResult = $user->createToken('Access Token');
        $token = $tokenResult->token;
        $token->save();
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($token->expires_at)->toDateTimeString()
        ], 200);
    }

    function logout(Request $request) {
        $request->user()->token()->revoke();
        return response()->json(['message' => 'Logged out']);
    }
    
    function register(Request $request) {
        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);
        } catch(\Exception $e) {
            return response()->json(['message' => 'User not created'], 418);
        }
        return response()->json(['message' => 'User created'], 201);
    }

    function solarquery() {
        $lat = 37.18817;
        $lon = -3.60667;
        $sunrisehour = date_sunrise(time(),SUNFUNCS_RET_STRING,$lat,$lon,90,1);
        $sunsethour  = date_sunset(time(),SUNFUNCS_RET_STRING,$lat,$lon,90,1);
        
        $sunriseparts = explode(":",$sunrisehour);
        $sunsetparts = explode(":",$sunsethour);
        
        $sunrise = $sunriseparts[0]+($sunriseparts[1]/60);
        $sunset = $sunsetparts[0]+($sunsetparts[1]/60);
        
        $interpolation = self::interpolate( $sunrise, $sunset );

        return response()->json([
            'cos:'      => cos($interpolation),
            'sin:'      => sin($interpolation),
            'sensor1:'  => rand(0, 100) / 100,
            'sensor2:'  => rand(0, 100) / 100,
            'sensor3:'  => rand(0, 100) / 100,
            'sensor4:'  => rand(0, 100) / 100
        ]);
    }
    
    function interpolate( $sunrise, $sunset ) {
        $minutes = date("i")/60;
        $now = date("H")+1+$minutes;
        $halfpi = pi()/2;
        $interpolation = -$halfpi+(((pi())/($sunset-$sunrise))*($now-$sunrise));
        //$interpolation = $sunset;
        return $interpolation;
    }
}