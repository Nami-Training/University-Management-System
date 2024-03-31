<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Services\GradeService;
use App\Services\PromotionService;
use App\Services\StudentService;

class GraduatedController extends Controller
{
    private $gradeService;
    private $studentService;
    private $promotionService;

    function __construct(GradeService $gradeService, StudentService $studentService, PromotionService $promotionService)
    {
        $this->gradeService = $gradeService;
        $this->studentService = $studentService;
        $this->promotionService = $promotionService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = $this->studentService->onlyTrashed();
        return view('pages.Students.Graduated.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $Grades = $this->gradeService->all();
        return view('pages.Students.Graduated.create', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $students = $this->studentService->where('grade_id', $request->grade_id)->where('classroom_id', $request->classroom_id)->where('section_id', $request->section_id);

        if ($students->count() < 1) {
            return redirect()->back()->with('error_Graduated', trans('Students_trans.there_is_no_students'));
        }

        foreach ($students as $student) {
            $ids = explode(',', $student->id);
            $this->studentService->deleteWhereIn('id', $ids);
        }

        return redirect()->route('graduated.index');
    }

    public function graduateStudentFromPromotion(string $id)
    {
        $Promotion = $this->promotionService->findById($id);
        $student = $this->studentService->findById($Promotion->student_id);
        $student->delete();
        $Promotion->delete();
        return redirect()->route('promotion.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }
    public function delete(Request $request)
    {
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->studentService->onlyTrashed()->where('id', $id)->first()->forceDelete();
        return redirect()->back();
    }

    public function ReturnStudent(string $id)
    {
        $this->studentService->onlyTrashed()->where('id', $id)->first()->restore();
        return redirect()->back();
    }
}
