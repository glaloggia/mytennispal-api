<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function (){

    Route::get('/dashboard',[\App\Http\Controllers\DashboardController::class,'dashboard'])->name('dashboard');
    Route::get('/token/create',[\App\Http\Controllers\DashboardController::class,'showTokenForm'])->name('token.showForm');
    Route::post('/token/create',[\App\Http\Controllers\DashboardController::class,'createToken'])->name('token.create');
    Route::post('/token/delete{token}',[\App\Http\Controllers\DashboardController::class,'deleteToken'])->name('token.delete');

});

//
//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
