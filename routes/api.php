<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;
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
    'prefix' => 'v1',
    'as' => 'api.',
    'namespace' => 'Api\V1',
], function () {
    
    // Login
    Route::post('login', [AuthController::class, 'login']);

    // Protect the router, to be access only with a valid token
    Route::middleware('auth:api')->group(function () {

        // Get the user info
        Route::post('/user', function (Request $request) {
            return $request->user();
        });
    });

});
