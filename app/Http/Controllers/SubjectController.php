<?php

namespace App\Http\Controllers;

use App\Services\GradeService;
use App\Services\SubjectService;
use App\Services\TeacherService;
use App\Http\Requests\SubjectRequest;

class SubjectController extends Controller
{

    private $subjectService;
    private $teacherService;
    private $gradeService;

    function __construct(SubjectService $subjectService, TeacherService $teacherService, GradeService $gradeService)
    {
        $this->subjectService = $subjectService;
        $this->teacherService = $teacherService;
        $this->gradeService = $gradeService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = $this->subjectService->all();
        return view('pages.Subjects.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $grades = $this->gradeService->all();
        $teachers = $this->teacherService->all();
        return view('pages.Subjects.create', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubjectRequest $request)
    {
        try {
            $this->subjectService->create($request->validated());
            toastr()->success(trans('messages.success'));
            return redirect()->route('Subjects.index');
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

        $subject = $this->subjectService->findById($id);
        $teachers = $this->teacherService->all();
        $grades = $this->gradeService->all();
        return view('pages.Subjects.edit', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubjectRequest $request, string $id)
    {
        try {
            $this->subjectService->update($id, $request->validated());
            toastr()->success(trans('messages.Update'));
            return redirect()->route('Subjects.index');
        }catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function delete(string $id)
    {
        try {
            $this->subjectService->delete($id);
            toastr()->error(trans('messages.Delete'));
            return redirect()->route('Subjects.index');
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
            $this->subjectService->forceDelete($id);
            toastr()->error(trans('messages.Delete'));
            return redirect()->route('Subjects.index');
        }catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
