<?php

use CloudCreativity\LaravelJsonApi\Facades\JsonApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\ForgotPasswordController;
use App\Http\Controllers\Api\V1\ResetPasswordController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// Add version and folder organization to the API
Route::group([
    'prefix' => 'api/v1',
    'as' => 'api.',
    /* 'namespace' => 'Api\V1', */
], function () {

    // Login
    Route::post('login', [AuthController::class, 'login'])->name('login');
    // Register
    Route::post('register', [AuthController::class, 'register'])->name('register');
    // Forgot Password, send email to the user
    Route::post('forgot-password', ForgotPasswordController::class)->name('password.email');
    // Reset Password
    Route::post('reset-password', ResetPasswordController::class)->name('reset.password');

    // Protect the router, to be access only with a valid token
    Route::middleware('auth:api')->group(function () {

        // Get the user info
        /*
        Route::post('/user', function (Request $request) {
            return $request->user();
        })->name('user');
        */
    });

});

JsonApi::register('default')->routes(function ($api) {
    $api->resource('users');
    $api->resource('products');
});
