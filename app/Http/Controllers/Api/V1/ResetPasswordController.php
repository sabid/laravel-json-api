<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\ResetPasswordRequest;
use Illuminate\Auth\Events\PasswordReset;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class ResetPasswordController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  ResetPasswordRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(ResetPasswordRequest $request)
    {
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->save();

                $user->setRememberToken(Str::random(60));

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? response()->json(['status' => __($status)], Response::HTTP_OK)
            : response()->json(['email' => __($status)], Response::HTTP_BAD_REQUEST );
    }
}
