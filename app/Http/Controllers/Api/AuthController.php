<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class AuthController extends Controller
{

    
    public function login(Request $request)
    {
        
        if(!Auth::attempt($request->only('email','password'))){
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }

        $user = User::where('email', $request->email)->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer'
        ]);

    }
    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response()->json([
            'message' => 'Success logout'
        ]);
    }
    public function users()
    {
        $users = User::get();
        return $users;
        
    }
}
