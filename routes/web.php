<?php

use App\Http\Controllers\ApiMakerController;
use App\Http\Controllers\ElasticdemoController;
use App\Http\Controllers\HorizonController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ScrapController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/dev', function () {






});

// Clear application cache:
Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    return 'Application Cache Routes Config View cache has been cleared';
});

Route::get('/', [MainController::class, 'welcome'])->name('welcome');
Route::get('/contact-me', [MainController::class, 'contactMe'])->name('contact-me');
Route::get('/inspire', [MainController::class, 'reloadInspire'])->name('inspire');
Route::get('/projects', [MainController::class, 'projects'])->name('projects');

//elastic
Route::get('/projects/elastic' ,[ElasticdemoController::class, 'index'])->name('projects.elastic');

//horizon
Route::get('/projects/my-horizon' ,[HorizonController::class, 'index'])->name('projects.horizon');
Route::get('/projects/my-horizon-start' ,[HorizonController::class, 'startHorizon'])->name('projects.horizon.start');

//scrapper
Route::get('/projects/scraper' ,[ScrapController::class, 'index'])->name('projects.scraper');
Route::post('/projects/scraper' ,[ScrapController::class, 'scraperWebForm'])->name('projects.scraper.url');

//news
Route::get('/projects/news' ,[NewsController::class, 'index'])->name('projects.news');
Route::post('/projects/news', [NewsController::class, 'submitForm'])->name('submitFormNews');

//api maker
Route::get('/projects/apimaker' ,[ApiMakerController::class, 'index'])->name('projects.apimaker');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
