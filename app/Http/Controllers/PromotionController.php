<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GradeService;
use App\Services\StudentService;
use App\Services\PromotionService;
use App\Http\Requests\PromotionRequest;
use App\Models\Student;

class PromotionController extends Controller
{
    private $promotionService;
    private $gradeService;
    private $studentService;

    function __construct(PromotionService $promotionService, GradeService $gradeService, StudentService $studentService)
    {
        $this->promotionService = $promotionService;
        $this->gradeService = $gradeService;
        $this->studentService = $studentService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $promotions = $this->promotionService->all();
        return view('pages.Students.promotion.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $Grades = $this->gradeService->all();
        return view('pages.Students.promotion.add', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PromotionRequest $request)
    {
        try {
            $students = $this->studentService->where('grade_id', $request->grade_id)->where('classroom_id', $request->classroom_id)->where('section_id', $request->section_id)->where('academic_year', $request->academic_year);

            if ($students->count() < 1) {
                return redirect()->back()->with('error_promotions', trans('there_is_no_students'));
            }

            // update in table student
            foreach ($students as $student) {
                $student->update([
                    'grade_id' => $request->grade_id_new,
                    'classroom_id' => $request->classroom_id_new,
                    'section_id' => $request->section_id_new,
                    'academic_year' => $request->academic_year_new,
                ]);

                $this->promotionService->create([
                    'student_id' => $student->id,
                    'from_grade' => $request->grade_id,
                    'from_Classroom' => $request->classroom_id,
                    'from_section' => $request->section_id,
                    'to_grade' => $request->grade_id_new,
                    'to_Classroom' => $request->classroom_id_new,
                    'to_section' => $request->section_id_new,
                    'academic_year' => $request->academic_year,
                    'academic_year_new' => $request->academic_year_new,
                ]);
            }
            toastr()->success(trans('messages.success'));
            return redirect()->route('promotion.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
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

    public function delete_all(Request $request)
    {
        try {
            if ($request->page_id == 1) {
                $Promotions = $this->promotionService->all();
                foreach ($Promotions as $Promotion) {
                    $ids = explode(',', $Promotion->student_id);
                    $this->studentService->updateWhereIn('id', $ids, [
                        'grade_id' => $Promotion->from_grade,
                        'classroom_id' => $Promotion->from_Classroom,
                        'section_id' => $Promotion->from_section,
                        'academic_year' => $Promotion->academic_year,
                    ]);

                    $Promotion->truncate();
                }
            }
            toastr()->error(trans('messages.Delete'));
            return redirect()->route('promotion.index');
        }catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $Promotion = $this->promotionService->findById($id);
            $student = $this->studentService->findById($Promotion->student_id);
            $student->update([
                'grade_id' => $Promotion->from_grade,
                'classroom_id' => $Promotion->from_Classroom,
                'section_id' => $Promotion->from_section,
                'academic_year' => $Promotion->academic_year,
            ]);
            $this->promotionService->delete($id);
            toastr()->error(trans('messages.Delete'));
            return redirect()->route('promotion.index');
        }catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
