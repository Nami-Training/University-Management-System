<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClassroomRequest;
use App\Models\Grade;
use App\Models\Classroom;
use App\Services\ClassroomService;
use App\Services\GradeService;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{

    private $classroomService;
    private $gradeService;


    function __construct(ClassroomService $classroomService, GradeService $gradeService)
    {
        $this->classroomService = $classroomService;
        $this->gradeService = $gradeService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $My_Classes = $this->classroomService->all();
        $Grades = $this->gradeService->all();
        return view('pages.My_Classes.My_Classes', get_defined_vars());
    }

    public function getGradeClasses(string $grade_id)
    {
        return $this->classroomService->getData('Grade_id', $grade_id);
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
    public function store(ClassroomRequest $request)
    {
        try {
            $this->classroomService->create($request->validated());
            toastr()->success(trans('messages.success'));
            return redirect()->route('Classrooms.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Classroom $classroom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classroom $classroom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClassroomRequest $request, string $id)
    {
        try {
            $this->classroomService->update($id, $request->validated());
            toastr()->success(trans('messages.Update'));
            return redirect()->route('Classrooms.index');
        }catch(\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function delete(string $id)
    {
        $this->classroomService->delete($id);
        return redirect()->route('Classrooms.index');
    }

    public function delete_all(Request $request)
    {
        $this->classroomService->deletAll($request->delete_all_id);
        return redirect()->route('Classrooms.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->classroomService->forceDelete($id);
        return redirect()->route('Classrooms.index');
    }

    public function Filter_Classes(Request $request)
    {
        $Grades = $this->gradeService->all();
        $Search = $this->classroomService->findByColumn('Grade_id',$request->Grade_id);
        return view('pages.My_Classes.My_Classes',get_defined_vars())->withDetails($Search);

    }
}
