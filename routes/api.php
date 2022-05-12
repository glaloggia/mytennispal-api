<?php

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

Route::middleware('auth:sanctum')->group(function(){
    Route::apiResource('message',\App\Http\Controllers\MessageController::class);
});

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::apiResource('venue', \App\Http\Controllers\VenueController::class);
Route::apiResource('event', \App\Http\Controllers\EventController::class);

Route::get('/mybookings/{myid}', [\App\Http\Controllers\RsvpController::class, 'myBookings']);
Route::apiResource('rsvp', \App\Http\Controllers\RsvpController::class);

Route::post('/auth/register', [\App\Http\Controllers\AuthController::class, 'register']);
Route::post('/auth/login', [\App\Http\Controllers\AuthController::class, 'login']);


