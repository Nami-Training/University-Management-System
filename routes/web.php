<?php

use App\Http\Controllers\ClassroomController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SectionController;

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

Route::get('/', function () {
    return view('auth.login');
})->middleware('auth');

Route::group(['verified'], function()
{
    Route::get('/dashboard', function () {
        return view('dashboard');
    });

    //==============================Garde============================
    Route::delete('Grades/{id}', [GradeController::class, 'delete'])->name('Grades.delete');
    Route::resource('Grades', GradeController::class);

    //==============================Classroom============================
    Route::delete('Classrooms/{id}', [ClassroomController::class, 'delete'])->name('Classrooms.delete');
    Route::post('Classrooms/delete_all', [ClassroomController::class, 'delete_all'])->name('Classrooms.delete_all');
    Route::post('Filter_Classes', [ClassroomController::class, 'Filter_Classes'])->name('Filter_Classes');
    Route::resource('Classrooms', ClassroomController::class);

    //==============================Section============================
    Route::delete('Sections/{id}', [SectionController::class, 'delete'])->name('Sections.delete');
    Route::resource('Sections', SectionController::class);




    //==============================Profile============================
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
