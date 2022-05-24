<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Grades\GradeController;

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



require __DIR__.'/auth.php';
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth']
    ], function () {

     //==============================dashboard============================

    Route::get('/dashboard', [Controller::class, 'index'])->name('dashboard');


   //==============================dashboard============================
   Route::resource('Grades', GradeController::class);


     
        
   Route::resource('Grade', GradeController::class);
  

});