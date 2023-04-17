<?php

use App\Http\ApiClasses\WeatherAPI;
use App\Http\Controllers\ContactController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/get-weather', [WeatherAPI::class, 'getWeather'])->name('get-weather');
Route::post('/get-weather-location', [WeatherAPI::class, 'getWeatherLocations'])->name('get-weather-location');
Route::post('/contact', [ContactController::class, 'store'])->name('store-contact');
Route::get('/contacts', [ContactController::class, 'show'])->name('store-show');
