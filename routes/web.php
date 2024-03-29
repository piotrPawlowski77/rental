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

//route do dzialania wyszukiwarki autocomplete na stronie glownej (datepicker.js)
Route::get('/searchCities', [App\Http\Controllers\FrontendController::class, 'searchCities'])->name('searchCities');

Route::post('/searchCars', [App\Http\Controllers\FrontendController::class, 'searchCars'])->name('searchCars');

//route do wyswietlenia formularza rezerwacji auta (car_reservation.blade.php)
Route::get('/carReservation/{id}', [App\Http\Controllers\FrontendController::class, 'carReservation'])->name('carReservation');

//route do wyswietlenia datepickera z datami rezerwacjami danego auta {id auta}(car_reservation.blade.php)
Route::get('/getCarReservationByAjax/{id}', [App\Http\Controllers\FrontendController::class, 'getCarReservationByAjax'])->name('getCarReservationByAjax');

//route do wyslamia formularza z danymi rezerwacji auta (car_reservation.blade.php)
Route::post('/addReservation/{car_id}/{city_id}', [App\Http\Controllers\FrontendController::class, 'addReservation'])->name('addReservation');

//route do opinii o serwisie (frontend)
Route::get('/opinions', [App\Http\Controllers\FrontendController::class, 'opinions'])->name('opinions');
//route do dodania opinii o serwisie (frontend)
Route::post('/addOpinion', [App\Http\Controllers\FrontendController::class, 'addOpinion'])->name('addOpinion');

//route dla panelu admin
Route::group(['prefix' => 'admin'], function (){

    Route::get('/', [\App\Http\Controllers\BackendController::class, 'index'])->name('adminHome');
    Route::get('/myCars', [\App\Http\Controllers\BackendController::class, 'myCars'])->name('myCars');
    Route::get('/deleteCar/{id}', [\App\Http\Controllers\BackendController::class, 'deleteCar'])->name('deleteCar');
    Route::match(['GET', 'POST'], '/carPanel/{id?}', [\App\Http\Controllers\BackendController::class, 'carPanel'])->name('carPanel');

    //rout-y CRUD do operacji na miastach
    Route::resource('cities', \App\Http\Controllers\CityController::class);

    Route::match(['GET', 'POST'],'/profile', [\App\Http\Controllers\BackendController::class, 'profile'])->name('profile');

    //route do usuniecia zdjecia
    Route::get('/deletePhoto/{id}', [\App\Http\Controllers\BackendController::class, 'deletePhoto'])->name('deletePhoto');

    //route do kalendarz rezerwacji - requesty ajax-owe
    Route::get('/getReservationDataFromDbByAjax', [\App\Http\Controllers\BackendController::class, 'getReservationDataFromDbByAjax'])->name('getReservationDataFromDbByAjax');

    //route do wyslania info ze powiadomienie przeczytane - requesty ajax-owe
    Route::get('/setReadNotificationByAjax', [\App\Http\Controllers\BackendController::class, 'setReadNotificationByAjax'])->name('setReadNotificationByAjax');

    //route do potwierdzania rezerwacji
    Route::get('/confirmReservation/{id}', [\App\Http\Controllers\BackendController::class, 'confirmReservation'])->name('confirmReservation');

    //route do usuwania rezerwacji
    Route::get('/deleteReservation/{id}', [\App\Http\Controllers\BackendController::class, 'deleteReservation'])->name('deleteReservation');


});
