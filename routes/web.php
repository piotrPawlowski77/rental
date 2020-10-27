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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\FrontendController::class, 'index'])->name('home');
Route::get('/contact', [App\Http\Controllers\FrontendController::class, 'contact'])->name('contact');
Route::get('/about', [App\Http\Controllers\FrontendController::class, 'about'])->name('about');
Route::post('/sendContactMessage', [App\Http\Controllers\FrontendController::class, 'sendContactMessage'])->name('sendContactMessage');


//route dla panelu admin
Route::group(['prefix' => 'admin'], function (){

    Route::get('/', [\App\Http\Controllers\BackendController::class, 'index'])->name('adminHome');
    Route::get('/profile', [\App\Http\Controllers\BackendController::class, 'profile'])->name('profile');

});
