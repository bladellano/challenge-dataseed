<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    UserController,
    AuthController,
    PasswordResetRequestController
};

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/** Middleware */
Route::group(['middleware' => ['apiJwt']], function () {
    Route::get('users',[UserController::class,'index']);
});

/** Forgot */
Route::post('forgot', [PasswordResetRequestController::class,'sendPasswordResetLink']);
Route::get('response-password-reset', function(){
    return response()->json(['token' => $_GET['token']]);
});

/** Auth */
Route::post('auth/login', [AuthController::class,'login']);
Route::post('auth/logout', [AuthController::class,'logout']);
Route::post('auth/me', [AuthController::class,'me']);

/** Users */

