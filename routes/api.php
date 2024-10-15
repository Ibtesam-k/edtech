<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\V1\UserController;

 Route::group([

    'middleware' => 'jwtauth',
    'prefix' => 'auth',

], function () {

    Route::post('login',  [AuthController::class, 'login'])->withoutMiddleware('jwtauth');
    Route::post('logout',  [AuthController::class, 'logout']);
    Route::post('refresh',  [AuthController::class, 'refresh']);
    Route::post('me',  [AuthController::class, 'me']);

}); 





Route::group(['prefix'=>'v1', 'namespace'=>'App\Http\Controllers\Api\V1',"middleware"=>'jwtauth'], function ()
{
    Route::apiResource('users',UserController::class);
});