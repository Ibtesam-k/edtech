<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\CourseController;
use App\Http\Controllers\Api\V1\AssignmentController;
use App\Http\Controllers\Api\V1\SubmissionController;

 Route::group([ 'middleware' => 'jwtauth', 'prefix' => 'auth',], function () {

    Route::post('logout',  [AuthController::class, 'logout']);
    Route::post('refresh',  [AuthController::class, 'refresh']);
    Route::post('me',  [AuthController::class, 'me']);

}); 

Route::group([ 'prefix' => 'auth'], function () {

    Route::post('login',  [AuthController::class, 'login']);
    Route::post('register',  [AuthController::class, 'register']);
}); 




Route::group(['prefix'=>'v1','namespace'=>'App\Http\Controllers\Api\V1',"middleware"=>'jwtauth'], function ()
{
    Route::apiResource('users',UserController::class);
    Route::apiResource('courses',CourseController::class);
    Route::apiResource('assignments',AssignmentController::class);
    Route::get('submissions/logs',[SubmissionController::class, 'logs']);
    Route::apiResource('submissions',SubmissionController::class)->except(['update']);
    Route::post('submissions/bulk',[SubmissionController::class, 'blukStore']);
});