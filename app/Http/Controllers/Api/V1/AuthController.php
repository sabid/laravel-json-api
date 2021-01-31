<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\LoginRequest;
use App\Http\Requests\Api\V1\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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

    /**
     * Registration
     * @param RegisterRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request): \Illuminate\Http\JsonResponse
    {
        $user = User::create($request->validated());

        $token = $user->createToken('TokenNameTest')->accessToken;

        return response()->json(['token' => $token], Response::HTTP_CREATED);
    }
}
