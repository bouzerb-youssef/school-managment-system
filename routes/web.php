<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Grades\GradeController;
use App\Http\Controllers\Classroom\ClassroomController;
use App\Http\Controllers\Sections\SectionController;
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
   //==============================Classrooms============================
   Route::resource('Classrooms', ClassroomController::class);
   Route::post('delete_all', [ClassroomController::class, 'delete_all'])->name('delete_all');

   Route::post('Filter_Classes', [ClassroomController::class, 'Filter_Classes'])->name('Filter_Classes');


    //==============================Sections============================


        Route::resource('Sections', SectionController::class);

        Route::get('/classes/{id}',[SectionController::class, 'getclasses'] );

  
   
        
   

});