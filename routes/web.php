<?php

use App\Http\Controllers\StudentController;
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

Route::get('/',[StudentController::class, 'index']);

Route::get('add_new_student', function () {
    return view('add_student');
})->name('add_new_student');
Route::post('add_student',[StudentController::class, 'store'])->name('add_student');

Route::get('edit_student/{id}',[StudentController::class, 'edit'])->name('edit_student');
Route::post('edit_student/{id}',[StudentController::class, 'update'])->name('edit_student_record');


Route::get('inactive_student/{id}',[StudentController::class, 'inactive_student'])->name('inactive_student');
Route::get('active_student/{id}',[StudentController::class, 'active_student'])->name('active_student');




