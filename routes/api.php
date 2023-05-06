<?php

use App\Http\ApiClasses\NewsAPI;
use App\Http\ApiClasses\WeatherAPI;
use App\Http\Controllers\ApiMakerController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ScrapController;
use App\Http\Controllers\HorizonController;
use App\Http\Controllers\SwaggerController;
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
//api maker /////////
Route::post('/api-maker', [ApiMakerController::class, 'makeApi'])->name('apimaker.make-model');

/**API_MAKER**/
Route::apiResource('/api-maker/letter20230506123112', \App\Http\Controllers\Letter20230506123112Controller::class );
Route::apiResource('/api-maker/letter20230506122459', \App\Http\Controllers\Letter20230506122459Controller::class );






//news ///////////
Route::get('/get-news', [NewsAPI::class, 'getNews'])->name('get-news');
Route::post('/projects/news', [NewsController::class, 'submitForm'])->name('submitFormNews');

//weather ///////////
Route::get('/get-weather', [WeatherAPI::class, 'getWeather'])->name('get-weather');
Route::post('/get-weather-future', [WeatherAPI::class, 'getWeatherFuture'])->name('get-weather-future');
Route::post('/get-weather-location', [WeatherAPI::class, 'getWeatherLocations'])->name('get-weather-location');
Route::post('/get-weather-location-future', [WeatherAPI::class, 'getWeatherFuture'])->name('get-weather-location-future');

//contacts /////////
Route::post('/contact', [ContactController::class, 'store'])->name('store-contact');
Route::get('/contacts', [ContactController::class, 'show'])->name('store-show');


//records////////////
Route::post('/add-record', [HorizonController::class, 'store']);
Route::get('/get-record/{id}', [HorizonController::class, 'getRecord']);
Route::put('/edit-record/{id}', [HorizonController::class, 'edit']);
Route::get('/get-records', [HorizonController::class, 'getRecords']);
Route::get('/seed-records', [HorizonController::class, 'runSeeder']);
Route::delete('/delete-record/{id}', [HorizonController::class, 'delete']);
Route::delete('/delete-all-records/', [HorizonController::class, 'deleteAll']);

//swagger ////////////
Route::get('gen-docs', [SwaggerController::class, 'generateDocs']);

/// crawler
Route::post('scraper', [ScrapController::class, 'scraper'])->name('api.scraper');
