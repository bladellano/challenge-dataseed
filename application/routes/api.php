<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    UserController,
    AuthController,
    PasswordResetRequestController,
    RegisterController
};

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
*/

Route::get('/', function () {
    return 'Working...';
});

/** Middleware */
Route::group(['middleware' => ['apiJwt']], function () {
    /** Users */
    Route::resource('users', UserController::class);
});

/** Register */
Route::post('/register', [RegisterController::class,'register']);

/** Auth */
Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class,'login']);
    Route::post('/logout', [AuthController::class,'logout']);
    Route::post('/forgot', [PasswordResetRequestController::class,'sendPasswordResetLink']);
    Route::get('/response-password-reset', fn() => response()->json(['token' => $_GET['token']]));
    Route::post('/me', [AuthController::class,'me']);
});
