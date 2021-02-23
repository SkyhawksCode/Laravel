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
use Illuminate\Support\Facades\DB;

Route::prefix(LaravelLocalization::setLocale())->middleware(['localeSessionRedirect', 'localizationRedirect'])->group(function () {
    
    Route::get('/', function () {
        return view('auth/login');
    });

    Auth::routes();

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/home/search', [App\Http\Controllers\HomeController::class, 'search'])->name('search');
    Route::post('/home/ajax', [App\Http\Controllers\HomeController::class, 'ajax'])->name('ajax');
    Route::get('/home/setting', [App\Http\Controllers\HomeController::class, 'setting'])->name('setting');
    Route::get('/home/pdasetting', [App\Http\Controllers\HomeController::class, 'pdasetting'])->name('pdasetting');
    Route::post('/home/pdapurcase', [App\Http\Controllers\HomeController::class, 'pdapurcase'])->name('pdapurcase');
    Route::post('/home/settingsave', [App\Http\Controllers\HomeController::class, 'settingsave'])->name('settingsave');
    Route::get('/batteries/allget', [App\Http\Controllers\BatteryController::class, 'allget'])->name('allget');
    Route::get('/batteries/tocsv', [App\Http\Controllers\BatteryController::class, 'tocsv'])->name('batterytocsv');
    Route::get('/users/toexcel', [App\Http\Controllers\UserController::class, 'toexcel'])->name('toexcel');
    Route::get('/users/tocsv', [App\Http\Controllers\UserController::class, 'tocsv'])->name('tocsv');
    Route::get('/users/print', [App\Http\Controllers\UserController::class, 'print'])->name('print');
    Route::resource('batteries', 'BatteryController');
    Route::resource('users', 'UserController');

});