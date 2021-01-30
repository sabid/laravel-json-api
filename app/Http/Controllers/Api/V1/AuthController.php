<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\LoginRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    /**
     * Login
     * @param LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request): \Illuminate\Http\JsonResponse
    {
        if (auth()->attempt($request->validated())) {
            $token = auth()->user()->createToken('TokenNameTest')->accessToken;
            return response()->json(['token' => $token], Response::HTTP_OK);
        }

        return response()->json(['error' => 'Unauthorised'], Response::HTTP_UNAUTHORIZED);
    }
}
