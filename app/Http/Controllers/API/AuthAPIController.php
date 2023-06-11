<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginAPIRequest;
use App\Models\User;
use Illuminate\Auth\GuardHelpers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;


class AuthAPIController extends ApiBaseController
{
    public function login(LoginAPIRequest $request): JsonResponse
    {
        $post_data = $request->validated();
        if (!Auth::attempt($request->only('email', 'password'))) {
            return $this->sendError(
                "Login information is invalid."
            );
        }

        $user = User::where('email', $request['email'])->firstOrFail();
        $token = $user->createToken('authToken')->plainTextToken;

        return $this->sendResponse(
            ["access_token" => $token, "token_type" => 'Bearer'],
            "Logged in."
        );
    }

    public function logout(Request $request){

        auth()->user()->currentAccessToken()->delete();

        return [
            'message'=>'Logged out'
        ];
    }
}
