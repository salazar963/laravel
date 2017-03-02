<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class ApiAuthController extends Controller
{
    public function userAuth(Request $request){
        $credenciales = $request->only('email', 'password');
        $token = null;

        try{
            if(! $token = JWTAuth::attempt($credenciales)) {
                return response()->json(['error' => 'credenciales_invalidas']);
            }
        }catch(JWTException $ex){
            return response()->json(['error' => 'Error_autenticacion'], 500);
        }

        return response()->json(compact('token'));
    }
}
