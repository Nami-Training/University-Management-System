<?php

namespace App\Http\Controllers;

use App\Services\SectionService;
use App\Http\Requests\SectionRequest;
use App\Services\ClassroomService;
use App\Services\GradeService;
use App\Services\TeacherService;

class SectionController extends Controller
{

    private $sectionService;
    private $classroomService;
    private $teacherService;
    private $gradeService;

    function __construct(SectionService $sectionService, ClassroomService $classroomService, TeacherService $teacherService, GradeService $gradeService)
    {
        $this->sectionService = $sectionService;
        $this->classroomService = $classroomService;
        $this->teacherService = $teacherService;
        $this->gradeService = $gradeService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Grades = $this->gradeService->all();
        $Classes = $this->classroomService->all();
        $teachers = $this->teacherService->all();
        return view('pages.Sections.Sections', get_defined_vars());
    }

    public function getClassSection(string $class_id)
    {
        return $this->sectionService->getData('classroom_id', $class_id);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SectionRequest $request)
    {
        try {
            $section = $this->sectionService->create($request->validated());
            $section->teachers()->attach($request->teacher_id);
            toastr()->success(trans('messages.success'));
            return redirect()->route('Sections.index');
        }catch (\Exception $e){
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
    public function update(SectionRequest $request, string $id)
    {
        try {
            $this->sectionService->update($id, $request->validated());
            toastr()->success(trans('messages.Update'));
            return redirect()->route('Sections.index');
        }catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function delete(string $id)
    {
        try {
            $this->sectionService->delete($id);
            toastr()->success(trans('messages.Delete'));
            return redirect()->route('Sections.index');
        }catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->sectionService->forceDelete($id);
            toastr()->success(trans('messages.Delete'));
            return redirect()->route('Sections.index');
        }catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
