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
        return view('pages.Quizzes.index', compact('quizzes'));
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
        return view('pages.Quizzes.create', compact('subjects', 'teachers', 'grades', 'sections'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(QuizzRequest $request)
    {
        $this->quizService->create($request->validated());
        return redirect()->route('Quizzes.index');
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
        return view('pages.Quizzes.edit', compact('quizz', 'subjects', 'teachers', 'grades', 'sections'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(QuizzRequest $request, string $id)
    {
        $this->quizService->update($id, $request->validated());
        return redirect()->route('Quizzes.index');
    }

    public function delete(String $id)
    {
        $this->quizService->delete($id);
        return redirect()->route('Quizzes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->quizService->forceDelete($id);
        return redirect()->route('Quizzes.index');
    }
}
