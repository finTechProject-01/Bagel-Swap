<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GlobalSettingsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function (){
    Route::get('login', function() {
        return response()->json(['message' => 'Unauthorized.'], 401);
    });
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::post('register',[AuthController::class,'register']);
    Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
    Route::middleware(['auth:sanctum'])->group(function(){
        Route::get('settings',[GlobalSettingsController::class,'index']);
        Route::post('settings',[GlobalSettingsController::class,'store']);
        Route::put('settings/{id}',[GlobalSettingsController::class,'update']);
        Route::delete('settings/{id}',[GlobalSettingsController::class,'destroy']);
    });

});
