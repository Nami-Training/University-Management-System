<?php

use App\Models\Teacher;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizzController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\dashboard\StudentController;

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
Route::group(['middleware' => 'auth:teacher'], function () {

    //==============================dashboard============================
    Route::get('/teacher/dashboard', function () {

        $ids = Teacher::findorFail(auth()->user()->id)->Sections()->pluck('section_id');
        $data['count_sections']= $ids->count();
        $data['count_students']= \App\Models\Student::whereIn('section_id',$ids)->count();

//        $ids = DB::table('teacher_section')->where('teacher_id',auth()->user()->id)->pluck('section_id');
//        $count_sections =  $ids->count();
//        $count_students = DB::table('students')->whereIn('section_id',$ids)->count();
        return view('pages.Teachers.dashboard.dashboard',$data);
    });

    Route::group(['namespace' => 'Teachers\dashboard'], function () {
        //==============================students============================
     Route::get('student',[StudentController::class,'index'])->name('student.index');
     Route::get('sections',[StudentController::class,'sections'])->name('sections');
     Route::post('attendance',[StudentController::class,'attendance'])->name('attendance');
     Route::post('edit_attendance',[StudentController::class,'editAttendance'])->name('attendance.edit');
     Route::get('attendance_report',[StudentController::class,'attendanceReport'])->name('attendance.report');
     Route::post('attendance_report',[StudentController::class,'attendanceSearch'])->name('attendance.search');


    });

    //==============================Quizz============================
    Route::delete('Quizzes/{id}', [QuizzController::class, 'delete'])->name('Quizzes.delete');
    Route::resource('Quizzes', QuizzController::class);

   //==============================Question============================
   Route::delete('Questions/{id}', [QuestionController::class, 'delete'])->name('Questions.delete');
   Route::resource('Questions', QuestionController::class);

});
