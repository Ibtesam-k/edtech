<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\UserController;


Route::group(['prefix'=>'v1', 'namespace'=>'App\Http\Controllers\Api\V1'], function ()
{
    Route::apiResource('users',UserController::class);
});