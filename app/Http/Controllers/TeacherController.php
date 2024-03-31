<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeacherRequest;
use App\Models\Gender;
use App\Models\Specialization;
use App\Models\Teacher;
use App\Services\GenderService;
use App\Services\SpecializationService;
use App\Services\TeacherService;

class TeacherController extends Controller
{

    private $teacherService;
    private $genderService;
    private $specializationService;

    function __construct(TeacherService $teacherService, GenderService $genderService, SpecializationService $specializationService)
    {
        $this->teacherService = $teacherService;
        $this->genderService = $genderService;
        $this->specializationService = $specializationService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = $this->teacherService->all();
        return view('pages.Teachers.Teachers', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genders = $this->genderService->all();
        $specializations = $this->specializationService->all();
        return view('pages.Teachers.create', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TeacherRequest $request)
    {
        $this->teacherService->createTeacher($request->validated(), $request->password, $request->Address);
        return redirect()->route('Teachers.index');
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
        $teacher = $this->teacherService->findById($id);
        $specializations = $this->specializationService->all();
        $genders = $this->genderService->all();
        return view('pages.Teachers.Edit', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TeacherRequest $request, string $id)
    {
        $this->teacherService->updateTeacher($id, $request->validated(), $request->password, $request->Address);
        return redirect()->route('Teachers.index');
    }

    public function delete(string $id)
    {
        $this->teacherService->delete($id);
        return redirect()->route('Teachers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->teacherService->forceDelete($id);
        return redirect()->route('Teachers.index');
    }
}
