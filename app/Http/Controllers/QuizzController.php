<?php

namespace App\Http\Controllers;

use App\Services\QuizService;
use App\Services\GradeService;
use App\Services\TeacherService;
use App\Http\Requests\QuizzRequest;
use App\Services\SectionService;
use App\Services\SubjectService;

class QuizzController extends Controller
{
    private $quizService;
    private $teacherService;
    private $gradeService;
    private $subjectService;
    private $sectionService;

    function __construct(QuizService $quizService, TeacherService $teacherService, GradeService $gradeService, SubjectService $subjectService, SectionService $sectionService)
    {
        $this->quizService = $quizService;
        $this->teacherService = $teacherService;
        $this->gradeService = $gradeService;
        $this->subjectService = $subjectService;
        $this->sectionService = $sectionService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $quizzes = $this->quizService->all();
        return view('pages.Quizzes.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subjects = $this->subjectService->all();
        $teachers = $this->teacherService->all();
        $grades = $this->gradeService->all();
        $sections = $this->sectionService->all();
        return view('pages.Quizzes.create', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(QuizzRequest $request)
    {
        try {
            $this->quizService->create($request->validated());
            toastr()->success(trans('messages.success'));
            return redirect()->route('Quizzes.index');
        }catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
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
        $quizz = $this->quizService->findById($id);
        $subjects = $this->subjectService->all();
        $teachers = $this->teacherService->all();
        $grades = $this->gradeService->all();
        $sections = $this->sectionService->all();
        return view('pages.Quizzes.edit', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(QuizzRequest $request, string $id)
    {
        try {
            $this->quizService->update($id, $request->validated());
            toastr()->success(trans('messages.Update'));
            return redirect()->route('Quizzes.index');
        }catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function delete(String $id)
    {
        try {
            $this->quizService->delete($id);
            toastr()->error(trans('messages.Delete'));
            return redirect()->route('Quizzes.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->quizService->forceDelete($id);
            toastr()->error(trans('messages.Delete'));
            return redirect()->route('Quizzes.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
