<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeesController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\QuizzController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\Fees_InvoicesController;
use App\Http\Controllers\GraduatedController;
use App\Http\Controllers\PaymentStudentController;
use App\Http\Controllers\ProcessingFeeController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\ReceiptStudentController;
use App\Models\Promotion;

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
    Route::get('Sections/getSections/{class_id}', [SectionController::class, 'getClassSection'])->name('Sections.getClassSection');
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

    //==============================Student============================
    Route::delete('Students/{id}', [StudentController::class, 'delete'])->name('Students.delete');
    Route::post('Students/Upload_attachment', [StudentController::class, 'Upload_attachment'])->name('Students.Upload_attachment');
    Route::post('Students/Delete_attachment', [StudentController::class, 'Delete_attachment'])->name('Students.Delete_attachment');
    Route::resource('Students', StudentController::class);

    //==============================parents============================
    // Route::view('add_parent','livewire.show_Form')->name('add_parent');

    //==============================Fees============================
    Route::delete('Fees/{id}', [FeesController::class, 'delete'])->name('Fees.delete');
    Route::delete('Fee_Invoices/{id}', [Fees_InvoicesController::class, 'delete'])->name('Fee_Invoices.delete');
    Route::resource('Fees', FeesController::class);
    Route::resource('Fee_Invoices', Fees_InvoicesController::class);


    //==============================ReceiptStudents============================
    Route::delete('ReceiptStudent/{id}', [ReceiptStudentController::class, 'delete'])->name('ReceiptStudent.delete');
    Route::resource('ReceiptStudent', ReceiptStudentController::class);

    //==============================payment============================
    Route::delete('PaymentStudent/{id}', [PaymentStudentController::class, 'delete'])->name('PaymentStudent.delete');
    Route::resource('PaymentStudent', PaymentStudentController::class);

    //==============================ProcessingFee============================
    Route::delete('ProcessingFee/{id}', [ProcessingFeeController::class, 'delete'])->name('ProcessingFee.delete');
    Route::resource('ProcessingFee', ProcessingFeeController::class);

    //==============================Promotion============================
    Route::delete('promotion/delete_all', [PromotionController::class, 'delete_all'])->name('promotion.delete_all');
    Route::resource('promotion', PromotionController::class);

    //==============================Graduated============================
    Route::delete('graduated/delete_all', [GraduatedController::class, 'delete_all'])->name('graduated.delete_all');
    Route::resource('graduated', GraduatedController::class);


    //==============================Profile============================
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
