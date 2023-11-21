<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('Inventory')->accessToken; 
            $success['name'] =  $user->name;
            $response = [
                'success' => true,
                'data'    => 'Logged in successfully',
                'token' => $success,
                'name' => $success['name'],
            ];
            return response()->json($response, 200);
        } 
        else{ 
            return response()->json(['error'=>'Unauthorised'], 401);
        } 
    }
}
