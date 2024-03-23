<?php

use App\Http\Controllers\ClassroomController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizzController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;

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
});

Route::group(['verified', 'middleare' => 'auth'], function()
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
    Route::get('Classrooms/getClasses/{garde_id}', [ClassroomController::class, 'getGradeClasses'])->name('Classrooms.getGradeClasses');
    Route::resource('Classrooms', ClassroomController::class);

    //==============================Section============================
    Route::delete('Sections/{id}', [SectionController::class, 'delete'])->name('Sections.delete');
    Route::resource('Sections', SectionController::class);

    //==============================Teacher============================
    Route::delete('Teachers/{id}', [TeacherController::class, 'delete'])->name('Teachers.delete');
    Route::resource('Teachers', TeacherController::class);

    //==============================Subject============================
    Route::delete('Subjects/{id}', [SubjectController::class, 'delete'])->name('Subjects.delete');
    Route::resource('Subjects', SubjectController::class);

    //==============================Quizz============================
     Route::delete('Quizzes/{id}', [QuizzController::class, 'delete'])->name('Quizzes.delete');
     Route::resource('Quizzes', QuizzController::class);

    //==============================Question============================
    Route::delete('Questions/{id}', [QuestionController::class, 'delete'])->name('Questions.delete');
    Route::resource('Questions', QuestionController::class);


    //==============================parents============================
    // Route::view('add_parent','livewire.show_Form')->name('add_parent');


    //==============================Profile============================
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
