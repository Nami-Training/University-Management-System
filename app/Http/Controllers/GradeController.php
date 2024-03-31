<?php

namespace App\Http\Controllers;

use App\Http\Requests\GradeRequest;
use App\Services\GradeService;

class GradeController extends Controller
{

    private $gradeService;

    function __construct(GradeService $gradeService)
    {
        $this->gradeService = $gradeService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Grades = $this->gradeService->all();
        return view('pages.Grades.Grades', get_defined_vars());
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
    public function store(GradeRequest $request)
    {
        $this->gradeService->create($request->validated());
        return redirect()->route('Grades.index');
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
    public function update(GradeRequest $request, string $id)
    {
        $this->gradeService->update($id, $request->validated());
        return redirect()->route('Grades.index');
    }


    public function delete(string $id)
    {
        $this->gradeService->delete($id);
        return redirect()->route('Grades.index');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->gradeService->forceDelete($id);
        return redirect()->route('Grades.index');
    }
}
