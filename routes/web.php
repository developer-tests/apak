<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleSocialiteController;
use App;

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
Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('clear-compiled');
    Artisan::call('config:cache');

    return "Cache is cleared";
});
Route::get('/updateapp', function () {
    Artisan::call('dump-autoload');
    echo 'dump-autoload complete';
});
//Route::get('set-locale/{locale}', function ($locale) {
//    \App::setLocale($locale);
//    session()->put('locale', $locale);
//    
//    return redirect()->back();
//})->middleware('setlocale')->name('locale.setting');

Route::get('set-locale/{locale}', 'LocalitionController@index')->name('locale.setting');

// Route::get('set-locale/{locale}', function ($locale) {
//                if (in_array($locale, \Config::get('app.locales'))) { session()->put('locale', $locale); }
//                dd(App::getLocale());
//                return redirect()->back();
//            })->name('locale.setting');

//Route::prefix(\Mcamara\LaravelLocalization\Facades\LaravelLocalization::setLocale())->middleware(['localeSessionRedirect', 'localizationRedirect'])->group(function () {
//    Route::group(['prefix' => '{locale}', 'where' => ['lang' => 'it|en'],'middleware' => 'setlocale'], function () {
    Auth::routes();
    Route::get('/', 'LoginController@index')->middleware('guest')->name('admin_login');
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
//});
