<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Services\BloodService;
use App\Services\ClassroomService;
use App\Services\GenderService;
use App\Services\GradeService;
use App\Services\NationalityService;
use App\Services\SectionService;
use App\Services\StudentService;
use Illuminate\Http\Request;

class StudentController extends Controller
{

    private $studentService;
    private $genderService;
    private $nationalityService;
    private $bloodService;
    private $classroomService;
    private $gradeService;
    private $sectionService;

    function __construct(StudentService $studentService, GenderService $genderService, NationalityService $nationalityService, BloodService $bloodService, ClassroomService $classroomService, GradeService $gradeService, SectionService $sectionService)
    {
        $this->studentService = $studentService;
        $this->genderService = $genderService;
        $this->nationalityService = $nationalityService;
        $this->bloodService = $bloodService;
        $this->classroomService = $classroomService;
        $this->gradeService = $gradeService;
        $this->sectionService = $sectionService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = $this->studentService->all();
        return view('pages.Students.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $Genders = $this->genderService->all();
        $nationals = $this->nationalityService->all();
        $bloods = $this->bloodService->all();
        $classes = $this->classroomService->all();
        $grades = $this->gradeService->all();
        $sections = $this->sectionService->all();
        return view('pages.Students.add', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentRequest $request)
    {
        try {
            $this->studentService->createStudent($request->validated(), $request->password, $request->file('photo'));
            toastr()->success(trans('messages.success'));
            return redirect()->route('Students.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student = $this->studentService->findById($id);
        return view('pages.Students.show', get_defined_vars());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $student = $this->studentService->findById($id);
        $Genders = $this->genderService->all();
        $nationals = $this->nationalityService->all();
        $bloods = $this->bloodService->all();
        $Grades = $this->gradeService->all();
        return view('pages.Students.edit', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudentRequest $request, string $id)
    {
        try {
            $this->studentService->updateStudent($id, $request->validated(), $request->password);
            toastr()->success(trans('messages.Update'));
            return redirect()->route('Students.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function Upload_attachment(Request $request)
    {
        $this->studentService->Upload_attachment($request->student_id, $request->file('photo'));
        toastr()->success(trans('messages.success'));
        return redirect()->route('Students.show', $request->student_id);
    }

    public function Delete_attachment(Request $request)
    {
        $this->studentService->Delete_attachment($request->student_id, $request->filename, $request->id);
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('Students.show', $request->student_id);
    }

    public function delete($id)
    {
        $this->studentService->delete($id);
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('Students.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->studentService->forceDelete($id);
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('Students.index');
    }
}
