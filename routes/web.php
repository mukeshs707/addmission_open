<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\EnrollController;

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

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {

    Route::get('/classes', [StudentController::class, 'classes'])->name('classes');

    Route::get('/students', [StudentController::class, 'index'])->name('students');
    Route::post('/students/save', [StudentController::class, 'save'])->name('student.save');
    Route::get('/students/delete/{id}', [StudentController::class, 'delete'])->name('student.delete');

    Route::get('/enroll', [EnrollController::class, 'index'])->name('enroll');
    Route::post('/enroll/save', [EnrollController::class, 'save'])->name('enroll.save');
    Route::get('/enroll/delete/{id}', [EnrollController::class, 'delete'])->name('enroll.delete');

});