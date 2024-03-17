<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            ]);

        $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],                     
                'password' => Hash::make($validatedData['password']),
         ]);
         
        $token = $user->createToken('auth_token')->plainTextToken;
        
        return response()->json([
                        'access_token' => $token,
                        'token_type' => 'Bearer',
        ]);
    }

    //log in user
    public function login(Request $request) {        
        if (!Auth::attempt($request->only('email', 'password'))) {
        return response()->json([
        'message' => 'Invalid login details'
                   ], 401);
               }
        
        $user = User::where('email', $request['email'])->firstOrFail();
        $delete = $user->tokens()->delete();
        $token = $user->createToken('auth_token')->plainTextToken;
        
        return response()->json([
                   'access_token' => $token,
                   'token_type' => 'Bearer',
        ]);

    }

    //log out user
    public function logout(Request $request) {        
        $user = User::where('email', $request['email'])->firstOrFail();

        $delete = $user->tokens()->delete();
        // TODO: Implement better error handling
        if (!$delete) {
            return response()->json([
                'error' => 'Unable to logout'
            ]);
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Successfully logged out'
        ]);
    }
}
