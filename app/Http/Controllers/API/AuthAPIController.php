<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\GuardHelpers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;


class AuthAPIController extends ApiBaseController
{
    public function register(Request $request){

        $post_data = $request->validate([
            'name'=>'required|string',
            'email'=>'required|string|email|unique:users',
            'password'=>'required|min:8'
        ]);

        $user = User::create([
            'name' => $post_data['name'],
            'email' => $post_data['email'],
            'password' => Hash::make($post_data['password']),
        ]);

        $token = $user->createToken('authToken')->plainTextToken;

        return $this->sendResponse(
            ["access_token" => $token, "token_type" => "Bearer"],
            "Registered"
        );
    }

    public function login(Request $request): JsonResponse
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return $this->sendError(
                "Login information invalid."
            );
        }

        $user = User::where('email', $request['email'])->firstOrFail();
        $token = $user->createToken('authToken')->plainTextToken;

        return $this->sendResponse(
            ["access_token" => $token, "token_type" => "Bearer"],
            "Logged in."
        );
    }

    public function logout(Request $request){
        auth()->user()->tokens()->logout();

        return [
            'message'=>'Logged out'
        ];
    }
}
