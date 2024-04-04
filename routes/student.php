<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizzController;
use App\Http\Controllers\QuestionController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| student Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//==============================Translate all pages============================
Route::group(['middleware' => 'auth:student'], function () {

    //==============================dashboard============================
    Route::get('/student/dashboard', function () {
        return view('pages.Students.dashboard');
    });


    //==============================Quizz============================
    Route::delete('Quizzes/{id}', [QuizzController::class, 'delete'])->name('Quizzes.delete');
    Route::resource('Quizzes', QuizzController::class);

   //==============================Question============================
   Route::delete('Questions/{id}', [QuestionController::class, 'delete'])->name('Questions.delete');
   Route::resource('Questions', QuestionController::class);


});
